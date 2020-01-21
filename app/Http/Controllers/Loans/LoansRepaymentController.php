<?php
namespace App\Http\Controllers\Loans;

use App\Helpers\BankAllocationHelper;
use App\Helpers\ExpressionHelper;
use app\Helpers\FileHelper;
use App\Models\Loan\FinancialData\BalanceSheet;
use App\Models\Loan\FinancialData\FinancialGroup;
use App\Models\Loan\FinancialData\ProfitLoss;
use App\Models\Loan\FinancialData\Cashflow;
use App\Models\Loan\FinancialData\Ratio;
use App\Helpers\validLoanUrlhelper;
use App\Models\Address;
use App\Models\Business;
use App\Models\Loan\PromoterDetails;
use App\Models\Loan\PromoterKycDetails;
use App\Models\Loan\SecurityDetail;
use App\Models\Loan\BuyerDetail;
use App\Models\LoanPromoterKycdtls;
use App\Models\Loan\LoanRepayment\LoanRepayments;
use App\Models\Loan\LoanRepayment\LoanRepaymentsMaster;
use App\Models\CompanyPosition;
use App\Models\Common\ConfigurableParameter;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Loan\Loan;

//use Cartalyst\Auth\Laravel\Facades\Auth;
use App\Models\MasterData;
use Log;
use Validator;
use Input;
use App\Models\Loan\LoansStatus;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;

use Storage;
use Auth;


//test
class LoansRepaymentController extends BaseLoansController
{
  public function __construct()
  {
    //This will ensure that all routes handled by this controller are first authenticated


    $this->middleware('auth');
  }

  /**
   * Display a listing of the resource.
   * @param $loanType
   * @param $loanId
   * @return Response
   */

