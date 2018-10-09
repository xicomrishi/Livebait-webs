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
    class UsersController extends AppController {

        // public function initialize()
        // {
        //     parent::initialize();
        //     $this->loadHelper('Common');
        // }

        public function beforeFilter(\Cake\Event\Event $event) {
            parent::beforeFilter($event);            
            $this->loadModel("Users");            
            $this->viewBuilder()->helpers(['Common']);
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
                if(!empty($search['keyword'])){                    
                    $conditions['OR'] = ["username like  '%" .$search['keyword'] . "%'","email like  '%" .$search['keyword'] . "%'","phone_number like  '%" .$search['keyword'] . "%'"];
                }
                if(!empty($search['age_from'])){                    
                    $conditions['age >= '] = $search['age_from'] ;
                }
                if(!empty($search['age_to'])){                    
                    $conditions['age <= '] = $search['age_to'] ;
                }
                if(!empty($search['gender'])){                    
                    $conditions['sex'] = $search['gender'] ;
                }
               }
            
            
            $this->paginate=['limit'=>10,"conditions"=>$conditions,'contain'=>[],'order'=>['id'=>'DESC']];

            $users = $this->paginate($this->Users)->toArray();            
            
            $this->set(compact('users','search'));
            $this->set('_serialize', ['users']);
        }

        /**
         * View method
         *
         * @param string|null $id User id.
         * @return \Cake\Http\Response|null
         * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
         */
        public function view($id = null) {            
            $user = $this->Users->get($id,['contain'=>['UserImages']]);

            $this->set('user', $user);
            $this->set('_serialize', ['user']);
        }

        /**
         * Add method
         *
         * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
         */
        public function save($id = NULL) {            
            $this->loadComponent("Image");
            if(!empty($id)){
                $record = $this->Users->find()->where(["id" => $id])->first();                
                if(!empty($record->image)){
                    $imageSrc=Router::url('/',true)."uploads/users/".$record->image;
                    $this->set(compact("imageSrc"));
                }                
            }else{
                $record = $this->Users->newEntity();
            }

            if (!empty($this->request->data)) {
                $data = $this->request->getData();
                if(!empty($id) && empty($data['password'])){
                    unset($data['password']);
                }

                if(!empty($data['image']['name'])){
                    $dir_path="uploads/users";
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

                $record = $this->Users->patchEntity($record, $data);                
                
                if ($this->Users->save($record)) {
                    $this->Flash->success(__('User details have been saved successfully'));
                    return $this->redirect(['action' => 'index']);                
                }
                
                $this->Flash->error(__('User details was NOT saved successfully'));
            }

            $this->set(compact('record'));
            $this->set('_serialize', ['record']);
        }

        /**
         * Delete method
         *
         * @param string|null $id User id.
         * @return \Cake\Http\Response|null Redirects to index.
         * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
         */
        public function delete($id = null) {
            $this->loadModel("Users");
            $this->request->allowMethod(['post', 'delete']);
            $user = $this->Users->get($id);
            if ($this->Users->delete($user)) {
                $this->Flash->success(__('User has been deleted.'));
            } else {
                $this->Flash->error(__('User could not be deleted. Please, try again.'));
            }

            return $this->redirect(['action' => 'index']);
        }

        public function changeStatus($id=null){
            if(!empty($id)){
                $user = $this->Users->get($id);
                if($user->status==1){
                    $user->status=0;
                }
                else{
                    $user->status=1;
                }

                if($this->Users->save($user)){
                    $this->Flash->success(__('User status changes successfully.'));
                }
                else{
                    $this->Flash->error(__('User status could not be changed. Please, try again.'));
                }
            }
            else{
                $this->Flash->error(__('Invalid request. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }

        public function request($id=null){
            if(!empty($id)){
                $this->loadModel('Requests');

                $this->paginate=['limit'=>10,"conditions"=>['from_user_id'=>$id],'contain'=>['UsersFrom','UsersTo']];
                $requests = $this->paginate($this->Requests)->toArray(); 

                $this->set(compact('requests'));
            }
            else{
                $this->Flash->error(__('Details not found.'));
                return $this->redirect(['action' => 'index']);
            }            
        }
    }
    