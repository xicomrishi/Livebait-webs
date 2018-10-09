<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;

/**
 * Email component
 */
class EmailComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    
    public function send($params = NULL){
        if(!EMAILS_ENABLED || empty($params["to"]) || empty($params["subject"]) || empty($params["from"]) || empty($params["message"])){
            return false;
        }
        $email = new Email();
        $email->setTransport("default");
        $email->setEmailFormat('html');
        $email->setFrom(EMAIL_FROM, EMAIL_FROM_NAME);
        $email->setTo($params["to"]);
        $email->setSubject($params["subject"]);
        if($email->send($params["message"])){
            return true;
        }
        return false;
    }
    
}
