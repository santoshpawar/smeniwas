<?php namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;

use App\Models\Address;
use App\Models\MasterData;
use App\Models\User;
use App\Models\Roles;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Session;
use Validator;
use JsValidator;
use Input;
use Mail;
use Auth;

class SMEUserProfileController extends Controller
{

    protected $indexPageValidationRules = [
        'username' => 'required|alpha_num|unique:users',
        'password' => 'required|alpha_num|confirmed|min:6',
        'email' => 'required|email|unique:users'
    ];

    protected $detailPageValidationRules = [
        'entity_type' => 'required',
        'business_nature' => 'required',
        'industry_type' => 'required',
        'business_details' => 'required',
        'website' => 'active_url',
        'mobile' => 'required',
        'std_code' => 'required',
        'landline' => 'required',
        'purpose_of_loan' => 'required',
        'required_amount' => 'required'
    ];

    protected $promoterPageValidationRules = [
        'owner_name' => 'required',
        'owner_pan' => 'required',
        'owner_email' => 'required|email',
        'owner_mobile' => 'required',
        'owner_std_code' => 'required',
        'owner_landline' => 'required'
    ];

    protected $financialPageValidationRules = [
        'incorporation_date' => 'required',
        'tan' => 'required',
        'service_tax_number' => 'required',
        'vat_number' => 'required',
        'turnover_201415' => 'required',
        'turnover_201314' => 'required',
        'turnover_201213' => 'required',
        'turnover_201112' => 'required',
        'gross_fixed_assets' => 'required',
        'gross_equipment' => 'required'
    ];

    protected $subsidiaryPageValidationRules = [
        'name' => 'required',
        'entity_type' => 'required',
        'business_nature' => 'required',
        'industry_type' => 'required',
        'owner_pan' => 'required',
        'owner_name' => 'required',
        'owner_email' => 'required|email',
        'owner_mobile' => 'required',
        'owner_std_code' => 'required',
        'owner_landline' => 'required',
        'incorporation_date' => 'required',
        'tan' => 'required',
        'service_tax_number' => 'required',
        'vat_number' => 'required'
    ];

    protected $registeredAddressRulesGet = [
        'registeredAddress[address1]' => 'required',
        'registeredAddress[address2]' => 'required',
        'registeredAddress[city]' => 'required',
        'registeredAddress[state]' => 'required',
        'registeredAddress[pincode]' => 'required'
    ];

    protected $registeredAddressMessagesGet = [
        'registeredAddress[address1]' => 'Registered Address 1',
        'registeredAddress[address2]' => 'Registered Address 2',
        'registeredAddress[city]' => 'Registered Address City',
        'registeredAddress[state]' => 'Registered Address State',
        'registeredAddress[pincode]' => 'Registered Address Pincode'
    ];

    protected $registeredAddressRulesPost = [
        'registeredAddress.address1' => 'required',
        'registeredAddress.address2' => 'required',
        'registeredAddress.city' => 'required',
        'registeredAddress.state' => 'required',
        'registeredAddress.pincode' => 'required'
    ];

    protected  $registeredAddressMessagesPost = [
        'registeredAddress.address1.required' => 'Address 1 field for registered address is required',
        'registeredAddress.address2.required' => 'Address 2 field for registered address is required',
        'registeredAddress.city.required' => 'City field for registered address is required',
        'registeredAddress.state.required' => 'State field for registered address is required',
        'registeredAddress.pincode.required' => 'Pincode field for registered address is required'
    ];


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $formaction = 'Register\SMEUserProfileController@postIndex';
        $subViewType = 'register.sme._form_register';

        $entityTypes = MasterData::entityTypes();
        $chosenEntity = null;

        $states = MasterData::states();
        $chosenState = null;
        $chosenOperatingState = null;

        $yesnotype = MasterData::yesNoTypes();
        $chosenYesNoType = null;

        $wizardusertype = MasterData::wizardUserType();
        $chosenWizardUserType = null;

        $purpose_of_loan = MasterData::purposeOfLoan();
        $chosenPurposeOfLoan = null;


