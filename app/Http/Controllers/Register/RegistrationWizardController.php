<?php namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;

use App\Models\Address;
use App\Models\Common\ConfigurableParameter;
use App\Models\MasterData;
use App\Models\User;

use App\Models\UserProfile;
use App\Models\Roles;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Auth\Passwords\DatabaseTokenRepository;

use Illuminate\Support\Facades\Session;
use Validator;
use JsValidator;
use Input;
use Mail;
use Auth;

class RegistrationWizardController extends Controller
{
  protected $ownerPageValidationRules = [
    'name_of_firm' => 'required',
    'firm_pan' => 'required|unique:users,username|Regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/',
    'owner_entity_type' => 'required',
    'owner_name' => 'required',
    'owner_email' => 'required|unique:users,email',
    'address' => 'required',
    'owner_city' => 'required',
    'owner_state' => 'required',
    'pincode' => 'required|numeric',
    'contact1' => 'required|numeric',
    //        'contact2' => 'required|numeric',
    'latest_turnover' => 'required|numeric',
    'owner_purpose_of_loan' => 'required',
    'required_amount' => 'required|numeric'
  ];

  protected $editOwnerPageValidationRules = [
    //'name_of_firm' => 'required',
    //'firm_pan' => 'required|Regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/',
    'owner_entity_type' => 'required',
    'owner_name' => 'required',
    //'owner_email' => 'required',
    'address' => 'required',
    'owner_city' => 'required',
    'owner_state' => 'required',
    'pincode' => 'required|numeric',
    'contact1' => 'required|numeric',
    //        'contact2' => 'required|numeric',
    'latest_turnover' => 'required|numeric',
    //        'owner_purpose_of_loan' => 'required',
    //        'required_amount' => 'required'
  ];

  protected $advisorSMEPageValidationRules = [
    'adv_name' => 'required',
    'adv_mobile' => 'required|numeric',
    'adv_email' => 'required|unique:users,email',
    'adv_pan' => 'required|unique:users,username|Regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/',

    'name_of_firm' => 'required',
    'firm_pan' => 'required|Regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/',
    'owner_entity_type' => 'required',
    'owner_name' => 'required',
    'owner_city' => 'required',
    'owner_email' => 'required|email',
    'address' => 'required',
    'owner_state' => 'required',
    'pincode' => 'required|numeric',
    'contact1' => 'required|numeric',
    //        'contact2' => 'required|numeric',
    'latest_turnover' => 'required|numeric',
    'owner_purpose_of_loan' => 'required',
    'required_amount' => 'required|numeric'
  ];

  protected $advisorPageValidationRules = [
    'adv_name' => 'required',
    'adv_mobile' => 'required|numeric',
    'adv_email' => 'required|unique:users,email',
    'adv_pan' => 'required|unique:users,username|Regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/'
  ];

  protected $editAdvisorPageValidationRules = [
    'adv_name' => 'required',
    'adv_mobile' => 'required|numeric',
    'adv_email' => 'required',
    'adv_pan' => 'required|Regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/'
  ];

  /**
  * Display a listing of the resource.
  *
  * @return Response
  */
  public function getIndex()
  {
    $formaction = 'Register\RegistrationWizardController@postIndex';
    $subViewType = 'register.wizard.index';

    $userProfile = null;

    $entityTypes = MasterData::entityTypes();
    $chosenEntity = null;

    $natureOfBusinessActivity = MasterData::natureOfBusinessActivity();
    $chosenEntityActivity = null;

    $bl_year = MasterData::BalanceSheet_FY();

    $cities = MasterData::cities();
    $chosenCity = null;

    $states = MasterData::states();
    $chosenState = null;
    $chosenOperatingState = null;

    $yesnotype = MasterData::yesNoTypes();
    $chosenYesNoType = null;

    $wizardusertype = MasterData::wizardUserType();
    $chosenWizardUserType = null;

    $purpose_of_loan = MasterData::endUseList();
    $chosenPurposeOfLoan = null;
    $validator = JsValidator::make($this->ownerPageValidationRules);

    $insurance_types = MasterData::insuranceProductType();
    $chosenInsuranceType = null;

    return view('register.wizard.index', compact('formaction','validator','userProfile','subViewType'
      ,'entityTypes','chosenEntity','bl_year','states','chosenState','chosenOperatingState','purpose_of_loan'
      ,'chosenPurposeOfLoan','yesnotype','natureOfBusinessActivity','chosenEntityActivity','chosenYesNoType','wizardusertype','chosenWizardUserType','cities','chosenCity','insurance_types','chosenInsuranceType'));
  }

