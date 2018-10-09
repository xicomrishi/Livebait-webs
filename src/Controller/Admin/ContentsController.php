<?php

    namespace App\Controller\Admin;

    use App\Controller\AppController;

    class ContentsController extends AppController {

        public function beforeFilter(\Cake\Event\Event $event) {
            parent::beforeFilter($event);
            // $this->loadComponent('Common');
        }

        public function index() {
            $conditions = [];
            $this->paginate=['limit'=>10,"conditions"=>$conditions];

            $results = $this->paginate($this->Contents)->toArray();         
            
            $this->set(compact('results'));
            $this->set('_serialize', ['results']);
        }

        public function save($id = NULL) {
            $this->loadModel('Contents');
            if (!empty($id)) {
                $record = $this->Contents->get($id);                
            }
            else{
                $record = $this->Contents->newEntity();                
            }

            if (!empty($this->request->data)) {
                $record = $this->Contents->patchEntity($record,$this->request->getData());

                if($this->Contents->save($record)){
                    $this->Flash->success(__('Data saved successfully.'));
                    return $this->redirect(['action' => 'index']);
                }

                $this->Flash->error(__('Data was NOT saved successfully'));
            }

            $this->set(compact('record'));
            $this->set('_serialize', ['record']);           
        }

        public function view($id = null) {            
            $this->loadModel("Contents");
            $content = $this->Contents->get($id);
            if (empty($content)) {
                $this->Flash->error(__('Content details not found.'));
                return $this->redirect(['action' => 'index']);
            }
           
            $this->set(compact('content'));
        }
        
        public function delete($id = NULL){
            if(!empty($id)){
                $this->loadModel("Content");
                if($this->Content->deleteDocumentById($id)){
                    $this->Flash->success(__('Content details have been deleted successfully'));
                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('Content details were NOT deleted successfully'));
            return $this->redirect(['action' => 'index']);
        }

    }
    