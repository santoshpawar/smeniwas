<?php
namespace App\Http\Controllers\Loans;

use App\Helpers\ExpressionHelper;
use App\Helpers\Ratios\FinancialModelRecord;
use App\Models\Address;
use App\Models\Business;
use App\Models\Loan\FinancialData\BalanceSheet;
use App\Models\Loan\FinancialData\FinancialGroup;
use App\Models\Loan\FinancialData\ProfitLoss;
use App\Models\Loan\FinancialData\Ratio;
use App\Models\Uploads;
use App\Models\CompanyPosition;
use App\Models\PromoterDetails;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Loan;
use App\Models\MasterData;
use Validator;
use Input;
use App\Models\PropertyDetails;
use App\Models\ThirdPartyDetails;
use App\Helpers\DeletedQuestionsHelper;
use Auth;

use Illuminate\Support\Facades\File;





class NewLAPController extends BaseLoansController
{

    public function __construct()
    {
        //This will ensure that all routes handled by this controller are first authenticated
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * @param $loanId
     * @return Response
     */
    public function getIndex($loanId = null)
    {
        $sales = MasterData::sales();
        $choosenSales = null;
        $userType = MasterData::userType();
        $choosenUserType = null;
        $loanApplicationId = null;
        $productType = MasterData::productTypes();
        $chosenproductType = null;
        $existingCompanyDeails = null;
        $existingCompanyDeailsCount = 0;
        $maxCompanyDetails = Config::get('constants.CONST_MAX_COMPANY_DETAIL');
        $newCompanyDeailsNum = $maxCompanyDetails-$existingCompanyDeailsCount;
        $loan = null;
        if(isset($loanId)){
            $loan = Loan::find($loanId);
            $loanApplicationId = $loan->loan_application_id;
        }
        if(isset($loan)){
            $isDistributed = $loan->isdistributor;
            if($isDistributed == 1){
                $existingCompanyDeails = $loan->getPositions()->get();
                $existingCompanyDeailsCount = $existingCompanyDeails->count();
                $newCompanyDeailsNum = $maxCompanyDetails-$existingCompanyDeailsCount;
            }
        }
        $formaction = 'Loans\NewLAPController@postIndex';
        $subViewType = 'loans.newlap._company_background';
        return view('loans.newlap.createedit', compact('formaction', 'subViewType','loan','loanId','loanApplicationId','sales','choosenSales','userType','choosenUserType','productType','chosenproductType','maxCompanyDetails','existingCompanyDeails','existingCompanyDeailsCount','newCompanyDeailsNum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function postIndex(Request $request)
    {
        $input = Input::all();
         $loan = null;
       // dd(Input::get('end_users'));
        $updateCompanyDetails = (new Collection( $input['company'] ))->filter( function ($company){
            if($company['process'] == true){
                if(!isset($company['isDeleted'])) {
                    return true;
                }else if($company['isDeleted'] != true){
                    return true;
                }
            }
        });
        $deleteCompanyDetails = (new Collection( $input['company'] ))->filter( function ($company){
            if($company['process'] == true && isset($company['isDeleted']) && $company['isDeleted'] == true){
                return true;
            }
        });
        $fieldsArr = array();
        $rulesArr = array();
        $messagesArr = array();
        $indexPosition = 0;

        $fieldsArr['cin_no']=$input['cin_no'];
        $rulesArr['cin_no']='required';
        $messagesArr['cin_no.required']='Cin number is required.';

        $fieldsArr['vat']=$input['vat'];
        $rulesArr['vat']='required';
        $messagesArr['vat.required']='Vat is required.';

        $fieldsArr['service_tax_no'] = $input['service_tax_no'];
        $rulesArr['service_tax_no'] ='required';
        $messagesArr['service_tax_no.required'] = 'Service tax no is required.';

        $fieldsArr['manufacturing_location_no']=$input['manufacturing_location_no'];
        $rulesArr['manufacturing_location_no']='required';
        $messagesArr['manufacturing_location_no.required']='Manufacturing location no is required.';


        $fieldsArr['branches_location_no']=$input['branches_location_no'];
        $rulesArr['branches_location_no']='required';
        $messagesArr['branches_location_no.required']='Branches location no is required.';

        $fieldsArr['key_products_manufactured']=$input['key_products_manufactured'];
        $rulesArr['key_products_manufactured']='required';
        $messagesArr['key_products_manufactured.required']='Key products manufactured is required.';

        $fieldsArr['product_uses' ]= $input['product_uses'];
        $rulesArr['product_uses']='required';
        $messagesArr['product_uses.required']='Product uses is required.';

        $fieldsArr['loan_amount' ]= $input['loan_amount'];
        $rulesArr['loan_amount']='required';
        $messagesArr['loan_amount.required']='Loan Amount is required.';

        $fieldsArr['turnover' ]= $input['turnover'];
        $rulesArr['turnover']='required';
        $messagesArr['turnover.required']='Turnover is required.';

        $fieldsArr['end_users' ]= Input::get('end_users');
        $rulesArr['end_users']='required';
        $messagesArr['end_users.required']='end users is required.';

        $fieldsArr['annual_value_exports']=$input['annual_value_exports'];
        $rulesArr['annual_value_exports']='required';
        $messagesArr['annual_value_exports.required']='Annual value exports is required.';

        $fieldsArr['isdistributor']=$input['isdistributor'];
        $rulesArr['isdistributor']='required';
        $messagesArr['isdistributor.required']='Are you distributor is required.';


        $updateCompanyDetails->each(function ($company) use (&$fieldsArr, &$rulesArr, &$messagesArr, &$indexPosition){
            $fieldsArr['company_name'.$indexPosition]=$company['company_name'];
            $rulesArr['company_name'.$indexPosition]='required';
            $messagesArr['company_name'.$indexPosition.'.required'] ='Company Details '.($indexPosition+1).' - Company Name are required.';

            $fieldsArr['product_name'.$indexPosition] = $company['product_name'];
            $rulesArr['product_name'.$indexPosition]='required';
            $messagesArr['product_name'.$indexPosition.'.required']='Company Details '.($indexPosition+1).' - Product Name is required.';

            $indexPosition++;
        });
        $validator = Validator::make($fieldsArr,$rulesArr, $messagesArr);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        else {
            $user = Auth::user();
            $input['user_id'] = $user->id;
            $loanId = $input['loanId'];
            if(empty($loanId)){
                $loanId = null;
            }
//            if (!isset($input['loan_application_id']) || empty($input['loan_application_id'])) {
//                $input['loan_application_id'] = md5(uniqid(rand(), true));
//            }
            $loan = Loan::updateOrCreate(array('id' => $loanId), $input);
            $loan->status = "Pending";
            $loanId = $loan->id;
            $loan->save();
        }
        if(isset($loanId)){
            $loan = Loan::find($loanId);
        }
        $loanId = $loan->id;
        //Loop through each company detail to be updated and update it in the db
        DB::table('company_positions')->where('loan_id', '=', $loan->id)->delete();
        $isDistributor = $input['isdistributor'];
        if($isDistributor == 1){
            $updateCompanyDetails->each(function ($company) use (&$loan){
                DB::table('company_positions')->insert(
                    ['loan_id' => $loan->id, 'company_name' => $company['company_name'], 'product_name' => $company['product_name'] ]
                );
            });
        }
        //Delete user deleted records
        if($deleteCompanyDetails->count() > 0){
            CompanyPosition::destroy($deleteCompanyDetails->lists('id'))->all();
        }
        $redirectUrl = 'loans/newlap/promoter';
        if(isset($loanId)){
            // dd($loanId);
            $redirectUrl = $redirectUrl . '/' . $loanId;
        }
        return Redirect::to($redirectUrl);
    }

    /**
     * Display a listing of the resource.
     * @param $loanId
     * @return Response
     */
    public function getPromoter($loanId) {
        $promotersGenerationType = MasterData::promoterGenrationType();
        $choosenPromoterGenerationtype = null;
        $noOfFamilyTypes = MasterData::familyType();
        $states = MasterData::states();
        $chosenState = null;

        $choosenFamilyType = null;
        if (isset($loanId)) {
            $loan = Loan::find($loanId);
        }
        $userProfile =  Auth::user()->userProfile;
       //dd($userProfile->owner_name);

        $subViewType = 'loans.newlap._promoter';
        $formaction = 'Loans\NewLAPController@postPromoter';
        $loan = null;
        if (isset($loanId)) {
            $loan = Loan::find($loanId);
            $promoter_details = PromoterDetails::where('loan_id', '=', $loanId)->get();
            @$choosenPromoterGenerationtype = $promoter_details->first()->promoter_type;
            @$choosenFamilyType = $promoter_details->first()->no_of_families;
        }

        $existingPromoters = $loan->getPromoters()->get();
        $maxPromoters = Config::get('constants.CONST_MAX_PROMOTER');
        $existingPromotersCount = $existingPromoters->count();
        $promoter_count = $promoter_details->count();
        $newPromoterRecordsNum = $maxPromoters-$existingPromotersCount;
        $temp_array = array();
        for($i = 0; $i < 5; $i++) {
            if($i < $promoter_details->count()) {
                array_push($temp_array, $promoter_details[$i]->toArray());
            } else {
                array_push($temp_array,"");
            }
        }
        return view('loans.newlap.createedit', compact('formaction', 'subViewType', 'loan', 'loanId', 'maxPromoters', 'existingPromoters', 'newPromoterRecordsNum', 'existingPromotersCount', 'promotersGenerationType', 'choosenPromoterGenerationtype', 'noOfFamilyTypes', 'choosenFamilyType',  'temp_array','promoter_count','userProfile', 'states', 'chosenState'));
    }

    public function postPromoter(Request $request) {
        $input = Input::all();
        $loanId = $request->input('loanId');
        if(!isset($loanId)){
            return Redirect::to('loans/lap/index');
        }
        $fieldsArr = array();
        $rulesArr = array();
        $messagesArr = array();
        $counter = $input['counter_storage'];
        for($i = 0; $i < $counter; $i++){
            $input['assets'] = $i;
            $fieldsArr['name_of_promoter'.$i]=$input['promoters'][$i]['name_of_promoter'];
            $rulesArr['name_of_promoter'.$i]='required';
            $messagesArr['name_of_promoter'.$i.'.required'] ='Promoter Details '.($i+1).' - Name is required.';

            $fieldsArr['din_of_promoter'.$i]=$input['promoters'][$i]['din_of_promoter'];
            $rulesArr['din_of_promoter'.$i]='required';
            $messagesArr['din_of_promoter'.$i.'.required']='Promoter Details '.($i+1).' - Director Identification Number is required.';

            $fieldsArr['pan_of_promoter'.$i]=$input['promoters'][$i]['pan_of_promoter'];
            $rulesArr['pan_of_promoter'.$i]='required|Regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/';
            $messagesArr['pan_of_promoter'.$i.'.required']='Promoter Details '.($i+1).' - PAN is required & Format Should be XXXXX1111X';

            if($counter > 0) {
                $fieldsArr['address'.$i]=$input['promoters'][$i]['address'];
                $rulesArr['address'.$i]='required';
                $messagesArr['address'.$i.'.required'] = 'Promoter Details '.($i+1).' - Address is required.';
            }
        }
        $fieldsArr['assets']=$input['assets'];
        $rulesArr['assets']='required';
        $messagesArr['assets.required']='Assets is required.';

        $fieldsArr['assets_others']=$input['assets_others'];
        $rulesArr['assets_others']='required';
        $messagesArr['assets_others.required']='Other Assets is required.';

        $fieldsArr['summary']=$input['summary'];
        $rulesArr['summary']='required';
        $messagesArr['summary.required']='Summary is required.';

        $fieldsArr['net_worth']=$input['net_worth'];
        $rulesArr['net_worth']='required';
        $messagesArr['net_worth.required']='Net Worth is required.';

        $fieldsArr['promoter_generation_type']=$input['promoter_generation_type'];
        $rulesArr['promoter_generation_type']='required';
        $messagesArr['promoter_generation_type.required']='Promoter Type is required.';

        $fieldsArr['no_of_families']=$input['no_of_families'];
        $rulesArr['no_of_families']='required';
        $messagesArr['no_of_families.required']='Number of Families is required.';

        $validator = Validator::make($fieldsArr,$rulesArr, $messagesArr);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }else{
            $loan = null;
            if(isset($loanId)){
                $loan = Loan::find($loanId);
            }
            DB::table('promoter_details')->where('loan_id', '=', $loan->id)->delete();
            for($i = 0; $i <= $counter; $i++){
                if($counter == 0) {
                    $input['promoters'][0]['address'] = '';
                }
                DB::table('promoter_details')->insert(
                    [
                        'loan_id' => $loan->id,
                        'name_of_promoter' => $input['promoters'][$i]['name_of_promoter'],
                        'din_of_promoter' => $input['promoters'][$i]['din_of_promoter'],
                        'pan_of_promoter' => $input['promoters'][$i]['pan_of_promoter'],
                        'address' => $input['promoters'][$i]['address'],
                        'assets' => $input['assets'],
                        'assets_others' => $input['assets_others'],
                        'summary' => $input['summary'],
                        'net_worth' => $input['net_worth'],
                        'promoter_type' => $input['promoter_generation_type'],
                        'no_of_families' =>$input['no_of_families']
                    ]);

            }
            $redirectUrl = 'loans/newlap/financial';
            if(isset($loanId)){
                $redirectUrl = $redirectUrl . '/' . $loanId;
            }
            return Redirect::to($redirectUrl)->withInput();
        }
    }
    /**
     * Display a listing of the resource.
     * @param $loanId
     * @return Response
     */
    public function getFinancial($loanId) {
        $loan = null;
        if(isset($loanId)){
            $loan = Loan::find($loanId);
        }
        $subViewType = 'loans.newlap._financial';
        $formaction = 'Loans\NewLAPController@postFinancial';
        $bl_year = MasterData::BalanceSheet_FY();

        $tenureYear = MasterData::tenureYearList();
        $choosenTenureYear = null;

        $states = MasterData::states();
        $propertyTypes = MasterData::propertyTypes();
        $commercialTypes = MasterData::commercialTypes();
        $residentialTypes = MasterData::residentialTypes();
        $landTypes = MasterData::landTypes();
        $ownerList = MasterData::ownerTypeList();
        $relationWithApplicantTypes = MasterData::relationWithApplicantTypes();

        $chosenState = null;
        $chosenThirdPartyState=null;
        $propertyDetails = null;
        $thirdPartyDetails =null;
        $thirdpartyAddress = null;
        $choosenPropertyName = null;
        $choosenPropertyType = null;
        $choosenApproxValue = null;
        $choosenOwnerList = null;
        $isThirdPartyAddressExist = false;

        if(isset($loanId)) {
            $propertyDetails = PropertyDetails::where('loan_id',$loanId);
            $propertyDetails = $propertyDetails->get()->first();

            $thirdPartyDetails = ThirdPartyDetails::where('loan_id',$loanId);
            $thirdPartyDetails = $thirdPartyDetails->get()->first();
        }
        if(isset($propertyDetails))
        {
            $choosenPropertyName = $propertyDetails->property_name;
            $choosenPropertyType = $propertyDetails->property_type;
            $choosenApproxValue = $propertyDetails->approx_value;
        }
        if (isset($loan)) {
            $registeredAddress = $loan->registeredAddress;
            if (isset($registeredAddress)) {
                $chosenState = $registeredAddress->state;
            }
            if(isset($thirdPartyDetails)){
                $thirdpartyAddress = Address::where('id','=',$thirdPartyDetails->third_party_address_id);
                if (isset($thirdpartyAddress)) {
                    $thirdpartyAddress = $thirdpartyAddress->get()->first();
                    $chosenThirdPartyState = $thirdpartyAddress->state;
                }
                if (isset($thirdpartyAddress) && isset($registeredAddress)) {
                    $isThirdPartyAddressExist = true;
                }
            }
        }
        //return view('loans.newlap.createedit', compact('subViewType','loan','loanId','formaction','bl_year','tenureYear','choosenTenureYear'));
        return view('loans.newlap.createedit', compact('subViewType','loan','loanId','formaction','bl_year','tenureYear','choosenTenureYear', 'propertyTypes', 'commercialTypes', 'residentialTypes', 'landTypes', 'states', 'relationWithApplicantTypes','chosenState','isThirdPartyAddressExist','chosenThirdPartyState','propertyDetails','choosenPropertyName','choosenPropertyType','choosenApproxValue','ownerList','choosenOwnerList','thirdPartyDetails','thirdpartyAddress'));
    }

    public function postFinancial(Request $request){
        $thirdPartyChecked=0;
        $flag=0;
        $propertyType = Input::get('property_type');
        $input = Input::all();
        $temp = null;
        for($i=0;$i<count($propertyType);$i++) {
            if($propertyType[$i]!=''){
                $temp = $propertyType[$i];
            }
        }
        $input['property_type'] = $temp;
        $loanId = $request->input('loanId');
        $fieldsArr = array();
        $rulesArr = array();
        $messagesArr = array();
        $indexPosition = 0;

        $updateLendersList = (new Collection( $input['financial'] ));

        $updateLendersList->each(function ($financial) use (&$fieldsArr, &$rulesArr, &$messagesArr, &$indexPosition){

            /*$fieldsArr['net_worth'.$indexPosition]=$financial['net_worth'];
            $rulesArr['net_worth'.$indexPosition]='required';
            $messagesArr['net_worth'.$indexPosition.'.required']='Financial Details '.($indexPosition+1).' - Net Worth is required.';

            $fieldsArr['total_debt'.$indexPosition]=$financial['total_debt'];
            $rulesArr['total_debt'.$indexPosition]='required';
            $messagesArr['total_debt'.$indexPosition.'.required']='Financial Details '.($indexPosition+1).' - Total Debt is required.';

            $fieldsArr['term_debt'.$indexPosition]=$financial['term_debt'];
            $rulesArr['term_debt'.$indexPosition]='required';
            $messagesArr['term_debt'.$indexPosition.'.required']='Financial Details '.($indexPosition+1).' - Term Debt is required.';

            $fieldsArr['debtors'.$indexPosition]=$financial['debtors'];
            $rulesArr['debtors'.$indexPosition]='required';
            $messagesArr['debtors'.$indexPosition.'.required']='Financial Details '.($indexPosition+1).' - Debtors Details is required.';

            $fieldsArr['inventory'.$indexPosition]=$financial['inventory'];
            $rulesArr['inventory'.$indexPosition]='required';
            $messagesArr['inventory'.$indexPosition.'.required']='Financial Details '.($indexPosition+1).' - Inventory Details is required.';

            $fieldsArr['creditors'.$indexPosition]=$financial['creditors'];
            $rulesArr['creditors'.$indexPosition]='required';
            $messagesArr['creditors'.$indexPosition.'.required']='Financial Details '.($indexPosition+1).' - Creditors Details is required.';

            $fieldsArr['nfs_assets'.$indexPosition]=$financial['nfs_assets'];
            $rulesArr['nfs_assets'.$indexPosition]='required';
            $messagesArr['nfs_assets'.$indexPosition.'.required']='Financial Details '.($indexPosition+1).' - Net Fixed Assets Details is required.';

            $fieldsArr['revenue'.$indexPosition]=$financial['revenue'];
            $rulesArr['revenue'.$indexPosition]='required';
            $messagesArr['revenue'.$indexPosition.'.required']='Financial Details '.($indexPosition+1).' - Revenue is required.';

            $fieldsArr['op_profit'.$indexPosition]=$financial['op_profit'];
            $rulesArr['op_profit'.$indexPosition]='required';
            $messagesArr['op_profit'.$indexPosition.'.required']='Financial Details '.($indexPosition+1).' - Operating Profit is required.';

            $fieldsArr['interest_expense'.$indexPosition]=$financial['interest_expense'];
            $rulesArr['interest_expense'.$indexPosition]='required';
            $messagesArr['interest_expense'.$indexPosition.'.required']='Financial Details '.($indexPosition+1).' - Interest Expense is required.';

            $fieldsArr['pat'.$indexPosition]=$financial['pat'];
            $rulesArr['pat'.$indexPosition]='required';
            $messagesArr['pat'.$indexPosition.'.required']='Financial Details '.($indexPosition+1).' - PAT Details is required.';
            */
            $indexPosition++;
        });

        $fieldsArr['gross_assets']=$input['gross_assets'];
        $rulesArr['gross_assets']='required';
        $messagesArr['gross_assets.required']='Gross Assets is required.';

        $fieldsArr['gross_value_of_plant']=$input['gross_value_of_plant'];
        $rulesArr['gross_value_of_plant']='required';
        $messagesArr['gross_value_of_plant.required']='Gross Value of plant & Machinery is required.';

        $fieldsArr['loan_amount']=$input['loan_amount'];
        $rulesArr['loan_amount']='required';
        $messagesArr['loan_amount.required']='Loan Requirements Details : Loan Amount is required.';

        $fieldsArr['loan_tenure']=$input['loan_tenure'];
        $rulesArr['loan_tenure']='required';
        $messagesArr['loan_tenure.required']='Loan Requirements Details : Tenure in Year is required.';

        $fieldsArr['monthly_emi']=$input['monthly_emi'];
        $rulesArr['monthly_emi']='required';
        $messagesArr['monthly_emi.required']='Loan Requirements Details : Monthly EMI for existing Loan is required.';

        $fieldsArr['max_additional_emi']=$input['max_additional_emi'];
        $rulesArr['max_additional_emi']='required';
        $messagesArr['max_additional_emi.required']='Loan Requirements Details : Maximum additional EMI Serviceable is required.';

        $fieldsArr['property_name']=$input['property_name'];
        $rulesArr['property_name']='required';
        $messagesArr['property_name.required']='Security being provided : Details of Property is required.';

        $fieldsArr['approx_value']=$input['approx_value'];
        $rulesArr['approx_value']='required';
        $messagesArr['approx_value.required']='Security being provided : Details of Property is required.';


        $fieldsArr['registeredAddress1'] = $input['registeredAddress']['address1'];
        $rulesArr['registeredAddress1']='required';
        $messagesArr['registeredAddress1.required']='Location of Property : Address 1 is required.';

        $fieldsArr['registeredAddress2'] = $input['registeredAddress']['address2'];
        $rulesArr['registeredAddress2']='required';
        $messagesArr['registeredAddress2.required']='Location of Property : Address 2 is required.';

        $fieldsArr['registeredAddress3'] = $input['registeredAddress']['address3'];
        $rulesArr['registeredAddress3']='required';
        $messagesArr['registeredAddress3.required']='Location of Property : Address 3 is required.';

        $fieldsArr['registeredAddressCity'] = $input['registeredAddress']['city'];
        $rulesArr['registeredAddressCity']='required';
        $messagesArr['registeredAddressCity.required']='Location of Property : City is required.';

        $fieldsArr['registeredAddressState'] = $input['registeredAddress']['state'];
        $rulesArr['registeredAddressState']='required';
        $messagesArr['registeredAddressState.required']='Location of Property : State is required.';

        $fieldsArr['registeredAddressPincode'] = $input['registeredAddress']['pincode'];
        $rulesArr['registeredAddressPincode']='required';
        $messagesArr['registeredAddressPincode.required']='Location of Property : Pincode is required.';

        $owner = Input::get('owner_type');
        if($owner == 'Third Party'){

            $fieldsArr['name']=$input['name'];
            $rulesArr['name']='required';
            $messagesArr['name.required']='Third Party Details : Name is required.';

            $fieldsArr['relationship']=$input['relationship'];
            $rulesArr['relationship']='required';
            $messagesArr['relationship.required']='Third Party Details : Relationship with Applicant is required.';

            $fieldsArr['pan']=$input['pan'];
            $rulesArr['pan']='required';
            $messagesArr['pan.required']='Third Party Details : PAN is required.';


            $fieldsArr['thirdpartyAddress1'] = $input['thirdpartyAddress']['address1'];
            $rulesArr['thirdpartyAddress1']='required';
            $messagesArr['thirdpartyAddress1.required']='Third Party Details : Address 1 is required.';

            $fieldsArr['thirdpartyAddress2'] = $input['thirdpartyAddress']['address2'];
            $rulesArr['thirdpartyAddress2']='required';
            $messagesArr['thirdpartyAddress2.required']='Third Party Details : Address 2 is required.';

            $fieldsArr['thirdpartyAddress3'] = $input['thirdpartyAddress']['address3'];
            $rulesArr['thirdpartyAddress3']='required';
            $messagesArr['thirdpartyAddress3.required']='Third Party Details : Address 3 is required.';

            $fieldsArr['thirdpartyAddressCity'] = $input['thirdpartyAddress']['city'];
            $rulesArr['thirdpartyAddressCity']='required';
            $messagesArr['thirdpartyAddresssCity.required']='Third Party Details : City is required.';

            $fieldsArr['thirdpartyAddressState'] = $input['thirdpartyAddress']['state'];
            $rulesArr['thirdpartyAddressState']='required';
            $messagesArr['thirdpartyAddressState.required']='Third Party Details : State is required.';

            $fieldsArr['thirdpartyAddressPincode'] = $input['thirdpartyAddress']['pincode'];
            $rulesArr['thirdpartyAddressPincode']='required';
            $messagesArr['thirdpartyAddressPincode.required']='Third Party Details : Pincode is required.';

            $thirdPartyChecked=1;
        }else{
            $thirdPartyChecked=2;
        }
        $validator = Validator::make($fieldsArr,$rulesArr, $messagesArr);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }else{
            $loan = null;
            if(isset($loanId)){
                $loan = Loan::find($loanId);
                $gross_assets = $input['gross_assets'];
                //$loan_details = $input['loan_details'];
                DB::table('financials')->where('loan_id', '=', $loan->id)->delete();
                //Loop through each lender to be updated and update it in the db
                $updateLendersList->each(function ($financial) use (&$loan, &$gross_assets, &$loan_details){
                    DB::table('financials')->insert(
                        ['loan_id' => $loan->id, 'net_worth' => $financial['net_worth'], 'total_debt' => $financial['total_debt'], 'term_debt' => $financial['term_debt'], 'debtors' => $financial['debtors'], 'inventory' => $financial['inventory'], 'creditors' => $financial['creditors'], 'nfs_assets' => $financial['nfs_assets'], 'revenue' => $financial['revenue'], 'op_profit' => $financial['op_profit'], 'interest_expense' => $financial['interest_expense'], 'pat' => $financial['pat'], 'gross_assets' => $gross_assets, 'loan_details' => $loan_details ]
                    );
                });
                $requirements = Loan::updateOrCreate(array('id' => $loanId), $input);
                $requirements->save();

                $propertyDetails = PropertyDetails::updateOrCreate(array('loan_id'=>$loanId),$input);
                $propertyDetails->loan_id = $loanId;
                $propertyDetails->save();

                $registeredAddress = Address::updateOrCreate(array('id' => $loan->registered_address_id), $input['registeredAddress']);
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
                    $flag = 1;

                }else if($thirdPartyChecked==2){
                    $thirdPartyDetails = ThirdPartyDetails::where('loan_id','=',$loanId);
                    if(isset($thirdPartyDetails)) {
                        $dataBaseAddressId = $thirdPartyDetails->get()->first()->third_party_address_id;
                        $dataBaseId = $thirdPartyDetails->get()->first()->id;

                        $deleteRecord = ThirdPartyDetails::where('id', '=', $dataBaseId);
                        $deleteRecord->delete();

                        $deleteAddressRecord = Address::where('id', '=', $dataBaseAddressId);
                        $deleteAddressRecord->delete();
                    }
                }
                $redirectUrl = 'loans/newlap/business';
                $redirectUrl = $redirectUrl . '/' . $loanId;
            }
            return Redirect::to($redirectUrl)->withInput();
        }
    }

    public function getBusiness($loanId){
        $companyPositionTypes = MasterData::companyPositionTypes();
        $chosenCompanyPositionTypes= array();

        $loan = null;
        if(isset($loanId)){
            $loan = Loan::find($loanId);
            $chosenCompanyPositionTypes = CompanyPosition::where('loan_id','=', $loanId)->get()->lists('position')->all();
            @$business_object = Business::where('loan_id', '=', $loanId)->get()->first();
        }
        
        $helper = new DeletedQuestionsHelper($loan);
        $subViewType = 'loans.newlap._business';
        $formaction = 'Loans\NewLAPController@postBusiness';
        $purchasedEquipmentTypes = MasterData::purchasedEquipmentTypes();
        $maxCustomers = 5;
        return view('loans.newlap.createedit', compact('subViewType','loan','loanId','formaction', 'business_object', 'helper','companyPositionTypes','chosenCompanyPositionTypes','maxCustomers', 'purchasedEquipmentTypes'));
    }
    public function postBusiness(Request $request)
    {
        $input = Input::all();
        $loanId = $request->input('loanId');
        $loan = null;
        if(isset($loanId)){
            $loan = Loan::find($loanId);
        }
        $helper = new DeletedQuestionsHelper($loan);

        if($input['office_premise_type'] == ''){
            $office_premise_rules_1 = array(
                'office_premise_type' => 'required'
            );
            $office_premise_rules_1_message = array(
                'approx_value.required' => 'Select Office Premise Type'
            );
        }else if($input['office_premise_type'] == 0) {
            $office_premise_rules_1 = array(
                'approx_value' => 'required'
            );
            $office_premise_rules_1_message = array(
                'approx_value.required' => 'Approximate Value of Office Premise is Required'
            );
        } else if($input['office_premise_type'] == 1) {
            $office_premise_rules_1 = array(
                'monthly_rent' => 'required'
            );
            $office_premise_rules_1_message = array(
                'monthly_rent.required' => 'Monthly Rent is Required'
            );
        }
        if($input['manufacturing_premise'] == ''){
            $office_premise_rules_2 = array(
                'manufacturing_premise' => 'required'
            );
            $office_premise_rules_2_message = array(
                'manufacturing_premise.required' => 'Select Manufacturing Premise'
            );
        }else if($input['manufacturing_premise'] == 0) {
            $office_premise_rules_2 = array(
                'approx_value_of_land' => 'required'
            );
            $office_premise_rules_2_message = array(
                'approx_value_of_land.required' => 'Approximate Land Value is required'
            );
        }else if($input['manufacturing_premise'] == 1) {
            $office_premise_rules_2 = array();
            $office_premise_rules_2_message = array();
        }

        if($input['long_term_contracts'] == '1') {
            $office_premise_rules_3 = array(
                'long_term_contract_customer_name'=> 'required',
                'long_term_contract_sale_annual_value' => 'required'
            );
            $office_premise_rules_3_message = array(
                'long_term_contract_customer_name.required'=> 'Customer Name is required',
                'long_term_contract_sale_annual_value.required' => 'Sale Annual Value is required'
            );
        } /*elseif($input['que24_longtcontract'] == '0') {
            $office_premise_rules_3 = array( );
            $office_premise_rules_3_message = array();
        }*/
        if($input['geographical_area'] ==''){
            $geographical_area = array(
                'geographical_area' =>'required',
            );
        }else if($input['geographical_area'] ==0){
            $geographical_area = array(
                'city_name' =>'required',
            );
        }else if($input['geographical_area'] ==1){
            $geographical_area = array(
                'city_name_1' =>'required',
                'city_name_2' =>'required',
                'city_name_3' =>'required',
            );
        }
        else if($input['geographical_area'] ==2){
            $geographical_area = array(
                'state_name_1' =>'required',
                'state_name_2' =>'required',
                'state_name_3' =>'required',
            );
        }
        if($input['sourced'] == 0){
            $sourced = array(
                'invoice_cif_in_lacs'=>'required',
                'custom_duty'=>'required',
                'invoice_cif_in_usd'=>'required',
            );
        }else if($input['sourced'] == 1){
            $sourced = array(
                'invoice_value' => 'required',
            );
        }



        $office_premise_rules_4 = array(
            'customer_name_1' => 'required',
            'customer_sale_amount_1' => 'required',
            'customer_name_2' => 'required',
            'customer_sale_amount_2' => 'required',
            'customer_name_3' => 'required',
            'customer_sale_amount_3' => 'required',
            'customer_sale_relationship' => 'required',
            'supplier_name_1' => 'required',
            'supplier_amount_1' => 'required',
            'supplier_name_2' => 'required',
            'supplier_amount_2' => 'required',
            'supplier_name_3' => 'required',
            'supplier_amount_3' => 'required',
            'names_of_competitors' => 'required',
            'positions' => 'required',
           // 'geographical_area' => 'required',
            'security_offered' => 'required',
            'years_of_relationship_with_companies' => 'required',
            'monthly_sales_month_year_1' => 'required',
            'monthly_sales_amount_1' => 'required',
            'monthly_sales_month_year_2' => 'required',
            'monthly_sales_amount_2' => 'required',
            'monthly_sales_month_year_3' => 'required',
            'monthly_sales_amount_3' => 'required',
            'monthly_sales_month_year_4' => 'required',
            'monthly_sales_amount_4' => 'required',
            'monthly_sales_month_year_5' => 'required',
            'monthly_sales_amount_5' => 'required',
            'monthly_sales_month_year_6' => 'required',
            'monthly_sales_amount_6' => 'required',
            'current_invoice' => 'required',
            'type_of_equipment' => 'required',
            'equipment_discription'=>'required',
            'sourced' => 'required',
            'name_of_manufacturer' => 'required',
            'date_manufacturer'=>'required',
            //'year_of_manufacture' => 'required',
            'contract_executed' => 'required',
            'amount_dec_1' => 'required',
            'amount_sep_1' => 'required',
            'ageing_1_dec_1' => 'required',
            'ageing_1_sep_1' => 'required',
            'ageing_2_dec_1' => 'required',
            'ageing_2_sep_1' => 'required',
            'ageing_3_dec_1' => 'required',
            'ageing_3_sep_1' => 'required',
            'amount_dec_2' => 'required',
            'amount_sep_2' => 'required',
            'ageing_1_dec_2' => 'required',
            'ageing_1_sep_2' => 'required',
            'ageing_2_dec_2' => 'required',
            'ageing_2_sep_2' => 'required',
            'ageing_3_dec_2' => 'required',
            'ageing_3_sep_2' => 'required',
            'amount_dec_3' => 'required',
            'amount_sep_3' => 'required',
            'ageing_1_dec_3' => 'required',
            'ageing_1_sep_3' => 'required',
            'ageing_2_dec_3' => 'required',
            'ageing_2_sep_3' => 'required',
            'ageing_3_dec_3' => 'required',
            'ageing_3_sep_3' => 'required',
        );

        $office_premise_rules_4_message = array(
            'customer_name_1.required' => 'First Customer Name is Required',
            'customer_sale_amount_1.required' => 'First Customer Sale Amount is Required',
            'customer_name_2.required' => 'Second Customer Name is Required',
            'customer_sale_amount_2.required' => 'Second Customer Sale Amount is Required',
            'customer_name_3.required' => 'Third Customer Name is Required',
            'customer_sale_amount_3.required' => 'Third Customer Sale Amount is Required',
            'customer_sale_relationship.required' => 'Customer Sale Relationship is Required',
            'supplier_name_1.required' => 'First Supplier Name is Required',
            'supplier_amount_1.required' => 'First Supplier Amount is Required',
            'supplier_name_2.required' => 'Second Supplier Name is Required',
            'supplier_amount_2.required' => 'Second Supplier Amount is Required',
            'supplier_name_3.required' => 'Third Supplier Name is Required',
            'supplier_amount_3.required' => 'Third Supplier Amount is Required',
            'names_of_competitors.required' => 'Names of Competitors is Required',
            'positions.required.required' => 'Position in Company is Required',
           // 'geographical_area.required' => 'Geographical Area is Required',
            'security_offered.required' => 'Security Offered is Required',
            'years_of_relationship_with_companies.required' => 'Years of Relationship with companies is required',
            'monthly_sales_month_year_1.required' => 'Month and Year of First Monthly sales is required',
            'monthly_sales_amount_1.required' => 'First Monthly Sales Amount is Required',
            'monthly_sales_month_year_2.required' => 'Month and Year of Second Monthly sales is required',
            'monthly_sales_amount_2.required' => 'Second Monthly Sales Amount is Required',
            'monthly_sales_month_year_3.required' => 'Month and Year of Third Monthly sales is required',
            'monthly_sales_amount_3.required' => 'Third Monthly Sales Amount is Required',
            'monthly_sales_month_year_4.required' => 'Month and Year of Fourth Monthly sales is required',
            'monthly_sales_amount_4.required' => 'Fourth Monthly Sales Amount is Required',
            'monthly_sales_month_year_5.required' => 'Month and Year of Fifth Monthly sales is required',
            'monthly_sales_amount_5.required' => 'Fifth Monthly Sales Amount is Required',
            'monthly_sales_month_year_6.required' => 'Month and Year of Sixth Monthly sales is required',
            'monthly_sales_amount_6.required' => 'Sixth Monthly Sales Amount is Required',
            'current_invoice.required' => 'Current Invoice is Required',
            'type_of_equipment.required' => 'Type of Equipment is Required',
            'equipment_discription.required'=>'Description of Equipment is Required',
            'name_of_manufacturer.required' => 'Name of Manufacturer is Required',
           // 'invoice_value.required' => 'Invoice Value is Required',
           // 'year_of_manufacture.required' => 'Year of Manufacture is Required',
            'contract_executed.required' => 'Contract Executed is required',
            'amount_dec_1.required' => 'Debtor1 QE Dec 14 Field is required',
            'amount_sep_1.required' => 'Debtor1 QE Sep 14 Field is required',
            'ageing_1_dec_1.required' => 'Debtor1 Ageing QE Dec 14 upto 90 days Field is required',
            'ageing_1_sep_1.required' => 'Debtor1 Ageing QE Sep 14 upto 90 days Field is required',
            'ageing_2_dec_1.required' => 'Debtor1 Ageing QE Dec 14 90-180 days Field is required',
            'ageing_2_sep_1.required' => 'Debtor1 Ageing QE Sep 14 90-180 days Field is required',
            'ageing_3_dec_1.required' => 'Debtor1 Ageing QE Sep 14 upto 90 days Field is required',
            'ageing_3_sep_1.required' => 'Debtor1 Ageing QE Sep 14 90-180 days Field is required',

            'amount_dec_2.required'   => 'Debtor2 Ageing QE Dec 14 upto 90 days Field is required',
            'amount_sep_2.required'   => 'Debtor2 Ageing QE Sep 14 upto 90 days Field is required',
            'ageing_1_dec_2.required' => 'Debtor2 Ageing QE Dec 14 90-180 days Field is required',
            'ageing_1_sep_2.required' => 'Debtor2 Ageing QE Sep 14 90-180 days Field is required',
            'ageing_2_dec_2.required' => 'Debtor2 Ageing QE Sep 14 upto 90 days Field is required',
            'ageing_2_sep_2.required' => 'Debtor2 Ageing QE Sep 14 90-180 days Field is required',

            'ageing_3_dec_2.required' =>'Debtor2 Ageing QE Dec 14 upto 90 days Field is required',
            'ageing_3_sep_2.required' => 'Debtor2 Ageing QE Sep 14 upto 90 days Field is required',
            'amount_dec_3.required' => 'Debtor2 Ageing QE Dec 14 90-180 days Field is required',
            'amount_sep_3.required' => 'Debtor2 Ageing QE Sep 14 90-180 days Field is required',

            'ageing_1_dec_3.required' => 'required',
            'ageing_1_sep_3.required' => 'required',
            'ageing_2_dec_3.required' => 'required',
            'ageing_2_sep_3.required' => 'required',
            'ageing_3_dec_3.required' => 'required',
            'ageing_3_sep_3.required' => 'required',
        );

        $rules = array_merge($office_premise_rules_1, $office_premise_rules_2,$office_premise_rules_4,$geographical_area,$sourced);
        $messages = array_merge($office_premise_rules_1_message, $office_premise_rules_2_message , $office_premise_rules_4_message);

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $temp = null;


            $business_details = Business::updateOrCreate(array('loan_id' => $loanId), $input);
            if($input['geographical_area'] == 0){

                $business_details->city_name_1 = null;
                $business_details->city_name_2 = null;
                $business_details->city_name_3 = null;
                $business_details->state_name_1 = null;
                $business_details->state_name_2 = null;
                $business_details->state_name_3 = null;

            }else if($input['geographical_area'] ==1){

                $business_details->state_name_1 = null;
                $business_details->state_name_2 = null;
                $business_details->state_name_3 = null;
                $business_details->city_name = null;
            }
            else if($input['geographical_area'] ==2){

                $business_details->city_name_1 = null;
                $business_details->city_name_2 = null;
                $business_details->city_name_3 = null;
                $business_details->city_name = null;
            }
            if($input['sourced'] == 0){
                $business_details->invoice_value = null;
            }else if($input['sourced'] == 1){
                $business_details->invoice_cif_in_lacs=null;
               $business_details->custom_duty = null;
               $business_details->invoice_cif_in_usd =null;
            }
            $business_details->save();

            $positions = $loan->getPositions()->get();
            $formPositionsArr = $input['positions'];

            $dbValuesArr = $positions->lists("position")->all();
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


            $redirectUrl = 'loans/newlap/uploaddoc/'.$loanId;
            return Redirect::to($redirectUrl);
        }

    }
    public function getUploaddoc($loanId) {
        $loan = null;
        if(isset($loanId)){
            $loan = Loan::find($loanId);
        }
        $subViewType = 'loans.newlap._upload_doc';
        $formaction = 'Loans\NewLAPController@postUploaddoc';
        $bl_year = MasterData::BalanceSheet_FY();
        $addressTypes = MasterData::addressProofTypes();

        $user = Auth::user();
        $user_id = $user->id;

        $upload_doc = null;
        $blplfile = null;
        $kycdocument_file = null;
        $pan_promoter_file = null;
        $proof_address_file = null;
        $bankstatement_file = null;
        $cibilreport_file = null;
        $visitingcard_file = null;
        $promoternetworth_file = null;
        $propertypapers_file = null;
        $corporate_file = null;
        $networthcertificate_file = null;
        $otherdocument_file = null;
        $ecommercesupply_file = null;

        if(isset($loanId))
        {
            $loan = Loan::find($loanId);
            $upload_doc = Uploads::where('owner_id', $user_id);

            if($upload_doc->count() > 0 && isset($upload_doc))
            {
                // dd($it_return_obj_1->count());
                for($i=0; $i < ($upload_doc->count()); $i++)
                {
                    /*foreach ($bl_year as $blyear)
                    {
                        $fileType = 'B/L'.$blyear;
                        if ($upload_doc->get()[$i]->file_type == $fileType) {
                            $blplfile = $upload_doc->get()[$i]->file_name;
                        }

                    }*/

                    if ($upload_doc->get()[$i]->file_type == "KYC Document")
                    {
                        $kycdocument_file = $upload_doc->get()[$i]->file_name;
                    }

                    if ($upload_doc->get()[$i]->file_type == "Pan Card") {
                        $pan_promoter_file = $upload_doc->get()[$i]->file_name;
                    }

                    if ($upload_doc->get()[$i]->file_type == "Address Proof") {
                        $proof_address_file = $upload_doc->get()[$i]->file_name;
                    }

                    if ($upload_doc->get()[$i]->file_type == "Bank Statement") {
                        $bankstatement_file = $upload_doc->get()[$i]->file_name;
                    }

                    if ($upload_doc->get()[$i]->file_type == "Cibil Report") {
                        $cibilreport_file = $upload_doc->get()[$i]->file_name;
                    }

                    if ($upload_doc->get()[$i]->file_type == "Visiting Card") {
                        $visitingcard_file = $upload_doc->get()[$i]->file_name;
                    }

                    if ($upload_doc->get()[$i]->file_type == "Promoter Networth") {
                        $promoternetworth_file = $upload_doc->get()[$i]->file_name;
                    }

                    if ($upload_doc->get()[$i]->file_type == "Property Papers") {
                        $propertypapers_file = $upload_doc->get()[$i]->file_name;
                    }


                    if ($upload_doc->get()[$i]->file_type == "Corporate Profile") {
                        $corporate_file = $upload_doc->get()[$i]->file_name;
                    }

                    if ($upload_doc->get()[$i]->file_type == "Networth Certificate") {
                        $networthcertificate_file = $upload_doc->get()[$i]->file_name;
                    }


                    if ($upload_doc->get()[$i]->file_type == "Other Documents") {
                        $otherdocument_file = $upload_doc->get()[$i]->file_name;
                    }

                    if ($upload_doc->get()[$i]->file_type == "Ecommerce Documents") {
                        $ecommercesupply_file = $upload_doc->get()[$i]->file_name;
                    }
                }
            }
        }

        return view('loans.newlap.createedit', compact('subViewType','loan','loanId','formaction','bl_year','addressTypes', 'kycdocument_file','pan_promoter_file','proof_address_file','bankstatement_file','cibilreport_file','visitingcard_file','promoternetworth_file','propertypapers_file','corporate_file','networthcertificate_file','otherdocument_file','ecommercesupply_file'));
    }