  /**
  * Show the form for creating a new resource.
  * @param Request $request
  * @return Response
  */
  public function postIndex(Request $request)
  {
    $input = Input::all();

    $id = $input['id'];
    $data = null;

    $this->validate($request, $this->ownerPageValidationRules);
    $credentials = ['username' => $input['firm_pan'], 'email' => $input['owner_email'], 'password' => password_hash($input['password'], PASSWORD_DEFAULT) ];
    //            $user = Sentinel::registerAndActivate($credentials);
    $user = User::updateOrCreate(array('id' => $id), $credentials);

    $input['user_id'] = $user->id;
    $token = $this->generateToken($user);

    //            $role = Sentinel::findRoleBySlug(Config::get('constants.RL_SME'));
    $role = Roles::where('slug', '=', Config::get('constants.RL_SME'))->get()->first();
    $role->users()->attach($user);
    $user->push();
    $santosh='santosh.pawar@smeniwas.com';
    $this->sendMail('emails.saurabh', array('id' => $id,
      'user_id' => $input['user_id'],
      'name_of_firm' => $input['name_of_firm'],
      'owner_entity_type' =>$input['owner_entity_type'],
      'owner_name' =>$input['owner_name'],
      'address' =>$input['address'],
      'owner_city' =>$input['owner_city'],
      'owner_state' =>$input['owner_state'],
      'pincode' =>$input['pincode'],
      'contact1' =>$input['contact1'],
      'contact2' =>$input['contact2'],
      'latest_turnover' =>$input['latest_turnover'],
      'owner_purpose_of_loan' =>$input['owner_purpose_of_loan'],
      'required_amount' =>$input['required_amount']), $santosh, 'Welcome to SMENiwas!');

    $this->sendMail('emails.welcome', array('token' => $token), $user->email, 'Welcome to SMENiwas!');

    //            UserProfile::updateOrCreate(['id' => $id], $input);

    if(isset($input['owner_city']) && $input['owner_city'] == 'Other'){
      $input['owner_city'] = $input['city_other'];
    }

    UserProfile::updateOrCreate([
      'id' => $id,
      'user_id' => $input['user_id'],
      'name_of_firm' => $input['name_of_firm'],
      'owner_entity_type' =>$input['owner_entity_type'],
      'owner_name' =>$input['owner_name'],
      'address' =>$input['address'],
      'owner_city' =>$input['owner_city'],
      'owner_state' =>$input['owner_state'],
      'pincode' =>$input['pincode'],
      'contact1' =>$input['contact1'],
      'contact2' =>$input['contact2'],
      'latest_turnover' =>$input['latest_turnover'],
      'owner_purpose_of_loan' =>$input['owner_purpose_of_loan'],
      'required_amount' =>$input['required_amount'],
      'natureOfBusinessActivity' =>@$input['natureOfBusinessActivity'],
    ]);

    $confParam = new ConfigurableParameter();
    $message = $confParam->getParamValueOrDefault('sms_template','Post Signup');
    if(isset($user)){
      $userProfile = $user->userProfile();
      if(isset($userProfile) && isset($userProfile->contact1)){
        $mobileNumber = $userProfile->contact1;
        $this->sendSMS($mobileNumber, $message);
      }
    }

    session()->flash('flash_message','User Details were successfully saved!');
    return view('register.wizard.thank_you');
  }

