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

use App\Models\Loan\FinancialData\Ratio;
use Auth;
use PDF;


/**
 * Class PrintController
 *
 * @package App\Http\Controllers\Pdf
 */
class PrintController extends controller{

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

                $CPUser = User::find($referredUserID);
                $CPUserProfile = UserProfile::find($referredUserID);
//        dd($CPUser,$CPUserProfile);

                if(isset($CPUserProfile)) {
                    $adv_name = $CPUserProfile->name_of_firm;
                    $adv_mobile = $CPUserProfile->contact1;
                }

                if(isset($CPUser)) {
                    $adv_pan = $CPUser->username;
                    $adv_email = $CPUser->email;
                }
//      End of For Profile & Loan Details tab

                if(isset($user)){
                    if($user->isCA()){
                        $setDisable = 'disabled';
                    }
                }

                if(!isset($loanId) && $loanId == null)
                {
                    $comYourSalestype = null;
                }
                else
                {
                    $choosenSales = $loan->com_your_salestoa;
                    $comYourSalestype = $loan->com_your_salestype;
                    if(isset($comYourSalestype) && $comYourSalestype == 'Export' || $comYourSalestype == 'Both')
                    {
                        $comAnnualValueExport = $loan->com_annual_value_exports;
                    }
                    else{
                        $comAnnualValueExport = null;
                    }
    //dd($comYourSalestype,$comAnnualValueExport);
                }
                if (isset($loanId)) {
                    $loan = Loan::find($loanId);
                    $LoanAgainstShare = $loan->getLoanAgainstShare($loanId);

                    $model = $loan->getPromoterDetails()->get()->first();
                    $salesAreaDetailId = $loan->id;
                    if(isset($salesAreaDetailId)){
                        $salesAreaDetails = SalesAreaDetails::where('loan_id', '=', $salesAreaDetailId)->first();
                    }
                    $promoterPropertyDetailId = $loan->id;
                    if(isset($promoterPropertyDetailId)){
                        $promoterPropertyDetails = PromoterPropertyDetail::where('loan_id', '=', $promoterPropertyDetailId)->first();
                    }
                }
                if(isset($model))
                {
                    $educationDegree = $model->othr_eduprofdegree;
                    $promotersAre = $model->othr_promoterare;
                }

//        $promoterKycDetail = $loan->getPromoterKycDetails()->get()->all();
                $promoterKycDetail = PromoterKycDetails::where('loan_id', '=', $loanId)->get();
                $maxPromoters = Config::get('constants.CONST_MAX_PROMOTER');
                $count = count($promoterKycDetail);
                $temp_array = array();
                for($i = 0; $i < 5; $i++) {
                    if($i < $count) {
                        array_push($temp_array, $promoterKycDetail[$i]->toArray());
                    } else {
                        array_push($temp_array,"");
                    }
                }

                $existingPropertyOwned = PromoterPropertyDetail::where('loan_id', '=', $loanId)->get();
                $countPropertyOwned = count($existingPropertyOwned);
//        dd($loanId,$model,$salesAreaDetails);

                $bl_details = array();
                $pl_details = array();
                $existingloan_details = array();

                $bl_details = BalanceSheetDetail::where('loan_id', '=', $loanId)->get();
                $pl_details = ProfitLossDetail::where('loan_id', '=', $loanId)->get();
                $existingloan_details = ExistingLoanDetail::where('loan_id', '=', $loanId)->get();
                $countLoanDetails = count($existingloan_details);
//        dd($bl_details,$pl_details,$existingloan_details);