        $validator = JsValidator::make($this->indexPageValidationRules);
        return view('register.sme.createedit', compact('formaction', 'subViewType', 'validator', 'entityTypes','chosenEntity','bl_year','states','chosenState','chosenOperatingState','purpose_of_loan','chosenPurposeOfLoan','yesnotype','chosenYesNoType','wizardusertype','chosenWizardUserType'));
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
            $id = $request['id'];
            $this->validate($request, $this->indexPageValidationRules);

//            $user = Sentinel::registerAndActivate($request->all());
            $user = User::updateOrCreate(array('id' => $id), $request->all());
            //Assign the SME role to this user
//            $role = Sentinel::findRoleBySlug(Config::get('constants.RL_SME'));
            $role = Roles::where('slug', '=', Config::get('constants.RL_SME'))->get()->first();
            $role->users()->attach($user);
            $user->push();

            $credentials = $request->only('email', 'password');

//            if (Sentinel::authenticateAndRemember($credentials)) {
            if(Auth::attempt($credentials)){
                $this->sendMail('emails.welcome', array(), $user->email, 'Welcome to SMENiwas!');
                return Redirect::to('register/sme/details')->withInput();
            } else {
                return Redirect::to('auth/login');
            }
        }else{
            return Redirect::to('register/sme')->withInput();
        }
    }
