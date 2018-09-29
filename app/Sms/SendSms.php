<?php

namespace App\Sms;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSms
{
    use Queueable, SerializesModels;

   
    public function __construct()
    {
        
    }

    public static function send($client_num, $message){
        $isError = 0;
        $errorMessage = true;

        //Preparing post parameters
        $mobile_num = implode($client_num,',');     
        $message = utf8_encode($message);
        $url = config('sms.bulksms.url');
        
        // http://sms.bulksmsserviceproviders.com/api/send_http.php?authkey=c58b117177592b0a0e61e627b565504d&mobiles=9161717401&message=Hii&sender=BLKSMS&route=B&unicode=1&response=json
        $postData = array(
            'authkey' => config('sms.bulksms.apikey'),
            'sender' => config('sms.bulksms.sender'), 
            'mobiles' => $mobile_num,
            'message' => $message,
            'route' => 'B',
            'unicode' => '1',
            'response' => 'json'
        );
        
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
        ));


        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


        //get response
        $output = curl_exec($ch);
        //echo $output;

        //Print error if any
        if (curl_errno($ch)) {
            $isError = true;
            $errorMessage = curl_error($ch);
        }
       
        curl_close($ch);

        // return $output;
//dd($errorMessage);
        if($isError){
            return array('error' => 1 , 'message' => $errorMessage);
        }else{
            return array('error' => 0 , 'output' => json_decode($output));
        }

    }
}
