<?php

namespace App\Helpers;

use Log;

class SMS {
    //Ensure php_curl.dll extension is enabled
    public static function send($toMobileNumber, $message){
        $smsURLPrefix = env('SMS_URL_PREFIX');
        $isSMSEnabled = env('SMS_ENABLED');
        if($isSMSEnabled != 1){
            return;
        }

        $fullSMSURL = $smsURLPrefix."&to=".$toMobileNumber."&message=".urlencode($message);
        $ch = curl_init();

        curl_setopt($ch,CURLOPT_URL,$fullSMSURL);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $output=curl_exec($ch);
        curl_close($ch);

        Log::info("Sending SMS",[$fullSMSURL, $output]);
    }
}