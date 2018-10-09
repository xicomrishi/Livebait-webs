<?php

    namespace App\Controller\Admin;

    use App\Controller\AppController;

    class ReportSpamsController extends AppController {

        public function beforeFilter(\Cake\Event\Event $event) {
            parent::beforeFilter($event);
            // $this->loadComponent('Common');
        }

        public function index() {
            $conditions = [];
            $this->paginate=['limit'=>20,"conditions"=>$conditions,'contain'=>['FromUser','ToUser']];

            $results = $this->paginate($this->ReportSpams)->toArray();         
            
            $this->set(compact('results'));
            $this->set('_serialize', ['results']);
        }

       
        
    }
    