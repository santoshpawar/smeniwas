<?php


namespace App\Http\Controllers\Register;
//use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Address;
use App\Models\MasterData;
use App\Models\User;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Session;
//use Proengsoft\JsValidation\JsValidator;
use Illuminate\Support\Facades\Storage;
use Validator;
use JsValidator;
use Input;
use Mail;
use Auth;
use Illuminate\Auth\Passwords\DatabaseTokenRepository;
use DB;


class BrokerUserProfileController extends Controller {

    protected $indexValidationRules = [
        'username' => 'required|alpha_num|unique:users',
        'password' => 'required|alpha_num|confirmed|min:6',
        'email' => 'required|email|unique:users'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $formaction = 'Register\BrokerUserProfileController@postIndex';
        $subViewType = 'register.broker._form_broker_register';

        $user = Auth::user();
        $id = $user->id;
        $userProfile = $user->userProfile();
//        dd($user,$id);
        if(isset($user)) {
            $broker_name = $user->username;
            $broker_email = $user->email;
        }
        $validator = JsValidator::make($this->indexValidationRules);

        return view('register.broker.createedit', compact('formaction', 'subViewType', 'validator','userProfile','broker_name','broker_email'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function postIndex(Request $request)
    {
        $input = Input::all();
        $user = Auth::user();
        $id = $user->id;
//        dd($input,$id);

        $input = $request->all();
        User::updateOrCreate(array('id' => $id),['username' => $input['broker_name'], 'email' => $input['broker_email']]);

        session()->flash('flash_message','User Details were successfully saved!');

        $redirectPath = 'register/broker';
        return Redirect::to($redirectPath)->withInput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function getBrokerDetails(Request $request)
    {
        //Proceed ahead to the next page if the user is already created
        if($this->checkAccess(('register/broker/broker-details'))){
            return Redirect::to('auth/login');
        }
        $states = MasterData::states();
        $chosenState = null;

        $formaction = 'Register\BrokerUserProfileController@postBrokerDetails';
        $subViewType = 'register.broker._form_broker_details';
        return view('register.broker.createedit', compact('formaction', 'subViewType','states','chosenState'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function postBrokerDetails(Request $request)
    {

        $rules = array(
            'name' => 'required',
            'registration_no'=>'required',
            'mobile'=>'required',
            'website'=>'required',
            'std_code'=>'required',
            'landline'=>'required',
            'registeredAddress.address1' => 'required',
            'registeredAddress.address2' => 'required',
            'registeredAddress.city' => 'required',
            'registeredAddress.state' => 'required',
            'registeredAddress.pincode' => 'required',
        );

        $this->validate($request, $rules);
        $input = $request->all();
        $user = Auth::user();
        $userProfile = UserProfile::updateOrCreate(array('user_id' => $user->id), $input);
        if (isset($userProfile)) {
            $registeredAddress = Address::updateOrCreate(array('id' => $userProfile->registered_address_id), $input['registeredAddress']);
            $userProfile->registeredAddress()->associate($registeredAddress);
        }
        $userProfile->save();
        return Redirect::to('register/broker/management-details ')->withInput();


    }
    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function getManagementDetails(Request $request){

        if($this->checkAccess(('register/broker/management-details'))){
            return Redirect::to('auth/login');
        }
        $formaction = 'Register\BrokerUserProfileController@postManagementDetails';
        $subViewType = 'register.broker._form_broker_management_details';

        return view('register.broker.createedit', compact('formaction', 'subViewType'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function postManagementDetails(Request $request){
        $rules = array(
            'owner_name' => 'required',
            'owner_email' => 'required|email',
            'owner_pan' => 'required',
            'owner_mobile' => 'required',
            'owner_std_code' => 'required',
            'owner_landline' => 'required',
        );
        $input = Input::all();
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $input = $request->all();
        $user = Auth::user();
        $userProfile = UserProfile::updateOrCreate(array('user_id' => $user->id), $input);
        $userProfile->save();
        return Redirect::to('home');
    }

    private function checkAccess($redirectUrl){

        if (Auth::guest()) {
            Session::put('url.intended', $redirectUrl);
            return true;
        }else {
            return false;
        }
    }

    protected function generateToken($user){
        $connection = DB::connection();

        $table = 'password_resets';

        $key = Config::get('app.key');

        $expire = 60;

        $dbRepository = new DatabaseTokenRepository($connection, $table, $key, $expire);
        return $dbRepository->create($user);
    }
}