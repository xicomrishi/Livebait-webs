<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize(){
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        switch (@$this->request->params["prefix"]) {            
            case "admin":            
                $this->loadComponent('Auth', [
                    'loginAction' => [
                        'controller' => 'Admins',
                        'action' => 'login',
                        'prefix' => "admin"
                    ],
                    'loginRedirect' => [
                        'controller' => 'Pages',
                        'action' => 'dashboard',
                        'prefix' => "admin"
                    ],
                    'logoutRedirect' => [
                        'controller' => 'Admins',
                        'action' => 'login',
                        'prefix' => "admin"
                    ],
                    'authenticate' => [
                        'Form' => [
                            'userModel' => 'Admins', //your Model Name
                            'fields' => [
                                'username' => 'email',
                                'password' => 'password'
                            ],
                        ]
                    ]
                ]);

                $this->set('user', $this->Auth->user());
                break;
            case "api":
                
                break;
            default:
                $this->loadComponent('Auth', [
                    'loginAction' => [
                        'controller' => 'Vendors',
                        'action' => 'login',
                        'prefix' => false
                    ],
                    'loginRedirect' => [
                        'controller' => 'Vendors',
                        'action' => 'dashboard',
                        'prefix' => false
                    ],
                    'logoutRedirect' => [
                        'controller' => 'Vendors',
                        'action' => 'login',
                        'prefix' => false
                    ],
                    'authenticate' => [
                        'Form' => [
                            'userModel' => 'Vendors', //your Model Name
                            'fields' => [
                                'username' => 'username',
                                'password' => 'password'
                            ],
                        ]
                    ]
                ]);
            $this->set('user', $this->Auth->user());
        }
        
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $layout="";
        switch (@$this->request->params["prefix"]){
            case "admin":
             $layout=ADMIN_LAYOUT;
            break;
            case "api":
                $layout = false;
                $timestamp = $this->request->header('timestamp'); 
                $token = $this->request->header('token'); 
                $developer = $this->request->header('developer');  

                if(!empty($timestamp)){                    
                    $hash = sha1($timestamp);
                }
                else{
                    $hash = "";
                }
                if($developer==1){$hash=1;}
                else{
                if(empty($token) || $token != $hash){
                    $this->response->type('json');
                    echo json_encode(["status" => false, "message" => "Unauthorized Request. Error: Invalid Token : $hash"]);
                    $this->response->send();                        
                    exit;
                }
                $loginToken=$this->request->header('loginToken');                
               
                $action=$this->request->param('action');
                $permissionFreeActions = ['signup'];

                if(!empty($loginToken)){    
                    $this->loadModel('Users');                    
                    $user = $this->Users->find('all',['conditions'=>['loginToken'=>$loginToken]])->first();                    
                    if($action == 'logout')
                    {
                        //return true;
                    }
                    else if(empty($user)){                        
                        $this->response->type('json');
                        echo json_encode(["status" => false, "message" => "Your login session has been expired."]);
                        $this->response->send();                        
                        exit;                    
                    }
                    else{
                        $this->reset_calls($user['id']);
                        $this->request->session()->write('AppUser',$user);

                    }
                }
                elseif(!in_array($action, $permissionFreeActions)){                    
                    $this->response->type('json');
                    echo json_encode(["status" => false, "message" => "Your login session has been expired."]);
                    $this->response->send();                        
                    exit;
                }
            }
                break;
        }
        $this->viewBuilder()->setLayout($layout);
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Http\Response|null|void
     */
    // public function beforeRender(Event $event)
    // {
    //     // Note: These defaults are just to get started quickly with development
    //     // and should not be used in production. You should instead set "_serialize"
    //     // in each action as required.
    //     if (!array_key_exists('_serialize', $this->viewVars) &&
    //         in_array($this->response->type(), ['application/json', 'application/xml'])
    //     ) {
    //         $this->set('_serialize', true);
    //     }
    // }


    public function reset_calls($user_id)
    {
        if($user_id)
        {
            $user = $this->Users->get($user_id);
            
            if($user['timezone'])
            {
                date_default_timezone_set($user['timezone']);
            }
            $getdate = date('Y-m-d') ;  
            if($user['last_reset_call'])
            {
            if($user['last_reset_call']->format('Y-m-d') != $getdate)
            {
                $user['unpaid_calls'] = 3;
                $user['last_reset_call'] = $getdate;
                $this->Users->save($user);
            }
            }
            date_default_timezone_set('UTC');
        }
    }
}
