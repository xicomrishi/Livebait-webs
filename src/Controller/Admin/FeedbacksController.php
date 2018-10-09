<?php

    namespace App\Controller\Admin;

    use App\Controller\AppController;

    class FeedbacksController extends AppController {

        public function beforeFilter(\Cake\Event\Event $event) {
            parent::beforeFilter($event);
            // $this->loadComponent('Common');
        }

        public function index() {
            $conditions = [];
            $this->paginate=['limit'=>10,"conditions"=>$conditions,'contain'=>['Users']];

            $results = $this->paginate($this->Feedbacks)->toArray();         
            
            $this->set(compact('results'));
            $this->set('_serialize', ['results']);
        }

        public function view($id) {
            $data = $this->Feedbacks->get($id,['contain'=>['Users']])      ;
            
            $this->set(compact('data'));
            $this->set('_serialize', ['results']);
        }

        
        public function delete($id = NULL){
            if(!empty($id)){
                $feedback = $this->Feedbacks->get($id);
                if($this->Feedbacks->delete($feedback)){
                    $this->Flash->success(__('Feedback have been deleted successfully'));
                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('Feedback were NOT deleted successfully'));
            return $this->redirect(['action' => 'index']);
        }

    }
    