    public function postUploaddoc(Request $request){
        $user = Auth::user();
        $user_id = $user->id; //Obtaining User id
        $loanId = $request->input('loanId');
        $input = Input::all();


        /*'blpl_file_' => 'required',*/
        /*$rules = array(
            'kycdocument_file' => 'required',
            'pan_promoter' => 'required',
            'proof_address' => 'required',
            'proof_address_file' => 'required',
            'bankstatement_file' => 'required',
            'cibilreport_file' => 'required',
            'visitingcard_file' => 'required',
            'promoternetworth_file' => 'required',
            'propertypapers_file' => 'required',
            'corporate_file' => 'required',
            'networthcertificate_file' => 'required',
            'otherdocument_file' => 'required',
            'ecommercesupply_file' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);*/



        /* $fieldsArr = array();
         $rulesArr = array();
         $messagesArr = array();

         $fieldsArr['kycdocument_file'] = $input['kycdocument_file'];
         $rulesArr['kycdocument_file']='required';
         $messagesArr['kycdocument_file.required']='KYC Document is required.';

         $fieldsArr['bankstatement_file'] = $input['bankstatement_file'];
         $rulesArr['bankstatement_file']='required';
         $messagesArr['bankstatement_file.required']='KYC Document is required.';

         $validator = Validator::make($fieldsArr,$rulesArr, $messagesArr);*/



        /*if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }*/

        if(isset($loanId))
        {

            $bl_year = MasterData::BalanceSheet_FY();
            foreach ($bl_year as $blyear)
            {
                $file_tmp = 'blpl_file_'.$blyear;
                if ($request->file($file_tmp))
                {
                    $file = $request->file($file_tmp);
                    $fileName = 'blsheet_'.$blyear.'_'.$file->getClientOriginalName();
                    $fileType = 'B/L'.$blyear; //$file->getClientOriginalExtension();
                    $filePath = 'storage/app/' . $user_id . '/' . $fileName;
                    $fileStorageType = Config::get('constants.CONST_FILE_STORAGE_TYPE');
                    // Check if File Exists
                    if (Storage::exists('/' . $user_id . '/' . $fileName))
                    {
                        return Redirect::back()->withErrors('File Already Exists')->withInput();
                    }
                    else
                    {
                        Storage::makeDirectory($user_id);
                        Storage::disk($fileStorageType)->put('/' . $user_id . '/' . $fileName,  File::get($file));
                        $it_return_obj_1 = Uploads::firstOrCreate(array('owner_id' => $user_id, 'owner_type' => 'loan/sme', 'file_name' => $fileName, 'file_path' => $filePath, 'file_type' => $fileType));
                        $it_return_obj_1->save();
                    }
                }
            }

            if ($request->file('kycdocument_file'))
            {
                $file = $request->file('kycdocument_file');
                $fileName = 'kyc_'.$file->getClientOriginalName();
                $fileType = 'KYC Document'; //$file->getClientOriginalExtension();
                $filePath = 'storage/app/' . $user_id . '/' . $fileName;
                $fileStorageType = Config::get('constants.CONST_FILE_STORAGE_TYPE');
                // Check if File Exists
                if (Storage::exists('/' . $user_id . '/' . $fileName))
                {
                    return Redirect::back()->withErrors('File Already Exists')->withInput();
                }
                else
                {
                    Storage::makeDirectory($user_id);
                    Storage::disk($fileStorageType)->put('/' . $user_id . '/' . $fileName,  File::get($file));
                    $it_return_obj_1 = Uploads::firstOrCreate(array('owner_id' => $user_id, 'owner_type' => 'loan/sme', 'file_name' => $fileName, 'file_path' => $filePath, 'file_type' => $fileType));
                    $it_return_obj_1->save();
                }
            }
            if ($request->file('pan_promoter_file'))
            {
                $file = $request->file('pan_promoter_file');
                $fileName = 'panc_'.$file->getClientOriginalName();
                $fileType = 'Pan Card'; //$file->getClientOriginalExtension();
                $filePath = 'storage/app/' . $user_id . '/' . $fileName;
                $fileStorageType = Config::get('constants.CONST_FILE_STORAGE_TYPE');
                // Check if File Exists
                if (Storage::exists('/' . $user_id . '/' . $fileName))
                {
                    return Redirect::back()->withErrors('File Already Exists')->withInput();
                }
                else
                {
                    Storage::makeDirectory($user_id);
                    Storage::disk($fileStorageType)->put('/' . $user_id . '/' . $fileName,  File::get($file));
                    $it_return_obj_1 = Uploads::firstOrCreate(array('owner_id' => $user_id, 'owner_type' => 'loan/sme', 'file_name' => $fileName, 'file_path' => $filePath, 'file_type' => $fileType));
                    $it_return_obj_1->save();
                }
            }

            if ($request->file('proof_address_file'))
            {
                $file = $request->file('proof_address_file');
                $fileName = 'adproof_'.$file->getClientOriginalName();
                $fileType = 'Address Proof'; //$file->getClientOriginalExtension();
                $filePath = 'storage/app/' . $user_id . '/' . $fileName;
                $fileStorageType = Config::get('constants.CONST_FILE_STORAGE_TYPE');
                // Check if File Exists
                if (Storage::exists('/' . $user_id . '/' . $fileName))
                {
                    return Redirect::back()->withErrors('File Already Exists')->withInput();
                }
                else
                {
                    Storage::makeDirectory($user_id);
                    Storage::disk($fileStorageType)->put('/' . $user_id . '/' . $fileName,  File::get($file));
                    $it_return_obj_1 = Uploads::firstOrCreate(array('owner_id' => $user_id, 'owner_type' => 'loan/sme', 'file_name' => $fileName, 'file_path' => $filePath, 'file_type' => $fileType));
                    $it_return_obj_1->save();
                }
            }
            if ($request->file('bankstatement_file'))
            {
                $file = $request->file('bankstatement_file');
                $fileName = 'bnk_'.$file->getClientOriginalName();
                $fileType = 'Bank Statement'; //$file->getClientOriginalExtension();
                $filePath = 'storage/app/' . $user_id . '/' . $fileName;
                $fileStorageType = Config::get('constants.CONST_FILE_STORAGE_TYPE');
                // Check if File Exists
                if (Storage::exists('/' . $user_id . '/' . $fileName))
                {
                    return Redirect::back()->withErrors('File Already Exists')->withInput();
                }
                else
                {
                    Storage::makeDirectory($user_id);
                    Storage::disk($fileStorageType)->put('/' . $user_id . '/' . $fileName,  File::get($file));
                    $it_return_obj_1 = Uploads::firstOrCreate(array('owner_id' => $user_id, 'owner_type' => 'loan/sme', 'file_name' => $fileName, 'file_path' => $filePath, 'file_type' => $fileType));
                    $it_return_obj_1->save();
                }
            }
            if ($request->file('cibilreport_file'))
            {
                $file = $request->file('cibilreport_file');
                $fileName = 'cibil_'.$file->getClientOriginalName();
                $fileType = 'Cibil Report'; //$file->getClientOriginalExtension();
                $filePath = 'storage/app/' . $user_id . '/' . $fileName;
                $fileStorageType = Config::get('constants.CONST_FILE_STORAGE_TYPE');
                // Check if File Exists
                if (Storage::exists('/' . $user_id . '/' . $fileName))
                {
                    return Redirect::back()->withErrors('File Already Exists')->withInput();
                }
                else
                {
                    Storage::makeDirectory($user_id);
                    Storage::disk($fileStorageType)->put('/' . $user_id . '/' . $fileName,  File::get($file));
                    $it_return_obj_1 = Uploads::firstOrCreate(array('owner_id' => $user_id, 'owner_type' => 'loan/sme', 'file_name' => $fileName, 'file_path' => $filePath, 'file_type' => $fileType));
                    $it_return_obj_1->save();
                }
            }
            if ($request->file('visitingcard_file'))
            {
                $file = $request->file('visitingcard_file');
                $fileName = 'vcard_'.$file->getClientOriginalName();
                $fileType = 'Visiting Card'; //$file->getClientOriginalExtension();
                $filePath = 'storage/app/' . $user_id . '/' . $fileName;
                $fileStorageType = Config::get('constants.CONST_FILE_STORAGE_TYPE');
                // Check if File Exists
                if (Storage::exists('/' . $user_id . '/' . $fileName))
                {
                    return Redirect::back()->withErrors('File Already Exists')->withInput();
                }
                else
                {
                    Storage::makeDirectory($user_id);
                    Storage::disk($fileStorageType)->put('/' . $user_id . '/' . $fileName,  File::get($file));
                    $it_return_obj_1 = Uploads::firstOrCreate(array('owner_id' => $user_id, 'owner_type' => 'loan/sme', 'file_name' => $fileName, 'file_path' => $filePath, 'file_type' => $fileType));
                    $it_return_obj_1->save();
                }
            }
            if ($request->file('promoternetworth_file'))
            {
                $file = $request->file('promoternetworth_file');
                $fileName = 'pnetworth_'.$file->getClientOriginalName();
                $fileType = 'Promoter Networth'; //$file->getClientOriginalExtension();
                $filePath = 'storage/app/' . $user_id . '/' . $fileName;
                $fileStorageType = Config::get('constants.CONST_FILE_STORAGE_TYPE');
                // Check if File Exists
                if (Storage::exists('/' . $user_id . '/' . $fileName))
                {
                    return Redirect::back()->withErrors('File Already Exists')->withInput();
                }
                else
                {
                    Storage::makeDirectory($user_id);
                    Storage::disk($fileStorageType)->put('/' . $user_id . '/' . $fileName,  File::get($file));
                    $it_return_obj_1 = Uploads::firstOrCreate(array('owner_id' => $user_id, 'owner_type' => 'loan/sme', 'file_name' => $fileName, 'file_path' => $filePath, 'file_type' => $fileType));
                    $it_return_obj_1->save();
                }
            }
            if ($request->file('propertypapers_file'))
            {
                $file = $request->file('propertypapers_file');
                $fileName = 'property_'.$file->getClientOriginalName();
                $fileType = 'Property Papers'; //$file->getClientOriginalExtension();
                $filePath = 'storage/app/' . $user_id . '/' . $fileName;
                $fileStorageType = Config::get('constants.CONST_FILE_STORAGE_TYPE');
                // Check if File Exists
                if (Storage::exists('/' . $user_id . '/' . $fileName))
                {
                    return Redirect::back()->withErrors('File Already Exists')->withInput();
                }
                else
                {
                    Storage::makeDirectory($user_id);
                    Storage::disk($fileStorageType)->put('/' . $user_id . '/' . $fileName,  File::get($file));
                    $it_return_obj_1 = Uploads::firstOrCreate(array('owner_id' => $user_id, 'owner_type' => 'loan/sme', 'file_name' => $fileName, 'file_path' => $filePath, 'file_type' => $fileType));
                    $it_return_obj_1->save();
                }
            }
            if ($request->file('corporate_file'))
            {
                $file = $request->file('corporate_file');
                $fileName = 'corporat_'.$file->getClientOriginalName();
                $fileType = 'Corporate Profile'; //$file->getClientOriginalExtension();
                $filePath = 'storage/app/' . $user_id . '/' . $fileName;
                $fileStorageType = Config::get('constants.CONST_FILE_STORAGE_TYPE');
                // Check if File Exists
                if (Storage::exists('/' . $user_id . '/' . $fileName))
                {
                    return Redirect::back()->withErrors('File Already Exists')->withInput();
                }
                else
                {
                    Storage::makeDirectory($user_id);
                    Storage::disk($fileStorageType)->put('/' . $user_id . '/' . $fileName,  File::get($file));
                    $it_return_obj_1 = Uploads::firstOrCreate(array('owner_id' => $user_id, 'owner_type' => 'loan/sme', 'file_name' => $fileName, 'file_path' => $filePath, 'file_type' => $fileType));
                    $it_return_obj_1->save();
                }
            }
            if ($request->file('networthcertificate_file'))
            {
                $file = $request->file('networthcertificate_file');
                $fileName = 'netwcert_'.$file->getClientOriginalName();
                $fileType = 'Networth Certificate'; //$file->getClientOriginalExtension();
                $filePath = 'storage/app/' . $user_id . '/' . $fileName;
                $fileStorageType = Config::get('constants.CONST_FILE_STORAGE_TYPE');
                // Check if File Exists
                if (Storage::exists('/' . $user_id . '/' . $fileName))
                {
                    return Redirect::back()->withErrors('File Already Exists')->withInput();
                }
                else
                {
                    Storage::makeDirectory($user_id);
                    Storage::disk($fileStorageType)->put('/' . $user_id . '/' . $fileName,  File::get($file));
                    $it_return_obj_1 = Uploads::firstOrCreate(array('owner_id' => $user_id, 'owner_type' => 'loan/sme', 'file_name' => $fileName, 'file_path' => $filePath, 'file_type' => $fileType));
                    $it_return_obj_1->save();
                }
            }
            if ($request->file('otherdocument_file'))
            {
                $file = $request->file('otherdocument_file');
                $fileName = 'other_'.$file->getClientOriginalName();
                $fileType = 'Other Documents'; //$file->getClientOriginalExtension();
                $filePath = 'storage/app/' . $user_id . '/' . $fileName;
                $fileStorageType = Config::get('constants.CONST_FILE_STORAGE_TYPE');
                // Check if File Exists
                if (Storage::exists('/' . $user_id . '/' . $fileName))
                {
                    return Redirect::back()->withErrors('File Already Exists')->withInput();
                }
                else
                {
                    Storage::makeDirectory($user_id);
                    Storage::disk($fileStorageType)->put('/' . $user_id . '/' . $fileName,  File::get($file));
                    $it_return_obj_1 = Uploads::firstOrCreate(array('owner_id' => $user_id, 'owner_type' => 'loan/sme', 'file_name' => $fileName, 'file_path' => $filePath, 'file_type' => $fileType));
                    $it_return_obj_1->save();
                }
            }
            if ($request->file('ecommercesupply_file'))
            {
                $file = $request->file('ecommercesupply_file');
                $fileName = 'ecommerc_'.$file->getClientOriginalName();
                $fileType = 'Ecommerce Documents'; //$file->getClientOriginalExtension();
                $filePath = 'storage/app/' . $user_id . '/' . $fileName;
                $fileStorageType = Config::get('constants.CONST_FILE_STORAGE_TYPE');
                // Check if File Exists
                if (Storage::exists('/' . $user_id . '/' . $fileName))
                {
                    return Redirect::back()->withErrors('File Already Exists')->withInput();
                }
                else
                {
                    Storage::makeDirectory($user_id);
                    Storage::disk($fileStorageType)->put('/' . $user_id . '/' . $fileName,  File::get($file));
                    $it_return_obj_1 = Uploads::firstOrCreate(array('owner_id' => $user_id, 'owner_type' => 'loan/sme', 'file_name' => $fileName, 'file_path' => $filePath, 'file_type' => $fileType));
                    $it_return_obj_1->save();
                }
            }
        }
        $redirectUrl = 'home';
        return Redirect::to($redirectUrl);
    }

