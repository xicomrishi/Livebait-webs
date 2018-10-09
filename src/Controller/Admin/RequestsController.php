<?php

    namespace App\Controller\Admin;

    use App\Controller\AppController;

    use Cake\Routing\Router;

    /**
     * Users Controller
     *
     * @property \App\Model\Table\AdminUsersTable $AdminUsers
     *
     * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
     */
    class RequestsController extends AppController {

        public function beforeFilter(\Cake\Event\Event $event) {
            parent::beforeFilter($event);            
        }

        /**
         * Index method
         *
         * @return \Cake\Http\Response|null
         */
        public function index() {       
            $conditions=[];  
            $search = $this->request->query;
            if($search){                
                if(!empty($search['date_from'])){ 
                    $date_from = date('Y-m-d',strtotime($search['date_from']));                   
                    $conditions[] = "LEFT(Requests.created,10) >= '".$date_from."'";
                }
                if(!empty($search['date_to'])){
                    $date_to = date('Y-m-d',strtotime($search['date_to']));                   
                    $conditions[] = "LEFT(Requests.created,10) <= '".$date_to."'";
                }
            }
           // print_r($conditions);exit;
            $this->paginate=['limit'=>10,"conditions"=>$conditions,'contain'=>['UsersFrom','UsersTo'],'order'=>['Requests.id'=>'DESC']];

            $requests = $this->paginate($this->Requests)->toArray();         
            
            $this->set(compact('requests','search'));
            $this->set('_serialize', ['requests']);
        }

        /**
         * View method
         *
         * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
         */
        public function view($id = NULL) {
            $request = $this->Requests->get($id,['contain'=>['UsersFrom','UsersTo']]);

            $this->set('request', $request);
            $this->set('_serialize', ['request']);
        }
    }
    