 public function getRepayment($param1 = null, $param2 = null, $param3 = null, $param4 = null, $param5 = null, $param6 = null, $param7 = null, $param8 = null)
  {
  
    $endUseList = $param1;
    $loanType = $param2;
    $loanProduct = $param2;
    $amount = $param3;
    $loanTenure = $param4;
    $companySharePledged = null;
    $bscNscCode = null;
    $afterShare = null;
    if (isset($param5) && isset($param6) && isset($param8)) {
      echo "string";
      $loanId = $param8;
      $afterShare = $param7;
    } elseif (isset($param5) && isset($param6)) {
      $companySharePledged = $param5;
      $bscNscCode = $param6;
      $loanId = $param7;
    } else {
      $loanId = $param5;
    }

  $loan = null;
  if (isset($loanId)) {
    $loan = Loan::find($loanId);
  
   
    if (!isset($endUseList)) {
      $endUseList = $loan->end_use;
    }
    if (!isset($loanType)) {
      $loanType = $loan->type;
    }
    if (!isset($amount)) {
      $amount = $loan->loan_amount;
    }
    if (!isset($loanTenure)) {
      $loanTenure = $loan->loan_tenure;
    }
  }

   $validLoanHelper = new validLoanUrlhelper();

    if (isset($loanId)) {
    $validLoan = $validLoanHelper->isValidLoan($loanId);
    if (!$validLoan) {
      return view('loans.error');
    }
    $status = $validLoanHelper->getTabStatus($loanId, 'promoter_details');
    if ($status == 'Y' && $setDisable != 'disabled') {
      $setDisable = 'disabled';
    }
  }

  //new


  $bl_year = $this->setFinancialYears();


  //new
    $groupType = Config::get('constants.CONST_FIN_GROUP_TYPE_RATIO');
    $financialGroups = FinancialGroup::with('financialEntries')->where('type', '=', $groupType)->where('status', '=', 1)->orderBy('sortOrder')->get();
    $helper = new ExpressionHelper($loanId);
    $financialDataExpressionsMap = $helper->calculateRatios();

    
    $financialDataMap = new Collection();
    $showFormulaText = true;
    $financialProfitLoss = ProfitLoss::where('loan_id', '=', $loanId)->get();
    $ratios = Ratio::where('loan_id', '=', $loanId)->get();


      
 
      $loan = Loan::find($loanId);
      $loanUser = User::find($loan->user_id);
      $loanUserProfile = $loanUser->userProfile();

      $isReadOnly = Config::get('constants.CONST_IS_READ_ONLY');

       $setDisable = '';
       $isRemoveMandatory = MasterData::removeMandatory();
       $isRemoveMandatory = array_except($isRemoveMandatory, ['']);
       $removeMandatoryHelper = new validLoanUrlhelper();

       $promoter_proof_address_file = null;
       $model = null;
        $mandatoryField = null;
     $mandatoryField = 'M';

         $user = Auth::getUser();
  $setDisable = $this->getIsDisabled($user);
  if ($user->isAnalyst() && $setDisable == 'disabled') {
    $setDisable = null;
    $mandatoryField = null;
  }
  $isRemoveMandatory = MasterData::removeMandatory();
  $isRemoveMandatory = array_except($isRemoveMandatory, ['']);
  $removeMandatoryHelper = new validLoanUrlhelper();
  $removeMandatory = $removeMandatoryHelper->getMandatory($user, $isRemoveMandatory);
   


       ///end new
  
  $addressTypes = MasterData::addressProofTypes();
  $mandatoryField = 'M';
  $setDisable = null;
  $isAnalystUser = null;
  $user = Auth::getUser();
  $setDisable = $this->getIsDisabled($user);
  if ($user->isAnalyst() && $setDisable == 'disabled') {
    $setDisable = null;
    $mandatoryField = null;
  }


  
 
  //getting borrowers profile
  if (isset($loanId)) {
    $loan = Loan::find($loanId);
    $loanUser = User::find($loan->user_id);
    $loanUserProfile = $loanUser->userProfile();

    //new
     @$praposalChecklist=LoanRepayments::where('loan_id', '=', $loanId)->first();
        @$promoterDetails=PromoterDetails::where('loan_id', '=', $loanId)->first();
  }

  $userPr = UserProfile::where('user_id', '=', $loan->user_id)->first();
  $userProfile = UserProfile::with('user')->find($userPr->id);
  //new
  $userProfileFirm = UserProfile::with('user')->find($userPr->id);

  //$formaction = 'Loans\LoansController@postRepayment';
  $formaction = 'Loans\LoansRepaymentController@postRepayment';

   $subViewType = 'loans._repayment';
//die();
  return view('loans.createedit', compact(
    'subViewType',
    'endUseList',
    'loanType',
    'amount',
    'loanTenure',
    'loan',
    'loanId',
    'formaction',
    'praposalChecklist',
    'companySharePledged',
    'validLoanHelper',
    'userProfileFirm',

    'promoter_proof_address_file',
    'removeMandatory',
    'model',
     'mandatoryField',
     'setDisable'
    
  ));
}



  /**
   * Save 
   * @param Request $request
   *
   * @return Response
   */


