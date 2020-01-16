<?php namespace App\Http\Controllers\Loans;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\CompanyPosition;
use App\Models\ExistingLenders;
use App\Models\MasterData;

use App\Models\Loan;
use App\Models\PromoterDetails;
use App\Models\Uploads;
use App\Models\PropertyDetails;
use App\Models\ThirdPartyDetails;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Collection;

//use Proengsoft\JsValidation\JsValidator;
use Illuminate\Support\Facades\Storage;
use Validator;
use Input;
use Auth;



/**
 * Class LAPController
 *
 * @package App\Http\Controllers\Loans
 */

class LAPController extends BaseLoansController{

    public function __construct() {
        //This will ensure that all routes handled by this controller are first authenticated
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * @param $loanId
     * @return Response
     */
    public function getIndex($loanId=null)
    {

        $promotersGenerationType = MasterData::promoterGenrationType();
        $choosenPromoterGenerationtype = null;

        $promotersBackground = MasterData::promoterBackground();
        $choosenPromoterBackground = null;

        $companyPositionTypes = MasterData::companyPositionTypes();
        $chosenCompanyPositionTypes= array();

        $sales = MasterData::sales();
        $choosenSales = null;
        $ratingModel = null;

        if(isset($loanId)){
            $chosenCompanyPositionTypes = CompanyPosition::where('loan_id','=', $loanId)->get()->lists('position')->all();
            $genralInfo = Loan::where('id','=',$loanId)->get()->first();
            $choosenPromoterGenerationtype =  $genralInfo->promoter_generation_type;
            $choosenPromoterBackground = $genralInfo->promoter_background;
            $choosenSales = $genralInfo->sales_geography_type;
        }

        $productType = MasterData::productTypes();
        $chosenproductType = null;

        $loan = null;
        $loanApplicationId = null;

        if(isset($loanId)){
            $loan = Loan::find($loanId);
            $loanApplicationId = $loan->loan_application_id;
        }

        $formaction = 'Loans\LAPController@postIndex';
        $subViewType = 'loans.lap._generalinfo';

        return view('loans.lap.createedit', compact('formaction', 'subViewType','loan','loanId','companyPositionTypes', 'productType','chosenproductType', 'chosenCompanyPositionTypes', 'loanApplicationId','promotersGenerationType','choosenPromoterGenerationtype','promotersBackground','choosenPromoterBackground','sales','choosenSales'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function postIndex(Request $request){

        $rules = array(
            'promoter_generation_type' => 'required',
            'promoter_background' => 'required',
            'other_key_businesses' => 'required',
            'manufacturing_location_no' => 'required',
            'key_products_manufactured' => 'required',
            'product_uses' => 'required',
            'industry_segment' => 'required',
            'services_nature' => 'required',
            'end_users' => 'required',
            'total_staff' => 'required',
            'sales_geography_type' => 'required',
            'positions' => 'required'
        );

        //validate
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        //save a new loan
        $user = Auth::user();
        $input = Input::all();
        $input['user_id'] = $user->id;
        $loanId = $input['loanId'];
        if(empty($loanId)){
            $loanId = null;
        }

        if(!isset($input['loan_application_id']) || empty($input['loan_application_id'])){
            $input['loan_application_id'] = md5(uniqid(rand(), true));
        }


        $loan = Loan::updateOrCreate(array('id' => $loanId), $input);
        $loan->status = "Pending";

        $positions = $loan->getPositions()->get();
        $formPositionsArr = $input['positions'];

        $dbValuesArr = $positions->lists("position")->all();

        //pass the loan id to the view
        $loanId = $loan->id;
         if(isset($loan)){
             //dd($extraDBValuesArr, $newFormValuesArr);
             //Find out the additional values which are present in the DB, but not in the newly saved form. These values need to be deleted.
             $toDeleteDBValuesArr = array_diff($dbValuesArr, $formPositionsArr);
             //Find out the extra values which are present in the newly saved form. These values need to be inserted
             $newFormValuesArr = array_diff($formPositionsArr, $dbValuesArr);
             //dd($toDeleteDBValuesArr, $newFormValuesArr);
             $toDeletePositionIdsArr = array();

             //For all company positions to be deleted, store their ids in a separate array to be deleted later
             foreach($toDeleteDBValuesArr as $positionName){
                 $toDelete = $positions->where('position',$positionName)->first();
                 if(isset($toDelete)) {
                     $toDeleteId = $toDelete->id;
                     array_push($toDeletePositionIdsArr,$toDeleteId);
                 }
             }

             //For new company positions, create a new object and add it to the positions collection to be saved later
             foreach($newFormValuesArr as $positionName){
                 $companyPosition = new CompanyPosition();
                 $companyPosition->loan_id = $loanId;
                 $companyPosition->position = $positionName;
                 //Add this new position to the company positions collection
                 $positions->push($companyPosition);
             }

             //Delete stale positions if they are present in the deletion array
             if(count($toDeletePositionIdsArr)> 0){//If there are elements to be deleted
                 CompanyPosition::destroy($toDeletePositionIdsArr);
             }
             //Save the upadted positions collection
             if($positions->count()>0){
                 $loan->getPositions()->saveMany($positions->all());
             }
             $loan->save();
         }

        $redirectUrl = 'loans/lap/requirements';
        if(isset($loanId)){

            $redirectUrl = $redirectUrl . '/' . $loanId;
        }

        return Redirect::to($redirectUrl)->withInput();
    }

    /**
     * Display a listing of the resource.
     * @param $loanId
     * @return Response
     */
    public function getRequirements($loanId){

        $formaction = 'Loans\LAPController@postRequirements';
        $subViewType = 'loans.lap._requirements';
        $loan = null;
        $tenureYear = MasterData::tenureYearList();
        $choosenTenureYear =null;

        if(isset($loanId)){
            $loan = Loan::find($loanId);
        }

        return view('loans.lap.createedit', compact('formaction', 'subViewType','loan', 'loanId','tenureYear','choosenTenureYear'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function postRequirements(Request $request){

        $loanId = $request->input('loan_id');
        if(!isset($loanId)){
            return Redirect::to('loans/lap/index');
        }

        $rules = array(
            'loan_amount' => 'required|numeric',
            'loan_tenure' => 'required',
            'monthly_emi' => 'required|numeric',
            'max_additional_emi' => 'required|numeric',
        );

       $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $input = Input::all();
           // $loanId = $input['loanId'];
            $loan = null;
            if(isset($loanId)){
                $loan = Loan::find($loanId);
            }
            $requirements = Loan::updateOrCreate(array('id' => $loanId), $input);
            $requirements->save();
            $redirectUrl = 'loans/lap/collateral';
            if(isset($loanId)){
                $redirectUrl = $redirectUrl . '/' . $loanId;
            }
            return Redirect::to($redirectUrl)->withInput();
        }


    }

    /**
     * Display collateral details
     * @param $loanId
     * @return Response
     */
    public function getCollateral($loanId)
    {
        $states = MasterData::states();
        $propertyTypes = MasterData::propertyTypes();
        $commercialTypes = MasterData::commercialTypes();
        $residentialTypes = MasterData::residentialTypes();
        $landTypes = MasterData::landTypes();
        $ownerList = MasterData::ownerTypeList();
        $relationWithApplicantTypes = MasterData::relationWithApplicantTypes();
        $formaction = 'Loans\LAPController@postCollateral';
        $subViewType = 'loans.lap._collateral';

        $chosenState = null;
        $chosenThirdPartyState=null;
        $loan = null;
        $propertyDetails = null;
        $thirdPartyDetails =null;
        $choosenPropertyName = null;
        $choosenPropertyType = null;
        $choosenApproxValue = null;
        $choosenOwnerList = null;
        $isThirdPartyAddressExist = false;

        if(isset($loanId)){
            $loan = Loan::find($loanId);
            $propertyDetails = PropertyDetails::where('loan_id',$loanId);
            $propertyDetails = $propertyDetails->get()->first();

        }
        if(isset($propertyDetails)){
            $choosenPropertyName = $propertyDetails->property_name;
            $choosenPropertyType = $propertyDetails->property_type;
            $choosenApproxValue = $propertyDetails->approx_value;

        }

       // dd($loan);

        if (isset($loan)) {
            $registeredAddress = $loan->registeredAddress;
            if (isset($registeredAddress)) {
                $chosenState = $registeredAddress->state;
            }
            $thirdpartyAddress = $loan->thirdpartyAddress;
            if (isset($thirdpartyAddress)) {
                $chosenThirdPartyState = $thirdpartyAddress->state;
            }
            if (isset($thirdpartyAddress) && isset($registeredAddress)) {
                $isThirdPartyAddressExist = true;
            }
        }

        return view('loans.lap.createedit', compact('formaction', 'subViewType', 'loanId', 'loan', 'propertyTypes', 'commercialTypes', 'residentialTypes', 'landTypes', 'states', 'relationWithApplicantTypes','chosenState','isThirdPartyAddressExist','chosenThirdPartyState','propertyDetails','choosenPropertyName','choosenPropertyType','choosenApproxValue','ownerList','choosenOwnerList'));
    }

    /**
     * Save collateral details
     *
     * @param Request $request
     * @return Response
     */
    public function postCollateral(Request $request){
        $thirdPartyChecked=0;
        $flag=0;
        $loanId = $request->input('loan_id');
        $propertyType = Input::get('property_type');
        $temp = null;
        //dd($propertyType);
        $input = Input::all();
        for($i=0;$i<count($propertyType);$i++) {
            if($propertyType[$i]!=''){
                $temp = $propertyType[$i];
            }
        }
        $input['property_type'] = $temp;
        //dd($input);
        $rules = array(
            'property_name' => 'required',
            'approx_value' => 'required|numeric',
            'registeredAddress.address1' => 'required',
            'registeredAddress.address2' => 'required',
            'registeredAddress.city' => 'required',
            'registeredAddress.state' => 'required',
            'registeredAddress.pincode' => 'required',
        );
        // For Third Party Details
        $owner = Input::get('owner_type');
        if($owner == 'Third Party'){
            $ownerRules = array(
                'name' => 'required',
                'relationship' => 'required',
                'pan' => 'required',
                'thirdpartyAddress.address1' => 'required',
                'thirdpartyAddress.address2' => 'required',
                'thirdpartyAddress.city' => 'required',
                'thirdpartyAddress.state' => 'required',
                'thirdpartyAddress.pincode' => 'required',
            );
            $rules = array_merge($rules,$ownerRules);
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $thirdPartyChecked=1;

        }
        else{
            $thirdPartyChecked=2;
            //dd($thirdPartyChecked);
        }
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }else {
            $loan = null;
            if(isset($loanId)){
                $loan = Loan::find($loanId);
            }
            $ownerType = Loan::updateOrCreate(array('id' => $loanId), $input);
            $ownerType->save();

            $propertyDetails = PropertyDetails::updateOrCreate(array('loan_id'=>$loanId),$input);
            $propertyDetails->loan_id = $loanId;
            $propertyDetails->save();


            $registeredAddress = Address::updateOrCreate(array('id' => $loan->registered_address_id), $input['registeredAddress']);
            // here registeredAddress() Method not found error
            $loan->registeredAddress()->associate($registeredAddress);
            $loan->save();

            if($thirdPartyChecked==1){
                $thirdPartyDetails = ThirdPartyDetails::updateOrCreate(array('loan_id'=>$loanId),$input);
                $thirdPartyDetails->loan_id = $loan->id;
               // $thirdPartyDetails->property_type = $propertyType;

                if(isset($thirdPartyDetails)){
                    $thirdpartyAddress = Address::updateOrCreate(array('id' => $thirdPartyDetails->third_party_address_id), $input['thirdpartyAddress']);
                    $thirdPartyDetails->getAddress()->associate($thirdpartyAddress);
                }
                $thirdPartyDetails->save();
                $flag=1;

            }elseif($thirdPartyChecked==2){
                $thirdPartyDetails = ThirdPartyDetails::where('loan_id','=',$loanId);
                if(isset($thirdPartyDetails)) {
                   if($flag==1){
                    $dataBaseId = $thirdPartyDetails->get()->first()->id;
                    $dataBaseAddressId = $thirdPartyDetails->get()->first()->third_party_address_id;
                    $deleteRecord = ThirdPartyDetails::where('id', '=', $dataBaseId)->delete();
                    $deleteRecord = Address::where('id', '=', $dataBaseAddressId)->delete();
                    $flag=0;
                   }
                }
            }
            // $loanId = $input['loanId'];
            $redirectUrl = 'loans/lap/existing-lender';
            if(isset($loanId)){
                $redirectUrl = $redirectUrl . '/' . $loanId;
            }
            return Redirect::to($redirectUrl)->withInput();
        }
    }

    /**
     * Display existing lender details
     * @param $loanId
     * @return Response
     */
    public function getExistingLender($loanId){

        $lenderTypes = MasterData::lenderTypes();
        $loanType = MasterData::loanType();
        $tenureYear = MasterData::tenureYearList();
        $choosenTenureYear =null;
        // dd($num_lender);
        $choosenLoan = null;

        $formaction = 'Loans\LAPController@postExistingLender';
        $subViewType = 'loans.lap._existing_lenderdetails';

        $loan = null;

        if(isset($loanId)){
            $loan = Loan::find($loanId);
        }

        $existingLenders = $loan->getLenders()->get();
        $maxLenderRecords = Config::get('constants.CONST_MAX_LENDER');
        $existingLendersCount = $existingLenders->count();
        $newLenderRecordsNum = $maxLenderRecords-$existingLendersCount;
        return view('loans.lap.createedit', compact('formaction', 'subViewType','lenderTypes','loanId', 'loan','loanType','tenureYear', 'existingLendersCount','newLenderRecordsNum', 'existingLenders', 'maxLenderRecords'));
    }

    /**
     * Save existing lender details
     *
     * @param Request $request
     * @return Response
     */
    public function postExistingLender(Request $request){
        $input = Input::all();


        $updateLendersList = (new Collection( $input['lenders'] ))->filter( function ($lender){
            if($lender['process'] == true){
                if(!isset($lender['isDeleted'])) {
                    return true;
                }else if($lender['isDeleted'] != true){
                    return true;
                }
            }
        });

        $deleteLendersList = (new Collection( $input['lenders'] ))->filter( function ($lender){
            if($lender['process'] == true && isset($lender['isDeleted']) && $lender['isDeleted'] == true){
                return true;
            }
        });

        //dd($updateLendersList, $deleteLendersList->lists('id'));

        $loanId = $request->input('loanId');

        if(!isset($loanId)){
            return Redirect::to('loans/lap/index');
        }
        //$isTermCondition=0;
        $rules = array(
            'lender_type' => 'required',
            'name' => 'required',
            'outstanding_amount' => 'required',
            'roi' => 'required',
            'loan_type' => 'required'
        );

        $messages = array();

        $fieldsArr = array();
        $rulesArr = array();
        $messagesArr = array();

        $indexPosition = 0;

        if (!isset($input['terms_condition']) || $input['terms_condition'] != '1') {
            $fieldsArr['terms_condition']='';
            $rulesArr['terms_condition']='required';
            $messagesArr['terms_condition.required']='Please accept the terms & conditions before proceeding.';
        }

        $updateLendersList->each(function ($lender) use (&$fieldsArr, &$rulesArr, &$messagesArr, &$indexPosition){
            $fieldsArr['lender_type'.$indexPosition]=$lender['lender_type'];
            $rulesArr['lender_type'.$indexPosition]='required';
            $messagesArr['lender_type'.$indexPosition.'.required'] ='Existing Lender Details '.($indexPosition+1).' - Lender Details are required.';

            $fieldsArr['name'.$indexPosition]=$lender['name'];
            $rulesArr['name'.$indexPosition]='required';
            $messagesArr['name'.$indexPosition.'.required']='Existing Lender Details '.($indexPosition+1).' - Name is required.';

            $fieldsArr['outstanding_amount'.$indexPosition]=$lender['outstanding_amount'];
            $rulesArr['outstanding_amount'.$indexPosition]='required';
            $messagesArr['outstanding_amount'.$indexPosition.'.required']='Existing Lender Details '.($indexPosition+1).' - Outstanding Amount is required.';

            $fieldsArr['roi'.$indexPosition]=$lender['roi'];
            $rulesArr['roi'.$indexPosition]='required';
            $messagesArr['roi'.$indexPosition.'.required'] = 'Existing Lender Details '.($indexPosition+1).' - ROI is required.';

            $fieldsArr['loan_type'.$indexPosition]=$lender['loan_type'];
            $rulesArr['loan_type'.$indexPosition]='required';
            $messagesArr['loan_type'.$indexPosition.'.required'] = 'Existing Lender Details '.($indexPosition+1).' - Type of Loan is required.';

            if(isset($lender['loan_type'])){
                if($lender['loan_type'] == 'Working Capital'){
                    $fieldsArr['fund_based_limits'.$indexPosition]=$lender['fund_based_limits'];
                    $rulesArr['fund_based_limits'.$indexPosition]='required';
                    $messagesArr['fund_based_limits'.$indexPosition.'.required'] = 'Existing Lender Details '.($indexPosition+1).' - Fund Based Limits are required for Working Capital Loans';

                    $fieldsArr['non_fund_based_limits'.$indexPosition]=$lender['non_fund_based_limits'];
                    $rulesArr['non_fund_based_limits'.$indexPosition]='required';
                    $messagesArr['non_fund_based_limits'.$indexPosition.'.required'] = 'Existing Lender Details '.($indexPosition+1).' - Non-fund Based Limits are required for Working Capital Loans';
                }elseif($lender['loan_type'] == 'Term Loan'){
                    $fieldsArr['tenure'.$indexPosition]=$lender['tenure'];
                    $rulesArr['tenure'.$indexPosition]='required';
                    $messagesArr['tenure'.$indexPosition.'.required'] = 'Existing Lender Details '.($indexPosition+1).' - Tenure is required for Working Capital Loans';

                    $fieldsArr['maturity_date'.$indexPosition]=$lender['maturity_date'];
                    $rulesArr['maturity_date'.$indexPosition]='required';
                    $messagesArr['maturity_date'.$indexPosition.'.required'] = 'Existing Lender Details '.($indexPosition+1).' - Maturity Date is required for Working Capital Loans';

                    $fieldsArr['current_emi'.$indexPosition]=$lender['current_emi'];
                    $rulesArr['current_emi'.$indexPosition]='required';
                    $messagesArr['current_emi'.$indexPosition.'.required'] = 'Existing Lender Details '.($indexPosition+1).' - Current EMI is required for Working Capital Loans';
                }
            }
            $indexPosition++;
        });

        $validator = Validator::make($fieldsArr,$rulesArr, $messagesArr);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }else{
            $loan = null;
            if(isset($loanId)){
                $loan = Loan::find($loanId);
            }

            //Loop through each lender to be updated and update it in the db
            $updateLendersList->each(function ($lender) use (&$loan){
                //dd( $lender['id']);
                //Data is already validated. Just remove unrequired additional data based on loan_type
                if(isset($lender['loan_type'])) {
                    //Ensure that the below fields are empty before saving to db
                    if ($lender['loan_type'] == 'Working Capital') {
                        $lender['tenure']=null;
                        $lender['maturity_date']=null;
                        $lender['current_emi']=null;
                    }else if ($lender['loan_type'] == 'Term Loan') {
                        $lender['fund_based_limits']=null;
                        $lender['non_fund_based_limits']=null;
                    }
                }

                $lenderDetails = ExistingLenders::updateOrCreate(array('id' => $lender['id']), $lender);
            });

            //Delete user deleted records
            if($deleteLendersList->count() > 0){
                ExistingLenders::destroy($deleteLendersList->lists('id'))->all();
            }
        }

        $redirectUrl = 'loans/lap/balancesheet-details';
        if(isset($loanId)){
            $redirectUrl = $redirectUrl . '/' . $loanId;
        }
        return Redirect::to($redirectUrl)->withInput();
    }

    /**
     * Display existing Balance Sheet details
     * @param $loanId
     * @return Response
     */
    public function getBalancesheetDetails($loanId){
        $formaction = 'Loans\LAPController@postBalancesheetDetails';
        $subViewType = 'loans.lap._balancesheet_details';
        $loan = null;
        if(isset($loanId)) {
            $loan = Loan::find($loanId);
        }
        $bl_year = MasterData::BalanceSheet_FY();

       // dd($bl_year);
        //$bl_year = ['FY 2010-11','FY 2011-12','FY 2012-13'];

        return view('loans.lap.createedit', compact('formaction', 'subViewType', 'loan', 'loanId','bl_year'));
    }

    /**
     * Save existing Balance Sheet details
     *
     * @param Request $request
     * @return Response
     */
    public function postBalancesheetDetails(Request $request){
        $loanId = $request->input('loanId');
        if(!isset($loanId)){
            return Redirect::to('loans/lap/index');
        }
        $rules = array(
            'revenue' => 'required',
        );
        $messages = array();
        $customMessage = array(
            'revenue.required' => 'Please Enter Revenue',
        );
        $message = array_merge($messages, $customMessage);
        $validator = Validator::make(Input::all(), $rules, $message);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $redirectUrl = 'loans/lap/pl-details';
        if(isset($loanId)){
            $redirectUrl = $redirectUrl . '/' . $loanId;
        }
        return Redirect::to($redirectUrl)->withInput();
    }

    /**
     * Display existing Profit & Loss details
     *
     *@param $loanId
     * @return Response
     */

    public function getPlDetails($loanId){
        $formaction = 'Loans\LAPController@postPlDetails';
        $subViewType = 'loans.lap._pl_details';
        $loan = null;
        if(isset($loanId)) {
            $loan = Loan::find($loanId);
        }
        return view('loans.lap.createedit', compact('formaction', 'subViewType', 'loan', 'loanId'));

    }

    /**
     * Save existing Balance Sheet details
     *
     * @param Request $request
     *
     * @return Response
     */
    public function postPlDetails(Request $request){
        return Redirect::to('loans/lap/upload-itreturn')->withInput();
    }

    /**
     * Display existing Profit & Loss details
     * @param $loanId
     * @return Response
     */
    public function getUploadItreturn($loanId){
        $formaction = 'Loans\LAPController@postUploadItreturn';
        $subViewType = 'loans.lap._upload_itreturn';
        $user = Auth::user();
        $user_id = $user->id;
        $loan = null;
        $it_return_obj_1 = null;
        $it_return_obj_2 = null;
        $it_return_obj_3 = null;

        if(isset($loanId)) {
            $loan = Loan::find($loanId);
            $it_return_obj_1 = Uploads::where('owner_id', $user_id);
            if(isset($it_return_obj_1)){
                $it_return_obj_1 = $it_return_obj_1->get()[0]->file_name;
            }
            $it_return_obj_2 = Uploads::where('owner_id', $user_id);
            if(isset($it_return_obj_2)){
                $it_return_obj_2 = $it_return_obj_2->get()[1]->file_name;
            }
            $it_return_obj_3 = Uploads::where('owner_id', $user_id);
            if(isset($it_return_obj_3)){
                $it_return_obj_3 = $it_return_obj_3->get()[2]->file_name;
            }
        }
        return view('loans.lap.createedit', compact('formaction', 'subViewType', 'loan', 'loanId', 'it_return_obj_1', 'it_return_obj_2', 'it_return_obj_3'));
    }

    /**
     * Save existing Balance Sheet details
     *
     * @param Request $request
     * @return Response
     */
    public function postUploadItreturn(Request $request) {

        $user = Auth::user();
        $user_id = $user->id; //Obtaining User id

        $loanId = $request->input('loanId');

        $rules = array(
            'it_return_1' => 'required',
        );

        $messages = array();

        $customMessage = array(
            'it_return_1.required' => 'Please Upload IT Return'
        );

        $message = array_merge($messages, $customMessage);

        $validator = Validator::make(Input::all(), $rules, $message);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $redirectUrl = 'loans/lap/promoter-details';
        }

        if(isset($loanId)) {

            if($request->file('it_return_1')) {
                $file = $request->file('it_return_1');
                $fileName = $file->getClientOriginalName();
                $fileType = $file->getClientOriginalExtension();
                $filePath = 'storage/app/'.$user_id.'/'.$fileName;

                // Check if File Exists
                if (Storage::exists('/'.$user_id.'/'.$loanId.'_it_'.$file->getClientOriginalName())) {
                    return Redirect::back()->withErrors('File Already Exists')->withInput();
                } else {
                    Storage::makeDirectory($user_id);
                    Storage::disk('local')->put('/'.$user_id.'/'.$loanId.'_it_'.$file->getClientOriginalName(),  File::get($file));

                    $it_return_obj_1 = Uploads::firstOrCreate(array('owner_id' => $user_id, 'owner_type' => 'loan/sme', 'file_name' => $fileName, 'file_path' => $filePath, 'file_type' => $fileType));

                    $it_return_obj_1->save();
                }
            }
            if($request->file('it_return_2')) {
                $file = $request->file('it_return_2');
                $fileName = $file->getClientOriginalName();
                $fileType = $file->getClientOriginalExtension();
                $filePath = 'storage/app/'.$user_id.'/'.$fileName;

                // Check if File Exists
                if (Storage::exists('/'.$user_id.'/'.$loanId.'_it_'.$file->getClientOriginalName())) {
                    return Redirect::back()->withErrors('File Already Exists')->withInput();
                } else {
                    Storage::makeDirectory($user_id);
                    Storage::disk('local')->put('/'.$user_id.'/'.$loanId.'_it_'.$file->getClientOriginalName(),  File::get($file));

                    $it_return_obj_2 = Uploads::firstOrCreate(array('owner_id' => $user_id, 'owner_type' => 'loan/sme', 'file_name' => $fileName, 'file_path' => $filePath, 'file_type' => $fileType));

                    $it_return_obj_2->save();
                }
            }
            if($request->file('it_return_3')) {
                $file = $request->file('it_return_3');
                $fileName = $file->getClientOriginalName();
                $fileType = $file->getClientOriginalExtension();
                $filePath = 'storage/app/'.$user_id.'/'.$fileName;

                // Check if File Exists
                if (Storage::exists('/'.$user_id.'/'.$loanId.'_it_'.$file->getClientOriginalName())) {
                    return Redirect::back()->withErrors('File Already Exists')->withInput();
                } else {
                    Storage::makeDirectory($user_id);
                    Storage::disk('local')->put('/'.$user_id.'/'.$loanId.'_it_'.$file->getClientOriginalName(),  File::get($file));

                    $it_return_obj_3 = Uploads::firstOrCreate(array('owner_id' => $user_id, 'owner_type' => 'loan/sme', 'file_name' => $fileName, 'file_path' => $filePath, 'file_type' => $fileType));

                    $it_return_obj_3->save();
                }
            }
            $redirectUrl = $redirectUrl . '/' . $loanId;
        }
        return Redirect::to($redirectUrl)->withInput();
    }

    /**
     * Display existing Promoters'/Directors' details
     * @param $loanId
     * @return Response
     */
    public function getPromoterDetails($loanId){
        $formaction = 'Loans\LAPController@postPromoterDetails';
        $subViewType = 'loans.lap._promoter_details';
        $loan = null;
        if(isset($loanId)) {
            $loan = Loan::find($loanId);
        }
        $existingPromoters = $loan->getPromoters()->get();
        $maxPromoters = Config::get('constants.CONST_MAX_PROMOTER');
        $existingPromotersCount = $existingPromoters->count();
        $newPromoterRecordsNum = $maxPromoters-$existingPromotersCount;
        return view('loans.lap.createedit', compact('formaction', 'subViewType', 'loan', 'loanId', 'maxPromoters', 'existingPromoters', 'newPromoterRecordsNum', 'existingPromotersCount'));
    }

    /**
     * Save existing Balance Sheet details
     *
     * @param Request $request
     * @return Response
     */
    public function postPromoterDetails(Request $request){
        $input = Input::all();

        $updatePromotersList = (new Collection( $input['promoters'] ))->filter( function ($promoter){
            if($promoter['process'] == true){
                if(!isset($promoter['isDeleted'])) {
                    return true;
                }else if($promoter['isDeleted'] != true){
                    return true;
                }
            }
        });

        $deletePromotersList = (new Collection( $input['promoters'] ))->filter( function ($promoters){
            if($promoters['process'] == true && isset($promoters['isDeleted']) && $promoters['isDeleted'] == true){
                return true;
            }
        });

        $loanId = $request->input('loanId');
        if(!isset($loanId)){
            return Redirect::to('loans/lap/index');
        }

        /*$rules = array(
            'promoters_name' => 'required',
            'pan_of_promoter' => 'required',
            'director_identification_number' => 'required',
            'no_of_companies_directorship' => 'required'
        );*/

        //$messages = array();

        $fieldsArr = array();
        $rulesArr = array();
        $messagesArr = array();

        $indexPosition = 0;

        $updatePromotersList->each(function ($promoters) use (&$fieldsArr, &$rulesArr, &$messagesArr, &$indexPosition){
            $fieldsArr['promoter_name'.$indexPosition]=$promoters['promoter_name'];
            $rulesArr['promoter_name'.$indexPosition]='required';
            $messagesArr['promoter_name'.$indexPosition.'.required'] ='Promoter/Director Details '.($indexPosition+1).' - Promoters / Directors Name is required.';

            $fieldsArr['pan_of_promoter'.$indexPosition]=$promoters['pan_of_promoter'];
            $rulesArr['pan_of_promoter'.$indexPosition]='required';
            $messagesArr['pan_of_promoter'.$indexPosition.'.required'] ='Promoter/Director Details '.($indexPosition+1).' - PAN of Promoter / Director is required.';

            $fieldsArr['director_identification_number'.$indexPosition]=$promoters['director_identification_number'];
            $rulesArr['director_identification_number'.$indexPosition]='required';
            $messagesArr['director_identification_number'.$indexPosition.'.required'] ='Promoter/Director Details '.($indexPosition+1).' - Director Identification Number is required.';

            $fieldsArr['no_of_companies_directorship'.$indexPosition]=$promoters['no_of_companies_directorship'];
            $rulesArr['no_of_companies_directorship'.$indexPosition]='required';
            $messagesArr['no_of_companies_directorship'.$indexPosition.'.required'] ='Promoter/Director Details '.($indexPosition+1).' - No of Companies directorship is required.';

            $indexPosition++;
        });

        $validator = Validator::make($fieldsArr,$rulesArr, $messagesArr);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $loan = null;
            if(isset($loanId)){
                $loan = Loan::find($loanId);
            }

            //Loop through each promoter to be updated and update it in the db
            $updatePromotersList->each(function ($promoters) use (&$loan){
                $promoterDetails = PromoterDetails::updateOrCreate(array('id' => $promoters['id']), array('promoter_name' => $promoters['promoter_name'], 'pan_of_promoter' => $promoters['pan_of_promoter'], 'director_identification_number' => $promoters['director_identification_number'], 'no_of_companies_directorship' => $promoters['no_of_companies_directorship'], 'loan_id'=> $loan->id));
            });

            if($deletePromotersList->count() > 0){
                ExistingLenders::destroy($deletePromotersList->lists('id'))->all();
            }
        }
        $redirectUrl = 'loans/lap/upload-details';
        if(isset($loanId)){
            $redirectUrl = $redirectUrl . '/' . $loanId;
        }
        return Redirect::to($redirectUrl)->withInput();
    }

    /**
     * Display existing Promoters'/Directors' details
     * @param $loanId
     * @return Response
     */
    public function getUploadDetails($loanId){
        $addressTypes = MasterData::addressProofTypes();
        $formaction = 'Loans\LAPController@postUploadDetails';
        $subViewType = 'loans.lap._upload_details';
        $loan = null;
        if(isset($loanId)) {
            $loan = Loan::find($loanId);
        }
        return view('loans.lap.createedit', compact('formaction', 'subViewType', 'loan', 'loanId', 'addressTypes'));
    }

    /**
     * Save existing Balance Sheet details
     *
     * @param Request $request
     * @return Response
     */
    public function postUploadDetails(Request $request){
        return Redirect::to('home');
    }
}