                $modelType=Config::get('constants.CONST_ANALYST_MODEL_TYPE_CREDIT');
                $modelTypeCol=Config::get('constants.CONST_ANALYST_MODEL_TYPE_COLLATERAL');

//For Security details Tab.
                $endUseList = $loan->end_use;
//        dd($endUseList);
                $validLoanHelper = new validLoanUrlhelper();
                $isHideShowReceivableDiscount = $validLoanHelper->securityTabHideShow($endUseList);
                $paymentTermsType = MasterData::paymentTermsType();
                $choosenPaymentTermsType = null;
                $maxPaymentTerms = Config::get('constants.CONST_MAX_PAYMENT_TERMS');
                $maxReceivableDiscount = Config::get('constants.CONST_MAX_RECEIVABLE_DISCOUNT');
                $buyer_details = BuyerDetail::where('loan_id', '=', $loanId)->get();
                $securityDetailId = $loan->id;
                if(isset($securityDetailId)){
                    $securityDetails = SecurityDetail::where('loan_id', '=', $securityDetailId)->first();
                }
                if(isset($securityDetails))
                {
                    $sourcedType = $securityDetails->sourced_type;
                    $equipmentType = $securityDetails->equipment_type;
                    $isCollateralProperty = $securityDetails->is_collateral_property;
                }
        // End of Security Details tab

        //For Input balance sheet tab.
                if (isset($loanId)) {
                    $loan = Loan::find($loanId);

                    $loanType = $loan->type;
                    $endUseList = $loan->end_use;
                    $amount = $loan->loan_amount;
                    $loanTenure = $loan->loan_tenure;
                    $companySharePledged = $loan->companySharePledged;
                    $bscNscCode = $loan->bscNscCode;

                    $userId = $loan->user_id;
                    $userProfile = UserProfile::where('user_id','=', $userId)->get()->first();
                    $analystFinalScore = AnalystModelRating::where('loan_id','=',$loanId)->where('model_type','=','Credit')->get()->first();
                    $analystcollatralScore = AnalystModelRating::where('loan_id','=',$loanId)->where('model_type','=','Collateral')->get()->first();
                    $analystcollatralScoreProperty = AnalystModelRating::where('loan_id','=',$loanId)->where('model_type','=','Collateral')->get();

                    $ratingModel = AnalystModelRating::with('ratingDetails')->where('model_type','=',$modelType)->where('loan_id','=',$loanId)->get()->first();
                    $ratingModelCol = AnalystModelRating::with('ratingDetails')->where('model_type','=',$modelTypeCol)->where('loan_id','=',$loanId)->get()->first();

                }

                $groupType = Config::get('constants.CONST_FIN_GROUP_TYPE_BS');
                $financialGroups = FinancialGroup::with('financialEntries')->where('type','=',$groupType)->where('status','=', 1)->orderBy('sortOrder')->get();
//        dd($groupType,$financialGroups);
                $financialDataRecords = BalanceSheet::where('loan_id','=',$loanId)->get();
        //dd($financialDataRecords);
                if(isset($financialDataRecords) && $financialDataRecords != null){
                    $financialDataRecordsID = array_pluck($financialDataRecords, 'loan_id');


                }else{
                    $financialDataRecordsID = null;
                }
                $financialDataMap = new Collection();

                foreach($financialDataRecords as $financialData){
                    $financialDataMap->offsetSet($financialData->period, $financialData);
                }

                $helper = new ExpressionHelper($loanId);
                $financialDataExpressionsMap = $helper->calculateBalanceSheetFormulae();
       // dd( $financialDataExpressionsMap);
//        End of input balance sheet tab.

//        For Input P & L tab.
                $groupTypePL = Config::get('constants.CONST_FIN_GROUP_TYPE_PL');
                $financialGroupsPL = FinancialGroup::with('financialEntries')->where('type','=',$groupTypePL)->where('status','=', 1)->orderBy('sortOrder')->get();

                $financialDataRecordsPL = ProfitLoss::where('loan_id','=',$loanId)->get();
                if(isset($financialDataRecordsPL) && $financialDataRecordsPL != null){
                    $financialDataRecordsPLID = array_pluck($financialDataRecordsPL, 'loan_id');
                }else{
                    $financialDataRecordsPLID = null;
                }
                $financialDataMapPL = new Collection();
//        dd($groupTypePL,$financialGroupsPL,$financialDataRecordsPL);

