<?php
namespace App\Controller\Admin;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Routing\Router;
/**
 * Admins Controller
 *
 * @property \App\Model\Table\AdminsTable $Admins
 *
 * @method \App\Model\Entity\Admin[] paginate($object = null, array $settings = [])
 */
class AdminsController extends AppController
{

    public function beforeFilter(Event $event) {
            parent::beforeFilter($event);
            $this->Auth->allow(["login", "save"]);
        }

        /**
         * Index method
         *
         * @return \Cake\Http\Response|null
         */
        public function dashboard() {

            $admins = $this->paginate($this->Admins);

            $this->set(compact('admins'));
            $this->set('_serialize', ['admins']);
        }

        public function index() {
            $users = $this->paginate($this->Admins);
            
            $this->set(compact('users'));
            $this->set('_serialize', ['users']);
        }

        /**
         * View method
         *
         * @param string|null $id Admin id.
         * @return \Cake\Http\Response|null
         * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
         */
        public function view($id = null) {
            $admin = $this->Admins->get($id, [
                'contain' => []
            ]);

            $this->set('admin', $admin);
            $this->set('_serialize', ['admin']);
        }

        /**
         * Save method
         *
         * @return \Cake\Http\Response|null Redirects on successful save, renders view otherwise.
         */
        public function save($id = NULL) {
            if (!empty($id)) {
                $record = $this->Admins->find()->where(["id" => $id])->first();
                if(!empty($record->image)){
                    $imageSrc=Router::url('/',true)."uploads/admin/".$record->image;
                    $this->set(compact("imageSrc"));
                }
            } else {
                $record = $this->Admins->newEntity();
            }

            if (!empty($this->request->data)) {
                $data=$this->request->getData();
                
                if(!empty($data['image']['name'])){
                     $this->loadComponent("Image");
                    $dir_path="uploads/admin";
                    $image=$this->Image->uploadImage($data['image'],$dir_path);
                    if($image){
                        $data['image']=$image;
                    }
                }
                else{
                    if(!empty($id)){
                        $data['image'] = $record->image;
                    }
                    else{
                        $data['image']="";
                    }                    
                }
                
                if(!empty($id) && empty($data['password'])){
                    unset($data['password']);
                }

                $record = $this->Admins->patchEntity($record, $data);

                if ($this->Admins->save($record)) {
                    $this->Flash->success(__('Details saved successfully'));
                    return $this->redirect(['action' => 'index']);
                }                                
                
                $this->Flash->error(__('Details was not saved successfully'));
            }
            $this->set(compact('record'));
            $this->set('_serialize', ['record']);
        }

        /**
         * Delete method
         *
         * @param string|null $id Admin id.
         * @return \Cake\Http\Response|null Redirects to index.
         * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
         */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $admin = array();
        $admin = $this->Admins->get($id);
        $admin['deleted'] = DELETED;
        if (!empty($admin)) {
            $this->Admins->save($admin);
            $this->Flash->success(__('The admin has been deleted.'));
        } else {
            $this->Flash->error(__('The admin could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

        /**
         * Login method
         * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
         */
    public function login() {   
        $this->viewBuilder()->setLayout(ADMIN_LOGIN_LAYOUT);     
        if ($this->request->is('post')) {
            $admin = $this->Auth->identify();
            if ($admin) {
                // $admin["role_id"] = APP_USER_ADMIN;
                $this->Auth->setUser($admin);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid adminname or password, try again'));
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }
}