//
//    /**
//     * Show the form for creating a new resource.
//     *
//     * @param Request $request
//     * @return Response
//     */
//    public function getDetails(Request $request)
//    {
//
//        //Proceed ahead to the next page if the user is already created
//        if($this->checkAccess('register/sme/details')){
//            return Redirect::to('auth/login');
//        }
//
//        $entityTypes = MasterData::entityTypes();
//        $businessNatures = MasterData::businessNatures();
//        $industryType = MasterData::industryTypes();
//        $states = MasterData::states();
//        $purpose_of_loan = MasterData::purposeOfLoan();
//
//        //Below fields are passed as parameter to view to show the previously saved choices as option selected values during edits
//        $chosenEntity = null;
//        $chosenBusinessNature = null;
//        $chosenIndustryType = null;
//        $chosenState = null;
//        $chosenOperatingState = null;
//        $chosenPurposeOfLoan = null;
//
//        $userProfile =  Sentinel::getUser()->userProfile;
//        $isOperatingAddressSameAsRegistered = false;
//
//        if (isset($userProfile)) {
//            $chosenEntity = $userProfile->entity_type;
//            $chosenBusinessNature = $userProfile->business_nature;
//            $chosenIndustryType = $userProfile->industry_type;
//
//            $registeredAddress = $userProfile->registeredAddress;
//            if (isset($registeredAddress)) {
//                $chosenState = $registeredAddress->state;
//            }
//
//            $operatingAddress = $userProfile->operatingAddress;
//            if(isset($operatingAddress)){
//                $chosenOperatingState = $operatingAddress->state;
//            }
//
//            if(isset($operatingAddress) && isset($registeredAddress) && $userProfile->registered_address_id === $userProfile->operating_address_id){
//                $isOperatingAddressSameAsRegistered = true;
//            }
//        }
//
//        $validator = JsValidator::make(array_merge($this->detailPageValidationRules, $this->registeredAddressRulesGet), [], $this->registeredAddressMessagesGet);
//        //$validator = JsValidator::make(['entity_type' => 'required']);
//
//        $formaction = 'Register\SMEUserProfileController@postDetails';
//        $subViewType = 'register.sme._form_details';
//        return view('register.sme.createedit', compact('formaction', 'subViewType', 'entityTypes', 'businessNatures', 'industryType', 'states', 'chosenEntity', 'chosenBusinessNature', 'chosenIndustryType', 'chosenState','isOperatingAddressSameAsRegistered','chosenOperatingState', 'validator','chosenPurposeOfLoan','purpose_of_loan'));
//    }
//
//    /**
//     * Show the form for creating a new resource.
//     *
//     * @param Request $request
//     * @return Response
//     */
//    public function postDetails(Request $request)
//    {
//        $isOperatingAddressDifferentThanRegistered=0;
//        //Proceed ahead to the next page if the user is already created
//        if($this->checkAccess('register/sme/details')){
//            return Redirect::to('auth/login');
//        }
//
//        $rules = array_merge($this->detailPageValidationRules, $this->registeredAddressRulesPost);
//
//        if (Input::get('operating_address') != '1') {
//            $operatingAddressRules = array(
//                'operatingAddress.address1' => 'required',
//                'operatingAddress.address2' => 'required',
//                'operatingAddress.city' => 'required',
//                'operatingAddress.state' => 'required',
//                'operatingAddress.pincode' => 'required',
//                'purpose_of_loan' => 'required',
//                'required_amount' => 'required',
//            );
//
//            $operatingAddressErrMsg = array(
//                'operatingAddress.address1.required' => 'Address 1 field for operating address is required',
//                'operatingAddress.address2.required' => 'Address 2 field for operating address is required',
//                'operatingAddress.city.required' => 'City field for operating address is required',
//                'operatingAddress.state.required' => 'State field for operating address is required',
//                'operatingAddress.pincode.required' => 'Pincode field for operating address is required'
//            );
//
//            $rules = array_merge($rules, $operatingAddressRules);
//            $messages = array_merge($this->registeredAddressMessagesPost, $operatingAddressErrMsg);
//
//            $isOperatingAddressDifferentThanRegistered=1;
//            $this->validate($request, $rules, $messages);
//        }
//
//        $this->validate($request, $rules);
//        $input = $request->all();
////        dd($input);
//        $user = Sentinel::getUser();
//        $userProfile = UserProfile::updateOrCreate(array('user_id' => $user->id), $input);
//        if (isset($userProfile)) {
//            $registeredAddress = Address::updateOrCreate(array('id' => $userProfile->registered_address_id), $input['registeredAddress']);
//            $userProfile->registeredAddress()->associate($registeredAddress);
//        }
//
//        $oldOperatingAddressId = $userProfile->operating_address_id;
//        $newOperatingAddressId = $userProfile->operating_address_id;
//        //If old Operating Address was same, but in the current request, if it is unchecked/different,
//        // then we need to remove the oldOperatingAddress, and insert a new record for the new operating address
//        if($isOperatingAddressDifferentThanRegistered==1 && $userProfile->registered_address_id == $oldOperatingAddressId){
//            $newOperatingAddressId = null;//setting this to null will create a new record in update or create
//        }
//
//        //If operating address is different than registered,
//        if($isOperatingAddressDifferentThanRegistered==1){
//            if (isset($userProfile)) {
//                $operatingAddress = Address::updateOrCreate(array('id' => $newOperatingAddressId), $input['operatingAddress']);
//                $userProfile->operatingAddress()->associate($operatingAddress);
//            }
//        }else if($isOperatingAddressDifferentThanRegistered == 0 && isset($oldOperatingAddressId)
//            && isset($userProfile->registered_address_id)
//            && $oldOperatingAddressId != $userProfile->registered_address_id){
//            //If operating address is same as registered, and if old operating address is != registered address, then delete it
//            $deletionId = $userProfile->operating_address_id;
//            $userProfile->operating_address_id = $userProfile->registered_address_id;
//            $userProfile->save();
//            Address::destroy($deletionId);
//        }else if($isOperatingAddressDifferentThanRegistered==0){
//            //This means that the same as above checkbox is checked
//            $userProfile->operating_address_id = $userProfile->registered_address_id;
//        }
//        $userProfile->save();
//        return Redirect::to('register/sme/promoter')->withInput();
//    }
//
//    /**
//     * Show the form for creating a new resource.
//     *
//     * @param Request $request
//     * @return Response
//     */
//    public function getPromoter(Request $request)
//    {
//        //Proceed ahead to the next page if the user is already created
//        if($this->checkAccess('register/sme/promoter')){
//            return Redirect::to('auth/login');
//        }
//
//        $validator = JsValidator::make($this->promoterPageValidationRules);
//
//        $formaction = 'Register\SMEUserProfileController@postPromoter';
//        $subViewType = 'register.sme._form_promoter';
//        return view('register.sme.createedit', compact('formaction', 'subViewType','validator'));
//    }
//
//    /**
//     * Show the form for creating a new resource.
//     *
//     * @param Request $request
//     * @return Response
//     */
//    public function postPromoter(Request $request)
//    {
//
//        //Proceed ahead to the next page if the user is already created
//        if($this->checkAccess('register/sme/promoter')){
//            return Redirect::to('auth/login');
//        }
//
//        $input = Input::all();
//        $validator = Validator::make($input, $this->promoterPageValidationRules);
//
//        if ($validator->fails()) {
//            return Redirect::back()->withErrors($validator)->withInput();
//        }
//
//        $user = Sentinel::getUser();
//        $userProfile = UserProfile::updateOrCreate(array('user_id' => $user->id), $input);
//        $userProfile->save();
//        return Redirect::to('register/sme/financial')->withInput();
//    }
//
//    /**
//     * Show the form for creating a new resource..
//     *
//     * @param Request $request
//     * @return Response
//     */
//    public function getFinancial(Request $request)
//    {
//        //Proceed ahead to the next page if the user is already created
//        if($this->checkAccess('register/sme/financial')){
//            return Redirect::to('auth/login');
//        }
//        $validator = JsValidator::make($this->financialPageValidationRules);
//
//        $formaction = 'Register\SMEUserProfileController@postFinancial';
//        $subViewType = 'register.sme._form_financial';
//        return view('register.sme.createedit', compact('formaction', 'subViewType','validator'));
//    }
//
//    /**
//     * Show the form for creating a new resource
//     *
//     * @param Request $request
//     * @return Response
//     */
//    public function postFinancial(Request $request)
//    {
//
//        //Proceed ahead to the next page if the user is already created
//        if($this->checkAccess('register/sme/financial')){
//            return Redirect::to('auth/login');
//        }
//
//        $input = Input::all();
//        $validator = Validator::make(Input::all(), $this->financialPageValidationRules);
//
//        if ($validator->fails()) {
//            return Redirect::back()->withErrors($validator)->withInput();
//        }
//
//        $user = Sentinel::getUser();
//        $userProfile = UserProfile::updateOrCreate(array('user_id' => $user->id), $input);
//        $userProfile->save();
//
//        return Redirect::to('register/sme/subsidiary')->withInput();
//    }
//
//    /**
//     * Show the form for creating a new resource.
//     *
//     * @param Request $request
//     * @return Response
//     */
//    public function getSubsidiary(Request $request)
//    {
//        //Proceed ahead to the next page if the user is already created
//        if($this->checkAccess('register/sme/subsidiary')){
//            return Redirect::to('auth/login');
//        }
//
//        $entityTypes = MasterData::entityTypes();
//        $businessNatures = MasterData::businessNatures();
//        $industryType = MasterData::industryTypes();
//        $states = MasterData::states();
//
//        //Below fields are passed as parameter to view to show the previously saved choices as option selected values during edits
//        $chosenEntity = null;
//        $chosenBusinessNature = null;
//        $chosenIndustryType = null;
//        $chosenState = null;
//        $chosenOperatingState = null;
//        $temp = 0;
//        $choosenisSubsidiary = 0;
//        $isOperatingAddressSameAsRegistered = false;
//
//        $userProfile =  Sentinel::getUser()->userProfile;
//        if($userProfile){
//            $subsidiary_id = $userProfile->subsidiary_id;
//            $subsidiary = UserProfile::where('id',$subsidiary_id)->first();
//            if(isset($subsidiary)){
//                $choosenisSubsidiary = $subsidiary->is_subsidiary;
//                $chosenEntity = $subsidiary->entity_type;
//                $chosenBusinessNature = $subsidiary->business_nature;
//                $chosenIndustryType = $subsidiary->industry_type;
//
//                $registeredAddress = $subsidiary->registeredAddress;
//                if (isset($registeredAddress)) {
//                    $chosenState = $registeredAddress->state;
//                }
//                $operatingAddress = $subsidiary->operatingAddress;
//                if(isset($operatingAddress)){
//                    $chosenOperatingState = $operatingAddress->state;
//                }
//                if(isset($operatingAddress) && isset($registeredAddress) && $subsidiary->registered_address_id === $subsidiary->operating_address_id){
//                    $isOperatingAddressSameAsRegistered = true;
//                }
//
//            }
//
//        }
//
//        $validator = JsValidator::make(array_merge($this->subsidiaryPageValidationRules, $this->registeredAddressRulesGet), [], $this->registeredAddressMessagesGet);
//        //$validator = "";
//
//        $formaction = 'Register\SMEUserProfileController@postSubsidiary';
//        $subViewType = 'register.sme._form_subsidiary';
//        return view('register.sme.createedit', compact('formaction', 'subViewType', 'entityTypes', 'businessNatures', 'industryType', 'states', 'chosenEntity', 'chosenBusinessNature', 'chosenIndustryType', 'chosenState', 'validator','choosenisSubsidiary','subsidiary','temp','chosenOperatingState','isOperatingAddressSameAsRegistered'));
//    }
//
//    /**
//     * Show the form for creating a new resource.
//     *
//     * @param Request $request
//     * @return Response
//     */
//    public function postSubsidiary(Request $request)
//    {
//        $flag=0;
//        //Proceed ahead to the next page if the user is already created
//        if($this->checkAccess('register/sme/subsidiary')){
//            return Redirect::to('auth/login');
//        }
//
//        $rules = array_merge($this->subsidiaryPageValidationRules, $this->registeredAddressRulesPost);
//        $input = Input::all();
//       // dd($input);
//        $isSubsidiary = $input['is_subsidiary'];
//        //dd($isSubsidiary);
//        $operatingAddressErrMsg = array();
//
//        if (Input::get('operating_address') != '1') {
//            $operatingAddressRules = array(
//                'operatingAddress.address1' => 'required',
//                'operatingAddress.address2' => 'required',
//                'operatingAddress.city' => 'required',
//                'operatingAddress.state' => 'required',
//                'operatingAddress.pincode' => 'required'
//            );
//            $operatingAddressErrMsg = array(
//                'operatingAddress.address1.required' => 'Address 1 field for operating address is required',
//                'operatingAddress.address2.required' => 'Address 2 field for operating address is required',
//                'operatingAddress.city.required' => 'City field for operating address is required',
//                'operatingAddress.state.required' => 'State field for operating address is required',
//                'operatingAddress.pincode.required' => 'Pincode field for operating address is required'
//            );
//            $rules = array_merge($rules, $operatingAddressRules);
//            $flag=1;
//        }
//
//        $messages = array_merge($this->registeredAddressMessagesPost, $operatingAddressErrMsg);
//
//        if($isSubsidiary) { //Validate only if user has chosen that there is a subsidiary
//            $validator = Validator::make(Input::all(), $rules, $messages);
//
//            if ($validator->fails()) {
//                return Redirect::back()->withErrors($validator)->withInput();
//            }
//        }
//
//
//        $user = Sentinel::getUser();
//        $userProfile = $user->userProfile()->first();
//        $subsidiaryId = $userProfile->subsidiary_id;
//        $input['user_id']=$user->id;
//        //$input['is_subsidiary']=1;
//
//        if(!$isSubsidiary && isset($subsidiaryId)){
//            //If during edit, the user chooses no to the 'Do you have any Subsidiary/Associate company?',
//            // and if previously there was a subsidiary saved, then we need to delete it.
//            UserProfile::destroy($subsidiaryId);
//
//            $userProfile->subsidiary_id = null;
//            $userProfile->save();
//        }
//        if($isSubsidiary) {
//            $subsidiary = UserProfile::updateOrCreate(array('id' => $subsidiaryId), $input);
//            $userProfile->subsidiary_id = $subsidiary->id;
//            if (isset($subsidiary)) {
//                $registeredAddress = Address::updateOrCreate (array('id' => $subsidiary->registered_address_id), $input['registeredAddress']);
//                $subsidiary->registeredAddress()->associate($registeredAddress);
//                $subsidiary->registered_address_id = $registeredAddress->id;
//            }
//
//            $oldOperatingAddressId = $subsidiary->operating_address_id;
//            $newOperatingAddressId = $subsidiary->operating_address_id;
//            //If old Operating Address was same, but in the current request, if it is unchecked/different,
//            // then we need to remove the oldOperatingAddress, and insert a new record for the new operating address
//            if($flag==1 && $subsidiary->registered_address_id == $oldOperatingAddressId){
//                $newOperatingAddressId = null;//setting this to null will create a new record in update or create
//            }
//            //If operating address is different than registered,
//            if($flag==1){
//                if (isset($subsidiary)) {
//                    $operatingAddress = Address::updateOrCreate(array('id' => $newOperatingAddressId), $input['operatingAddress']);
//                    $subsidiary->operatingAddress()->associate($operatingAddress);
//                    $subsidiary->operating_address_id = $operatingAddress->id;
//                }
//            }else if($flag == 0 && isset($oldOperatingAddressId) && isset($subsidiary->registered_address_id)  && $oldOperatingAddressId != $subsidiary->registered_address_id){
//                //If operating address is same as registered, and if old operating address is != registered address, then delete it
//                $deletionId = $subsidiary->operating_address_id;
//                $subsidiary->operating_address_id = $subsidiary->registered_address_id;
//                $subsidiary->save();
//                Address::destroy($deletionId);
//            }else if($flag==0){
//                //This means that the same as above checkbox is checked
//                $subsidiary->operating_address_id = $subsidiary->registered_address_id;
//            }
//            $subsidiary->save();
//            $userProfile->save();
//        }
//        return Redirect::to('home');
//    }
//
//    private function checkAccess($redirectUrl){
//
//        if (Sentinel::guest()) {
//            Session::put('url.intended', $redirectUrl);
//            return true;
//        }else {
//            return false;
//        }
//    }
}