    /**
     * Display a the balance sheet to the analyst
     * @param $loanId
     * @return Response
     */
    public function getAnalystBalanceSheet($loanId){
        $loan =null;
        if(isset($loanId)){
            $loan = Loan::find($loanId);
        }
        $bl_year = MasterData::BalanceSheet_FY();
        $groupType = Config::get('constants.CONST_FIN_GROUP_TYPE_BS');
        $financialGroups = FinancialGroup::with('financialEntries')->where('type','=',$groupType)->where('status','=', 1)->orderBy('sortOrder')->get();

        $financialDataRecords = BalanceSheet::where('loan_id','=',$loanId)->get();
        $financialDataMap = new Collection();

        foreach($financialDataRecords as $financialData){
            $financialDataMap->offsetSet($financialData->period, $financialData);
        }

        $helper = new ExpressionHelper($loanId);
        $financialDataExpressionsMap = $helper->calculateBalanceSheetFormulae();

        $subViewType = 'loans.newlap.financial._analyst_financial_info';
        $formaction = 'Loans\NewLAPController@postAnalystBalanceSheet';

        return view('loans.newlap.createedit', compact('subViewType','loan','loanId','formaction', 'bl_year', 'financialGroups','groupType', 'financialDataExpressionsMap', 'financialDataMap'));
    }

