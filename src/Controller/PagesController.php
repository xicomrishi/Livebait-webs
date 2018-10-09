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

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{

     public function initialize(){
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Common');
        $this->Auth->allow();

    }
    /**
     * Displays a view
     *
     * @param array ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Network\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function display(...$path)
    {
        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }

    // Status Update Notification Api for Apple
    public function updateIOSSubscription()
    {
        $this->autoRender = false;
        
        $this->loadModel('Users');
        $this->loadModel('Subscriptions');
        
        if($this->request->data)
        {
            $data = $this->request->data['latest_receipt_info'];
            $data['txn_id'] = $data['original_transaction_id'];
            $s = $this->Subscriptions->find('all',['conditions'=>['txn_id'=>$data['original_transaction_id']]])->last();
            $sub = $this->Subscriptions->get($s['id']);
            unset($this->request->data['latest_receipt']);
            $data['apidata'] = json_encode($this->request->data);
            $data['app_status'] = $this->request->data['notification_type'];
            if($data['app_status'] == 'CANCEL')
            {
                $data['status'] = '0';
            }
            else
            {
                $data['status'] = '1';
            }
            $sub = $this->Subscriptions->patchEntity($sub,$data);    
            if($this->Subscriptions->save($sub))
            {
                if($data['app_status'] == 'CANCEL')
                {
                    $this->loadModel('Users');

                    $userObjData = $this->Users->get($s['user_id']);
                    $userObjData->subscribed      = '0';
                    $this->Users->save($userObjData);
                    echo "success";
                }
                
            }
            else
            {
                echo "error";
            }
        }
        else
        {
            echo "Invalid Request.";
        }
    }

    // Android Check subscription status 
    public function updateAndroidSubscription()
    {
        $this->autoRender = false;
        
        $this->loadModel('Users');
        $this->loadModel('Subscriptions');
        
        if($this->request->data)
        {
            $data = $this->request->data['latest_receipt_info'];
            $data['txn_id'] = $data['original_transaction_id'];
            $s = $this->Subscriptions->find('all',['conditions'=>['txn_id'=>$data['original_transaction_id']]])->last();
            $sub = $this->Subscriptions->get($s['id']);
            unset($this->request->data['latest_receipt']);
            $data['apidata'] = json_encode($this->request->data);
            $data['app_status'] = $this->request->data['notification_type'];
            if($data['app_status'] == 'CANCEL')
            {
                $data['status'] = '0';
            }
            else
            {
                $data['status'] = '1';
            }
            $sub = $this->Subscriptions->patchEntity($sub,$data);    
            if($this->Subscriptions->save($sub))
            {
                if($data['app_status'] == 'CANCEL')
                {
                    $this->loadModel('Users');

                    $userObjData = $this->Users->get($s['user_id']);
                    $userObjData->subscribed      = 0;
                    $this->Users->save($userObjData);
                    echo "success";
                }
                
            }
            else
            {
                echo "error";
            }
        }
    }

    // Cron To Delete notintrested after 5 min 
    public function deletenotintrested()
    {
        Configure::write('debug',2);
        $this->autoRender = false;
        $this->loadModel('UserNotInteresteds');
        $notin = $this->UserNotInteresteds->deleteAll(['created < now() + INTERVAL 5 MINUTE']);
    }


    public function checkNearbyusers()
    {
        $this->autoRender = false;
        $this->loadModel('Locations');
        $this->loadModel('Users');
        $users = $this->Users->find('all',['contain'=>['UserSettings']])->toArray();
        //print "<pre>";print_r($users);exit;
        foreach($users as $data)
        {
            $miles = $data['user_setting']['distance'];
            if(!$miles)
            {
                $miles = 5;
            }
            //echo $miles;
            $getnearbyusers = $this->Users->find('all',['fields'=>['distance'=>'( 3959 * acos( cos( radians('.$data["lat"].') ) * cos( radians( lat ) ) * cos( radians(lon) - radians('.$data["lon"].')) + sin(radians('.$data["lat"].')) * sin( radians(lat))))','id'],'conditions'=>['( 3959 * acos( cos( radians('.$data["lat"].') ) * cos( radians( lat ) ) * cos( radians(lon) - radians('.$data["lon"].')) + sin(radians('.$data["lat"].')) * sin( radians(lat)))) <= '=>$miles,'id != '=> $data['id']]])->count();
            ///echo $getnearbyusers.'/';
            if($getnearbyusers > 20)
            {
                    $pushdata['type'] = 99;
                    $pushdata['message'] = "Hey there is 20 people live now. Come and join the Fun!!";
                    if($data->deviceType == "A"){                        
                        echo $check = $this->Common->androidNotification($pushdata,$data->deviceToken , $data->id);
                    }
                    else{
                        echo $check = $this->Common->iosNotification($pushdata,$data->deviceToken, $data->id);
                    }
            }
        }

    }

    // cron to set calls daily at 12:01 AM
    public function refreshCalls()
    {   
        $this->autoRender = false;
        $this->loadModel('Users');
        $user = $this->Users->find('all')->toArray();
        foreach($user as $u)
        {
            $us = $this->Users->get($u->id);
            $us->unpaid_calls = 3;
            $this->Users->save($us);
        }
    }


}