  public function getEditProfile($id = null)
  {

    $user = null;

    if(isset($id)){
      $user = User::find($id);
    }else{
      $user = Auth::user();
      $id = $user->id;
    }

    $userProfile = $user->userProfile();

    $firm_pan = $user->username;
    $owner_email = $user->email;

    //        dd($firm_pan,$owner_email);

    $entityTypes = MasterData::entityTypes();
    $chosenEntity = null;

    $cities = MasterData::cities();
    $chosenCity = null;

    $states = MasterData::states();
    $chosenState = null;

    $purpose_of_loan = MasterData::endUseList();
    $chosenPurposeOfLoan =null;
    $setDisable = null;
    /* $isSME = $user->isSME();
    echo "<pre>";
    print_r($isSME);
    echo "</pre>";
    if($isSME==1){*/
      $setDisable = 'readonly';


      if(isset($userProfile)) {
        $chosenEntity = $userProfile->owner_entity_type;
        $chosenState = $userProfile->owner_state;
        $chosenPurposeOfLoan = $userProfile->owner_purpose_of_loan;

        if (in_array($userProfile->owner_city, $cities)) {
          $chosenCity = $userProfile->owner_city;
        }
        else{
          $userProfile->city_other = $userProfile->owner_city;
          $chosenCity = 'Other';
        }
      }

      $user = Auth::user();

      if(isset($user)){
        $userID = $user->id;
        $userEmail = $user->email;
      }
      if(isset($userID)){
        $mobileAppData = DB::table('user_profiles')->where('user_id', $userID)->first();
      }

      if(isset($userID)){
        $userData = DB::table('users')->where('id', $userID)->first();
      }

      if(isset($mobileAppData)){
        $mobileAppFirm_Name = $mobileAppData->name_of_firm;
        $mobileEntityType = $mobileAppData->owner_entity_type;
        $mobileAuditedTurnover = $mobileAppData->latest_turnover;
        $mobileFirmPan = $userData->username;
        $mobileOwnerName = $mobileAppData->owner_name;
        $mobileEmail = $userData->email;
        $mobileAddress = $mobileAppData->address;
        $mobileCity = $mobileAppData->owner_city;
        $mobileState = $mobileAppData->owner_state;
        $mobilePincode = $mobileAppData->pincode;
        $mobileContact = $mobileAppData->contact1;
      }

      $formaction = 'Register\RegistrationWizardController@postEditProfile';
      $subViewType = 'register.sme._form_register';
      $validator = JsValidator::make($this->editOwnerPageValidationRules);
      return view('register.sme.createedit',compact('formaction','subViewType','validator','userProfile','firm_pan','owner_email',
        'entityTypes','chosenEntity','states','chosenState','purpose_of_loan','chosenPurposeOfLoan','cities','chosenCity',
        'mobileAppFirm_Name','mobileEntityType','mobileAuditedTurnover','mobileFirmPan','mobileOwnerName','mobileEmail','mobileAddress',
        'mobileCity','mobileState','mobilePincode','mobileContact','setDisable'));
    }


    public function postEditProfile(Request $request)
    {
      $input = Input::all();

      $id = $input['id'];
      $userID = $input['user_id'];
      $data = null;
      $setDisable = null;
      if(isset($id)) {
        $data = UserProfile::find($id);
        $data1 = User::find($id);
      }
    //        dd($userID,$input, $id, $data, $data1);

      $this->validate($request, $this->editOwnerPageValidationRules);
      $input = $request->all();

      if(isset($input['owner_city']) && $input['owner_city'] == 'Other'){
        $input['owner_city'] = $input['city_other'];
      }

      UserProfile::updateOrCreate(array('id' => $id),['user_id' => $input['user_id'], 'name_of_firm' => $input['name_of_firm'],
        'owner_entity_type' =>$input['owner_entity_type'],'owner_name' =>$input['owner_name'],'address' =>$input['address'],
        'owner_city' =>$input['owner_city'],'owner_state' =>$input['owner_state'],'pincode' =>$input['pincode'],
        'contact1' =>$input['contact1'],'contact2' =>$input['contact2'],'latest_turnover' =>$input['latest_turnover'],
        'owner_purpose_of_loan' =>$input['owner_purpose_of_loan'],'required_amount' =>$input['required_amount']]);

    // UserProfile::updateOrCreate(array('id' => $id), $input);
      User::updateOrCreate(array('id' => $userID),['id' => $input['id'],'username' => $input['firm_pan'], 'email' => $input['owner_email']]);

      session()->flash('flash_message','User Details were successfully saved!');

      $redirectPath = 'register/wizard/edit-profile';
      return Redirect::to($redirectPath)->withInput();

    }

