<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Loan\Loan;
use Illuminate\Http\Request;
use App\Models\MasterData;
use DB;
use App\Helpers\validLoanUrlhelper;

use Illuminate\Support\Facades\Input;

use App\Models\Business;
use App\Models\Loan\BalanceSheetDetail;
use App\Models\Loan\ExistingLoanDetail;
use App\Models\Loan\ProfitLossDetail;
use App\Models\Loan\PromoterPropertyDetail;
use App\Models\LoanPromoterKycdtls;
use App\Models\CompanyPosition;

use App\Models\Loan\PromoterKycDetails;
use App\Models\Loan\SalesAreaDetails;

use Illuminate\Support\Facades\Config;
use App\Models\Loan\SecurityDetail;
use App\Models\Loan\BuyerDetail;
use App\Models\PropertyDetails;
use App\Models\ThirdPartyDetails;
use App\Helpers\DeletedQuestionsHelper;

use App\Models\Loan\FinancialData\BalanceSheet;
use App\Models\Loan\FinancialData\FinancialGroup;
use Illuminate\Database\Eloquent\Collection;
use App\Helpers\ExpressionHelper;

use App\Models\Loan\FinancialData\ProfitLoss;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\Loan\AnalystModel\AnalystModelRating;
use App\Models\Loan\AnalystModel\AnalystModelCategory;

use App\Models\Loan\LiquidityModel\LiquidityModelCategory;
use App\Models\Loan\LiquidityModel\LiquidityModelRating;
use App\Models\Loan\LiquidityModel\LiquidityModelRatingDetails;
use App\Models\Loan\FinancialData\Cashflow;
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
use App\Models\Loan\PraposalKeyloanterms;
use App\Models\Loan\FinancialData\Ratio;
use Auth;
use PDF;
use App\Models\Loan\PraposalBackground;
use App\Models\Loan\PraposalDetails;
use App\Models\Loan\PraposalChecklists;
use App\Models\Loan\PromoterDetails;
/**
 * Class PrintController
 *
 * @package App\Http\Controllers\Pdf
 */
class PraposalprintController extends controller{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex($loanId = null){

        $loan = null;
        $loanType = null;
        $model = null;
        $amount = null;
        $setDisable = null;
        $existingPromoterKycCount = 0;
        $existingPropertyOwned =null;
       // $bl_year = MasterData::BalanceSheet_FY();
        $bl_year = $this->setFinancialYears();
        //$bl_year = MasterData::BalanceSheet_FY();
             /*   echo "<pre>";
                print_r( $bl_year);
                echo "</pre>";*/

                $companyPositionTypes = MasterData::companyPositionTypes();
                $loan_product= MasterData::loanProductType();
                $entityTypes = MasterData::entityTypes();
                $promoterBackground = MasterData::degreeTypes();
                $userType = MasterData::userType();
                $industryTypes = MasterData::industryTypes(false);
                $businessVintage = MasterData::businessVintage();
                $chosenLoanProduct =null;

                $loanId = Input::get('id');
                $loan = Loan::find($loanId);
                $user = Auth::user();
//        dd($loanId,$loan,$user);

//        For Profile & Loan Details tab
                $userID = $loan->user_id;
                $referredUserID = $loan->referredby_userid;
                $user = User::find($userID);

        //$userPr = UserProfile::find('user_id',$userID);

                $userPr = UserProfile::where('user_id', '=', $userID)->first();
                $userProfile = UserProfile::with('user')->find($userPr->id);
//        dd($user,$userID,$referredUserID);

                $firm_pan = $user->username;
                $owner_email = $user->email;
        //dd($userProfile);
                if(isset($userProfile)) {
                    $chosenEntity = $userProfile->owner_entity_type;
                    $chosenCity = $userProfile->owner_city;
                    $chosenState = $userProfile->owner_state;
                    $name_of_firm = $userProfile->name_of_firm;
                    $owner_name = $userProfile->owner_name;
                    $address = $userProfile->address;
                    $pincode = $userProfile->pincode;
                    $contact1= $userProfile->contact1;
                    $contact2 = $userProfile->contact2;
                    $latest_turnover = $userProfile->latest_turnover;
                }

                if (isset($loanId)) {
                  $loan = Loan::find($loanId);
                  $loanUser = User::find($loan->user_id);
                  $loanUserProfile = $loanUser->userProfile();
                  $existingPromoterKycDetails = PromoterKycDetails::where('loan_id', '=', $loanId)->get();
                  $praposalBackground = PraposalBackground::where('loan_id', '=', $loanId)->first();
                  $praposalDetails=PraposalDetails::where('loan_id', '=', $loanId)->first();
                     @$praposalChecklist=PraposalChecklists::where('loan_id', '=', $loanId)->first();
                     @$promoterDetails=PromoterDetails::where('loan_id', '=', $loanId)->first();
                     $financialDataRecords = BalanceSheet::where('loan_id', '=', $loanId)->get();

              }
              $userPr = UserProfile::where('user_id', '=', $userID);
              if (isset($loan->user_id)) {
                  $userPr = UserProfile::where('user_id', '=', $loan->user_id)->first();
                  $userProfileFirm = UserProfile::with('user')->find($userPr->id);
              } else {
                  $userProfileFirm = UserProfile::with('user')->find($userID);
              }





             //  $bl_year = $this->setFinancialYears();