    /**
     * Display a the balance sheet to the analyst
     * @param Request $request
     *
     * @return Response
     */
    public function postAnalystBalanceSheet(Request $request){
        $input = Input::all();
        $loanId =$input['loanId'];

        $tempFinancialsCollection = new Collection( $input['financial']);
        $modelsCollection = $tempFinancialsCollection->map(function($record){
            $recordCollection = new Collection();

            foreach($record as $key => &$value){
                $strVal = trim(strval($value));

                if(strcmp($strVal,"") == 0 || strcmp($strVal, " ") == 0 || strcmp($strVal, "&nbsp") === 0){
                    //dd($key);
                    $strVal = null;
                }

                if(isset($strVal)) {
                    $recordCollection->put($key, $strVal);
                }
            }
            return new FinancialModelRecord($recordCollection->all());
        });

       // dd($input, $tempFinancialsCollection, $modelsCollection);
        $helper = new ExpressionHelper($loanId);
        $financialDataExpressionsMap = $helper->calculateBalanceSheetFormulae($modelsCollection);
        $financialsCollection = $helper->mergeValuesIntoCollection($tempFinancialsCollection, $financialDataExpressionsMap);
        //dd($modelsCollection, $financialDataExpressionsMap, $financialsCollection);


        $fieldsArr = array();
        $rulesArr = array();
        $messagesArr = array();
        $indexPosition = 0;

        $financialsCollection->each(function ($financialRecord) use (&$fieldsArr, &$rulesArr, &$messagesArr, &$indexPosition){
            $period = $financialRecord['period'];


            $fieldsArr['tangible_assets'.$indexPosition]=$financialRecord['tangible_assets'];
            $rulesArr['tangible_assets'.$indexPosition]='numeric';
            $messagesArr['tangible_assets'.$indexPosition.'.numeric'] ='Gross Tangible Assets + WIP for period '.$period.' - should be a valid number.';

            $fieldsArr['depreciation'.$indexPosition]=$financialRecord['depreciation'];
            $rulesArr['depreciation'.$indexPosition]='numeric';
            $messagesArr['depreciation'.$indexPosition.'.numeric'] ='Total Depreciation '.$period.' - should be a valid number.';

            $fieldsArr['net_fixed_assets'.$indexPosition]=$financialRecord['net_fixed_assets'];
            $rulesArr['net_fixed_assets'.$indexPosition]='numeric';
            $messagesArr['net_fixed_assets'.$indexPosition.'.numeric'] ='Net Fixed Assets '.$period.' - should be a valid number.';

            $fieldsArr['total_assets'.$indexPosition]=$financialRecord['total_assets'];
            $rulesArr['total_assets'.$indexPosition]='numeric';
            $messagesArr['total_assets'.$indexPosition.'.numeric'] ='Total Assets for period '.$period.' - Total Assets should be a valid number.';

            $fieldsArr['total_liabilities'.$indexPosition]=$financialRecord['total_liabilities'];
            $rulesArr['total_liabilities'.$indexPosition]='numeric';
            $messagesArr['total_liabilities'.$indexPosition.'.numeric'] ='Total Liabilities for period '.$period.' - Total Liabilities should be a valid number.';

            $rulesArr['total_liabilities'.$indexPosition]='same:total_assets'.$indexPosition;
            $messagesArr['total_liabilities'.$indexPosition.'.same'] ='Total Liabilities for period '.$period.' - Total Liabilities should be same as total assets.';

            $indexPosition++;
        });

        //dd($financialsCollection, $fieldsArr, $rulesArr, $messagesArr);

        $validator = Validator::make($fieldsArr,$rulesArr, $messagesArr);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        foreach($financialsCollection as $record){
            $id = null;

            if(isset($record['id'])){
                $id = $record['id'];
            }
            BalanceSheet::updateOrCreate(array('id' => $id), $record);
        }

        $this->recalculateAndSaveRatios($loanId);


        session()->flash('flash_message','Input Balance Sheet Details were successfully saved!');
        $redirectUrl = "loans/newlap/analyst-profit-loss/".$loanId;
        return Redirect::to($redirectUrl)->withInput();
    }

