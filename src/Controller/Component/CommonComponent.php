<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;

/**
 * Common component
 */
class CommonComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    
    public function androidNotification($data,$deviceToken , $user_id = null){
        if($user_id)
        {
            $tbl = TableRegistry::get('UserSettings');
            $user = $tbl->find('all',['conditions'=>['user_id'=>$user_id],'fields'=>['push_notifications']])->last();
            if($user['push_notifications'] == 1)
            {
                $push = 1;
            }
            else
            {
                $push = 2;
            }
        }
        else
        {
            $push = 1;
        }
        if($push = 1)
        {
            $url = 'https://fcm.googleapis.com/fcm/send';
                
            $fields = ['to' => $deviceToken,'data'=>$data];
      
            $headers = array(
            'Authorization: key=AAAAFLE5Fwo:APA91bH8oVC2uS3gyoGVSLLMExyyzNdTjcg3fW3opJuFjn8y-gQqY1S61WRsBBzN_c6zhvobUlAFauWf3YNJZL12Y2LerqgLFgYKW9zJazfjfEhM3qz7TVDQVBMjVHGQZciHKC-2sFyu',
            'Content-Type: application/json'
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);                               
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                               
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);     

            curl_close($ch);

            if ($result === FALSE) {
                return false;
            }
            else{
                return true;
            }
        }
        else
        {
            return "disabled";
        }
    }

   public function iosNotification($data , $token, $user_id = null){

        if($user_id)
        {
            $tbl = TableRegistry::get('UserSettings');
            $user = $tbl->UserSettings('all',['conditions'=>['user_id'=>$user_id],'fields'=>['push_notifications']])->last();
            if($user['push_notifications'] == 1)
            {
                $push = 1;
            }
            else
            {
                $push = 2;
            }
        }
        else
        {
            $push = 1;
        }
        if($push = 1)
        {

            $env = 'development';
            
            if($env == 'production')
            {
                $tHost = PRO_PUSH_HOST;
                $tPort = PRO_PUSH_PORT;
                $tCert = WWW_ROOT . 'pem/armini_final.pem';
                
            }
            else 
            {
                $tHost = DEV_PUSH_HOST;
                $tPort = DEV_PUSH_PORT;
                $tCert = WWW_ROOT . 'pem/CertificatesP12.pem';
            }
            
            $passphrase = "Livebait";
            if(!empty($token))
            {       
                
                $tPassphrase = 'Livebait';
                // Audible Notification Option.
                $tSound = 'default';
                // Create the message content that is to be sent to the device.
                $tBody['aps'] = array (
                'alert' => $data['message'],
                'badge' => 1,
                'sound' => $tSound,
                'data' => $data,
                );
                //$tBody ['payload'] = $tPayload;
                // Encode the body to JSON.
                $tBody = json_encode ($tBody);
                //$this->log('Ios Push notification : '.$tBody);
                // Create the Socket Stream.
                $tContext = stream_context_create ();
                stream_context_set_option ($tContext, 'ssl', 'local_cert', $tCert);
                // Remove this line if you would like to enter the Private Key Passphrase manually.
                stream_context_set_option ($tContext, 'ssl', 'passphrase', $tPassphrase);
                // Open the Connection to the APNS Server.
                $tSocket = stream_socket_client ('ssl://'.$tHost.':'.$tPort, $error, $errstr, 30, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $tContext);
                // Check if we were able to open a socket.
                //echo $tSocket;exit;
                if (!$tSocket)
                 $retmsg = "APNS Connection Failed: $error $errstr" . PHP_EOL;
                // Build the Binary Notification.
                else
                    
                $tMsg = chr (0) . chr (0) . chr (32) . pack ('H*', $token) . pack ('n', strlen ($tBody)) . $tBody;
                // Send the Notification to the Server.
                $tResult = fwrite ($tSocket, $tMsg, strlen ($tMsg));
                if ($tResult)
                $retmsg = true;
                else
                $retmsg = false;
                // Close the Connection to the Server.
                fclose ($tSocket);
                        
            } 
            
            return $retmsg; 


        
    }
    else
        {
            return "disabled";
        }
    
}

}
