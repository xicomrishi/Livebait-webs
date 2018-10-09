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
    class PagesController extends AppController {

        public function beforeFilter(\Cake\Event\Event $event) {
            parent::beforeFilter($event);            
        }

        /**
         * Index method
         *
         * @return \Cake\Http\Response|null
         */
        public function dashboard() {       
            $this->loadModel('Users');
            $totalUsers = $this->Users->find('all')->count();
            $todayUsers = $this->Users->find('all',['conditions'=>['created <=' => date("Y-m-d 23:59:59"),'created >='=>date("Y-m-d 00:00:00")]])->count();

            $this->loadModel('Requests');
            $totalRequests = $this->Requests->find('all')->count();
            $todayRequests = $this->Requests->find('all',['conditions'=>['created <=' => date("Y-m-d 23:59:59"),'created >='=>date("Y-m-d 00:00:00")]])->count();

            $this->set(compact('totalUsers','todayUsers','totalRequests','todayRequests'));
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
    