    /**
     * Display a the profit loss details to the analyst
     * @param $loanId
     * @return Response
     */
    public function getAnalystProfitLoss($loanId){
        $loan =null;
        if(isset($loanId)){
            $loan = Loan::find($loanId);
        }
        $bl_year = MasterData::BalanceSheet_FY();
        $groupType = Config::get('constants.CONST_FIN_GROUP_TYPE_PL');
        $financialGroups = FinancialGroup::with('financialEntries')->where('type','=',$groupType)->where('status','=', 1)->orderBy('sortOrder')->get();

        $helper = new ExpressionHelper($loanId);
        $financialDataExpressionsMap = $helper->calculateProfitLossFormulae();

        $financialDataRecords = ProfitLoss::where('loan_id','=',$loanId)->get();
        $financialDataMap = new Collection();

        foreach($financialDataRecords as $financialData){
            $financialDataMap->offsetSet($financialData->period, $financialData);
        }

        $subViewType = 'loans.newlap.financial._analyst_financial_info';
        $formaction = 'Loans\NewLAPController@postAnalystProfitLoss';

        return view('loans.newlap.createedit', compact('subViewType','loan','loanId','formaction', 'bl_year', 'financialGroups','groupType', 'financialDataExpressionsMap', 'financialDataMap'));
    }

