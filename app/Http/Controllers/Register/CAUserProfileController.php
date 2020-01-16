<?php namespace App\Http\Controllers\Register;

//use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Address;
use App\Models\MasterData;
use App\Models\User;
use App\Models\Roles;
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

/**
 * @property array cadetailsValidationRules
 */
class CAUserProfileController extends Controller{

    protected $indexValidationRules = [
        'username' => 'required|alpha_num|unique:users',
        'password' => 'required|alpha_num|confirmed|min:6',
        'email' => 'required|email|unique:users'
    ];

    protected $caFirmValidationRules = [
        'entity_type' => 'required',
        'name' => 'required',
        'mobile'=>'required',
        'std_code'=>'required',
        'landline'=>'required',
        'registeredAddress.address1' => 'required',
        'registeredAddress.address2' => 'required',
        'registeredAddress.city' => 'required',
        'registeredAddress.state' => 'required',
        'registeredAddress.pincode' => 'required',
        'purpose_of_loan' => 'required',
        'required_amount' => 'required'
    ];

    protected $caProprietorsValidationRules = [
        'owner_name' => 'required',
        'owner_email' => 'required|email',
        'owner_pan' => 'required',
        'owner_mobile' => 'required',
        'owner_std_code' => 'required',
        'owner_landline' => 'required',
        'turnover_201415' => 'required',
        'turnover_201314' => 'required',
        'turnover_201213' => 'required',
        'turnover_201112' => 'required'
    ];

    protected $caCertificateValidationRules = [
        'registration_no' => 'required',
        'ca_certificate_file' => 'required'
        ];

    protected $newSmePageValidationRules = [
        'name_of_firm' => 'required',
        'firm_pan' => 'required|Regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/',
        'owner_entity_type' => 'required',
        'owner_name' => 'required',
        'owner_email' => 'required',
        'address' => 'required',
        'owner_state' => 'required',
        'pincode' => 'required|numeric',
        'contact1' => 'required|numeric',
//        'contact2' => 'required|numeric',
        'latest_turnover' => 'required',
        'owner_purpose_of_loan' => 'required',
        'required_amount' => 'required',
        'city_other' => 'required_if:owner_city,Other'

    ];


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $formaction = 'Register\CAUserProfileController@postIndex';
        $subViewType = 'register.ca._form_ca_register';

        $validator = JsValidator::make($this->indexValidationRules);