                foreach($financialDataRecordsPL as $financialData){
                    $financialDataMap->offsetSet($financialData->period, $financialData);
                }
                $helper = new ExpressionHelper($loanId);
                $financialDataExpressionsMapPL = $helper->calculateProfitLossFormulae();
                $financialDataExpressionsMapPL->offsetExists('$blyear');
        //dd($financialDataExpressionsMapPL);//
//        End of input P & L tab.

//        For Calculated Ratios tab.
                $groupTypeCal = Config::get('constants.CONST_FIN_GROUP_TYPE_RATIO');
                $financialGroupsCal = FinancialGroup::with('financialEntries')->where('type','=',$groupTypeCal)->where('status','=', 1)->orderBy('sortOrder')->get();

                $financialDataMapCal = new Collection();
                $showFormulaText = true;

                foreach($financialDataRecordsPL as $financialData){
                    $financialDataMap->offsetSet($financialData->period, $financialData);
                }
                $helper = new ExpressionHelper($loanId);
                $financialDataExpressionsMapCal = $helper->calculateRatios();
//        End of Calculated Ratios tab.

//        For Credit Model tab.
                $creditRatingPointsList = new Collection(array_flip(MasterData::creditRatingPoints()));
                $analystModelsCategoriesList = AnalystModelCategory::with('dimensions','dimensions.measures')->where('type','=',$modelType)->where('status','=',1)->get();
                $yesNoOptions = MasterData::yesNoTypes(false);

                if(isset($ratingModel)){
                    foreach($ratingModel->ratingDetails as $ratingDetail){
                        foreach($analystModelsCategoriesList as $category){
                            if($category->mergeRecord($ratingDetail)){
                                break;
                            }
                        }
                    }
        }else{//New Credit Model Being Saved
            $maxFY = MasterData::maxFY();
            $ratiosList = Ratio::where('loan_id','=',$loanId)->where('period','=',$maxFY)->get();
            $ratiosByRatioIdList = $ratiosList->keyBy('ratio_id');
            if(isset($ratiosByRatioIdList) && $ratiosByRatioIdList->count() > 0){
                foreach($analystModelsCategoriesList as $category){
                    $category->autoCalculateRatioMeasures($ratiosByRatioIdList);
                }
            }
        }
//        End of Credit Model tab.

        //Liquidity Model
        $modelType = Config::get('constants.CONST_LIQUIDITY_MODEL_TYPE_CREDIT');
        //$liquidityModelsCategoriesList = LiquidityModelCategory::with('dimensions','dimensions.measures')->where('type','=',$modelType)->where('status','=',1)->get();
        $liquidityModelsCategoriesList = LiquidityModelCategory::with('dimensions', 'dimensions.measures')->where('type', '=', $modelType)->where('status', '=', 1)->get();
      // dd($liquidityModelsCategoriesList);

        $yesNoOptions = MasterData::yesNoTypes(false);

        if(isset($ratingModel)){
            foreach($ratingModel->ratingDetails as $ratingDetail){
                foreach($liquidityModelsCategoriesList as $category){
                    if($category->mergeRecord($ratingDetail)){
                        break;
                    }
                }
            }
        }else{ //New Credit Model Being Saved
            $maxFY = MasterData::maxFY();
            $ratiosList = Ratio::where('loan_id','=',$loanId)->where('period','=',$maxFY)->get();
            $ratiosByRatioIdList = $ratiosList->keyBy('ratio_id');
            if(isset($ratiosByRatioIdList) && $ratiosByRatioIdList->count() > 0){
                foreach($liquidityModelsCategoriesList as $category){
                    $category->autoCalculateRatioMeasures($ratiosByRatioIdList);
                }
            }
        }
        //End of Liquidity model