    public function postAdvisor (Request $request)
    {
      $input = Input::all();
    //        dd($input, $input['password']);
      $smeClient = $input['sme_client'];
      $userId = $input['user_id'];
      $id = $input['id'];
      $data = null;

      if(isset($id)) {
        $data = UserProfile::find($id);
      }

      if($smeClient == 1 )
      {
        $this->validate($request, $this->advisorSMEPageValidationRules);
        $input = $request->all();


      //          Register & send mail to CA/Advisor
        $credentials = ['username' => $input['adv_pan'], 'email' => $input['adv_email'], 'password' => password_hash($input['password'], PASSWORD_DEFAULT)];
        $user = User::updateOrCreate(array('id' => $id), $credentials);
        $token = $this->generateToken($user);
        $role = Roles::where('slug', '=', Config::get('constants.RL_CP'))->get()->first();
        $role->users()->attach($user);
        $user->push();
        $this->sendMail('emails.welcome', array('token' => $token), $user->email, 'Welcome to SMENiwas!');

        UserProfile::updateOrCreate(['id' => $id,'user_id' => $user->id, 'name_of_firm' => $input['adv_name'],'contact1' =>$input['adv_mobile']]);

      //Register & send mail to Owner/Promoter
        $credentialsSME = ['username' => $input['firm_pan'], 'email' => $input['owner_email'], 'password' => password_hash($input['password'], PASSWORD_DEFAULT)];
        $userSME = User::updateOrCreate(array('id' => $id), $credentialsSME);
        $token = $this->generateToken($userSME);
        $role = Roles::where('slug', '=', Config::get('constants.RL_SME'))->get()->first();
        $role->users()->attach($userSME);
        $userSME->push();
        $this->sendMail('emails.welcome', array('token' => $token), $userSME->email, 'Welcome to SMENiwas!');

        if(isset($input['owner_city']) && $input['owner_city'] == 'Other'){
          $input['owner_city'] = $input['city_other'];
        }

        UserProfile::updateOrCreate(['id' => $id,'user_id' => $userSME->id,'referredby_userid' => $user->id, 'name_of_firm' => $input['name_of_firm'],
          'owner_entity_type' =>$input['owner_entity_type'],'owner_name' =>$input['owner_name'],'address' =>$input['address'],
          'owner_city' =>$input['owner_city'],'owner_state' =>$input['owner_state'],'pincode' =>$input['pincode'],
          'contact1' =>$input['contact1'],'contact2' =>$input['contact2'],'latest_turnover' =>$input['latest_turnover'],
          'owner_purpose_of_loan' =>$input['owner_purpose_of_loan'],'required_amount' =>$input['required_amount']]);

        $confParam = new ConfigurableParameter();
        $message = $confParam->getParamValueOrDefault('sms_template','Post Signup');
        if(isset($user)){
          $userProfile = $user->userProfile();
          if(isset($userProfile) && isset($userProfile->contact1)){
            $mobileNumber = $userProfile->contact1;
            $this->sendSMS($mobileNumber, $message);
          }
        }

        if(isset($userSME)){
          $userProfile = $userSME->userProfile();
          if(isset($userProfile) && isset($userProfile->contact1)){
            $mobileNumber = $userProfile->contact1;
            $this->sendSMS($mobileNumber, $message);
          }
        }

        session()->flash('flash_message','User Details were successfully saved!');
        return view('register.wizard.thank_you');

      }else{
        $this->validate($request, $this->advisorPageValidationRules);
        $input = $request->all();
        $credentials = ['username' => $input['adv_pan'], 'email' => $input['adv_email'], 'password' => password_hash($input['password'], PASSWORD_DEFAULT) ];
      //            dd($data, $input, $credentials);

        $user = User::updateOrCreate(array('id' => $id), $credentials);
        $token = $this->generateToken($user);
        $role = Roles::where('slug', '=', Config::get('constants.RL_CP'))->get()->first();

        $role->users()->attach($user);
        $user->push();

        $this->sendMail('emails.welcome', array('token' => $token), $user->email, 'Welcome to SMENiwas!');

        UserProfile::updateOrCreate(['id' => $id,'user_id' => $user->id, 'name_of_firm' => $input['adv_name'],'contact1' =>$input['adv_mobile']]);

        $confParam = new ConfigurableParameter();
        $message = $confParam->getParamValueOrDefault('sms_template','Post Signup');
        if(isset($user)){
          $userProfile = $user->userProfile();
          if(isset($userProfile) && isset($userProfile->contact1)){
            $mobileNumber = $userProfile->contact1;
            $this->sendSMS($mobileNumber, $message);
          }
        }

        session()->flash('flash_message','User Details were successfully saved!, your login credentials will be mailed on your registered email id.');

        $redirectPath = 'register/wizard/index';
        return Redirect::to($redirectPath)->withInput();
      }
    }

