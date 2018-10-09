<?php

    namespace App\Controller\Api;

    use App\Controller\AppController;

    use Cake\Routing\Router;

    use Cake\Datasource\ConnectionManager;

    class RequestsController extends AppController {

        public $components = ['Image'];

        public function beforeFilter(\Cake\Event\Event $event) {
            parent::beforeFilter($event);                        
        }
        
        public function save(){
            $status = false;
            $message = "Call log could not be saved.";

            if($this->request->getData()){
                $this->loadModel('User');
                $request = $this->request->getData();
                $request['from_user_id'] = $this->request->session()->read('AppUser.id');
                if($request['quickblox_id'])
                {
                    $to = $this->Users->find('all',['conditions'=>['quickblox_id'=>$request['quickblox_id']]])->first();
                    $request['to_user_id'] = $to->id;
                }
               
                if($req_id = $request['request_id'])
                {
                    $record = $this->Requests->get($req_id);
                }
                else
                {
                    $record = $this->Requests->newEntity();
                }
                $record = $this->Requests->patchEntity($record,$request);
                //print "<pre>";print_r($record);exit;
                if($this->Requests->save($record)){
                    if($record['status'] == 1){
                        $u = $this->Users->get($request['from_user_id']);
                        if($u['subscribed'] == 0)
                        {
                            if($u['unpaid_calls'] > 0)
                            {
                                $u->unpaid_calls = $u['unpaid_calls'] - 1;
                            }
                            else if($u['paid_calls'] > 0)
                            {
                                $u->paid_calls = $u['paid_calls'] - 1;
                            }
                            $this->Users->save($u);
                        }
                    }
                    if($record['status'] == 2){
                        $this->loadModel('UserNotInteresteds');
                        $user = $this->UserNotInteresteds->newEntity();

                        $row['user_from'] = $request['to_user_id'];
                        $row['user_to'] = $this->request->session()->read('AppUser.id');

                        $user = $this->UserNotInteresteds->patchEntity($user,$row);

                        if($this->UserNotInteresteds->save($user)){
                            $user = $this->UserNotInteresteds->newEntity();
                            $row['user_to'] = $to->id;
                            $row['user_from'] = $this->request->session()->read('AppUser.id');

                            $user = $this->UserNotInteresteds->patchEntity($user,$row);
                            $this->UserNotInteresteds->save($user);
                        }
                    }
                    $status = true;
                    $message = "Call log saved successfully.";
                    $request_id = $record->id;

                }
            }

            $this->response->type('json');
            echo json_encode(compact('status','message','request_id'));
            $this->response->send();                        
            exit;
        }

        public function sendDetail(){
             header('Content-Type: application/json');
            //$this->autoRender = false;
            $status = false;
            $message = "Request could not be completed.";
            $stop = false;

            if($this->request->is('post')){
                $request = $this->request->getData();
                // if(!$request['request_id'])
                // {
                //     $status = false;
                //     $message = "Please provide Request Id .";
                // }
                // else
                // {
                $this->loadModel('Users');
                $user = $this->Users->get($this->request->session()->read('AppUser.id'));
                $name = $user->name;
                 //print "<pre>";print_r($user);exit;
                if($request['type'] == 1){
                    if(empty($user->phone_number)){                        
                        $message = "Phone number doesn't exist.";
                        $stop = true;
                    }
                    if($user->isMobileVerified == 0 ){                        
                        $message = "Please verify your mobile number to share with your friends";
                        $stop = true;
                    }
                    else{                        
                        $data['phone_number'] = $user->phone_number;
                        $data['type'] = 1;
                        $data['message'] = $data['phone_number']."\n".$name." wants to share his/her number with you.";
                    }
                    
                }
                elseif($request['type'] != 2 || empty($request['address']) || empty($request['lat']) || empty($request['lon'])){
                    $stop = true;
                    $message = "Your location could not be share right now. Please try again later.";                    
                }
                else{                                        
                    $data = $request;
                    $data['message'] = $name." wants to share his/her location with you.";
                }

                if(isset($request['user_id']) && !empty($request['user_id']) && !$stop){
                    $receiver = $this->Users->get($request['user_id']);
                }
                else
                {

                }

               // print "<pre>";print_r($receiver);exit;
                if(!$stop && !empty($receiver->deviceToken) && !empty($receiver->deviceType)){
                    unset($data['user_id']);
                    unset($data['device_type']);

                    $this->loadComponent('Common');
                    $this->loadModel('Shares');
                    $share['data'] = $data;
                    $share['from'] = $user->id;
                    $share['to'] = $receiver->id;
                    $share['type'] = $request['type'];
                    //$share['request_id'] = $request['request_id'];
                    $s = $this->Shares->add($share);


                    if($receiver->deviceType == "A"){                        
                        $check = $this->Common->androidNotification($data,$receiver->deviceToken , $receiver->id);
                    }
                    else{
                        $check = $this->Common->iosNotification($data,$receiver->deviceToken, $receiver->id);
                    }

                    if($check){
                        $status = true;
                        $message = "Request successful".$check;
                        //$share_id = $share->id;
                    }
                    else
                    {
                        $status = false;
                        $message = 'Notification failed.'.$check;
                    }
                   
                }
                else{
                        $status = false;
                        if(!$message)
                        {
                         $message = "Receiver Token not found.";
                        }
                        
                } 
                }           
            //}

            $this->response->type('json');
            echo json_encode(compact('status','message','share_id'));
            $this->response->send();                        
            exit;
        }

        public function getNotifications(){
            $status = false;
            $message = "Request could not be completed.";
            $stop = false;
            header('Content-Type: application/json');
            if($this->request->is('post')){
                $this->loadModel('Users');
                $this->loadModel('Shares');
                $user_id = $this->request->session()->read('AppUser.id');
                if($user_id)
                {
                    $request = $this->request->getData();
                    if(!$request['page']) { $page = 1; }else{ $page = $request['page'];}
                    $this->paginate = ['conditions'=>['OR'=>
                        [
                            ['Shares.touser'=>$user_id,'Shares.type in (1,2)'],
                            ['Shares.fromuser'=>$user_id,'Shares.type'=>3]
                        ]
                    ]
                ,'order'=>['Shares.id'=>'desc'],'contain'=>['Sender'],'limit'=>50,'page'=>$page];
                    $list = $this->paginate($this->Shares);
                    $data = [];
                    foreach($list as $list)
                    {
                        $data[] = ['sender'=>$list['sender'],'type'=>$list['type'],'request_data'=>json_decode($list['data'])];
                    }
                    $status = true;
                    $message = true;
                }
                             
            }

            $this->response->type('json');
            echo json_encode(compact('status','message','data'));
            $this->response->send();                        
            exit;
        }

         public function reportSpam(){
            $status = false;
            $message = "Request could not be completed.";
            $stop = false;

            if($this->request->is('post')){
                $this->loadModel('Users');
                $this->loadModel('Shares');
                $error = [];
                $user_id = $this->request->session()->read('AppUser.id');
                if($user_id)
                {
                    $request = $this->request->getData();
                    $fromuser = $user_id;
                    if($request['user_id'])
                    {
                        $touser = $request['user_id'];
                    }
                    else
                    {
                        $error[] = "User Id is required.";
                    }
                    if($request['screenshot']['name'])
                    {
                        $img = $request['screenshot'];
                    }
                    else
                    {
                        $error[] = "Screenshot Required is required.";
                    }
                    if($error)
                    {
                        $status = false;
                        $message = implode(',',$error);
                    }
                    else
                    {
                        //$this->loadModel('ReportSpams');
                        //$ins = $this->ReportSpams->newEntity();
                        //$ins->fromuser = $fromuser;
                        //$ins->touser = $touser;
                        //$ins->request_id = $request_id;
                        $dir_path = SPAM_FOLDER;
                        $screenshot = $this->Image->uploadImage($request['screenshot'],$dir_path,false);
                       // $ins->screenshot = $screenshot;
                       //$this->ReportSpams->save($ins);
                        if($screenshot)
                        {
                            $this->loadComponent('Common');
                            $this->loadModel('Shares');
                            $msg = "You have reported this call as spam .";
                            $share['data'] = ['screenshot'=>BASE_URL.$dir_path.$screenshot,'message'=>$msg];
                            $share['from'] = $fromuser;
                            $share['to'] = $touser;
                            $share['type'] = 3;
                            //$share['request_id'] = $request['request_id'];
                            $s = $this->Shares->add($share);


                            $status = true;
                            $message = true;
                        }
                        else
                        {
                            $status = false;
                            $message = json_encode($request['screenshot']['error']);
                        }
                    }
                }
                             
            }

            $this->response->type('json');
            echo json_encode(compact('status','message','data'));
            $this->response->send();                        
            exit;
        }


    }
    