    /**
     * Display a the balance sheet to the analyst
     * @param Request $request
     *
     * @return Response
     */
    public function postAnalystProfitLoss(Request $request){
        $input = Input::all();
        $loanId =$input['loanId'];

        $tempFinancialsCollection = new Collection( $input['financial']);
        $modelsCollection = $tempFinancialsCollection->map(function($record){
            $recordCollection = new Collection();

            foreach($record as $key => &$value){
                $strVal = trim(strval($value));

                if(strcmp($strVal,"") == 0 || strcmp($strVal, " ") == 0 || strcmp($strVal, "&nbsp") === 0){
                    //dd($key);
                    $strVal = null;
                }

                if(isset($strVal)) {
                    $recordCollection->put($key, $strVal);
                }
            }
            return new FinancialModelRecord($recordCollection->all());
        });

        //dd($input, $tempFinancialsCollection, $modelsCollection);
        $helper = new ExpressionHelper($loanId);
        $financialDataExpressionsMap = $helper->calculateProfitLossFormulae($modelsCollection);
        $financialsCollection = $helper->mergeValuesIntoCollection($tempFinancialsCollection, $financialDataExpressionsMap);
        //dd($modelsCollection, $financialDataExpressionsMap, $financialsCollection);


        $fieldsArr = array();
        $rulesArr = array();
        $messagesArr = array();
        $indexPosition = 0;

        $financialsCollection->each(function ($financialRecord) use (&$fieldsArr, &$rulesArr, &$messagesArr, &$indexPosition){
            $period = $financialRecord['period'];


            $fieldsArr['net_sales'.$indexPosition]=$financialRecord['net_sales'];
            $rulesArr['net_sales'.$indexPosition]='numeric';
            $messagesArr['net_sales'.$indexPosition.'.numeric'] ='Net Sales (After Excise, Octroi, Service Tax etc) for period '.$period.' - should be a valid number.';

            $fieldsArr['oth_op_income'.$indexPosition]=$financialRecord['oth_op_income'];
            $rulesArr['oth_op_income'.$indexPosition]='numeric';
            $messagesArr['oth_op_income'.$indexPosition.'.numeric'] ='Other Operating / Related Income '.$period.' - should be a valid number.';

            $fieldsArr['net_revenue'.$indexPosition]=$financialRecord['net_revenue'];
            $rulesArr['net_revenue'.$indexPosition]='numeric';
            $messagesArr['net_revenue'.$indexPosition.'.numeric'] ='Net Revenue '.$period.' - should be a valid number.';

            $fieldsArr['raw_materials'.$indexPosition]=$financialRecord['raw_materials'];
            $rulesArr['raw_materials'.$indexPosition]='numeric';
            $messagesArr['raw_materials'.$indexPosition.'.numeric'] ='Cost of Raw Material for period '.$period.' - should be a valid number.';

            $indexPosition++;
        });

        //dd($financialsCollection, $fieldsArr, $rulesArr, $messagesArr);

        $validator = Validator::make($fieldsArr,$rulesArr, $messagesArr);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        foreach($financialsCollection as $record){
            $id = null;

            if(isset($record['id'])){
                $id = $record['id'];
            }
            ProfitLoss::updateOrCreate(array('id' => $id), $record);
        }

        $this->recalculateAndSaveRatios($loanId);

        session()->flash('flash_message','Input P&L Details were successfully saved!');
        $redirectUrl = "loans/newlap/analyst-calculated-ratios/".$loanId;
        return Redirect::to($redirectUrl)->withInput();
    }

