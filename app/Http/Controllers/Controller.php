<?php namespace App\Http\Controllers;

use App\Helpers\SMS;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Mail;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	protected function sendMail($view, $data, $receiverAddress, $subject = "SMENiwas", $receiverName=null){
        /*
		Mail::later(5, $view, $data, function ($m) use ($receiverAddress, $receiverName, $subject) {
			$m->to($receiverAddress, $receiverName)->subject($subject);
		});*/
        Mail::send($view, $data, function($message) use ($receiverAddress, $receiverName, $subject) {
            $message->to($receiverAddress, $receiverName)->subject($subject);
        });
	}

    protected function sendSMS($toMobileNumber, $message){
        if(isset($toMobileNumber) && isset($message)){
            SMS::send($toMobileNumber, $message);
        }
    }
}