        //        For Collateral Model tab.
        $analystModelsCategoriesListCol = AnalystModelCategory::with('dimensions','dimensions.measures')->where('type','=',$modelTypeCol)->where('status','=',1)->get();
        $defectTypes = MasterData::collateralDefectTypes();

        if(isset($ratingModelCol)){
            foreach($ratingModelCol->ratingDetails as $ratingDetail){
                foreach($analystModelsCategoriesListCol as $category){
                    if($category->mergeRecord($ratingDetail)){
                        break;
                    }
                }
            }
        }
        //        dd($modelTypeCol,$ratingModelCol,$ratingModel,$analystModelsCategoriesListCol);
        //        End of Collateral Model tab.
        /*temp*/
        /*Liquidity Test Model*/
        $cashflowInitial = CashFlowInitial::where('loan_id', '=', $loanId)->first();
        $srcFundschk = SrcOfFundsData::where('loan_id', '=', $loanId)->first();
        if(isset($srcFundschk)){
          for ($i=0; $i < 11; $i++) {
            $srcFunds[] = DB::table('src_of_funds_data')
            ->where('loan_id', '=', $loanId)
            ->where('src_id', '=', $i)
            ->get();
        }

        $usesFundschk = UsesOfFundsData::where('loan_id', '=', $loanId)->first();
        $SrcTotal = SrcTotal::where('loan_id', '=', $loanId)->first();
        $usesTotal = UsesTotal::where('loan_id', '=', $loanId)->first();
        $openingSrcUse = OpeningSrcUse::where('loan_id', '=', $loanId)->first();
        $surplusSrcUses = SurplusSrcUses::where('loan_id', '=', $loanId)->first();
        $closingSrcUses = ClosingSrcUses::where('loan_id', '=', $loanId)->first();
        $cashCriteria = CashCriteria::where('loan_id', '=', $loanId)->first();
        if(isset($usesFundschk)){
          for ($i=0; $i < 19; $i++) {
            $dataFunds[] = DB::table('uses_of_funds_data')
            ->where('loan_id', '=', $loanId)
            ->where('uses_id', '=', $i)
            ->get();
        }
    }
    $period_name= $cashflowInitial->period_name;
    $no_of_period= $cashflowInitial->no_of_period;
    $opening_cash_balance= $cashflowInitial->opening_cash_balance;
}
$srcOfFunds=SrcOfFund::all()->pluck('name');
$useOfFund=UseOfFund::all()->pluck('name');



     /*   $bl_year = $this->setFinancialYears();
     unset($bl_year[last($bl_year)]);*/
     $groupTypeCF = Config::get('constants.CONST_FIN_GROUP_TYPE_CF');
     $financialGroupsCF = FinancialGroup::with('financialEntries')->where('type', '=', $groupTypeCF)->where('status', '=', 1)->orderBy('sortOrder')->get();
     $helper = new ExpressionHelper($loanId);
     $financialDataExpressionsMapCF = $helper->calculateCashflows();
     $financialDataMapCF = new Collection();
     $showFormulaText = true;
     /*tem above*/

     $deletedQuestionsLoan = $this->getDeletedQuestionLoan($loan, $loanType, $amount);
     $deletedQuestionHelper = new DeletedQuestionsHelper($deletedQuestionsLoan);
     $pdfFileName = 'Loan -' .$loanId . '.pdf';


       // echo  $companySharePledged;
     $paramsArr = compact('loan','loanId','loanType','endUseList','amount','loanTenure','deletedQuestionHelper','setDisable','loan_product',
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
         'srcFunds','cashflowInitial','cashCriteria','analystcollatralScoreProperty','SrcTotal','openingSrcUse','surplusSrcUses','closingSrcUses','usesTotal','dataFunds','loan', 'cashflowInitial','srcOfFunds','useOfFund');

 //return PDF::loadView('reports.full_loan_report', $paramsArr)->download($pdfFileName);
   return view('reports.full_loan_report', $paramsArr);
  //return view('reports.full_loan_report',$paramsArr);
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