        $blyear = $this->setFinancialYears();
     unset($blyear[last($blyear)]);
     $groupTypeCF = Config::get('constants.CONST_FIN_GROUP_TYPE_CF');
     $financialGroupsCF = FinancialGroup::with('financialEntries')->where('type', '=', $groupTypeCF)->where('status', '=', 1)->orderBy('sortOrder')->get();
     $helper = new ExpressionHelper($loanId);
     $financialDataExpressionsMapCF = $helper->calculateCashflows();
     $financialDataMapCF = new Collection();
     $showFormulaText = true;

     $ratios = Ratio::where('loan_id', '=', $loanId)->get();
     $financialProfitLoss = ProfitLoss::where('loan_id', '=', $loanId)->get();
     $test = Cashflow::where('loan_id', '=', $loanId)->get();
     $fromCashflowTable = Cashflow::periodsCashflowIdMap($loanId);
     /*tem above*/
     $keyloanterm=PraposalKeyloanterms::where('loan_id', '=', $loanId)->first();
       
         
     $deletedQuestionsLoan = $this->getDeletedQuestionLoan($loan, $loanType, $amount);
     $deletedQuestionHelper = new DeletedQuestionsHelper($deletedQuestionsLoan);
     $pdfFileName = 'Loan -' .$loanId . '.pdf';


       // echo  $companySharePledged;
     $paramsArr = compact('loan','loanId','loanType','entityTypes','endUseList','amount','loanTenure','deletedQuestionHelper','setDisable','loan_product',
        'comYourSalestype','analystFinalScore','analystcollatralScore','comAnnualValueExport','salesAreaDetails','temp_array','existingPropertyOwned','model','bl_year','chosenLoanProduct',
        'existingloan_details','companyPositionTypes','promoterPropertyDetails','bl_details','pl_details','choosenSales','maxPromoters',
        'temp_array','count','existingPropertyOwned','countPropertyOwned','countLoanDetails','financialGroups','groupType',
        'financialDataExpressionsMap','groupTypeCF','financialDataExpressionsMapCF','financialDataMapCF','financialGroupsCF','financialDataMap','financialDataRecords','groupTypePL','financialGroupsPL','financialDataExpressionsMapPL',
        'financialDataRecordsPL','financialDataMapPL','financialGroupsCal','financialDataMapCal','showFormulaText','financialDataExpressionsMapCal',
        'userProfile','ratingModel','analystModelsCategoriesList','liquidityModelsCategoriesList','yesNoOptions','analystModelsCategoriesListCol','liquidityModelsCategoriesListCol','defectTypes','ratingModelCol',
        'firm_pan','chosenEntity','owner_email','chosenState','contact1','contact2','chosenCity','name_of_firm','owner_name','pincode',
        'address','latest_turnover','referredUserID','adv_pan','adv_email','adv_name','adv_mobile','validLoanHelper','isHideShowReceivableDiscount',
        'maxPaymentTerms','maxReceivableDiscount','paymentTermsType','choosenPaymentTermsType','buyer_details','sourcedType','equipmentType',
        'isCollateralProperty','financialDataRecordsID','creditRatingPointsList','financialDataRecordsPLID','educationDegree','promotersAre','LoanAgainstShare','companySharePledged','bscNscCode',
        'srcFunds','cashflowInitial','cashCriteria','analystcollatralScoreProperty','SrcTotal','openingSrcUse','surplusSrcUses','closingSrcUses','usesTotal','dataFunds','loan', 'cashflowInitial','srcOfFunds','useOfFund',
        'amount',   'praposedAmount',  'financialDataRecords',   'finalAmount',     'loanTenure',      'existingTenor' ,       'praposedTenor' ,        'totalTenor' ,    'existingInterestRate' ,  'praposedInterestRate' ,
        'totalInterestRate','maxCompanyDetails', 'existingPromoterKycDetails', 'mobileEntityType', 'existingCompanyDeails', 'existingCompanyDeailsCount', 'newCompanyDeailsNum',
        'industryTypes', 'praposalBackground', 'setDisable','mobileAppData','com_industry_segment','deletedQuestionHelper','cities','states',  'validLoanHelper',
        'removeMandatory', 'businessVintage','userProfile',  'businessType', 'mobileAppDataID',  'userProfileFirm',  'mobileKeyProduct',   'mobileFirmRegNo','loanUserProfile',
        'othr_eduprofdegree','degreeType','praposalDetails', 'comAnnualValueExport' ,'promoterBackground','financialProfitLoss','blyear','ratios','fromCashflowTable',
        'praposalChecklist','promoterDetails','keyloanterm');

    return PDF::loadView('reports.praposal_loan_report', $paramsArr)->download($pdfFileName);
   return view('reports.praposal_loan_report', $paramsArr);
    // return view('reports.praposal_loan_report',$paramsArr);
 }

//================================
 public function setFinancialYears() {
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


public function dummyDateMK() {
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


protected function getDeletedQuestionLoan($loan, $loanType, $amount)
{
    $deletedQuestionsLoan = null;
    if (isset($loan)) {
        $deletedQuestionsLoan = $loan;
    } else {
        $user = Auth::user();

        if ($user->isSME()) {
            $deletedQuestionsLoan = new Loan();
            $userProfile = $user->userProfile();
            if(isset($userProfile) && isset($userProfile->latest_turnover)) {
                $turnover = $userProfile->latest_turnover;
                $deletedQuestionsLoan->turnover = $turnover;
            }
            $deletedQuestionsLoan->type = $loanType;
            $deletedQuestionsLoan->loan_amount = $amount;
        }
        return $deletedQuestionsLoan;
    }
}

}
