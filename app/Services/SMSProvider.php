<?php 

namespace App\Services;

use Twilio\Rest\Client;

class SMSProvider {
    
    public function __construct() {
    }

    /**
     * Sends sms to user using Twilio's programmable sms client
     * @param String $message Body of sms
     * @param String $recipients string or array of phone number of recepient
     */

    private function send_message($message, $recipients){
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");

        $client = new Client($account_sid, $auth_token);
        $messanger = $client->messages->create($recipients, array('from'=> $twilio_number, 'body'=> $message));
        
        return $messanger->sid;
    }

    public function get_sms_provider($message, $recipients){
        $message = $this->send_message($message, $recipients);
        return $message;
    }
}