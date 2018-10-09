<?php

    namespace App\Controller\Api;

    use App\Controller\AppController;

    use Cake\Routing\Router;

    use Cake\Datasource\ConnectionManager;

    class ContentsController extends AppController {

        public function beforeFilter(\Cake\Event\Event $event) {
            parent::beforeFilter($event);                        
        }
        
        public function index(){
            $status = false;
            $message = "No data found.";
            header('Content-Type: application/json');
            if($this->request->getData('type')){
                $type = $this->request->getData('type');
                // $this->loadModel('Contents');               
                $data = $this->Contents->find('all',['conditions'=>['type'=>$type]])->first();                          
                if(!empty($data)){
                    $status = true;
                    $message = "Request successful.";
                }
                else{
                    $data = new \stdClass();
                }
            }
            else{
                $data = new \stdClass();
            }

            $this->response->type('json');
            echo json_encode(compact('status','message','data'));
            $this->response->send();                        
            exit;
        }
    }
    