<?php

    namespace App\Controller\Admin;

    use App\Controller\AppController;

    class BlockedController extends AppController {

        public function beforeFilter(\Cake\Event\Event $event) {
            parent::beforeFilter($event);
            $this->loadModel('UserNotInteresteds');
            // $this->loadComponent('Common');
        }

        public function index() {
            
            $conditions = [];
            $this->paginate=['limit'=>20,"conditions"=>$conditions,'contain'=>['FromUser','ToUser']];

            $results = $this->paginate($this->UserNotInteresteds)->toArray();         
            
            $this->set(compact('results'));
            $this->set('_serialize', ['results']);
        }

         public function delete($id = NULL){
            if(!empty($id)){
                $feedback = $this->UserNotInteresteds->get($id);
                if($this->UserNotInteresteds->delete($feedback)){
                    $this->Flash->success(__('Record have been deleted successfully'));
                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('Record were NOT deleted successfully'));
            return $this->redirect(['action' => 'index']);
        }
       

    }
    