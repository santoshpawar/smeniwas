<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/6/2015
 * Time: 4:11 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Validator;
use Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Models\Loan\Loan;
use Illuminate\Support\Facades\Redirect;
use App\Helpers\FormatHelper;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Common\ConfigurableParameter;
use Auth;

class StaticPageController extends Controller {

    protected $postContectUsForm = [
        'name' => 'required',
        'email' => 'required|email',
        'mobile' => 'required',
        'subject' => 'required',
        'message' => 'required|min:50',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //$this->middleware('guest');
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function wwr() {
        $subViewType = 'static_views.wwr';
        return view('static_views.createedit', compact('subViewType'));
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function whyUs() {
        $subViewType = 'static_views.whyus';
        return view('static_views.createedit', compact('subViewType'));
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function keymgmt() {
        $subViewType = 'static_views.our_team';
        return view('static_views.createedit', compact('subViewType'));
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function teammembers() {
        $subViewType = 'static_views.team_members';
        return view('static_views.createedit', compact('subViewType'));
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function howToApply() {
        $subViewType = 'static_views.how_to_apply';
        return view('static_views.createedit', compact('subViewType'));
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function infoRequired() {
        $subViewType = 'static_views.info_required';
        return view('static_views.createedit', compact('subViewType'));
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function docRequired() {
        $subViewType = 'static_views.doc_required';
        return view('static_views.createedit', compact('subViewType'));
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function contactUs() {
        $subViewType = 'static_views.contactus';
        $formaction = 'StaticPageController@postContactUs';
        return view('static_views.createedit', compact('subViewType', 'formaction'));
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function trackApplication() {
        $subViewType = 'static_views.track_application';
        $formaction = 'StaticPageController@postTrackApplication';
        return view('static_views.createedit', compact('subViewType', 'formaction'));
    }

    public function postContactUs(Request $request) {
        $input = Input::all();
        $validation = $this->validate($request, $this->postContectUsForm);


        $fromEmail = Input::get('email');
        $fromName = Input::get('name');
        $subject = Input::get('subject');
        $Data = Input::get('message');
        $mobile = Input::get('mobile');
        $toEmail = 'contact@smeniwas.com'; // 'mkwebsite@mailinator.com';
        $toName = 'smeniwas';

        Mail::send('emails.contactus', ['fromEmail' => $fromEmail, 'fromName' => $fromName, 'Data' => $Data, 'mobile' => $mobile], function($message) use ($toEmail, $fromName, $subject) {
            $message->to($toEmail, $fromName)->subject($subject);
        });
        session()->flash('flash_message', 'Your message was successfully sent!');
        return Redirect::back()->with('message', 'Your message was successfully sent!');
    }

    public function postTrackApplication(Request $request) {
        $input = Input::all();
//        dd($input);
        $loanId = $input['loan_id'];
        $loan = Loan::find($loanId);
        if (isset($loan) && count($loan) > 0) {
            $user = User::find($loan->user_id);
            if (Auth::guest()) {
                $statusValue = FormatHelper::formatStatusType($loan->status);
//            dd($statusValue);
                $this->sendMail('emails.loanstatus', array('loanID' => $loanId, 'loanStatus' => $statusValue), $user->email, 'Loan Status From SMENiwas!');

                $confParam = new ConfigurableParameter();
                $message = $confParam->getParamValueOrDefault('template', 'Track Application');
                $message = $message . ' SMENiwas Loan # -' . $loanId . ' Status is - ' . $statusValue;
//                dd($message);
                if (isset($user)) {
                    $userProfile = $user->userProfile();
                    if (isset($userProfile) && isset($userProfile->contact1)) {
                        $mobileNumber = $userProfile->contact1;
                        $this->sendSMS($mobileNumber, $message);
                    }
                }

                session()->flash('flash_message', 'An Email and SMS of the loan status has been send to the registered user successfully!');
                $redirectPath = 'application_process/track_application';
                return Redirect::to($redirectPath);
            } else {
                if (Auth::user()->id == $loan->user_id) {
                    $statusValue = FormatHelper::formatStatusType($loan->status);
                    $this->sendMail('emails.loanstatus', array('loanID' => $loanId, 'loanStatus' => $statusValue), $user->email, 'Loan Status From SMENiwas!');

                    $confParam = new ConfigurableParameter();
                    $message = $confParam->getParamValueOrDefault('template', 'Track Application');
                    $message = $message . ' SMENiwas Loan # -' . $loanId . ' Status is - ' . $statusValue;
                    if (isset($user)) {
                        $userProfile = $user->userProfile();
                        if (isset($userProfile) && isset($userProfile->contact1)) {
                            $mobileNumber = $userProfile->contact1;
                            $this->sendSMS($mobileNumber, $message);
                        }
                    }

                    session()->flash('flash_message', 'An Email and SMS of the loan status has been send to the registered user successfully!');
                    $redirectPath = 'application_process/track_application';
                    return Redirect::to($redirectPath);
                } else {
                    return Redirect::back()->withErrors('You do not have permissions to view status for this loan ID.');
                }
            }
        } else {
            return Redirect::back()->withErrors('Invalid Loan ID.');
        }
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function loanproducts() {
        $subViewType = 'static_views.loan_products';
        return view('static_views.createedit', compact('subViewType'));
    }

   /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function successStories() {
        $subViewType = 'static_views.successStories';
 
        return view('static_views.createedit', compact('subViewType'));
    }

}