    /**
     * Display a the profit loss details to the analyst
     * @param $loanId
     * @return Response
     */
    public function getAnalystCalculatedRatios($loanId){
        $loan =null;
        if(isset($loanId)){
            $loan = Loan::find($loanId);
        }
        $bl_year = MasterData::BalanceSheet_FY();
        $groupType = Config::get('constants.CONST_FIN_GROUP_TYPE_RATIO');
        $financialGroups = FinancialGroup::with('financialEntries')->where('type','=',$groupType)->where('status','=', 1)->orderBy('sortOrder')->get();
        $helper = new ExpressionHelper($loanId);
        $financialDataExpressionsMap = $helper->calculateRatios();
        $financialDataMap = new Collection();
        $showFormulaText = true;
        $subViewType = 'loans.newlap.financial._analyst_ratios_info';
        $formaction = 'Loans\NewLAPController@getUploaddoc';
        //$formaction = 'loans/newlap/uploaddoc/'.$loanId;
        return view('loans.newlap.createedit', compact('subViewType','loan','loanId','formaction', 'bl_year', 'financialGroups','groupType','financialDataExpressionsMap', 'showFormulaText', 'financialDataMap'));
    }

    /**
     * Display a the balance sheet to the analyst
     * @param Request $request
     *
     * @return Response
     */
    public function postCalculatedRatios(Request $request){
        $input = Input::all();
        $loanId =$input['loanId'];
        $financialDataByPeriod = new Collection($input['financial']);
        dd($input);

        foreach($financialDataByPeriod as $periodCollection){
            foreach($periodCollection as $record) {
                $id = null;
                if (isset($record['id'])) {
                    $id = $record['id'];
                }
                Ratio::updateOrCreate(array('id' => $id), $record);
            }
        }

        session()->flash('flash_message','Calculated Ratios were successfully saved!');
        $redirectUrl = "loans/newlap/uploaddoc/".$loanId;
        return Redirect::to($redirectUrl)->withInput();
    }

    /**
     * Recalculate and save Ratios
     * @param $loanId
     */
    protected function recalculateAndSaveRatios($loanId)
    {
        $existingPeriodsRatioIdMap = Ratio::periodsRatioIdMap($loanId);

        $helper = new ExpressionHelper($loanId);
        $financialDataExpressionsMap = $helper->calculateRatios();
        $calculatedRatiosArr = $helper->getCalculatedRatiosArr($financialDataExpressionsMap, $existingPeriodsRatioIdMap);
        //dd($financialDataExpressionsMap, $calculatedRatiosArr, $financialsCollection);

        foreach ($calculatedRatiosArr as $ratioRecord) {
            $id = null;
            if (isset($ratioRecord['id'])) {
                $id = $ratioRecord['id'];
            }
            Ratio::updateOrCreate(array('id' => $id), $ratioRecord);
        }
    }
}