  public function postRepayment()
{
echo "string";
  die("sa");
  $input = Input::all();
  $loanId = isset($input['loanId']) ? $input['loanId'] : null;
  $loanType = isset($input['type']) ? $input['type'] : null;
  $amount = isset($input['loan_amount']) ? $input['loan_amount'] : null;
  $loanTenure = isset($input['loan_tenure']) ? $input['loan_tenure'] : null;
  $endUseList = isset($input['end_use']) ? $input['end_use'] : null;
  $companySharePledged = isset($input['companySharePledged']) ? $input['companySharePledged'] : null;
  $bscNscCode = isset($input['bscNscCode']) ? $input['bscNscCode'] : null;
  
  $user = Auth::getUser();
    $user_id = $user->id; //Obtaining User id
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
      $deletedQuestionsLoan = $this->getDeletedQuestionLoan($loan, $loanType, $amount);
      $deletedQuestionHelper = new DeletedQuestionsHelper($deletedQuestionsLoan);
      $isQuestionMandatory = new UploadDocHelper($loan);
    }
    $fieldsArr = [];
    $rulesArr = [];
    $messagesArr = [];
  



$loan = null;
if (isset($loanId)) {
  $loan = Loan::find($loanId);
}

$loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loan->id], ['loan_id' => $loanId, 'loan_repayment' => 'Y']);
// $loansStatus = Loan::updateOrCreate(['id' => $loanId], ['id' => $loanId, 'status' => '22']);
$loansStatus->save();
$this->getLoansStatus($loanId);
$validator = Validator::make($fieldsArr, $rulesArr, $messagesArr);
if ($validator->fails()) {
  return Redirect::back()->withErrors($validator)->withInput();
} else {
  session()->flash('flash_message', 'Loan Repayment successfully uploaded!');
}

 $loan = LoanRepayments::updateOrCreate(['loan_id' => $loanId], [

   'cust_name' => @$input['cust_name'],
   'guarantor_name' => @$input['guarantor_name'],
   'cust_address' => @$input['cust_address'],
   'guarantor_address' => @$input['guarantor_address'],
   'cust_number' => @$input['cust_number'],
   'guarantor_number' => @$input['guarantor_number'],
   'email' => @$input['email'],
   'email2' => @$input['email2'],
   'TypeofLoan' => @$input['TypeofLoan'],
   'TypeofRepayment' => @$input['TypeofRepayment'],
   'p' => @$input['p'],
   'r' => @$input['r'],
   'n' => @$input['n'],
   't' => @$input['t'],
   'loansanction' => @$input['loansanction'],
   'date1' => @$input['date1'],
   'date2' => @$input['date2'],
   'date3' => @$input['date3'],
   'date4' => @$input['date4'],
   'date5' => @$input['date5'],
   'date6' => @$input['date6'],
   'date7' => @$input['date7'],
   'date8' => @$input['date8'],
   'date9' => @$input['date9'],
   'date10' => @$input['date10'],
   'date11' => @$input['date11'],
   'date12' => @$input['date12'],
   'date13' => @$input['date13'],
   'date14' => @$input['date14'],
   'date15' => @$input['date15'],
   'date16' => @$input['date16'],
   'date17' => @$input['date17'],
   'date18' => @$input['date18'],
   'date19' => @$input['date19'],
   'date20' => @$input['date20'],
   'date21' => @$input['date21'],
   'date22' => @$input['date22'],
   'date23' => @$input['date23'],
   'date24' => @$input['date24'],
   'date25' => @$input['date25'],
   'date26' => @$input['date26'],
   'date27' => @$input['date27'],
   'date28' => @$input['date28'],
   'date29' => @$input['date29'],
   'date30' => @$input['date30'],
   'date31' => @$input['date31'],
   'date32' => @$input['date32'],
   'date33' => @$input['date33'],
   'date34' => @$input['date34'],
   'date35' => @$input['date35'],
   'date36' => @$input['date36'],
   'date37' => @$input['date37'],
   'date38' => @$input['date38'],
   'date39' => @$input['date39'],
   'date40' => @$input['date40'],
   'date41' => @$input['date41'],
   'date42' => @$input['date42'],
   'date43' => @$input['date43'],
   'date44' => @$input['date44'],
   'date45' => @$input['date45'],
   'date46' => @$input['date46'],
   'date47' => @$input['date47'],
   'date48' => @$input['date48'],



   'first_date'=> @$input['first_date'],
    'two_date'=> @$input['two_date'],

    // 'os'=> @$input['os'],
    'os1'=> @$input['os1'],
    'os2'=> @$input['os2'],
    'os3'=> @$input['os3'],
    'os4'=> @$input['os4'],
    'os5'=> @$input['os5'],
    'os6'=> @$input['os6'],
    'os7'=> @$input['os7'],
    'os8'=> @$input['os8'],
    'os9'=> @$input['os9'],
    'os10'=> @$input['os10'],
    'os11'=> @$input['os11'],
    'os12'=> @$input['os12'],
    'os13'=> @$input['os13'],
    'os14'=> @$input['os14'],
    'os15'=> @$input['os15'],
    'os16'=> @$input['os16'],
    'os17'=> @$input['os17'],
    'os18'=> @$input['os18'],
    'os19'=> @$input['os19'],
    'os20'=> @$input['os20'],
    'os21'=> @$input['os21'],
    'os22'=> @$input['os22'],
    'os23'=> @$input['os23'],
    'os24'=> @$input['os24'],
    'os25'=> @$input['os25'],
    'os26'=> @$input['os26'],
    'os27'=> @$input['os27'],
    'os28'=> @$input['os28'],
    'os29'=> @$input['os29'],
    'os30'=> @$input['os30'],
    'os31'=> @$input['os31'],
    'os32'=> @$input['os32'],
    'os33'=> @$input['os33'],
    'os34'=> @$input['os34'],
    'os35'=> @$input['os35'],
    'os36'=> @$input['os36'],

    // 'interestdue'=> @$input['interestdue'],
    'interestdue1'=> @$input['interestdue1'],
    'interestdue2'=> @$input['interestdue2'],
    'interestdue3'=> @$input['interestdue3'],
    'interestdue4'=> @$input['interestdue4'],
    'interestdue5'=> @$input['interestdue5'],
    'interestdue6'=> @$input['interestdue6'],
    'interestdue7'=> @$input['interestdue7'],
    'interestdue8'=> @$input['interestdue8'],
    'interestdue9'=> @$input['interestdue9'],
    'interestdue10'=> @$input['interestdue10'],
    'interestdue11'=> @$input['interestdue11'],
    'interestdue12'=> @$input['interestdue12'],
    'interestdue13'=> @$input['interestdue13'],
    'interestdue14'=> @$input['interestdue14'],
    'interestdue15'=> @$input['interestdue15'],
    'interestdue16'=> @$input['interestdue16'],
    'interestdue17'=> @$input['interestdue17'],
    'interestdue18'=> @$input['interestdue18'],
    'interestdue19'=> @$input['interestdue19'],
    'interestdue20'=> @$input['interestdue20'],
    'interestdue21'=> @$input['interestdue21'],
    'interestdue22'=> @$input['interestdue22'],
    'interestdue23'=> @$input['interestdue23'],
    'interestdue24'=> @$input['interestdue24'],
    'interestdue25'=> @$input['interestdue25'],
    'interestdue26'=> @$input['interestdue26'],
    'interestdue27'=> @$input['interestdue27'],
    'interestdue28'=> @$input['interestdue28'],
    'interestdue29'=> @$input['interestdue29'],
    'interestdue30'=> @$input['interestdue30'],
    'interestdue31'=> @$input['interestdue31'],
    'interestdue32'=> @$input['interestdue32'],
    'interestdue33'=> @$input['interestdue33'],
    'interestdue34'=> @$input['interestdue34'],
    'interestdue35'=> @$input['interestdue35'],
    'interestdue36'=> @$input['interestdue36'],


    // 'pd'=> @$input['pd'],
    'pd1'=> @$input['pd1'],
    'pd2'=> @$input['pd2'],
    'pd3'=> @$input['pd3'],
    'pd4'=> @$input['pd4'],
    'pd5'=> @$input['pd5'],
    'pd6'=> @$input['pd6'],
    'pd7'=> @$input['pd7'],
    'pd8'=> @$input['pd8'],
    'pd9'=> @$input['pd9'],
    'pd10'=> @$input['pd10'],
    'pd11'=> @$input['pd11'],
    'pd12'=> @$input['pd12'],
    'pd13'=> @$input['pd13'],
    'pd14'=> @$input['pd14'],
    'pd15'=> @$input['pd15'],
    'pd16'=> @$input['pd16'],
    'pd17'=> @$input['pd17'],
    'pd18'=> @$input['pd18'],
    'pd19'=> @$input['pd19'],
    'pd20'=> @$input['pd20'],
    'pd21'=> @$input['pd21'],
    'pd22'=> @$input['pd22'],
    'pd23'=> @$input['pd23'],
    'pd24'=> @$input['pd24'],
    'pd25'=> @$input['pd25'],
    'pd26'=> @$input['pd26'],
    'pd27'=> @$input['pd27'],
    'pd28'=> @$input['pd28'],
    'pd29'=> @$input['pd29'],
    'pd30'=> @$input['pd30'],
    'pd31'=> @$input['pd31'],
    'pd32'=> @$input['pd32'],
    'pd33'=> @$input['pd33'],
    'pd34'=> @$input['pd34'],
    'pd35'=> @$input['pd35'],
    'pd36'=> @$input['pd36'],


    // 'tds'=> @$input['tds'],
    'tds1'=> @$input['tds1'],
    'tds2'=> @$input['tds2'],
    'tds3'=> @$input['tds3'],
    'tds4'=> @$input['tds4'],
    'tds5'=> @$input['tds5'],
    'tds6'=> @$input['tds6'],
    'tds7'=> @$input['tds7'],
    'tds8'=> @$input['tds8'],
    'tds9'=> @$input['tds9'],
    'tds10'=> @$input['tds10'],
    'tds11'=> @$input['tds11'],
    'tds12'=> @$input['tds12'],
    'tds13'=> @$input['tds13'],
    'tds14'=> @$input['tds14'],
    'tds15'=> @$input['tds15'],
    'tds16'=> @$input['tds16'],
    'tds17'=> @$input['tds17'],
    'tds18'=> @$input['tds18'],
    'tds19'=> @$input['tds19'],
    'tds20'=> @$input['tds20'],
    'tds21'=> @$input['tds21'],
    'tds22'=> @$input['tds22'],
    'tds23'=> @$input['tds23'],
    'tds24'=> @$input['tds24'],
    'tds25'=> @$input['tds25'],
    'tds26'=> @$input['tds26'],
    'tds27'=> @$input['tds27'],
    'tds28'=> @$input['tds28'],
    'tds29'=> @$input['tds29'],
    'tds30'=> @$input['tds30'],
    'tds31'=> @$input['tds31'],
    'tds32'=> @$input['tds32'],
    'tds33'=> @$input['tds33'],
    'tds34'=> @$input['tds34'],
    'tds35'=> @$input['tds35'],
    'tds36'=> @$input['tds36'],


    // 'netinterest'=> @$input['netinterest'],
    'netinterest1'=> @$input['netinterest1'],
    'netinterest2'=> @$input['netinterest2'],
    'netinterest3'=> @$input['netinterest3'],
    'netinterest4'=> @$input['netinterest4'],
    'netinterest5'=> @$input['netinterest5'],
    'netinterest6'=> @$input['netinterest6'],
    'netinterest7'=> @$input['netinterest7'],
    'netinterest8'=> @$input['netinterest8'],
    'netinterest9'=> @$input['netinterest9'],
    'netinterest10'=> @$input['netinterest10'],
    'netinterest11'=> @$input['netinterest11'],
    'netinterest12'=> @$input['netinterest12'],
    'netinterest13'=> @$input['netinterest13'],
    'netinterest14'=> @$input['netinterest14'],
    'netinterest15'=> @$input['netinterest15'],
    'netinterest16'=> @$input['netinterest16'],
    'netinterest17'=> @$input['netinterest17'],
    'netinterest18'=> @$input['netinterest18'],
    'netinterest19'=> @$input['netinterest19'],
    'netinterest20'=> @$input['netinterest20'],
    'netinterest21'=> @$input['netinterest21'],
    'netinterest22'=> @$input['netinterest22'],
    'netinterest23'=> @$input['netinterest23'],
    'netinterest24'=> @$input['netinterest24'],
    'netinterest25'=> @$input['netinterest25'],
    'netinterest26'=> @$input['netinterest26'],
    'netinterest27'=> @$input['netinterest27'],
    'netinterest28'=> @$input['netinterest28'],
    'netinterest29'=> @$input['netinterest29'],
    'netinterest30'=> @$input['netinterest30'],
    'netinterest31'=> @$input['netinterest31'],
    'netinterest32'=> @$input['netinterest32'],
    'netinterest33'=> @$input['netinterest33'],
    'netinterest34'=> @$input['netinterest34'],
    'netinterest35'=> @$input['netinterest35'],
    'netinterest36'=> @$input['netinterest36'],

    
    // 'netamtdue'=> @$input['netamtdue'],
    'netamtdue1'=> @$input['netamtdue1'],
    'netamtdue2'=> @$input['netamtdue2'],
    'netamtdue3'=> @$input['netamtdue3'],
    'netamtdue4'=> @$input['netamtdue4'],
    'netamtdue5'=> @$input['netamtdue5'],
    'netamtdue6'=> @$input['netamtdue6'],
    'netamtdue7'=> @$input['netamtdue7'],
    'netamtdue8'=> @$input['netamtdue8'],
    'netamtdue9'=> @$input['netamtdue9'],
    'netamtdue10'=> @$input['netamtdue10'],
    'netamtdue11'=> @$input['netamtdue11'],
    'netamtdue12'=> @$input['netamtdue12'],
    'netamtdue13'=> @$input['netamtdue13'],
    'netamtdue14'=> @$input['netamtdue14'],
    'netamtdue15'=> @$input['netamtdue15'],
    'netamtdue16'=> @$input['netamtdue16'],
    'netamtdue17'=> @$input['netamtdue17'],
    'netamtdue18'=> @$input['netamtdue18'],
    'netamtdue19'=> @$input['netamtdue19'],
    'netamtdue20'=> @$input['netamtdue20'],
    'netamtdue21'=> @$input['netamtdue21'],
    'netamtdue22'=> @$input['netamtdue22'],
    'netamtdue23'=> @$input['netamtdue23'],
    'netamtdue24'=> @$input['netamtdue24'],
    'netamtdue25'=> @$input['netamtdue25'],
    'netamtdue26'=> @$input['netamtdue26'],
    'netamtdue27'=> @$input['netamtdue27'],
    'netamtdue28'=> @$input['netamtdue28'],
    'netamtdue29'=> @$input['netamtdue29'],
    'netamtdue30'=> @$input['netamtdue30'],
    'netamtdue31'=> @$input['netamtdue31'],
    'netamtdue32'=> @$input['netamtdue32'],
    'netamtdue33'=> @$input['netamtdue33'],
    'netamtdue34'=> @$input['netamtdue34'],
    'netamtdue35'=> @$input['netamtdue35'],
    'netamtdue36'=> @$input['netamtdue36'],







    
 ] );