    public function getEditAdvisor()
    {
      $user = Auth::user();
      $id = $user->id;

      $userProfile = $user->userProfile();
      if(isset($userProfile)) {
        $adv_name = $userProfile->name_of_firm;
        $adv_mobile = $userProfile->contact1;
      }

      $userP = User::find($id);
      if(isset($userProfile)) {
        $adv_pan = $userP->username;
        $adv_email = $userP->email;
      }

    //dd($id,$userP,$adv_pan,$adv_email,$userProfile,$adv_name,$adv_mobile);
      $formaction = 'Register\RegistrationWizardController@postEditAdvisor';
      $subViewType = 'register.ca._form_ca_register';
      $validator = JsValidator::make($this->editAdvisorPageValidationRules);
      return view('register.ca.createedit',compact('formaction','subViewType','validator','userProfile','adv_pan','adv_email','adv_name','adv_mobile'));
    }

    public function postEditAdvisor (Request $request)
    {
      $input = Input::all();
      $user = Auth::user();
      $id = $user->id;

      $userProfile = $user->userProfile();
      $userId = $userProfile->user_id;

      if(isset($id)) {
        $data = $userProfile;
        $data1 = User::find($id);
      }

    //        dd($input,$id,$userProfile,$userId);

      $this->validate($request, $this->editAdvisorPageValidationRules);
      $input = $request->all();
      User::updateOrCreate(array('id' => $id),['id' => $input['id'],'username' => $input['adv_pan'], 'email' => $input['adv_email']]);
      UserProfile::updateOrCreate(array('user_id' => $userId), ['name_of_firm' => $input['adv_name'], 'contact1' => $input['adv_mobile']]);

      session()->flash('flash_message','User Details were successfully saved!');

      $redirectPath = 'register/wizard/edit-advisor';
      return Redirect::to($redirectPath)->withInput();
    }

    private function checkAccess($redirectUrl){

      if (Auth::guest()) {
        Session::put('url.intended', $redirectUrl);
        return true;
      }else {
        return false;
      }
    }
    protected function getIsDisabled($user = null, $isAnalyst = false) {
      if (!isset($user)) {
        $user = Auth::getUser();
      }

      if (isset($user)) {
        if (!$isAnalyst && !$user->isSME()) {
          return 'disabled';
        } elseif ($isAnalyst && !$user->isSMENiwasEmployee()) {
          return 'disabled';
        }
      }
      return '';
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