        return view('register.ca.createedit', compact('formaction', 'subViewType', 'validator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */

    public function postIndex(Request $request)
    {
        if(Auth::guest()) {
//            dd($request->all());
            $id = $request['id'];
            $this->validate($request, $this->indexValidationRules);

//            $user = Sentinel::registerAndActivate($request->all());
            $user = User::updateOrCreate(array('id' => $id), $request->all());
            //Assign the SME role to this user

//          $role = Sentinel::findRoleBySlug(Config::get('constants.RL_CA'));
            $role = Roles::where('slug', '=', Config::get('constants.RL_CP'))->get()->first();
//          $role = Sentinel::findRoleBySlug(Config::get('constants.RL_CP'));

            $role->users()->attach($user);
            $user->push();

            $credentials = $request->only('email', 'password');

//            if (Sentinel::authenticateAndRemember($credentials)) {
            if(Auth::attempt($credentials)){
                $this->sendMail('emails.welcome', array(), $user->email, 'Welcome to SMENiwas!');
                return Redirect::to('register/ca/details')->withInput();
            } else {
                return Redirect::to('auth/login');
            }
        }else{
            return Redirect::to('register/ca/details')->withInput();
        }
    }

    public function getSmeClient()
    {
        $formaction = 'Register\CAUserProfileController@postSmeClient';
        $subViewType = 'register.ca._form_ca_newsme';

        $userProfile = null;

        $entityTypes = MasterData::entityTypes();
        $chosenEntity = null;

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
        $validator = JsValidator::make($this->newSmePageValidationRules);

        return view('register.ca._form_ca_newsme', compact('formaction','validator','userProfile','subViewType','entityTypes',
            'chosenEntity','bl_year','states','chosenState','chosenOperatingState','purpose_of_loan','chosenPurposeOfLoan','yesnotype',
            'chosenYesNoType','wizardusertype','chosenWizardUserType','cities','chosenCity'));
    }

    public function postSmeClient(Request $request)
    {
        $input = Input::all();
//        dd($input);
        $user = Auth::user();
        $userId = $user->id;
//        dd($userId,$input,$user);

        $id = $input['id'];
        $input['password'] = str_random(6);
        $data = null;

        if(isset($id)) {
            $data = UserProfile::find($id);
        }

        $this->validate($request, $this->newSmePageValidationRules);
        $credentials = ['username' => $input['firm_pan'], 'email' => $input['owner_email'], 'password' => $input['password'] ];
//        $user = Sentinel::registerAndActivate($credentials);
        $user = User::updateOrCreate(array('id' => $id), $credentials);
        $input['user_id'] = $user->id;
        $token = $this->generateToken($user);

//        $role = Sentinel::findRoleBySlug(Config::get('constants.RL_SME'));
        $role = Roles::where('slug', '=', Config::get('constants.RL_SME'))->get()->first();
        $role->users()->attach($user);
        $user->push();

        $this->sendMail('emails.welcome', array('token' => $token), $user->email, 'Welcome to SMENiwas!');

        if(isset($input['owner_city']) && $input['owner_city'] == 'Other'){
            $input['owner_city'] = $input['city_other'];
        }

        UserProfile::updateOrCreate(['id' => $id,'user_id' => $user->id,'referredby_userid' => $userId, 'name_of_firm' => $input['name_of_firm'],
            'owner_entity_type' =>$input['owner_entity_type'],'owner_name' =>$input['owner_name'],'address' =>$input['address'],
            'owner_city' =>$input['owner_city'],'owner_state' =>$input['owner_state'],'pincode' =>$input['pincode'],'contact1' =>$input['contact1'],
            'contact2' =>$input['contact2'],'latest_turnover' =>$input['latest_turnover'],
            'owner_purpose_of_loan' =>$input['owner_purpose_of_loan'],'required_amount' =>$input['required_amount']]);

//            dd($data, $input, $credentials, $lastUserInsertedId);

        session()->flash('flash_message','User Details were successfully saved!');
        return view('register.wizard.thank_you');
        }

    /*  public function postIndex(Request $request)
      {
          if(Sentinel::guest()) {
              $rules = array(
                  'username' => 'required|alpha_num|unique:users',
                  'password' => 'required|alpha_num|confirmed|min:6',
                  'email' => 'required|email|unique:users'
              );

              $this->validate($request, $rules);

              $user = Sentinel::registerAndActivate($request->all());
              //Assign the SME role to this user
              $role = Sentinel::findRoleBySlug(Config::get('constants.RL_CA'));
              $role->users()->attach($user);
              $user->push();

              $credentials = $request->only('email', 'password');

              if (Sentinel::authenticateAndRemember($credentials)) {
                  return Redirect::to('register/ca/firm')->withInput();
              } else {
                  return Redirect::to('auth/login');
              }
          }else{
              return Redirect::to('register/ca/firm')->withInput();
          }
      }*/

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function getFirm(Request $request){

        if($this->checkAccess(('register/ca/firm'))){
            return Redirect::to('auth/login');
        }
        $states = MasterData::states();
        $chosenState = null;

        $entityTypes = MasterData::entityTypes();
        $chosenEntity = null;
        $purpose_of_loan = MasterData::purposeOfLoan();
        $chosenPurposeOfLoan = null;

        $userProfile =  Auth::user()->userProfile;
        $isOperatingAddressSameAsRegistered = false;

        if (isset($userProfile)) {

            $registeredAddress = $userProfile->registeredAddress;
            if (isset($registeredAddress)) {
                $chosenState = $registeredAddress->state;
            }

            $operatingAddress = $userProfile->operatingAddress;
            if(isset($operatingAddress)){
                $chosenOperatingState = $operatingAddress->state;
            }

            if(isset($operatingAddress) && isset($registeredAddress) && $userProfile->registered_address_id === $userProfile->operating_address_id){
                $isOperatingAddressSameAsRegistered = true;
            }
        }


        $formaction = 'Register\CAUserProfileController@postFirm';
        $subViewType = 'register.ca._form_ca_firm_details';

        $validator = JsValidator::make($this->caFirmValidationRules);
        return view('register.ca.createedit', compact('formaction', 'subViewType','states','chosenState','isOperatingAddressSameAsRegistered','chosenOperatingState','entityTypes','chosenEntity','purpose_of_loan','chosenPurposeOfLoan'));

    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function postFirm(Request $request){
       // $flag=0;

        $isOperatingAddressDifferentThanRegistered=0;
        if($this->checkAccess('register/ca/firm')){
            return Redirect::to('auth/login');
        }
        $rules = array(
            'name' => 'required',
            'mobile'=>'required',
            'std_code'=>'required',
            'landline'=>'required',
            'registeredAddress.address1' => 'required',
            'registeredAddress.address2' => 'required',
            'registeredAddress.city' => 'required',
            'registeredAddress.state' => 'required',
            'registeredAddress.pincode' => 'required',
        );

        /*if (Input::get('operating_address') != '1') {
            $operatingAddressRules = array(
                'operatingAddress.address1' => 'required',
                'operatingAddress.address2' => 'required',
                'operatingAddress.city' => 'required',
                'operatingAddress.state' => 'required',
                'operatingAddress.pincode' => 'required'
            );
            $rules = array_merge($rules, $operatingAddressRules);
            $flag=1;
        }

        $this->validate($request, $rules);
        $input = $request->all();
        $user = Sentinel::getUser();
        $userProfile = UserProfile::updateOrCreate(array('user_id' => $user->id), $input);
        if (isset($userProfile)) {
            $registeredAddress = Address::updateOrCreate(array('id' => $userProfile->registered_address_id), $input['registeredAddress']);
            $userProfile->registeredAddress()->associate($registeredAddress);
        }
        if($flag==1){
            if (isset($userProfile)) {
                $operatingAddress = Address::updateOrCreate(array('id' => $userProfile->operating_address_id), $input['operatingAddress']);
                $userProfile->operatingAddress()->associate($operatingAddress);
            }
        }
        $userProfile->save();*/
        $messages = array();

        if (Input::get('operating_address') != '1') {
            $operatingAddressRules = array(
                'operatingAddress.address1' => 'required',
                'operatingAddress.address2' => 'required',
                'operatingAddress.city' => 'required',
                'operatingAddress.state' => 'required',
                'operatingAddress.pincode' => 'required'
            );

            $operatingAddressErrMsg = array(
                'operatingAddress.address1.required' => 'Address 1 field for operating address is required',
                'operatingAddress.address2.required' => 'Address 2 field for operating address is required',
                'operatingAddress.city.required' => 'City field for operating address is required',
                'operatingAddress.state.required' => 'State field for operating address is required',
                'operatingAddress.pincode.required' => 'Pincode field for operating address is required'
            );

            $rules = array_merge($rules, $operatingAddressRules);
            $messages = array_merge($messages, $operatingAddressErrMsg);

            $isOperatingAddressDifferentThanRegistered=1;
        }

        //$validator = JsValidator::make($this->$cadetailsValidationRules);

        $this->validate($request, $rules, $messages);
        $input = $request->all();
//        dd($input);
        $user = Auth::user();
        $userProfile = UserProfile::updateOrCreate(array('user_id' => $user->id), $input);
        if (isset($userProfile)) {
            $registeredAddress = Address::updateOrCreate(array('id' => $userProfile->registered_address_id), $input['registeredAddress']);
            $userProfile->registeredAddress()->associate($registeredAddress);
        }

        $oldOperatingAddressId = $userProfile->operating_address_id;
        $newOperatingAddressId = $userProfile->operating_address_id;
        //If old Operating Address was same, but in the current request, if it is unchecked/different,
        // then we need to remove the oldOperatingAddress, and insert a new record for the new operating address
        if($isOperatingAddressDifferentThanRegistered==1 && $userProfile->registered_address_id == $oldOperatingAddressId){
            $newOperatingAddressId = null;//setting this to null will create a new record in update or create
        }

        //If operating address is different than registered,
        if($isOperatingAddressDifferentThanRegistered==1){
            if (isset($userProfile)) {
                $operatingAddress = Address::updateOrCreate(array('id' => $newOperatingAddressId), $input['operatingAddress']);
                $userProfile->operatingAddress()->associate($operatingAddress);
            }
        }else if($isOperatingAddressDifferentThanRegistered == 0 && isset($oldOperatingAddressId)
            && isset($userProfile->registered_address_id)
            && $oldOperatingAddressId != $userProfile->registered_address_id){
            //If operating address is same as registered, and if old operating address is != registered address, then delete it
            $deletionId = $userProfile->operating_address_id;
            $userProfile->operating_address_id = $userProfile->registered_address_id;
            $userProfile->save();
            Address::destroy($deletionId);
        }else if($isOperatingAddressDifferentThanRegistered==0){
            //This means that the same as above checkbox is checked
            $userProfile->operating_address_id = $userProfile->registered_address_id;
        }
        $userProfile->save();

        return Redirect::to('register/ca/details')->withInput();

    }

        public function getDetails(Request $request)
        {
            $bl_year = MasterData::BalanceSheet_FY();
            //Proceed ahead to the next page if the user is already created
            if($this->checkAccess('register/ca/details')){
                return Redirect::to('auth/login');
            }
            $formaction = 'Register\CAUserProfileController@postDetails';
            $subViewType = 'register.ca._form_proprietors_details';

            $validator = JsValidator::make($this->caProprietorsValidationRules);
            return view('register.ca.createedit', compact('formaction', 'subViewType','bl_year'));
        }

        /**
         * Show the form for creating a new resource.
         *
         * @param Request $request
         * @return Response
         */
        public function postDetails(Request $request)
        {
            $rules = array(
                'owner_name' => 'required',
                'owner_email' => 'required|email',
                'owner_pan' => 'required',
                'owner_mobile' => 'required',
                'owner_std_code' => 'required',
                'owner_landline' => 'required',
                'turnover_201415' => 'required',
                'turnover_201314' => 'required',
                'turnover_201213' => 'required',
                'turnover_201112' => 'required'

            );
            $input = Input::all();
//            dd($input);
            $validator = Validator::make($input, $rules);

           // $validator = JsValidator::make($this->$cadetailsValidationRules);

            $input = Input::all();

            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $user = Auth::user();
            $userProfile = UserProfile::updateOrCreate(array('user_id' => $user->id), $input);
            $userProfile->save();
            return Redirect::to('register/ca/registration')->withInput();
        }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function getRegistration(Request $request)
    {

        //Proceed ahead to the next page if the user is already created
        if($this->checkAccess('register/ca/registration')){
            return Redirect::to('auth/login');
        }
        $formaction = 'Register\CAUserProfileController@postRegistration';
        $subViewType = 'register.ca._form_ca_registration_details';

        $validator = JsValidator::make($this->caCertificateValidationRules);
        return view('register.ca.createedit', compact('formaction', 'subViewType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function postRegistration(Request $request)
    {
        // Check if the CA Registration null
        $input = $request->all();
        $user = Auth::user();
        $userProfile = UserProfile::updateOrCreate(array('user_id' => $user->id), $input);
        $rules = array(
            'registration_no' => 'required',
            'ca_certificate_file' => 'required',
        );

        //$input = Input::all();
        $validator = Validator::make($input, $rules);
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        // Check if the File already exists in the FileSystem
        $fileName = 'ca_documents/'.$user->id.'_ca_'.$request->file('ca_certificate_file')->getClientOriginalName();
        if(Storage::disk('local')->exists($fileName))
        {
            return Redirect::back()->withErrors('File already exist in the System')->withInput();
        }

        $redirectUrl = 'register/ca/registration';
        if (isset($userProfile))
        {
            //Save the File to storage/app directory
            $fileStorageType = Config::get('constants.CONST_FILE_STORAGE_TYPE');
            $file = $request->file('ca_certificate_file');
            //$fileName = 'ca_documents/'.$user->id.'_ca_'.$request->file('ca_certificate_file')->getClientOriginalName();
            //$extension = $file->getClientOriginalExtension();
            //Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));
            Storage::disk($fileStorageType)->put($fileName,  File::get($file));
            $userProfile->save();
        }
        return Redirect::to($redirectUrl)->withInput();
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