<?php
namespace App\Http\Controllers\Loans;

use App\Helpers\BankAllocationHelper;
use App\Helpers\ExpressionHelper;
use app\Helpers\FileHelper;
use App\Helpers\Ratios\FinancialModelRecord;
use App\Helpers\UploadDocHelper;
use App\Helpers\validLoanUrlhelper;
use App\Models\Address;
use App\Models\Business;
use Carbon\Carbon;
use App\Models\Loan\AnalystModel\AnalystModelCategory;
use App\Models\Loan\AnalystModel\AnalystModelRating;
use App\Models\Loan\AnalystModel\AnalystModelRatingDetails;

use App\Models\Loan\LiquidityModel\LiquidityModelCategory;
use App\Models\Loan\LiquidityModel\LiquidityModelRating;
use App\Models\Loan\LiquidityModel\LiquidityModelRatingDetails;

use App\Models\Loan\BalanceSheetDetail;
use App\Models\Loan\LoanAgainstShare;
use App\Models\Loan\Bankallocation\LoansBankAllocation;
use App\Models\Loan\BusinessOperationalDetail;
use App\Models\Loan\ExistingLoanDetail;
use App\Models\Loan\FinancialData\BalanceSheet;
use App\Models\Loan\FinancialData\FinancialGroup;
use App\Models\Loan\FinancialData\ProfitLoss;
use App\Models\Loan\FinancialData\Cashflow;
use App\Models\Loan\FinancialData\Ratio;
use App\Models\Loan\MobileAppData;
use App\Models\Loan\ProfitLossDetail;
use App\Models\Loan\PromoterDetails;
use App\Models\Loan\PraposalKeyloanterms;
use App\Models\Loan\PromoterKycDetails;
use App\Models\Loan\PromoterPropertyDetail;
use App\Models\Loan\LoanOverdraftKycDetails;
use App\Models\Loan\LoanVechicleDetails;
use App\Models\Loan\LoanCreditCardDetails;
use App\Models\Loan\SecurityDetail;
use App\Models\Loan\BuyerDetail;
use App\Models\LoanPromoterKycdtls;
use App\Models\Loan\PraposalBackground;
use App\Models\Loan\PraposalDetails;
use App\Models\Loan\PraposalChecklists;
//use App\Models\Loan\LoanRepayments;
use App\Models\Loan\LoanRepayment\LoanRepayments;
use App\Models\Loan\LoanRepayment\LoanRepaymentsDetails;

use App\Models\Loan\Upload;
use App\Models\CompanyPosition;
use App\Models\Common\ConfigurableParameter;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\CashFlowInitial;
use App\Models\SrcOfFund;
use App\Models\SrcOfFundsData;
use App\Models\UseOfFund;
use App\Models\UsesOfFundsData;
use App\Models\SrcTotal;
use App\Models\UsesTotal;
use App\Models\OpeningSrcUse;
use App\Models\SurplusSrcUses;
use App\Models\ClosingSrcUses;
use App\Models\CashCriteria;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Loan\Loan;
use App\Models\Loan\LoansMortgageDetails;

use App\Models\Loan\SalesAreaDetails;
//use Cartalyst\Auth\Laravel\Facades\Auth;
use App\Models\MasterData;
use Log;
use Validator;
use Input;
use App\Models\PropertyDetails;
use App\Models\ThirdPartyDetails;
use App\Helpers\DeletedQuestionsHelper;

use App\Models\Loan\LoansStatus;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;


use App\Models\Loan\LoanRepayment\LoanRepaymentsMaster;

use Storage;
use Auth;


//test
class LoansController extends BaseLoansController
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
  public function getIndex($loanType = null, $loanId = null)
  {
    $userType = MasterData::userType();
    $choosenUserType = null;
    $loan_tenure = MasterData::tenureYearList();
    $chosenLoanTenure = null;
    $loan_product = MasterData::loanProductType();
    $chosenLoanProduct = null;
    $end_use = MasterData::endUseList();
    $chosenEndUse = null;

    $amount = 0;
    $loan = null;
    $test = null;
    $validLoanHelper = new validLoanUrlhelper();
    $user = Auth::user();
    if (isset($user)) {
      $userID = $user->id;
      $userEmail = $user->email;
    }
    $userPr = UserProfile::where('user_id', '=', $userID)->first();
    $userProfile = UserProfile::with('user')->find($userPr->id);

    //dd($userProfile);

    if (isset($userID)) {
      $mobileAppEmail = DB::table('mobile_app_data')->where('Email', $userEmail)
      ->where('status', 0)
      ->first();
    }

    if (isset($mobileAppEmail)) {
      $amount = $mobileAppEmail->ReqAmt;
    }
    if (isset($_GET['EU'])) {
      $chosenEndUse = $_GET['EU'];
      $chosenLoanProduct = $_GET['LT'];
      $amount = $_GET['AMT'];
      $chosenLoanTenure = $_GET['TN'];
      $companySharePledged = $_GET['CSP'];
      $bscNscCode = $_GET['BSC'];
    }
    $formaction = 'Loans\LoansController@postIndex';
    $subViewType = 'loans._choose_loan';
    return view('loans.createedit', compact(
      'formaction',
      'subViewType',
      'loanType',
      'loanId',
      'userType',
      'choosenUserType',
      'end_use',
      'chosenEndUse',
      'loan_tenure',
      'userProfile',
      'companySharePledged',
      'bscNscCode',
      'chosenLoanTenure',
      'validLoanHelper',
      'loan_product',
      'chosenLoanProduct',
      'amount',
      'loan',
      'userID',
      'mobileAppEmail'
    ));
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
    $loanId = isset($input['loanId']) ? $input['loanId'] : null;
    $loanProduct = isset($input['loan_product']) ? $input['loan_product'] : null;
    $amount = isset($input['amount']) ? $input['amount'] : null;
    $loanTenure = isset($input['loan_tenure']) ? $input['loan_tenure'] : null;
    $endUseList = isset($input['end_use']) ? $input['end_use'] : null;


    $companySharePledged = str_replace(' ', '', $input['companySharePledged']);
    if (isset($companySharePledged)) {
      $companySharePledged = isset($companySharePledged) ? $companySharePledged : null;
      $bscNscCode = isset($input['bscNscCode']) ? $input['bscNscCode'] : null;
    }
    $loan = null;
    // dd($request,$input,$loan);
    $rules = [
      'end_use' => 'required',
      'loan_product' => 'required',
      'amount' => 'required|numeric',
      'loan_tenure' => 'required|numeric',
    ];
    $this->validate($request, $rules);
    $redirectUrl = $this->generateRedirectURL('loans/company-background', $endUseList, $loanProduct, $amount, $loanTenure, $companySharePledged, $bscNscCode, $loanId);
    return Redirect::to($redirectUrl);
  }

  /**
   * Display a listing of the resource.
   * @param $loanType
   * @param $endUseList
   * @param $amount
   * @param $chosenLoanTenure
   * @param $loanId
   * @return Response
   */
  // public function getProfileLoanDetails($loanType, $endUseList, $amount, $loanTenure, $loanId) {
  //public function getApplication($loanType, $endUseList = null, $amount = null, $loanTenure= null, $loanId = null){
  public function getProfileLoanDetails($param1 = null, $param2 = null, $param3 = null, $param4 = null, $param5 = null, $param6 = null, $param7 = null, $param8 = null)
  {
    // dd($param1,$param2,$param3,$param4,$param5,$param6,$param7,$param8);
    //$endUseList,$loanType, $amount=null, $loanTenure = null, $companySharePledged= null, $bscNscCode = null,$loanId=null
    $endUseList = $param1;
    $loanType = $param2;
    //$loanProduct = $param2;
    $amount = $param3;
    $loanTenure = $param4;
    $companySharePledged = null;
    $bscNscCode = null;
    $afterShare = null;
    if (isset($param5) && isset($param6) && isset($param8)) {
      //  echo "string";
      $companySharePledged = $param5;
      $bscNscCode = $param6;
      $loanId = $param8;
      $afterShare = $param7;
    } elseif (isset($param5) && isset($param6)) {
      $companySharePledged = $param5;
      $bscNscCode = $param6;
      $loanId = $param7;
    } else {
      $loanId = $param5;
    }


    $validLoanHelper = new validLoanUrlhelper();
    $user = null;
    $loan = Loan::find($loanId);
    $userID = null;
    $firm_pan = null;
    $owner_email = null;
    $referredUserID = null;
    $name_of_firm = null;
    $chosenEntity = null;
    $chosenCity = null;
    $chosenState = null;
    $owner_name = null;
    $address = null;
    $pincode = null;
    $contact1 = null;
    $contact2 = null;
    $latest_turnover = null;
    if (isset($loan)) {
      $userID = $loan->user_id;
      $referredUserID = $loan->referredby_userid;
    }
    if (isset($userID)) {

      $user = User::find($userID);
      //$userPr = UserProfile::find('user_id',$userID);

      $userPr = UserProfile::where('user_id', '=', $userID)->first();
      $userProfile = UserProfile::with('user')->find($userPr->id);
      //dd($userProfile);
      // /die;
      $firm_pan = $userProfile->user->username;
      $owner_email = $userProfile->user->email;
    }
    if (isset($userProfile)) {
      $chosenEntity = $userProfile->owner_entity_type;
      $chosenCity = $userProfile->owner_city;
      $chosenState = $userProfile->owner_state;
      $name_of_firm = $userProfile->name_of_firm;
      $owner_name = $userProfile->owner_name;
      $address = $userProfile->address;
      $pincode = $userProfile->pincode;
      $contact1 = $userProfile->contact1;
      $contact2 = $userProfile->contact2;

      $latest_turnover = $userProfile->latest_turnover;
    }
    //dd($variable);
    $CPUser = User::find($referredUserID);
    $CPUserProfile = UserProfile::find($referredUserID);
    //        dd($CPUser,$CPUserProfile);
    if (isset($CPUserProfile)) {
      $adv_name = $CPUserProfile->name_of_firm;
      $adv_mobile = $CPUserProfile->contact1;
    }
    if (isset($CPUser)) {
      $adv_pan = $CPUser->username;
      $adv_email = $CPUser->email;
    }
    $formaction = 'Loans\LoansController@postProfileLoanDetails';
    $subViewType = 'loans._profile_loan_details';
    return view('loans.createedit', compact(
      'formaction',
      'subViewType',
      'loanType',
      'loanId',
      'loan',
      'endUseList',
      'amount',
      'loanTenure',
      'validLoanHelper',
      'firm_pan',
      'chosenEntity',
      'owner_email',
      'chosenState',
      'contact1',
      'contact2',
      'chosenCity',
      'name_of_firm',
      'owner_name',
      'pincode',
      'userProfile',
      'address',
      'latest_turnover',
      'referredUserID',
      'adv_pan',
      'adv_email',
      'adv_name',
      'adv_mobile',
      'companySharePledged',
      'bscNscCode'
    ));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @param Request $request
   *
   * @return Response
   */
  public function postProfileLoanDetails(Request $request)
  {
  }

  /**
   * Display a listing of the resource.
   * @param $endUseList
   * @param $loanProduct
   * @param $amount
   * @param $chosenLoanTenure
   * @param $loanId
   * @param $companyCode
   * @param $exchangeCode
   * @return Response
   *///  $endUseList, $loanProduct , $amount, $loanTenure, $companySharePledged, $bscNscCode, $loanId
  public function getCompanyBackground($param1 = null, $param2 = null, $param3 = null, $param4 = null, $param5 = null, $param6 = null, $param7 = null)
  {
    $loanType = $param1;
    $endUseList = $param2;
    $loanProduct = $param2;
    $amount = $param3;
    $loanTenure = $param4;
    $companySharePledged = null;
    $bscNscCode = null;
    if (isset($param5) && isset($param6)) {
      $companySharePledged = $param5;
      $bscNscCode = $param6;
      $loanId = $param7;
    } else {
      $loanId = $param5;
    }
    $sales = MasterData::sales();
    $cities = MasterData::cities();
    $states = MasterData::states();
    $choosenSales = null;
    $userType = MasterData::userType();
    $industryTypes = MasterData::industryTypes(false);
    $businessVintage = MasterData::businessVintage();
    $choosenUserType = null;
    $loanApplicationId = null;
    $chosenproductType = null;
    $existingCompanyDeails = null;
    $existingCompanyDeailsCount = 0;
    $maxCompanyDetails = Config::get('constants.CONST_MAX_COMPANY_DETAIL');
    $newCompanyDeailsNum = $maxCompanyDetails - $existingCompanyDeailsCount;
    $salesAreaDetailId = null;
    $salesAreaDetails = null;
    $loansStatus = null;
    $loan = null;
    $isReadOnly = Config::get('constants.CONST_IS_READ_ONLY');
    $setDisable = null;
    $status = null;
    $user = null;
    $userProfile = null;
    $isRemoveMandatory = MasterData::removeMandatory();
    $isRemoveMandatory = array_except($isRemoveMandatory, ['']);
    $removeMandatoryHelper = new validLoanUrlhelper();
    $removeMandatory = $removeMandatoryHelper->getMandatory($user, $isRemoveMandatory);
    //        $removeMandatory  = $this->getMandatory($user);
    //        dd($removeMandatory,$setDisable);
    $validLoanHelper = new validLoanUrlhelper();
    $setDisable = $this->getIsDisabled($user);
    if (isset($loanId)) {
      $validLoan = $validLoanHelper->isValidLoan($loanId);
      if (!$validLoan) {
        return view('loans.error');
      }
      $status = $validLoanHelper->getTabStatus($loanId, 'background');
      if ($status == 'Y' && $setDisable != 'disabled') {
        $setDisable = 'disabled';
      }
    }
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
      if (isset($loan)) {
        $salesAreaDetailId = $loan->id;
      }
      if (isset($salesAreaDetailId)) {
        $salesAreaDetails = SalesAreaDetails::where('loan_id', '=', $salesAreaDetailId)->first();
      }
      $user = User::find($loan->user_id);
      $userProfile = $user->userProfile();
      $model = $loan->getBusinessOperationalDetails()->get()->first();
    }
    if (isset($salesAreaDetails)) {
      if (in_array($salesAreaDetails->city_name, $cities)) {
        $salesAreaDetails->city_name = $salesAreaDetails->city_name;
      } else {
        $salesAreaDetails->city_name_other = $salesAreaDetails->city_name;
        $salesAreaDetails->city_name = 'Other';
      }
      if (in_array($salesAreaDetails->city_name_1, $cities)) {
        $salesAreaDetails->city_name_1 = $salesAreaDetails->city_name_1;
      } else {
        $salesAreaDetails->city_name_other_1 = $salesAreaDetails->city_name_1;
        $salesAreaDetails->city_name_1 = 'Other';
      }
      if (in_array($salesAreaDetails->city_name_2, $cities)) {
        $salesAreaDetails->city_name_2 = $salesAreaDetails->city_name_2;
      } else {
        $salesAreaDetails->city_name_other_2 = $salesAreaDetails->city_name_2;
        $salesAreaDetails->city_name_2 = 'Other';
      }
    }
    if (isset($loan)) {
      $loanApplicationId = $loan->loan_application_id;
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
    if (!isset($loan) && $loanId == null) {
      $comYourSalestype = null;
    } else {
      $choosenSales = $loan->com_your_salestoa;
      $comYourSalestype = $loan->com_your_salestype;
      if (isset($comYourSalestype) && $comYourSalestype == 'Export' || $comYourSalestype == 'Both') {
        $comAnnualValueExport = $loan->com_annual_value_exports;
      } else {
        $comAnnualValueExport = null;
      }
      //            dd($comYourSalestype,$comAnnualValueExport);
    }
    $user = Auth::user();

    if (isset($user)) {
      $userID = $user->id;
      $userEmail = $user->email;
      $userProfile = $user->userProfile();
      $isSME = $user->isSME();
    }
    if (isset($userID)) {
      $mobileAppEmail = DB::table('mobile_app_data')->where('Email', $userEmail)
      ->where('status', 0)
      ->first();
    }
    if (isset($mobileAppEmail)) {
      echo $businessType = $mobileAppEmail->BusinessType;
      $mobileAppDataID = $mobileAppEmail->id;
      $mobileKeyProduct = $mobileAppEmail->KeyProduct;
      $mobileFirmRegNo = $mobileAppEmail->FirmRegNo;
    }
    $deletedQuestionsLoan = $this->getDeletedQuestionLoan($loan, $loanType, $amount);
    $deletedQuestionHelper = new DeletedQuestionsHelper($deletedQuestionsLoan);
    
    //getting borrowers profile
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
      $loanUser = User::find($loan->user_id);
      $loanUserProfile = $loanUser->userProfile();
    }
    $userPr = UserProfile::where('user_id', '=', $userID);

    // $userProfileFirm = UserProfile::with('user')->find($userID);
    //dd($loan->user_id);
    if (isset($loan->user_id)) {
      $userPr = UserProfile::where('user_id', '=', $loan->user_id)->first();


      $userProfileFirm = UserProfile::with('user')->find($userPr->id);
    } else {
      $userProfileFirm = UserProfile::with('user')->find($userID);
    }


    $formaction = 'Loans\LoansController@postCompanyBackground';
    $subViewType = 'loans._company_background';
    return view('loans.createedit', compact(
      'formaction',
      'subViewType',
      'endUseList',
      'loanType',
      'amount',
      'loanTenure',
      'companySharePledged',
      'bscNscCode',
      'loan',
      'salesAreaDetails',
      'comYourSalestype',
      'comAnnualValueExport',
      'loanId',
      'loanApplicationId',
      'sales',
      'choosenSales',
      'userType',
      'choosenUserType',
      'maxCompanyDetails',
      'existingCompanyDeails',
      'existingCompanyDeailsCount',
      'newCompanyDeailsNum',
      'industryTypes',
      'setDisable',
      'deletedQuestionHelper',
      'cities',
      'states',
      'validLoanHelper',
      'removeMandatory',
      'businessVintage',
      'userProfile',
      'businessType',
      'mobileAppDataID',
      'userProfileFirm',
      'mobileKeyProduct',
      'mobileFirmRegNo',
      'loanUserProfile',
      'isSME',
      'model'
    ));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @param Request $request
   *
   * @return Response
   */
  public function postCompanyBackground(Request $request)
  {
    $input = Input::all();

    /*  if (isset($input['com_vat_1']) || $input['com_vat'] == null) {
    $input['com_vat'] = $input['com_vat_1'];
  }*/


  $loanId = isset($input['loanId']) ? $input['loanId'] : null;
  $loanType = isset($input['type']) ? $input['type'] : null;
  $amount = isset($input['loan_amount']) ? $input['loan_amount'] : null;
  $loanTenure = isset($input['loan_tenure']) ? $input['loan_tenure'] : null;
  $endUseList = isset($input['end_use']) ? $input['end_use'] : null;
  //if loan is selected
  $companySharePledged = isset($input['companySharePledged']) ? $input['companySharePledged'] : null;
  $bscNscCode = isset($input['bscNscCode']) ? $input['bscNscCode'] : null;
  $id = $input['id'];
  $loan = null;
  $fieldsArr = [];
  $rulesArr = [];
  $messagesArr = [];
  $user = Auth::getUser();
  $userProfile = Auth::getUser()->userProfile();
  if (isset($loanId)) {
    $loans = Loan::find($loanId);
    $deletedQuestionsLoan = $this->getDeletedQuestionLoan($loan, $loanType, $amount);
    $deletedQuestionHelper = new DeletedQuestionsHelper($deletedQuestionsLoan);
    if ($deletedQuestionHelper->isQuestionValid("A1.1")) {
      $fieldsArr['com_business_type'] = $input['com_business_type'];
      $rulesArr['com_business_type'] = 'required';
      $messagesArr['com_business_type.required'] = 'Business Type is required in KYC Details Tab.';
    }

    if ($deletedQuestionHelper->isQuestionValid("A1.3")) {
      if (isset($userProfile) && $userProfile->owner_entity_type == "Pvt Ltd Company") {
        $fieldsArr['com_cin_no'] = $input['com_cin_no'];
        $rulesArr['com_cin_no'] = 'required';
        $messagesArr['com_cin_no.required'] = 'Cin number is required in KYC Details Tab.';
      }
    }
    $isSME = $user->isSME();
    if ($deletedQuestionHelper->isQuestionValid("A1.4") && !$isSME) {
      $fieldsArr['com_service_tax_no'] = $input['com_service_tax_no'];
      $rulesArr['com_service_tax_no'] = 'required';
      $messagesArr['com_service_tax_no.required'] = 'Service tax no is required in KYC Details Tab.';
    }
    if ($deletedQuestionHelper->isQuestionValid("A2")) {
      $fieldsArr['com_industry_segment'] = $input['com_industry_segment'];
      $rulesArr['com_industry_segment'] = 'required';
      $messagesArr['com_industry_segment.required'] = 'Industry Segment is required in Business Background Tab.';
    }




    $validator = Validator::make($fieldsArr, $rulesArr, $messagesArr);
    if ($validator->fails()) {
      return Redirect::back()->withErrors($validator)->withInput();
    } else {
  //$user = Auth::getUser();
  //$userProfile =  Auth::getUser()->userProfile();
      $input['user_id'] = $user->id;
      if (isset($loanId)) {
        if (isset($loans)) {
          $salesAreaDetailId = $loans->id;
        } else {
          $salesAreaDetailId = null;
        }
      }


      $loan = Loan::updateOrCreate(['id' => $salesAreaDetailId], $input);


      $loan->status = "Pending";
      if (isset($userProfile)) {
        $loan->turnover = $userProfile->latest_turnover;
      }
      $loanId = $loan->id;
      $loan->save();
      $loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loan->id], ['loan_id' => $loanId, 'background' => 'Y']);


      $loansStatus->save();
      BusinessOperationalDetail::updateOrCreate(['loan_id' => $loan->id], $input);
      $this->getLoansStatus($loanId);


      $user = Auth::user();
      if (isset($user)) {
        $userID = $user->id;
        $userEmail = $user->email;
      }
      if (isset($userID)) {
        $mobileAppEmail = DB::table('mobile_app_data')->where('Email', $userEmail)
        ->where('status', 0)
        ->first();
      }
      if (isset($mobileAppEmail)) {
        $fileHelper = new FileHelper();
        $directory = $userID . "/" . $loanId;
        $uploadDetails = null;
        $mobileAppDataID = $mobileAppEmail->id;
    //                  Promoter Tabs mobile_app_data
        $degree = $mobileAppEmail->Degree;
        $cibilScore = $mobileAppEmail->CibilScore;
        $independent = $mobileAppEmail->Independent;
        $mobilePromoType = $mobileAppEmail->PromoType;
        $ownedVehicle = $mobileAppEmail->OwnedVehicle;
        $vehicleMarketValue = $mobileAppEmail->MarketValue;
        $ownedProperty = $mobileAppEmail->OwnedProperty;
        $mobileLenderName = $mobileAppEmail->LenderName;
        $mobileOutstandingAmt = $mobileAppEmail->OutstandingAmt;
        $mobileMonthlyEmi = $mobileAppEmail->MonthlyEmi;
        $mobileLiability = $mobileAppEmail->Liability;
    //                  Financials Tab mobile_app_data
        $DefaultNoOfExistingLoan = 1;
        $MobileBankName = $mobileAppEmail->BankName;
        $MobileAmount = $mobileAppEmail->Amount;
    //                  Business Tab mobile_app_data
        $officePremiseOwned = $mobileAppEmail->OfficePremiseOwned;
        $officePremiseRented = $mobileAppEmail->OfficePremiseRented;
        $manufacturePremise = $mobileAppEmail->ManufacturePremise;
        $mobilecust1 = $mobileAppEmail->cust1;
        $mobilesale1 = $mobileAppEmail->sale1;
        $mobileyear1 = $mobileAppEmail->year1;
        $mobilecust2 = $mobileAppEmail->cust2;
        $mobilesale2 = $mobileAppEmail->sale2;
        $mobileyear2 = $mobileAppEmail->year2;
        $mobilecust3 = $mobileAppEmail->cust3;
        $mobilesale3 = $mobileAppEmail->sale3;
        $mobileyear3 = $mobileAppEmail->year3;
        if (isset($officePremiseOwned) && $officePremiseOwned != 0) {
          $officepremiseType = 1;
        } else if (isset($officePremiseRented) && $officePremiseRented != 0) {
          $officepremiseType = 2;
        }
    //                  Security Tab mobile_app_data
        $mobileAppCollateralType = $mobileAppEmail->CollateralType;
        $mobileAppPropType = $mobileAppEmail->PropType;
        $mobileAppColAddress = $mobileAppEmail->ColAddress;
        $mobileAppColCity = $mobileAppEmail->ColCity;
        $mobileAppColPincode = $mobileAppEmail->ColPincode;
        $mobileAppLatestVal = $mobileAppEmail->LatestVal;
    //                  Upload Doc Tab mobile_app_data
        $mobileAppCompFinUpd = $mobileAppEmail->comp_fin_upd;
        $mobileAppCompPanUpd = $mobileAppEmail->comp_pan_upd;
        $mobileAppCompAddrUpd = $mobileAppEmail->comp_addr_upd;
        $mobileAppPromAddrUpd = $mobileAppEmail->prom_addr_upd;
        $mobileAppPromPanUpd = $mobileAppEmail->prom_pan_upd;
        $mobileAppPromBankUpd = $mobileAppEmail->prom_bank_upd;
        $mobileAppPromCibilUpd = $mobileAppEmail->prom_cibil_upd;
      }
      if (isset($mobileAppDataID)) {
    //                  For Promoter Tab data inserting from mobile_app_data
        $promoterDetails = PromoterDetails::updateOrCreate(['loan_id' => $loanId], [
          'fin_vehiclesowned' => $ownedVehicle,
          'fin_vehiclesowned_marketvalue' => $vehicleMarketValue, 'fin_propertiesowned' => $ownedProperty, 'borrowloan_bankname' => $mobileLenderName,
          'borrowloan_amtoutstanding' => $mobileOutstandingAmt, 'borrowloan_monthlyemi' => $mobileMonthlyEmi, 'borrowloan_totalliability' => $mobileLiability,
          'othr_eduprofdegree' => $degree, 'othr_promoterare' => $mobilePromoType, 'othr_noofindependent' => $independent,
          'othr_doyouknowcibil' => 'Yes', 'othr_cibilscore' => $cibilScore
        ]);
    //                  For Financial Tab data inserting from mobile_app_data
        $loan = Loan::updateOrCreate(['id' => $loanId], [
          'fin_numofexistingloan' => $DefaultNoOfExistingLoan,
          'fin_doyouknowcibil' => 'Yes', 'fin_cibilscore' => $cibilScore
        ]);
        DB::table('loans_existingloan_details')->where('loan_id', '=', $loanId)->delete();
        DB::table('loans_existingloan_details')->insert([
          'loan_id' => $loanId,
          'name' => $MobileBankName,
          'amount_outstanding' => $MobileAmount,
        ]);
    //                  For Business Tab data inserting from mobile_app_data
        BusinessOperationalDetail::updateOrCreate(['loan_id' => $loanId], [
          'officepremise_type' => $officepremiseType,
          'approx_value' => $officePremiseOwned, 'monthly_rentpaid' => $officePremiseRented, 'mfgpremise_type' => 'owned',
          'approx_land_value' => $manufacturePremise, 'top3_custname_1' => $mobilecust1, 'top3_annsales_1' => $mobilesale1,
          'top3_relationsince_1' => $mobileyear1, 'top3_custname_2' => $mobilecust2, 'top3_annsales_2' => $mobilesale2,
          'top3_relationsince_2' => $mobileyear2, 'top3_custname_3' => $mobilecust3, 'top3_annsales_3' => $mobilesale3,
          'top3_relationsince_3' => $mobileyear3
        ]);
    //                  For Security Tab data inserting from mobile_app_data
        SecurityDetail::updateOrCreate(['loan_id' => $loanId], [
          'collateral_type' => $mobileAppPropType,
          'area' => $mobileAppColAddress, 'city' => $mobileAppColCity, 'pincode' => $mobileAppColPincode,
          'latest_valuation' => $mobileAppLatestVal, 'occupied_type' => $mobileAppCollateralType
        ]);
    //                  For Upload Doc tab datat inserting from mobile_app_data
    //                  For Financials Reports (FY2014-15) field of upload doc tab
        if (isset($mobileAppCompFinUpd)) {
          $file = $mobileAppCompFinUpd;
          $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'FY2014-15' . '_' . $file;
          $fieldName = $mobileAppCompFinUpd;
          if (!isset($uploadDetails)) {
            $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], ['finyear_file1_path' => $uploadedFileName]);
          }
          $fileHelper->copyFile($directory, $uploadedFileName, $file);
          $uploadDetails->setAttribute($fieldName, $uploadedFileName);
        }

    //new

        if (isset($mobileAppCompFinUpd)) {
          $file = $mobileAppCompFinUpd;
          $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'FY2014-15' . '_' . $file;
          $fieldName = $mobileAppCompFinUpd;
          if (!isset($uploadDetails)) {
            $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], ['other_file1_path' => $uploadedFileName]);
          }
          $fileHelper->copyFile($directory, $uploadedFileName, $file);
          $uploadDetails->setAttribute($fieldName, $uploadedFileName);
        }

//end new

    //                  For company kyc & financial-> kyc details-> PAN card field of upload doc tab
        if (isset($mobileAppCompPanUpd)) {
          $file = $mobileAppCompPanUpd;
          $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'company_pancard' . '_' . $file;
          $fieldName = $mobileAppCompPanUpd;
          if (isset($uploadDetails)) {
            $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], ['pancard_file_path' => $uploadedFileName]);
          }
          $fileHelper->copyFile($directory, $uploadedFileName, $file);
          $uploadDetails->setAttribute($fieldName, $uploadedFileName);
        }


    //new
        if (isset($mobileAppCompPanUpd)) {
          $file = $mobileAppCompPanUpd;
          $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'moa_company' . '_' . $file;
          $fieldName = $mobileAppCompPanUpd;
          if (isset($uploadDetails)) {
            $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], ['moa_file_path' => $uploadedFileName]);
          }
          $fileHelper->copyFile($directory, $uploadedFileName, $file);
          $uploadDetails->setAttribute($fieldName, $uploadedFileName);
        }


    //end new
    //                  For company kyc & financial-> kyc details-> Address Proof field of upload doc tab
        if (isset($mobileAppCompAddrUpd)) {
          $file = $mobileAppCompAddrUpd;
          $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'company_address_proof' . '_' . $file;
          $fieldName = $mobileAppCompAddrUpd;
          if (isset($uploadDetails)) {
            $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], ['addproof_file_path' => $uploadedFileName]);
          }
          $fileHelper->copyFile($directory, $uploadedFileName, $file);
          $uploadDetails->setAttribute($fieldName, $uploadedFileName);
        }

    //new
        if (isset($mobileAppCompAddrUpd)) {
          $file = $mobileAppCompAddrUpd;
          $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'gst_company' . '_' . $file;
          $fieldName = $mobileAppCompAddrUpd;
          if (isset($uploadDetails)) {
            $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], ['gst_file_path' => $uploadedFileName]);
          }
          $fileHelper->copyFile($directory, $uploadedFileName, $file);
          $uploadDetails->setAttribute($fieldName, $uploadedFileName);
        }


    //end new
    //                  For promoter kyc & financial-> kyc details-> address proof field of upload doc tab
        if (isset($mobileAppPromAddrUpd)) {
          $file = $mobileAppPromAddrUpd;
          $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'promoter_address_proof' . '_' . $file;
          $fieldName = $mobileAppPromAddrUpd;
          if (isset($uploadDetails)) {
            $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], ['prom_kyc_addproof_file_path' => $uploadedFileName]);
          }
          $fileHelper->copyFile($directory, $uploadedFileName, $file);
          $uploadDetails->setAttribute($fieldName, $uploadedFileName);
        }

    //new
        if (isset($mobileAppPromAddrUpd)) {
          $file = $mobileAppPromAddrUpd;
          $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'promoter_pan_proof' . '_' . $file;
          $fieldName = $mobileAppPromAddrUpd;
          if (isset($uploadDetails)) {
            $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], ['prom_kyc_pan_file_path' => $uploadedFileName]);
          }
          $fileHelper->copyFile($directory, $uploadedFileName, $file);
          $uploadDetails->setAttribute($fieldName, $uploadedFileName);
        }


    //end new
    //promoter 2
        if (isset($mobileAppPromAddrUpd)) {
          $file = $mobileAppPromAddrUpd;
          $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'promoter_pancard' . '_' . $file;
          $fieldName = $mobileAppPromAddrUpd;
          if (isset($uploadDetails)) {
            $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], ['prom_pancard_file_path' => $uploadedFileName]);
          }
          $fileHelper->copyFile($directory, $uploadedFileName, $file);
          $uploadDetails->setAttribute($fieldName, $uploadedFileName);
        }

    //promoter 3

        if (isset($mobileAppPromAddrUpd)) {
          $file = $mobileAppPromAddrUpd;
          $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'other_promoter' . '_' . $file;
          $fieldName = $mobileAppPromAddrUpd;
          if (isset($uploadDetails)) {
            $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], ['other_promoter_file' => $uploadedFileName]);
          }
          $fileHelper->copyFile($directory, $uploadedFileName, $file);
          $uploadDetails->setAttribute($fieldName, $uploadedFileName);
        }



    //promoter 4

        if (isset($mobileAppPromAddrUpd)) {
          $file = $mobileAppPromAddrUpd;
          $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'promoter_idproof' . '_' . $file;
          $fieldName = $mobileAppPromAddrUpd;
          if (isset($uploadDetails)) {
            $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], ['prom_idproof_file_path' => $uploadedFileName]);
          }
          $fileHelper->copyFile($directory, $uploadedFileName, $file);
          $uploadDetails->setAttribute($fieldName, $uploadedFileName);
        }


    //new

        if (isset($mobileAppPromAddrUpd)) {
          $file = $mobileAppPromAddrUpd;
          $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'promoter_addproof' . '_' . $file;
          $fieldName = $mobileAppPromAddrUpd;
          if (isset($uploadDetails)) {
            $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], ['prom_addproof_file_path' => $uploadedFileName]);
          }
          $fileHelper->copyFile($directory, $uploadedFileName, $file);
          $uploadDetails->setAttribute($fieldName, $uploadedFileName);
        }


    //end new



    //promoter 5
    //                  For promoter kyc & financial-> kyc details-> PAN card field of upload doc tab
        if (isset($mobileAppPromPanUpd)) {
          $file = $mobileAppPromPanUpd;
          $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'promoter_pancard' . '_' . $file;
          $fieldName = $mobileAppPromPanUpd;
          if (isset($uploadDetails)) {
            $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], ['prom_pancard_file_path' => $uploadedFileName]);
          }
          $fileHelper->copyFile($directory, $uploadedFileName, $file);
          $uploadDetails->setAttribute($fieldName, $uploadedFileName);
        }

    //promoter 6

        if (isset($mobileAppPromPanUpd)) {
          $file = $mobileAppPromPanUpd;
          $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'visitingcard_file' . '_' . $file;
          $fieldName = $mobileAppPromPanUpd;
          if (isset($uploadDetails)) {
            $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], ['prom_visiting_file_path' => $uploadedFileName]);
          }
          $fileHelper->copyFile($directory, $uploadedFileName, $file);
          $uploadDetails->setAttribute($fieldName, $uploadedFileName);
        }

    //new
        if (isset($mobileAppPromPanUpd)) {
          $file = $mobileAppPromPanUpd;
          $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'network_file' . '_' . $file;
          $fieldName = $mobileAppPromPanUpd;
          if (isset($uploadDetails)) {
            $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], ['prom_network_file_path' => $uploadedFileName]);
          }
          $fileHelper->copyFile($directory, $uploadedFileName, $file);
          $uploadDetails->setAttribute($fieldName, $uploadedFileName);
        }

        if (isset($mobileAppPromPanUpd)) {
          $file = $mobileAppPromPanUpd;
          $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'cibil_file' . '_' . $file;
          $fieldName = $mobileAppPromPanUpd;
          if (isset($uploadDetails)) {
            $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], ['prom_cibil_file_path' => $uploadedFileName]);
          }
          $fileHelper->copyFile($directory, $uploadedFileName, $file);
          $uploadDetails->setAttribute($fieldName, $uploadedFileName);
        }


    //end new

    //                  For promoter kyc & financial-> Bank Statements-> Bank Statements field of upload doc tab
        if (isset($mobileAppPromBankUpd)) {
          $file = $mobileAppPromBankUpd;
          $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'promoter_bankStmt' . '_' . $file;
          $fieldName = $mobileAppPromBankUpd;
          if (isset($uploadDetails)) {
            $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], ['prom_bank_stmt_file_path' => $uploadedFileName]);
          }
          $fileHelper->copyFile($directory, $uploadedFileName, $file);
          $uploadDetails->setAttribute($fieldName, $uploadedFileName);
        }
    //                  For promoter kyc & financial-> Financial-> CIBIL report (optional) field of upload doc tab
        if (isset($mobileAppPromCibilUpd)) {
          $file = $mobileAppPromCibilUpd;
          $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'promoter_cibil' . '_' . $file;
          $fieldName = $mobileAppPromCibilUpd;
          if (isset($uploadDetails)) {
            $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], ['prom_cibilreport_file_path' => $uploadedFileName]);
          }
          $fileHelper->copyFile($directory, $uploadedFileName, $file);
          $uploadDetails->setAttribute($fieldName, $uploadedFileName);
        }
    //                  For updating mobile_app_data tables status from 0 to 1
        $MobileAppDataStatus = MobileAppData::updateOrCreate(['id' => $mobileAppDataID], ['status' => 1]);
      }
    }

  }
  $redirectUrl = $this->generateRedirectURL('loans/promoter', $endUseList, $loanType, $amount, $loanTenure, $companySharePledged, $bscNscCode, $loanId);
  return Redirect::to($redirectUrl);
}

  /**
   * Display a listing of the resource.
   * @param $loanType
   * @param $endUseList
   * @param $amount
   * @param $chosenLoanTenure
   * @param $loanId
   * @return Response
   */
  public function getPromoter($param1 = null, $param2 = null, $param3 = null, $param4 = null, $param5 = null, $param6 = null, $param7 = null)
  {
  //$endUseList,$loanType, $amount=null, $loanTenure = null, $companySharePledged= null, $bscNscCode = null,$loanId=null
    $endUseList = $param1;
    $loanType = $param2;
    $loanProduct = $param2;
    $amount = $param3;
    $loanTenure = $param4;
    $companySharePledged = null;
    $bscNscCode = null;
    if (isset($param5) && isset($param6)) {
      $companySharePledged = $param5;
      $bscNscCode = $param6;
      $loanId = $param7;
    } else {
      $loanId = $param5;
    }
    $promotersGenerationType = MasterData::promoterGenrationType();
    $choosenCibil = null;
    $degreeType = MasterData::degreeTypes();
    $noOfFamilyTypes = MasterData::familyType();
    $cities = MasterData::cities();
    $states = MasterData::states();
    $loan = null;
    $model = null;
    $existingPropertyOwned = null;
    $existingLoansMortgageDetails = null;
    $setDisable = null;
    $existingPromoterKycCount = 0;
    $promoter_details = null;
    $isFunded = 0;
    $userProfile = Auth::getUser()->userProfile();
    $user = Auth::getUser();
    $isSME = $user->isSME();
    $setDisable = $this->getIsDisabled($user);
    $isRemoveMandatory = MasterData::removeMandatory();
    $isRemoveMandatory = array_except($isRemoveMandatory, ['']);
    $removeMandatoryHelper = new validLoanUrlhelper();
    $removeMandatory = $removeMandatoryHelper->getMandatory($user, $isRemoveMandatory);
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
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
      $isFunded = $loan->com_venture_capital_funded;
      if ($isFunded == null) {
        $isFunded = 0;
      }
      $model = $loan->getPromoterDetails()->get()->first();
      if (isset($model)) {
        if ($model->fin_propertiesowned > 0 && $model->fin_propertiesowned != 'None') {
          $existingPropertyOwned = PromoterPropertyDetail::where('loan_id', '=', $loanId)->get()->toArray();
        }
      /*           if(isset($existingPropertyOwned)){
      if (in_array($existingPropertyOwned->location_city, $cities)) {
      $existingPropertyOwned->location_city = $existingPropertyOwned->location_city;
    }else{
    $salesAreaDetails->city_name_other = $salesAreaDetails->city_name;
    $salesAreaDetails->city_name = 'Other';
  }
}*/

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
$existingPromoterKycDetails = PromoterKycDetails::where('loan_id', '=', $loanId)->get();
$existingLoanOverdraftDetails = LoanOverdraftKycDetails::where('loan_id', '=', $loanId)->get();
$existingLoansMortgageDetails = LoansMortgageDetails::where('loan_id', '=', $loanId)->get();
$existingLoanVechicleDetails = LoanVechicleDetails::where('loan_id', '=', $loanId)->get();
$existingLoanCreditCardDetails = LoanCreditCardDetails::where('loan_id', '=', $loanId)->get();

}


//Promoter Array
if (isset($existingPromoterKycDetails)) {
  $existingPromoterKycCount = count($existingPromoterKycDetails);
}
    $maxPromoters = Config::get('constants.CONST_MAX_PROMOTER');   //5

    $temp_array = [];
//$mortgagetemp_array = array();
    for ($i = 0; $i < 5; $i++) {
      if ($i < $existingPromoterKycCount) {
        array_push($temp_array, $existingPromoterKycDetails[$i]->toArray());
      } else {
        array_push($temp_array, "");
      }
    }

//Overdraft array
    if (isset($existingLoanOverdraftDetails)) {
      $existingLoanOverdraftCount = count($existingLoanOverdraftDetails);
    }
    $maxoverdrafts = '3';

    $temp_array_overdr = [];
    for ($o = 0; $o < 3; $o++) {
      if ($o < $existingLoanOverdraftCount) {
        array_push($temp_array_overdr, $existingLoanOverdraftDetails[$o]->toArray());
      } else {
        array_push($temp_array_overdr, "");
      }
    }

//Mortgage array
    if (isset($existingLoansMortgageDetails)) {
      $existingLoansMortgageCount = count($existingLoansMortgageDetails);
    }
    $maxmortgages = '3';

    $temp_array_mortgage = [];
    for ($mort = 0; $mort < 3; $mort++) {
      if ($mort < $existingLoansMortgageCount) {
        array_push($temp_array_mortgage, $existingLoansMortgageDetails[$mort]->toArray());
      } else {
        array_push($temp_array_mortgage, "");
      }
    }

//Liblities Vechicle Loan

    if (isset($existingLoanVechicleDetails)) {
      $existingLoanVechicleCount = count($existingLoanVechicleDetails);
    }
    $maxvehicles = '3';
    $temp_array_vechicle = [];
    for ($vechicle = 0; $vechicle < 3; $vechicle++) {
      if ($vechicle < $existingLoanVechicleCount) {
        array_push($temp_array_vechicle, $existingLoanVechicleDetails[$vechicle]->toArray());
      } else {
        array_push($temp_array_vechicle, "");
      }

    }

//Liblities Creditcard Loan

    if (isset($existingLoanCreditCardDetails)) {
      $existingCreditCardCount = count($existingLoanCreditCardDetails);
    }
    $maxCreditCards = '4';
    $temp_array_creditcard = [];
    for ($creditcard = 0; $creditcard < 3; $creditcard++) {
      if ($creditcard < $existingCreditCardCount) {
        array_push($temp_array_creditcard, $existingLoanCreditCardDetails[$creditcard]->toArray());
      } else {
        array_push($temp_array_creditcard, "");
      }

    }





    $deletedQuestionsLoan = $this->getDeletedQuestionLoan($loan, $loanType, $amount);
    $deletedQuestionHelper = new DeletedQuestionsHelper($deletedQuestionsLoan);
//getting borrowers profile
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
      $loanUser = User::find($loan->user_id);
      $loanUserProfile = $loanUser->userProfile();
    }
    $userPr = UserProfile::where('user_id', '=', $loan->user_id)->first();
    $userProfileFirm = UserProfile::with('user')->find($userPr->id);
    if ($isSME != null) {
  // dd(Auth::getUser()->userProfile()->owner_email);
  //$owner_entity_type =  Auth::getUser()->userProfile()->owner_entity_type;
      $owner_entity_type = Auth::getUser()->userProfile();
    }
    $subViewType = 'loans._promoter';
    $formaction = 'Loans\LoansController@postPromoter';
    return view('loans.createedit', compact(
      'formaction',
      'subViewType',
      'endUseList',
      'loanType',
      'amount',
      'loanTenure',
      'companySharePledged',
      'bscNscCode',
      'loan',
      'cities',
      'loanId',
      'maxPromoters',
      'maxCreditCards',
      'maxmortgages',
      'maxvehicles',
      'maxoverdrafts',
      'existingPromoterCreditCardCount',
      'promotersGenerationType',
      'degreeType',
      'noOfFamilyTypes',
      'temp_array',
      'userProfile',
      'states',
      'setDisable',
      'deletedQuestionHelper',
      'existingPromoterKycCount',
      'existingPropertyOwned',
      'existingLoansMortgageDetails',
      'model',
      'validLoanHelper',
      'owner_entity_type',
      'removeMandatory',
      'loanUserProfile',
      'userProfileFirm',
      'isFunded',
      'isSME',
      'existingLoanOverdraftCount',
      'existingLoansMortgageCount',
      'existingLoanOverdraftDetails',
      'existingLoanVechicleDetails',
      'temp_array_overdr',
      'temp_array_mortgage',
      'temp_array_vechicle',
      'temp_array_creditcard',
      'existingLoanVechicleCount',
      'existingCreditCardCount'
    ));
  }

  public function postPromoter(Request $request)
  {
    $input = Input::all();
  /*   echo $numOfOverdraft=$input['counter_OD_storage'].'od<br>';
  echo $counter = $input['counter_storage'].'promoter';
     */
  //  dd($input);
  $loanId = isset($input['loanId']) ? $input['loanId'] : null;
  $loanType = isset($input['type']) ? $input['type'] : null;
  $amount = isset($input['loan_amount']) ? $input['loan_amount'] : null;
  $loanTenure = isset($input['loan_tenure']) ? $input['loan_tenure'] : null;
  $endUseList = isset($input['end_use']) ? $input['end_use'] : null;
  // dd($loanType ,$endUseList , $amount , $loanTenure );
  //if loan is selected
  $companySharePledged = isset($input['companySharePledged']) ? $input['companySharePledged'] : null;
  $bscNscCode = isset($input['bscNscCode']) ? $input['bscNscCode'] : null;
  $fieldsArr = [];
  $rulesArr = [];
  $messagesArr = [];
    $counter = $input['counter_storage']; //get the count from front end
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
    }
    $mortgage = $input['mortgage'];
    $loanArray = ['loan_id' => $loanId];
  //  print_r(array_values(array_filter($mortgage)));
    $mortgageFilter = array_map('array_filter', $mortgage);
    $filtredMortgage = array_filter($mortgageFilter);
    DB::table('loans_mortgage_details')->where('loan_id', '=', $loanId)->delete();
    foreach ($filtredMortgage as $value) {
      $insertMortgage = $loanArray + $value;
    //Model::updateOrCreate($insertMortgage);
      $promoterDetailssas = LoansMortgageDetails::insert($insertMortgage);
    }
  //  dd( $input);
  //dd(array_filter($input));
  //$loantest = LoansMortgageDetails::all();
  // $loantest = LoansMortgageDetails::findOrFail($loanId);
    $loantest = LoansMortgageDetails::where('loan_id', '=', $loanId)->get();
    $deletedQuestionsLoan = $this->getDeletedQuestionLoan($loan, $loanType, $amount);
    $deletedQuestionHelper = new DeletedQuestionsHelper($deletedQuestionsLoan);
    if ($counter == 0) {

      if ($deletedQuestionHelper->isQuestionValid("B1.1")) {
        $fieldsArr['kyc_name' . $counter] = $input['promoters'][$counter]['kyc_name'];
        $rulesArr['kyc_name' . $counter] = 'required';
        $messagesArr['kyc_name' . $counter . '.required'] = 'Promoter Details ' . ($counter + 1) . ' - Name is required.';
      }
      if ($deletedQuestionHelper->isQuestionValid("B1.3")) {
        $fieldsArr['kyc_pan' . $counter] = $input['promoters'][$counter]['kyc_pan'];
        $rulesArr['kyc_pan' . $counter] = 'required|Regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/';
        $messagesArr['kyc_pan' . $counter . '.required'] = 'Promoter Details ' . ($counter + 1) . ' - PAN is required & Format Should be XXXXX1111X';
      }


      if ($deletedQuestionHelper->isQuestionValid("B1.2")) {
      //                $fieldsArr['kyc_din' . $counter] = $input['promoters'][$counter]['kyc_din'];
      //                $rulesArr['kyc_din' . $counter] = 'required';
      //                $messagesArr['kyc_din' . $counter . '.required'] = 'Promoter Details ' . ($counter + 1) . ' - Director Identification Number is required.';
      }
      if ($deletedQuestionHelper->isQuestionValid("B1.6")) {
        $fieldsArr['kyc_address' . $counter] = $input['promoters'][$counter]['kyc_address'];
        $rulesArr['kyc_address' . $counter] = 'required';
        $messagesArr['kyc_address' . $counter . '.required'] = 'Promoter Details ' . ($counter + 1) . ' - Address is required.';
      }
      if ($deletedQuestionHelper->isQuestionValid("B1.7")) {
        $fieldsArr['kyc_state' . $counter] = $input['promoters'][$counter]['kyc_state'];
        $rulesArr['kyc_state' . $counter] = 'required';
        $messagesArr['kyc_state' . $counter . '.required'] = 'Promoter Details ' . ($counter + 1) . ' - State is required.';
      }
      if ($deletedQuestionHelper->isQuestionValid("B1.8")) {
        $fieldsArr['kyc_pin' . $counter] = $input['promoters'][$counter]['kyc_pin'];
        $rulesArr['kyc_pin' . $counter] = 'required';
        $messagesArr['kyc_pin' . $counter . '.required'] = 'Promoter Details ' . ($counter + 1) . ' - Pincode Field is required.';
      }
      echo "first";
    } else {
      $counter++;
      for ($i = 0; $i < $counter; $i++) {
        echo "next";
        if ($deletedQuestionHelper->isQuestionValid("B1.1")) {
          $fieldsArr['kyc_name' . $i] = $input['promoters'][$i]['kyc_name'];
          $rulesArr['kyc_name' . $i] = 'required';
          $messagesArr['kyc_name' . $i . '.required'] = 'Promoter Details ' . ($i + 1) . ' - Name is required.';
        }
       // if ($deletedQuestionHelper->isQuestionValid("B1.3")) {
        $fieldsArr['kyc_pan' . $i] = $input['promoters'][$i]['kyc_pan'];
        $rulesArr['kyc_pan' . $i] = 'required|Regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/';
        $messagesArr['kyc_pan' . $i . '.required'] = 'Promoter Details ' . ($i + 1) . ' - PAN is required & Format Should be XXXXX1111X';
       // }

        if ($deletedQuestionHelper->isQuestionValid("B1.2")) {
        //                    $fieldsArr['kyc_din' . $i] = $input['promoters'][$i]['kyc_din'];
        //                    $rulesArr['kyc_din' . $i] = 'required';
        //                    $messagesArr['kyc_din' . $i . '.required'] = 'Promoter Details ' . ($i + 1) . ' - Director Identification Number is required.';
        }
        if ($deletedQuestionHelper->isQuestionValid("B1.7")) {
          $fieldsArr['kyc_state' . $i] = $input['promoters'][$i]['kyc_state'];
          $rulesArr['kyc_state' . $i] = 'required';
          $messagesArr['kyc_state' . $i . '.required'] = 'Promoter Details ' . ($i + 1) . ' - State is required.';
        }
        if ($deletedQuestionHelper->isQuestionValid("B1.8")) {
          $fieldsArr['kyc_pin' . $i] = $input['promoters'][$i]['kyc_pin'];
          $rulesArr['kyc_pin' . $i] = 'required';
          $messagesArr['kyc_pin' . $i . '.required'] = 'Promoter Details ' . ($i + 1) . ' - Pincode Field is required.';
        }
        if ($deletedQuestionHelper->isQuestionValid("B1.6")) {
          $fieldsArr['kyc_address' . $i] = $input['promoters'][$i]['kyc_address'];
          $rulesArr['kyc_address' . $i] = 'required';
          $messagesArr['kyc_address' . $i . '.required'] = 'Promoter Details ' . ($i + 1) . ' - Address is required.';
        }
      }
    }
    if ($deletedQuestionHelper->isQuestionValid("B2.2")) {
    //$fieldsArr['fin_propertiesowned'] = $input['fin_propertiesowned'];
    //$rulesArr['fin_propertiesowned'] = 'required';
    //$messagesArr['fin_propertiesowned.required'] = 'Financial Details - Property Owned Field is required.';
      $numOfPropertyOwned = $input['fin_propertiesowned'];
      if (isset($numOfPropertyOwned) && $numOfPropertyOwned != 0 && $numOfPropertyOwned != 'None') {
        for ($i = 1; $i <= $numOfPropertyOwned; $i++) {
          if ($i != 4) {
            $fieldsArr['property_type' . $i] = $input['propertyDetails'][$i]['property_type'];
            $rulesArr['property_type' . $i] = 'required';
            $messagesArr['property_type' . $i . '.required'] = 'Financial Details Property Details ' . ($i) . ' - Property Type is required.';
            $fieldsArr['market_value' . $i] = $input['propertyDetails'][$i]['market_value'];
            $rulesArr['market_value' . $i] = 'required';
            $messagesArr['market_value' . $i . '.required'] = 'Financial Details Property Details ' . ($i) . ' - Approx Market Value of property is required.';
            $fieldsArr['location_city' . $i] = $input['propertyDetails'][$i]['location_city'];
            $rulesArr['location_city' . $i] = 'required';
            $messagesArr['location_city' . $i . '.required'] = 'Financial Details Property Details ' . ($i) . ' - Location City is required.';
            $fieldsArr['is_mortgage' . $i] = $input['propertyDetails'][$i]['is_mortgage'];
            $rulesArr['is_mortgage' . $i] = 'required';
            $messagesArr['is_mortgage' . $i . '.required'] = 'Financial Details Property Details' . ($i) . ' - Is it mortgaged is required.';
          } else {
            $fieldsArr['property_type' . $i] = $input['propertyDetails'][$i]['property_type'];
            $rulesArr['property_type' . $i] = 'required';
            $messagesArr['property_type' . $i . '.required'] = 'Financial Details Other Properties ' . ($i) . ' - Property Type is required.';
            $fieldsArr['market_value' . $i] = $input['propertyDetails'][$i]['market_value'];
            $rulesArr['market_value' . $i] = 'required';
            $messagesArr['market_value' . $i . '.required'] = 'Financial Details Other Properties ' . ($i) . ' - Approx Market Value of property is required.';
          }
        }
      }
    }
  /*
  if($deletedQuestionHelper->isQuestionValid("B2.3")) {
  $fieldsArr['fin_fixeddeposit'] = $input['fin_fixeddeposit'];
  $rulesArr['fin_fixeddeposit'] = 'required';
  $messagesArr['fin_fixeddeposit.required'] = 'Financial Details - Other Assets Owned Fixed Deposits is required.';
  $fieldsArr['fin_mutualfunds'] = $input['fin_mutualfunds'];
  $rulesArr['fin_mutualfunds'] = 'required';
  $messagesArr['fin_mutualfunds.required'] = 'Financial Details - Other Assets Owned Mutual Funds is required.';
  $fieldsArr['fin_listedshares'] = $input['fin_listedshares'];
  $rulesArr['fin_listedshares'] = 'required';
  $messagesArr['fin_listedshares.required'] = 'Financial Details - Other Assets Owned - Listed Shares Owned is required.';
}
if($deletedQuestionHelper->isQuestionValid("B2.5")) {
$fieldsArr['pl_bankname'] = $input['pl_bankname'];
$rulesArr['pl_bankname'] = 'required';
$messagesArr['pl_bankname.required'] = 'Financial Details - Personal Loan/Overdraft - Name of Bank is required.';
$fieldsArr['pl_amtoutstanding'] = $input['pl_amtoutstanding'];
$rulesArr['pl_amtoutstanding'] = 'required';
$messagesArr['pl_amtoutstanding.required'] = 'Financial Details - Personal Loan/Overdraft - Amount Outstanding is required.';
$fieldsArr['pl_monthlyemi'] = $input['pl_monthlyemi'];
$rulesArr['pl_monthlyemi'] = 'required';
$messagesArr['pl_monthlyemi.required'] = 'Financial Details - Personal Loan/Overdraft - Monthly EMI is required.';
//            $fieldsArr['pl_totalliability'] = $input['pl_totalliability'];
//            $rulesArr['pl_totalliability'] = 'required';
//            $messagesArr['pl_totalliability.required'] = 'Financial Details - Personal Loan/Overdraft - Total Liability is required.';
}
if($deletedQuestionHelper->isQuestionValid("B2.7")) {
$fieldsArr['mortloan_bankname'] = $input['mortloan_bankname'];
$rulesArr['mortloan_bankname'] = 'required';
$messagesArr['mortloan_bankname.required'] = 'Financial Details - Mortgage Loan - Name of Bank is required.';
$fieldsArr['mortloan_monthlyemi'] = $input['mortloan_monthlyemi'];
$rulesArr['mortloan_monthlyemi'] = 'required';
$messagesArr['mortloan_monthlyemi.required'] = 'Financial Details - Mortgage Loan - Monthly EMI is required.';
$fieldsArr['mortloan_amtoutstanding'] = $input['mortloan_amtoutstanding'];
$rulesArr['mortloan_amtoutstanding'] = 'required';
$messagesArr['mortloan_amtoutstanding.required'] = 'Financial Details - Mortgage Loan - Amount Outstanding is required.';
//            $fieldsArr['mortloan_totalliability'] = $input['mortloan_totalliability'];
//            $rulesArr['mortloan_totalliability'] = 'required';
//            $messagesArr['mortloan_totalliability.required'] = 'Financial Details - Mortgage Loan - Total Liability is required.';
}
     */
if ($deletedQuestionHelper->isQuestionValid("B3.1")) {
  $fieldsArr['othr_eduprofdegree'] = $input['othr_eduprofdegree'];
  $rulesArr['othr_eduprofdegree'] = 'required';
  $messagesArr['othr_eduprofdegree.required'] = 'Other Details - Additional Details - Education/professional degree is required.';
}
if ($deletedQuestionHelper->isQuestionValid("B3.2")) {
  $fieldsArr['othr_promoterare'] = $input['othr_promoterare'];
  $rulesArr['othr_promoterare'] = 'required';
  $messagesArr['othr_promoterare.required'] = 'Other Details - Additional Details - Promoters are is required.';
}
if ($deletedQuestionHelper->isQuestionValid("B3.4") && isset($input['othr_income']) && $input['othr_income'] == '1') {
  $fieldsArr['othr_sourceofincome'] = $input['othr_sourceofincome'];
  $rulesArr['othr_sourceofincome'] = 'required';
  $messagesArr['othr_sourceofincome.required'] = 'Other Details - Additional Loan Information - Does promoter have other sources of income? is required.';
}
if ($deletedQuestionHelper->isQuestionValid("B3.5")) {
  @$fieldsArr['othr_doyouknowcibil'] = @$input['othr_doyouknowcibil'];
  $rulesArr['othr_doyouknowcibil'] = 'required';
  $messagesArr['othr_doyouknowcibil.required'] = 'Other Details - Additional Loan Information - Do you know you CIBIL Score? degree is required.';
  if (@$input['othr_doyouknowcibil'] == 'Yes') {
    $fieldsArr['othr_cibilscore'] = $input['othr_cibilscore'];
    $rulesArr['othr_cibilscore'] = 'required';
    $messagesArr['othr_cibilscore.required'] = 'Other Details - Additional Loan Information - Enter CIBIL Score is required.';
  }
}
$isFunded = $input['is_funded'];
if (($isFunded == "1" && $input['othr_promoterare'] == "1") || ($isFunded == "0" && $input['othr_promoterare'] == "1")) {
  $tempFieldsArr = ['fin_propertiesowned', 'fin_fixeddeposit', 'fin_mutualfunds', 'fin_listedshares', 'pl_bankname', 'pl_amtoutstanding', 'pl_monthlyemi', 'mortloan_bankname', 'mortloan_monthlyemi', 'mortloan_amtoutstanding'];
  for ($i = 0; $i < count($tempFieldsArr); $i++) {
    if (array_key_exists($tempFieldsArr[$i], $fieldsArr)) {
      unset($fieldsArr[$tempFieldsArr[$i]]);
      unset($rulesArr[$tempFieldsArr[$i]]);
    }
  }
}

$validator = Validator::make($fieldsArr, $rulesArr, $messagesArr);
if ($validator->fails()) {
  return Redirect::back()->withErrors($validator)->withInput();
} else {
  if (isset($loanId)) {
    DB::table('loans_promoter_kyc_details')->where('loan_id', '=', $loan->id)->delete();
    if ($counter == 0) {
      for ($i = 0; $i <= $counter; $i++) {

        DB::table('loans_promoter_kyc_details')->insert([
          'loan_id' => $loan->id,
          'kyc_name' => $input['promoters'][$i]['kyc_name'],
          'kyc_din' => $input['promoters'][$i]['kyc_din'],
          'kyc_pan' => $input['promoters'][$i]['kyc_pan'],
          'kyc_address' => $input['promoters'][$i]['kyc_address'],
          'kyc_address_proof' => $input['promoters'][$i]['kyc_address_proof'],
          'kyc_proof_id' => $input['promoters'][$i]['kyc_proof_id'],
          'kyc_state' => $input['promoters'][$i]['kyc_state'],
          'kyc_pin' => $input['promoters'][$i]['kyc_pin'],
        ]);
      }
    } else {
      for ($i = 0; $i < $counter; $i++) {

        DB::table('loans_promoter_kyc_details')->insert([
          'loan_id' => $loan->id,
          'kyc_name' => $input['promoters'][$i]['kyc_name'],
          'kyc_din' => $input['promoters'][$i]['kyc_din'],
          'kyc_pan' => $input['promoters'][$i]['kyc_pan'],
          'kyc_address' => $input['promoters'][$i]['kyc_address'],
          'kyc_address_proof' => $input['promoters'][$i]['kyc_address_proof'],
          'kyc_proof_id' => $input['promoters'][$i]['kyc_proof_id'],
          'kyc_state' => $input['promoters'][$i]['kyc_state'],
          'kyc_pin' => $input['promoters'][$i]['kyc_pin'],
        ]);
      }
    }

    //Overdraft Details Add record
    $numOfOverdraft = $input['counter_OD_storage'];
    $overdraft = $input['overdraft'];
    $mortgageFilterOV = array_map('array_filter', $overdraft);
    $filtredMortgageOV = array_filter($mortgageFilterOV);

    DB::table('loans_overdraft_kyc_details')->where('loan_id', '=', $loan->id)->delete();

    if ($numOfOverdraft == 0) {
      for ($i = 0; $i <= $numOfOverdraft; $i++) {

        DB::table('loans_overdraft_kyc_details')->insert([
          'loan_id' => $loan->id,
          'overName' => @$filtredMortgageOV[$i]['overName'],
          'overOutstanding' => @$filtredMortgageOV[$i]['overOutstanding'],
          'overMonthlyEmi' => @$filtredMortgageOV[$i]['overMonthlyEmi'],
        ]);

      }
    } else {
      for ($i = 0; $i < $numOfOverdraft; $i++) {

        DB::table('loans_overdraft_kyc_details')->insert([

          'loan_id' => $loan->id,
          'overName' => $filtredMortgageOV[$i]['overName'],
          'overOutstanding' => $filtredMortgageOV[$i]['overOutstanding'],
          'overMonthlyEmi' => $filtredMortgageOV[$i]['overMonthlyEmi'],
        ]);
      }

    }



    if (isset($input['othr_income']) && $input['othr_income'] == '0') {
      $input['othr_sourceofincome'] = null;
    }
    $promoterDetails = PromoterDetails::updateOrCreate(['loan_id' => $loan->id], $input);
    $promoterDetails->save();



    // dd($input['overdraft']);



    if ($numOfPropertyOwned != 'None') {
      //DB::table('loans_overdraft_kyc_details')->where('loan_id', '=', $loan->id)->delete();
      for ($i = 1; $i <= $numOfPropertyOwned; $i++) {
        if ($i != 4) {
          DB::table('loans_promoter_property_details')->insert([
            'loan_id' => $loan->id,
            'property_type' => $input['propertyDetails'][$i]['property_type'],
            'market_value' => $input['propertyDetails'][$i]['market_value'],
            'location_city' => $input['propertyDetails'][$i]['location_city'],
            'other_city_name' => $input['other_city_name'][$i],
            'is_mortgage' => $input['propertyDetails'][$i]['is_mortgage'],
          ]);
        } else {
          DB::table('loans_promoter_property_details')->insert([
            'loan_id' => $loan->id,
            'property_type' => $input['propertyDetails'][$i]['property_type'],
            'market_value' => $input['propertyDetails'][$i]['market_value'],
          ]);
        }
      }
    }



    $numOfmortgage = $input['counter_ML_storage'];
    $mortgage = $input['mortgage'];
    $mortgageFilterMR = array_map('array_filter', $mortgage);
    $filtredMortgageMR = array_filter($mortgageFilterMR);
    //Morthagage Loan Details Add record
    //$numOfmortgage=$input['mortgageLib'];

    DB::table('loans_mortgage_details')->where('loan_id', '=', $loan->id)->delete();
    if (count($numOfmortgage == 0)) {
      for ($i = 0; $i <= $numOfmortgage; $i++) {
        DB::table('loans_mortgage_details')->insert([
          'loan_id' => $loan->id,
          'mortName' => @$filtredMortgageMR[$i]['mortName'],
          'mortOutstanding' => @$filtredMortgageMR[$i]['mortOutstanding'],
          'mortMonthlyEmi' => @$filtredMortgageMR[$i]['mortMonthlyEmi'],
        ]);
      }
    } else {
      for ($i = 0; $i < $numOfmortgage; $i++) {
        DB::table('loans_mortgage_details')->insert([
          'loan_id' => $loan->id,
          'mortName' => $filtredMortgageMR[$i]['mortName'],
          'mortOutstanding' => $filtredMortgageMR[$i]['mortOutstanding'],
          'mortMonthlyEmi' => $filtredMortgageMR[$i]['mortMonthlyEmi'],
        ]);
      }
    }


    //Libilities vechicle  Loan Details Add record
    $numOfvechicle = $input['counter_VL_storage'];

    $vehicle = $input['vehicle'];
    $mortgageFilterVL = array_map('array_filter', $vehicle);
    $filtredMortgageVL = array_filter($mortgageFilterVL);

    DB::table('loans_vehicle_details')->where('loan_id', '=', $loan->id)->delete();
    if (count($numOfvechicle == 0)) {
      for ($i = 0; $i <= $numOfvechicle; $i++) {
        DB::table('loans_vehicle_details')->insert([
          'loan_id' => $loan->id,
          'vehicleName' => @$filtredMortgageVL[$i]['vehicleName'],
          'vehicleOutstanding' => @$filtredMortgageVL[$i]['vehicleOutstanding'],
          'vehicleMonthlyEmi' => @$filtredMortgageVL[$i]['vehicleMonthlyEmi'],
        ]);
      }
    } else {
      for ($i = 0; $i < $numOfvechicle; $i++) {
        DB::table('loans_vehicle_details')->insert([
          'loan_id' => $loan->id,
          'vehicleName' => $filtredMortgageVL[$i]['vehicleName'],
          'vehicleOutstanding' => $filtredMortgageVL[$i]['vehicleOutstanding'],
          'vehicleMonthlyEmi' => $filtredMortgageVL[$i]['vehicleMonthlyEmi'],
        ]);
      }
    }

    //Libilities
    //Credit card  Loan Details
    $numOfcreditcard = $input['counter_CL_storage'];

    $creditCard = $input['creditCard'];
    $mortgageFilterCC = array_map('array_filter', $creditCard);
    $filtredMortgageCC = array_filter($mortgageFilterCC);
    // dd($input);
    DB::table('loans_creditcard_details')->where('loan_id', '=', $loan->id)->delete();
    if (count($numOfcreditcard == 0)) {
      for ($i = 0; $i <= $numOfcreditcard; $i++) {
        DB::table('loans_creditcard_details')->insert([
          'loan_id' => $loan->id,
          'ccName' => @$filtredMortgageCC[$i]['ccName'],
          'ccOutstanding' => @$filtredMortgageCC[$i]['ccOutstanding']

        ]);
      }
    } else {
      for ($i = 0; $i < $numOfcreditcard; $i++) {
        DB::table('loans_creditcard_details')->insert([
          'loan_id' => $loan->id,
          'ccName' => $filtredMortgageCC[$i]['ccName'],
          'ccOutstanding' => $filtredMortgageCC[$i]['ccOutstanding']
        ]);
      }
    }


  }
  $loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loan->id], ['loan_id' => $loanId, 'promoter_details' => 'Y']);
  $loansStatus->save();

  $this->getLoansStatus($loanId);

  //session()->flash('flash_message', 'Promoter Details were successfully saved!');
}

$redirectUrl = $this->generateRedirectURL('loans/financial', $endUseList, $loanType, $amount, $loanTenure, $companySharePledged, $bscNscCode, $loanId);
return Redirect::to($redirectUrl)->withInput();
}

  /**
   * Display a listing of the resource.
   * @param $endUseList
   * @param $loanType
   * @param $amount
   * @param $chosenLoanTenure
   * @param $loanId
   * @return Response
   */
//public function getFinancial($loanType, $endUseList = null, $amount = null, $loanTenure= null, $loanId = null)
  public function getFinancial($param1 = null, $param2 = null, $param3 = null, $param4 = null, $param5 = null, $param6 = null, $param7 = null, $param8 = null)
  {
  //$endUseList,$loanType, $amount=null, $loanTenure = null, $companySharePledged= null, $bscNscCode = null,$loanId=null
    $endUseList = $param1;
    $loanType = $param2;
    $loanProduct = $param2;
    $amount = $param3;
    $loanTenure = $param4;
    $companySharePledged = null;
    $bscNscCode = null;
    if (isset($param5) && isset($param6)) {
      $companySharePledged = $param5;
      $bscNscCode = $param6;
      $loanId = $param7;
    } else {
      $loanId = $param5;
    }
    $loan = null;
    $model = null;
    $setDisable = null;
    $user = Auth::getUser();
    $setDisable = $this->getIsDisabled($user);
    $isRemoveMandatory = MasterData::removeMandatory();
    $isRemoveMandatory = array_except($isRemoveMandatory, ['']);
    $removeMandatoryHelper = new validLoanUrlhelper();
    $removeMandatory = $removeMandatoryHelper->getMandatory($user, $isRemoveMandatory);
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

    if (isset($loanId)) {
      $loan = Loan::find($loanId);
      $userId = $loan->user_id;
    //$model = $loan->getBalanceSheetDetails()->get()->first();
    //dd($loan, $model);
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
    //$chosenCompanyPositionTypes = CompanyPosition::where('loan_id','=', $loanId)->get()->lists('position');
    //@$business_object = Business::where('loan_id', '=', $loanId)->get()->first();
    }
    $userPr = UserProfile::where('user_id', '=', $userId)->first();
    $userProfile = UserProfile::with('user')->find($userPr->id);
    $helper = new DeletedQuestionsHelper($loan);
    $deletedQuestionsLoan = $this->getDeletedQuestionLoan($loan, $loanType, $amount);
    $deletedQuestionHelper = new DeletedQuestionsHelper($deletedQuestionsLoan);
  //$bl_year = MasterData::BalanceSheet_FY();
    $bl_year = $this->setFinancialYears();
    $choosenApproxValue = null;
    $subViewType = 'loans._financial';
    $formaction = 'Loans\LoansController@postFinancial';
    $bl_details = [];
    $pl_details = [];
    $existingloan_details = [];
    $bl_details = BalanceSheetDetail::where('loan_id', '=', $loanId)->orderBy('finyear', 'DESC')->get();
    $pl_details = ProfitLossDetail::where('loan_id', '=', $loanId)->orderBy('finyear', 'DESC')->get();
    $existingloan_details = ExistingLoanDetail::where('loan_id', '=', $loanId)->get();
    $financialBLDataMap = new Collection();
    $financialPLDataMap = new Collection();
    foreach ($bl_details as $financialData) {
      $financialBLDataMap->offsetSet($financialData->finyear, $financialData);
    }
    foreach ($pl_details as $financialData) {
      $financialPLDataMap->offsetSet($financialData->finyear, $financialData);
    }
  //dd( $bl_year, $bl_details, $pl_details, $existingloan_details);
  //getting borrowers profile
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
      $loanUser = User::find($loan->user_id);
      $loanUserProfile = $loanUser->userProfile();
    }
    $userPr = UserProfile::where('user_id', '=', $loan->user_id)->first();
    $userProfileFirm = UserProfile::with('user')->find($userPr->id);
    return view('loans.createedit', compact(
      'subViewType',
      'endUseList',
      'loanType',
      'amount',
      'loanTenure',
      'loan',
      'companySharePledged',
      'bscNscCode',
      'loanId',
      'formaction',
      'bl_year',
      'bl_details',
      'pl_details',
      'existingloan_details',
      'choosenApproxValue',
      'helper',
      'deletedQuestionHelper',
      'setDisable',
      'validLoanHelper',
      'removeMandatory',
      'userProfileFirm',
      'loanUserProfile',
      'userProfile',
      'financialBLDataMap',
      'financialPLDataMap'
    ));
  }

  public function postFinancial(Request $request)
  {
    $input = Input::all();
    $loanId = isset($input['loanId']) ? $input['loanId'] : null;
    $loanType = isset($input['type']) ? $input['type'] : null;
    $amount = isset($input['loan_amount']) ? $input['loan_amount'] : null;
    $loanTenure = isset($input['loan_tenure']) ? $input['loan_tenure'] : null;
    $endUseList = isset($input['end_use']) ? $input['end_use'] : null;
  //Loan Against Share
    $companySharePledged = isset($input['companySharePledged']) ? $input['companySharePledged'] : null;
    $bscNscCode = isset($input['bscNscCode']) ? $input['bscNscCode'] : null;
    $thirdPartyChecked = 0;
    $flag = 0;
    $propertyType = Input::get('property_type');
    $input = Input::all();
    $temp = null;
    for ($i = 0; $i < count($propertyType); $i++) {
      if ($propertyType[$i] != '') {
        $temp = $propertyType[$i];
      }
    }
    $input['property_type'] = $temp;
    $loanId = $request->input('loanId');
    $fieldsArr = [];
    $rulesArr = [];
    $messagesArr = [];
    $indexPosition = 0;
    $updateLendersList = (new Collection($input['financial']));
    $updateLendersList->each(function ($financial) use (&$fieldsArr, &$rulesArr, &$messagesArr, &$indexPosition) {
      if ($indexPosition <= 1) {
        $fieldsArr['net_worth' . $indexPosition] = $financial['networth'];
        $rulesArr['net_worth' . $indexPosition] = 'required';
        $messagesArr['net_worth' . $indexPosition . '.required'] = 'Balance Sheet Details ' . ($indexPosition + 1) . '- Net Worth is required.';
        $fieldsArr['total_debt' . $indexPosition] = $financial['total_debt'];
        $rulesArr['total_debt' . $indexPosition] = 'required';
        $messagesArr['total_debt' . $indexPosition . '.required'] = 'Balance Sheet Details ' . ($indexPosition + 1) . '- Total Debt is required.';
        $fieldsArr['term_debt' . $indexPosition] = $financial['term_debt'];
        $rulesArr['term_debt' . $indexPosition] = 'required';
        $messagesArr['term_debt' . $indexPosition . '.required'] = 'Balance Sheet Details ' . ($indexPosition + 1) . '- Term Debt is required.';
        $fieldsArr['debtors' . $indexPosition] = $financial['debtors'];
        $rulesArr['debtors' . $indexPosition] = 'required';
        $messagesArr['debtors' . $indexPosition . '.required'] = 'Balance Sheet Details ' . ($indexPosition + 1) . '- Debtors Details is required.';
        $fieldsArr['inventory' . $indexPosition] = @$financial['inventory'];
        $rulesArr['inventory' . $indexPosition] = 'required';
        $messagesArr['inventory' . $indexPosition . '.required'] = 'Balance Sheet Details ' . ($indexPosition + 1) . '- Inventory Details is required.';
        $fieldsArr['creditors' . $indexPosition] = $financial['creditors'];
        $rulesArr['creditors' . $indexPosition] = 'required';
        $messagesArr['creditors' . $indexPosition . '.required'] = 'Balance Sheet Details ' . ($indexPosition + 1) . '- Creditors Details is required.';
        $fieldsArr['nfs_assets' . $indexPosition] = $financial['net_fixed_assets'];
        $rulesArr['nfs_assets' . $indexPosition] = 'required';
        $messagesArr['nfs_assets' . $indexPosition . '.required'] = 'Balance Sheet Details ' . ($indexPosition + 1) . '-  Net Fixed Assets Details is required.';
      /*$fieldsArr['sales' . $indexPosition] = $financial['sales'];
      $rulesArr['sales' . $indexPosition] = 'required';
      $messagesArr['sales' . $indexPosition . '.required'] = 'Profit & Loss Details ' . ($indexPosition + 1) . '- Sales is required.';*/
      $fieldsArr['revenue' . $indexPosition] = $financial['revenue'];
      $rulesArr['revenue' . $indexPosition] = 'required';
      $messagesArr['revenue' . $indexPosition . '.required'] = 'Profit & Loss Details ' . ($indexPosition + 1) . '-  Revenue is required.';
      $fieldsArr['op_profit' . $indexPosition] = $financial['ebitda_profit'];
      $rulesArr['op_profit' . $indexPosition] = 'required';
      $messagesArr['op_profit' . $indexPosition . '.required'] = 'Profit & Loss Details ' . ($indexPosition + 1) . '- Operating Profit is required.';
      $fieldsArr['interest_expense' . $indexPosition] = $financial['interest_expense'];
      $rulesArr['interest_expense' . $indexPosition] = 'required';
      $messagesArr['interest_expense' . $indexPosition . '.required'] = 'Profit & Loss Details ' . ($indexPosition + 1) . '- Interest Expense is required.';
      $fieldsArr['pat' . $indexPosition] = $financial['pat'];
      $rulesArr['pat' . $indexPosition] = 'required';
      $messagesArr['pat' . $indexPosition . '.required'] = 'Profit & Loss Details ' . ($indexPosition + 1) . ' - PAT is required.';
    }
    $indexPosition++;
  });
    if ($companySharePledged == '') {
      $fieldsArr['gross_assets'] = $input['fin_grossfixedassets'];
      $rulesArr['gross_assets'] = 'required';
      $messagesArr['gross_assets.required'] = 'Other Details - Gross Assets is required.';
      $fieldsArr['gross_value_of_plant'] = $input['fin_grossvalueofplant'];
      $rulesArr['gross_value_of_plant'] = 'required';
      $messagesArr['gross_value_of_plant.required'] = 'Other Details - Gross Value of plant & Machinery is required.';
      $fieldsArr['propertiesOwned'] = $input['fin_numofexistingloan'];
      $rulesArr['propertiesOwned'] = 'required';
      $messagesArr['propertiesOwned.required'] = 'Other Details - Number of Existing Loan is required.';
    }
    $numOfPropertyOwned = $input['fin_numofexistingloan'];
    if (isset($numOfPropertyOwned) && $numOfPropertyOwned != 0) {
      if ($numOfPropertyOwned == 4) {
        $numOfPropertyOwned = 3;
      }
      for ($i = 1; $i <= $numOfPropertyOwned; $i++) {
        $fieldsArr['bankname' . $i] = $input['bankname'][$i];
        $rulesArr['bankname' . $i] = 'required';
        $messagesArr['bankname' . $i . '.required'] = 'Other Details - Bank Name is required.';
        $fieldsArr['loantype' . $i] = $input['loantype'][$i];
        $rulesArr['loantype' . $i] = 'required';
        $messagesArr['loantype' . $i . '.required'] = 'Other Details - Loan Type is required.';
        $fieldsArr['outstanding_amount' . $i] = $input['outstanding_amount'][$i];
        $rulesArr['outstanding_amount' . $i] = 'required';
        $messagesArr['outstanding_amount' . $i . '.required'] = 'Other Details - Outstanding Amount is required.';
        $fieldsArr['monthlyemi_amount' . $i] = $input['monthlyemi_amount'][$i];
        $rulesArr['monthlyemi_amount' . $i] = 'required';
        $messagesArr['monthlyemi_amount' . $i . '.required'] = 'Other Details - Monthly EMI Amount is required.';
      /*$fieldsArr['balance_tenure' . $i] = $input['balance_tenure'][$i];
      $rulesArr['balance_tenure' . $i] = 'required';
      $messagesArr['balance_tenure'.$i.'.required'] ='Other Details - Balance Tenure is required.';
      $fieldsArr['securityprovided' . $i] = $input['securityprovided'][$i];
      $rulesArr['securityprovided' . $i] = 'required';
      $messagesArr['securityprovided'.$i.'.required'] ='Other Details - Security Provided is required.';*/
    }
  }
  /*   if(isset($input['cibilScore']))
  {
  $fieldsArr['cibilScore']=$input['cibilScore'];
}
$rulesArr['cibilScore']='required';
$messagesArr['cibilScore.required']='Do you know CIBIL score is required.';
if(isset($input['cibilScore']) && $input['cibilScore'] == "Yes")
{
$fieldsArr['fin_cibilscore']=$input['fin_cibilscore'];
$rulesArr['fin_cibilscore']='required';
$messagesArr['fin_cibilscore.required']='CIBIL Score is required.';
}
$fieldsArr['additionalEMIAmt']=;
$rulesArr['additionalEMIAmt']='required';
$messagesArr['additionalEMIAmt.required']='Additional monthly interest is required.';*/
$validator = Validator::make($fieldsArr, $rulesArr, $messagesArr);
if ($validator->fails()) {
  return Redirect::back()->withErrors($validator)->withInput();
} else {
  if (isset($loanId)) {
    $loan = Loan::find($loanId);
    DB::table('loans_balancesheet_details')->where('loan_id', '=', $loan->id)->delete();
    for ($i = 0; $i < $indexPosition; $i++) {
      DB::table('loans_balancesheet_details')->insert([
        'loan_id' => $loan->id,
        'finyear' => $input['financial'][$i]['finyear'],
        'networth' => $input['financial'][$i]['networth'],
        'total_debt' => $input['financial'][$i]['total_debt'],
        'term_debt' => $input['financial'][$i]['term_debt'],
        'debtors' => $input['financial'][$i]['debtors'],
        'inventory' => $input['financial'][$i]['inventory'],
        'creditors' => $input['financial'][$i]['creditors'],
        'net_fixed_assets' => $input['financial'][$i]['net_fixed_assets'],
      ]);
    }
    // $finBalDetails = BalanceSheetDetail::updateOrCreate(array('id' => $loanId), $input);
    // $finBalDetails->save();
    DB::table('loans_profitloss_details')->where('loan_id', '=', $loan->id)->delete();
    for ($i = 0; $i < $indexPosition; $i++) {
      DB::table('loans_profitloss_details')->insert([
        'loan_id' => $loan->id,
        'finyear' => $input['financial'][$i]['finyearpl'],
        //'sales' => $input['financial'][$i]['sales'],
        'revenue' => $input['financial'][$i]['revenue'],
        'ebitda_profit' => $input['financial'][$i]['ebitda_profit'],
        'interest_expense' => $input['financial'][$i]['interest_expense'],
        'pat' => $input['financial'][$i]['pat'],
      ]);
    }
    //$finPLDetails = ProfitLossDetail::updateOrCreate(array('id' => $loanId), $input);
    //$finPLDetails->save();
    DB::table('loans_existingloan_details')->where('loan_id', '=', $loan->id)->delete();
    for ($i = 1; $i <= $numOfPropertyOwned; $i++) {
      DB::table('loans_existingloan_details')->insert([
        'loan_id' => $loan->id,
        'name' => $input['bankname'][$i],
        'loan_type' => $input['loantype'][$i],
        'amount_outstanding' => $input['outstanding_amount'][$i],
        'amount_monthlyemi' => $input['monthlyemi_amount'][$i],
        'balance_tenure' => $input['balance_tenure'][$i],
        'security_provided' => $input['securityprovided'][$i],
      ]);
    }
    //$finPLDetails = ProfitLossDetail::updateOrCreate(array('id' => $loanId), $input);
    //$finPLDetails->save();
  Loan::where('id', $loanId)->update(['fin_grossfixedassets' => $input['fin_grossfixedassets'], 'fin_grossvalueofplant' => $input['fin_grossvalueofplant'], 'fin_numofexistingloan' => $input['fin_numofexistingloan']/*'fin_doyouknowcibil' =>  $input['cibilScore'], 'fin_cibilscore' =>  $input['fin_cibilscore'] , 'fin_addmonthlyintrest' => $input['fin_addmonthlyintrest'],'other_outstandingamount' => $input['other_outstandingamount'],'other_totalmonthlyemi'=>$input['other_totalmonthlyemi']*/ ]);
  $loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loan->id], ['loan_id' => $loanId, 'financials' => 'Y']);
  $loansStatus->save();
  $this->getLoansStatus($loanId);
}
}
if (Auth::user()->isSME()) {
  //$redirectUrl = $this->generateRedirectURL('loans/application', $endUseList, $loanType, $amount, $loanTenure, $loanId);
  $redirectUrl = $this->generateRedirectURL('loans/application', $endUseList, $loanType, $amount, $loanTenure, $companySharePledged, $bscNscCode, $share = null, $loanId);
} else {
  $redirectUrl = $this->generateRedirectURL('loans/business', $endUseList, $loanType, $amount, $loanTenure, $loanId);
}
return Redirect::to($redirectUrl)->withInput();

}

  /**
   * Display a listing of the resource.
   * @param $endUseList
   * @param $loanType
   * @param $amount
   * @param $chosenLoanTenure
   * @param $loanId
   * @return Response
   * @return mixed
   */
  public function getBusiness($loanType, $endUseList = null, $amount = null, $loanTenure = null, $loanId = null)
  {
    $companyPositionTypes = MasterData::companyPositionTypes();
    $chosenCompanyPositionTypes = [];
    $loan = null;
    $model = null;
    $setDisable = null;
    $user = Auth::getUser();
    $setDisable = $this->getIsDisabled($user);
    $isRemoveMandatory = MasterData::removeMandatory();
    $isRemoveMandatory = array_except($isRemoveMandatory, ['']);
    $removeMandatoryHelper = new validLoanUrlhelper();
    $removeMandatory = $removeMandatoryHelper->getMandatory($user, $isRemoveMandatory);
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
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
      $model = $loan->getBusinessOperationalDetails()->get()->first();
    //dd($loan, $model);
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
    $helper = new DeletedQuestionsHelper($loan);
    $deletedQuestionsLoan = $this->getDeletedQuestionLoan($loan, $loanType, $amount);
    $deletedQuestionHelper = new DeletedQuestionsHelper($deletedQuestionsLoan);
    $subViewType = 'loans._business';
    $formaction = 'Loans\LoansController@postBusiness';
    $purchasedEquipmentTypes = MasterData::purchasedEquipmentTypes();
    $maxCustomers = 5;
  //getting borrowers profile
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
      $loanUser = User::find($loan->user_id);
      $loanUserProfile = $loanUser->userProfile();
    }
    return view('loans.createedit', compact(
      'subViewType',
      'endUseList',
      'loanType',
      'amount',
      'loanTenure',
      'loan',
      'loanId',
      'formaction',
      'business_object',
      'helper',
      'companyPositionTypes',
      'chosenCompanyPositionTypes',
      'maxCustomers',
      'purchasedEquipmentTypes',
      'deletedQuestionHelper',
      'setDisable',
      'model',
      'validLoanHelper',
      'removeMandatory',
      'loanUserProfile'
    ));
  }

  public function postBusiness(Request $request)
  {
    $input = Input::all();
    $loanId = (isset($input['loanId']) && $input['loanId'] != "") ? $input['loanId'] : null;
    $loanType = isset($input['type']) ? $input['type'] : null;
    $amount = isset($input['loan_amount']) ? $input['loan_amount'] : null;
    $loanTenure = isset($input['loan_tenure']) ? $input['loan_tenure'] : null;
    $endUseList = isset($input['end_use']) ? $input['end_use'] : null;
    $modelId = (isset($input['model_id']) && $input['model_id'] != "") ? $input['model_id'] : null;
    $loan = null;
    $model = null;
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
    }
    $rules = [];
    $attributeNames = [];
    $deletedQuestionsLoan = $this->getDeletedQuestionLoan($loan, $loanType, $amount);
    $deletedQuestionHelper = new DeletedQuestionsHelper($deletedQuestionsLoan);
    if ($deletedQuestionHelper->isQuestionValid("D3.1")) {
      $rules['officepremise_type'] = 'required';
      $attributeNames['officepremise_type'] = 'Is your Office Premise';
    }
    if ($deletedQuestionHelper->isQuestionValid("D3.2")) {
      $rules['mfgpremise_type'] = 'required';
      $attributeNames['mfgpremise_type'] = 'Is your Manufacturing premise on';
    }
    if ($deletedQuestionHelper->isQuestionValid("D3.3")) {
      $rules['top3_custname_1'] = 'required';
      $attributeNames['top3_custname_1'] = 'Top 3 customers Basis Annual Sales - Customer Name - 1';
      $rules['top3_annsales_1'] = 'numeric';
      $attributeNames['top3_annsales_1'] = 'Top 3 customers Basis Annual Sales - Annual Sales Amount - 1';
      $rules['top3_relationsince_1'] = 'required';
      $attributeNames['top3_relationsince_1'] = 'Top 3 customers Basis Annual Sales - Relationship Since - 1';
      $rules['top3_custname_2'] = 'required';
      $attributeNames['top3_custname_2'] = 'Top 3 customers Basis Annual Sales - Customer Name - 2';
      $rules['top3_annsales_2'] = 'numeric';
      $attributeNames['top3_annsales_2'] = 'Top 3 customers Basis Annual Sales - Annual Sales Amount - 2';
      $rules['top3_relationsince_2'] = 'required';
      $attributeNames['top3_relationsince_2'] = 'Top 3 customers Basis Annual Sales - Relationship Since - 2';
    }
    if ($deletedQuestionHelper->isQuestionValid("D3.4")) {
      if ($input['longterm_contracts_type'] == '1') {
        $rules['longterm_name'] = 'required_if:longterm_contracts_type,1';
        $rules['longterm_years'] = 'required_if:longterm_contracts_type,1';
        $rules['longterm_ann_contract_value'] = 'required_if:longterm_contracts_type,1|numeric';
        $rules['longterm_numofyear'] = 'required_if:longterm_contracts_type,1|numeric';
        $attributeNames['longterm_contracts_type'] = 'Do you have any long term contracts with any customers';
        $attributeNames['longterm_name'] = 'Customer Long Term Contract Details - Names of Customers';
        $attributeNames['longterm_years'] = 'Customer Long Term Contract Details - Number of years of contracts';
        $attributeNames['longterm_ann_contract_value'] = 'Customer Long Term Contract Details - Annual Value of Contracts';
        $attributeNames['longterm_numofyear'] = 'Customer Long Term Contract Details - Numbers of years of customer sale relationship details';
      }
    }
    if ($deletedQuestionHelper->isQuestionValid("D3.5.1")) {
      $rules['ao_name_of_debtor_1'] = 'required';
      $attributeNames['ao_name_of_debtor_1'] = 'Top 3 debtors - Name of Debtor - 1';
      $rules['ao_amount_outstanding_1'] = 'numeric';
      $attributeNames['ao_amount_outstanding_1'] = 'Top 3 debtors - Amount Outstanding - 1';
      $rules['ao_period_outstanding_1'] = 'required';
      $attributeNames['ao_period_outstanding_1'] = 'Top 3 debtors - Period Outstanding - 1';
      $rules['ao_name_of_debtor_2'] = 'required';
      $attributeNames['ao_name_of_debtor_2'] = 'Top 3 debtors - Name of Debtor - 2';
      $rules['ao_amount_outstanding_2'] = 'numeric';
      $attributeNames['ao_amount_outstanding_2'] = 'Top 3 debtors - Amount Outstanding - 2';
      $rules['ao_period_outstanding_2'] = 'required';
      $attributeNames['ao_period_outstanding_2'] = 'Top 3 debtors - Period Outstanding - 2';
    }
    if ($deletedQuestionHelper->isQuestionValid("D3.5.2")) {
      $rules['aud_name_of_debtor_1'] = 'required';
      $attributeNames['aud_name_of_debtor_1'] = 'As on Last Audited Balance Sheet - Name of Debtor  - 1';
      $rules['aud_amount_outstanding_1'] = 'numeric';
      $attributeNames['aud_amount_outstanding_1'] = 'As on Last Audited Balance Sheet - Amount Outstanding - 1';
      $rules['aud_period_outstanding_1'] = 'required';
      $attributeNames['aud_period_outstanding_1'] = 'As on Last Audited Balance Sheet - Period Outstanding - 1';
      $rules['aud_name_of_debtor_2'] = 'required';
      $attributeNames['aud_name_of_debtor_2'] = 'As on Last Audited Balance Sheet - Name of Debtor  - 2';
      $rules['aud_amount_outstanding_2'] = 'numeric';
      $attributeNames['aud_amount_outstanding_2'] = 'As on Last Audited Balance Sheet - Amount Outstanding - 2';
      $rules['aud_period_outstanding_2'] = 'required';
      $attributeNames['aud_period_outstanding_2'] = 'As on Last Audited Balance Sheet - Period Outstanding - 2';
    }
    if ($deletedQuestionHelper->isQuestionValid("D3.6")) {
      $rules['supplier_name_1'] = 'required';
      $attributeNames['supplier_name_1'] = 'Top 3 suppliers - Suppliers Name - 1';
      $rules['supplier_amount_1'] = 'numeric';
      $attributeNames['supplier_amount_1'] = 'Top 3 suppliers - Annual Amount - 1';
      $rules['supplier_relation_1'] = 'required';
      $attributeNames['supplier_relation_1'] = 'Top 3 suppliers - Relation Since - 1';
      $rules['supplier_ref_name_1'] = 'required';
      $attributeNames['supplier_ref_name_1'] = 'Top 3 suppliers - Reference Name - 1';
      $rules['supplier_ref_contact_1'] = 'required';
      $attributeNames['supplier_ref_contact_1'] = 'Top 3 suppliers - Reference Contact - 1';
      $rules['supplier_name_2'] = 'required';
      $attributeNames['supplier_name_2'] = 'Top 3 suppliers - Suppliers Name - 2';
      $rules['supplier_amount_2'] = 'numeric';
      $attributeNames['supplier_amount_2'] = 'Top 3 suppliers - Annual Amount - 1';
      $rules['supplier_relation_2'] = 'required';
      $attributeNames['supplier_relation_2'] = 'Top 3 suppliers - Relation Since - 2';
      $rules['supplier_ref_name_2'] = 'required';
      $attributeNames['supplier_ref_name_2'] = 'Top 3 suppliers - Reference Name - 2';
      $rules['supplier_ref_contact_2'] = 'required';
      $attributeNames['supplier_ref_contact_1'] = 'Top 3 suppliers - Reference Contact - 2';
    }
    if ($deletedQuestionHelper->isQuestionValid("D3.10")) {
      if ($input['relationship_type'] != 'None of the above') {
        $rules['vendor_service_name'] = 'required';
        $rules['vendor_relation_since'] = 'required';
        $attributeNames['vendor_service_name'] = 'Are You any of the following - Name of the Large manufacturing company';
        $attributeNames['vendor_relation_since'] = 'Are You any of the following - Relationship Since';
        $rules['vendor_saleamount_1'] = 'required';
        $attributeNames['vendor_saleamount_1'] = 'Are You any of the following - Monthly sales details for last 6 months - Sale Amount - 1';
        $rules['vendor_products_sold_1'] = 'required';
        $attributeNames['vendor_products_sold_1'] = 'Are You any of the following - Monthly sales details for last 6 months - Products Sold - 1';
        $rules['vendor_saleamount_2'] = 'required';
        $attributeNames['vendor_saleamount_2'] = 'Are You any of the following - Monthly sales details for last 6 months - Sale Amount - 2';
        $rules['vendor_products_sold_2'] = 'required';
        $attributeNames['vendor_products_sold_2'] = 'Are You any of the following - Monthly sales details for last 6 months - Products Sold - 2';
        $rules['vendor_saleamount_3'] = 'required';
        $attributeNames['vendor_saleamount_3'] = 'Are You any of the following - Monthly sales details for last 6 months - Sale Amount - 3';
        $rules['vendor_products_sold_3'] = 'required';
        $attributeNames['vendor_products_sold_3'] = 'Are You any of the following - Monthly sales details for last 6 months - Products Sold - 3';
        $rules['vendor_saleamount_4'] = 'required';
        $attributeNames['vendor_saleamount_4'] = 'Are You any of the following - Monthly sales details for last 6 months - Sale Amount - 4';
        $rules['vendor_products_sold_4'] = 'required';
        $attributeNames['vendor_products_sold_4'] = 'Are You any of the following - Monthly sales details for last 6 months - Products Sold - 4';
        $rules['vendor_saleamount_5'] = 'required';
        $attributeNames['vendor_saleamount_5'] = 'Are You any of the following - Monthly sales details for last 6 months - Sale Amount - 2';
        $rules['vendor_products_sold_5'] = 'required';
        $attributeNames['vendor_products_sold_5'] = 'Are You any of the following - Monthly sales details for last 6 months - Products Sold - 5';
        $rules['vendor_saleamount_6'] = 'required';
        $attributeNames['vendor_saleamount_6'] = 'Are You any of the following - Monthly sales details for last 6 months - Sale Amount - 6';
        $rules['vendor_products_sold_6'] = 'required';
        $attributeNames['vendor_products_sold_6'] = 'Are You any of the following - Monthly sales details for last 6 months - Products Sold - 6';
      }
    }
    $companyPositionTypes = MasterData::companyPositionTypes();
    if ($deletedQuestionHelper->isQuestionValid("D3.8")) {
      $tmp_count = 0;
      $chkdata = "N";
      foreach ($companyPositionTypes as $companyPositionTypeName => $companyPositionTypeValue) {
        $tmp_count++;
        if (isset($input['fin_positions_' . $tmp_count])) {
          $chkdata = 'Y';
        }
      }
      if ($chkdata == 'N') {
        $rules['fin_positions'] = 'required';
        $attributeNames['fin_positions'] = 'Which of the following positions are present in your company';
      }
    }
    if ($deletedQuestionHelper->isQuestionValid("D3.9")) {
      $tmp_count = 0;
      $chkdata = "N";
      foreach ($companyPositionTypes as $companyPositionTypeName => $companyPositionTypeValue) {
        $tmp_count++;
        if (isset($input['fin_profession_' . $tmp_count])) {
          $chkdata = 'Y';
        }
      }
    //            if ($chkdata == 'N') {
    //                $rules['fin_profession'] = 'required';
    //                $attributeNames['fin_profession'] = 'Which of the above are held by professional other than promoters ';
    //            }
    }
  //validate
    $validator = Validator::make($input, $rules);
    $validator->setAttributeNames($attributeNames);
    if ($validator->fails()) {
      return Redirect::back()->withErrors($validator)->withInput();
    }
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
    }
    $loan_id = $loan->id;
    if (!isset($loan_id)) {
      $getBusinessOperationalDetailID = null;
      $primaryIdOfBusinessOperationalDetail = null;
    } else {
      $getBusinessOperationalDetailID = BusinessOperationalDetail::where('loan_id', '=', $loanId)->first();
      if ($getBusinessOperationalDetailID == null) {
        $primaryIdOfBusinessOperationalDetail = null;
      } else {
        $primaryIdOfBusinessOperationalDetail = $getBusinessOperationalDetailID->id;
      }
    }
  //        dd($loan_id,$loanId,$loan,$getBusinessOperationalDetailID,$primaryIdOfBusinessOperationalDetail);
  //commented by satish as discussed with vishal
  //        else{
  //            $loan = $this->createAndSaveNewLoan($loanType, $amount, $loanTenure);
  //            $loanId = $loan->id;
  //            $input['loan_id'] = $loanId;
  //        }
    if (isset($modelId)) {
      $model = $loan->getBusinessOperationalDetails();
    }
    if (isset($input['fin_positions_1'])) {
      $fin_positions_1 = $input['fin_positions_1'];
    } else {
      $fin_positions_1 = null;
    }
    if (isset($input['fin_positions_2'])) {
      $fin_positions_2 = $input['fin_positions_2'];
    } else {
      $fin_positions_2 = null;
    }
    if (isset($input['fin_positions_3'])) {
      $fin_positions_3 = $input['fin_positions_3'];
    } else {
      $fin_positions_3 = null;
    }
    if (isset($input['fin_positions_4'])) {
      $fin_positions_4 = $input['fin_positions_4'];
    } else {
      $fin_positions_4 = null;
    }
    if (isset($input['fin_positions_5'])) {
      $fin_positions_5 = $input['fin_positions_5'];
    } else {
      $fin_positions_5 = null;
    }
    if (isset($input['fin_profession_1'])) {
      $fin_profession_1 = $input['fin_profession_1'];
    } else {
      $fin_profession_1 = null;
    }
    if (isset($input['fin_profession_2'])) {
      $fin_profession_2 = $input['fin_profession_2'];
    } else {
      $fin_profession_2 = null;
    }
    if (isset($input['fin_profession_3'])) {
      $fin_profession_3 = $input['fin_profession_3'];
    } else {
      $fin_profession_3 = null;
    }
    if (isset($input['fin_profession_4'])) {
      $fin_profession_4 = $input['fin_profession_4'];
    } else {
      $fin_profession_4 = null;
    }
    if (isset($input['fin_profession_5'])) {
      $fin_profession_5 = $input['fin_profession_5'];
    } else {
      $fin_profession_5 = null;
    }
  //        dd($input,$loan,$modelId,$model);
    BusinessOperationalDetail::updateOrCreate(['id' => $modelId], $input);
    if (isset($primaryIdOfBusinessOperationalDetail) && $primaryIdOfBusinessOperationalDetail != null) {
      BusinessOperationalDetail::updateOrCreate(['id' => $modelId], [
        'loan_id' => $input['loan_id'], 'fin_positions_1' => $fin_positions_1,
        'fin_positions_2' => $fin_positions_2, 'fin_positions_3' => $fin_positions_3, 'fin_positions_4' => $fin_positions_4,
        'fin_positions_5' => $fin_positions_5, 'fin_profession_1' => $fin_profession_1, 'fin_profession_2' => $fin_profession_2,
        'fin_profession_3' => $fin_profession_3, 'fin_profession_4' => $fin_profession_4, 'fin_profession_5' => $fin_profession_5
      ]);
    }
    $loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loan->id], ['loan_id' => $loanId, 'business_details' => 'Y']);
    $loansStatus->save();
    $this->getLoansStatus($loanId);
    session()->flash('flash_message', 'Business Details were successfully saved!');
    $validLoanHelper = new validLoanUrlhelper();
    if (isset($loanId) && isset($loanType)) {
      $isVisibleSecurityTab = $validLoanHelper->securityTab($loanId, $loanType);
      if (!$isVisibleSecurityTab) {
        $loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loanId], ['loan_id' => $loanId, 'security_details' => 'Y']);
        $loansStatus->save();
        $this->getLoansStatus($loanId);
        $redirectUrl = $this->generateRedirectURL('loans/uploaddoc', $endUseList, $loanType, $amount, $loanTenure, $loanId);
      } else {
        $redirectUrl = $this->generateRedirectURL('loans/application', $endUseList, $loanType, $amount, $loanTenure, $loanId);
      }
    }
  //$redirectUrl = $this->generateRedirectURL('loans/application', $endUseList, $loanType, $amount, $loanTenure, $loanId);
    return Redirect::to($redirectUrl);
  }

  /**
   * @param $endUseList
   * @param $loanType
   * @param $amount
   * @param $chosenLoanTenure
   * @param $loanId
   * @return Response
   * @return mixed
   */
//public function getApplication($loanType, $endUseList = null, $amount = null, $loanTenure= null, $loanId = null){
  public function getApplication($param1 = null, $param2 = null, $param3 = null, $param4 = null, $param5 = null, $param6 = null, $param7 = null, $param8 = null)
  {
  //dd($param1,$param2,$param3,$param4,$param5,$param6,$param7,$param8);
  //$endUseList,$loanType, $amount=null, $loanTenure = null, $companySharePledged= null, $bscNscCode = null,$loanId=null
    $endUseList = $param1;
    $loanType = $param2;
  //$loanProduct = $param2;
    $amount = $param3;
    $loanTenure = $param4;
    $companySharePledged = null;
    $bscNscCode = null;
    $afterShare = null;
    if (isset($param5) && isset($param6) && isset($param8)) {
    //  echo "string";
      $companySharePledged = $param5;
      $bscNscCode = $param6;
      $loanId = $param8;
      $afterShare = $param7;
    } elseif (isset($param5) && isset($param6)) {
      $companySharePledged = $param5;
      $bscNscCode = $param6;
      $loanId = $param7;
    } else {
      $loanId = $param5;
    }
  /* echo $loanId."=loanid<br>";
  echo $endUseList."=enuse<br>";
  echo $loanType."=loantype<br>";

  echo $amount."=amt<br>";
  echo $loanTenure."=tenure<br>";
  echo $companySharePledged."=companyName<br>";
  echo $bscNscCode."=Companycode<br>";
  echo $afterShare."=aftershare<br>";*/
  //dd($param1,$param2,$param3,$param4,$param5,$param6,$param7,$param8);
  //dd($endUseList,$loanType,$amount,$loanTenure,$companySharePledged,$bscNscCode,$afterShare,$loanId);
  $documentsTypes = MasterData::documentTypes();
  $chosenDocuments = [];
  $ownerTypes = [null => ''] + MasterData::propertyOwnerTypes();
  $propertyIs = [null => ''] + MasterData::propertyPropertyIs();
  $cities = MasterData::cities();
  $chosenOwner = null;
  $chooseProperty = null;
  $otherSecurityTypes = MasterData::otherSecurityTypes();
  $choosenOtherSecurityType = null;
  $purchasedEquipmentTypes = MasterData::purchasedEquipmentTypes();
  $typeOfInventory = MasterData::typeOfInventory();
  $natureOfInventory = MasterData::natureOfInventory();
  $paymentTermsType = MasterData::paymentTermsType();
  $choosenPaymentTermsType = null;
  $propertyType = MasterData::propertyTypes();
  $chosenPropertyType = null;
  $propertyLand = MasterData::propertyLands();
  $chosenPropertyLand = null;
  $craditRating = MasterData::craditRatings();
  $chooseCraditRating = null;
  $ratingAgencies = MasterData::ratingAgencies();
  $chooseRatingAgency = null;
  $payment_count = 0;
  $receivable_count = 0;
  //dd($otherSecurityTypes);
  $loan = null;
  $setDisable = null;
  $user = Auth::getUser();
  $setDisable = $this->getIsDisabled($user);
  $isRemoveMandatory = MasterData::removeMandatory();
  $isRemoveMandatory = array_except($isRemoveMandatory, ['']);
  $removeMandatoryHelper = new validLoanUrlhelper();
  $removeMandatory = $removeMandatoryHelper->getMandatory($user, $isRemoveMandatory);
  $validLoanHelper = new validLoanUrlhelper();
  $isHideShowReceivableDiscount = $validLoanHelper->securityTabHideShow($endUseList);
  //        dd($isHideShowReceivableDiscount);
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
  //dd($loanId);
  if (isset($loanId)) {
    $loan = Loan::find($loanId);
    $model = $loan->getSecurityDetails()->get()->first();
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
    $loanSecurityShare = LoanAgainstShare::where('loan_id', '=', $loanId)->first();
    //dd(  $loanSecurityShare);
  }
  if (isset($loanId)) {
    $loan = Loan::find($loanId);
    $securityDetailId = $loan->id;
    $buyerDetailId = $loan->id;
    if (isset($securityDetailId)) {
      $securityDetails = SecurityDetail::where('loan_id', '=', $securityDetailId)->first();
    }
    if (isset($securityDetails)) {
      if (in_array($securityDetails->city, $cities)) {
        $model->city = $securityDetails->city;
      } else {
        $model->city_other = $securityDetails->city;
        $model->city = 'Other';
      }
    }
    $buyer_details = BuyerDetail::where('loan_id', '=', $loanId)->get();
    //dd($byuer_details);
  }
  if (isset($securityDetails)) {
    $isCollateralProperty = $securityDetails->is_collateral_property;
    $othersecurityType = $securityDetails->othersecurity_type;
    $sourcedType = $securityDetails->sourced_type;
  } else {
    $isCollateralProperty = null;
    $othersecurityType = null;
    $sourcedType = null;
  }
  // dd($model);
  //        dd($securityDetails,$isCollateralProperty,$othersecurityType,$sourcedType,$buyer_name_0);\
  $maxPaymentTerms = Config::get('constants.CONST_MAX_PAYMENT_TERMS');
  $maxReceivableDiscount = Config::get('constants.CONST_MAX_RECEIVABLE_DISCOUNT');
  $deletedQuestionsLoan = $this->getDeletedQuestionLoan($loan, $loanType, $amount);
  $deletedQuestionHelper = new DeletedQuestionsHelper($deletedQuestionsLoan);
  $helper = new DeletedQuestionsHelper($loan);
  Session::set('end_use', $endUseList);
  Session::set('loanId', $loanId);
  Session::set('loan_amount', $amount);
  Session::set('loan_tenure', $loanTenure);
  Session::set('type', $loanType);
  //getting borrowers profile
  if (isset($loanId)) {
    $loan = Loan::find($loanId);
    $loanUser = User::find($loan->user_id);
    $loanUserProfile = $loanUser->userProfile();
  }
  @$security_object = SecurityDetail::where('loan_id', '=', $loanId)->get()->first();
  //dd($loanId);
  $userPr = UserProfile::where('user_id', '=', $loan->user_id)->first();
  $userProfile = UserProfile::with('user')->find($userPr->id);
  if (isset($companySharePledged) && isset($bscNscCode) && isset($afterShare)) {

    $subViewType = 'loans._application';
    $formaction = 'Loans\LoansController@postApplication';
    return view('loans.createedit', compact(
      'subViewType',
      'endUseList',
      'loanType',
      'amount',
      'loanTenure',
      'loan',
      'loanId',
      'formaction',
      'payment_count',
      'receivable_count',
      'documentsTypes',
      'chosenDocuments',
      'ownerTypes',
      'propertyIs',
      'chosenOwner',
      'otherSecurityTypes',
      'choosenOtherSecurityType',
      'business_object',
      'helper',
      'purchasedEquipmentTypes',
      'paymentTermsType',
      'choosenPaymentTermsType',
      'maxPaymentTerms',
      'maxReceivableDiscount',
      'setDisable',
      'deletedQuestionHelper',
      'model',
      'propertyType',
      'chosenPropertyType',
      'typeOfInventory',
      'natureOfInventory',
      'valuOfInventory',
      'security_object',
      'isCollateralProperty',
      'othersecurityType',
      'sourcedType',
      'buyer_details',
      'cities',
      'validLoanHelper',
      'removeMandatory',
      'isHideShowReceivableDiscount',
      'loanUserProfile',
      'userProfile',
      'chooseProperty'
    ));
  } elseif (isset($companySharePledged) && isset($bscNscCode)) {


    $subViewType = 'loans._application_las';
    $formaction = 'Loans\LoansController@postApplicationlas';
    return view('loans.createedit', compact(
      'subViewType',
      'endUseList',
      'loanType',
      'amount',
      'loanTenure',
      'loan',
      'companySharePledged',
      'bscNscCode',
      'loanId',
      'formaction',
      'setDisable',
      'model',
      'propertyIs',
      'chooseProperty ',
      'sourcedType',
      'buyer_details',
      'cities',
      'validLoanHelper',
      'removeMandatory',
      'loanUserProfile',
      'craditRating',
      'userProfile',
      'currentQuarter',
      'previousQuarter',
      'chooseCraditRating',
      'loanSecurityShare',
      'ratingAgencies',
      'chooseRatingAgency'
    ));
  } else {

    $subViewType = 'loans._application';
    $formaction = 'Loans\LoansController@postApplication';
    return view('loans.createedit', compact(
      'subViewType',
      'endUseList',
      'loanType',
      'amount',
      'loanTenure',
      'loan',
      'loanId',
      'formaction',
      'payment_count',
      'receivable_count',
      'documentsTypes',
      'chosenDocuments',
      'ownerTypes',
      'propertyIs',
      'chosenOwner',
      'otherSecurityTypes',
      'choosenOtherSecurityType',
      'business_object',
      'helper',
      'purchasedEquipmentTypes',
      'paymentTermsType',
      'choosenPaymentTermsType',
      'maxPaymentTerms',
      'maxReceivableDiscount',
      'setDisable',
      'deletedQuestionHelper',
      'model',
      'propertyType',
      'chosenPropertyType',
      'propertyLand',
      'chosenPropertyLand',
      'typeOfInventory',
      'natureOfInventory',
      'valuOfInventory',
      'security_object',
      'isCollateralProperty',
      'othersecurityType',
      'sourcedType',
      'buyer_details',
      'cities',
      'validLoanHelper',
      'removeMandatory',
      'isHideShowReceivableDiscount',
      'userProfile',
      'loanUserProfile',
      'chooseProperty'
    ));
  }
}

public function postApplication(Request $request)
{
  $input = Input::all();
  $loanId = isset($input['loanId']) ? $input['loanId'] : null;
  $loanType = isset($input['type']) ? $input['type'] : null;
  $amount = isset($input['loan_amount']) ? $input['loan_amount'] : null;
  $loanTenure = isset($input['loan_tenure']) ? $input['loan_tenure'] : null;
  $endUseList = isset($input['end_use']) ? $input['end_use'] : null;
  $companySharePledged = isset($input['companySharePledged']) ? $input['companySharePledged'] : null;
  $bscNscCode = isset($input['bscNscCode']) ? $input['bscNscCode'] : null;
  // $counter = $input['counter_storage'];
  $modelId = (isset($input['model_id']) && $input['model_id'] != "") ? $input['model_id'] : null;
  $loan = null;
  $model = null;
  $fieldsArr = [];
  $rulesArr = [];
  $messagesArr = [];
  if (isset($loanId)) {
    $loan = Loan::find($loanId);
    $deletedQuestionsLoan = $this->getDeletedQuestionLoan($loan, $loanType, $amount);
    $deletedQuestionHelper = new DeletedQuestionsHelper($deletedQuestionsLoan);
    if ($loanType == 'LAP' || $loanType == 'CC' || $loanType == 'STL') {
      $input['is_collateral_property'] = 1;
    }
    if ($deletedQuestionHelper->isQuestionValid("E1")) {
      /*  $fieldsArr['is_collateral_property']=$input['is_collateral_property'];
      $rulesArr['is_collateral_property']='required';
      $messagesArr['is_collateral_property.required']='Collateral Property is required.';*/
      /*
      if($input['is_collateral_property'] == '1')
      {
      $fieldsArr['collateral_type']=$input['collateral_type'];
      $rulesArr['collateral_type']='required';
      $messagesArr['collateral_type.required']='Type of collateral offered is required.';
      $fieldsArr['area']=$input['area'];
      $rulesArr['area']='required';
      $messagesArr['area.required']='Area is required.';
      $fieldsArr['city']=$input['city'];
      $rulesArr['city']='required';
      $messagesArr['city.required']='City is required.';
      $fieldsArr['pincode']=$input['pincode'];
      $rulesArr['pincode']='required';
      $messagesArr['pincode.required']='Pin code is required.';
      $fieldsArr['owner']=$input['owner'];
      $rulesArr['owner']='required';
      $messagesArr['owner.required']='Owner is required.';
      $fieldsArr['latest_valuation']=$input['latest_valuation'];
      $rulesArr['latest_valuation']='required';
      $messagesArr['latest_valuation.required']='Latest Valuation is required.';
      if(isset($input['occupied_type'])){
      $fieldsArr['occupied_type']=$input['occupied_type'];
    }
    $rulesArr['occupied_type']='required';
    $messagesArr['occupied_type.required']='IS it? is required.';
  }
         */
}
/*
if ($deletedQuestionHelper->isQuestionValid("E2")) {
if(isset($input['othersecurity_type'])) {
$fieldsArr['othersecurity_type'] = $input['othersecurity_type'];
}
$rulesArr['othersecurity_type'] = 'required';
$messagesArr['othersecurity_type.required'] = 'Other Security is required.';
if(isset($input['othersecurity_type'])) {
if ($input['othersecurity_type'] == 'Others') {
$fieldsArr['others_value'] = $input['others_value'];
$rulesArr['others_value'] = 'required';
$messagesArr['others_value.required'] = 'Other Value is required.';
}
}
}
       */
// if ($deletedQuestionHelper->isQuestionValid("E3")) {
/* $fieldsArr['equipment_type']=$input['equipment_type'];
$rulesArr['equipment_type']='required';
$messagesArr['equipment_type.required']='Type of Equipment is required.';
if($input['equipment_type'] == 'Others')
{
$fieldsArr['equipment_type_others']=$input['equipment_type_others'];
$rulesArr['equipment_type_others']='required';
$messagesArr['equipment_type_others.required']='Other Equipment Type Value is required.';
}*/
//                $fieldsArr['description']=$input['description'];
//                $rulesArr['description']='required';
//                $messagesArr['description.required']='Brief Description is required.';
/*  $fieldsArr['sourced_type']=$input['sourced_type'];
$rulesArr['sourced_type']='required';
$messagesArr['sourced_type.required']='Sourced Field is required.';
       */
/*  if($input['sourced_type'] == 'owned')
{
$fieldsArr['invoice_cif_in_lacs']=$input['invoice_cif_in_lacs'];
$rulesArr['invoice_cif_in_lacs']='required';
$messagesArr['invoice_cif_in_lacs.required']='Invoice CIF Value in Lacs Value is required.';
$fieldsArr['custom_duty']=$input['custom_duty'];
$rulesArr['custom_duty']='required';
$messagesArr['custom_duty.required']='Custom & Other Duty Value is required.';
$fieldsArr['invoice_cif_in_usd']=$input['invoice_cif_in_usd'];
$rulesArr['invoice_cif_in_usd']='required';
$messagesArr['invoice_cif_in_usd.required']='Invoice CIF Value in USD Value is required.';
}*/
//   if($input['sourced_type'] == 'rented') {
//                    $fieldsArr['invoice_value'] = $input['invoice_value'];
//                    $rulesArr['invoice_value'] = 'required';
//                    $messagesArr['invoice_value.required'] = 'Invoice Value in Lacs Value is required.';
}
//    if($input['equipment_type'] == 'Medical Equipment' || $input['equipment_type'] == 'Construction/Excavation Equipment' || $input['equipment_type'] == 'Transportation Vehicles') {
//                    $fieldsArr['manufacturer_name_mandatory'] = $input['manufacturer_name_mandatory'];
//                    $rulesArr['manufacturer_name_mandatory'] = 'required';
//                    $messagesArr['manufacturer_name_mandatory.required'] = 'Manufacturer Name Field is required.';
//
//                    $fieldsArr['manufacture_year_mandatory'] = $input['manufacture_year_mandatory'];
//                    $rulesArr['manufacture_year_mandatory'] = 'required';
//                    $messagesArr['manufacture_year_mandatory.required'] = 'Manufacture Year Field is required.';
//  }
// }
// }
$validator = Validator::make($fieldsArr, $rulesArr, $messagesArr);
if ($validator->fails()) {
  return Redirect::back()->withErrors($validator)->withInput();
} else {
  $user = Auth::getUser();
  $input['user_id'] = $user->id;
  $input['loan_id'] = $loan->id;
  if (isset($loanId)) {
    $loan = Loan::find($loanId);
  }
  if (isset($input['city']) && $input['city'] == 'Other') {
    $input['city'] = $input['city_other'];
  }


  if (isset($input)) {
    for ($i = 1; $i <= 12; $i++) {
      if (isset($input['avl_doc_name_' . $i])) {
        $input['avl_doc_name_' . $i] = $input['avl_doc_name_' . $i];
      } else {
        $input['avl_doc_name_' . $i] = null;
      }
    }
  }

  SecurityDetail::updateOrCreate(['id' => $loan->id], $input);
  if (isset($modelId)) {
    SecurityDetail::updateOrCreate(['id' => $modelId], $input);
  } else {
    SecurityDetail::updateOrCreate(['id' => $modelId], $input);
  }


  $buyerCount = $input['receivable_count'];
  $buyerCount_inv1 = $input['receivables0InvoiceCounter'];
  $buyerCount_inv2 = $input['receivables1InvoiceCounter'];
  $buyerCount_inv3 = $input['receivables2InvoiceCounter'];
  // dd($buyerCount_inv2);
  $string = "";
  DB::table('loans_buyer_details')->where('loan_id', '=', $loan->id)->delete();
  for ($i = 0; $i <= $buyerCount; $i++) {
    if (isset($input['buyer_name_' . $i])) {
      DB::table('loans_buyer_details')->insert([
        'loan_id' => $loan->id,
        'buyer_name' => $input['buyer_name_' . $i],
        'avg_monthly_sale' => $input['avg_monthly_sale_' . $i],
        'buyer_serial_num' => $i + 1,
      ]);
      if ($i == 0) {
        for ($d = 0; $d <= $buyerCount_inv1; $d++) {
          DB::table('loans_buyer_details')
                ->where('loan_id', '=', $loan->id) // find your user by their email
                ->where('buyer_serial_num', '=', $i + 1)
                ->limit(1) // optional - to ensure only one record is updated.
                ->update(['invoice_date_' . ($d + 1) => $input['invoice_date_' . $i . '_' . $d], 'amount_' . ($d + 1) => $input['amount_' . $i . '_' . $d], 'payment_terms_' . ($d + 1) => @$input['payment_terms_' . $i . '_' . $d]]);
              }
            }
            if ($i == 1) {
              for ($d2 = 0; $d2 <= $buyerCount_inv2; $d2++) {
                DB::table('loans_buyer_details')
                ->where('loan_id', '=', $loan->id) // find your user by their email
                ->where('buyer_serial_num', '=', $i + 1)
                ->limit(1) // optional - to ensure only one record is updated.
                ->update(['invoice_date_' . ($d2 + 1) => $input['invoice_date_' . $i . '_' . $d2], 'amount_' . ($d2 + 1) => $input['amount_' . $i . '_' . $d2], 'payment_terms_' . ($d2 + 1) => $input['payment_terms_' . $i . '_' . $d2]]);
              }
            }
            if ($i == 2) {
              for ($d3 = 0; $d3 <= $buyerCount_inv3; $d3++) {
                DB::table('loans_buyer_details')
                ->where('loan_id', '=', $loan->id) // find your user by their email
                ->where('buyer_serial_num', '=', $i + 1)
                ->limit(1) // optional - to ensure only one record is updated.
                ->update(['invoice_date_' . ($d3 + 1) => $input['invoice_date_' . $i . '_' . $d3], 'amount_' . ($d3 + 1) => $input['amount_' . $i . '_' . $d3], 'payment_terms_' . ($d3 + 1) => $input['payment_terms_' . $i . '_' . $d3]]);
              }
            }
            /* }*/
          }
        }
        $loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loan->id], ['loan_id' => $loanId, 'security_details' => 'Y']);
        $loansStatus->save();
        $this->getLoansStatus($loanId);
        Session::set('end_use', $endUseList);
        Session::set('loanId', $loanId);
        Session::set('loan_amount', $amount);
        Session::set('loan_tenure', $loanTenure);
        Session::set('type', $loanType);
  // $redirectUrl = $this->generateRedirectURL('loans/uploaddoc', $endUseList, $loanType , $amount, $loanTenure, $loanId);
        $redirectUrl = $this->generateRedirectURL('loans/uploaddoc', $endUseList, $loanType, $amount, $loanTenure, $companySharePledged, $bscNscCode, $loanId);
        return Redirect::to($redirectUrl);
      }
    }

/*
Post Application LAS
   */
public function postApplicationlas(Request $request)
{
  $input = Input::all();
  $loanId = isset($input['loanId']) ? $input['loanId'] : null;
  $loanType = isset($input['type']) ? $input['type'] : null;
  $amount = isset($input['loan_amount']) ? $input['loan_amount'] : null;
  $loanTenure = isset($input['loan_tenure']) ? $input['loan_tenure'] : null;
  $endUseList = isset($input['end_use']) ? $input['end_use'] : null;
  $companySharePledged = isset($input['companySharePledged']) ? $input['companySharePledged'] : null;
  $bscNscCode = isset($input['bscNscCode']) ? $input['bscNscCode'] : null;
  // $counter = $input['counter_storage'];
  $modelId = (isset($input['model_id']) && $input['model_id'] != "") ? $input['model_id'] : null;
  $loan = null;
  $model = null;
  $fieldsArr = [];
  $rulesArr = [];
  $messagesArr = [];
  // dd($input['documents'][0]);
  $validator = Validator::make($fieldsArr, $rulesArr, $messagesArr);
  if ($validator->fails()) {
    return Redirect::back()->withErrors($validator)->withInput();
  } else {
    $user = Auth::getUser();
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
    }
    //$loansStatus = LoanAgainstShare::updateOrCreate(array('loan_id' => $loan->id), ['loan_id' => $loanId, 'security_details' => 'Y']);
    $loansStatus = LoanAgainstShare::updateOrCreate(['loan_id' => $loan->id], $input);
    $loansStatus->save();
    $this->getLoansStatus($loanId);
    // $redirectUrl = $this->generateRedirectURL('loans/application',$endUseList, $loanType, $amount, $loanTenure,$companySharePledged,$bscNscCode,$afterShare='afterShare',$loan->id);
    //$redirectUrl = $this->generateRedirectURL('loans/uploaddoc',$endUseList, $loanType, $amount, $loanTenure,$loanId);
    $redirectUrl = $this->generateRedirectURL('loans/uploaddoc', $endUseList, $loanType, $amount, $loanTenure, $companySharePledged, $bscNscCode, $loanId);
    // dd($redirectUrl);
    return Redirect::to($redirectUrl);
    //            return Redirect::back()->with('data',[$endUseList,$loanType,$amount,$loanTenure,$loanId]);
    //            $loanId = $loan->id;
    //            $redirectUrl = $this->generateRedirectURL('loans/uploaddoc', $endUseList, $loanType, $amount, $loanTenure, $loanId);
    //            return Redirect::to($redirectUrl);
  }
}

  /**
   * @param $loanType
   * @param $endUseList
   * @param $amount
   * @param $chosenLoanTenure
   * @param $loanId
   * @return Response
   * @return mixed
   */
//public function getUploaddoc($loanType, $endUseList = null, $amount = null, $loanTenure= null, $loanId = null) {
  public function getUploaddoc($param1 = null, $param2 = null, $param3 = null, $param4 = null, $param5 = null, $param6 = null, $param7 = null, $param8 = null)
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
    //$loan = Loan::find($loanId);
      $securityDetail = $loan->getSecurityDetails()->get()->first();
      if ($companySharePledged == null) {
        if (@$securityDetail->is_any_other_security == 1) {
          $displayNoneSecurity = $securityDetail->is_any_other_security;
        }
      }
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
    $loan_tenure = MasterData::tenureYearList();
    $chosenLoanTenure = null;
    $loan_product = MasterData::loanProductType();
    $chosenLoanProduct = null;
    $subViewType = 'loans._upload_doc';
    $formaction = 'Loans\LoansController@postUploaddoc';
  //$bl_year = MasterData::BalanceSheet_FY();
    $bl_year = $this->setFinancialYears();
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
    $isRemoveMandatory = MasterData::removeMandatory();
    $isRemoveMandatory = array_except($isRemoveMandatory, ['']);
    $removeMandatoryHelper = new validLoanUrlhelper();
    $removeMandatory = $removeMandatoryHelper->getMandatory($user, $isRemoveMandatory);

    $deletedQuestionsLoan = $this->getDeletedQuestionLoan($loan, $loanType, $amount);
    $deletedQuestionHelper = new DeletedQuestionsHelper($deletedQuestionsLoan);
    $isQuestionMandatory = new UploadDocHelper($loan);
    $user = Auth::getUser();
    $user_id = $user->id;
    $max_cmpny_bank_stmt = Config::get('constants.CONST_MAX_COMPANY_BANK_STATEMENT');
    $maxInvoiceCopyofEquipmentPurchase = Config::get('constants.CONST_MAX_INVOICE_COPY_OF_EQUIPMENT_PURCHASE');
    $maxInvoiceBillDetails = Config::get('constants.CONST_MAX_COPY_OF_INVOICE_BILL_DETAILS');
    $maxSecurityDocument = Config::get('constants.CONST_MAX_SECURITY_DOCUMENT_DETAILS');
    $upload_doc = null;
    $blplfile = [];
    $kycdocument_file = null;
    $pan_promoter_file = null;
    $identity_proof_file = null;
    $proof_address_file = null;
    $bankstatement_file = null;
    $cmpnybankstmt_file = [];
    $cibilreport_file = null;
    $visitingcard_file = null;
    $promoternetworth_file = null;
    $propertypapers_file = null;
    $corporate_file = null;
    $networthcertificate_file = null;
    $otherdocument_file = null;
    $ecommercesupply_file = null;
    $pancard_file = null;
    $vatregistration_file = null;

    $shopestablish_file = null;
    $addressproof_company_file = null;
    $optional_file1 = null;
    $optional_file2 = null;
    $promoter_cibilreport_file = null;
    $promoter_proof_address_file = null;
    $equipmentPurchaseCopy = [];
    $invoiceCopy = [];
    $lastValuation = [];
    $titleSearch = [];
    $propertyTax = [];
    $occupation = [];
    $socityShare = [];
    $extractFile = [];
    $lastSaledeed = [];
    $muncipalFile = [];
    $electricityBill = [];
    $existingSecurityFiles = 0;
    $model = null;
    $securityDetailsFile = null;
    $n = 0;
    $cnt = 0;
    $o = 0;
    $p = 0;
    $q = 0;
    $r = 0;
    $s = 0;
    $t = 0;
    $u = 0;
    $v = 0;
    $fileHelper = new FileHelper();
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
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
      $model = $loan->getUploads()->get()->first();
      if (isset($model)) {
        $model = $model->toArray();
        for ($i = 1; $i <= count($model); $i++) {
          foreach ($model as $key => $val) {
            if ($key == 'finyear_file' . $i . '_path') {
              if (isset($val)) {
                $blplfile[$key] = $fileHelper->getFileDownloadURL($val);
              }
            } else if ($key == 'bank_file' . $i . '_path') {
              if (isset($val)) {
                $cmpnybankstmt_file[$key] = $fileHelper->getFileDownloadURL($val);
              }
            } else if ($key == 'cibilreport_file_path') {
              if (isset($val)) {
                $cibilreport_file = $fileHelper->getFileDownloadURL($val);
              }
            } else if ($key == 'pancard_file_path') {
              if (isset($val)) {
                $pancard_file = $fileHelper->getFileDownloadURL($val);
              }
            } else if ($key == 'vatreg_file_path') {
              if (isset($val)) {
                $vatregistration_file = $fileHelper->getFileDownloadURL($val);
              }
            } else if ($key == 'shopestablish_file_path') {
              if (isset($val)) {
                $shopestablish_file = $fileHelper->getFileDownloadURL($val);
              }
            } else if ($key == 'addproof_file_path') {
              if (isset($val)) {
                $addressproof_company_file = $fileHelper->getFileDownloadURL($val);
              }
            } else if ($key == 'kyc_extra_file1_path') {
              if (isset($val)) {
                $optional_file1 = $fileHelper->getFileDownloadURL($val);
              }
            } else if ($key == 'kyc_extra_file2_path') {
              if (isset($val)) {
                $optional_file2 = $fileHelper->getFileDownloadURL($val);
              }
            } else if ($key == 'prom_bank_stmt_file_path') {
              if (isset($val)) {
                $bankstatement_file = $fileHelper->getFileDownloadURL($val);
              }
            } else if ($key == 'prom_networth_file_path') {
              if (isset($val)) {
                $promoternetworth_file = $fileHelper->getFileDownloadURL($val);
              }
            } else if ($key == 'prom_cibilreport_file_path') {
              if (isset($val)) {
                $promoter_cibilreport_file = $fileHelper->getFileDownloadURL($val);
              }
            } else if ($key == 'prom_kyc_addproof_file_path') {
              if (isset($val)) {
                $promoter_proof_address_file = $fileHelper->getFileDownloadURL($val);
              }
            } else if ($key == 'prom_idproof_file_path') {
              if (isset($val)) {
                $identity_proof_file = $fileHelper->getFileDownloadURL($val);
              }
            } else if ($key == 'prom_visiting_file_path') {
              if (isset($val)) {
                $visitingcard_file = $fileHelper->getFileDownloadURL($val);
              }
            } else if ($key == 'prom_pancard_file_path') {
              if (isset($val)) {
                $pan_promoter_file = $fileHelper->getFileDownloadURL($val);
              }
            } else if ($key == 'business_corporate_file_path') {
              if (isset($val)) {
                $corporate_file = $fileHelper->getFileDownloadURL($val);
              }
            } else if ($key == 'business_cert_ecom_file_path') {
              if (isset($val)) {
                $ecommercesupply_file = $fileHelper->getFileDownloadURL($val);
              }
            } else if ($key == 'business_invoice_equi' . $i . '_file_path') {
              if (isset($val)) {
                $equipmentPurchaseCopy[$key] = $fileHelper->getFileDownloadURL($val);
              }
            } else if ($key == 'business_invoice_bill' . $i . '_file_path') {
              if (isset($val)) {
                $invoiceCopy[$key] = $fileHelper->getFileDownloadURL($val);
              }
            } else if ($key == 'last_pro_val_report' . $i . '_path') {
              if (isset($val)) {
                $lastValuation[$n] = $fileHelper->getFileDownloadURL($val);
                $n++;
                $cnt = $n;
              }
            } else if ($key == 'pro_title_search_report' . $i . '_path') {
              if (isset($val)) {
                $titleSearch[$o] = $fileHelper->getFileDownloadURL($val);
                $o++;
                if ($cnt < $o) {
                  $cnt = $o;
                }
              }
            } else if ($key == 'pro_tax_card' . $i . '_path') {
              if (isset($val)) {
                $propertyTax[$p] = $fileHelper->getFileDownloadURL($val);
                $p++;
                if ($cnt < $p) {
                  $cnt = $p;
                }
              }
            } else if ($key == 'oc' . $i . '_path') {
              if (isset($val)) {
                $occupation[$q] = $fileHelper->getFileDownloadURL($val);
                $q++;
                if ($cnt < $q) {
                  $cnt = $q;
                }
              }
            } else if ($key == 'society_share_cert' . $i . '_path') {
              if (isset($val)) {
                $socityShare[$r] = $fileHelper->getFileDownloadURL($val);
                $r++;
                if ($cnt < $r) {
                  $cnt = $r;
                }
              }
            } else if ($key == 'copy_7_12_extract' . $i . '_path') {
              if (isset($val)) {
                $extractFile[$s] = $fileHelper->getFileDownloadURL($val);
                $s++;
                if ($cnt < $s) {
                  $cnt = $s;
                }
              }
            } else if ($key == 'copy_last_sales_pur' . $i . '_path') {
              if (isset($val)) {
                $lastSaledeed[$t] = $fileHelper->getFileDownloadURL($val);
                $t++;
                if ($cnt < $t) {
                  $cnt = $t;
                }
              }
            } else if ($key == 'municipal_plan' . $i . '_path') {
              if (isset($val)) {
                $muncipalFile[$u] = $fileHelper->getFileDownloadURL($val);
                $u++;
                if ($cnt < $u) {
                  $cnt = $u;
                }
              }
            } else if ($key == 'electricity_bill_' . $i . '_path') {
              if (isset($val)) {
                $electricityBill[$v] = $fileHelper->getFileDownloadURL($val);
                $v++;
                if ($cnt < $v) {
                  $cnt = $v;
                }
              }
            }
          }
        }
      }
      if ($cnt != 0) {
        $existingSecurityFiles = $cnt;
      }
    }
  //getting borrowers profile
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
      $loanUser = User::find($loan->user_id);
      $loanUserProfile = $loanUser->userProfile();
    }
    $userPr = UserProfile::where('user_id', '=', $loan->user_id)->first();
    $userProfile = UserProfile::with('user')->find($userPr->id);
    return view('loans.createedit', compact(
      'subViewType',
      'endUseList',
      'loanType',
      'amount',
      'loanTenure',
      'loan',
      'loanId',
      'formaction',
      'loan_tenure',
      'chosenLoanTenure',
      'userProfile',
      'loan_product',
      'chosenLoanProduct',
      'bl_year',
      'addressTypes',
      'kycdocument_file',
      'pan_promoter_file',
      'proof_address_file',
      'bankstatement_file',
      'cibilreport_file',
      'visitingcard_file',
      'promoternetworth_file',
      'propertypapers_file',
      'corporate_file',
      'networthcertificate_file',
      'otherdocument_file',
      'ecommercesupply_file',
      'blplfile',
      'pancard_file',
      'vatregistration_file',
      'shopestablish_file',
      'removeMandatory',
      'addressproof_company_file',
      'optional_file1',
      'optional_file2',
      'promoter_cibilreport_file',
      'promoter_proof_address_file',
      'max_cmpny_bank_stmt',
      'cmpnybankstmt_file',
      'maxInvoiceCopyofEquipmentPurchase',
      'equipmentPurchaseCopy',
      'maxInvoiceBillDetails',
      'invoiceCopy',
      'maxSecurityDocument',
      'existingSecurityFiles',
      'lastValuation',
      'titleSearch',
      'propertyTax',
      'occupation',
      'socityShare',
      'extractFile',
      'lastSaledeed',
      'muncipalFile',
      'electricityBill',
      'setDisable',
      'displayNoneSecurity',
      'deletedQuestionHelper',
      'model',
      'isQuestionMandatory',
      'companySharePledged',
      'bscNscCode',
      'validLoanHelper',
      'mandatoryField',
      'identity_proof_file',
      'loanUserProfile'
    ));
  }

  public function postUploaddoc(Request $request)
  {
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
  //$bl_year = MasterData::BalanceSheet_FY();
    $bl_year = $this->setFinancialYears();
    $countYear = 0;
    if (isset($loanId)) {
      $fileHelper = new FileHelper();
      $directory = $user_id . "/" . $loanId;
      $uploadDetails = null;
    //Final Year copy
      if ($input['prom_kyc_addproof_name'] != " " || $input['prom_idproof_name'] != " ") {
        $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], ['prom_kyc_addproof_name' => $input['prom_kyc_addproof_name'], 'prom_idproof_name' => $input['prom_idproof_name']]);
        $uploadDetails->save();
      }
      foreach ($bl_year as $year) {
        $countYear++;
        if ($request->file('finyear_file' . $countYear . '_path')) {
          $file = $request->file('finyear_file' . $countYear . '_path');
          $originalFileName = $file->getClientOriginalName();
          $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . $year . '-' . $originalFileName;
          $oldFileName = null;
          $fieldName = 'finyear_file' . $countYear . '_path';
          if (!isset($uploadDetails)) {
            $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
          }
          if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
            $oldFileName = $uploadDetails->getAttribute($fieldName);
          }
          $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
          $uploadDetails->setAttribute($fieldName, $uploadedFileName);
        }

      }
// Bank Statement
      $maxCompanyBankStmt = Config::get('constants.CONST_MAX_COMPANY_BANK_STATEMENT');
      $maxCompanyBankStmtcount = @$input['num_bank'];
//dd($maxCompanyBankStmt);
      for ($i = 1; $i <= $maxCompanyBankStmt; $i++) {
        if ($maxCompanyBankStmtcount == 1 && $i > $maxCompanyBankStmtcount) {
          $bankStmt = Upload::updateOrCreate(['loan_id' => $loanId], ['bank_name' . $i => null, 'bank_period' . $i => null, 'bank_file' . $i . '_path' => null]);
          $bankStmt->save();
        } elseif ($maxCompanyBankStmtcount == 2 && $i > $maxCompanyBankStmtcount) {
          $bankStmt = Upload::updateOrCreate(['loan_id' => $loanId], ['bank_name' . $i => null, 'bank_period' . $i => null, 'bank_file' . $i . '_path' => null]);
          $bankStmt->save();
        }
      }
      for ($i = 1; $i <= $maxCompanyBankStmtcount; $i++) {
        if (!empty($input['bank_name' . $i])) {
          $bankStmt = Upload::updateOrCreate(['loan_id' => $loanId], ['bank_name' . $i => $input['bank_name' . $i], 'bank_period' . $i => $input['bank_period' . $i]]);
          $bankStmt->save();
        }
        if ($request->file('bank_file' . $i . '_path')) {
          $file = $request->file('bank_file' . $i . '_path');
          $originalFileName = $file->getClientOriginalName();
          $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'bankstmt_' . $i . '-' . $originalFileName;
          $oldFileName = null;
          $fieldName = 'bank_file' . $i . '_path';
          if (!isset($uploadDetails)) {
            $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
          }
          if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
            $oldFileName = $uploadDetails->getAttribute($fieldName);
          }
          $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
          $uploadDetails->setAttribute($fieldName, $uploadedFileName);
        }
      }
//CIBIL Report
      if ($request->file('cibilreport_file_path')) {
        $file = $request->file('cibilreport_file_path');
        $originalFileName = $file->getClientOriginalName();
        $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'cibil_report' . '_' . $originalFileName;
        $oldFileName = null;
        $fieldName = 'cibilreport_file_path';
        if (!isset($uploadDetails)) {
          $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
        }
        if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
          $oldFileName = $uploadDetails->getAttribute($fieldName);
        }
        $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
        $uploadDetails->setAttribute($fieldName, $uploadedFileName);
      }
//Company Kyc Details Files\
      if (isset($input['kycDetails'])) {
        for ($i = 1; $i <= count($input['kycDetails']); $i++) {
          $file_temp = $input['kycDetails'][$i];
          foreach ($file_temp as $key => $item) {
            if (isset($item)) {
              $file = $item;
              $originalFileName = $file->getClientOriginalName();
              $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'KYC_' . $originalFileName;
              $oldFileName = null;
              $fieldName = $key;
              if (!isset($uploadDetails)) {
                $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
              }
              if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
                $oldFileName = $uploadDetails->getAttribute($fieldName);
              }
              $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
              $uploadDetails->setAttribute($fieldName, $uploadedFileName);
            }

          }
        }
      }
      if ($request->file('prom_bank_stmt_file_path')) {
        $file = $request->file('prom_bank_stmt_file_path');
        $originalFileName = $file->getClientOriginalName();
        $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'promoter_bankStmt_' . $originalFileName;
        $oldFileName = null;
        $fieldName = 'prom_bank_stmt_file_path';
        if (!isset($uploadDetails)) {
          $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
        }
        if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
          $oldFileName = $uploadDetails->getAttribute($fieldName);
        }
        $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
        $uploadDetails->setAttribute($fieldName, $uploadedFileName);
      }

      if ($request->file('prom_networth_file_path')) {
        $file = $request->file('prom_networth_file_path');
        $originalFileName = $file->getClientOriginalName();
        $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'promoter_networth' . '_' . $originalFileName;
        $oldFileName = null;
        $fieldName = 'prom_networth_file_path';
        if (!isset($uploadDetails)) {
          $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
        }
        if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
          $oldFileName = $uploadDetails->getAttribute($fieldName);
        }
        $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
        $uploadDetails->setAttribute($fieldName, $uploadedFileName);
      } else {
        if ($deletedQuestionHelper->isQuestionValid("F2.2")) {

        }
      }
      if ($request->file('prom_cibilreport_file_path')) {
        $file = $request->file('prom_cibilreport_file_path');
        $originalFileName = $file->getClientOriginalName();
        $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'promoter_cibil' . '_' . $originalFileName;
        $oldFileName = null;
        $fieldName = 'prom_cibilreport_file_path';
        if (!isset($uploadDetails)) {
          $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
        }
        if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
          $oldFileName = $uploadDetails->getAttribute($fieldName);
        }
        $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
        $uploadDetails->setAttribute($fieldName, $uploadedFileName);
      }
      if ($request->file('prom_kyc_addproof_file_path')) {
        $file = $request->file('prom_kyc_addproof_file_path');
        $originalFileName = $file->getClientOriginalName();
        $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'promoter_address_proof' . '_' . $originalFileName;
        $oldFileName = null;
        $fieldName = 'prom_kyc_addproof_file_path';
        if (!isset($uploadDetails)) {
          $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
        }
        if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
          $oldFileName = $uploadDetails->getAttribute($fieldName);
        }
        $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
        $uploadDetails->setAttribute($fieldName, $uploadedFileName);
      }

      if ($request->file('prom_pancard_file_path')) {
        $file = $request->file('prom_pancard_file_path');
        $originalFileName = $file->getClientOriginalName();
        $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'promoter_pancard' . '_' . $originalFileName;
        $oldFileName = null;
        $fieldName = 'prom_pancard_file_path';
        if (!isset($uploadDetails)) {
          $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
        }
        if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
          $oldFileName = $uploadDetails->getAttribute($fieldName);
        }
        $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
        $uploadDetails->setAttribute($fieldName, $uploadedFileName);
      }

      if ($request->file('prom_idproof_file_path')) {
        $file = $request->file('prom_idproof_file_path');
        $originalFileName = $file->getClientOriginalName();
        $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'promoter_idproof' . '_' . $originalFileName;
        $oldFileName = null;
        $fieldName = 'prom_idproof_file_path';
        if (!isset($uploadDetails)) {
          $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
        }
        if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
          $oldFileName = $uploadDetails->getAttribute($fieldName);
        }
        $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
        $uploadDetails->setAttribute($fieldName, $uploadedFileName);
      } else



      if ($request->file('business_corporate_file_path')) {
        $file = $request->file('business_corporate_file_path');
        $originalFileName = $file->getClientOriginalName();
        $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'corporate_presentation' . '_' . $originalFileName;
        $oldFileName = null;
        $fieldName = 'business_corporate_file_path';
        if (!isset($uploadDetails)) {
          $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
        }
        if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
          $oldFileName = $uploadDetails->getAttribute($fieldName);
        }
        $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
        $uploadDetails->setAttribute($fieldName, $uploadedFileName);
      }
      if ($request->file('business_cert_ecom_file_path')) {
        $file = $request->file('business_cert_ecom_file_path');
        $originalFileName = $file->getClientOriginalName();
        $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'e-commerce_certificate' . $i . '_' . $originalFileName;
        $oldFileName = null;
        $fieldName = 'business_cert_ecom_file_path';
        if (!isset($uploadDetails)) {
          $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
        }
        if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
          $oldFileName = $uploadDetails->getAttribute($fieldName);
        }
        $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
        $uploadDetails->setAttribute($fieldName, $uploadedFileName);
      }
//Invoice Copy of Equipment Purchase
      $maxInvoiceCopyofEquipmentPurchase = Config::get('constants.CONST_MAX_INVOICE_COPY_OF_EQUIPMENT_PURCHASE');
      if ($deletedQuestionHelper->isQuestionValid("F3.3")) {
        $maxEquipmentPurchaseCopy = $input['num_equi_purchase'];
        for ($i = 1; $i <= $maxInvoiceCopyofEquipmentPurchase; $i++) {
          if ($maxEquipmentPurchaseCopy == 1 && $i > $maxEquipmentPurchaseCopy) {
            $fieldName = 'business_invoice_equi' . $i . '_file_path';
            $equipmentPurchase = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => null]);
            $equipmentPurchase->save();
          } elseif ($maxEquipmentPurchaseCopy == 2 && $i > $maxEquipmentPurchaseCopy) {
            $fieldName = 'business_invoice_equi' . $i . '_file_path';
            $equipmentPurchase = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => null]);
            $equipmentPurchase->save();
          }
        }
      }
      if (isset($input['equipementPurchase'])) {
        $m = 1;
        foreach ($input['equipementPurchase'] as $key => $file) {
          if ($m <= $input['num_equi_purchase']) {
            if (isset($file)) {
              $originalFileName = $file->getClientOriginalName();
              $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'equipment_copy' . '-' . $originalFileName;
              $oldFileName = null;
              $fieldName = $key;
              if (!isset($uploadDetails)) {
                $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
              }
              if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
                $oldFileName = $uploadDetails->getAttribute($fieldName);
              }
              $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
              $uploadDetails->setAttribute($fieldName, $uploadedFileName);
            } else {

            }
          } else {
            break;
          }
          $m++;
        }
      }
//Copy of Invoice/Bill details
      $maxInvoiceBillDetails = Config::get('constants.CONST_MAX_COPY_OF_INVOICE_BILL_DETAILS');
      if ($deletedQuestionHelper->isQuestionValid("F3.4")) {
        $maxInvoiceBillDetailsCount = $input['num_invoice_detail'];
        for ($i = 1; $i < $maxInvoiceBillDetails; $i++) {
          if ($maxInvoiceBillDetailsCount == 1 && $i > $maxInvoiceBillDetailsCount) {
            $fieldName = 'business_invoice_bill' . $i . '_file_path';
            $equipmentBillDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => null]);
            $equipmentBillDetails->save();
          } elseif ($maxInvoiceBillDetailsCount == 2 && $i > $maxInvoiceBillDetailsCount) {
            $fieldName = 'business_invoice_bill' . $i . '_file_path';
            $equipmentBillDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => null]);
            $equipmentBillDetails->save();
          } elseif ($maxInvoiceBillDetailsCount == 3 && $i > $maxInvoiceBillDetailsCount) {
            $fieldName = 'business_invoice_bill' . $i . '_file_path';
            $equipmentBillDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => null]);
            $equipmentBillDetails->save();
          } elseif ($maxInvoiceBillDetailsCount == 4 && $i > $maxInvoiceBillDetailsCount) {
            $fieldName = 'business_invoice_bill' . $i . '_file_path';
            $equipmentBillDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => null]);
            $equipmentBillDetails->save();
          }
        }
      }
      if (isset($input['invoiceBillFile'])) {
        $m = 1;
        foreach ($input['invoiceBillFile'] as $key => $file) {
          if ($m <= $input['num_invoice_detail']) {
            if (isset($file)) {
              $originalFileName = $file->getClientOriginalName();
              $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'invoice_bill' . '-' . $originalFileName;
              $oldFileName = null;
              $fieldName = $key;
              if (!isset($uploadDetails)) {
                $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
              }
              if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
                $oldFileName = $uploadDetails->getAttribute($fieldName);
              }
              $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
              $uploadDetails->setAttribute($fieldName, $uploadedFileName);
            } else {

            }
          } else {
            break;
          }
          $m++;
        }
      }
//===========Security Documents Uploads=============//
      $maxSecurityDocument = Config::get('constants.CONST_MAX_SECURITY_DOCUMENT_DETAILS');
      if (isset($input['num_security_doc'])) {
        $maxSecurityDocumentCount = $input['num_security_doc'];
        for ($i = 1; $i <= $maxSecurityDocument; $i++) {
          if ($maxSecurityDocumentCount == 1 && $i > $maxSecurityDocumentCount) {
            $fieldName1 = 'last_pro_val_report' . $i . '_path';
            $fieldName2 = 'pro_title_search_report' . $i . '_path';
            $fieldName3 = 'pro_tax_card' . $i . '_path';
            $fieldName4 = 'oc' . $i . '_path';
            $fieldName5 = 'society_share_cert' . $i . '_path';
            $fieldName6 = 'copy_7_12_extract' . $i . '_path';
            $fieldName7 = 'copy_last_sales_pur' . $i . '_path';
            $fieldName8 = 'municipal_plan' . $i . '_path';
            $securityDocs = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName1 => null, $fieldName2 => null, $fieldName3 => null, $fieldName4 => null, $fieldName5 => null, $fieldName6 => null, $fieldName7 => null, $fieldName8 => null]);
            $securityDocs->save();
          } elseif ($maxSecurityDocumentCount == 2 && $i > $maxSecurityDocumentCount) {
            $fieldName1 = 'last_pro_val_report' . $i . '_path';
            $fieldName2 = 'pro_title_search_report' . $i . '_path';
            $fieldName3 = 'pro_tax_card' . $i . '_path';
            $fieldName4 = 'oc' . $i . '_path';
            $fieldName5 = 'society_share_cert' . $i . '_path';
            $fieldName6 = 'copy_7_12_extract' . $i . '_path';
            $fieldName7 = 'copy_last_sales_pur' . $i . '_path';
            $fieldName8 = 'municipal_plan' . $i . '_path';
            $securityDocs = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName1 => null, $fieldName2 => null, $fieldName3 => null, $fieldName4 => null, $fieldName5 => null, $fieldName6 => null, $fieldName7 => null, $fieldName8 => null]);
            $securityDocs->save();
          }
        }
      }
      if (isset($input['security_lastvaluation_file'])) {
        $cnt = 0;
        foreach ($input['security_lastvaluation_file'] as $key => $file) {
          $cnt++;
          if ($cnt <= $maxSecurityDocumentCount) {
            if (isset($file)) {
              $originalFileName = $file->getClientOriginalName();
              $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'last_valuation' . '-' . $originalFileName;
              $oldFileName = null;
              $fieldName = $key;
              if (!isset($uploadDetails)) {
                $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
              }
              if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
                $oldFileName = $uploadDetails->getAttribute($fieldName);
              }
              $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
              $uploadDetails->setAttribute($fieldName, $uploadedFileName);
            } else {
              if ($deletedQuestionHelper->isQuestionValid("F4")) {

              }
            }
          } else {
            break;
          }
        }
      }
      if (isset($input['security_titlesearch_file'])) {
        $cnt = 0;
        foreach ($input['security_titlesearch_file'] as $key => $file) {
          $cnt++;
          if ($cnt <= $maxSecurityDocumentCount) {
            if (isset($file)) {
              $originalFileName = $file->getClientOriginalName();
              $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'title_search' . '-' . $originalFileName;
              $oldFileName = null;
              $fieldName = $key;
              if (!isset($uploadDetails)) {
                $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
              }
              if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
                $oldFileName = $uploadDetails->getAttribute($fieldName);
              }
              $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
              $uploadDetails->setAttribute($fieldName, $uploadedFileName);
            } else {
              if ($deletedQuestionHelper->isQuestionValid("F4")) {

              }
            }
          } else {
            break;
          }
        }
      }
      if (isset($input['security_propertytax_file'])) {
        $cnt = 0;
        foreach ($input['security_propertytax_file'] as $key => $file) {
          $cnt++;
          if ($cnt <= $maxSecurityDocumentCount) {
            if (isset($file)) {
              $originalFileName = $file->getClientOriginalName();
              $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'property_tax' . '-' . $originalFileName;
              $oldFileName = null;
              $fieldName = $key;
              if (!isset($uploadDetails)) {
                $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
              }
              if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
                $oldFileName = $uploadDetails->getAttribute($fieldName);
              }
              $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
              $uploadDetails->setAttribute($fieldName, $uploadedFileName);
            } else {
              if ($deletedQuestionHelper->isQuestionValid("F4")) {

              }
            }
          } else {
            break;
          }
        }
      }
      if (isset($input['security_occupation_file'])) {
        $cnt = 0;
        foreach ($input['security_occupation_file'] as $key => $file) {
          $cnt++;
          if ($cnt <= $maxSecurityDocumentCount) {
            if (isset($file)) {
              $originalFileName = $file->getClientOriginalName();
              $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'occupation_copy' . '-' . $originalFileName;
              $oldFileName = null;
              $fieldName = $key;
              if (!isset($uploadDetails)) {
                $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
              }
              if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
                $oldFileName = $uploadDetails->getAttribute($fieldName);
              }
              $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
              $uploadDetails->setAttribute($fieldName, $uploadedFileName);
            } else {
              if ($deletedQuestionHelper->isQuestionValid("F4")) {

              }
            }
          } else {
            break;
          }
        }
      }
      if (isset($input['security_societyshare_file'])) {
        $cnt = 0;
        foreach ($input['security_societyshare_file'] as $key => $file) {
          $cnt++;
          if ($cnt <= $maxSecurityDocumentCount) {
            if (isset($file)) {
              $originalFileName = $file->getClientOriginalName();
              $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'society_share' . '-' . $originalFileName;
              $oldFileName = null;
              $fieldName = $key;
              if (!isset($uploadDetails)) {
                $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
              }
              if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
                $oldFileName = $uploadDetails->getAttribute($fieldName);
              }
              $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
              $uploadDetails->setAttribute($fieldName, $uploadedFileName);
            } else {
              if ($deletedQuestionHelper->isQuestionValid("F4")) {

              }
            }
          } else {
            break;
          }
        }
      }
      if (isset($input['security_712extract_file'])) {
        $cnt = 0;
        foreach ($input['security_712extract_file'] as $key => $file) {
          $cnt++;
          if ($cnt <= $maxSecurityDocumentCount) {
            if (isset($file)) {
              $originalFileName = $file->getClientOriginalName();
              $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . '712_extract' . '-' . $originalFileName;
              $oldFileName = null;
              $fieldName = $key;
              if (!isset($uploadDetails)) {
                $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
              }
              if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
                $oldFileName = $uploadDetails->getAttribute($fieldName);
              }
              $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
              $uploadDetails->setAttribute($fieldName, $uploadedFileName);
            } else {
              if ($deletedQuestionHelper->isQuestionValid("F4")) {

              }
            }
          } else {
            break;
          }
        }
      }
      if (isset($input['security_lastsaledeed_file'])) {
        $cnt = 0;
        foreach ($input['security_lastsaledeed_file'] as $key => $file) {
          $cnt++;
          if ($cnt <= $maxSecurityDocumentCount) {
            if (isset($file)) {
              $originalFileName = $file->getClientOriginalName();
              $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'last_sale_deed' . '-' . $originalFileName;
              $oldFileName = null;
              $fieldName = $key;
              if (!isset($uploadDetails)) {
                $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
              }
              if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
                $oldFileName = $uploadDetails->getAttribute($fieldName);
              }
              $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
              $uploadDetails->setAttribute($fieldName, $uploadedFileName);
            } else {
              if ($deletedQuestionHelper->isQuestionValid("F4")) {

              }
            }
          } else {
            break;
          }
        }
      }
      if (isset($input['muncipal_plan'])) {
        $cnt = 0;
        foreach ($input['muncipal_plan'] as $key => $file) {
          $cnt++;
          if ($cnt <= $maxSecurityDocumentCount) {
            if (isset($file)) {
              $originalFileName = $file->getClientOriginalName();
              $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'muncipal_plan' . '-' . $originalFileName;
              $oldFileName = null;
              $fieldName = $key;
              if (!isset($uploadDetails)) {
                $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
              }
              if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
                $oldFileName = $uploadDetails->getAttribute($fieldName);
              }
              $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
              $uploadDetails->setAttribute($fieldName, $uploadedFileName);
            } else {
              if ($deletedQuestionHelper->isQuestionValid("F4")) {

              }
            }
          } else {
            break;
          }
        }
      }
      if (isset($input['electricity_bill'])) {
        $cnt = 0;
        foreach ($input['electricity_bill'] as $key => $file) {
          $cnt++;
          if ($cnt <= $maxSecurityDocumentCount) {
            if (isset($file)) {
              $originalFileName = $file->getClientOriginalName();
              $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'electricity_bill' . '-' . $originalFileName;
              $oldFileName = null;
              $fieldName = $key;
              if (!isset($uploadDetails)) {
                $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
              }
              if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
                $oldFileName = $uploadDetails->getAttribute($fieldName);
              }
              $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
              $uploadDetails->setAttribute($fieldName, $uploadedFileName);
            } 

          } else {
            break;
          }
        }
      }
      if (isset($uploadDetails)) {
        $uploadDetails->save();
      }
    }
    $loan = null;
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
    }
    $loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loan->id], ['loan_id' => $loanId, 'upload_documents' => 'Y']);
    $loansStatus->save();
    $this->getLoansStatus($loanId);
    $validator = Validator::make($fieldsArr, $rulesArr, $messagesArr);
    if ($validator->fails()) {
      return Redirect::back()->withErrors($validator)->withInput();
    } else {
      session()->flash('flash_message', 'Document successfully uploaded!');
    }

    $redirectUrl = 'home';
    return Redirect::to($redirectUrl);
  }

  /**
   * @param $loanType
   * @param null $loanId
   * @return mixed
   */
  public function getTermsConditions($loanType, $endUseList = null, $amount = null, $loanTenure = null, $loanId = null)
  {
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
    $confParam = new ConfigurableParameter();
    $termsConditions = $confParam->getParamValueOrDefault('loan', 'Loan T&C');
    $helper = new DeletedQuestionsHelper($loan);
    $subViewType = 'loans._terms_conditions';
    $formaction = 'Loans\LoansController@postTermsConditions';
    $validLoanHelper = new validLoanUrlhelper();
    if (isset($loanId)) {
      $validLoan = $validLoanHelper->isValidLoan($loanId);
      if (!$validLoan) {
        return view('loans.error');
      }
    }
    return view('loans.createedit', compact('subViewType', 'endUseList', 'loanType', 'amount', 'loanTenure', 'loan', 'loanId', 'formaction', 'business_object', 'helper', 'validLoanHelper', 'termsConditions'));
  }

  public function postTermsConditions(Request $request)
  {
    $input = Input::all();
    $loanId = isset($input['loanId']) ? $input['loanId'] : null;
    $loanType = isset($input['loanType']) ? $input['loanType'] : null;
    $endUseList = isset($input['end_use']) ? $input['end_use'] : null;
    $loan = null;
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
    }
    $loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loan->id], ['loan_id' => $loanId, 'upload_documents' => 'Y']);
    $loansStatus->save();
    $this->getLoansStatus($loanId);
    $redirectUrl = 'home';
    return Redirect::to($redirectUrl);
  }

  /**
   * Display a the balance sheet to the analyst
   * @param $loanId
   * @return Response
   */
  public function getAnalystGoogleSearch($loanId)
  {
    $loan = null;
    $loanUser = null;
    $loanUserProfile = null;
    $promotersKycDetails = null;
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
      $loanUser = User::find($loan->user_id);

      $promotersKycDetails = $loan->getPromoterKycDetails()->get();
      $loanUserProfile = $loanUser->userProfile();

    }
    $endUseList = null;
    $loanType = null;
    $amount = null;
    $loanTenure = null;
    if (isset($loan)) {
      $loanType = $loan->type;
      $amount = $loan->loan_amount;
      $loanTenure = $loan->loan_tenure;
      $endUseList = $loan->end_use;

    // $amount = isset($input['loan_amount']) ? $input['loan_amount'] : null;
    //$loanTenure = isset($input['loan_tenure']) ? $input['loan_tenure'] : null;
    //  $endUseList = isset($input['end_use']) ? $input['end_use'] : null;
      if ($loan->companySharePledged != '' && $loan->bscNscCode != '') {
        @$companySharePledged = $loan->companySharePledged;
        @$bscNscCode = $loan->bscNscCode;
      }
    }
    $userPr = UserProfile::where('user_id', '=', $loan->user_id)->first();
    $userProfileFirm = UserProfile::with('user')->find($userPr->id);
    $validLoanHelper = new validLoanUrlhelper();
    $isPL = false;
    $setDisable = null;
    $user = Auth::getUser();
    $setDisable = $this->getIsDisabled($user, true);
    $groupType = Config::get('constants.CONST_FIN_GROUP_TYPE_GS');
    $subViewType = 'loans.financial._analyst_google_search';
    $formaction = 'Loans\LoansController@postAnalystGoogleSearch';
    return view('loans.createedit', compact(
      'subViewType',
      'endUseList',
      'loan',
      'loanId',
      'formaction',
      'loanType',
      'loanType',
      'amount',
      'loanTenure',
      'bl_year',
      'financialGroups',
      'groupType',
      'financialDataExpressionsMap',
      'financialDataMap',
      'isPL',
      'validLoanHelper',
      'setDisable',
      'userProfileFirm',
      'loanUserProfile',
      'promotersKycDetails',
      'companySharePledged',
      'bscNscCode'
    ));
  }

  /**
   * Display a the balance sheet to the analyst
   * @param Request $request
   *
   * @return Response
   */
  public function postAnalystGoogleSearch(Request $request)
  {
  }

  /**
   * Display a the balance sheet to the analyst
   * @param $loanId
   * @return Response
   */
  public function getAnalystBalanceSheet($loanId)
  {
    $loan = null;
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
    }
    $endUseList = null;
    $loanType = null;
    $amount = null;
    $loanTenure = null;
    if (isset($loan)) {
      $loanType = $loan->type;
      $amount = $loan->loan_amount;
      $loanTenure = $loan->loan_tenure;
      $endUseList = $loan->end_use;
      if ($loan->companySharePledged != '' && $loan->bscNscCode != '') {
        @$companySharePledged = $loan->companySharePledged;
        @$bscNscCode = $loan->bscNscCode;
      }
    }
  //$bl_year = MasterData::BalanceSheet_FY();
    $bl_year = $this->setFinancialYears();
    $groupType = Config::get('constants.CONST_FIN_GROUP_TYPE_BS');
    $financialGroups = FinancialGroup::with('financialEntries')->where('type', '=', $groupType)->where('status', '=', 1)->orderBy('sortOrder')->get();
    $financialDataRecords = BalanceSheet::where('loan_id', '=', $loanId)->get();
    $financialDataMap = new Collection();
  //dd($financialGroups, $financialDataRecords);
    foreach ($financialDataRecords as $financialData) {
      $financialDataMap->offsetSet($financialData->period, $financialData);
    }
    $helper = new ExpressionHelper($loanId);
    $financialDataExpressionsMap = $helper->calculateBalanceSheetFormulae();
    $subViewType = 'loans.financial._analyst_financial_info';
    $formaction = 'Loans\LoansController@postAnalystBalanceSheet';
    $validLoanHelper = new validLoanUrlhelper();
    $isPL = false;
    $setDisable = null;
    $user = Auth::getUser();
    $setDisable = $this->getIsDisabled($user, true);
  //getting borrowers profile
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
      $loanUser = User::find($loan->user_id);
      $loanUserProfile = $loanUser->userProfile();
    }
    $userPr = UserProfile::where('user_id', '=', $loan->user_id)->first();
    $userProfileFirm = UserProfile::with('user')->find($userPr->id);
    return view('loans.createedit', compact(
      'subViewType',
      'endUseList',
      'loan',
      'loanId',
      'formaction',
      'loanType',
      'loanType',
      'amount',
      'loanTenure',
      'bl_year',
      'financialGroups',
      'groupType',
      'financialDataExpressionsMap',
      'financialDataMap',
      'isPL',
      'validLoanHelper',
      'setDisable',
      'loanUserProfile',
      'userProfileFirm',
      'companySharePledged',
      'bscNscCode'
    ));
  }

  /**
   * Display a the balance sheet to the analyst
   * @param Request $request
   *
   * @return Response
   */
  public function postAnalystBalanceSheet(Request $request)
  {
    $input = Input::all();
    $loanId = $input['loanId'];
    $tempFinancialsCollection = new Collection($input['financial']);
    $modelsCollection = $tempFinancialsCollection->map(function ($record) {
      $recordCollection = new Collection();
      foreach ($record as $key => &$value) {
        $strVal = trim(strval($value));
        if (strcmp($strVal, "") == 0 || strcmp($strVal, " ") == 0 || strcmp($strVal, "&nbsp") === 0) {
        //dd($key);
          $strVal = null;
        }
        if (isset($strVal)) {
          $recordCollection->put($key, $strVal);
        }
      }
      return new FinancialModelRecord($recordCollection->all());
    });
  // dd($input, $tempFinancialsCollection, $modelsCollection);
    $helper = new ExpressionHelper($loanId);
    //dd($helper);
    $financialDataExpressionsMap = $helper->calculateBalanceSheetFormulae($modelsCollection);
   //dd($tempFinancialsCollection);
    $financialsCollection = $helper->mergeValuesIntoCollection($tempFinancialsCollection, $financialDataExpressionsMap);
  //dd($modelsCollection, $financialDataExpressionsMap, $financialsCollection);
    $fieldsArr = [];
    $rulesArr = [];
    $messagesArr = [];
    $indexPosition = 0;
    $financialsCollection->each(function ($financialRecord) use (&$fieldsArr, &$rulesArr, &$messagesArr, &$indexPosition) {
      $period = $financialRecord['period'];
      if (isset($financialRecord['tangible_assets'])) {
        $fieldsArr['tangible_assets' . $indexPosition] = $financialRecord['tangible_assets'];
        $rulesArr['tangible_assets' . $indexPosition] = 'numeric';
        $messagesArr['tangible_assets' . $indexPosition . '.numeric'] = 'Gross Tangible Assets + WIP for period ' . $period . ' - should be a valid number.';
      }
      if (isset($financialRecord['depreciation'])) {
        $fieldsArr['depreciation' . $indexPosition] = $financialRecord['depreciation'];
        $rulesArr['depreciation' . $indexPosition] = 'numeric';
        $messagesArr['depreciation' . $indexPosition . '.numeric'] = 'Total Depreciation ' . $period . ' - should be a valid number.';
      }
      if (isset($financialRecord['long_term_advances'])) {
        $fieldsArr['long_term_advances' . $indexPosition] = $financialRecord['long_term_advances'];
        $rulesArr['long_term_advances' . $indexPosition] = 'numeric';
        $messagesArr['long_term_advances' . $indexPosition . '.numeric'] = 'Total Depreciation ' . $period . ' - should be a valid number.';
      }
      if (isset($financialRecord['net_fixed_assets'])) {
        $fieldsArr['net_fixed_assets' . $indexPosition] = $financialRecord['net_fixed_assets'];
        $rulesArr['net_fixed_assets' . $indexPosition] = 'numeric';
        $messagesArr['net_fixed_assets' . $indexPosition . '.numeric'] = 'Net Fixed Assets ' . $period . ' - should be a valid number.';
      }
     // dd($financialRecord['total_assets'])
      if (isset($financialRecord['total_assets'])) {
        $fieldsArr['total_assets' . $indexPosition] = $financialRecord['total_assets'];
        $rulesArr['total_assets' . $indexPosition] = 'numeric';
        $messagesArr['total_assets' . $indexPosition . '.numeric'] = 'Total Assets for period ' . $period . ' - Total Assets should be a valid number.';
      }
      if (isset($financialRecord['total_liabilities'])) {
        $fieldsArr['total_liabilities' . $indexPosition] = $financialRecord['total_liabilities'];
        $rulesArr['total_liabilities' . $indexPosition] = 'numeric';
        $messagesArr['total_liabilities' . $indexPosition . '.numeric'] = 'Total Liabilities for period ' . $period . ' - Total Liabilities should be a valid number.';
      }
     // echo "string";
      $rulesArr['total_liabilities' . $indexPosition] = 'same:total_assets' . $indexPosition;
      $messagesArr['total_liabilities' . $indexPosition . '.same'] = 'Total Liabilities for period ' . $period . ' - Total Liabilities should be same as total assets. Total Assets - ' . $financialRecord['total_assets'] . ' Total Liabilities - ' . $financialRecord['total_liabilities'];
      $indexPosition++;
    });

  //dd($financialsCollection, $fieldsArr, $rulesArr, $messagesArr);
    $validator = Validator::make($fieldsArr, $rulesArr, $messagesArr);
    if ($validator->fails()) {
      return Redirect::back()->withErrors($validator)->withInput();
    }

    foreach ($financialsCollection as $record) {
      $id = null;
      if (isset($record['id'])) {
        $id = $record['id'];
        BalanceSheet::updateOrCreate(['id' => $id], $record);
      }
      if(!isset($record['id'])){
       BalanceSheet::updateOrCreate($record);
     }
   }
   // dd('hi0');
     // dd($financialsCollection);
   $this->recalculateAndSaveCashflows($loanId);
   $this->recalculateAndSaveRatios($loanId);
  //session()->flash('flash_message', 'Input Balance Sheet Details were successfully saved!');


   $loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loanId], ['loan_id' => $loanId, 'input_blsheet' => 'Y']);
   $loansStatus->save();
   $this->getLoansStatus($loanId);
   $redirectUrl = "loans/analyst-profit-loss/" . $loanId;
   return Redirect::to($redirectUrl)->withInput();
 }

  /**
   * Display a the profit loss details to the analyst
   * @param $loanId
   * @return Response
   */
  public function getAnalystProfitLoss($loanId)
  {
    $loan = null;
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
    }
    $loanType = null;
    $amount = null;
    $loanTenure = null;
    $endUseList = null;
    if (isset($loan)) {
      $loanType = $loan->type;
      $amount = $loan->loan_amount;
      $loanTenure = $loan->loan_tenure;
      $endUseList = $loan->end_use;
      if ($loan->companySharePledged != '' && $loan->bscNscCode != '') {
        @$companySharePledged = $loan->companySharePledged;
        @$bscNscCode = $loan->bscNscCode;
      }
    }
  // $bl_year = MasterData::BalanceSheet_FY();
    $bl_year = $this->setFinancialYears();
    $groupType = Config::get('constants.CONST_FIN_GROUP_TYPE_PL');
    $financialGroups = FinancialGroup::with('financialEntries')->where('type', '=', $groupType)->where('status', '=', 1)->orderBy('sortOrder')->get();
    $helper = new ExpressionHelper($loanId);
    $financialDataExpressionsMap = $helper->calculateProfitLossFormulae();
  //dd($financialDataExpressionsMap);
    $financialDataRecords = ProfitLoss::where('loan_id', '=', $loanId)->get();
    $financialDataMap = new Collection();
    foreach ($financialDataRecords as $financialData) {
      $financialDataMap->offsetSet($financialData->period, $financialData);
    }
    $subViewType = 'loans.financial._analyst_financial_info';
    $formaction = 'Loans\LoansController@postAnalystProfitLoss';
    $isPL = true;
    $validLoanHelper = new validLoanUrlhelper();
    $setDisable = null;
    $user = Auth::getUser();
    $setDisable = $this->getIsDisabled($user, true);
  //getting borrowers profile
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
      $loanUser = User::find($loan->user_id);
      $loanUserProfile = $loanUser->userProfile();
    }
    $userPr = UserProfile::where('user_id', '=', $loan->user_id)->first();
    $userProfileFirm = UserProfile::with('user')->find($userPr->id);
    return view('loans.createedit', compact(
      'subViewType',
      'loan',
      'loanId',
      'loanType',
      'endUseList',
      'amount',
      'loanTenure',
      'formaction',
      'bl_year',
      'financialGroups',
      'groupType',
      'financialDataExpressionsMap',
      'financialDataMap',
      'isPL',
      'validLoanHelper',
      'setDisable',
      'loanUserProfile',
      'userProfileFirm',
      'companySharePledged',
      'bscNscCode'
    ));
  }

  /**
   * Display a the balance sheet to the analyst
   * @param Request $request
   *
   * @return Response
   */
  public function postAnalystProfitLoss(Request $request)
  {
    $input = Input::all();
    $loanId = $input['loanId'];
    $tempFinancialsCollection = new Collection($input['financial']);
    $modelsCollection = $tempFinancialsCollection->map(function ($record) {
      $recordCollection = new Collection();
      foreach ($record as $key => &$value) {
        $strVal = trim(strval($value));
        if (strcmp($strVal, "") == 0 || strcmp($strVal, " ") == 0 || strcmp($strVal, "&nbsp") === 0) {
        //dd($key);
          $strVal = null;
        }
        if (isset($strVal)) {
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
    $fieldsArr = [];
    $rulesArr = [];
    $messagesArr = [];
    $indexPosition = 0;

    $financialsCollection->each(function ($financialRecord) use (&$fieldsArr, &$rulesArr, &$messagesArr, &$indexPosition) {
      $period = $financialRecord['period'];

      $fieldsArr['net_sales' . $indexPosition] = @$financialRecord['net_sales'];
      $rulesArr['net_sales' . $indexPosition] = 'numeric';
      $messagesArr['net_sales' . $indexPosition . '.numeric'] = 'Net Sales (After Excise, Octroi, Service Tax etc) for period ' . $period . ' - should be a valid number.';
      if (isset($financialRecord['oth_op_income'])) {
        $fieldsArr['oth_op_income' . $indexPosition] = $financialRecord['oth_op_income'];
        $rulesArr['oth_op_income' . $indexPosition] = 'numeric';
        $messagesArr['oth_op_income' . $indexPosition . '.numeric'] = 'Other Operating / Related Income ' . $period . ' - should be a valid number.';
      }
      if (isset($financialRecord['net_revenue'])) {
        $fieldsArr['net_revenue' . $indexPosition] = $financialRecord['net_revenue'];
        $rulesArr['net_revenue' . $indexPosition] = 'numeric';
        $messagesArr['net_revenue' . $indexPosition . '.numeric'] = 'Net Revenue ' . $period . ' - should be a valid number.';
      }
      if (isset($financialRecord['raw_materials'])) {
        $fieldsArr['raw_materials' . $indexPosition] = $financialRecord['raw_materials'];
        $rulesArr['raw_materials' . $indexPosition] = 'numeric';
        $messagesArr['raw_materials' . $indexPosition . '.numeric'] = 'Cost of Raw Material for period ' . $period . ' - should be a valid number.';
      }
      $indexPosition++;
    });
  //dd($financialsCollection, $fieldsArr, $rulesArr, $messagesArr);
    $validator = Validator::make($fieldsArr, $rulesArr, $messagesArr);
    if ($validator->fails()) {
      return Redirect::back()->withErrors($validator)->withInput();
    }

   /* foreach ($financialsCollection as $record) {
      $id = null;
      if (isset($record['id'])) {
        $id = $record['id'];
      }
   // DB::table('financials_profit_loss')->where(['id' => $id], $record)->delete();
      ProfitLoss::updateOrCreate(['id' => $id, 'loan_id' => $loanId], $record);
    }*/

    foreach ($financialsCollection as $record) {
      $id = null;
      if (isset($record['id'])) {
        $id = $record['id'];
        ProfitLoss::updateOrCreate(['id' => $id], $record);
      }
      if(!isset($record['id'])){
       ProfitLoss::updateOrCreate($record);
     }
   }
   $this->recalculateAndSaveCashflows($loanId);
   $this->recalculateAndSaveRatios($loanId);
  //session()->flash('flash_message', 'Input P&L Details were successfully saved!');
   $loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loanId], ['loan_id' => $loanId, 'input_p&l' => 'Y']);
   $loansStatus->save();
   $this->getLoansStatus($loanId);
   $redirectUrl = "loans/analyst-cashflow/" . $loanId;
   return Redirect::to($redirectUrl)->withInput();
 }

  /**
   * Display a the cash flow details to the analyst
   * @param $loanId
   * @return Response
   */
  public function getAnalystCashflow($loanId)
  {
    $loan = null;
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
    }


    $loanType = null;
    $amount = null;
    $loanTenure = null;
    $endUseList = null;
    if (isset($loan)) {
      $loanType = $loan->type;
      $amount = $loan->loan_amount;
      $loanTenure = $loan->loan_tenure;
      $endUseList = $loan->end_use;
      if ($loan->companySharePledged != '' && $loan->bscNscCode != '') {
        @$companySharePledged = $loan->companySharePledged;
        @$bscNscCode = $loan->bscNscCode;
      }
    }
  //$bl_year = MasterData::BalanceSheet_FY();
    $bl_year = $this->setFinancialYears();
    unset($bl_year[last($bl_year)]);
    $groupType = Config::get('constants.CONST_FIN_GROUP_TYPE_CF');
    $financialGroups = FinancialGroup::with('financialEntries')->where('type', '=', $groupType)->where('status', '=', 1)->orderBy('sortOrder')->get();
    $helper = new ExpressionHelper($loanId);
    $financialDataExpressionsMap = $helper->calculateCashflows();
    $financialDataMap = new Collection();
    $showFormulaText = true;
    $subViewType = 'loans.financial._analyst_cashflow_info';
    $formaction = 'Loans\LoansController@postCalculatedRatios';
    $isPL = true;
    $validLoanHelper = new validLoanUrlhelper();
    $setDisable = null;
    $user = Auth::getUser();
    $setDisable = $this->getIsDisabled($user, true);
  //getting borrowers profile
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
      $loanUser = User::find($loan->user_id);
      $loanUserProfile = $loanUser->userProfile();
    }
    $userPr = UserProfile::where('user_id', '=', $loan->user_id)->first();
    $userProfileFirm = UserProfile::with('user')->find($userPr->id);
    return view('loans.createedit', compact(
      'subViewType',
      'loan',
      'loanId',
      'loanType',
      'endUseList',
      'amount',
      'loanTenure',
      'formaction',
      'bl_year',
      'financialGroups',
      'groupType',
      'financialDataExpressionsMap',
      'financialDataMap',
      'isPL',
      'validLoanHelper',
      'setDisable',
      'loanUserProfile',
      'userProfileFirm',
      'companySharePledged',
      'bscNscCode'
    ));
  }

  /**
   * Display the calculated cashflows to the analyst
   * @param $loanId
   * @return Response
   */
  public function postCalculatedCashflows(Request $request)
  {
  }

  /**
   * Display the calculated ratios to the analyst
   * @param $loanId
   * @return Response
   */
  public function getAnalystCalculatedRatios($loanId)
  {
    $loan = null;
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
    }
    $loanType = null;
    $amount = null;
    $loanTenure = null;
    $endUseList = null;
    if (isset($loan)) {
      $loanType = $loan->type;
      $amount = $loan->loan_amount;
      $loanTenure = $loan->loan_tenure;
      $endUseList = $loan->end_use;
      if ($loan->companySharePledged != '' && $loan->bscNscCode != '') {
        @$companySharePledged = $loan->companySharePledged;
        @$bscNscCode = $loan->bscNscCode;
      }

    }
  //$bl_year = MasterData::BalanceSheet_FY();
    $bl_year = $this->setFinancialYears();
    $groupType = Config::get('constants.CONST_FIN_GROUP_TYPE_RATIO');
    $financialGroups = FinancialGroup::with('financialEntries')->where('type', '=', $groupType)->where('status', '=', 1)->orderBy('sortOrder')->get();
    $helper = new ExpressionHelper($loanId);
    $financialDataExpressionsMap = $helper->calculateRatios();
  //dd($bl_year, $groupType, $financialGroups, $financialDataExpressionsMap);
    $financialDataMap = new Collection();
    $showFormulaText = true;
    $subViewType = 'loans.financial._analyst_ratios_info';
    $formaction = 'Loans\LoansController@postCalculatedRatios';
  //$formaction = 'loans/newlap/uploaddoc/'.$loanId;
    $validLoanHelper = new validLoanUrlhelper();
  //getting borrowers profile
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
      $loanUser = User::find($loan->user_id);
      $loanUserProfile = $loanUser->userProfile();
    }
    $userPr = UserProfile::where('user_id', '=', $loan->user_id)->first();
    $userProfileFirm = UserProfile::with('user')->find($userPr->id);
    return view('loans.createedit', compact(
      'subViewType',
      'loan',
      'loanId',
      'endUseList',
      'loanType',
      'amount',
      'loanTenure',
      'formaction',
      'bl_year',
      'financialGroups',
      'groupType',
      'financialDataExpressionsMap',
      'showFormulaText',
      'financialDataMap',
      'validLoanHelper',
      'userProfileFirm',
      'loanUserProfile',
      'companySharePledged',
      'bscNscCode'
    ));
  }

  /**
   * Display a the balance sheet to the analyst
   * @param Request $request
   *
   * @return Response
   */
  public function postCalculatedRatios(Request $request)
  {

    $input = Input::all();
    $loanId = $input['loanId'];
    $financialDataByPeriod = new Collection($input['financial']);
  // dd($input);
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
    }
    $loanType = null;
    $amount = null;
    $loanTenure = null;
    $endUseList = null;
    if (isset($loan)) {
      $loanType = $loan->type;
      $amount = $loan->loan_amount;
      $loanTenure = $loan->loan_tenure;
      $endUseList = $loan->end_use;
    }
    foreach ($financialDataByPeriod as $periodCollection) {
      foreach ($periodCollection as $record) {
        $id = null;
        if (isset($record['id'])) {
          $id = $record['id'];
        }
        Ratio::updateOrCreate(array('id' => $id), $record);
      }
    }
    session()->flash('flash_message', 'Calculated Ratios were successfully saved!');
    $loansStatus = LoansStatus::updateOrCreate(array('loan_id' => $loan->id), ['loan_id' => $loanId, 'calculated_ratios' => 'Y']);
    $loansStatus->save();
    $this->getLoansStatus($loanId);
    $redirectUrl = "loans/credit-model/" . $loanId;
    return Redirect::to($redirectUrl)->withInput();

  }

  /**
   * Recalculate and save Cashflow
   * @param $loanId
   */
  protected function recalculateAndSaveCashflows($loanId)
  {
    $existingPeriodsCashflowIdMap = Cashflow::periodsCashflowIdMap($loanId);
    $helper = new ExpressionHelper($loanId);
    $financialDataExpressionsMap = $helper->calculateCashflows();
    $calculatedCashflowsArr = $helper->getCalculatedCashflowsArr($financialDataExpressionsMap, $existingPeriodsCashflowIdMap);
    foreach ($calculatedCashflowsArr as $cashflowRecord) {
      $id = null;
      if (isset($cashflowRecord['id'])) {
        $id = $cashflowRecord['id'];
      }
      Cashflow::updateOrCreate(['id' => $id], $cashflowRecord);
    }
    $loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loanId], ['loan_id' => $loanId, 'cashflow' => 'Y']);
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
      Ratio::updateOrCreate(['id' => $id], $ratioRecord);
    }
    $loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loanId], ['loan_id' => $loanId, 'calculated_ratios' => 'Y']);
  }

  /**
   * Display the credit model input to the analyst
   * @param $loanId
   * @return Response
   */
  public function getCreditModel($loanId)
  {
    $modelType = Config::get('constants.CONST_ANALYST_MODEL_TYPE_CREDIT');
    DB::enableQueryLog();
    $loan = null;
    $loanType = null;
    $amount = null;
    $loanTenure = null;
    $endUseList = null;
    $userProfile = null;
    $ratingModel = null;
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
    }
    if (isset($loan)) {
      $loanType = $loan->type;
      $amount = $loan->loan_amount;
      $loanTenure = $loan->loan_tenure;
      $endUseList = $loan->end_use;
      $userId = $loan->user_id; 
      $userProfile = UserProfile::where('user_id', '=', $userId)->get()->first();
      $ratingModel = AnalystModelRating::with('ratingDetails')->where('model_type', '=', $modelType)->where('loan_id', '=', $loanId)->get()->first();
    }
    $query = DB::getQueryLog();
    $analystModelsCategoriesList = AnalystModelCategory::with('dimensions', 'dimensions.measures')->where('type', '=', $modelType)->where('status', '=', 1)->get();

    if (isset($ratingModel)) {
      foreach ($ratingModel->ratingDetails as $ratingDetail) {
        foreach ($analystModelsCategoriesList as $category) {
          if ($category->mergeRecord($ratingDetail)) {
            break;
          }
        }
      }
    } else {
    //New Credit Model Being Saved
      $maxFY = MasterData::maxFY();
      $ratiosList = Ratio::where('loan_id', '=', $loanId)->where('period', '=', $maxFY)->get();
      $ratiosByRatioIdList = $ratiosList->keyBy('ratio_id');
      if (isset($ratiosByRatioIdList) && $ratiosByRatioIdList->count() > 0) {
        foreach ($analystModelsCategoriesList as $category) {
          $category->autoCalculateRatioMeasures($ratiosByRatioIdList);
        }
      }
      foreach ($analystModelsCategoriesList as $category) {
        $category->autoCalculateDefaults($loan);
      }
    }
    $yesNoOptions = MasterData::yesNoTypes(false);
    $creditRatingPointsList = new Collection(array_flip(MasterData::creditRatingPoints()));
    $validLoanHelper = new validLoanUrlhelper();
    $setDisable = null;
    $user = Auth::getUser();
    $setDisable = $this->getIsDisabled($user, true);
  //getting borrowers profile
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
      $loanUser = User::find($loan->user_id);
      $loanUserProfile = $loanUser->userProfile();
    }
    $subViewType = 'loans.financial._analyst_credit_model';
    $formaction = 'Loans\LoansController@postCreditModel';
    return view('loans.createedit', compact(
      'subViewType',
      'formaction',
      'loan',
      'loanId',
      'loanType',
      'endUseList',
      'amount',
      'loanTenure',
      'analystModelsCategoriesList',
      'yesNoOptions',
      'userProfile',
      'ratingModel',
      'validLoanHelper',
      'creditRatingPointsList',
      'setDisable',
      'loanUserProfile'
    ));
  }

  /**
   * Save the credit model entered by the analyst
   * @param Request $request
   *
   * @return Response
   */
  public function postCreditModel(Request $request)
  {
    $input = Input::all();
    //echo $input['ResetCreditModel'];
     //dd($input);
    
    $rules = [
      'remark' => 'required_if:rejectProposal,RejectProposal',
    ];
    $this->validate($request, $rules);
    $loanId = $input['loanId'];
    $ratingsId = null;
  //$finalRating = $input['final_rating'];
    if(isset($input['resetProposal'])){
  //  echo "Reset code";
    //find  loan id take id from loan id
      // $user = AnalystModelRating::findOrFail('157')->delete();
       //$user = AnalystModelRating::ratingDetails()->get('157');

      $deltedRecord= $input['analyst_model_rating_details'][1]['ratings_id'];

      $comments = AnalystModelRating::find($deltedRecord);
      $comments->ratingDetails()->delete();
      $comments->delete();
      $redirectUrl = 'loans/credit-model/' . $loanId;
      return Redirect::to($redirectUrl);

       //$user = AnalystModelRating::findOrFail('157')->on('loan_id')->delete();
      
    // AnalystModelRatingDetails::updateOrCreate(['id' => $id], $record);  //Loan_id

    }else{
      if (isset($input['rejectProposal']) && $input['rejectProposal'] == 'RejectProposal') {
        $loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loanId], ['loan_id' => $loanId, 'rejected' => 'Y', 'remark' => $input['remark']]);
        $loansStatus->save();
        $this->getLoansStatus($loanId);
      } else {
        if (isset($input['ratings_id'])) {
          $ratingsId = $input['ratings_id'];
        }
        if (!isset($input['status'])) {
          $record['status'] = 1;
        }
        $ratingsModel = AnalystModelRating::updateOrCreate(['id' => $ratingsId], $input);
        $ratingsId = $ratingsModel->id;
        $modelRatingsDetailsList = new Collection($input['analyst_model_rating_details']);
    /*  echo "<pre>";
      print_r($modelRatingsDetailsList);
      echo "</pre>";*/
      foreach ($modelRatingsDetailsList as $record) {
        $id = null;   //yes
        if (isset($record['id']) && !empty($record['id'])) { 
         echo  $id = $record['id'];
       }
       if (!isset($record['ratings_id']) || empty($record['ratings_id'])) {
          $record['ratings_id'] = $ratingsId;  //yes
        }
        if (!isset($record['status']) || empty($record['status'])) {
          $record['status'] = 1;
        }
//        echo $id.'sa';

        
        AnalystModelRatingDetails::updateOrCreate(['id' => $id], $record);
      }
/*echo "<pre>";
print_r($record);
echo "</pre>";
die();*/
    //session()->flash('flash_message', 'Credit Model was successfully saved!');
$loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loanId], ['loan_id' => $loanId, 'credit_model' => 'Y', 'rejected' => 'N', 'remark' => null]);
$loansStatus->save();
$this->getLoansStatus($loanId);
}

      //  echo "string";
$validLoanHelper = new validLoanUrlhelper();
if (isset($loanId)) {
    //  echo "string";

  $isCollateralVisible = $validLoanHelper->collateralModel($loanId);

  if ($isCollateralVisible) {

    $redirectUrl = $redirectUrl = 'loans/collateral-model/' . $loanId;
  } else {
    if (isset($input['submitToBank']) && $input['submitToBank'] == 'Save') {
      session()->flash('message', 'Credit Model was successfully saved! please Create Proposal');
      $redirectUrl = 'home';
    } elseif (isset($input['simpleSave']) && $input['simpleSave'] == 'Save') {
      $redirectUrl = 'loans/credit-model/' . $loanId;
    }
  }
}
    //$redirectUrl = 'loans/collateral-model/' . $loanId;
    //$redirectUrl = 'loans/data-cash-flow-model/' . $loanId;
return Redirect::to($redirectUrl);
}

}



  /**
   * Display the collateral model input to the analyst
   * @param $loanId
   * @return Response
   */
  public function getCollateralModel($loanId)
  {
    $modelType = Config::get('constants.CONST_ANALYST_MODEL_TYPE_COLLATERAL');
    $loan = null;
    $loanType = null;
    $amount = null;
    $loanTenure = null;
    $endUseList = null;
    $userProfile = null;
    $ratingModel = null;
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
    }
    if (isset($loan)) {
      $loanType = $loan->type;
      $amount = $loan->loan_amount;
      $loanTenure = $loan->loan_tenure;
      $endUseList = $loan->end_use;
      $userId = $loan->user_id;
      $userProfile = UserProfile::where('user_id', '=', $userId)->get()->first();

      $ratingModel = AnalystModelRating::with('ratingDetails')->where('model_type', '=', $modelType)->where(['loan_id' => $loanId, 'property' => '1'])->get()->first();
    }
    $analystModelsCategoriesList = AnalystModelCategory::with('dimensions', 'dimensions.measures')->where('type', '=', $modelType)->where('status', '=', 1)->get();
    if (isset($ratingModel)) {
      foreach ($ratingModel->ratingDetails as $ratingDetail) {
        foreach ($analystModelsCategoriesList as $category) {
          if ($category->mergeRecord($ratingDetail)) {
            break;
          }
        }
      }
    } else {
      if (isset($loan)) {
        $securityDetail = $loan->getSecurityDetails()->get()->first();
        if (isset($securityDetail) && isset($securityDetail->collateral_type)) {
          if (strcmp("Land Agri", $securityDetail->collateral_type) == 0 || strcmp("Land Non-Agri", $securityDetail->collateral_type) == 0) {
            $collateralCategory = $analystModelsCategoriesList->first();
            $targetDimensionsList = $collateralCategory->dimensions->filter(function ($item) {
              return (strcmp("- Super luxury/luxury/economic/low budget", $item->label) == 0) || (strcmp("- Old building/New building", $item->label) == 0);
            });
            if (isset($targetDimensionsList)) {
              foreach ($targetDimensionsList as $targetDimension) {
                $targetDimension->is_applicable = 0;
              }
            }
          }
        }
      }
    }
    $collateralCategory = $analystModelsCategoriesList->first();
    $yesNoOptions = MasterData::yesNoTypes(false);
    $defectTypes = MasterData::collateralDefectTypes();
    $user = Auth::getUser();
    $setDisable = $this->getIsDisabled($user, true);
    $validLoanHelper = new validLoanUrlhelper();
    $subViewType = 'loans.financial._analyst_collateral_model';
    $formaction = 'Loans\LoansController@postCollateralModel';
    return view('loans.createedit', compact('subViewType', 'formaction', 'loan', 'loanId', 'loanType', 'endUseList', 'amount', 'loanTenure', 'analystModelsCategoriesList', 'yesNoOptions', 'userProfile', 'ratingModel', 'defectTypes', 'validLoanHelper', 'setDisable'));
  }

  /**
   * Save the credit model entered by the analyst
   * @param Request $request
   *
   * @return Response
   */
  public function postCollateralModel(Request $request)
  {
    $input = Input::all();
        // dd($input);
    $rules = [
      'remark' => 'required_if:rejectProposal,RejectProposal',
    ];
    $this->validate($request, $rules);
    $loanId = $input['loanId'];
  //$finalRating = $input['final_haircut'];
    $ratingsId = null;
    if (isset($input['rejectProposal']) && $input['rejectProposal'] == 'RejectProposal') {
      $loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loanId], ['loan_id' => $loanId, 'rejected' => 'Y', 'remark' => $input['remark']]);
      $loansStatus->save();
      $this->getLoansStatus($loanId);
    } else {
      if (isset($input['ratings_id'])) {
        $ratingsId = $input['ratings_id'];
        $tt = $input['property'] = '1';
      }
      if (!isset($input['status'])) {
        $record['status'] = 1;
      }
  //  $tt=1;
      $ratingsModel = AnalystModelRating::updateOrCreate(['id' => $ratingsId, 'property' => $tt], $input);
      $ratingsId = $ratingsModel->id;
      $modelRatingsDetailsList = new Collection($input['analyst_model_rating_details']);
      foreach ($modelRatingsDetailsList as $record) {
        $id = null;
        if (isset($record['id']) && !empty($record['id'])) {
          $id = $record['id'];
        }
        if (!isset($record['ratings_id']) || empty($record['ratings_id'])) {
          $record['ratings_id'] = $ratingsId;
        }
        if (!isset($record['status']) || empty($record['status'])) {
          $record['status'] = 1;
        }
        AnalystModelRatingDetails::updateOrCreate(['id' => $id], $record);
      }
      session()->flash('flash_message', 'Collateral Model was successfully saved!');
      $loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loanId], ['loan_id' => $loanId, 'collateral_model' => 'Y', 'rejected' => 'N', 'remark' => null]);
      $loansStatus->save();
      $this->getLoansStatus($loanId);
    }
  //$redirectUrl = 'home';

  //dd($modelRatingsDetailsList);
    $redirectUrl = 'loans/second-collateral-model/' . $loanId;
    return Redirect::to($redirectUrl);
  }

  /**
   * Display the collateral model  for property 2 input to the analyst
   * @param $loanId
   * @return Response
   */
  public function getSecondCollateralModel($loanId)
  {
    $modelType = Config::get('constants.CONST_ANALYST_MODEL_TYPE_COLLATERAL');
    $loan = null;
    $loanType = null;
    $amount = null;
    $loanTenure = null;
    $endUseList = null;
    $userProfile = null;
    $ratingModel = null;
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
    }
    if (isset($loan)) {
      $loanType = $loan->type;
      $amount = $loan->loan_amount;
      $loanTenure = $loan->loan_tenure;
      $endUseList = $loan->end_use;
      $userId = $loan->user_id;
      $userProfile = UserProfile::where('user_id', '=', $userId)->get()->first();
      $ratingModel = AnalystModelRating::with('ratingDetails')->where('model_type', '=', $modelType)->where(['loan_id' => $loanId, 'property' => '2'])->get()->first();
    }
    $analystModelsCategoriesList = AnalystModelCategory::with('dimensions', 'dimensions.measures')->where('type', '=', $modelType)->where('status', '=', 1)->get();
    if (isset($ratingModel)) {
      foreach ($ratingModel->ratingDetails as $ratingDetail) {
        foreach ($analystModelsCategoriesList as $category) {
          if ($category->mergeRecord($ratingDetail)) {
            break;
          }
        }
      }
    } else {
      if (isset($loan)) {
        $securityDetail = $loan->getSecurityDetails()->get()->first();
        if (isset($securityDetail) && isset($securityDetail->collateral_type)) {
          if (strcmp("Land Agri", $securityDetail->collateral_type) == 0 || strcmp("Land Non-Agri", $securityDetail->collateral_type) == 0) {
            $collateralCategory = $analystModelsCategoriesList->first();
            $targetDimensionsList = $collateralCategory->dimensions->filter(function ($item) {
              return (strcmp("- Super luxury/luxury/economic/low budget", $item->label) == 0) || (strcmp("- Old building/New building", $item->label) == 0);
            });
            if (isset($targetDimensionsList)) {
              foreach ($targetDimensionsList as $targetDimension) {
                $targetDimension->is_applicable = 0;
              }
            }
          }
        }
      }
    }
    $collateralCategory = $analystModelsCategoriesList->first();
    $yesNoOptions = MasterData::yesNoTypes(false);
    $defectTypes = MasterData::collateralDefectTypes();
    $user = Auth::getUser();
    $setDisable = $this->getIsDisabled($user, true);
    $validLoanHelper = new validLoanUrlhelper();
    $subViewType = 'loans.financial._analyst_collateral_model_secondProperty';
    $formaction = 'Loans\LoansController@postSecondCollateralModel';
    return view('loans.createedit', compact('subViewType', 'formaction', 'loan', 'loanId', 'loanType', 'endUseList', 'amount', 'loanTenure', 'analystModelsCategoriesList', 'yesNoOptions', 'userProfile', 'ratingModel', 'defectTypes', 'validLoanHelper', 'setDisable'));
  }

  /**
   * Save the credit model entered by the analyst
   * @param Request $request
   *
   * @return Response
   */
  public function postSecondCollateralModel(Request $request)
  {
    $input = Input::all();
 //     dd($input);
    $rules = [
      'remark' => 'required_if:rejectProposal,RejectProposal',
    ];
    $this->validate($request, $rules);
    $loanId = $input['loanId'];
  //$finalRating = $input['final_haircut'];
    $ratingsId = null;
    if (isset($input['rejectProposal']) && $input['rejectProposal'] == 'RejectProposal') {
      $loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loanId], ['loan_id' => $loanId, 'rejected' => 'Y', 'remark' => $input['remark']]);
      $loansStatus->save();
      $this->getLoansStatus($loanId);
    } else {
      if (isset($input['ratings_id'])) {
        $ratingsId = $input['ratings_id'];
        $tt = $input['property'] = '2';
      }
      if (!isset($input['status'])) {
        $record['status'] = 1;
      }
  //  $tt=1;
      $ratingsModel = AnalystModelRating::updateOrCreate(['id' => $ratingsId, 'property' => $tt], $input);
      $ratingsId = $ratingsModel->id;
      $modelRatingsDetailsList = new Collection($input['analyst_model_rating_details']);
    //dd($modelRatingsDetailsList);
      foreach ($modelRatingsDetailsList as $record) {
        $id = null;
        if (isset($record['id']) && !empty($record['id'])) {
          $id = $record['id'];
        }
        if (!isset($record['ratings_id']) || empty($record['ratings_id'])) {
          $record['ratings_id'] = $ratingsId;
        }
        if (!isset($record['status']) || empty($record['status'])) {
          $record['status'] = 1;
        }
        AnalystModelRatingDetails::updateOrCreate(['id' => $id], $record);
      }
      session()->flash('flash_message', 'Collateral Model was successfully saved!');
      $loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loanId], ['loan_id' => $loanId, 'collateral_model' => 'Y', 'rejected' => 'N', 'remark' => null]);
      $loansStatus->save();
      $this->getLoansStatus($loanId);
    }
  //$redirectUrl = 'home';


    $redirectUrl = 'loans/third-collateral-model/' . $loanId;
    return Redirect::to($redirectUrl);
  }

  /**
   * Display the collateral model  for property 2 input to the analyst
   * @param $loanId
   * @return Response
   */
  public function getThirdCollateralModel($loanId)
  {
    $modelType = Config::get('constants.CONST_ANALYST_MODEL_TYPE_COLLATERAL');
    $loan = null;
    $loanType = null;
    $amount = null;
    $loanTenure = null;
    $endUseList = null;
    $userProfile = null;
    $ratingModel = null;
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
    }
    if (isset($loan)) {
      $loanType = $loan->type;
      $amount = $loan->loan_amount;
      $loanTenure = $loan->loan_tenure;
      $endUseList = $loan->end_use;
      $userId = $loan->user_id;
      $userProfile = UserProfile::where('user_id', '=', $userId)->get()->first();
      $ratingModel = AnalystModelRating::with('ratingDetails')->where('model_type', '=', $modelType)->where(['loan_id' => $loanId, 'property' => '3'])->get()->first();
    }
    $analystModelsCategoriesList = AnalystModelCategory::with('dimensions', 'dimensions.measures')->where('type', '=', $modelType)->where('status', '=', 1)->get();
    if (isset($ratingModel)) {
      foreach ($ratingModel->ratingDetails as $ratingDetail) {
        foreach ($analystModelsCategoriesList as $category) {
          if ($category->mergeRecord($ratingDetail)) {
            break;
          }
        }
      }
    } else {
      if (isset($loan)) {
        $securityDetail = $loan->getSecurityDetails()->get()->first();
        if (isset($securityDetail) && isset($securityDetail->collateral_type)) {
          if (strcmp("Land Agri", $securityDetail->collateral_type) == 0 || strcmp("Land Non-Agri", $securityDetail->collateral_type) == 0) {
            $collateralCategory = $analystModelsCategoriesList->first();
            $targetDimensionsList = $collateralCategory->dimensions->filter(function ($item) {
              return (strcmp("- Super luxury/luxury/economic/low budget", $item->label) == 0) || (strcmp("- Old building/New building", $item->label) == 0);
            });
            if (isset($targetDimensionsList)) {
              foreach ($targetDimensionsList as $targetDimension) {
                $targetDimension->is_applicable = 0;
              }
            }
          }
        }
      }
    }
    $collateralCategory = $analystModelsCategoriesList->first();
    $yesNoOptions = MasterData::yesNoTypes(false);
    $defectTypes = MasterData::collateralDefectTypes();
    $user = Auth::getUser();
    $setDisable = $this->getIsDisabled($user, true);
    $validLoanHelper = new validLoanUrlhelper();
    $subViewType = 'loans.financial._analyst_collateral_model_thirdProperty';
    $formaction = 'Loans\LoansController@postThirdCollateralModel';
    return view('loans.createedit', compact('subViewType', 'formaction', 'loan', 'loanId', 'loanType', 'endUseList', 'amount', 'loanTenure', 'analystModelsCategoriesList', 'yesNoOptions', 'userProfile', 'ratingModel', 'defectTypes', 'validLoanHelper', 'setDisable'));
  }

  /**
   * Save the credit model entered by the analyst
   * @param Request $request
   *
   * @return Response
   */
  public function postThirdCollateralModel(Request $request)
  {
    $input = Input::all();
  //        dd($input);
    $rules = [
      'remark' => 'required_if:rejectProposal,RejectProposal',
    ];
    $this->validate($request, $rules);
    $loanId = $input['loanId'];
  //$finalRating = $input['final_haircut'];
    $ratingsId = null;
    if (isset($input['rejectProposal']) && $input['rejectProposal'] == 'RejectProposal') {
      $loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loanId], ['loan_id' => $loanId, 'rejected' => 'Y', 'remark' => $input['remark']]);
      $loansStatus->save();
      $this->getLoansStatus($loanId);
    } else {
      if (isset($input['ratings_id'])) {
        $ratingsId = $input['ratings_id'];
        $tt = $input['property'] = '3';
      }
      if (!isset($input['status'])) {
        $record['status'] = 1;
      }
  //  $tt=1;
      $ratingsModel = AnalystModelRating::updateOrCreate(['id' => $ratingsId, 'property' => $tt], $input);
  /* echo "<pre>";
   print_r($ratingsModel);
   echo "</pre>";*/
    //dd($ratingsModel);
   $ratingsId = $ratingsModel->id;
   $modelRatingsDetailsList = new Collection($input['analyst_model_rating_details']);
   foreach ($modelRatingsDetailsList as $record) {
    $id = null;
    if (isset($record['id']) && !empty($record['id'])) {
      $id = $record['id'];
    }
    if (!isset($record['ratings_id']) || empty($record['ratings_id'])) {
      $record['ratings_id'] = $ratingsId;
    }
    if (!isset($record['status']) || empty($record['status'])) {
      $record['status'] = 1;
    }
    AnalystModelRatingDetails::updateOrCreate(['id' => $id], $record);
  }
     //dd($record);
  session()->flash('flash_message', 'Collateral Model was successfully saved!');
  $loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loanId], ['loan_id' => $loanId, 'collateral_model' => 'Y', 'rejected' => 'N', 'remark' => null]);
  $loansStatus->save();
  $this->getLoansStatus($loanId);
}
$redirectUrl = 'home';


     // $redirectUrl = 'loans/collateral-model/' . $loanId;
return Redirect::to($redirectUrl);
}

/*
   *Liquidity Model
   */
  /**
   * Display the credit model input to the analyst
   * @param $loanId
   * @return Response
   */
  public function getLiquidityModel($loanId)
  {
    $modelType = Config::get('constants.CONST_LIQUIDITY_MODEL_TYPE_CREDIT');
    $loan = null;
    $loanType = null;
    $amount = null;
    $loanTenure = null;
    $endUseList = null;
    $userProfile = null;
    $ratingModel = null;
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
    }
    if (isset($loan)) {
      $loanType = $loan->type;
      $amount = $loan->loan_amount;
      $loanTenure = $loan->loan_tenure;
      $endUseList = $loan->end_use;
      $userId = $loan->user_id;
      $companySharePledged = $loan->companySharePledged;
      $bscNscCode = $loan->bscNscCode;
    //$userProfile = UserProfile::where('user_id','=', $userId)->get()->first();
    // $ratingModel = LiquidityModelRating::find($loanId);
    }
    $liquidityModelsCategoriesList = LiquidityModelCategory::with('dimensions', 'dimensions.measures')->where('type', '=', $modelType)->where('status', '=', 1)->get();
  //dd($liquidityModelsCategoriesList);
    if (isset($ratingModel)) {
      foreach ($ratingModel->ratingDetails as $ratingDetail) {
        foreach ($liquidityModelsCategoriesList as $category) {
          if ($category->mergeRecord($ratingDetail)) {
            break;
          }
        }
      }
    } else {
    //New Credit Model Being Saved
      $maxFY = MasterData::maxFY();
      $ratiosList = Ratio::where('loan_id', '=', $loanId)->where('period', '=', $maxFY)->get();
      $ratiosByRatioIdList = $ratiosList->keyBy('ratio_id');
      if (isset($ratiosByRatioIdList) && $ratiosByRatioIdList->count() > 0) {
        foreach ($liquidityModelsCategoriesList as $category) {
          $category->autoCalculateRatioMeasures($ratiosByRatioIdList);
        }
      }
      foreach ($liquidityModelsCategoriesList as $category) {
        $category->autoCalculateDefaults($loan);
      }
    //return nothing
    }
  //$las=LoanAgainstShare::findOrFail($loan_id);
    $liquidityLas = LoanAgainstShare::where('loan_id', '=', $loanId)->first();
    $yesNoOptions = MasterData::yesNoTypes(false);
  // $creditRatingPointsList = new Collection(array_flip(MasterData::creditRatingPoints()));
    $liquidityRatingPointsList = new Collection(array_flip(MasterData::liquidityRatingPoints()));
    $validLoanHelper = new validLoanUrlhelper();
    $setDisable = null;
    $user = Auth::getUser();
    $setDisable = $this->getIsDisabled($user, true);
  //getting borrowers profile
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
      $loanUser = User::find($loan->user_id);
      $loanUserProfile = $loanUser->userProfile();
    //$this->getLoansStatus($loanId);
    }

    $bankStatus = LoansBankAllocation::where('loan_id', '=', $loanId)->get();
    $helper = new BankAllocationHelper();
    $calculatedStatus = $helper->calculateBankAllocationStatus($loanId);

    $appRej = $bankStatus->filter(function ($item) {
      if ($item->loan_status == 20 || $item->loan_status == 21) {
        return $item->loan_status;
      }

    })->first();


  // echo $desired_object.'ssssssssssssssssssssssss';

    $userPr = UserProfile::where('user_id', '=', $loan->user_id)->first();
    $userProfileFirm = UserProfile::with('user')->find($userPr->id);
    $subViewType = 'loans.financial._analyst_liquidity_model';
    $formaction = 'Loans\LoansController@postLiquidityModel';
    return view('loans.createedit', compact(
      'subViewType',
      'formaction',
      'loan',
      'loanId',
      'loanType',
      'endUseList',
      'amount',
      'loanTenure',
      'liquidityModelsCategoriesList',
      'yesNoOptions',
      'userProfile',
      'ratingModel',
      'validLoanHelper',
      'liquidityRatingPointsList',
      'setDisable',
      'loanUserProfile',
      'liquidityLas',
      'userProfileFirm',
      'bscNscCode',
      'companySharePledged',
      'appRej',
      'calculatedStatus'
    ));
  }

  /**
   * Save the credit model entered by the analyst
   * @param Request $request
   *
   * @return Response
   */
  public function postLiquidityModel(Request $request)
  {
    $input = Input::all();
  //        dd($input);
    $rules = [
      'remark' => 'required_if:rejectProposal,RejectProposal',
    ];
    $this->validate($request, $rules);
    $loanId = $input['loanId'];
    $ratingsId = null;
  //$finalRating = $input['final_rating'];
    if (isset($input['rejectProposal']) && $input['rejectProposal'] == 'RejectProposal') {
      $loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loanId], ['loan_id' => $loanId, 'rejected' => 'Y', 'remark' => $input['remark']]);
      $loansStatus->save();
      $test = $this->getLoansStatus($loanId);
    } else {
      if (isset($input['ratings_id'])) {
        $ratingsId = $input['ratings_id'];
      }
      if (!isset($input['status'])) {
        $record['status'] = 1;
      }
      $ratingsModel = LiquidityModelRating::updateOrCreate(['id' => $ratingsId], $input);
      $ratingsId = $ratingsModel->id;
      $modelRatingsDetailsList = new Collection($input['liquidity_model_rating_details']);
      foreach ($modelRatingsDetailsList as $record) {
        $id = null;
        if (isset($record['id']) && !empty($record['id'])) {
          $id = $record['id'];
        }
        if (!isset($record['ratings_id']) || empty($record['ratings_id'])) {
          $record['ratings_id'] = $ratingsId;
        }
        if (!isset($record['status']) || empty($record['status'])) {
          $record['status'] = 1;
        }
        LiquidityModelRatingDetails::updateOrCreate(['id' => $id], $record);
      }
      session()->flash('flash_message', 'Liquidity Model was successfully saved!');
      $loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loanId], ['loan_id' => $loanId, 'liquidity_model' => 'Y', 'rejected' => 'N', 'remark' => null]);
      $test = $loansStatus->save();
      $this->getLoansStatus($loanId);
    }
    $validLoanHelper = new validLoanUrlhelper();
    if (isset($loanId)) {
      if (isset($input['submitToBank']) && $input['submitToBank'] == 'Save') {
        $redirectUrl = 'home';
      //      dd($input['submitToBank']);
      } elseif (isset($input['simpleSave']) && $input['simpleSave'] == 'Save') {
        $redirectUrl = 'loans/liquidity-model/' . $loanId;
      }
    }
    $redirectUrl = 'loans/liquidity-model/' . $loanId;
    return Redirect::to($redirectUrl)->withInput();
  }

  /**
   * Display the Approval tab to the bank user
   * @param $loanId
   * @return Response
   */
  public function getBankApproval($loanType, $endUseList = null, $amount = null, $loanTenure = null, $loanId = null)
  {
    $loan = null;
    $model = null;
    $bankApprovalStatus_1 = Config::get('constants.CONST_LOAN_STATUS_TYPE_20');
    $bankApprovalStatus_2 = Config::get('constants.CONST_LOAN_STATUS_TYPE_21');
    $validLoanHelper = new validLoanUrlhelper();
    $user = Auth::getUser();
    if (isset($loanId)) {
      $validLoan = $validLoanHelper->isValidLoan($loanId);
      if (!$validLoan) {
        return view('loans.error');
      }
      $loan = Loan::find($loanId);
      if (isset($loan) && isset($user) && $user->isBankUser() && isset($user->bank_id)) {
        $bankApprovalDetail = $loan->getBankAllocationDetails($user->bank_id);
        if (isset($bankApprovalDetail)) {
          $loan['id'] = $bankApprovalDetail->id;
          $loan['loan_status'] = $bankApprovalDetail->loan_status;
          $loan['remarks'] = $bankApprovalDetail->remarks;
        }
      }
    }
    $subViewType = 'loans.bank._bank_approval';
    $formaction = 'Loans\LoansController@postBankApproval';
    return view('loans.createedit', compact('subViewType', 'formaction', 'loan', 'loanId', 'loanType', 'endUseList', 'amount', 'loanTenure', 'validLoanHelper', 'bankApprovalStatus_1', 'bankApprovalStatus_2'));
  }

  /**
   * Save the Approval result by bank user
   * @param Request $request
   *
   * @return Response
   */
  public function postBankApproval(Request $request)
  {
    $input = Input::all();
    $id = isset($input['id']) ? $input['id'] : null;
    $loanId = isset($input['loanId']) ? $input['loanId'] : null;
    $loanType = isset($input['type']) ? $input['type'] : null;
    $amount = isset($input['loan_amount']) ? $input['loan_amount'] : null;
    $loanTenure = isset($input['loan_tenure']) ? $input['loan_tenure'] : null;
    $endUseList = isset($input['end_use']) ? $input['end_use'] : null;
    $user = Auth::getUser();
    $bankApproval = LoansBankAllocation::updateOrCreate(['id' => $id], $input);
    if ($user->isBankUser()) {
      $bankApproval['bank_id'] = $user->bank_id;
    }
    {
      Loan::find(1);
    }
    $bankApproval->save();
    if ($bankApproval) {
      $helper = new BankAllocationHelper();
      $calculatedStatus = $helper->calculateBankAllocationStatus($loanId);
      $loan = Loan::updateOrCreate(['id' => $loanId], ['status' => $calculatedStatus]);
      $loan->save();
    }
    $redirectUrl = 'home';
    return Redirect::to($redirectUrl)->withInput();
  }

  protected function generateRedirectURL($redirectUrl, $endUseList, $loanProduct, $amount, $loanTenure, $companySharePledged = null, $bscNscCode = null, $afterShare = null, $loanId = null)
  {
    if (isset($loanProduct)) {
      $redirectUrl = $redirectUrl . '/' . $loanProduct;
    }
    if (isset($endUseList)) {
      $redirectUrl = $redirectUrl . '/' . $endUseList;
    }
    if (isset($loanType)) {
      $redirectUrl = $redirectUrl . '/' . $loanType;
    }
    if (isset($amount)) {
      $redirectUrl = $redirectUrl . '/' . $amount;
    }
    if (isset($loanTenure)) {
      $redirectUrl = $redirectUrl . '/' . $loanTenure;
    }
  //$endUseList, $loanProduct , $amount, $loanTenure, $companySharePledged, $bscNscCode, $loanId
    if (isset($companySharePledged)) {
      $redirectUrl = $redirectUrl . '/' . $companySharePledged;
    }
    if (isset($bscNscCode)) {
      $redirectUrl = $redirectUrl . '/' . $bscNscCode;
    }
    if (isset($afterShare)) {
      $redirectUrl = $redirectUrl . '/' . $afterShare;
    }
    if (isset($loanId)) {
      $redirectUrl = $redirectUrl . '/' . $loanId;
    }
    return $redirectUrl;
  }

  /**
   * @param $loanType
   * @param $amount
   * @param $loan
   * @return array
   */
  protected function getDeletedQuestionLoan($loan, $loanType, $amount)
  {
    $deletedQuestionsLoan = null;
    if (isset($loan)) {
      $deletedQuestionsLoan = $loan;
      return $deletedQuestionsLoan;
    } else {
      $user = Auth::getUser();
      if ($user->isSME()) {
        $deletedQuestionsLoan = new Loan();
        $userProfile = $user->userProfile();
        if (isset($userProfile) && isset($userProfile->latest_turnover)) {
          $turnover = $userProfile->latest_turnover;
          $deletedQuestionsLoan->turnover = $turnover;
        }
        $deletedQuestionsLoan->type = $loanType;
        $deletedQuestionsLoan->loan_amount = $amount;
      }
      return $deletedQuestionsLoan;
    }
  }

  /**
   * @param $loanType
   * @param $amount
   * @param $loanTenure
   * @return Loan
   */
  protected function createAndSaveNewLoan($loanType, $amount, $loanTenure)
  {
    $user = Auth::getUser();
    $userProfile = Auth::getUser()->userProfile();
    $loan = new Loan();
    $loan->user_id = $user->id;
    $loan->type = $loanType;
    $loan->loan_amount = $amount;
    $loan->loan_tenure = $loanTenure;
    $loan->turnover = $userProfile->latest_turnover;
    $loan->save();
    return $loan;
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

//    protected function getMandatory($user = null){
//        $starSign = Config::get('constants.CONST_REMOVE_MANDATORY');
//        if(!isset($user)) {
//            $user = Auth::getUser();
//        }
//        if(isset($user) && isset($starSign)){
//            return '';
//        }
//        else{
//            return $starSign;
//        }
//        return '';
//    }
  public function getFileName($name)
  {
    $str = explode("?", $name);
    $newStr = explode("/", $str[0]);
    $resStr = $newStr[count($newStr) - 1];
    return $resStr;
  }

  /**----------------------------
   * Function to generate PDF
   *-----------------------------
   */
  public function generatePDF()
  {
    $pdf = App::make('dompdf');
    $pdf = $pdf->loadHTML('<h1>Test</h1>');
    return $pdf->stream('company_background.pdf');
  }

              //Function for Generate Loan Status
  protected function getLoansStatus($loanid)
  {
    $loan_statusID = 0;
    $loanstatusData = [];
    if (isset($loanid)) {
      $loanstatusData = LoansStatus::where('loan_id', '=', $loanid)->get();
      $is_background = "N";
      $is_promoter_details = "N";
      $is_financials = "N";
      $is_business_details = "N";
      $is_security_details = "N";
      $is_upload_documents = "N";
      $is_input_blsheet = "N";
      $is_input_pl = "N";
      $is_calculated_ratios = "N";
      $is_credit_model = "N";
      $is_liquidity_model = "N";
      $is_collateral_model = "N";
      $is_rejected = "N";
      $is_approved = "N";
      foreach ($loanstatusData as $record) {
        if (isset($record['background'])) {
          $is_background = $record['background'];
        }
        if (isset($record['promoter_details'])) {
          $is_promoter_details = $record['promoter_details'];
        }
        if (isset($record['financials'])) {
          $is_financials = $record['financials'];
        }
        if (isset($record['business_details'])) {
          $is_business_details = $record['business_details'];
        }
        if (isset($record['security_details'])) {
          $is_security_details = $record['security_details'];
        }
        if (isset($record['upload_documents'])) {
          $is_upload_documents = $record['upload_documents'];
        }
        if (isset($record['input_blsheet'])) {
          $is_input_blsheet = $record['input_blsheet'];
        }
        if (isset($record['input_p&l'])) {
          $is_input_pl = $record['input_p&l'];
        }
        if (isset($record['calculated_ratios'])) {
          $is_calculated_ratios = $record['calculated_ratios'];
        }
        if (isset($record['credit_model'])) {
          $is_credit_model = $record['credit_model'];
        }
        if (isset($record['liquidity_model'])) {
          $is_liquidity_model = $record['liquidity_model'];
        }
        if (isset($record['praposalApproved'])) {
          $is_approved = $record['praposalApproved'];
        }
        if (isset($record['collateral_model'])) {
          $is_collateral_model = $record['collateral_model'];
          if (!isset($is_collateral_model) || $is_collateral_model == "N") {
            $validLoanHelper = new validLoanUrlhelper();
            if (!$validLoanHelper->collateralModel($loanid)) {
              $is_collateral_model = 'Y';
            }
          }
        } else {
          if (!isset($record['collateral_model']) || $record['collateral_model'] == "N") {
            $validLoanHelper = new validLoanUrlhelper();
            if (!$validLoanHelper->collateralModel($loanid)) {
              $is_collateral_model = 'Y';
            }
          }
        }
                          /*if (isset($record['liquidity_model'])) {
                          $is_liquidity_model = $record['liquidity_model'];
                          if(!isset($is_liquidity_model) || $is_liquidity_model == "N"){
                          $validLoanHelper = new validLoanUrlhelper();
                          if(!$validLoanHelper->collateralModel($loanid)){
                          $is_liquidity_model = 'Y';
                        }
                      }
                    }else{
                    if(!isset($record['liquidity_model']) || $record['liquidity_model'] == "N"){
                    $validLoanHelper = new validLoanUrlhelper();
                    if(!$validLoanHelper->collateralModel($loanid)){
                    $is_liquidity_model = 'Y';
                    }
                    }
                  }*/
                  if (isset($record['rejected'])) {
                    $is_rejected = $record['rejected'];
                  }
                }
                 $loan_statusID = 1; //Application Form Pending
                  //dd($is_background ." | ". $is_promoter_details ." | ". $is_financials ." | ". $is_business_details ." | ". $is_security_details );
                 if ($is_background == "Y" && $is_promoter_details == "Y" && $is_financials == "Y" && $is_business_details == "Y" && $is_security_details == "Y") {
              $loan_statusID = 2; //Upload Document Pending
            }
            if ($is_upload_documents == "Y") {
              $loan_statusID = 3; //Application Submitted
            }

            if ($loan_statusID == 3) {
              if ($is_input_blsheet == "Y" && $is_input_pl == "Y" && $is_calculated_ratios == "Y" && $is_credit_model == "Y" && $is_collateral_model == "Y") {
              $loan_statusID = 4; //Application Forwarded to Bank
            }
          }


          /************Application Forwarded to Bank when Liquidity Model************/
          if ($loan_statusID == 3) {
            if ($is_input_blsheet == "Y" && $is_input_pl == "Y" /*&& $is_calculated_ratios == "Y" */ && $is_liquidity_model == "Y") {
              $loan_statusID = 4; //Application Forwarded to Bank
            }
          }
          /*if ($loan_statusID == 4) {
          }*/
          if ($is_rejected == "Y") {
            $loan_statusID = Config::get('constants.CONST_LOAN_STATUS_TYPE_21'); //Reject loan
          }


          if ($is_approved == "Y") {
              $loan_statusID = 24; //Application Submitted
            }

          }



          $loan = Loan::where('id', $loanid)->update(['status' => $loan_statusID]);
          if (isset($loanid) && $loan_statusID == 4) {
  //Allocate if loan was submitted to bank
            $loanRecord = Loan::find($loanid);
            if (isset($loanRecord->user_id)) {
              $user = User::find($loanRecord->user_id);
              $bankAllocationHelper = new BankAllocationHelper();
              $bankAllocationHelper->allocate($loanRecord, $user);
            } else {
              Log::error("No valid user id found for loan id - ", [$loanid]);
            }
          }
          return $loan_statusID;
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


  /**
   * Display the CashFlow model input to the analyst
   * @param $loanId
   * @return Response
   */
  public function getDataCashFlowModel($loanId)
  {
  //$modelType = Config::get('constants.CONST_ANALYST_MODEL_TYPE_CREDIT');
    $modelType = 'Cash Flow Model';

    DB::enableQueryLog();

    $loan = null;
    $loanType = null;
    $amount = null;
    $loanTenure = null;
    $endUseList = null;
    $userProfile = null;
    $ratingModel = null;
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
    }


    if (isset($loan)) {
      $loanType = $loan->type;
      $amount = $loan->loan_amount;
      $loanTenure = $loan->loan_tenure;
      $endUseList = $loan->end_use;
      $userId = $loan->user_id;
      $userProfile = UserProfile::where('user_id', '=', $userId)->get()->first();
      $cashflowInitial = CashFlowInitial::where('loan_id', '=', $loanId)->first();

      if (isset($cashflowInitial)) {
        $period_name = $cashflowInitial->period_name;
        $no_of_period = $cashflowInitial->no_of_period;
        $opening_cash_balance = $cashflowInitial->opening_cash_balance;
        $capital_Invested = $cashflowInitial->capital_Invested;
        $startingTime = $cashflowInitial->startingTime;
      }
    }
  //$loan = CashFlowInitial::find($loanId);


  //$validLoanHelper = new validLoanUrlhelper();
    $setDisable = null;
    $validLoanHelper = new validLoanUrlhelper();
    $user = Auth::getUser();
    $setDisable = $this->getIsDisabled($user, true);
  //getting borrowers profile
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
      $loanUser = User::find($loan->user_id);
      $loanUserProfile = $loanUser->userProfile();
    }
    $subViewType = 'loans.financial._cash_flow_model';
    $formaction = 'Loans\LoansController@postDataCashFlowModel';
    return view('loans.createedit', compact('subViewType','setDisable', 'formaction', 'srcOfFunds', 'loan', 'capital_Invested', 'startingTime', 'loanId', 'loanType', 'endUseList', 'validLoanHelper', 'amount', 'loanTenure', 'period_name', 'no_of_period', 'opening_cash_balance', 'setDisable', 'loanUserProfile'));
  }

  /**
   * Save the Data Cash Model model entered by the analyst
   * @param Request $request
   *
   * @return Response
   */
  public function postDataCashFlowModel(Request $request)
  {
    $input = Input::all();
    $opening_cash_balance = $input['opening_cash_balance'];
    $period_name = $input['period_name'];
    $no_of_period = $input['no_of_period'];
    $startingTime = $input['startingTime'];
    $capital_Invested = $input['capital_Invested'];
  //dd($input);
  //$this->validate($request, $rules);
    $loanId = $input['loanId'];

    $ratingsModel = CashFlowInitial::updateOrCreate(['loan_id' => $loanId], ['opening_cash_balance' => $opening_cash_balance, 'period_name' => $period_name, 'no_of_period' => $no_of_period, 'startingTime' => $startingTime, 'capital_Invested' => $capital_Invested]);
  //$promoterDetails = UsesOfFundsData::updateOrCreate(['loan_id' => $input['loanId'],'uses_id' => '1'],['uperiod_1'=>@$input['1_uperiod_1'],'uperiod_6'=>@$input['1_uperiod_6']]);
  //$ratingsId = $ratingsModel->id;
  //$modelRatingsDetailsList = new Collection($input['analyst_model_rating_details']);

 //session()->flash('flash_message', 'Credit Model was successfully saved!');
  //$loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loanId], ['loan_id' => $loanId, 'credit_model' => 'Y', 'rejected' => 'N', 'remark' => null]);
    $ratingsModel->save();
    $redirectUrl = 'loans/cash-flow-model/' . $loanId;
    return Redirect::to($redirectUrl)->withInput();
  //$this->getLoansStatus($loanId);
  }
//$validLoanHelper = new validLoanUrlhelper();

//$redirectUrl = 'loans/collateral-model/' . $loanId;
//return Redirect::to($redirectUrl)->withInput();




  /**
   * Display the CashFlow model input to the analyst
   * @param $loanId
   * @return Response
   */
  public function getCashFlowModel($loanId)
  {
  //$modelType = Config::get('constants.CONST_ANALYST_MODEL_TYPE_CREDIT');
    $modelType = 'Cash Flow Model';

    DB::enableQueryLog();

    $loan = null;
    $loanType = null;
    $amount = null;
    $loanTenure = null;
    $endUseList = null;
    $userProfile = null;
    $ratingModel = null;
    if (isset($loanId)) {
      $loan = Loan::find($loanId);

    }
    if (isset($loan)) {
      $loanType = $loan->type;
      $amount = $loan->loan_amount;
      $loanTenure = $loan->loan_tenure;
      $endUseList = $loan->end_use;
      $userId = $loan->user_id;
      $userProfile = UserProfile::where('user_id', '=', $userId)->get()->first();

      $cashflowInitial = CashFlowInitial::where('loan_id', '=', $loanId)->first();
      $srcFundschk = SrcOfFundsData::where('loan_id', '=', $loanId)->first();
  //  $usesFundschk = UsesOfFundsData::where('loan_id', '=', $loanId)->first();

      if (isset($srcFundschk)) {
        for ($i = 0; $i < 11; $i++) {
          $srcFunds[] = DB::table('src_of_funds_data')
          ->where('loan_id', '=', $loanId)
          ->where('src_id', '=', $i)
          ->get();
        }
      }
      $usesFundschk = UsesOfFundsData::where('loan_id', '=', $loanId)->first();
      $SrcTotal = SrcTotal::where('loan_id', '=', $loanId)->first();
      $usesTotal = UsesTotal::where('loan_id', '=', $loanId)->first();
      $openingSrcUse = OpeningSrcUse::where('loan_id', '=', $loanId)->first();
      $surplusSrcUses = SurplusSrcUses::where('loan_id', '=', $loanId)->first();
      $closingSrcUses = ClosingSrcUses::where('loan_id', '=', $loanId)->first();
      if (isset($usesFundschk)) {
        for ($i = 0; $i < 19; $i++) {
          $dataFunds[] = DB::table('uses_of_funds_data')
          ->where('loan_id', '=', $loanId)
          ->where('uses_id', '=', $i)
          ->get();
        }
      }

    //$loanPeriod = CashFlowInitial::find($loanId);


      $period_name = $cashflowInitial->period_name;
      $no_of_period = $cashflowInitial->no_of_period;
      $opening_cash_balance = $cashflowInitial->opening_cash_balance;
    }
  //$validLoanHelper = new validLoanUrlhelper();
    $setDisable = null;
    $validLoanHelper = new validLoanUrlhelper();
    $user = Auth::getUser();
    $setDisable = $this->getIsDisabled($user, true);
  //getting borrowers profile
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
      $loanUser = User::find($loan->user_id);
      $loanUserProfile = $loanUser->userProfile();
    }
    $srcOfFunds = SrcOfFund::all()->pluck('name');
    $useOfFund = UseOfFund::all()->pluck('name');




    $subViewType = 'loans.financial._cash_flow_model_table';
    $formaction = 'Loans\LoansController@postCashFlowModel';
    return view('loans.createedit', compact('subViewType', 'formaction', 'srcFunds', 'SrcTotal', 'openingSrcUse', 'surplusSrcUses', 'closingSrcUses', 'usesTotal', 'dataFunds', 'loan', 'cashflowInitial', 'srcOfFunds', 'useOfFund', 'loanId', 'loanType', 'endUseList', 'validLoanHelper', 'amount', 'loanTenure', 'period_name', 'no_of_period', 'opening_cash_balance', 'setDisable', 'loanUserProfile'));
  }

  /**
   * Save the Data Cash Model model entered by the analyst
   * @param Request $request
   *
   * @return Response
   */
  public function postCashFlowModel(Request $request)
  {
    $input = Input::all();

    $promoterDetails = SrcOfFundsData::updateOrCreate(['loan_id' => $input['loanId'], 'src_id' => '1'], ['speriod_1' => @$input['1_speriod_1'], 'speriod_2' => @$input['1_speriod_2'], 'speriod_3' => @$input['1_speriod_3'], 'speriod_4' => @$input['1_speriod_4'], 'speriod_5' => @$input['1_speriod_5'], 'speriod_6' => @$input['1_speriod_6']]);
    $promoterDetails = SrcOfFundsData::updateOrCreate(['loan_id' => $input['loanId'], 'src_id' => '2'], ['speriod_1' => @$input['2_speriod_1'], 'speriod_2' => @$input['2_speriod_2'], 'speriod_3' => @$input['2_speriod_3'], 'speriod_4' => @$input['2_speriod_4'], 'speriod_5' => @$input['2_speriod_5'], 'speriod_6' => @$input['2_speriod_6']]);
    $promoterDetails = SrcOfFundsData::updateOrCreate(['loan_id' => $input['loanId'], 'src_id' => '3'], ['speriod_1' => @$input['3_speriod_1'], 'speriod_2' => @$input['3_speriod_2'], 'speriod_3' => @$input['3_speriod_3'], 'speriod_4' => @$input['3_speriod_4'], 'speriod_5' => @$input['3_speriod_5'], 'speriod_6' => @$input['3_speriod_6']]);
    $promoterDetails = SrcOfFundsData::updateOrCreate(['loan_id' => $input['loanId'], 'src_id' => '4'], ['speriod_1' => @$input['4_speriod_1'], 'speriod_2' => @$input['4_speriod_2'], 'speriod_3' => @$input['4_speriod_3'], 'speriod_4' => @$input['4_speriod_4'], 'speriod_5' => @$input['4_speriod_5'], 'speriod_6' => @$input['4_speriod_6']]);
    $promoterDetails = SrcOfFundsData::updateOrCreate(['loan_id' => $input['loanId'], 'src_id' => '5'], ['speriod_1' => @$input['5_speriod_1'], 'speriod_2' => @$input['5_speriod_2'], 'speriod_3' => @$input['5_speriod_3'], 'speriod_4' => @$input['5_speriod_4'], 'speriod_5' => @$input['5_speriod_5'], 'speriod_6' => @$input['5_speriod_6']]);
    $promoterDetails = SrcOfFundsData::updateOrCreate(['loan_id' => $input['loanId'], 'src_id' => '6'], ['speriod_1' => @$input['6_speriod_1'], 'speriod_2' => @$input['6_speriod_2'], 'speriod_3' => @$input['6_speriod_3'], 'speriod_4' => @$input['6_speriod_4'], 'speriod_5' => @$input['6_speriod_5'], 'speriod_6' => @$input['6_speriod_6']]);
    $promoterDetails = SrcOfFundsData::updateOrCreate(['loan_id' => $input['loanId'], 'src_id' => '7'], ['speriod_1' => @$input['7_speriod_1'], 'speriod_2' => @$input['7_speriod_2'], 'speriod_3' => @$input['7_speriod_3'], 'speriod_4' => @$input['7_speriod_4'], 'speriod_5' => @$input['7_speriod_5'], 'speriod_6' => @$input['7_speriod_6']]);
    $promoterDetails = SrcOfFundsData::updateOrCreate(['loan_id' => $input['loanId'], 'src_id' => '8'], ['speriod_1' => @$input['8_speriod_1'], 'speriod_2' => @$input['8_speriod_2'], 'speriod_3' => @$input['8_speriod_3'], 'speriod_4' => @$input['8_speriod_4'], 'speriod_5' => @$input['8_speriod_5'], 'speriod_6' => @$input['8_speriod_6']]);
    $promoterDetails = SrcOfFundsData::updateOrCreate(['loan_id' => $input['loanId'], 'src_id' => '9'], ['speriod_1' => @$input['9_speriod_1'], 'speriod_2' => @$input['9_speriod_2'], 'speriod_3' => @$input['9_speriod_3'], 'speriod_4' => @$input['9_speriod_4'], 'speriod_5' => @$input['9_speriod_5'], 'speriod_6' => @$input['9_speriod_6']]);
    $promoterDetails = SrcOfFundsData::updateOrCreate(['loan_id' => $input['loanId'], 'src_id' => '10'], ['speriod_1' => @$input['10_speriod_1'], 'speriod_2' => @$input['10_speriod_2'], 'speriod_3' => @$input['10_speriod_3'], 'speriod_4' => @$input['10_speriod_4'], 'speriod_5' => @$input['10_speriod_5'], 'speriod_6' => @$input['10_speriod_6']]);
  //$promoterDetails = SrcOfFundsData::updateOrCreate(['loan_id' => $input['loanId'],'src_id' => '10'],['speriod_1'=>@$input['10_speriod_1'],'speriod_2'=>@$input['10_speriod_2'],'speriod_3'=>@$input['10_speriod_3'],'speriod_4'=>@$input['10_speriod_4'],'speriod_5'=>@$input['10_speriod_5'],'speriod_6'=>@$input['10_speriod_6']]);

    $promoterDetails = UsesOfFundsData::updateOrCreate(['loan_id' => $input['loanId'], 'uses_id' => '1'], ['uperiod_1' => @$input['1_uperiod_1'], 'uperiod_2' => @$input['1_uperiod_2'], 'uperiod_3' => @$input['1_uperiod_3'], 'uperiod_4' => @$input['1_uperiod_4'], 'uperiod_5' => @$input['1_uperiod_5'], 'uperiod_6' => @$input['1_uperiod_6']]);
    $promoterDetails = UsesOfFundsData::updateOrCreate(['loan_id' => $input['loanId'], 'uses_id' => '2'], ['uperiod_1' => @$input['2_uperiod_1'], 'uperiod_2' => @$input['2_uperiod_2'], 'uperiod_3' => @$input['2_uperiod_3'], 'uperiod_4' => @$input['2_uperiod_4'], 'uperiod_5' => @$input['2_uperiod_5'], 'uperiod_6' => @$input['2_uperiod_6']]);
    $promoterDetails = UsesOfFundsData::updateOrCreate(['loan_id' => $input['loanId'], 'uses_id' => '3'], ['uperiod_1' => @$input['3_uperiod_1'], 'uperiod_2' => @$input['3_uperiod_2'], 'uperiod_3' => @$input['3_uperiod_3'], 'uperiod_4' => @$input['3_uperiod_4'], 'uperiod_5' => @$input['3_uperiod_5'], 'uperiod_6' => @$input['3_uperiod_6']]);
    $promoterDetails = UsesOfFundsData::updateOrCreate(['loan_id' => $input['loanId'], 'uses_id' => '4'], ['uperiod_1' => @$input['4_uperiod_1'], 'uperiod_2' => @$input['4_uperiod_2'], 'uperiod_3' => @$input['4_uperiod_3'], 'uperiod_4' => @$input['4_uperiod_4'], 'uperiod_5' => @$input['4_uperiod_5'], 'uperiod_6' => @$input['4_uperiod_6']]);
    $promoterDetails = UsesOfFundsData::updateOrCreate(['loan_id' => $input['loanId'], 'uses_id' => '5'], ['uperiod_1' => @$input['5_uperiod_1'], 'uperiod_2' => @$input['5_uperiod_2'], 'uperiod_3' => @$input['5_uperiod_3'], 'uperiod_4' => @$input['5_uperiod_4'], 'uperiod_5' => @$input['5_uperiod_5'], 'uperiod_6' => @$input['5_uperiod_6']]);
    $promoterDetails = UsesOfFundsData::updateOrCreate(['loan_id' => $input['loanId'], 'uses_id' => '6'], ['uperiod_1' => @$input['6_uperiod_1'], 'uperiod_2' => @$input['6_uperiod_2'], 'uperiod_3' => @$input['6_uperiod_3'], 'uperiod_4' => @$input['6_uperiod_4'], 'uperiod_5' => @$input['6_uperiod_5'], 'uperiod_6' => @$input['6_uperiod_6']]);
    $promoterDetails = UsesOfFundsData::updateOrCreate(['loan_id' => $input['loanId'], 'uses_id' => '7'], ['uperiod_1' => @$input['7_uperiod_1'], 'uperiod_2' => @$input['7_uperiod_2'], 'uperiod_3' => @$input['7_uperiod_3'], 'uperiod_4' => @$input['7_uperiod_4'], 'uperiod_5' => @$input['7_uperiod_5'], 'uperiod_6' => @$input['7_uperiod_6']]);
    $promoterDetails = UsesOfFundsData::updateOrCreate(['loan_id' => $input['loanId'], 'uses_id' => '8'], ['uperiod_1' => @$input['8_uperiod_1'], 'uperiod_2' => @$input['8_uperiod_2'], 'uperiod_3' => @$input['8_uperiod_3'], 'uperiod_4' => @$input['8_uperiod_4'], 'uperiod_5' => @$input['8_uperiod_5'], 'uperiod_6' => @$input['8_uperiod_6']]);
    $promoterDetails = UsesOfFundsData::updateOrCreate(['loan_id' => $input['loanId'], 'uses_id' => '9'], ['uperiod_1' => @$input['9_uperiod_1'], 'uperiod_2' => @$input['9_uperiod_2'], 'uperiod_3' => @$input['9_uperiod_3'], 'uperiod_4' => @$input['9_uperiod_4'], 'uperiod_5' => @$input['9_uperiod_5'], 'uperiod_6' => @$input['9_uperiod_6']]);
    $promoterDetails = UsesOfFundsData::updateOrCreate(['loan_id' => $input['loanId'], 'uses_id' => '10'], ['uperiod_1' => @$input['10_uperiod_1'], 'uperiod_2' => @$input['10_uperiod_2'], 'uperiod_3' => @$input['10_uperiod_3'], 'uperiod_4' => @$input['10_uperiod_4'], 'uperiod_5' => @$input['10_uperiod_5'], 'uperiod_6' => @$input['10_uperiod_6']]);
    $promoterDetails = UsesOfFundsData::updateOrCreate(['loan_id' => $input['loanId'], 'uses_id' => '11'], ['uperiod_1' => @$input['10_uperiod_1'], 'uperiod_2' => @$input['10_uperiod_2'], 'uperiod_3' => @$input['10_uperiod_3'], 'uperiod_4' => @$input['10_uperiod_4'], 'uperiod_5' => @$input['10_uperiod_5'], 'uperiod_6' => @$input['10_uperiod_6']]);
    $promoterDetails = UsesOfFundsData::updateOrCreate(['loan_id' => $input['loanId'], 'uses_id' => '12'], ['uperiod_1' => @$input['12_uperiod_1'], 'uperiod_2' => @$input['12_uperiod_2'], 'uperiod_3' => @$input['12_uperiod_3'], 'uperiod_4' => @$input['12_uperiod_4'], 'uperiod_5' => @$input['12_uperiod_5'], 'uperiod_6' => @$input['12_uperiod_6']]);
    $promoterDetails = UsesOfFundsData::updateOrCreate(['loan_id' => $input['loanId'], 'uses_id' => '13'], ['uperiod_1' => @$input['13_uperiod_1'], 'uperiod_2' => @$input['13_uperiod_2'], 'uperiod_3' => @$input['13_uperiod_3'], 'uperiod_4' => @$input['13_uperiod_4'], 'uperiod_5' => @$input['13_uperiod_5'], 'uperiod_6' => @$input['13_uperiod_6']]);
    $promoterDetails = UsesOfFundsData::updateOrCreate(['loan_id' => $input['loanId'], 'uses_id' => '14'], ['uperiod_1' => @$input['14_uperiod_1'], 'uperiod_2' => @$input['14_uperiod_2'], 'uperiod_3' => @$input['14_uperiod_3'], 'uperiod_4' => @$input['14_uperiod_4'], 'uperiod_5' => @$input['14_uperiod_5'], 'uperiod_6' => @$input['14_uperiod_6']]);
    $promoterDetails = UsesOfFundsData::updateOrCreate(['loan_id' => $input['loanId'], 'uses_id' => '15'], ['uperiod_1' => @$input['15_uperiod_1'], 'uperiod_2' => @$input['15_uperiod_2'], 'uperiod_3' => @$input['15_uperiod_3'], 'uperiod_4' => @$input['15_uperiod_4'], 'uperiod_5' => @$input['15_uperiod_5'], 'uperiod_6' => @$input['15_uperiod_6']]);
    $promoterDetails = UsesOfFundsData::updateOrCreate(['loan_id' => $input['loanId'], 'uses_id' => '16'], ['uperiod_1' => @$input['16_uperiod_1'], 'uperiod_2' => @$input['16_uperiod_2'], 'uperiod_3' => @$input['16_uperiod_3'], 'uperiod_4' => @$input['16_uperiod_4'], 'uperiod_5' => @$input['16_uperiod_5'], 'uperiod_6' => @$input['16_uperiod_6']]);
    $promoterDetails = UsesOfFundsData::updateOrCreate(['loan_id' => $input['loanId'], 'uses_id' => '17'], ['uperiod_1' => @$input['17_uperiod_1'], 'uperiod_2' => @$input['17_uperiod_2'], 'uperiod_3' => @$input['17_uperiod_3'], 'uperiod_4' => @$input['17_uperiod_4'], 'uperiod_5' => @$input['17_uperiod_5'], 'uperiod_6' => @$input['17_uperiod_6']]);
    $promoterDetails = UsesOfFundsData::updateOrCreate(['loan_id' => $input['loanId'], 'uses_id' => '18'], ['uperiod_1' => @$input['18_uperiod_1'], 'uperiod_2' => @$input['18_uperiod_2'], 'uperiod_3' => @$input['18_uperiod_3'], 'uperiod_4' => @$input['18_uperiod_4'], 'uperiod_5' => @$input['18_uperiod_5'], 'uperiod_6' => @$input['18_uperiod_6']]);

    $promoterDetails = SrcTotal::updateOrCreate(['loan_id' => $input['loanId']], ['stPeriod_1' => @$input['stPeriod_1'], 'stPeriod_2' => @$input['stPeriod_2'], 'stPeriod_3' => @$input['stPeriod_3'], 'stPeriod_4' => @$input['stPeriod_4'], 'stPeriod_5' => @$input['stPeriod_5'], 'stPeriod_6' => @$input['stPeriod_6']]);
    $promoterDetails = UsesTotal::updateOrCreate(['loan_id' => $input['loanId']], ['utPeriod_1' => @$input['utPeriod_1'], 'utPeriod_2' => @$input['utPeriod_2'], 'utPeriod_3' => @$input['utPeriod_3'], 'utPeriod_4' => @$input['utPeriod_4'], 'utPeriod_5' => @$input['utPeriod_5'], 'utPeriod_6' => @$input['utPeriod_6']]);
    $promoterDetails = OpeningSrcUse::updateOrCreate(['loan_id' => $input['loanId']], ['oPeriod_1' => @$input['oPeriod_1'], 'oPeriod_2' => @$input['oPeriod_2'], 'oPeriod_3' => @$input['oPeriod_3'], 'oPeriod_4' => @$input['oPeriod_4'], 'oPeriod_5' => @$input['oPeriod_5'], 'oPeriod_6' => @$input['oPeriod_6']]);

    $promoterDetails = SurplusSrcUses::updateOrCreate(['loan_id' => $input['loanId']], ['surPeriod_1' => @$input['surPeriod_1'], 'surPeriod_2' => @$input['surPeriod_2'], 'surPeriod_3' => @$input['surPeriod_3'], 'surPeriod_4' => @$input['surPeriod_4'], 'surPeriod_5' => @$input['surPeriod_5'], 'surPeriod_6' => @$input['surPeriod_6']]);

    $promoterDetails = ClosingSrcUses::updateOrCreate(['loan_id' => $input['loanId']], ['cPeriod_1' => @$input['cPeriod_1'], 'cPeriod_2' => @$input['cPeriod_2'], 'cPeriod_3' => @$input['cPeriod_3'], 'cPeriod_4' => @$input['cPeriod_4'], 'cPeriod_5' => @$input['cPeriod_5'], 'cPeriod_6' => @$input['cPeriod_6']]);

/*echo "<pre>";
print_r($input['stPeriod_1']);
echo "</pre>";

dd($input);*/
  //SrcTotal  UsesTotal
  //$promoterDetails = SrcOfFundsData::updateOrCreate(['loan_id' => '1139','src_id' => '1'],['uperiod_1'=>@$input['1_uperiod_1'],'uperiod_2'=>@$input['1_uperiod_2'],'uperiod_3'=>@$input['1_uperiod_3'],'uperiod_4'=>@$input['1_uperiod_4'],'uperiod_5'=>@$input['1_uperiod_5'],'uperiod_6'=>@$input['1_uperiod_6']]);
  //dd($input);

  //$this->validate($request, $rules);
$loanId = $input['loanId'];



$validLoanHelper = new validLoanUrlhelper();

$redirectUrl = 'loans/cash-flow-criteria/' . $loanId;
return Redirect::to($redirectUrl)->withInput();
}

public function getCashFlowCriteria($loanId)
{
  //$modelType = Config::get('constants.CONST_ANALYST_MODEL_TYPE_CREDIT');
  $modelType = 'Cash Flow Model';

  DB::enableQueryLog();

  $loan = null;
  $loanType = null;
  $amount = null;
  $loanTenure = null;
  $endUseList = null;
  $userProfile = null;
  $ratingModel = null;
  if (isset($loanId)) {
    $loan = Loan::find($loanId);

  }
  if (isset($loan)) {
    $loanType = $loan->type;
    $amount = $loan->loan_amount;
    $loanTenure = $loan->loan_tenure;
    $endUseList = $loan->end_use;
    $userId = $loan->user_id;
    //$srcFunds="";
    $userProfile = UserProfile::where('user_id', '=', $userId)->get()->first();

    $cashflowInitial = CashFlowInitial::where('loan_id', '=', $loanId)->first();
    $srcFundschk = SrcOfFundsData::where('loan_id', '=', $loanId)->first();
    if (isset($srcFundschk)) {
      for ($i = 0; $i < 11; $i++) {
        $srcFunds[] = DB::table('src_of_funds_data')
        ->where('loan_id', '=', $loanId)
        ->where('src_id', '=', $i)
        ->get();
      }
    }
    $usesFundschk = UsesOfFundsData::where('loan_id', '=', $loanId)->first();
    $SrcTotal = SrcTotal::where('loan_id', '=', $loanId)->first();
    $usesTotal = UsesTotal::where('loan_id', '=', $loanId)->first();
    $openingSrcUse = OpeningSrcUse::where('loan_id', '=', $loanId)->first();
    $surplusSrcUses = SurplusSrcUses::where('loan_id', '=', $loanId)->first();
    $closingSrcUses = ClosingSrcUses::where('loan_id', '=', $loanId)->first();
    $cashCriteria = CashCriteria::where('loan_id', '=', $loanId)->first();
    //$dataFunds[]="santosh";
    if (isset($usesFundschk)) {
      for ($i = 0; $i < 19; $i++) {
        $dataFunds[] = DB::table('uses_of_funds_data')
        ->where('loan_id', '=', $loanId)
        ->where('uses_id', '=', $i)
        ->get();
      }
    }
    $period_name = $cashflowInitial->period_name;
    $no_of_period = $cashflowInitial->no_of_period;
    $opening_cash_balance = $cashflowInitial->opening_cash_balance;
  }
  //$validLoanHelper = new validLoanUrlhelper();
  $setDisable = null;
  $validLoanHelper = new validLoanUrlhelper();
  $user = Auth::getUser();
  $setDisable = $this->getIsDisabled($user, true);
  //getting borrowers profile
  if (isset($loanId)) {
    $loan = Loan::find($loanId);
    $loanUser = User::find($loan->user_id);
    $loanUserProfile = $loanUser->userProfile();
  }
  $srcOfFunds = SrcOfFund::all()->pluck('name');
  $useOfFund = UseOfFund::all()->pluck('name');




  $subViewType = 'loans.financial._cash_flow_criteria';
  $formaction = 'Loans\LoansController@postCashFlowCriteria';
  return view('loans.createedit', compact('subViewType', 'formaction', 'srcFunds', 'cashflowInitial', 'cashCriteria', 'SrcTotal', 'openingSrcUse', 'surplusSrcUses', 'closingSrcUses', 'usesTotal', 'dataFunds', 'loan', 'cashflowInitial', 'srcOfFunds', 'useOfFund', 'loanId', 'loanType', 'endUseList', 'validLoanHelper', 'amount', 'loanTenure', 'period_name', 'no_of_period', 'opening_cash_balance', 'setDisable', 'loanUserProfile'));
}

  /**
   * Save the Data Cash Model model entered by the analyst
   * @param Request $request
   *
   * @return Response
   */
  public function postCashFlowCriteria(Request $request)
  {
    $input = Input::all();


    $promoterDetails = CashCriteria::updateOrCreate([
      'loan_id' => $input['loanId'], 'selectSources1' => 'selectSources1'
    ], [
      'selectSources2' => @$input['selectSources2'],
      'selectSources3' => @$input['selectSources3'], 'selectSources4' => @$input['selectSources4'], 'calculatedScore1' => @$input['calculatedScore1'],
      'calculatedScore2' => @$input['calculatedScore2'], 'calculatedScore3' => @$input['calculatedScore3'], 'calculatedScore4' => @$input['calculatedScore4'],
      'lastCashBalance' => @$input['lastCashBalance'], 'cashVSinvest' => @$input['cashVSinvest'], 'lowstClosingBalance' => @$input['lowstClosingBalance'],
      'trendClosingBalance' => @$input['trendClosingBalance'], 'effectivScore1' => @$input['effectivScore1'], 'effectivScore2' => @$input['effectivScore2'],
      'effectivScore3' => @$input['effectivScore3'], 'effectivScore4' => @$input['effectivScore4'], 'cashFlowScore' => @$input['cashFlowScore'], 'liquidityRemark' => @$input['liquidityRemark']
    ]);

/*  $promoterDetails = SrcTotal::updateOrCreate(['loan_id' => $input['loanId']],['stPeriod_1'=>@$input['stPeriod_1'],'stPeriod_2'=>@$input['stPeriod_2'],'stPeriod_3'=>@$input['stPeriod_3'],'stPeriod_4'=>@$input['stPeriod_4'],'stPeriod_5'=>@$input['stPeriod_5'],'stPeriod_6'=>@$input['stPeriod_6']]);
  $promoterDetails = UsesTotal::updateOrCreate(['loan_id' => $input['loanId']],['utPeriod_1'=>@$input['utPeriod_1'],'utPeriod_2'=>@$input['utPeriod_2'],'utPeriod_3'=>@$input['utPeriod_3'],'utPeriod_4'=>@$input['utPeriod_4'],'utPeriod_5'=>@$input['utPeriod_5'],'utPeriod_6'=>@$input['utPeriod_6']]);
  $promoterDetails = OpeningSrcUse::updateOrCreate(['loan_id' => $input['loanId']],['oPeriod_1'=>@$input['oPeriod_1'],'oPeriod_2'=>@$input['oPeriod_2'],'oPeriod_3'=>@$input['oPeriod_3'],'oPeriod_4'=>@$input['oPeriod_4'],'oPeriod_5'=>@$input['oPeriod_5'],'oPeriod_6'=>@$input['oPeriod_6']]);

  $promoterDetails = SurplusSrcUses::updateOrCreate(['loan_id' => $input['loanId']],['surPeriod_1'=>@$input['surPeriod_1'],'surPeriod_2'=>@$input['surPeriod_2'],'surPeriod_3'=>@$input['surPeriod_3'],'surPeriod_4'=>@$input['surPeriod_4'],'surPeriod_5'=>@$input['surPeriod_5'],'surPeriod_6'=>@$input['surPeriod_6']]);

  $promoterDetails = ClosingSrcUses::updateOrCreate(['loan_id' => $input['loanId']],['cPeriod_1'=>@$input['cPeriod_1'],'cPeriod_2'=>@$input['cPeriod_2'],'cPeriod_3'=>@$input['cPeriod_3'],'cPeriod_4'=>@$input['cPeriod_4'],'cPeriod_5'=>@$input['cPeriod_5'],'cPeriod_6'=>@$input['cPeriod_6']]);
     */
  $loanId = $input['loanId'];



  //$validLoanHelper = new validLoanUrlhelper();
  //echo "string";
  $redirectUrl = 'loans/collateral-model/' . $loanId;
  return Redirect::to($redirectUrl)->withInput();
}


/*proposal Deatils*/

  /**
   * Display a listing of the resource.
   * @param $endUseList
   * @param $loanProduct
   * @param $amount
   * @param $chosenLoanTenure
   * @param $loanId
   * @param $companyCode
   * @param $exchangeCode
   * @return Response
   *///  $endUseList, $loanProduct , $amount, $loanTenure, $companySharePledged, $bscNscCode, $loanId
  public function getPraposalCompanyBackground($param1 = null, $param2 = null, $param3 = null, $param4 = null, $param5 = null, $param6 = null, $param7 = null)
  {

    $loanType = $param1;
    $endUseList = $param2;
    $loanProduct = $param2;
    $amount = $param3;
    $loanTenure = $param4;
    $companySharePledged = null;
    $bscNscCode = null;
    if (isset($param5) && isset($param6)) {
      $companySharePledged = $param5;
      $bscNscCode = $param6;
      $loanId = $param7;
    } else {
      $loanId = $param5;
    }


    $sales = MasterData::sales();
    $cities = MasterData::cities();
    $states = MasterData::states();
    $choosenSales = null;
    $userType = MasterData::userType();
    $industryTypes = MasterData::industryTypes(false);
    $businessVintage = MasterData::businessVintage();
    $choosenUserType = null;
    $loanApplicationId = null;
    $chosenproductType = null;
    $existingCompanyDeails = null;
    $existingCompanyDeailsCount = 0;
    $maxCompanyDetails = Config::get('constants.CONST_MAX_COMPANY_DETAIL');
    $newCompanyDeailsNum = $maxCompanyDetails - $existingCompanyDeailsCount;
    $salesAreaDetailId = null;
    $salesAreaDetails = null;
    $loansStatus = null;
    $loan = null;
    $isReadOnly = Config::get('constants.CONST_IS_READ_ONLY');
    $setDisable = null;
    $status = null;
    $user = null;
    $userProfile = null;
    $isRemoveMandatory = MasterData::removeMandatory();
    $entityTypes = MasterData::entityTypes();
    $chosenEntity = null;
    $isRemoveMandatory = array_except($isRemoveMandatory, ['']);
    $removeMandatoryHelper = new validLoanUrlhelper();
    $removeMandatory = $removeMandatoryHelper->getMandatory($user, $isRemoveMandatory);
    //        $removeMandatory  = $this->getMandatory($user);
    //        dd($removeMandatory,$setDisable);
    $validLoanHelper = new validLoanUrlhelper();
    $setDisable = $this->getIsDisabled($user);
    if (isset($loanId)) {
      $validLoan = $validLoanHelper->isValidLoan($loanId);
      if (!$validLoan) {
        return view('loans.error');
      }
      $status = $validLoanHelper->getTabStatus($loanId, 'background');
      if ($status == 'Y' && $setDisable != 'disabled') {
        $setDisable = 'disabled';
      }
    }
    if (isset($loanId)) {
      $loan = Loan::find($loanId);

      $user = User::find($loan->user_id);
      $userProfile = $user->userProfile();
      $model = $loan->getBusinessOperationalDetails()->get()->first();
    }

    if (isset($loan)) {
      $loanApplicationId = $loan->loan_application_id;
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

    $user = Auth::user();

    if (isset($user)) {
     echo $userID = $user->id;
     $userEmail = $user->email;
     $userProfile = $user->userProfile();
     $isSME = $user->isSME();
   }
   if (isset($userID)) {
    $mobileAppEmail = DB::table('mobile_app_data')->where('Email', $userEmail)
    ->where('status', 0)
    ->first();
    $mobileAppData = DB::table('user_profiles')->where('user_id', $userID)->first();
//    $mobileAppFirm_Name = $mobileAppData->name_of_firm;
  //  $mobileEntityType = $mobileAppData->owner_entity_type;
  }


  if (isset($loanId)) {
    $loan = Loan::find($loanId);
    $loanUser = User::find($loan->user_id);
    $loanUserProfile = $loanUser->userProfile();
    $existingPromoterKycDetails = PromoterKycDetails::where('loan_id', '=', $loanId)->get();

    $praposalBackground = PraposalBackground::where('loan_id', '=', $loanId)->first();
  }
  /*  $praposalLoan = PraposalBackground::find($loanId);
    if(isset($praposalLoan)){
      $praposalBackground = PraposalBackground::where('loan_id', '=', $loanId)->first();
    }else{
      $praposalBackground[]='';
    }*/
    $userPr = UserProfile::where('user_id', '=', $userID);

    // $userProfileFirm = UserProfile::with('user')->find($userID);
    //dd($loan->user_id);
    if (isset($loan->user_id)) {
      $userPr = UserProfile::where('user_id', '=', $loan->user_id)->first();
      $userProfileFirm = UserProfile::with('user')->find($userPr->id);
    } else {
      $userProfileFirm = UserProfile::with('user')->find($userID);
    }
    $setDisable='';

    $formaction = 'Loans\LoansController@postPraposalCompanyBackground';
    $subViewType = 'loans._praposal_company_background';
    return view('loans.praposalCreditEdit', compact(
      'formaction',
      'subViewType',
      'endUseList',
      'loanType',
      'amount',
      'praposedAmount',
      'finalAmount',
      'loanTenure',
      'existingTenor' , 
      'praposedTenor' ,  
      'totalTenor' ,    'existingInterestRate' ,  'praposedInterestRate' ,
      'totalInterestRate',
      'praposalSourceOthers',
      'loan',
      'salesAreaDetails',
      'comYourSalestype',
      'comAnnualValueExport',
      'loanId',
      'mobileAppFirm_Name',
      'loanApplicationId',
      'sales',
      'entityTypes',
      'choosenSales',
      'userType',
      'choosenUserType',
      'maxCompanyDetails',
      'existingPromoterKycDetails',
      'mobileEntityType',
      'existingCompanyDeails',
      'existingCompanyDeailsCount',
      'newCompanyDeailsNum',
      'industryTypes',
      'praposalBackground',
      'setDisable',
      'mobileAppData',
      'com_industry_segment',
      'deletedQuestionHelper',
      'cities',
      'states',
      'existingLoan',
      'validLoanHelper',
      'removeMandatory',
      'businessVintage',
      'userProfile',
      'businessType',
      'mobileAppDataID',
      'userProfileFirm',
      'mobileKeyProduct',
      'mobileFirmRegNo',
      'loanUserProfile',
      'isSME',
      'model'
    ));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @param Request $request
   *
   * @return Response
   */
  public function postPraposalCompanyBackground(Request $request)
  {
    $input = Input::all();
    $loanId = isset($input['loanId']) ? $input['loanId'] : null;
    $loanType = isset($input['type']) ? $input['type'] : null;
    $amount = isset($input['loan_amount']) ? $input['loan_amount'] : null;
    $loanTenure = isset($input['loan_tenure']) ? $input['loan_tenure'] : null;
    $endUseList = isset($input['end_use']) ? $input['end_use'] : null;
  //if loan is selected
    $companySharePledged = isset($input['companySharePledged']) ? $input['companySharePledged'] : null;
    $bscNscCode = isset($input['bscNscCode']) ? $input['bscNscCode'] : null;
    $loan = null;
    $fieldsArr = [];
    $rulesArr = [];
    $messagesArr = [];
    $user = Auth::getUser();
    $userProfile = Auth::getUser()->userProfile();

    $validator = Validator::make($fieldsArr, $rulesArr, $messagesArr);
    if ($validator->fails()) {
      return Redirect::back()->withErrors($validator)->withInput();
    } else {
  //$user = Auth::getUser();
  //$userProfile =  Auth::getUser()->userProfile();
      $input['user_id'] = $user->id;
      if (isset($loanId)) {
        if (isset($loans)) {
          $salesAreaDetailId = $loans->id;
        } else {
          $salesAreaDetailId = null;
        }
      }


      $user = Auth::user();
      if (isset($user)) {
        $userID = $user->id;
        $userEmail = $user->email;
      }
      if (isset($userID)) {
        $mobileAppEmail = DB::table('mobile_app_data')->where('Email', $userEmail)
        ->where('status', 0)
        ->first();
      }
    }
    $loan = PraposalBackground::updateOrCreate(['loan_id' => $input['loanId']], [
      'borrower_name'=> $input['borrower_name'],
      'promoter_name'=> $input['promoter_name'],
      'praposal_source'=> $input['praposal_source'],
      'legal_entity_type'=> @$input['legal_entity_type'],
      'com_industry_segment'=> $input['com_industry_segment'],
      'com_business_type'=> $input['com_business_type'],
      'business_address'=> $input['business_address'],
      'niwas_branch_officer'=> $input['niwas_branch_officer'],
      'amount'=> $input['amount'],
      'praposedAmount'=> $input['praposedAmount'],
      'finalAmount'=> $input['finalAmount'],
      'security'=> $input['security'],
      'existingTenor'=> $input['existingTenor'],
      'praposedTenor'=> $input['praposedTenor'],
      'existingLoan'=> $input['existingLoan'],
      'totalTenor'=> $input['totalTenor'],  
      'existingInterestRate'=> $input['existingInterestRate'],
      'praposedInterestRate'=> $input['praposedInterestRate'],
      'totalInterestRate'=> $input['totalInterestRate'],
      'praposalSourceOthers'=> $input['praposalSourceOthers'],
      'security'=> $input['security'],

      'dealy'=> @$input['dealy'],
      'disbursement_date'=> $input['disbursement_date'],
      'loan_purpose'=> $input['loan_purpose']

    ]);

    $redirectUrl = $this->generateRedirectURL('loans/praposal/details', $endUseList, $loanType, $amount, $loanTenure, $companySharePledged, $bscNscCode, $loanId);
    return Redirect::to($redirectUrl);
  }




  /**
   * Display a listing of the resource.
   * @param $endUseList
   * @param $loanProduct
   * @param $amount
   * @param $chosenLoanTenure
   * @param $loanId
   * @param $companyCode
   * @param $exchangeCode
   * @return Response
   *///  $endUseList, $loanProduct , $amount, $loanTenure, $companySharePledged, $bscNscCode, $loanId
  public function getPraposalDeatils($param1 = null, $param2 = null, $param3 = null, $param4 = null, $param5 = null, $param6 = null, $param7 = null)
  {
    $loanType = $param1;
    $endUseList = $param2;
    $loanProduct = $param2;
    $amount = $param3;
    $loanTenure = $param4;
    $companySharePledged = null;
    $bscNscCode = null;
    if (isset($param5) && isset($param6)) {
      $companySharePledged = $param5;
      $bscNscCode = $param6;
      $loanId = $param7;
    } else {
      $loanId = $param5;
    }
    $sales = MasterData::sales();
    $cities = MasterData::cities();
    $states = MasterData::states();
    $choosenSales = null;
    $userType = MasterData::userType();
    $industryTypes = MasterData::industryTypes(false);
    $businessVintage = MasterData::businessVintage();
    $degreeType = MasterData::degreeTypes();
    $choosenUserType = null;
    $loanApplicationId = null;
    $chosenproductType = null;
    $existingCompanyDeails = null;
    $existingCompanyDeailsCount = 0;
    $maxCompanyDetails = Config::get('constants.CONST_MAX_COMPANY_DETAIL');
    $newCompanyDeailsNum = $maxCompanyDetails - $existingCompanyDeailsCount;
    $salesAreaDetailId = null;
    $salesAreaDetails = null;
    $loansStatus = null;
    $loan = null;
    $isReadOnly = Config::get('constants.CONST_IS_READ_ONLY');
    $setDisable = null;
    $status = null;
    $user = null;
    $userProfile = null;
    $isRemoveMandatory = MasterData::removeMandatory();
    $promoterBackground = MasterData::degreeTypes();
    $isRemoveMandatory = array_except($isRemoveMandatory, ['']);
    $removeMandatoryHelper = new validLoanUrlhelper();
    $removeMandatory = $removeMandatoryHelper->getMandatory($user, $isRemoveMandatory);
    //        $removeMandatory  = $this->getMandatory($user);
    //        dd($removeMandatory,$setDisable);
    $validLoanHelper = new validLoanUrlhelper();
    $setDisable = $this->getIsDisabled($user);
    if (isset($loanId)) {
      $validLoan = $validLoanHelper->isValidLoan($loanId);
      if (!$validLoan) {
        return view('loans.error');
      }
      $status = $validLoanHelper->getTabStatus($loanId, 'background');
      if ($status == 'Y' && $setDisable != 'disabled') {
        $setDisable = 'disabled';
      }
    }
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
      if (isset($loan)) {
        $salesAreaDetailId = $loan->id;
      }
      if (isset($salesAreaDetailId)) {
        $salesAreaDetails = SalesAreaDetails::where('loan_id', '=', $salesAreaDetailId)->first();
      }
      $user = User::find($loan->user_id);
      $userProfile = $user->userProfile();
      $model = $loan->getBusinessOperationalDetails()->get()->first();
    }

    
    $user = Auth::user();

    if (isset($user)) {
      $userID = $user->id;
      $userEmail = $user->email;
      $userProfile = $user->userProfile();
      $isSME = $user->isSME();
    }
    if (isset($userID)) {
      $mobileAppEmail = DB::table('mobile_app_data')->where('Email', $userEmail)
      ->where('status', 0)
      ->first();
    }
    if (isset($mobileAppEmail)) {
      $businessType = $mobileAppEmail->BusinessType;
      $mobileAppDataID = $mobileAppEmail->id;
      $mobileKeyProduct = $mobileAppEmail->KeyProduct;
      $mobileFirmRegNo = $mobileAppEmail->FirmRegNo;
    }
    $deletedQuestionsLoan = $this->getDeletedQuestionLoan($loan, $loanType, $amount);
    $deletedQuestionHelper = new DeletedQuestionsHelper($deletedQuestionsLoan);
    //getting borrowers profile
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
      $loanUser = User::find($loan->user_id);
      $loanUserProfile = $loanUser->userProfile();


      $existingPromoterKycDetails = PromoterKycDetails::where('loan_id', '=', $loanId)->get();

    }
    $userPr = UserProfile::where('user_id', '=', $userID);

    //echo $lastAuditedTurnover=$userPr->latest_turnover;
    // $userProfileFirm = UserProfile::with('user')->find($userID);
    //dd($loan->user_id);
    if (isset($loan->user_id)) {
      $userPr = UserProfile::where('user_id', '=', $loan->user_id)->first();



      $userProfileFirm = UserProfile::with('user')->find($userPr->id);
    } else {
      $userProfileFirm = UserProfile::with('user')->find($userID);
    }
    @$praposalDetails=PraposalDetails::where('loan_id', '=', $loanId)->first();

    //dd($praposalDetails);
      //$praposalDetails->promoterBackground;

    $lastAuditedTurnover=$userProfileFirm->latest_turnover;
    $setDisable='';

    $formaction = 'Loans\LoansController@postPraposal';
    $subViewType = 'loans._praposal';
    return view('loans.praposalCreditEdit', compact(
      'formaction',
      'subViewType',
      'endUseList',
      'loanType',
      'amount',
      'loanTenure',
      'companySharePledged',
      'bscNscCode',
      'loan',
      'salesAreaDetails',
      'praposalDetails',
      'comYourSalestype',
      'othr_eduprofdegree',
      'degreeType',
      'comAnnualValueExport',
      'loanId',
      'loanApplicationId',
      'sales',
      'choosenSales',
      'userType',
      'pramoterDetails',
      'choosenUserType',   
      'setDisable',
      'deletedQuestionHelper',
      'validLoanHelper',
      'existingPromoterKycDetails',
      'removeMandatory',
      'businessVintage',
      'promoterBackground',
      'lastAuditedTurnover',
      'userProfile',
      'businessType',
      'mobileAppDataID',
      'userProfileFirm',
      'mobileKeyProduct',
      'mobileFirmRegNo',
      'loanUserProfile',
      'isSME',
      'model'
    ));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @param Request $request
   *
   * @return Response
   */
  public function postPraposal(Request $request)
  {
    $input = Input::all();
    //dd($input);
    $loanId = isset($input['loanId']) ? $input['loanId'] : null;
    $loanType = isset($input['type']) ? $input['type'] : null;
    $amount = isset($input['loan_amount']) ? $input['loan_amount'] : null;
    $loanTenure = isset($input['loan_tenure']) ? $input['loan_tenure'] : null;
    $endUseList = isset($input['end_use']) ? $input['end_use'] : null;
  //if loan is selected
    $companySharePledged = isset($input['companySharePledged']) ? $input['companySharePledged'] : null;
    $bscNscCode = isset($input['bscNscCode']) ? $input['bscNscCode'] : null;
    $id = $input['id'];
    $loan = null;
    $fieldsArr = [];
    $rulesArr = [];
    $messagesArr = [];
    $user = Auth::getUser();
    $userProfile = Auth::getUser()->userProfile();

    $validator = Validator::make($fieldsArr, $rulesArr, $messagesArr);
    if ($validator->fails()) {
      return Redirect::back()->withErrors($validator)->withInput();
    } else {
  //$user = Auth::getUser();
  //$userProfile =  Auth::getUser()->userProfile();
      $input['user_id'] = $user->id;
      if (isset($loanId)) {
        if (isset($loans)) {
          $salesAreaDetailId = $loans->id;
        } else {
          $salesAreaDetailId = null;
        }
      }




      $loan = PraposalDetails::updateOrCreate(['loan_id' => $input['loanId']], [
       /* 'promoterBackground' => @$input['promoterBackground'],*/
       'lastAuditedTurnover' => $input['lastAuditedTurnover'],
       'othr_eduprofdegree' => @$input['othr_eduprofdegree'],
       'com_business_type'=> @$input['com_business_type'],
       'briefProducts'=> $input['briefProducts'], 
       'briefCustomers'=> $input['briefCustomers'],
       'historyEquityInfusion'=> $input['historyEquityInfusion'], 
       'commentaryProfitability'=> $input['commentaryProfitability'],
       'commentaryLiquidityWC'=> $input['commentaryLiquidityWC'], 
       'commentaryBalanceSheet'=> $input['commentaryBalanceSheet'],
       'totalBorrowing6Month'=> $input['totalBorrowing6Month'], 
       'amountHighCostGT16Loans'=> $input['amountHighCostGT16Loans'], 
       'detailsLoanPurpose'=> $input['detailsLoanPurpose'], 
        //'loan_purpose'=> $input['loan_purpose']
     ]);
      $user = Auth::user();
      
      
    }
//9167686390   10000  Juice ok
    $redirectUrl = $this->generateRedirectURL('loans/praposal/finsummary', $endUseList, $loanType, $amount, $loanTenure, $companySharePledged, $bscNscCode, $loanId);

    //$redirectUrl = 'loans/praposal/finsummary/' . $loanId;
    return Redirect::to($redirectUrl);


  }


//public function getPraposalCompanyBackground($param1 = null, $param2 = null, $param3 = null, $param4 = null, $param5 = null, $param6 = null, $param7 = null)
   /**
   * Display a listing of the resource.
   * @param $endUseList
   * @param $loanProduct
   * @param $amount
   * @param $chosenLoanTenure
   * @param $loanId
   * @param $companyCode
   * @param $exchangeCode
   * @return Response
   *///  $endUseList, $loanProduct , $amount, $loanTenure, $companySharePledged, $bscNscCode, $loanId
    //

   public function getPraposalFinsummary( $param1 = null, $param2 = null, $param3 = null, $param4 = null, $param5 = null, $param6 = null, $param7 = null)
   {
    $endUseList = $param2;
    $loanProduct = $param2;
    $amount = $param3;
    $loanTenure = $param4;
    $companySharePledged = null;
    $bscNscCode = null;
    if (isset($param5) && isset($param6)) {
      $companySharePledged = $param5;
      $bscNscCode = $param6;
      $loanId = $param7;
    } else {
      $loanId = $param5;
    }


    $loan = null;
    $loanType = null;
  //$bl_year = MasterData::BalanceSheet_FY();
    $bl_year = $this->setFinancialYears();
    $groupType = Config::get('constants.CONST_FIN_GROUP_TYPE_RATIO');
    $financialGroups = FinancialGroup::with('financialEntries')->where('type', '=', $groupType)->where('status', '=', 1)->orderBy('sortOrder')->get();
    $helper = new ExpressionHelper($loanId);
    $financialDataRecords = BalanceSheet::where('loan_id', '=', $loanId)->get();


    $financialDataExpressionsMap = $helper->calculateRatios();
  //dd($bl_year, $groupType, $financialGroups, $financialDataExpressionsMap);
    $financialDataMap = new Collection();
    $showFormulaText = true;
    $financialProfitLoss = ProfitLoss::where('loan_id', '=', $loanId)->get();
    $test = Cashflow::where('loan_id', '=', $loanId)->get();
    $fromCashflowTable = Cashflow::periodsCashflowIdMap($loanId);
    //echo $existingPeriodsCashsasflowIdMap[76]->value;
       /* echo "<pre>";
        print_r($fromCashflowTable['FY 2017-18(Prov)'][79]->value);
        echo "</pre>";*/

        
        $ratios = Ratio::where('loan_id', '=', $loanId)->get();
     /*  echo "<pre>";
       print_r($ratios);
       echo "</pre>";
     */   
       $subViewType = 'loans._finsummary';
       $formaction = 'Loans\LoansController@postPraposalFinsummary';
  //$formaction = 'loans/newlap/uploaddoc/'.$loanId;
       $validLoanHelper = new validLoanUrlhelper();
  //getting borrowers profile
       if (isset($loanId)) {
        $loan = Loan::find($loanId);

        $loanUser = User::find($loan->user_id);
        $loanUserProfile = $loanUser->userProfile();
      }
      $userPr = UserProfile::where('user_id', '=', $loan->user_id)->first();
      $userProfileFirm = UserProfile::with('user')->find($userPr->id);
      return view('loans.praposalCreditEdit', compact(
        'subViewType',
        'loan',
        'loanId',
        'endUseList',
        'loanType',
        'amount',
        'loanTenure',
        'formaction',
        'bl_year',
        'financialGroups',
        'groupType',
        'financialDataExpressionsMap',
        'showFormulaText',
        'financialDataMap',
        'fromCashflowTable',
        'validLoanHelper',
        'userProfileFirm',
        'loanUserProfile',
        'companySharePledged',
        'bscNscCode',
        'financialProfitLoss',
        'ratios',
        'financialDataRecords'
      ));
    }

  /**
   * Show the form for creating a new resource.
   *
   * @param Request $request
   *
   * @return Response
   */ // 
  public function postPraposalFinsummary(Request $request)
  {

    $input = Input::all();
    $loanId = isset($input['loanId']) ? $input['loanId'] : null;
    $loanType = isset($input['type']) ? $input['type'] : null;
    $amount = isset($input['loan_amount']) ? $input['loan_amount'] : null;
    $loanTenure = isset($input['loan_tenure']) ? $input['loan_tenure'] : null;
    $endUseList = isset($input['end_use']) ? $input['end_use'] : null;
  //if loan is selected
    $companySharePledged = isset($input['companySharePledged']) ? $input['companySharePledged'] : null;
    $bscNscCode = isset($input['bscNscCode']) ? $input['bscNscCode'] : null;
    //$id = $input['id'];
    $loan = null;
    $fieldsArr = [];
    $rulesArr = [];
    $messagesArr = [];
    $user = Auth::getUser();
    $userProfile = Auth::getUser()->userProfile();

    $validator = Validator::make($fieldsArr, $rulesArr, $messagesArr);
    if ($validator->fails()) {
      return Redirect::back()->withErrors($validator)->withInput();
    } else {
  //$user = Auth::getUser();
  //$userProfile =  Auth::getUser()->userProfile();
      $input['user_id'] = $user->id;
      if (isset($loanId)) {
        if (isset($loans)) {
          $salesAreaDetailId = $loans->id;
        } else {
          $salesAreaDetailId = null;
        }
      }

      $user = Auth::user();
      if (isset($user)) {
        $userID = $user->id;
        $userEmail = $user->email;
      }
      if (isset($userID)) {
        $mobileAppEmail = DB::table('mobile_app_data')->where('Email', $userEmail)
        ->where('status', 0)
        ->first();
      }
    }


     // $redirectUrl = $this->generateRedirectURL('loans/praposal/checklist', $endUseList, $loanType, $amount, $loanTenure, $companySharePledged, $bscNscCode, $loanId);
    $redirectUrl = $this->generateRedirectURL('loans/praposal/checklist', $endUseList, $loanType, $amount, $loanTenure, $companySharePledged, $bscNscCode, $loanId);

    return Redirect::to($redirectUrl);
  }


//public function getPraposalCompanyBackground($param1 = null, $param2 = null, $param3 = null, $param4 = null, $param5 = null, $param6 = null, $param7 = null)
   /**
   * Display a listing of the resource.
   * @param $endUseList
   * @param $loanProduct
   * @param $amount
   * @param $chosenLoanTenure
   * @param $loanId
   * @param $companyCode
   * @param $exchangeCode
   * @return Response
   *///  $endUseList, $loanProduct , $amount, $loanTenure, $companySharePledged, $bscNscCode, $loanId
    //

   public function getPraposalChecklist( $param1 = null, $param2 = null, $param3 = null, $param4 = null, $param5 = null, $param6 = null, $param7 = null)
   {

    $endUseList = $param2;
    $loanProduct = $param2;
    $amount = $param3;
    $loanTenure = $param4;
    $companySharePledged = null;
    $bscNscCode = null;
    if (isset($param5) && isset($param6)) {
      $companySharePledged = $param5;
      $bscNscCode = $param6;
      $loanId = $param7;
    } else {
      $loanId = $param5;
    }

    $loan = null;
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
    }
    $loanType = null;
    
    $user = null;
    $userProfile = null;
    if (isset($loan)) {
      $loanType = $loan->type;
      $amount = $loan->loan_amount;
      $loanTenure = $loan->loan_tenure;
      $endUseList = $loan->end_use;


    }


    $states = MasterData::states();
    $choosenSales = null;
    $userType = MasterData::userType();
    $industryTypes = MasterData::industryTypes(false);
    $businessVintage = MasterData::businessVintage();
    $choosenUserType = null;
    $loanApplicationId = null;
    $chosenproductType = null;
    $existingCompanyDeails = null;
    $existingCompanyDeailsCount = 0;
    $maxCompanyDetails = Config::get('constants.CONST_MAX_COMPANY_DETAIL');
    $newCompanyDeailsNum = $maxCompanyDetails - $existingCompanyDeailsCount;

    $loansStatus = null;
    $loan = null;
    $isReadOnly = Config::get('constants.CONST_IS_READ_ONLY');
    $setDisable = null;
    $status = null;
    $user = null;
    $userProfile = null;
    $isRemoveMandatory = MasterData::removeMandatory();
    $entityTypes = MasterData::entityTypes();
    $chosenEntity = null;
    $isRemoveMandatory = array_except($isRemoveMandatory, ['']);
    $removeMandatoryHelper = new validLoanUrlhelper();
    $removeMandatory = $removeMandatoryHelper->getMandatory($user, $isRemoveMandatory);
    //        $removeMandatory  = $this->getMandatory($user);
    //        dd($removeMandatory,$setDisable);
    $validLoanHelper = new validLoanUrlhelper();
    $setDisable = $this->getIsDisabled($user);

  //$bl_year = MasterData::BalanceSheet_FY();
    $bl_year = $this->setFinancialYears();
    $groupType = Config::get('constants.CONST_FIN_GROUP_TYPE_RATIO');
    $financialGroups = FinancialGroup::with('financialEntries')->where('type', '=', $groupType)->where('status', '=', 1)->orderBy('sortOrder')->get();
    $helper = new ExpressionHelper($loanId);
    $financialDataExpressionsMap = $helper->calculateRatios();
  //dd($bl_year, $groupType, $financialGroups, $financialDataExpressionsMap);
    $financialDataMap = new Collection();
    $showFormulaText = true;
    $financialProfitLoss = ProfitLoss::where('loan_id', '=', $loanId)->get();
    $ratios = Ratio::where('loan_id', '=', $loanId)->get();
     /*  echo "<pre>";
       print_r($ratios);
       echo "</pre>";
     */   
       $subViewType = 'loans._checklist';
       $formaction = 'Loans\LoansController@postPraposalChecklist';
  //$formaction = 'loans/newlap/uploaddoc/'.$loanId;
       $validLoanHelper = new validLoanUrlhelper();
  //getting borrowers profile
       //PraposalChecklist
       $loan = Loan::find($loanId);
       $loanUser = User::find($loan->user_id);
       $loanUserProfile = $loanUser->userProfile();


       $isReadOnly = Config::get('constants.CONST_IS_READ_ONLY');

       $setDisable = '';
       $isRemoveMandatory = MasterData::removeMandatory();
       $isRemoveMandatory = array_except($isRemoveMandatory, ['']);
       $removeMandatoryHelper = new validLoanUrlhelper();
       $removeMandatory = $removeMandatoryHelper->getMandatory($user, $isRemoveMandatory);
       if (isset($loanId)) {
        $validLoan = $validLoanHelper->isValidLoan($loanId);
        if (!$validLoan) {
          return view('loans.error');
        }
        $status = $validLoanHelper->getTabStatus($loanId, 'background');
        if ($status == 'Y' && $setDisable != 'disabled') {
          $setDisable = 'disabled';
        }
      }
  //$formaction = 'loans/newlap/uploaddoc/'.$loanId;
      $validLoanHelper = new validLoanUrlhelper();
  //getting borrowers profile
      if (isset($loanId)) {
        $loan = Loan::find($loanId);
        $loanUser = User::find($loan->user_id);
        $loanUserProfile = $loanUser->userProfile();
        @$praposalChecklist=PraposalChecklists::where('loan_id', '=', $loanId)->first();
        @$promoterDetails=PromoterDetails::where('loan_id', '=', $loanId)->first();
      }
      $userPr = UserProfile::where('user_id', '=', $loan->user_id)->first();
      $userProfileFirm = UserProfile::with('user')->find($userPr->id);

      return view('loans.praposalCreditEdit', compact(
        'subViewType',
        'loan',
        'praposalChecklist',
        'loanId',
        'endUseList',
        'loanType',
        'amount',
        'loanTenure',
        'promoterDetails',
        'formaction',
        'removeMandatory ',
        'bl_year',
        'businessVintage',
        'setDisable',
        'ratioBreachesDescrip',
        'financialGroups',
        'groupType',
        'com_business_type',
        'financialDataExpressionsMap',
        'showFormulaText',
        'financialDataMap',
        'validLoanHelper',
        'userProfileFirm',
        'refreanceCheckDescription',
        'loanUserProfile',
        'companySharePledged',
        'bscNscCode',
        'financialProfitLoss',
        'ratios',
        'typeofEntity'
      ));
    }

  /**
   * Show the form for creating a new resource.
   *
   * @param Request $request
   *
   * @return Response
   */ // 
  public function postPraposalChecklist(Request $request)
  {
   $input = Input::all();
   $loanId = isset($input['loanId']) ? $input['loanId'] : null;
   $loanType = isset($input['type']) ? $input['type'] : null;
   $amount = isset($input['loan_amount']) ? $input['loan_amount'] : null;
   $loanTenure = isset($input['loan_tenure']) ? $input['loan_tenure'] : null;
   $endUseList = isset($input['end_use']) ? $input['end_use'] : null;
  //if loan is selected
   $companySharePledged = isset($input['companySharePledged']) ? $input['companySharePledged'] : null;
   $bscNscCode = isset($input['bscNscCode']) ? $input['bscNscCode'] : null;
    //$id = $input['id'];
   $loan = null;
   $fieldsArr = [];
   $rulesArr = [];
   $messagesArr = [];
   $user = Auth::getUser();
   $userProfile = Auth::getUser()->userProfile();

   $validator = Validator::make($fieldsArr, $rulesArr, $messagesArr);
   if ($validator->fails()) {
    return Redirect::back()->withErrors($validator)->withInput();
  } else {
  //$user = Auth::getUser();
  //$userProfile =  Auth::getUser()->userProfile();
    $input['user_id'] = $user->id;
    if (isset($loanId)) {
      if (isset($loans)) {
        $salesAreaDetailId = $loans->id;
      } else {
        $salesAreaDetailId = null;
      }
    }

    $user = Auth::user();
    if (isset($user)) {
      $userID = $user->id;
      $userEmail = $user->email;
    }
    if (isset($userID)) {
      $mobileAppEmail = DB::table('mobile_app_data')->where('Email', $userEmail)
      ->where('status', 0)
      ->first();
    }
  }

  $loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loanId], ['loan_id' => $loanId, 'sentApprovar' => 'Y']);
  $loansStatus = Loan::updateOrCreate(['id' => $loanId], ['id' => $loanId, 'status' => '22']);
  $loansStatus->save();
  
  $loan = PraposalChecklists::updateOrCreate(['loan_id' => $loanId], [
   /* 'promoterBackground' => @$input['promoterBackground'],*/
   'com_business_type' => @$input['com_business_type'],
   'business_address' => @$input['business_address'],
   'com_co_business_old'=> @$input['com_co_business_old'],
     //  'businessDescription'=> @$input['businessDescription'], 
   'lastAuditedTurnover'=> @$input['lastAuditedTurnover'],
   'othr_cibilscore'=> @$input['othr_cibilscore'], 
   'threeYearsFinancials'=> @$input['threeYearsFinancials'],
   'profitableLast2Years'=> @$input['profitableLast2Years'], 
   'ratioBreaches'=> @$input['ratioBreaches'],
   'ratioBreachesDescrip'=> @$input['ratioBreachesDescrip'], 
   'KYC'=> @$input['KYC'], 
   'customerVisit'=> @$input['customerVisit'], 
   'customerVisitDescription'=> @$input['customerVisitDescription'], 
   'creditCell'=> @$input['creditCell'], 
   'creditCellDescription'=> @$input['creditCellDescription'],
   'refrenceCheck'=> @$input['refrenceCheck'], 
   'refreanceCheckDescription'=> @$input['refreanceCheckDescription'],
   'bankStatment'=> @$input['bankStatment'], 
   'bankStatmentDescrip'=> @$input['bankStatmentDescrip'], 
   'latestTotalBorrowing'=> @$input['latestTotalBorrowing'], 
        //'loan_purpose'=> @$input['loan_purpose'] 'KYC'=> @$input['KYC'], 
   'anyDefaultLenders'=> @$input['anyDefaultLenders'], 
   'securityProvided'=> @$input['securityProvided'], 
   'latestDEratio'=> @$input['latestDEratio'],
   'securityProvidedDescrip'=> @$input['securityProvidedDescrip'], 
   'liquidityModel'=> @$input['liquidityModel'],
   'liquidityModelDescrip'=> @$input['liquidityModelDescrip'], 
   'daviationLoanMatrix'=> @$input['daviationLoanMatrix'], 
   'daviationLoanMatrixDescrip'=> @$input['daviationLoanMatrixDescrip'], 
   'companyKYC'=> @$input['companyKYC'], 
   //'recomndation'=> @$input['recomndation'],  
   'loan_purpose'=> @$input['loan_purpose'], 

        //'loan_purpose'=> $input['loan_purpose']
 ] );
  //dd( $input);
     // $redirectUrl = $this->generateRedirectURL('loans/praposal/checklist', $endUseList, $loanType, $amount, $loanTenure, $companySharePledged, $bscNscCode, $loanId);
  //$redirectUrl = $this->generateRedirectURL('loans/praposal/checklist', $endUseList, $loanType, $amount, $loanTenure, $companySharePledged, $bscNscCode, $loanId);

  //return Redirect::to($redirectUrl);
  //$redirectUrl = 'home';


  /*if($user->isApproverUser()){
   $redirectUrl = $this->generateRedirectURL('loans/praposal/approver', $endUseList, $loanType, $amount, $loanTenure, $companySharePledged, $bscNscCode, $loanId);
 }else{*/
 // $redirectUrl = 'home';
  $redirectUrl = $this->generateRedirectURL('loans/praposal/keyloanterm', $endUseList, $loanType, $amount, $loanTenure, $companySharePledged, $bscNscCode, $loanId);

  return Redirect::to($redirectUrl)->with('message', 'Checklist has beed successfully saved');;

}


public function getKeyloanTerm( $param1 = null, $param2 = null, $param3 = null, $param4 = null, $param5 = null, $param6 = null, $param7 = null)
{
  $endUseList = $param2;
  $loanProduct = $param2;
  $amount = $param3;
  $loanTenure = $param4;
  $companySharePledged = null;
  $bscNscCode = null;
  if (isset($param5) && isset($param6)) {
    $companySharePledged = $param5;
    $bscNscCode = $param6;
    $loanId = $param7;
  } else {
    $loanId = $param5;
  }

  $loan = null;
  if (isset($loanId)) {
    $loan = Loan::find($loanId);
  }
  $loanType = null;
  $user = null;
  $userProfile = null;
  if (isset($loan)) {
    $loanType = $loan->type;
    $amount = $loan->loan_amount;
    $loanTenure = $loan->loan_tenure;
    $endUseList = $loan->end_use;
  }

  $states = MasterData::states();
  $choosenSales = null;
  $userType = MasterData::userType();
  $industryTypes = MasterData::industryTypes(false);
  $businessVintage = MasterData::businessVintage();
  $choosenUserType = null;
  $loanApplicationId = null;

  $loansStatus = null;
  $loan = null;
  
  $setDisable = null;
  $status = null;
  $user = null;
  $userProfile = null;
  $loan = Loan::find($loanId);
  $loanUser = User::find($loan->user_id);
  $loanUserProfile = $loanUser->userProfile();
  $isReadOnly = Config::get('constants.CONST_IS_READ_ONLY');
  
   //$formaction = 'loans/newlap/uploaddoc/'.$loanId;
  $validLoanHelper = new validLoanUrlhelper();
  //getting borrowers profile
       //PraposalChecklist
  $loan = Loan::find($loanId);
  $loanUser = User::find($loan->user_id);
  $loanUserProfile = $loanUser->userProfile();


  $isReadOnly = Config::get('constants.CONST_IS_READ_ONLY');

  $setDisable = '';
  $isRemoveMandatory = MasterData::removeMandatory();
  $isRemoveMandatory = array_except($isRemoveMandatory, ['']);
  $removeMandatoryHelper = new validLoanUrlhelper();
  $removeMandatory = $removeMandatoryHelper->getMandatory($user, $isRemoveMandatory);
  if (isset($loanId)) {
    $validLoan = $validLoanHelper->isValidLoan($loanId);
    if (!$validLoan) {
      return view('loans.error');
    }
    $status = $validLoanHelper->getTabStatus($loanId, 'background');
    if ($status == 'Y' && $setDisable != 'disabled') {
      $setDisable = 'disabled';
    }
  }
  //$formaction = 'loans/newlap/uploaddoc/'.$loanId;
  $validLoanHelper = new validLoanUrlhelper();
  $subViewType = 'loans._keyloanterm';
  $formaction = 'Loans\LoansController@postKeyloanTerm';
     //$formaction = 'loans/newlap/uploaddoc/'.$loanId;
      //getting borrowers profile
  if (isset($loanId)) {
    $loan = Loan::find($loanId);
    $loanUser = User::find($loan->user_id);
    $loanUserProfile = $loanUser->userProfile();
    @$keyloanterm=PraposalKeyloanterms::where('loan_id', '=', $loanId)->first();
    
  }
  $userPr = UserProfile::where('user_id', '=', $loan->user_id)->first();
  $userProfileFirm = UserProfile::with('user')->find($userPr->id);

  return view('loans.praposalCreditEdit', compact(
    'subViewType',
    'loan',
    'keyloanterm',
    'loanId',
    'endUseList',
    'loanType',
    'amount',
    'loanTenure',
    'promoterDetails',
    'formaction',
    'removeMandatory ',
    'setDisable',
    'validLoanHelper',
    'userProfileFirm',
    'keyloanterm',
    'ratios',
    'typeofEntity'

  ));
}

  /**
   * Show the form for creating a new resource.
   *
   * @param Request $request
   *
   * @return Response
   */ // 
  public function postKeyloanTerm(Request $request)
  {
   $input = Input::all();
   $loanId = isset($input['loanId']) ? $input['loanId'] : null;
   $loanType = isset($input['type']) ? $input['type'] : null;
   $amount = isset($input['loan_amount']) ? $input['loan_amount'] : null;
   $loanTenure = isset($input['loan_tenure']) ? $input['loan_tenure'] : null;
   $endUseList = isset($input['end_use']) ? $input['end_use'] : null;
  //if loan is selected
   $companySharePledged = isset($input['companySharePledged']) ? $input['companySharePledged'] : null;
   $bscNscCode = isset($input['bscNscCode']) ? $input['bscNscCode'] : null;
    //$id = $input['id'];
   $loan = null;
   $fieldsArr = [];
   $rulesArr = [];
   $messagesArr = [];
   $user = Auth::getUser();
   $userProfile = Auth::getUser()->userProfile();

   //$guarantors=$input['guarantors'];
   $fieldsArr['guarantors']=$input['guarantors'];
   $rulesArr['guarantors']='Required';
   $messagesArr['guarantors.required']="Guarantors is required";

   $fieldsArr['amount']=$input['amount'];
   $rulesArr['amount']='Required|numeric';
   $messagesArr['amount.required']="Amount is required"; 

   $fieldsArr['purpose']=$input['purpose'];
   $rulesArr['purpose']='Required';
   $messagesArr['purpose.required']="Purpose is required"; 

   $fieldsArr['facility']=$input['facility'];
   $rulesArr['facility']='Required';
   $messagesArr['facility.required']="Facility is required";

   $fieldsArr['tenor']=$input['tenor'];
   $rulesArr['tenor']='Required|numeric|max:120';
   $messagesArr['tenor.required']="Tenor is required"; 

   $fieldsArr['interest_rate']=$input['interest_rate'];
   $rulesArr['interest_rate']='Required|numeric|max:25';
   $messagesArr['interest_rate.required']="Interest is required"; 

   $fieldsArr['processing_fee']=$input['processing_fee'];
   $rulesArr['processing_fee']='Required|numeric';
   $messagesArr['processing_fee.required']="Processing Fees is required";  

   $fieldsArr['legal_fee']=$input['legal_fee'];
   $rulesArr['legal_fee']='Required|numeric';
   $messagesArr['legal_fee.required']="Legal Fees is required";



   $validator = Validator::make($fieldsArr, $rulesArr, $messagesArr);
   if ($validator->fails()) {
    return Redirect::back()->withErrors($validator)->withInput();
  } else {
  //$user = Auth::getUser();
  //$userProfile =  Auth::getUser()->userProfile();
    $input['user_id'] = $user->id;
    if (isset($loanId)) {
      if (isset($loans)) {
        $salesAreaDetailId = $loans->id;
      } else {
        $salesAreaDetailId = null;
      }
    }

    $user = Auth::user();
    if (isset($user)) {
      $userID = $user->id;
      $userEmail = $user->email;
    }
    if (isset($userID)) {
      $mobileAppEmail = DB::table('mobile_app_data')->where('Email', $userEmail)
      ->where('status', 0)
      ->first();
    }
  }

  $loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loanId], ['loan_id' => $loanId, 'sentApprovar' => 'Y']);
  $loansStatus = Loan::updateOrCreate(['id' => $loanId], ['id' => $loanId, 'status' => '22']);
  $loansStatus->save();
  
  $loan = PraposalKeyloanterms::updateOrCreate(['loan_id' => $loanId], [
   /* 'promoterBackground' => @$input['promoterBackground'],*/
   'guarantors' => @$input['guarantors'],
   'amount' => @$input['amount'],
   'purpose'=> @$input['purpose'],
   'borrower'=> @$input['borrower'],
     //  'businessDescription'=> @$input['businessDescription'], 
   'facility'=> @$input['facility'],
   'tenor'=> @$input['tenor'], 
   'interest_rate'=> @$input['interest_rate'],
   'processing_fee'=> @$input['processing_fee'], 
   'legal_fee'=> @$input['legal_fee'],
   'repayment_schedule'=> @$input['repayment_schedule'], 
   'prepayment_penalty'=> @$input['prepayment_penalty'], 
   'security'=> @$input['security'], 
   'pre_disbursement_conditions'=> @$input['pre_disbursement_conditions'], 
   'fin_conv_debt_ebitda'=> @$input['fin_conv_debt_ebitda'], 
   'fin_conv_debt_equity_ratio'=> @$input['fin_conv_debt_equity_ratio'],
   'fin_conv_current_ratio'=> @$input['fin_conv_current_ratio'], 
   'fin_conv_interest_cov_ratio'=> @$input['fin_conv_interest_cov_ratio'],
   'fin_conv_other'=> @$input['fin_conv_other'], 
   //'other_convenants_standerds_withaddiotion'=> @$input['other_convenants_standerds_withaddiotion'], 
   'other_convenants_standerds_withaddiotion'=> @$input['other_convenants_standerds_withaddiotion'], 
        //'loan_purpose'=> @$input['loan_purpose'] 'KYC'=> @$input['KYC'], 
   'recomndation'=> @$input['recomndation'], 
   'lastRowriskMitigants'=> @$input['lastRowriskMitigants'], 


        //'loan_purpose'=> $input['loan_purpose']
 ] );
  //dd( $input);
     // $redirectUrl = $this->generateRedirectURL('loans/praposal/checklist', $endUseList, $loanType, $amount, $loanTenure, $companySharePledged, $bscNscCode, $loanId);
  //$redirectUrl = $this->generateRedirectURL('loans/praposal/checklist', $endUseList, $loanType, $amount, $loanTenure, $companySharePledged, $bscNscCode, $loanId);

  //return Redirect::to($redirectUrl);
  //$redirectUrl = 'home';


  if($user->isApproverUser()){
   $redirectUrl = $this->generateRedirectURL('loans/praposal/approver', $endUseList, $loanType, $amount, $loanTenure, $companySharePledged, $bscNscCode, $loanId);
 }else{
  $redirectUrl = 'home';
}
return Redirect::to($redirectUrl)->with('message', 'Proposal Has beed forwarded to approver');;

}




public function getApprover($loanType, $endUseList = null, $amount = null, $loanTenure = null, $loanId = null)
{

  $loan = null;
  $model = null;
  $praposalApproved = Config::get('constants.CONST_LOAN_STATUS_TYPE_24');
  $praposalRejected = Config::get('constants.CONST_LOAN_STATUS_TYPE_25');
  $validLoanHelper = new validLoanUrlhelper();

  $user = Auth::getUser();
  if (isset($loanId)) {
    $validLoan = $validLoanHelper->isValidLoan($loanId);
    if (!$validLoan) {
      return view('loans.error');
    }
    $loan = Loan::find($loanId);
    $userPr = UserProfile::where('user_id', '=', $loan->user_id)->first();
    $userProfileFirm = UserProfile::with('user')->find($userPr->id);
    if (isset($loan) && isset($user)) {

     $loan=LoansStatus::where('loan_id', '=', $loanId)->first();
   }
 }
 $subViewType = 'loans._approver';
 $formaction = 'Loans\LoansController@postApprover';
 return view('loans.createedit', compact('subViewType', 'formaction','userProfileFirm', 'loan', 'loanId', 'loanType', 'endUseList', 'amount', 'loanTenure', 'validLoanHelper', 'bankApprovalStatus_1', 'bankApprovalStatus_2'));
}

  /**
   * Save the Approval result by bank user
   * @param Request $request
   *
   * @return Response
   */
  public function postApprover(Request $request)
  {
    $input = Input::all();
    $id = isset($input['id']) ? $input['id'] : null;
    $loanId = isset($input['loanId']) ? $input['loanId'] : null;
    $loanType = isset($input['type']) ? $input['type'] : null;
    $amount = isset($input['loan_amount']) ? $input['loan_amount'] : null;
    $loanTenure = isset($input['loan_tenure']) ? $input['loan_tenure'] : null;
    $endUseList = isset($input['end_use']) ? $input['end_use'] : null;
    $user = Auth::getUser();


    LoansStatus::updateOrCreate(['loan_id' => $loanId], ['loan_id' => $loanId, 'praposalApproved' => $input['loan_status'],'remark'=>$input['remark']]);
    if($input['loan_status']=='Y'){
      $loansStatus = Loan::updateOrCreate(['id' => $loanId], ['id' => $loanId, 'status' => '24']);
      $loansStatus->save();
    }else{
      $loansStatusNo = Loan::updateOrCreate(['id' => $loanId], ['id' => $loanId, 'status' => '23']);
      $loansStatusNo->save();
    }

   // $loansStatus->save();
    $redirectUrl = 'home';
    return Redirect::to($redirectUrl)->withInput();
  }




  public function getLoancomment($param1 = null, $param2 = null, $param3 = null, $param4 = null, $param5 = null, $param6 = null, $param7 = null)
  {

    $endUseList = $param2;
    $loanProduct = $param2;
    $amount = $param3;
    $loanTenure = $param4;
    $companySharePledged = null;
    $bscNscCode = null;
    if (isset($param5) && isset($param6)) {
      $companySharePledged = $param5;
      $bscNscCode = $param6;
      $loanId = $param7;
    } else {
      $loanId = $param5;
    }

    $loan = null;
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
    }
    $loanType = null;
    
    $user = null;
    $userProfile = null;
    if (isset($loan)) {
      $loanType = $loan->type;
      $amount = $loan->loan_amount;
      $loanTenure = $loan->loan_tenure;
      $endUseList = $loan->end_use;


    }

    $praposalApproved = Config::get('constants.CONST_LOAN_STATUS_TYPE_24');
    $praposalRejected = Config::get('constants.CONST_LOAN_STATUS_TYPE_23');
    $validLoanHelper = new validLoanUrlhelper();

    $user = Auth::getUser();
    if (isset($loanId)) {
      $validLoan = $validLoanHelper->isValidLoan($loanId);
      if (!$validLoan) {
        return view('loans.error');
      }
      $loan = Loan::find($loanId);
      $userPr = UserProfile::where('user_id', '=', $loan->user_id)->first();
      $userProfileFirm = UserProfile::with('user')->find($userPr->id);
      if (isset($loan) && isset($user)) {

       $loanstatus=LoansStatus::where('loan_id', '=', $loanId)->first();
     }
   }
   $subViewType = 'loans._approvalcomment';
   $formaction = 'Loans\LoansController@postApprover';
   return view('loans.createedit', compact('subViewType', 'formaction','userProfileFirm', 'loan','loanstatus', 'loanId', 'loanType', 'endUseList', 'amount', 'loanTenure', 'validLoanHelper', 'bankApprovalStatus_1', 'bankApprovalStatus_2'));
 }


 /**
   * @param $loanType
   * @param $endUseList
   * @param $amount
   * @param $chosenLoanTenure
   * @param $loanId
   * @return Response
   * @return mixed
   */

 public function getChecklist($param1 = null, $param2 = null, $param3 = null, $param4 = null, $param5 = null, $param6 = null, $param7 = null, $param8 = null)
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

    $securityDetail = $loan->getSecurityDetails()->get()->first();
    if ($companySharePledged == null) {
      if (@$securityDetail->is_any_other_security == 1) {
        $displayNoneSecurity = $securityDetail->is_any_other_security;
      }
    }
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

  //new

  $loansStatus = null;
  $loan = null;
  $isReadOnly = Config::get('constants.CONST_IS_READ_ONLY');

  $status = null;
  $user = null;
  $userProfile = null;

  $entityTypes = MasterData::entityTypes();
  $chosenEntity = null;


  $loan_tenure = MasterData::tenureYearList();
  $chosenLoanTenure = null;
  $loan_product = MasterData::loanProductType();
  $chosenLoanProduct = null;

  $subViewType = 'loans._createCheckList';
  $formaction = 'Loans\LoansController@postCreatechecklist';

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


  $validLoanHelper = new validLoanUrlhelper();

  $loan = Loan::find($loanId);
  $loanUser = User::find($loan->user_id);
  $loanUserProfile = $loanUser->userProfile();

  $isReadOnly = Config::get('constants.CONST_IS_READ_ONLY');

  $setDisable = '';
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
  $isRemoveMandatory = MasterData::removeMandatory();
  $isRemoveMandatory = array_except($isRemoveMandatory, ['']);
  $removeMandatoryHelper = new validLoanUrlhelper();
  $removeMandatory = $removeMandatoryHelper->getMandatory($user, $isRemoveMandatory);
  $deletedQuestionsLoan = $this->getDeletedQuestionLoan($loan, $loanType, $amount);
  $deletedQuestionHelper = new DeletedQuestionsHelper($deletedQuestionsLoan);
  $isQuestionMandatory = new UploadDocHelper($loan);
  $user = Auth::getUser();
  $user_id = $user->id;
  $max_cmpny_bank_stmt = Config::get('constants.CONST_MAX_COMPANY_BANK_STATEMENT');
  $maxInvoiceCopyofEquipmentPurchase = Config::get('constants.CONST_MAX_INVOICE_COPY_OF_EQUIPMENT_PURCHASE');
  $maxInvoiceBillDetails = Config::get('constants.CONST_MAX_COPY_OF_INVOICE_BILL_DETAILS');
  $maxSecurityDocument = Config::get('constants.CONST_MAX_SECURITY_DOCUMENT_DETAILS');
  $maxSecurityDocumentCount =null;
  $upload_doc = null;
  $blplfile = [];
  $kycdocument_file = null;
  $cibil_promoter_file = null;

  $add_proof_file = null;
  $proof_address_file = null;
  $bankstatement_file = null;
  $cmpnybankstmt_file = [];
  $cibilreport_file = null;
  $gurav_file = null;
  $rent_file = null;
  $udyog_file = null;
  $electricity_file = null;
  $other_promoter_file = null;
  $network_file = null;

  $promoternetworth_file = null;
  $propertypapers_file = null;
  $corporate_file = null;
  $networthcertificate_file = null;
  $otherdocument_file = null;
  $ecommercesupply_file = null;
  

  //new
  $moa_file = null;


  $pan_file = null;


  $cor_file =null;


  $gst_file_path = null;
  $gst_company_file = null;

  

  $ghumasta_file1 = null;
  $company_cibil_file2 = null;

  $optional_file2 = null;
  $promoter_cibilreport_file = null;
  $promoter_proof_pan_file = null;

  $equipmentPurchaseCopy = [];
  $loandoc = [];
  $mortagageDocument = [];
  $hypothicationAgreement = [];

  $EscrowAgreement = [];

  $nachagree = [];
  $pdcSec = [];
  $pdcCover = [];
  $otherSecuritytab1 = [];
  $otherSecuritytab2 = [];
  $otherSecuritytab3 = [];
  $existingSecurityFiles = 0;
  $model = null;
  $securityDetailsFile = null;
  $n = 0;
  $cnt = 0;
  $o = 0;
  $p = 0;
  $q = 0;
  $r = 0;
  $s = 0;
  $t = 0;
  $u = 0;
  $v = 0;
  $fileHelper = new FileHelper();
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

  if (isset($loanId)) {
    $loan = Loan::find($loanId);
    $model = $loan->getUploads()->get()->first();
    if (isset($model)) {
      $model = $model->toArray();
      for ($i = 1; $i <= count($model); $i++) {
        foreach ($model as $key => $val) {
          if ($key == 'other_file' . $i . '_path') {
            if (isset($val)) {
              $blplfile[$key] = $fileHelper->getFileDownloadURL($val);
            }
          } else if ($key == 'bank_file' . $i . '_path') {
            if (isset($val)) {
              $cmpnybankstmt_file[$key] = $fileHelper->getFileDownloadURL($val);
            }
          } else if ($key == 'cibilreport_file_path') {
            if (isset($val)) {
             $cibilreport_file = $fileHelper->getFileDownloadURL($val);


           }
         } else if ($key == 'cibilreport_file_path') {
          if (isset($val)) {
            $cibilreport_file = $fileHelper->getFileDownloadURL($val);

          }
        } else if ($key == 'moa_file_path') {
          if (isset($val)) {
            $moa_file = $fileHelper->getFileDownloadURL($val);
          }
        } else if ($key == 'pan_file_path') {
          if (isset($val)) {
            $pan_file = $fileHelper->getFileDownloadURL($val);
          }
        } else if ($key == 'cor_file_path') {
          if (isset($val)) {
            $cor_file = $fileHelper->getFileDownloadURL($val);

          }
        }else if ($key == 'gurav_file_path') {
          if (isset($val)) {
            $gurav_file = $fileHelper->getFileDownloadURL($val);


          }
        }else if ($key == 'rent_file_path') {
          if (isset($val)) {
            $rent_file = $fileHelper->getFileDownloadURL($val);
          }
        }else if ($key == 'udyog_file_path') {
          if (isset($val)) {
            $udyog_file = $fileHelper->getFileDownloadURL($val);
          }
        }else if ($key == 'electricity_file_path') {
          if (isset($val)) {
            $electricity_file = $fileHelper->getFileDownloadURL($val);
          }
        }else if ($key == 'gst_file_path') {
          if (isset($val)) {
            $gst_company_file = $fileHelper->getFileDownloadURL($val);
          }
        } else if ($key == 'ghumasta_file1_path') {
          if (isset($val)) {
            $ghumasta_file1 = $fileHelper->getFileDownloadURL($val);
          }
        } else if ($key == 'company_cibil_file2_path') {
          if (isset($val)) {
            $company_cibil_file2 = $fileHelper->getFileDownloadURL($val);
          }
        } else if ($key == 'prom_bank_stmt_file_path') {
          if (isset($val)) {
            $bankstatement_file = $fileHelper->getFileDownloadURL($val);
          }
        } else if ($key == 'prom_networth_file_path') {
          if (isset($val)) {
            $promoternetworth_file = $fileHelper->getFileDownloadURL($val);
          }
        } else if ($key == 'prom_cibilreport_file_path') {
          if (isset($val)) {
            $promoter_cibilreport_file = $fileHelper->getFileDownloadURL($val);
          }
        } else if ($key == 'prom_kyc_pan_file_path') {
          if (isset($val)) {
            $promoter_proof_pan_file = $fileHelper->getFileDownloadURL($val);
          }
        } else if ($key == 'prom_addproof_file_path') {
          if (isset($val)) {
            $add_proof_file = $fileHelper->getFileDownloadURL($val);
          }
        } else if ($key == 'prom_network_file_path') {
          if (isset($val)) {
            $network_file = $fileHelper->getFileDownloadURL($val);
          }
        } else if ($key == 'prom_cibil_file_path') {
          if (isset($val)) {
            $cibil_promoter_file = $fileHelper->getFileDownloadURL($val);
          }
        } else if ($key == 'other_promoter_file_path') {
          if (isset($val)) {
            $other_promoter_file = $fileHelper->getFileDownloadURL($val);
          }
        } else if ($key == 'business_corporate_file_path') {
          if (isset($val)) {
            $corporate_file = $fileHelper->getFileDownloadURL($val);
          }
        } else if ($key == 'business_cert_ecom_file_path') {
          if (isset($val)) {
            $ecommercesupply_file = $fileHelper->getFileDownloadURL($val);
          }
        } else if ($key == 'business_invoice_equi' . $i . '_file_path') {
          if (isset($val)) {
            $equipmentPurchaseCopy[$key] = $fileHelper->getFileDownloadURL($val);
          }
        } else if ($key == 'loan_doc_bill' . $i . '_file_path') {
          if (isset($val)) {
            $loandoc[$key] = $fileHelper->getFileDownloadURL($val);
          }
        } else if ($key == 'mortagage_pro_val_report' . $i . '_path') {
          if (isset($val)) {
            $mortagageDocument[$n] = $fileHelper->getFileDownloadURL($val);
            $n++;
            $cnt = $n;
          }
        } else if ($key == 'pro_hypothication_search_report' . $i . '_path') {
          if (isset($val)) {
            $hypothicationAgreement[$o] = $fileHelper->getFileDownloadURL($val);
            $o++;
            if ($cnt < $o) {
              $cnt = $o;
            }
          }
        } else if ($key == 'escrow_agreement_card' . $i . '_path') {
          if (isset($val)) {
            $EscrowAgreement[$p] = $fileHelper->getFileDownloadURL($val);
            $p++;
            if ($cnt < $p) {
              $cnt = $p;
            }
          }
        } else if ($key == 'nach' . $i . '_path') {
          if (isset($val)) {
            $nachagree[$q] = $fileHelper->getFileDownloadURL($val);
            $q++;
            if ($cnt < $q) {
              $cnt = $q;
            }
          }
        } else if ($key == 'pdc_security' . $i . '_path') {
          if (isset($val)) {
            $pdcSec[$r] = $fileHelper->getFileDownloadURL($val);
            $r++;
            if ($cnt < $r) {
              $cnt = $r;
            }
          }
        } else if ($key == 'pdc_covering_letter' . $i . '_path') {
          if (isset($val)) {
            $pdcCover[$s] = $fileHelper->getFileDownloadURL($val);
            $s++;
            if ($cnt < $s) {
              $cnt = $s;
            }
          }
        } else if ($key == 'security1_other' . $i . '_path') {
          if (isset($val)) {
            $otherSecuritytab1[$t] = $fileHelper->getFileDownloadURL($val);
            $t++;
            if ($cnt < $t) {
              $cnt = $t;
            }
          }
        } else if ($key == 'security2_other' . $i . '_path') {
          if (isset($val)) {
            $otherSecuritytab2[$u] = $fileHelper->getFileDownloadURL($val);
            $u++;
            if ($cnt < $u) {
              $cnt = $u;
            }
          }
        } else if ($key == 'security3_other' . $i . '_path') {
          if (isset($val)) {
            $otherSecuritytab3[$v] = $fileHelper->getFileDownloadURL($val);
            $v++;
            if ($cnt < $v) {
              $cnt = $v;
            }
          }
        }
      }
    }
  }
  if ($cnt != 0) {
    $existingSecurityFiles = $cnt;
  }
}

  //getting borrowers profile
if (isset($loanId)) {
  $loan = Loan::find($loanId);
  $loanUser = User::find($loan->user_id);
  $loanUserProfile = $loanUser->userProfile();

    //new
  @$praposalChecklist=PraposalChecklists::where('loan_id', '=', $loanId)->first();
  @$promoterDetails=PromoterDetails::where('loan_id', '=', $loanId)->first();
}
$userPr = UserProfile::where('user_id', '=', $loan->user_id)->first();
$userProfile = UserProfile::with('user')->find($userPr->id);
  //new
$userProfileFirm = UserProfile::with('user')->find($userPr->id);

return view('loans.createedit', compact(
  'subViewType',
  'endUseList',
  'loanType',
  'amount',
  'loanTenure',
  'loan',
  'loanId',
  'formaction',
  'loan_tenure',
  'chosenLoanTenure',
  'userProfile',
  'loan_product',
  'chosenLoanProduct',
  'bl_year',
  'addressTypes',
  'kycdocument_file',
  'cibil_promoter_file',
  'proof_address_file',
  'bankstatement_file',
  'cibilreport_file',
  'network_file',
  'promoternetworth_file',
  'propertypapers_file',
  'corporate_file',
  'networthcertificate_file',
  'otherdocument_file',
  'ecommercesupply_file',
  'blplfile',
  'pancard_file',
  'moa_file',

  // 'vatregistration_file',
  'pan_file',
    //'shopestablish_file',
  'cor_file',
  'removeMandatory',
  // 'addressproof_company_file',

  'gst_company_file',



  'ghumasta_file1',
  'company_cibil_file2',

  'optional_file2',
  'promoter_cibilreport_file',
  'promoter_proof_pan_file',
  'max_cmpny_bank_stmt',
  'cmpnybankstmt_file',
  'maxInvoiceCopyofEquipmentPurchase',
  'equipmentPurchaseCopy',
  'maxInvoiceBillDetails',
  'loandoc',
  'maxSecurityDocument',
  'maxSecurityDocumentCount',
  'existingSecurityFiles',
  'mortagageDocument',
  'hypothicationAgreement',
  'EscrowAgreement',
  'nachagree',
  'pdcSec',
  'pdcCover',
  'otherSecuritytab1',
  'otherSecuritytab2',
  'otherSecuritytab3',
  'setDisable',
  'displayNoneSecurity',
  'deletedQuestionHelper',
  'model',
  'isQuestionMandatory',
  'companySharePledged',
  'bscNscCode',
  'validLoanHelper',
  'mandatoryField',
  'add_proof_file',
  'loanUserProfile',

    //new

  'praposalChecklist',


  'groupType',
  'com_business_type',
  'financialDataExpressionsMap',
  'showFormulaText',
  'financialDataMap',
  'validLoanHelper',
  'userProfileFirm',
  'refreanceCheckDescription',
  'loanUserProfile',
  'companySharePledged',

  'financialProfitLoss',
  'ratios',
  'typeofEntity',
  'gurav_file',
  'rent_file',
  'udyog_file',
  'electricity_file',
  'other_promoter_file'
));
}

public function postCreatechecklist(Request $request)
{
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

    $bl_year = $this->setFinancialYears();
    $countYear = 0;
    if (isset($loanId)) {
      $fileHelper = new FileHelper();
      $directory = $user_id . "/" . $loanId;
      $uploadDetails = null;


      foreach ($bl_year as $year) {
        $countYear++;
        if ($request->file('other_file' . $countYear . '_path')) {
          $file = $request->file('other_file' . $countYear . '_path');
          $originalFileName = $file->getClientOriginalName();
          $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . $year . '-' . $originalFileName;
          $oldFileName = null;
          $fieldName = 'other_file' . $countYear . '_path';
          if (!isset($uploadDetails)) {
            $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
          }
          if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
            $oldFileName = $uploadDetails->getAttribute($fieldName);
          }
          $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
          $uploadDetails->setAttribute($fieldName, $uploadedFileName);
        }

      }
// Bank Statement
      $maxCompanyBankStmt = Config::get('constants.CONST_MAX_COMPANY_BANK_STATEMENT');
      $maxCompanyBankStmtcount = @$input['num_bank'];

      for ($i = 1; $i <= $maxCompanyBankStmt; $i++) {
        if ($maxCompanyBankStmtcount == 1 && $i > $maxCompanyBankStmtcount) {
          $bankStmt = Upload::updateOrCreate(['loan_id' => $loanId], ['bank_name' . $i => null, 'bank_period' . $i => null, 'bank_file' . $i . '_path' => null]);
          $bankStmt->save();
        } elseif ($maxCompanyBankStmtcount == 2 && $i > $maxCompanyBankStmtcount) {
          $bankStmt = Upload::updateOrCreate(['loan_id' => $loanId], ['bank_name' . $i => null, 'bank_period' . $i => null, 'bank_file' . $i . '_path' => null]);
          $bankStmt->save();
        }
      }
      for ($i = 1; $i <= $maxCompanyBankStmtcount; $i++) {
        if (!empty($input['bank_name' . $i])) {
          $bankStmt = Upload::updateOrCreate(['loan_id' => $loanId], ['bank_name' . $i => $input['bank_name' . $i], 'bank_period' . $i => $input['bank_period' . $i]]);
          $bankStmt->save();
        }
        if ($request->file('bank_file' . $i . '_path')) {
          $file = $request->file('bank_file' . $i . '_path');
          $originalFileName = $file->getClientOriginalName();
          $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'bankstmt_' . $i . '-' . $originalFileName;
          $oldFileName = null;
          $fieldName = 'bank_file' . $i . '_path';
          if (!isset($uploadDetails)) {
            $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
          }
          if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
            $oldFileName = $uploadDetails->getAttribute($fieldName);
          }
          $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
          $uploadDetails->setAttribute($fieldName, $uploadedFileName);
        }
      }
//CIBIL Report
      if ($request->file('cibilreport_file_path')) {
        $file = $request->file('cibilreport_file_path');
        $originalFileName = $file->getClientOriginalName();
        $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'cibil_report' . '_' . $originalFileName;
        $oldFileName = null;
        $fieldName = 'cibilreport_file_path';
        if (!isset($uploadDetails)) {
          $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
        }
        if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
          $oldFileName = $uploadDetails->getAttribute($fieldName);
        }
        $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
        $uploadDetails->setAttribute($fieldName, $uploadedFileName);
      }
//Company Kyc Details Files\
      if (isset($input['kycDetails'])) {
        for ($i = 1; $i <= count($input['kycDetails']); $i++) {
          $file_temp = $input['kycDetails'][$i];
          foreach ($file_temp as $key => $item) {
            if (isset($item)) {
              $file = $item;
              $originalFileName = $file->getClientOriginalName();
              $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'KYC_' . $originalFileName;
              $oldFileName = null;
              $fieldName = $key;
              if (!isset($uploadDetails)) {
                $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
              }
              if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
                $oldFileName = $uploadDetails->getAttribute($fieldName);
              }
              $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
              $uploadDetails->setAttribute($fieldName, $uploadedFileName);
            }

          }
        }
      }
      if ($request->file('prom_bank_stmt_file_path')) {
        $file = $request->file('prom_bank_stmt_file_path');
        $originalFileName = $file->getClientOriginalName();
        $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'promoter_bankStmt_' . $originalFileName;
        $oldFileName = null;
        $fieldName = 'prom_bank_stmt_file_path';
        if (!isset($uploadDetails)) {
          $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
        }
        if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
          $oldFileName = $uploadDetails->getAttribute($fieldName);
        }
        $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
        $uploadDetails->setAttribute($fieldName, $uploadedFileName);
      }



      if ($request->file('prom_networth_file_path')) {
        $file = $request->file('prom_networth_file_path');
        $originalFileName = $file->getClientOriginalName();
        $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'promoter_networth' . '_' . $originalFileName;
        $oldFileName = null;
        $fieldName = 'prom_networth_file_path';
        if (!isset($uploadDetails)) {
          $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
        }
        if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
          $oldFileName = $uploadDetails->getAttribute($fieldName);
        }
        $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
        $uploadDetails->setAttribute($fieldName, $uploadedFileName);
      } else {
        if ($deletedQuestionHelper->isQuestionValid("F2.2")) {

        }
      }
      if ($request->file('prom_cibilreport_file_path')) {
        $file = $request->file('prom_cibilreport_file_path');
        $originalFileName = $file->getClientOriginalName();
        $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'promoter_cibil' . '_' . $originalFileName;
        $oldFileName = null;
        $fieldName = 'prom_cibilreport_file_path';
        if (!isset($uploadDetails)) {
          $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
        }
        if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
          $oldFileName = $uploadDetails->getAttribute($fieldName);
        }
        $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
        $uploadDetails->setAttribute($fieldName, $uploadedFileName);
      }
      if ($request->file('prom_kyc_pan_file_path')) {
        $file = $request->file('prom_kyc_pan_file_path');
        $originalFileName = $file->getClientOriginalName();
        $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'promoter_pan_proof' . '_' . $originalFileName;
        $oldFileName = null;
        $fieldName = 'prom_kyc_pan_file_path';
        if (!isset($uploadDetails)) {
          $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
        }
        if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
          $oldFileName = $uploadDetails->getAttribute($fieldName);
        }
        $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
        $uploadDetails->setAttribute($fieldName, $uploadedFileName);
      }

      if ($request->file('prom_cibil_file_path')) {
        $file = $request->file('prom_cibil_file_path');
        $originalFileName = $file->getClientOriginalName();
        $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'promoter_cibil' . '_' . $originalFileName;
        $oldFileName = null;
        $fieldName = 'prom_cibil_file_path';
        if (!isset($uploadDetails)) {
          $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
        }
        if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
          $oldFileName = $uploadDetails->getAttribute($fieldName);
        }
        $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
        $uploadDetails->setAttribute($fieldName, $uploadedFileName);
      }

//new
      if ($request->file('other_promoter_file_path')) {
        $file = $request->file('other_promoter_file_path');
        $originalFileName = $file->getClientOriginalName();
        $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'other_promoter' . '_' . $originalFileName;
        $oldFileName = null;
        $fieldName = 'other_promoter_file_path';
        if (!isset($uploadDetails)) {
          $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
        }
        if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
          $oldFileName = $uploadDetails->getAttribute($fieldName);
        }
        $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
        $uploadDetails->setAttribute($fieldName, $uploadedFileName);
      }


//new end



      if ($request->file('prom_addproof_file_path')) {
        $file = $request->file('prom_addproof_file_path');
        $originalFileName = $file->getClientOriginalName();
        $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'promoter_addproof' . '_' . $originalFileName;
        $oldFileName = null;
        $fieldName = 'prom_addproof_file_path';
        if (!isset($uploadDetails)) {
          $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
        }
        if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
          $oldFileName = $uploadDetails->getAttribute($fieldName);
        }
        $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
        $uploadDetails->setAttribute($fieldName, $uploadedFileName);
      } else

//new for network certificate
      if ($request->file('prom_network_file_path')) {
        $file = $request->file('prom_network_file_path');
        $originalFileName = $file->getClientOriginalName();
        $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'network_file' . '_' . $originalFileName;
        $oldFileName = null;
        $fieldName = 'prom_network_file_path';
        if (!isset($uploadDetails)) {
          $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
        }
        if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
          $oldFileName = $uploadDetails->getAttribute($fieldName);
        }
        $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
        $uploadDetails->setAttribute($fieldName, $uploadedFileName);
      } else

      //new for cibil promoter file

      if ($request->file('prom_cibil_file_path')) {
        $file = $request->file('prom_cibil_file_path');
        $originalFileName = $file->getClientOriginalName();
        $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'cibil_file' . '_' . $originalFileName;
        $oldFileName = null;
        $fieldName = 'prom_cibil_file_path';
        if (!isset($uploadDetails)) {
          $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
        }
        if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
          $oldFileName = $uploadDetails->getAttribute($fieldName);
        }
        $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
        $uploadDetails->setAttribute($fieldName, $uploadedFileName);
      } else




      if ($request->file('business_corporate_file_path')) {
        $file = $request->file('business_corporate_file_path');
        $originalFileName = $file->getClientOriginalName();
        $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'corporate_presentation' . '_' . $originalFileName;
        $oldFileName = null;
        $fieldName = 'business_corporate_file_path';
        if (!isset($uploadDetails)) {
          $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
        }
        if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
          $oldFileName = $uploadDetails->getAttribute($fieldName);
        }
        $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
        $uploadDetails->setAttribute($fieldName, $uploadedFileName);
      }
      if ($request->file('business_cert_ecom_file_path')) {
        $file = $request->file('business_cert_ecom_file_path');
        $originalFileName = $file->getClientOriginalName();
        $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'e-commerce_certificate' . $i . '_' . $originalFileName;
        $oldFileName = null;
        $fieldName = 'business_cert_ecom_file_path';
        if (!isset($uploadDetails)) {
          $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
        }
        if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
          $oldFileName = $uploadDetails->getAttribute($fieldName);
        }
        $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
        $uploadDetails->setAttribute($fieldName, $uploadedFileName);
      }
//Invoice Copy of Equipment Purchase
      $maxInvoiceCopyofEquipmentPurchase = Config::get('constants.CONST_MAX_INVOICE_COPY_OF_EQUIPMENT_PURCHASE');


      if (isset($input['equipementPurchase'])) {
        $m = 1;
        foreach ($input['equipementPurchase'] as $key => $file) {
          if ($m <= $input['num_equi_purchase']) {
            if (isset($file)) {
              $originalFileName = $file->getClientOriginalName();
              $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'equipment_copy' . '-' . $originalFileName;
              $oldFileName = null;
              $fieldName = $key;
              if (!isset($uploadDetails)) {
                $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
              }
              if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
                $oldFileName = $uploadDetails->getAttribute($fieldName);
              }
              $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
              $uploadDetails->setAttribute($fieldName, $uploadedFileName);
            } else {




            }
          } else {
            break;
          }
          $m++;
        }
      }
//Copy of Invoice/Bill details
      $maxInvoiceBillDetails = Config::get('constants.CONST_MAX_COPY_OF_INVOICE_BILL_DETAILS');
      if ($deletedQuestionHelper->isQuestionValid("F3.4")) {
        $maxInvoiceBillDetailsCount = $input['num_invoice_detail'];
        for ($i = 1; $i < $maxInvoiceBillDetails; $i++) {
          if ($maxInvoiceBillDetailsCount == 1 && $i > $maxInvoiceBillDetailsCount) {
            $fieldName = 'loan_doc_bill' . $i . '_file_path';
            $equipmentBillDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => null]);
            $equipmentBillDetails->save();
          } elseif ($maxInvoiceBillDetailsCount == 2 && $i > $maxInvoiceBillDetailsCount) {
            $fieldName = 'loan_doc_bill' . $i . '_file_path';
            $equipmentBillDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => null]);
            $equipmentBillDetails->save();
          } elseif ($maxInvoiceBillDetailsCount == 3 && $i > $maxInvoiceBillDetailsCount) {
            $fieldName = 'loan_doc_bill' . $i . '_file_path';
            $equipmentBillDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => null]);
            $equipmentBillDetails->save();
          } elseif ($maxInvoiceBillDetailsCount == 4 && $i > $maxInvoiceBillDetailsCount) {
            $fieldName = 'loan_doc_bill' . $i . '_file_path';
            $equipmentBillDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => null]);
            $equipmentBillDetails->save();
          } elseif ($maxInvoiceBillDetailsCount == 5 && $i > $maxInvoiceBillDetailsCount) {
            $fieldName = 'loan_doc_bill' . $i . '_file_path';
            $equipmentBillDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => null]);
            $equipmentBillDetails->save();
          } 
        }
      }
      if (isset($input['loanDocFile'])) {
        $m = 1;
        foreach ($input['loanDocFile'] as $key => $file) {
          if ($m <= $input['num_invoice_detail']) {
            if (isset($file)) {
              $originalFileName = $file->getClientOriginalName();
              $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'invoice_bill' . '-' . $originalFileName;
              $oldFileName = null;
              $fieldName = $key;
              if (!isset($uploadDetails)) {
                $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
              }
              if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
                $oldFileName = $uploadDetails->getAttribute($fieldName);
              }
              $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
              $uploadDetails->setAttribute($fieldName, $uploadedFileName);
            } else {



            }
          } else {
            break;
          }
          $m++;
        }
      }
//===========Security Documents Uploads=============//
      $maxSecurityDocument = Config::get('constants.CONST_MAX_SECURITY_DOCUMENT_DETAILS');
      if (isset($input['num_security_doc'])) {
        $maxSecurityDocumentCount = $input['num_security_doc']; 
        for ($i = 1; $i <= $maxSecurityDocument; $i++) {
          if ($maxSecurityDocumentCount == 1 && $i > $maxSecurityDocumentCount) {
            $fieldName1 = 'mortagage_pro_val_report' . $i . '_path';
            $fieldName2 = 'pro_hypothication_search_report' . $i . '_path';
            $fieldName3 = 'escrow_agreement_card' . $i . '_path';
            $fieldName4 = 'nach' . $i . '_path';
            $fieldName5 = 'pdc_security' . $i . '_path';
            $fieldName6 = 'pdc_covering_letter' . $i . '_path';
            $fieldName7 = 'security1_other' . $i . '_path';
            $fieldName8 = 'security2_other' . $i . '_path';
            $fieldName9 = 'security3_other' . $i . '_path';
            $securityDocs = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName1 => null, $fieldName2 => null, $fieldName3 => null, $fieldName4 => null, $fieldName5 => null, $fieldName6 => null, $fieldName7 => null, $fieldName8 => null, $fieldName9 => null]);
            $securityDocs->save();
          } elseif ($maxSecurityDocumentCount == 2 && $i > $maxSecurityDocumentCount) {
            $fieldName1 = 'mortagage_pro_val_report' . $i . '_path';
            $fieldName2 = 'pro_hypothication_search_report' . $i . '_path';
            $fieldName3 = 'escrow_agreement_card' . $i . '_path';
            $fieldName4 = 'nach' . $i . '_path';
            $fieldName5 = 'pdc_security' . $i . '_path';
            $fieldName6 = 'pdc_covering_letter' . $i . '_path';
            $fieldName7 = 'security1_other' . $i . '_path';
            $fieldName8 = 'security2_other' . $i . '_path';
            $fieldName9 = 'security3_other' . $i . '_path';
            $securityDocs = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName1 => null, $fieldName2 => null, $fieldName3 => null, $fieldName4 => null, $fieldName5 => null, $fieldName6 => null, $fieldName7 => null, $fieldName8 => null, $fieldName9 =>null]);
            $securityDocs->save();
          }
        }
      }
      if (isset($input['mortagage_document_file'])) {
        $cnt = 0;
        foreach ($input['mortagage_document_file'] as $key => $file) {
          $cnt++;
          if ($cnt <= $maxSecurityDocumentCount) {
            if (isset($file)) {
              $originalFileName = $file->getClientOriginalName();
              $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'mortagage_document' . '-' . $originalFileName;
              $oldFileName = null;
              $fieldName = $key;
              if (!isset($uploadDetails)) {
                $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
              }
              if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
                $oldFileName = $uploadDetails->getAttribute($fieldName);
              }
              $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
              $uploadDetails->setAttribute($fieldName, $uploadedFileName);
            } else {
              if ($deletedQuestionHelper->isQuestionValid("F4")) {

              }
            }
          } else {
            break;
          }
        }
      }
      if (isset($input['hypothication_agreement_file'])) {
        $cnt = 0;
        foreach ($input['hypothication_agreement_file'] as $key => $file) {
          $cnt++;
          if ($cnt <= $maxSecurityDocumentCount) {
            if (isset($file)) {
              $originalFileName = $file->getClientOriginalName();
              $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'hypothication_agreement' . '-' . $originalFileName;
              $oldFileName = null;
              $fieldName = $key;
              if (!isset($uploadDetails)) {
                $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
              }
              if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
                $oldFileName = $uploadDetails->getAttribute($fieldName);
              }
              $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
              $uploadDetails->setAttribute($fieldName, $uploadedFileName);
            } else {
              if ($deletedQuestionHelper->isQuestionValid("F4")) {

              }
            }
          } else {
            break;
          }
        }
      }
      if (isset($input['escrow_agreement_file'])) {
        $cnt = 0;
        foreach ($input['escrow_agreement_file'] as $key => $file) {
          $cnt++;
          if ($cnt <= $maxSecurityDocumentCount) {
            if (isset($file)) {
              $originalFileName = $file->getClientOriginalName();
              $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'escrow_agreement' . '-' . $originalFileName;
              $oldFileName = null;
              $fieldName = $key;
              if (!isset($uploadDetails)) {
                $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
              }
              if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
                $oldFileName = $uploadDetails->getAttribute($fieldName);
              }
              $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
              $uploadDetails->setAttribute($fieldName, $uploadedFileName);
            } else {
              if ($deletedQuestionHelper->isQuestionValid("F4")) {

              }
            }
          } else {
            break;
          }
        }
      }
      if (isset($input['nach_agreement_file'])) {
        $cnt = 0;
        foreach ($input['nach_agreement_file'] as $key => $file) {
          $cnt++;
          if ($cnt <= $maxSecurityDocumentCount) {
            if (isset($file)) {
              $originalFileName = $file->getClientOriginalName();
              $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'nach_agreement' . '-' . $originalFileName;
              $oldFileName = null;
              $fieldName = $key;
              if (!isset($uploadDetails)) {
                $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
              }
              if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
                $oldFileName = $uploadDetails->getAttribute($fieldName);
              }
              $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
              $uploadDetails->setAttribute($fieldName, $uploadedFileName);
            } else {
              if ($deletedQuestionHelper->isQuestionValid("F4")) {

              }
            }
          } else {
            break;
          }
        }
      }
      if (isset($input['pdc_security_file'])) {
        $cnt = 0;
        foreach ($input['pdc_security_file'] as $key => $file) {
          $cnt++;
          if ($cnt <= $maxSecurityDocumentCount) {
            if (isset($file)) {
              $originalFileName = $file->getClientOriginalName();
              $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'pdc' . '-' . $originalFileName;
              $oldFileName = null;
              $fieldName = $key;
              if (!isset($uploadDetails)) {
                $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
              }
              if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
                $oldFileName = $uploadDetails->getAttribute($fieldName);
              }
              $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
              $uploadDetails->setAttribute($fieldName, $uploadedFileName);
            } else {
              if ($deletedQuestionHelper->isQuestionValid("F4")) {

              }
            }
          } else {
            break;
          }
        }
      }
      if (isset($input['pdc_covering_file'])) {
        $cnt = 0;
        foreach ($input['pdc_covering_file'] as $key => $file) {
          $cnt++;
          if ($cnt <= $maxSecurityDocumentCount) {
            if (isset($file)) {
              $originalFileName = $file->getClientOriginalName();
              $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'pdc_covering_letter' . '-' . $originalFileName;
              $oldFileName = null;
              $fieldName = $key;
              if (!isset($uploadDetails)) {
                $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
              }
              if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
                $oldFileName = $uploadDetails->getAttribute($fieldName);
              }
              $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
              $uploadDetails->setAttribute($fieldName, $uploadedFileName);
            } else {
              if ($deletedQuestionHelper->isQuestionValid("F4")) {

              }
            }
          } else {
            break;
          }
        }
      }
      if (isset($input['other1_security_file'])) {
        $cnt = 0;
        foreach ($input['other1_security_file'] as $key => $file) {
          $cnt++;
          if ($cnt <= $maxSecurityDocumentCount) {
            if (isset($file)) {
              $originalFileName = $file->getClientOriginalName();
              $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'other_security_doc1' . '-' . $originalFileName;
              $oldFileName = null;
              $fieldName = $key;
              if (!isset($uploadDetails)) {
                $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
              }
              if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
                $oldFileName = $uploadDetails->getAttribute($fieldName);
              }
              $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
              $uploadDetails->setAttribute($fieldName, $uploadedFileName);
            } else {
              if ($deletedQuestionHelper->isQuestionValid("F4")) {

              }
            }
          } else {
            break;
          }
        }
      }
      if (isset($input['other2_security_file'])) {
        $cnt = 0;
        foreach ($input['other2_security_file'] as $key => $file) {
          $cnt++;
          if ($cnt <= $maxSecurityDocumentCount) {
            if (isset($file)) {
              $originalFileName = $file->getClientOriginalName();
              $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'other_security_doc2' . '-' . $originalFileName;
              $oldFileName = null;
              $fieldName = $key;
              if (!isset($uploadDetails)) {
                $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
              }
              if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
                $oldFileName = $uploadDetails->getAttribute($fieldName);
              }
              $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
              $uploadDetails->setAttribute($fieldName, $uploadedFileName);
            } else {
              if ($deletedQuestionHelper->isQuestionValid("F4")) {

              }
            }
          } else {
            break;
          }
        }
      }
      if (isset($input['other3_security_file'])) {
        $cnt = 0;
        foreach ($input['other3_security_file'] as $key => $file) {
          $cnt++;
          if ($cnt <= $maxSecurityDocumentCount) {
            if (isset($file)) {
              $originalFileName = $file->getClientOriginalName();
              $uploadedFileName = $directory . '/' . 'loan_' . $loanId . '-' . 'other_security_doc3' . '-' . $originalFileName;
              $oldFileName = null;
              $fieldName = $key;
              if (!isset($uploadDetails)) {
                $uploadDetails = Upload::updateOrCreate(['loan_id' => $loanId], [$fieldName => $uploadedFileName]);
              }
              if (isset($uploadDetails) && $uploadDetails->__isset($fieldName)) {
                $oldFileName = $uploadDetails->getAttribute($fieldName);
              }
              $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
              $uploadDetails->setAttribute($fieldName, $uploadedFileName);
            } 


          } else {
            break;
          }
        }
      }
      if (isset($uploadDetails)) {
        $uploadDetails->save();
      }
    }
    $loan = null;
    if (isset($loanId)) {
      $loan = Loan::find($loanId);
    }

// $loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loan->id], ['loan_id' => $loanId, 'upload_documents' => 'Y']);
    $loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loan->id], ['loan_id' => $loanId, 'create_checklist' => 'Y']);
    $loansStatus = Loan::updateOrCreate(['id' => $loanId], ['id' => $loanId, 'status' => '24']);
    $loansStatus->save();
    $test=$this->getLoansStatus($loanId);


    $validator = Validator::make($fieldsArr, $rulesArr, $messagesArr);
    if ($validator->fails()) {
      return Redirect::back()->withErrors($validator)->withInput();
    } else {
      session()->flash('flash_message', 'checklist successfully uploaded!');
    }

    $loan = PraposalChecklists::updateOrCreate(['loan_id' => $loanId], [

   // 'moa' => @$input['moa'],
      // 'moa' => @$input['moa'],

    //kyc of business start here

     'moa_applicable1' => @$input['moa_applicable1'],
     'moa_document1' => @$input['moa_document1'],
     'moa_discrepancies1' => @$input['moa_discrepancies1'],
     'moa_remark1' => @$input['moa_remark1'],
   //'moa_attachment1' => @$input['moa_attachment1'],

     'cor_applicable1' => @$input['cor_applicable1'],
     'cor_document1' => @$input['cor_document1'],
     'cor_discrepancies1' => @$input['cor_discrepancies1'],
     'cor_remark1' => @$input['cor_remark1'],
   //'cor_attachment1' => @$input['cor_attachment1'],


     'pan_applicable1' => @$input['pan_applicable1'],
     'pan_document1' => @$input['pan_document1'],
     'pan_discrepancies1' => @$input['pan_discrepancies1'],
     'pan_remark1' => @$input['pan_remark1'],
   //'pan_attachment1' => @$input['pan_attachment1'],


     'shopcertificate_applicable1' => @$input['shopcertificate_applicable1'],
     'shopcertificate_document1' => @$input['shopcertificate_document1'],
     'shopcertificate_discrepancies1' => @$input['shopcertificate_discrepancies1'],
     'shopcertificate_remark1' => @$input['shopcertificate_remark1'],
   //'shopcertificate_attachment1' => @$input['shopcertificate_attachment1'],


     'gstcertificate_applicable1' => @$input['gstcertificate_applicable1'],
     'gstcertificate_document1' => @$input['gstcertificate_document1'],
     'gstcertificate_discrepancies1' => @$input['gstcertificate_discrepancies1'],
     'gstcertificate_remark1' => @$input['gstcertificate_remark1'],
   //'gstcertificate_attachment1' => @$input['gstcertificate_attachment1'],


     'ghumastalicence_applicable1' => @$input['ghumastalicence_applicable1'],
     'ghumastalicence_document1' => @$input['ghumastalicence_document1'],
     'ghumastalicence_discrepancies1' => @$input['ghumastalicence_discrepancies1'],
     'ghumastalicence_remark1' => @$input['ghumastalicence_remark1'],
   //'ghumastalicence_attachment1' => @$input['ghumastalicence_attachment1'],


     'rentagreement_applicable1' => @$input['rentagreement_applicable1'],
     'rentagreement_document1' => @$input['rentagreement_document1'],
     'rentagreement_discrepancies1' => @$input['rentagreement_discrepancies1'],
     'rentagreement_remark1' => @$input['rentagreement_remark1'],
   //'rentagreement_attachment1' => @$input['rentagreement_attachment1'],


     'udyogadhar_applicable1' => @$input['udyogadhar_applicable1'],
     'udyogadhar_document1' => @$input['udyogadhar_document1'],
     'udyogadhar_discrepancies1' => @$input['udyogadhar_discrepancies1'],
     'udyogadhar_remark1' => @$input['udyogadhar_remark1'],
   //'udyogadhar_attachment1' => @$input['udyogadhar_attachment1'],


     'electricitybill_applicable1' => @$input['electricitybill_applicable1'],
     'electricitybill_document1' => @$input['electricitybill_document1'],
     'electricitybill_discrepancies1' => @$input['electricitybill_discrepancies1'],
     'electricitybill_remark1' => @$input['electricitybill_remark1'],
   //'electricitybill_attachment1' => @$input['electricitybill_attachment1'],


     'cibilofentity_applicable1' => @$input['cibilofentity_applicable1'],
     'cibilofentity_document1' => @$input['cibilofentity_document1'],
     'cibilofentity_discrepancies1' => @$input['cibilofentity_discrepancies1'],
     'cibilofentity_remark1' => @$input['cibilofentity_remark1'],
   //'cibilofentity_attachment1' => @$input['cibilofentity_attachment1'],


     'other1_applicable1' => @$input['other1_applicable1'],
     'other1_document1' => @$input['other1_document1'],
     'other1_remarks' => @$input['other1_remarks'],

   //  //kyc of promoter start below
     'pan2_applicable1' => @$input['pan2_applicable1'],
     'pan2_document1' => @$input['pan2_document1'],
     'pan2_discrepancies1' => @$input['pan2_discrepancies1'],
     'pan2_remark2' => @$input['pan2_remark2'],
    //'pan2_attachment1' => @$input['pan2_attachment1'],

     'addressproof_applicable1' => @$input['addressproof_applicable1'],
     'addressproof_document1' => @$input['addressproof_document1'],
     'addressproof_discrepancies1' => @$input['addressproof_discrepancies1'],
     'addressproof_remark2' => @$input['addressproof_remark2'],
    //'addressproof_attachment1' => @$input['addressproof_attachment1'],

     'networthcertificate_applicable1' => @$input['networthcertificate_applicable1'],
     'networthcertificate_document1' => @$input['networthcertificate_document1'],
     'networthcertificate_discrepancies1' => @$input['networthcertificate_discrepancies1'],
     'networthcertificate_remark2' => @$input['networthcertificate_remark2'],
    //'networthcertificate_attachment1' => @$input['networthcertificate_attachment1'],

     'cibilofpromoter_applicable1' => @$input['cibilofpromoter_applicable1'],
     'cibilofpromoter_document1' => @$input['cibilofpromoter_document1'],
     'cibilofpromoter_discrepancies1' => @$input['cibilofpromoter_discrepancies1'],
     'cibilofpromoter_remark2' => @$input['cibilofpromoter_remark2'],
    //'cibilofpromoter_attachment1' => @$input['cibilofpromoter_attachment1'],

     'other2_applicable1' => @$input['other2_applicable1'],
     'other2_document1' => @$input['other2_document1'],
     'other2_remarks' => @$input['other2_remarks'],


   //  //kyc of loan documents

     'acceptedtermsheet_applicable1' => @$input['acceptedtermsheet_applicable1'],
     'acceptedtermsheet_document1' => @$input['acceptedtermsheet_document1'],
     'acceptedtermsheet_discrepancies1' => @$input['acceptedtermsheet_discrepancies1'],
     'acceptedtermsheet_remark3' => @$input['acceptedtermsheet_remark3'],

     'loanagreement_applicable1' => @$input['loanagreement_applicable1'],
     'loanagreement_document1' => @$input['loanagreement_document1'],
     'loanagreement_discrepancies1' => @$input['loanagreement_discrepancies1'],
     'loanagreement_remark3' => @$input['loanagreement_remark3'],

     'personalguarantee_applicable1' => @$input['personalguarantee_applicable1'],
     'personalguarantee_document1' => @$input['personalguarantee_document1'],
     'personalguarantee_discrepancies1' => @$input['personalguarantee_discrepancies1'],
     'personalguarantee_remark3' => @$input['personalguarantee_remark3'],

     'signatureverification_applicable1' => @$input['signatureverification_applicable1'],
     'signatureverification_document1' => @$input['signatureverification_document1'],
     'signatureverification_discrepancies1' => @$input['signatureverification_discrepancies1'],
     'signatureverification_remark3' => @$input['signatureverification_remark3'],

     'dpn_applicable1' => @$input['dpn_applicable1'],
     'dpn_document1' => @$input['dpn_document1'],
     'dpn_discrepancies1' => @$input['dpn_discrepancies1'],
     'dpn_remark3' => @$input['dpn_remark3'],

     'boardresolve_applicable1' => @$input['boardresolve_applicable1'],
     'boardresolve_document1' => @$input['boardresolve_document1'],
     'boardresolve_discrepancies1' => @$input['boardresolve_discrepancies1'],
     'boardresolve_remark3' => @$input['boardresolve_remark3'],
    // 'boardresolve_attachment1' => @$input['boardresolve_attachment1'],

     'other3_applicable1' => @$input['other3_applicable1'],
     'other3_document1' => @$input['other3_document1'],
     'other3_remarks' => @$input['other3_remarks'],

   //  //kyc of security start

     'mortgagedocument_applicable1' => @$input['mortgagedocument_applicable1'],
     'mortgagedocument_document1' => @$input['mortgagedocument_document1'],
     'mortgagedocument_discrepancies1' => @$input['mortgagedocument_discrepancies1'],
     'mortgagedocument_remark4' => @$input['mortgagedocument_remark4'],

     'hypothicationagreement_applicable1' => @$input['hypothicationagreement_applicable1'],
     'hypothicationagreement_document1' => @$input['hypothicationagreement_document1'],
     'hypothicationagreement_discrepancies1' => @$input['hypothicationagreement_discrepancies1'],
     'hypothicationagreement_remark4' => @$input['hypothicationagreement_remark4'],

     'escrowagreement_applicable1' => @$input['escrowagreement_applicable1'],
     'escrowagreement_document1' => @$input['escrowagreement_document1'],
     'escrowagreement_discrepancies1' => @$input['escrowagreement_discrepancies1'],
     'escrowagreement_remark4' => @$input['escrowagreement_remark4'],

     'nachagreement_applicable1' => @$input['nachagreement_applicable1'],
     'nachagreement_document1' => @$input['nachagreement_document1'],
     'nachagreement_discrepancies1' => @$input['nachagreement_discrepancies1'],
     'nachagreement_remark4' => @$input['nachagreement_remark4'],

     'pdc_applicable1' => @$input['pdc_applicable1'],
     'pdc_document1' => @$input['pdc_document1'],
     'pdc_discrepancies1' => @$input['pdc_discrepancies1'],
     'pdc_remark4' => @$input['pdc_remark4'],

     'pdccoveringletter_applicable1' => @$input['pdccoveringletter_applicable1'],
     'pdccoveringletter_document1' => @$input['pdccoveringletter_document1'],
     'pdccoveringletter_discrepancies1' => @$input['pdccoveringletter_discrepancies1'],
     'pdccoveringletter_remark4' => @$input['pdccoveringletter_remark4'],


     'other4_applicable1' => @$input['other4_applicable1'],
     'other4_document1' => @$input['other4_document1'],
     'other4_remarks' => @$input['other4_remarks'],


   ] );

  // $redirectUrl = $this->generateRedirectURL('loans/praposal/createchecklist', $endUseList, $loanType, $amount, $loanTenure, $companySharePledged, $bscNscCode, $loanId);

  // return Redirect::to($redirectUrl)->with('message', 'Checklist has beed successfully saved');

$redirectUrl = 'home';

// return Redirect::to($redirectUrl);

return Redirect::to($redirectUrl)->with('message', 'Checklist has beed successfully saved');
}


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

  $userType = MasterData::userType();
  $choosenUserType = null;
  $loan_tenure = MasterData::tenureYearList();
  $chosenLoanTenure = null;
  $loan_product = MasterData::loanProductType();

  $chosenLoanProduct = null;
  $end_use = MasterData::endUseList();
  $chosenEndUse = null;


  $loan = null;
  if (isset($loanId)) {
    $loan = Loan::find($loanId);

    $securityDetail = $loan->getSecurityDetails()->get()->first();
    if ($companySharePledged == null) {
      if (@$securityDetail->is_any_other_security == 1) {
        $displayNoneSecurity = $securityDetail->is_any_other_security;
      }
    }
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
  //new

  $test = UserProfile::with('user')->find($userPr->id);

  @$repaymentMaster=LoanRepayments::where('loan_id', '=', $loanId)->first();


  @$repaymentDetails=LoanRepaymentsDetails::where('loan_id', '=', $loanId)->get();
  


  $subViewType = 'loans._repayment';
  $formaction = 'Loans\LoansController@postRepayment';
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
    'userPr',
    'promoter_proof_address_file',
    'removeMandatory',
    'model',
    'mandatoryField',
    'setDisable',
    'loan_product',
    'chosenLoanProduct',
    'repaymentMaster',
    'repaymentDetails'
  ));
}



  /**
   * Save 
   * @param Request $request
   *
   * @return Response
   */


  public function postRepayment(Request $request)
  {
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
    $date = Carbon::now()->format('Y-m-d');

    @$repaymentMaster=LoanRepayments::where('loan_id', '=', $loanId)->first();
    @$repaymentDetails=LoanRepaymentsDetails::where('loan_id', '=', $loanId)->get();
      //Count(Date-loandis+1)
    $dateEmiStart=Carbon::parse($repaymentMaster->emiStartDate);
    $loanDisD=Carbon::parse($repaymentMaster->loanDisDate);

    
    $noOfDays = $dateEmiStart->diffInDays($loanDisD)+1;



    $principal = $repaymentMaster->principal;
    $interest = $repaymentMaster->interest;
    $tds = $input['tds']; //TDS in %
    $interestdue = ($noOfDays * $principal * $interest)/36500 ; 
    $tdsAmt = ($input['tds'] * $interestdue) /100 ; //4340
    $netInterest = $interestdue - $tdsAmt;
    $netAmountDue = $interestdue - 0 - $tdsAmt;
    $totalDue = $interestdue - 0 - $tdsAmt;
    $arrears = $totalDue - $input['receipt'];
    $penalInterest = 0;
    $principleDue = 0;
    $cumIntEarned = round($penalInterest) + round($interestdue);
    $loanOutstanding = $input['principal'] - $principleDue - ( $input['receipt'] - $totalDue );
    $ts=1;
    if(!isset($repaymentMaster)){
      DB::table('loan_repayment_master')->insert([
        'loan_id' => '10350',
        'TypeofLoan' => $input['TypeofLoan'],
        'principal' => $input['principal'],
        'interest' => $input['interest'],
        'tenor' => $input['tenor'],
        'loanDisDate' => $input['loanDisDate'],
        'TypeofRepayment' => $input['TypeofRepayment'],
        'emiStartDate' => $input['emiStartDate'],
        'loan_amount' => $input['loan_amount'],
        'moratorium' => $input['moratorium'],
        'tds' => $input['tds'],
        'penalRate' => $input['penalRate'],
        'status' => "1"
      ]);
    }else if(!isset($repaymentDetails)){
echo "add first record";
    /* $loan = LoanRepaymentsDetails::updateOrCreate(['loan_id' => $loanId], [
       //$deatilsData =array (

       'date' => @$input['date'],
       'noOfDays' => @$noOfDays,
       'month'=>'1',
       'chequeNo' => @$input['chequeNo'],
       'loanOutstanding' => round(@$loanOutstanding),
       
       'intersetDue' => round(@$interestdue),
       'principalDue' => round(@$principleDue),
       'tds' => round(@$tdsAmt),
       'netInterest' => round(@$netInterest),
       'netAmountDue' => round(@$netAmountDue),
       'totalDue' => round(@$totalDue),
       'receipt' => round(@$input['receipt']),
       'arrears' => round(@$arrears),
       'penalInterest' => round(@$penalInterest),
       'cumIntEarned' => round(@$cumIntEarned)
     ]);*/
 

   }else{
    @$repaymentDetails=LoanRepaymentsDetails::where('loan_id', '=', $loanId)->orderBy('month', 'DESC')->first();
    $first=Carbon::parse($input['date']);
    $second=Carbon::parse($repaymentDetails->date);
    $odays = $first->diffInDays($second);

    $interestdue2 = ( $odays * $repaymentDetails->loanOutstanding * $interest )/36500 ; 
    $tdsAmt2 = ( $input['tds'] * $interestdue2 ) / 100 ; 
    $netInterest2 =  $interestdue2 - $tdsAmt2 ;  
    $penalInterest2 =  ( $repaymentDetails->arrears * $repaymentMaster->penalRate * $odays ) / 36500 ; 
    $netAmountDue2 =  ( $interestdue2 + $repaymentDetails->principalDue - $tdsAmt2 + $penalInterest2 + $repaymentDetails->arrears );
    $totalDue2 =   $netAmountDue2 - $repaymentDetails->arrears; 
    $arrears2 =   $totalDue2 - $input['receipt']; 
    $cumIntEarned2 = round($penalInterest2) + round($interestdue2);
    $loanOutstanding = $input['principal'] - $repaymentDetails->arrears - ( $input['receipt'] - $totalDue2 );
     $second = LoanRepaymentsDetails::updateOrCreate(['loan_id' => $loanId], [
       //$deatilsData =array (

       'date' => @$input['date'],
       'noOfDays' => @$noOfDays,
       'month'=>$repaymentDetails->month+1,
       'chequeNo' => @$input['chequeNo'],
       'loanOutstanding' => round(@$loanOutstanding),
       
       'intersetDue' => round(@$interestdue),
       'principalDue' => round(@$principleDue),
       'tds' => round(@$tdsAmt),
       'netInterest' => round(@$netInterest),
       'netAmountDue' => round(@$netAmountDue),
       'totalDue' => round(@$totalDue),
       'receipt' => round(@$input['receipt']),
       'arrears' => round(@$arrears),
       'penalInterest' => round(@$penalInterest),
       'cumIntEarned' => round(@$cumIntEarned)
     ]);
echo "<pre>";
print_r($second);
echo "</pre>";


    /*
    Penal Interest=(4000*24*30)/36500
    */

  }
  die();

  $validator = Validator::make($fieldsArr, $rulesArr, $messagesArr);
  if ($validator->fails()) {
    return Redirect::back()->withErrors($validator)->withInput();
  } else {
    session()->flash('flash_message', 'Loan Repayment successfully uploaded!');
  }



  $redirectUrl = 'home';
  // return Redirect::to($redirectUrl);
/*     $loansStatus = LoansStatus::updateOrCreate(['loan_id' => $loan->id], ['loan_id' => $loanId, 'loan_repayment' => 'Y']);
     $loansStatus->save();
     $this->getLoansStatus($loanId);*/

     return Redirect::to($redirectUrl)->with('message', 'Loan Repayment has beed successfully saved');
   }




 }


