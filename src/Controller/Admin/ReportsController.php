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
    class ReportsController extends AppController {

        public function beforeFilter(\Cake\Event\Event $event) {
            parent::beforeFilter($event); 
            $this->loadModel('Requests');
        }

        /**
         * Index method
         *
         * @return \Cake\Http\Response|null
         */
        public function requestexport() {       
            $requests = $this->Requests->find('all',['contain'=>['UsersFrom','UsersTo']])->toArray();         
            $this->set(compact('requests'));
            
        }

        
    }
    