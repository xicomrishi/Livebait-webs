<?php

    namespace App\Controller\Admin;

    use App\Controller\AppController;

    class PaymentsController extends AppController {

        public function beforeFilter(\Cake\Event\Event $event) {
            parent::beforeFilter($event);
            // $this->loadComponent('Common');
        }

        public function index() {
            $conditions = [];
            $conditions=[];  
            $search = $this->request->query;
            if($search){                
                if(!empty($search['date_from'])){ 
                    $date_from = date('Y-m-d',strtotime($search['date_from']));                   
                    $conditions[] = "LEFT(Payments.created,10) >= '".$date_from."'";
                }
                if(!empty($search['date_to'])){
                    $date_to = date('Y-m-d',strtotime($search['date_to']));                   
                    $conditions[] = "LEFT(Payments.created,10) <= '".$date_to."'";
                }
            }

            $this->paginate=['limit'=>20,"conditions"=>$conditions,'contain'=>['Plans','Users']];

            $results = $this->paginate($this->Payments)->toArray();         
            
            $this->set(compact('results','search'));
            $this->set('_serialize', ['results']);
        }

       
        
    }
    