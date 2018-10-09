<?php

    namespace App\Controller\Api;

    use App\Controller\AppController;

    use Cake\Routing\Router;

    use Cake\Datasource\ConnectionManager;

    class UsersController extends AppController {

        public $components = ['Image'];

        public function beforeFilter(\Cake\Event\Event $event) {
            parent::beforeFilter($event);                        
        }

        public function signup(){
            $status = false;
            $message = "Login could not be done. Please try again";

            if($this->request->getData()){
                $request = $this->request->getData();               

                if(!empty($request['fb_id'])){
                    $checkUser = $this->Users->find('all',['conditions'=>['fb_id'=>$request['fb_id']]])->first();
                    $this->loadModel('UserSessions');

                    if(empty($checkUser)){
                        $user = $this->Users->newEntity();

                        $request['loginToken'] = sha1(base64_encode(date('H:i:s')));

                        if(!empty($request['image'])){                                                            
                            $request['profile_image'] = $request['image'];
                        }
                        if($timezone = $this->request->header('timezone'))
                        {
                            $request['timezone'] = $timezone;
                        }
                        if($request['username'] == ''):  unset($request['username']); endif;
                        $user = $this->Users->patchEntity($user,$request,['validate'=>'default']);

                        if(empty($user->errors())){                           

                            if($this->Users->save($user)){
                                $status = true;
                                $message = "Login successful.";
                                
                                $session = $this->UserSessions->newEntity();
                                $session->user_id = $user->id;
                                $session->start_time = date('Y-m-d H:i:s');

                                $this->UserSessions->save($session);

                                $this->loadModel('UserNotInteresteds');
                                $this->UserNotInteresteds->deleteAll(['user_from'=>$user->id]);


                                $data = $this->Users->get($user->id,['contain'=>['UserImages']])->toArray();
                                $data['already_register'] = 0;

                                $this->loadModel('UserSettings');
                                $settings = $this->UserSettings->newEntity();                                
                                $settings->user_id = $data['id'];
                                $settings->distance = 10;                                                                
                                $settings->age_to = $data['age'];
                                $settings->dating = $data['sex'];
                                $this->UserSettings->save($settings);
                            }
                        }
                        else{                            
                            $errors = $user->errors();
                            $this->set(compact('errors'));
                        }                    
                    }     
                    else{        
                        $request['loginToken'] = sha1(base64_encode(date('H:i:s')));
                         if($timezone = $this->request->header('timezone'))
                        {
                            $request['timezone'] = $timezone;
                        }
                        $user = $this->Users->patchEntity($checkUser,$request);
                        $this->Users->save($checkUser);

                        $session = $this->UserSessions->find('all',['conditions'=>['user_id'=>$checkUser->id,'end_time'=>'0000-00-00 00:00:00']])->first();

                        if(empty($session)){
                            $session = $this->UserSessions->newEntity();
                            $session->user_id = $user->id;
                            $session->start_time = date('Y-m-d H:i:s');
                            $this->UserSessions->save($session);
                        }

                        $data = $this->Users->get($checkUser->id,['contain'=>['UserImages']])->toArray();
                        $data['already_register'] = 1;
                        $status = true;
                        $message = "User already registered.";
                    }
                }
                else{
                    $message = "Facebook Id is required.";
                    $data = [];
                }           
            }

            $this->set(compact('data','status','message'));             
            // $this->set("_serialize", [ "data",'status','message']);
        }

        public function profile(){
            $status = false;
            $message = "Request could not be completed.";

            if($this->request->is('post')){
                $request = $this->request->getData();
                if($this->request->getData('user_id')){
                    $id = $this->request->getData('user_id');
                }
                else{
                    $id = $this->request->session()->read('AppUser.id');
                }
                $data = $this->Users->get($id,['contain'=>['UserImages']])->toArray();                          
                if(!empty($data)){
                    $status = true;
                    $message = "Request successful.";
                }
            }

            $this->set(compact('data','status','message')); 
            $this->render('signup');
        }

        public function logout() {
            $status = false;
            $message = "You have not logged out successfully.";
            if (empty($this->request->session()->read('AppUser.id'))) {
                $status = true;
                $message = "You are already logged out.";
            } else {                
                $status = true;
                $user=$this->Users->get($this->request->session()->read('AppUser.id'));
                $user->loginToken = "";
                $this->Users->save($user);

                //check if user session exists and end it.
                $this->loadModel('UserSessions');
                $session = $this->UserSessions->find('all',['conditions'=>['user_id'=>$user->id,'end_time'=>'0000-00-00 00:00:00']])->first();
                if(!empty($session)){
                    $session->end_time = date('Y-m-d H:i:s');
                    $this->UserSessions->save($session);
                }

                $message = "You have been logged out successfully.";
                
            }
            $data = [];
            $this->response->type('json');
            echo json_encode(compact('status','message','data'));
            $this->response->send();                        
            exit;
        }

        public function updateProfile(){
            $status = false;
            $message = "Profile could not be updated. Please try again.";

            if($this->request->getData()){
                $request = $this->request->getData();

                $this->log($request,'debug');

                $user = $this->Users->get($this->request->session()->read('AppUser.id'));

                if(!empty($request['profile_image']) && is_array($request['profile_image'])){                        
                    $dir_path = str_replace("{user_id}", $user->id , USER_IMAGE_UPLOAD_DIR);
                    $request['profile_image'] = $this->Image->uploadImage($request['profile_image'],$dir_path,true);
                }
                else
                {
                    $pimgpath = explode('uploads',$request['profile_image']);
                    if($pimgpath[1])
                    {
                        $request['profile_image'] = 'uploads'.$pimgpath[1];
                    }
                }
                if($timezone = $this->request->header('timezone'))
                {
                    $request['timezone'] = $timezone;
                }
                $user = $this->Users->patchEntity($user,$request,['validate'=>'apiUpdate']);


                if(empty($user->errors())){
                    $this->loadModel('UserImages');
                    $this->UserImages->deleteAll(['user_id'=>$user->id]);

                    // print_r(count($request['previous_images'])); exit;


                    if((!empty($request['images']) && is_array($request['images'])) || (isset($request['previous_images']) && count($request['previous_images']) > 0)){                            
                        
                        $imageRecord['user_id'] = $user->id;
                        
                        if(!is_array($request['previous_images'])){
                            $request['previous_images'] = explode(",", $request['previous_images']);
                            $previous_images = [];
                            foreach($request['previous_images'] As $pi)
                            {
                                $getpath = explode('uploads',$pi);
                                if($getpath[1])
                                {
                                    $previous_images[] = 'uploads'.$getpath[1];
                                }
                            }
                        }
                        $request['previous_images'] = $previous_images;
                        if(isset($request['images'])){
                            $request['images'] = array_merge($request['previous_images'],$request['images']);
                        }
                        else{
                            $request['images']  = $request['previous_images'];                            
                        }
                        
                        foreach ($request['images'] as $key => $value) {
                            if(is_array($value)){
                                $dir_path = str_replace("{user_id}", $user->id , USER_IMAGE_UPLOAD_DIR);
                                $imageRecord['image'] = $this->Image->uploadImage($value,$dir_path,true);
                            }
                            else{
                                $imageRecord['image'] = $value;
                            }
                            if($imageRecord['image'])
                            {
                                $image = $this->UserImages->newEntity();
                                $image = $this->UserImages->patchEntity($image,$imageRecord);
                                $this->UserImages->save($image);
                            }
                        }
                    }                    
                      
                    if($this->Users->save($user)){
                        $data = $this->Users->get($user->id,['contain'=>['UserImages']])->toArray();
                        $status = true;
                        $message = "Profile successfully updated.";
                    }
                    // print_r($data); exit;
                }
                else{
                        $errors = $user->errors();
                        $data = new \stdClass();
                        $this->set(compact('errors'));
                        // $this->render('signup');
                    }

                $this->set(compact("status", "message", "data"));       
                $this->render('signup');         
            }
        }

        public function getSettings(){
            $status = false;
            $message = "No recod found.";

            if($this->request->is('post')){
                $this->loadModel('UserSettings');
                $data = $this->UserSettings->find('all',['conditions'=>['user_id'=>$this->request->session()->read('AppUser.id')]])->first();
                if(!empty($data)){
                    $status = true;
                    $message = "Request successful.";
                }
                else{
                    $data = '';
                }
            }
            $this->response->type('json');
            echo json_encode(compact('status','message','data'));
            $this->response->send();                        
            exit;
        }

        public function saveSettings(){
            $status = false;
            $message = "Settings could not be updated. Please try again.";

            if($this->request->is('post')){
                $this->loadModel('UserSettings');

                $request = $this->request->getData();
                $this->log($request,'debug');
                $request['user_id'] = $this->request->session()->read('AppUser.id');

                $settings = $this->UserSettings->find('all',['conditions'=>['user_id'=>$request['user_id']]])->first();

                if(empty($settings)){
                    $settings = $this->UserSettings->newEntity();
                }

                $settings = $this->UserSettings->patchEntity($settings,$request);

                if(!empty($this->UserSettings->save($settings))){
                    $data = $this->UserSettings->get($settings->id);
                    $status = true;
                    $message = "Settings updates successfully.";
                }
            }

            $this->response->type('json');
            echo json_encode(compact('status','message','data'));
            $this->response->send();                        
            exit;
        }

        public function getUsers(){
            header('Content-Type: application/json');
            $status = false;
            $message = "No users found.";

            $data['record'] = [];

            if($this->request->getData('lat') && $this->request->getData('lon')){
                $request = $this->request->getData();
                $user = $this->Users->get($this->request->session()->read('AppUser.id'));

                if(!empty($user)){                    
                    $user->lat = $request['lat'];
                    $user->lon = $request['lon'];

                    $this->Users->save($user);
                    $this->loadModel('UserSettings'); 
                    $settings = $this->UserSettings->find('all',['conditions'=>['user_id'=>$user->id]])->first();
                    
                    $conn = ConnectionManager::get('default');

                    $fields = "users.username,users.id,users.age";

                    $limit = 10;

                    if(isset($request['page']) && $request['page'] != 0){
                        $offset = ($request['page']-1)*10;                        
                    }
                    else{                        
                        $offset = 0;
                    }
                    //$settings = '';
                    if(!empty($settings)){
                        
                       if($settings->dating)
                       {
                        $sexin = 'and users.sex IN ('.$settings->dating.')';
                       }
                       if($settings->distance)
                       {
                         /*$distanceqry = 'and ( 3959 * ACOS( COS( RADIANS( '.$request["lat"].' ) ) * COS( RADIANS( lat ) ) * COS( RADIANS( lon ) - RADIANS( '.$request["lon"].' ) ) + SIN( RADIANS('.$request["lat"].' ) ) * SIN( RADIANS( lat ) ) ) ) <= '.$settings->distance;*/
                       }
                       
                        $stmt = $conn->execute('SELECT *, ( 3959 * ACOS( COS( RADIANS( '.$request["lat"].' ) ) * COS( RADIANS( lat ) ) * COS( RADIANS( lon ) - RADIANS( '.$request["lon"].' ) ) + SIN( RADIANS('.$request["lat"].' ) ) * SIN( RADIANS( lat ) ) ) ) AS distance FROM users INNER JOIN user_sessions ON users.id = user_sessions.user_id WHERE users.id != '.$user->id.' and UNIX_TIMESTAMP(user_sessions.end_time) = 0 and users.age >= '.$settings->age_from.' '.$sexin.' '.$distanceqry.' and users.age <= '.$settings->age_to.' and users.status = 1 and users.loginToken != "" group by users.id  order by distance asc limit '.$offset.','.$limit.'');                        
                    }
                    else{
                        
                        $stmt = $conn->execute('SELECT *, ( 3959 * ACOS( COS( RADIANS( '.$request["lat"].' ) ) * COS( RADIANS( lat ) ) * COS( RADIANS( lon ) - RADIANS( '.$request["lon"].' ) ) + SIN( RADIANS('.$request["lat"].' ) ) * SIN( RADIANS( lat ) ) ) ) AS distance FROM users INNER JOIN user_sessions ON users.id = user_sessions.user_id WHERE users.id != '.$user->id.' and UNIX_TIMESTAMP(user_sessions.end_time) = 0 and users.status = 1 and users.loginToken != "" order by distance asc limit '.$offset.','.$limit.'');                          
                    }       
                         

                    $result = $stmt ->fetchAll('assoc');
                   // echo json_encode($result);
                    if(!empty($result)){                        
                        $this->loadModel('UserNotInteresteds');
                        $notIntrested = $this->UserNotInteresteds->find('list',['conditions'=>['user_from'=>$this->request->session()->read('AppUser.id')],'keyField' => 'id','valueField'=>'user_to'])->toArray();
                        

                        $this->loadModel('UserImages');
                        foreach ($result as $key => $value) {
                            $images = $this->UserImages->find('all',['conditions'=>['user_id'=>$value['user_id']],'fields'=>['image']])->all();
                            if(iterator_count($images)){                                
                                foreach ($images as $index => $image) {
                                    if(strpos($image['image'], 'uploads/users/') !== false){          
                                        //$userImage = Router::url('/',true).$image['image'];
                                        $userImage = SITEURL.$image['image'];
                                    }
                                    else
                                    {
                                        $userImage = $image['image'];
                                    }

                                    $result[$key]['images'][] = $userImage;
                                }                                
                            }
                            else{                                
                                $result[$key]['images'] = [];
                            }

                            $result[$key]['distance'] = strval(round($result[$key]['distance'],2));

                            $result[$key]['id'] = $result[$key]['user_id'];
                            if(strpos($result[$key]['profile_image'], 'uploads/users/') !== false){          
                                        //$userImage = Router::url('/',true).$image['image'];
                                $result[$key]['profile_image'] = SITEURL.$result[$key]['profile_image'];
                            }
                           
                            if(in_array($result[$key]['id'], array_values($notIntrested))){
                                unset($result[$key]);
                            }
                        }
                        $status = true;
                        $message = "Request successful.";
                        $data['record'] = array_values($result);
                    }
                    else{
                        $status = true;
                    }
                }

                $data['paid_calls'] = $user->paid_calls;
                $data['unpaid_calls'] = $user->unpaid_calls;
            }

            $this->response->type('json');
            echo json_encode(compact('status','message','data','settings'));
            $this->response->send();                        
            exit;
        }

        public function gridSession(){
            $status = false;
            $message = "Request could not be completed.";

            if($this->request->is('post')){
                $request = $this->request->getData();
                //echo json_encode($request);exit;
                $this->loadModel('UserSessions');
                $session = $this->UserSessions->find('all',['conditions'=>['user_id'=>$this->request->session()->read('AppUser.id'),'end_time'=>'0000-00-00 00:00:00']])->first();       

                if(isset($request['type'])){                     
                    if(!empty($session) && ($request['type'] == 2)){
                        $session->end_time = date('Y-m-d H:i:s');
                        
                        if($this->UserSessions->save($session)){                        
                            $status = true;
                            $message = "Request successfully completed.";
                            $data['session_active'] = 0;
                            $data['t'] = 0;

                            //delete all record of not interested
                            $this->loadModel('UserNotInteresteds');
                            $this->UserNotInteresteds->deleteAll(['user_from'=>$this->request->session()->read('AppUser.id')]);
                        }                        
                    }
                    elseif(empty($session) && ($request['type'] == 1)){
                        $session = $this->UserSessions->newEntity();
                        $record['start_time'] = date('Y-m-d H:i:s');
                        $record['user_id'] = $this->request->session()->read('AppUser.id');
                        $session = $this->UserSessions->patchEntity($session,$record);

                        if($this->UserSessions->save($session)){
                            $status = true;
                            $message = "Request successfully completed.";
                            $data['session_active'] = 1;
                            
                            //delete all record of not interested
                            $this->loadModel('UserNotInteresteds');
                            $this->UserNotInteresteds->deleteAll(['user_from'=>$this->request->session()->read('AppUser.id')]);


                            
                        }
                    }
                    elseif(!empty($session)){
                        $status = true;
                        $message = "Request successfully completed.";
                        $data['session_active'] = 1;
                        
                        //delete all record of not interested
                        $this->loadModel('UserNotInteresteds');
                        $this->UserNotInteresteds->deleteAll(['user_from'=>$this->request->session()->read('AppUser.id')]);
                    }
                }         
            }

            $this->response->type('json');
            echo json_encode(compact('status','message','data'));
            $this->response->send();                        
            exit;
        }

        public function checkDetail() {
            $status = false;
            $message = "Username already exist.";
            if($this->request->getData('username')){
                $user = $this->Users->find('all',['conditions'=>['username' => $this->request->getData('username'),'id !='=>$this->request->session()->read('AppUser.id')]])->first();
                if(empty($user)){
                    $status = true;
                    $message = "Username is available.";
                }
            }
            else{
                $message = "Please enter username.";
            }
            
            $this->response->type('json');
            echo json_encode(compact('status','message','data'));
            $this->response->send();                        
            exit;
        }

        public function notIntrested(){
            $status = false;
            $message = "Request could not be completed. Please try again.";

            if($this->request->getData('user_id')){
                $this->loadModel('UserNotInteresteds');
                $user = $this->UserNotInteresteds->newEntity();

                $record['user_to'] = $this->request->getData('user_id');
                $record['user_from'] = $this->request->session()->read('AppUser.id');

                $user = $this->UserNotInteresteds->patchEntity($user,$record);

                if($this->UserNotInteresteds->save($user)){
                    $user = $this->UserNotInteresteds->newEntity();
                    $record['user_from'] = $this->request->getData('user_id');
                    $record['user_to'] = $this->request->session()->read('AppUser.id');

                    $user = $this->UserNotInteresteds->patchEntity($user,$record);

                    if($this->UserNotInteresteds->save($user)){
                        $status = true;
                        $message = "Request successful.";
                    }
                }
            }

            $this->response->type('json');
            echo json_encode(compact('status','message','data'));
            $this->response->send();                        
            exit;
        }

        //Get Plans
        public function getPlans()
        {
            $this->autoRender = false;
            $status = false;
            $message = "Request could not be completed. Please try again.";
            $errors = [];
            if(!$user_id = $this->request->session()->read('AppUser.id'))
            {
                $errors[] = "User Id not found.";
            }
            if($errors)
            {
                $message = implode(',',$errors);
                $status = false;
            }
            else
            {
                $this->loadModel('Plans');

                // Get plan details 
                $getplans = $this->Plans->find('all',['fields'=>['no_of_chats','price','name','id']])->toArray();
                if($getplans)
                {
                
                    /*****************************************************************/
                    $data = $getplans;
                    $status = true;
                   
                }  
                else
                {
                    $status = false;
                    
                }
            }
            $this->response->type('json');
            echo json_encode(compact('status','message','data'));
            $this->response->send();                        
            exit;
        }


        public function saveSubscription()
        {
            $status = false;
            $message = "Request could not be completed. Please try again.";
            $errors = [];
            $txn_id = $this->request->getData('txn_id');
            $status = $this->request->getData('status');
            $device = $this->request->getData('deviceType');
            $plan_id = $this->request->getData('plan_id');
            $appdata = $this->request->getData('payment_data');
            if($txn_id == '') { $errors[] = "Txn Id is required";}
            if($status == '') { $errors[] = "Status is required";}
            if($device == '') { $errors[] = "Device is required";}
            if($appdata == '') { $errors[] = "Payment Data is required";}
            if($plan_id == '') { $errors[] = "Plan Id is required";}
            if(!$user_id = $this->request->session()->read('AppUser.id'))
            {
                $errors[] = "User Id not found.";
            }
            if($errors)
            {
                $message = implode(',',$errors);
            }
            else
            {
                $this->loadModel('Payments');
                $this->loadModel('Subscriptions');
                $this->loadModel('Users');
                $this->loadModel('Plans');

                // Get plan details 
                $getplans = $this->Plans->find('all',['conditions'=>['id'=>$plan_id]])->last();
                if($getplans)
                {
                // Save Payment
                $payments = $this->Payments->newEntity();
                $payments['user_id'] = $user_id;
                $payments['plan_id'] = $plan_id;
                $payments['payment_data'] = $appdata;
                $payments['status'] = $status;
                $payments['device'] = $device;
                $payments['amount'] = $getplans['price'];
                $this->Payments->save($payments);
                /*****************************************************************/
                // Save Subscription 
                $sub = $this->Subscriptions->newEntity();
                $sub['user_id'] = $user_id;
                $sub['txn_id'] = $txn_id;
                $sub['device'] = $device;
                $sub['status'] = $status;
                $sub['appdata'] = $appdata;
                $this->Subscriptions->save($sub);
                /*****************************************************************/

                // UPdate User Data
                $user = $this->Users->get($user_id);
                if($getplans['type']  == 1 )
                {
                    $user->subscribed = 1;
                    $user->unlimited_till = date('Y-m-d',strtotime(date('Y-m-d').' +30 DAYS'));
                }
                else
                {
                    $user->unpaid_calls = $user->unpaid_calls + $getplans['no_of_chats'];
                }
                $this->Users->save($user);
                /*****************************************************************/
                $status = true;
                $message = "Subscription updated successful.";
                }  
                else
                {
                    $status = false;
                    $message = "Subscription not found.";
                }
            }
            $this->response->type('json');
            echo json_encode(compact('status','message','data'));
            $this->response->send();                        
            exit;
        }

        

        public function saveFeedback()
        {
            $status = false;
            $message = "Request could not be completed. Please try again.";
            $errors = [];
            $comment = $this->request->getData('message');
            if($comment == '') { $errors[] = "Message is required";}
            if(!$user_id = $this->request->session()->read('AppUser.id'))
            {
                $errors[] = "User Id not found.";
            }
            if($errors)
            {
                $message = implode(',',$errors);
            }
            else
            {
                $this->loadModel('Feedbacks');
                // Get plan details 
                $feedback = $this->Feedbacks->newEntity();
                $data['user_id'] = $user_id;
                $data['message'] = $comment;
                $feedback = $this->Feedbacks->patchEntity($feedback , $data);
                $this->Feedbacks->save($feedback);
                $status = true;
                $message = "Thank you for your feedback.";
            }  
            
            $this->response->type('json');
            echo json_encode(compact('status','message'));
            $this->response->send();                        
            exit;
        }

        public function saveLocations()
        {
            $status = false;
            $message = "Request could not be completed. Please try again.";
            $errors = [];
            if(!$user_id = $this->request->getData('user_id'))
            {
                $errors[] = "User Id not found.";
            }
            if(!$lat = $this->request->getData('lat'))
            {
                $errors[] = "Latitude not found.";
            }
            if(!$lng = $this->request->getData('lng'))
            {
                $errors[] = "Longitude not found.";
            }
            if($errors)
            {
                $message = implode(',',$errors);
            }
            else
            {
                //Configure::write('debug' , true);
                $this->loadModel('Locations');
                // Get plan details 
                $check = $this->Locations->findByUserId($user_id)->last();
                if($check)
                {
                    $feedback = $this->Locations->get($check['id']);
                }
                else
                {
                    $feedback = $this->Locations->newEntity();
                }
                $data['user_id'] = $user_id;
                $data['lat'] = $lat;
                $data['lng'] = $lng;
                $feedback = $this->Locations->patchEntity($feedback , $data);
                $this->Locations->save($feedback);
                $status = true;
                $message = "Location has been updated successfully.";
            }  
            
            $this->response->type('json');
            echo json_encode(compact('status','message'));
            $this->response->send();                        
            exit;
        }
    }
    