$redirectUrl = 'home';
// return Redirect::to($redirectUrl);



return Redirect::to($redirectUrl)->with('message', 'Loan Repayment has beed successfully saved');
}



//================================
      public function setFinancialYears()
      {
        return $this->dummyDateMK();
  // $currentFinancialYear = intval(date('Y'));
  // $currentMonth = intval(date('m'));
  // $currentFY = null;
  // if ($currentMonth > 3) {
  //     // FY is current - next year
  //     $currentFY = $currentFinancialYear;
  // } else {
  //     // FY is prev - current year
  //     $currentFY = $currentFinancialYear - 1;
  // }
  // // Check current date falls between provisional range
  // $currentDateTimestamp = strtotime(date('Y-m-d'));
  // $provisionalStartDate = strtotime(date('Y').'-07-01');
  // $provisionalEndDate = strtotime(date('Y').'-10-31');
  // $goTillLastYear = 3;
  // if ($currentDateTimestamp >= $provisionalStartDate && $currentDateTimestamp <= $provisionalEndDate) {
  //     // In provision
  //     $goTillLastYear = 4;
  // } else if ($currentDateTimestamp < $provisionalStartDate) {
  //     // $currentFY = $currentFY - 1;
  //     $goTillLastYear = 3;
  // } else {
  //     $goTillLastYear = 4;
  // }
  // $fin_bl_year = [];
  // $secondPart = null;
  // for($i = $currentFY, $l = $currentFY - $goTillLastYear; $i > $l; $i--) {
  //     $secondPart = str_replace('20', '', ($i));
  //     $fin_bl_year[('FY' . ($i-1) . '-' . $secondPart)] = ('FY' . ($i-1) . '-' . $secondPart);
  // }
  // return $fin_bl_year;
  ////////////////////////////////////////////////////////////
  // $bl_year = MasterData::BalanceSheet_FY();
  // $fin_bl_year = [];
  // $currentYear = date('Y');
  // $currentDateTimestamp   = strtotime(date('Y-m-d'));
  // $finStartDateTimestamp  = strtotime(date('Y').'-07-01');
  // $finEndDateTimestamp    = strtotime(date('Y').'-10-31');
  // foreach ($bl_year as $year) {
  //     $fin_year = explode('-', explode('FY', $year)[1]);
  //     if($fin_year[0] == (int)($currentYear - 1)) {
  //         if(($currentDateTimestamp >= $finStartDateTimestamp && ($currentDateTimestamp <= $finEndDateTimestamp))) {
  //             for($i=$fin_year[0]; $i > (int)($fin_year[0]-4); $i--) {
  //                 $fin_bl_year['FY'. $i . '-' . (int)(explode('20', $i)[1] + 1)] = 'FY'. $i . '-' . (int)(explode('20', $i)[1] + 1);
  //             }
  //         } else if(($currentDateTimestamp >= $finEndDateTimestamp)) {
  //             for($i=$fin_year[0]; $i > (int)($fin_year[0]-3); $i--) {
  //                 $fin_bl_year['FY'. $i . '-' . (int)(explode('20', $i)[1] + 1)] = 'FY'. $i . '-' . (int)(explode('20', $i)[1] + 1);
  //             }
  //         } else {
  //             for($i=(int)($fin_year[0]-1); $i > (int)($fin_year[0]-4); $i--) {
  //                 $fin_bl_year['FY'. $i . '-' . (int)(explode('20', $i)[1] + 1)] = 'FY'. $i . '-' . (int)(explode('20', $i)[1] + 1);
  //             }
  //         }
  //     }
  // }
  // return $fin_bl_year;
      }

      public function dummyDate()
      {
        $currentFinancialYear = 2016;
        $currentMonth = 1;
        $currentFY = null;
        if ($currentMonth > 6) {
    // FY is current - next year
          $currentFY = $currentFinancialYear;
        } else {
    // FY is prev - current year
          $currentFY = $currentFinancialYear - 1;
        }
  // Check current date falls between provisional range
        $currentDateTimestamp = strtotime($currentFinancialYear . '-' . $currentMonth . '-11');
        $provisionalStartDate = strtotime($currentFinancialYear . '-07-01');
        $provisionalEndDate = strtotime($currentFinancialYear . '-10-31');
        $goTillLastYear = 3;
        if ($currentDateTimestamp >= $provisionalStartDate && $currentDateTimestamp <= $provisionalEndDate) {
    // In provision
          $goTillLastYear = 4;
        } else if ($currentDateTimestamp > $provisionalStartDate) {
    // $currentFY = $currentFY - 1;
          $goTillLastYear = 3;
        } else {
          $goTillLastYear = 3;
        }
        $fin_bl_year = [];
        $secondPart = null;
        for ($i = $currentFY, $l = $currentFY - $goTillLastYear; $i > $l; $i--) {
          $firstPart = ($i - 1);
          $secondPart = str_replace('20', '', ($i));
          $value = 'FY' . $firstPart . '-' . $secondPart;
          if ($currentMonth <= 10) {
            if (str_replace('20', '', $currentFinancialYear) == str_replace('20', '', ($i))) {
              $value .= '(Provisional)';
            }
          }
          $fin_bl_year[('FY' . $firstPart . '-' . $secondPart)] = ($value);
        }
        return $fin_bl_year;
      }

      public function dummyDateMK()
      {
        $toShow = 3;
        $provi = 'n';
        $currentFinancialYear = date("Y");
        $currentMonth = date("m");
        $currentFY = $currentFinancialYear;
        if ($currentMonth > 6) {
          $currentFY++;
          if ($currentMonth < 10) {
            $toShow++;
            $provi = 'y';
          }
        }
        for ($i = 0; $i < $toShow; $i++) {
          if ($provi == 'y') {
            $use = '(Prov)';
            $provi = 'n';
          } else {
            $use = '';
          }
          $currentFY--;
          $year1 = 'FY ' . ($currentFY - 1) . '-' . substr($currentFY, -2) . $use;


          $fin_bl_year[$year1] = $year1;
        }
        return $fin_bl_year;
      }

  protected function getIsDisabled($user = null, $isAnalyst = false)
  {
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


}

