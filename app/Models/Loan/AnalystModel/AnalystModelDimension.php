<?php

namespace App\Models\Loan\AnalystModel;

use App\Models\Common\ConfigurableParameter;
use App\Models\Common\OperandComparison;
use App\Models\Loan\FinancialData\ProfitLoss;
use App\Models\Loan\FinancialData\Ratio;
use App\Models\Loan\FinancialData\BalanceSheet;
use App\Models\Loan\FinancialData\Cashflow;
use App\Models\Loan\Loan;
use App\Models\Loan\PromoterDetails;
use App\Models\Common\ConfIndustryTypeSectorOutlookMapping;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use App\Models\Loan\LoanAgainstShare;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;
use Log;

class AnalystModelDimension extends Model {

	use OperandComparison;

	public $table = "analyst_model_dimensions";

	public $selected_rating_details_id;
	public $selected_measure_id;

	protected $fillable = [
		'category_id',
		'parent_dimension_id',
		'ratio_id',
		'dimension_type',
		'label',
		'description',
		'weight',
		'is_applicable',
		'is_trend',
		'model',
		'attribute',
		'status'
	];

	public function category(){
		return $this->belongsTo('App\Models\Loan\AnalystModel\AnalystModelCategory','category_id','id')->where('status','=','1');
	}

	public function parentDimension(){
		return $this->belongsTo('App\Models\Loan\AnalystModel\AnalystModelDimension','parent_dimension_id','id')->where('status','=','1');
	}

	public function measures(){
		return $this->hasMany('App\Models\Loan\AnalystModel\AnalystModelMeasure','dimension_id','id')->where('status','=','1');
	}

	public function isParent(){
		$isParent = false;
		if($this->dimension_type == 1){
			$isParent = true;
		}
		return $isParent;
	}

	private static function fetchAnalystModelDimension($keyName, $addEmptyFirstElement=true){


		$cacheTimeout = Config::get('constants.MD_CACHE_TIMEOUT');
		$dimensionData = null;
		Cache::forget($keyName);

		if(Cache::has($keyName)){
			$dimensionData = Cache::get($keyName);
		}else{
			$dimensionData = AnalystModelDimension::where('label', "=", $keyName)->lists('label','weight')->all();
			if($addEmptyFirstElement) {
				$dimensionData = array(NULL => '') + $dimensionData;
			}
			Cache::put($keyName, $dimensionData, $cacheTimeout);
		}
		return $dimensionData;
	}

	public function hasRatio(){
		return isset($this->ratio_id);
	}

	public function hasTrend(){

		return isset($this->is_trend) && $this->is_trend == true && isset($this->model) && isset($this->attribute);
	}

	public function calculateTrend($loan){
		if(!$this->hasTrend()){
			return;
		}

		$modelList = null;
		if(strcmp($this->model, Config::get('constants.CONST_PL_TABLE')) == 0){
			$modelList = ProfitLoss::where('loan_id','=',$loan->id)->orderBy('period', 'DESC')->get();
		}else if(strcmp($this->model, Config::get('constants.CONST_BS_TABLE')) == 0){
			$modelList = BalanceSheet::where('loan_id','=',$loan->id)->orderBy('period', 'DESC')->get();
		}


		if(isset($modelList)){
			$y3 = null;
			$y2 = null;
			$y1 = null;
			$avgGrowth = null;

			foreach ($modelList as $model) {
				if(!$model->offsetExists($this->attribute)){
					Log::error('Credit Model autocalculation error! Cannot find attribute ' . $this->attribute . " for dimension " . $this->id . " - " . $this->label);
				}
				if($y3 == null){
					$y3 = $model->getAttribute($this->attribute);
				}else if($y2 == null) {
					$y2 = $model->getAttribute($this->attribute);
				}else {
					$y1 = $model->getAttribute($this->attribute);

					@$percentageChange1 = (( $y3 - $y2 ) / $y2);
					@$percentageChange2 = (( $y2 - $y1 ) / $y1);



					$avgGrowth = (($percentageChange1 + $percentageChange2) / 2) * 100;
					$this->calculateTrendMeasure($avgGrowth);
				}
			}

		}
	}

	protected function calculateTrendMeasure($avgGrowth){
		$trend = null;
		$measuresList = $this->measures;
		$trendPositiveTolerance = null;
		$trendNegativeTolerance = null;

		if(strcmp($this->attribute, "net_revenue") == 0) {
			$trendPositiveTolerance = ConfigurableParameter::getParamValueOrDefault(Config::get('constants.CONST_ANALYST_MODEL_TYPE_CREDIT'), 'Revenue Trend - Positive Tolerance', 6);
			$trendNegativeTolerance = ConfigurableParameter::getParamValueOrDefault(Config::get('constants.CONST_ANALYST_MODEL_TYPE_CREDIT'), 'Revenue Trend - Negative Tolerance', 0);
        }else{  //EBITDA
        	$trendPositiveTolerance = ConfigurableParameter::getParamValueOrDefault(Config::get('constants.CONST_ANALYST_MODEL_TYPE_CREDIT'), 'EBITDA Trend - Positive Tolerance', 6);
        	$trendNegativeTolerance = ConfigurableParameter::getParamValueOrDefault(Config::get('constants.CONST_ANALYST_MODEL_TYPE_CREDIT'), 'EBITDA Trend - Negative Tolerance', 0);
        }


        if($avgGrowth > $trendPositiveTolerance){
        	$trend = "+ve trend";
        }else if ($avgGrowth >= $trendNegativeTolerance && $avgGrowth <= $trendPositiveTolerance){
        	$trend = "No trend";
        }else if($avgGrowth < $trendNegativeTolerance){
        	$trend = "-ve trend";
        }

        if(isset($trend) && isset($measuresList)){
        	$foundMeasure = $measuresList->filter(function ($item) use(&$trend)  {
        		return strcmp($item->label, $trend) == 0;
        	})->first();

        	if(isset($foundMeasure)){
        		$this->selected_measure_id = $foundMeasure->id;
        	}
        }

      }

      public function calculateDefault($loan){

       if(!isset($this->model) && !isset($this->attribute) && !isset($loan)){
        return;
      } 


      $model = null;

      if(strcmp($this->model, Config::get('constants.CONST_PROMOTER_DETAILS_TABLE')) == 0){
        $model = $loan->getPromoterDetails()->get()->first();


      }elseif(strcmp($this->model, Config::get('constants.CONST_LOANS_TABLE')) == 0){
        $model = $loan;

      }elseif(strcmp($this->model, Config::get('constants.CONST_BUSINESS_DETAILS_TABLE')) == 0){
        $model = $loan->getBusinessOperationalDetails()->get()->first();

      }elseif(strcmp($this->model, Config::get('constants.CONST_LOANS_SALESAREA_TABLE')) == 0){
        $model = $loan->getSalesAreaDetails()->get()->first();

      }

      if (Config::get('constants.CONST_RATIOS_TABLE')) {
        $debtCovRatio = Ratio::where(['loan_id' => $loan->id, 'name' => 'debt_service_coverage_ratio'])->orderBy('period', 'DESC')->get()->first();
        if(isset($debtCovRatio)){
          if(strcmp($this->label, "Debt Service Coverage Ratio") == 0) {
            if($debtCovRatio->value > '2') {
             $this->selected_measure_id = '80';
           }
           else if ($debtCovRatio->value >= '1.5' && $debtCovRatio->value <= '2') {
             $this->selected_measure_id = '81';
           }
           else if ($debtCovRatio->value >= '1' && $debtCovRatio->value <= '1.5') {
             $this->selected_measure_id = '82';
           }
           else if ($debtCovRatio->value < '1') {
             $this->selected_measure_id = '83';
           }
           else {
             $this->selected_measure_id = '84';
           }
         }
       }
     }

     if (Config::get('constants.CONST_RATIOS_TABLE')) {
      $businessOld = Loan::where(['id' => $loan->id, 'com_co_business_old' =>  $loan->com_co_business_old])->get()->first();
      if(isset($businessOld->com_co_business_old)){
        if(strcmp($this->label, "No of years in business") == 0) {
          if($businessOld->com_co_business_old < '5') {
           $this->selected_measure_id = '10';
         }
         else if ($businessOld->com_co_business_old >= '5' && $businessOld->com_co_business_old <= '10') {
           $this->selected_measure_id = '11';
         } else {
           $this->selected_measure_id = '12';
         }
       }
     }
   }

   if (Config::get('constants.CONST_RATIOS_TABLE')) {

    $businessLegacy = PromoterDetails::where(['loan_id' => $loan->id])->orderBy('updated_at', 'DESC')->get()->first();
    $businessLegacy->othr_promoterare;
    if(isset($businessLegacy->othr_promoterare)){
     if (strcmp($this->label, "Business legacy") == 0) {
      if ($businessLegacy->othr_promoterare == '1') {
       $this->selected_measure_id = '13';
     } else if ($businessLegacy->othr_promoterare == '2' ) {
       $this->selected_measure_id = '14';
     } else {
       $this->selected_measure_id = '15';
     }
   }
 }
}

if (Config::get('constants.CONST_RATIOS_TABLE')) {
        //$debt_ebidta = Ratio::where(['loan_id' => $loan->id, 'name' => 'total_debt_ebitda'])->orderBy('period', 'DESC')->get()->first();
  $balSheet = BalanceSheet::where('loan_id','=',$loan->id)->orderBy('period', 'DESC')->get()->first();

  $ebitdaCmodell = ProfitLoss::where(['loan_id' => $loan->id])->orderBy('period', 'DESC')->get()->first();
         /* echo "<pre>";
          print_r($ebitdaCmodell);
          echo "</pre>";*/
          @$bdel=$ebitdaCmodell->ebitda ;

          @$dbe=($balSheet->pref_share_capital_redeemable + $balSheet->long_term_borrowings + $balSheet->short_term_loans+ $balSheet->curr_long_term_debt) / ($bdel);
       /*   echo "<pre>";
          print_r($dbe);
          echo "</pre>";*/
          if (strcmp($this->label, "DEBT/EBIDTA") == 0) {
          	if ($dbe < '1') {
          		$this->selected_measure_id = '94';
          	}
          	else if ($dbe >= '1' && $dbe <= '2') {
          		$this->selected_measure_id = '95';
          	}
          	else if ($dbe >= '2.01' && $dbe <= '3') {
          		$this->selected_measure_id = '96';
          	}
          	else if ($dbe >= '3.01' && $dbe <= '4') {
          		$this->selected_measure_id = '97';
          	}
          	else if ($dbe >= '4.01' && $dbe <= '6') {
          		$this->selected_measure_id = '98';
          	} else {
          		$this->selected_measure_id = '225';
          	}
          }
        }  

        if (Config::get('constants.CONST_RATIOS_TABLE')) {
         $turnTotalAsset = Ratio::where(['loan_id' => $loan->id, 'name' => 'net_revenue_total_assets'])->orderBy('period', 'DESC')->get()->first();

         if (strcmp($this->label, " Turnover/Total Assets") == 0) {

          if ($turnTotalAsset->value >= '1' && $turnTotalAsset->value <= '1.5') {
           $this->selected_measure_id = '105';
         }else if ($turnTotalAsset->value >= '1.56' && $turnTotalAsset->value <= '2') {
           $this->selected_measure_id = '108';
         } else if ($turnTotalAsset->value > '2') {
           $this->selected_measure_id = '106';
         }else {
           $this->selected_measure_id = '107';
         }
       }

     }
     if (Config::get('constants.CONST_RATIOS_TABLE')) {
       $grossProfitFixCost = Ratio::where(['loan_id' => $loan->id, 'name' => 'gross_proft_fixed_expns'])->orderBy('period', 'DESC')->get()->first();
       if (strcmp($this->label, "Gross profit/ fixed cost") == 0) {
        if (@$grossProfitFixCost->value >= '1' && @$grossProfitFixCost->value <= '1.5') {
         $this->selected_measure_id = '111';
       }else if (@$grossProfitFixCost->value >= '1.56' && @$grossProfitFixCost->value <= '2') {
         $this->selected_measure_id = '110';
       }else if (@$grossProfitFixCost->value > '2') {
         $this->selected_measure_id = '109';
       }else {
         $this->selected_measure_id = '112';
       }
     }
   } 

   if (Config::get('constants.CONST_RATIOS_TABLE')) {
   // $cuurentRatios = Ratio::where(['loan_id' => $loan->id, 'name' => 'current_ratio'])->orderBy('period', 'DESC')->get()->first();
     $anaModBalSheet = BalanceSheet::where('loan_id','=',$loan->id)->orderBy('period', 'DESC')->get()->first();
     $cuurentRatios=($anaModBalSheet->total_current_assets - $anaModBalSheet->receivables_from_related_party - $anaModBalSheet->related_party_advances - $anaModBalSheet->capital_advances ) / 
     $anaModBalSheet->total_current_liabilities;
    //(total_current_assets - receivables_from_related_party  - related_party_advances - capital_advances) / total_current_liabilities


     if (strcmp($this->label, "Current Ratio") == 0) {
      if ($cuurentRatios >= '0.4' && $cuurentRatios <= '0.7') {
       $this->selected_measure_id = '226';
     }else if ($cuurentRatios >= '0.701' && $cuurentRatios <= '1') {
       $this->selected_measure_id = '114';
     }else if ($cuurentRatios >= '1.01' && $cuurentRatios <= '1.5') {
       $this->selected_measure_id = '116';
     }else if ($cuurentRatios < '0.4') {
       $this->selected_measure_id = '227';
     }else {
       $this->selected_measure_id = '113';
     }
   }
 } 

 
 $roeRoe = Ratio::where(['loan_id' => $loan->id, 'name' => 'roe'])->orderBy('period', 'DESC')->get()->first();
//echo $roeRoe->value;

//dd(Ratio::($roceRoce->valu));

// ( RR / ( C + D + ( @ - 1 C + @ - 1 D ) ) / 2 ) * 100


 if(isset($roeRoe)){
   if (strcmp($this->label, "ROE") == 0) {
    if ($roeRoe->value >= '5' && $roeRoe->value <= '15') {
     $this->selected_measure_id = '223';
   }else if ($roeRoe->value >= '-5' && $roeRoe->value <= '5') {
     $this->selected_measure_id = '119';
   }else if ($roeRoe->value < '-5' ) {
     $this->selected_measure_id = '118';
   }else{
     $this->selected_measure_id = '224';
   }
 }
}



if (Config::get('constants.CONST_RATIOS_TABLE')) {
    //$roceRoce = Ratio::where(['loan_id' => $loan->id, 'name' => 'roce'])->orderBy('period', 'DESC')->get()->first();
 $rocebalSheet = BalanceSheet::where('loan_id','=',$loan->id)->orderBy('period', 'DESC')->get();
 $ebitdaRoce = ProfitLoss::where(['loan_id' => $loan->id])->orderBy('period', 'DESC')->get()->first();

 $roceEbitda=$ebitdaRoce->ebitda ;
 $roceRoce= ($roceEbitda / (( $rocebalSheet[0]->total_fixed_assets  +  $rocebalSheet[1]->total_fixed_assets + 
  $rocebalSheet[0]->investment + $rocebalSheet[1]->investment + $rocebalSheet[0]->total_current_assets +
  $rocebalSheet[1]->total_current_assets) / 2 ) * 100 ) ;
 if(isset($roceRoce))
   if (strcmp($this->label, "ROCE") == 0) {
      		// dd(round($roceRoce));
    if (round($roceRoce) > '15') {
     $this->selected_measure_id = '120';
   }elseif (round($roceRoce) > '10') {
     $this->selected_measure_id = '121';
   }else{
     $this->selected_measure_id = '122';
   }
 }
}



if (Config::get('constants.CONST_RATIOS_TABLE')) {
 $contLiabNetWorth = Ratio::where(['loan_id' => $loan->id, 'name' => 'contingent_liabilities_net_worth'])->orderBy('period', 'DESC')->get()->first();
       // $contLiabNetWorth->value='31';
 if(isset($contLiabNetWorth)){
  if (strcmp($this->label, "Contingent liability/NW") == 0) {
   if ($contLiabNetWorth->value >= '0' && $contLiabNetWorth->value <= '15') {
    $this->selected_measure_id = '229';
  }else if ($contLiabNetWorth->value >= '15.01' && $contLiabNetWorth->value <= '30') {
    $this->selected_measure_id = '230';
  }else if ($contLiabNetWorth->value >= '30.01' && $contLiabNetWorth->value <= '50') {
    $this->selected_measure_id = '231';
  }else if ($contLiabNetWorth->value >= '50.01' && $contLiabNetWorth->value <= '70') {
    $this->selected_measure_id = '232';
  }else {
    $this->selected_measure_id = '233';
  }
}
}
}



if (Config::get('constants.CONST_RATIOS_TABLE')) {
 $contLiabNetWorth = Ratio::where(['loan_id' => $loan->id, 'name' => 'contingent_liabilities_net_worth'])->orderBy('period', 'DESC')->get()->first();
 $anaModBalSheet = BalanceSheet::where('loan_id','=',$loan->id)->orderBy('period', 'DESC')->get()->first();
   $finalLANW=($anaModBalSheet->related_party_advances+ $anaModBalSheet->third_party_advances)/$anaModBalSheet->net_worth.'==';
 if(isset($finalLANW)){
   if (strcmp($this->label, "Loans & Advances (Given)/NW") == 0) {
    if ($finalLANW <= '0') {
     $this->selected_measure_id = '126';
   }else if ($finalLANW < '15') {
     $this->selected_measure_id = '127';
   }else{   
     $this->selected_measure_id = '128';

   }
 }
}
}

if (Config::get('constants.CONST_RATIOS_TABLE')) {
 $netCashFlowOpration = Cashflow::where(['loan_id' => $loan->id, 'name' => 'net_cf_from_operation'])->orderBy('period', 'DESC')->get()->first();
 $nasetCashFlowOpration = ProfitLoss::where(['loan_id' => $loan->id])->orderBy('period', 'DESC')->get()->first();
 $currentPortion = BalanceSheet::where('loan_id', '=', $loan->id)->orderBy('period', 'DESC')->get();
 $currentPortionLongTermDebt = $currentPortion[1]->curr_long_term_debt;
 @$cfoBasedDscr = (($netCashFlowOpration->value) / (($nasetCashFlowOpration->finance_cost) + $currentPortionLongTermDebt));
 /*echo "<pre>";
 print_r($netCashFlowOpration->value.'<br>sasa');
 print_r($currentPortionLongTermDebt.'<br>sasa');
 print_r($cfoBasedDscr);
 echo "</pre>";*/
 if(isset($cfoBasedDscr)){
   if (strcmp($this->label, "CFO based DSCR") == 0) {
    if ($cfoBasedDscr <= '1.2') {
     $this->selected_measure_id = '85';
   }
   else if ($cfoBasedDscr >= '1.201' && $cfoBasedDscr <= '1.8') {
     $this->selected_measure_id = '86';
   }
   else if (@$cfoBasedDscr >= '1.801' && @$cfoBasedDscr <= '2.5') {
     @$this->selected_measure_id = '87';
   } else {
     $this->selected_measure_id = '88';
   }
 }
}
}

if (Config::get('constants.CONST_RATIOS_TABLE')) {
 // $debtShareFundsRatio = Ratio::where(['loan_id' => $loan->id, 'name' => 'debt_funds_ratio'])->orderBy('period', 'DESC')->get()->first();
 $tdsfr = BalanceSheet::where('loan_id','=',$loan->id)->orderBy('period', 'DESC')->get()->first();

 $debtShareFundsRatio = ( $tdsfr->pref_share_capital_redeemable + $tdsfr->long_term_borrowings + $tdsfr->short_term_loans + $tdsfr->curr_long_term_debt )  / ( $tdsfr->total_shareholders_funds - $tdsfr->receivables_from_related_party + $tdsfr->related_party_advances );
    //echo $debtShareFundsRatio . '<br>';
 if($debtShareFundsRatio){
   if (strcmp($this->label, "Total Debt / Shareholders Funds Ratio") == 0) {
    if ($debtShareFundsRatio <= '1') {
     $this->selected_measure_id = '75';
   } else if ($debtShareFundsRatio >= '1' && $debtShareFundsRatio <= '2') {
     $this->selected_measure_id = '76';
   }
   else if ($debtShareFundsRatio >= '2.01' && $debtShareFundsRatio <= '3.5') {
     $this->selected_measure_id = '77';
   }else   if ($debtShareFundsRatio >= '3.501' && $debtShareFundsRatio <= '5') {
     $this->selected_measure_id = '221';
   }else{
     $this->selected_measure_id = '222';
   }
 }
}
}

if (Config::get('constants.CONST_RATIOS_TABLE')) {
    //$netCashFlowOpration = Cashflow::where(['loan_id' => $loan->id, 'name' => 'net_cf_from_operation'])->orderBy('period', 'DESC')->get()->first();
 $ebitdaCmodel = ProfitLoss::where(['loan_id' => $loan->id])->orderBy('period', 'DESC')->get();
 
   $ebitdaRange=($ebitdaCmodel[0]->ebitda / $ebitdaCmodel[1]->ebitda) ;

 //echo $ebitdaRange;

/* echo $ebitdaCmodel[0]->ebitda . "ebitda A===";
 echo $ebitdaCmodel[1]->ebitda . "==ebitda B";*/
      	//$ebitdaRange='0.1';
   
 if(isset($ebitdaCmodel)){

   if (strcmp($this->label, "EBITDA") == 0) {
       $ebitdaCmodel[1]->ebitda.'<br>last year==' ;  //8.84
      'current year=='.$ebitdaCmodel[0]->ebitda.'<br>'  ; //-257.37
    'Last year=='.$ebitdaCmodel[1]->ebitda.'<br>'  ; //-257.37

  //die();
      			//if(strcmp($this->attribute, "net_revenue") == 0) {
    if ($ebitdaCmodel[0]->ebitda > $ebitdaCmodel[1]->ebitda) {
     $this->selected_measure_id = '102';
   } else {
     $this->selected_measure_id = '104';
   } 
      		//dd($ebitdaRange);
 }
}
} 

if (Config::get('constants.CONST_RATIOS_TABLE')) {
    //$netCashFlowOpration = Cashflow::where(['loan_id' => $loan->id, 'name' => 'net_cf_from_operation'])->orderBy('period', 'DESC')->get()->first();
 $ebitdaCmodel = ProfitLoss::where(['loan_id' => $loan->id])->orderBy('period', 'DESC')->get();
 $revenueCredit=($ebitdaCmodel[0]->net_sales / $ebitdaCmodel[1]->net_sales) ;
 
 if(isset($revenueCredit)){
   if (strcmp($this->label, "Revenue") == 0) {
      			//if(strcmp($this->attribute, "net_revenue") == 0) {
    if ($ebitdaCmodel[0]->net_sales > $ebitdaCmodel[1]->net_sales) {
      //echo "negative";
     $this->selected_measure_id = '99';
   } else {
     // echo "postive";
      $ebitdaCmodel[0]->net_sales;
     $this->selected_measure_id = '101';
   } 
      		//dd($ebitdaRange);
 }
}
}

if(isset($mod))

  if(isset($model) && $model->offsetExists($this->attribute)){
   $attributeValue = $model->getAttribute($this->attribute);
   $this->autoCalculateMeasureValue($attributeValue);
 }else if (strcmp($this->label,'Project pipeline') == 0){
   $loanBusinessType = $loan->com_business_type;
   if(strcmp($loanBusinessType, "Manufacturing") == 0 || strcmp($loanBusinessType, "Trading") == 0){
    $this->is_applicable = 0;
  }
}else if (strcmp($this->label,'Presence of professional at key positions (CFO, COO etc.)') == 0) {

 $busOpDts = $loan->getBusinessOperationalDetails()->get()->first();
 $noMeasure = $this->getMeasureByLabel("No");
 $diversifiedMeasureId = isset($noMeasure)?$noMeasure->id:null;
 if(isset($busOpDts)){
  if(isset($busOpDts->fin_profession_1) || isset($busOpDts->fin_profession_2) || isset($busOpDts->fin_profession_3) || isset($busOpDts->fin_profession_4) || isset($busOpDts->fin_profession_5)){
   $yesMeasure = $this->getMeasureByLabel("Yes");
   $diversifiedMeasureId   = isset($yesMeasure)?$yesMeasure->id:null;
 }
}
if(isset($diversifiedMeasureId)){
  $this->selected_measure_id = $diversifiedMeasureId;
}

}else if (strcmp($this->label,'Sector Outlook') == 0 && isset($loan->com_industry_segment)) {
 $mappedMeasureId = ConfIndustryTypeSectorOutlookMapping::getMappedMeasureId($loan->com_industry_segment);
 if(isset($mappedMeasureId)){
  $this->selected_measure_id = $mappedMeasureId;
}
}else{
 $parentDimension = $this->parentDimension()->get()->first();

 if (isset($parentDimension) && strcmp($parentDimension->label, "Group Strength") == 0){
  $groupStrengthTolerance = ConfigurableParameter::getParamValueOrDefault(Config::get('constants.CONST_ANALYST_MODEL_TYPE_CREDIT'), 'Group Strength Row Sub-Items Tolerance', 2500);

  if(isset($loan->turnover) && $loan->turnover < $groupStrengthTolerance){
   $this->is_applicable = 0;
 }
}else if(isset($parentDimension) && strcmp($parentDimension->label, "Business Diversification") == 0) {
  $latestProfitLoss = ProfitLoss::where('loan_id', '=', $loan->id)->orderBy('period','DESC')->get()->first();
  $businessOpsDetail = $loan->getBusinessOperationalDetails()->get()->first();

  if(isset($latestProfitLoss) && isset($this->measures) && isset($businessOpsDetail)) {
   if (strcmp($this->label, "Customer") == 0) {
    $sales = $this->calculateSalesAmount($businessOpsDetail, true);

    $revenue = $latestProfitLoss->net_sales;
    Log::info("Credit Model Autocalcs for Customer: ", [$sales, $revenue]);
    $diversifiedMeasure = $this->getMeasureByLabel("Diversified");
    $customerMeasureId = isset($diversifiedMeasure)?$diversifiedMeasure->id:null;
    $customerSalesRevenueTolerance = ConfigurableParameter::getParamValueOrDefault(Config::get('constants.CONST_ANALYST_MODEL_TYPE_CREDIT'), 'Customer Sales Revenue Tolerance', 0.6);

    if(isset($sales) && isset($revenue) && $sales > ($customerSalesRevenueTolerance * $revenue)){
     $concentratedMeasure = $this->getMeasureByLabel("Concentrated");
     $customerMeasureId = isset($concentratedMeasure)?$concentratedMeasure->id:null;
   }

   if(isset($customerMeasureId)){
     $this->selected_measure_id = $customerMeasureId;
   }
 }elseif (strcmp($this->label, "Supplier") == 0) {
  $revenue = $latestProfitLoss->net_sales;
  $sales = $this->calculateSalesAmount($businessOpsDetail, false);
  Log::info("Credit Model Autocalcs for Supplier: ", [$sales, $revenue]);
  $diversifiedMeasure = $this->getMeasureByLabel("Diversified");
  $supplierMeasureId = isset($diversifiedMeasure)?$diversifiedMeasure->id:null;
  $supplierSalesRevenueTolerance = ConfigurableParameter::getParamValueOrDefault(Config::get('constants.CONST_ANALYST_MODEL_TYPE_CREDIT'), 'Customer Supplier Revenue Tolerance', 0.45);

  if(isset($sales) && isset($revenue) && $sales > ($supplierSalesRevenueTolerance * $revenue)){
   $concentratedMeasure = $this->getMeasureByLabel("Concentrated");
   $supplierMeasureId = isset($concentratedMeasure)?$concentratedMeasure->id:null;
 }

 if(isset($supplierMeasureId)){
   $this->selected_measure_id = $supplierMeasureId;
 }

}elseif (strcmp($this->label, "Latest D/E ratio (excluding revaluation reserve)") == 0) {

  $liquidityLas = LoanAgainstShare::where('loan_id', '=', $loan->id)->first();

                   /* if ($liquidityLas->marketCapitalisation >= 250 && $liquidityLas->marketCapitalisation <= 500) {
                        $this->selected_measure_id = '66';
                    } elseif ($liquidityLas->marketCapitalisation >= 500 && $liquidityLas->marketCapitalisation <= 1000) {
                        $this->selected_measure_id = '65';
                    } elseif ($liquidityLas->marketCapitalisation >= 1000) {
                        $this->selected_measure_id = '64';
                      }*/
                    }





                  }
                }
              }


            }

            public function autoCalculateMeasureValue($value){

             if(isset($this->measures)){
              $measuresList = $this->measures;
              $measureFound = false;
              $foundMeasureId = null;
              foreach($measuresList as $measure){
               if(isset($measure) && isset($measure->operand)){
                if(strcmp($measure->operand,"between") === 0){
                 $beginRange = $measure->begin_range;
                 $endRange = $measure->end_range;
                 if($beginRange <= $value && $value <= $endRange) {
                  $measureFound = true;
                  $foundMeasureId = $measure->id;
                  break;
                }
              }else{
               if($this->checkAssignmentOperations($measure->operand, $value, $measure->single_value)){
                $measureFound = true;
                $foundMeasureId = $measure->id;
                break;
              }
            }
          }
        }

        if($measureFound && isset($foundMeasureId)){
         $this->selected_measure_id = $foundMeasureId;
       }
     }
   }

   protected function getMeasureByLabel($measureLabel){
     return $this->measures->filter(function ($measure) use(&$measureLabel){
      if(strcmp($measure->label, $measureLabel) == 0){
       return true;
     }
   })->first();
   }

    /**
     * @param $businessOpsDetail
     * @param $sales
     * @return mixed
     */
    private function calculateSalesAmount($businessOpsDetail, $isCustomer)
    {
    	$sales = 0;
    	if($isCustomer) {
    		if ((isset($businessOpsDetail->top3_annsales_1) && is_numeric($businessOpsDetail->top3_annsales_1) && $businessOpsDetail->top3_annsales_1 > 0)
    			|| (isset($businessOpsDetail->top3_annsales_2) && is_numeric($businessOpsDetail->top3_annsales_2) && $businessOpsDetail->top3_annsales_2 > 0)
    			|| isset($businessOpsDetail->top3_annsales_3) && is_numeric($businessOpsDetail->top3_annsales_3) && $businessOpsDetail->top3_annsales_3 > 0
    		) {
    			if (isset($businessOpsDetail->top3_annsales_1) && is_numeric($businessOpsDetail->top3_annsales_1) && $businessOpsDetail->top3_annsales_1 > 0) {
    				$sales += $businessOpsDetail->top3_annsales_1;
    			}

    			if (isset($businessOpsDetail->top3_annsales_2) && is_numeric($businessOpsDetail->top3_annsales_2) && $businessOpsDetail->top3_annsales_2 > 0) {
    				$sales += $businessOpsDetail->top3_annsales_2;
    			}

    			if (isset($businessOpsDetail->top3_annsales_3) && is_numeric($businessOpsDetail->top3_annsales_3) && $businessOpsDetail->top3_annsales_3 > 0) {
    				$sales += $businessOpsDetail->top3_annsales_3;
    				return $sales;
    			}
    		} else {
    			if (isset($businessOpsDetail->vendor_saleamount_1) && is_numeric($businessOpsDetail->vendor_saleamount_1) && $businessOpsDetail->vendor_saleamount_1 > 0) {
    				$sales += $businessOpsDetail->vendor_saleamount_1;
    			}

    			if (isset($businessOpsDetail->vendor_saleamount_2) && is_numeric($businessOpsDetail->vendor_saleamount_2) && $businessOpsDetail->vendor_saleamount_2 > 0) {
    				$sales += $businessOpsDetail->vendor_saleamount_2;
    			}

    			if (isset($businessOpsDetail->vendor_saleamount_3) && is_numeric($businessOpsDetail->vendor_saleamount_3) && $businessOpsDetail->vendor_saleamount_3 > 0) {
    				$sales += $businessOpsDetail->vendor_saleamount_3;
    			}

    			if (isset($businessOpsDetail->vendor_saleamount_3) && is_numeric($businessOpsDetail->vendor_saleamount_3) && $businessOpsDetail->vendor_saleamount_3 > 0) {
    				$sales += $businessOpsDetail->vendor_saleamount_3;
    			}

    			if (isset($businessOpsDetail->vendor_saleamount_4) && is_numeric($businessOpsDetail->vendor_saleamount_4) && $businessOpsDetail->vendor_saleamount_4 > 0) {
    				$sales += $businessOpsDetail->vendor_saleamount_4;
    			}

    			if (isset($businessOpsDetail->vendor_saleamount_5) && is_numeric($businessOpsDetail->vendor_saleamount_5) && $businessOpsDetail->vendor_saleamount_5 > 0) {
    				$sales += $businessOpsDetail->vendor_saleamount_5;
    			}

    			if (isset($businessOpsDetail->vendor_saleamount_6) && is_numeric($businessOpsDetail->vendor_saleamount_6) && $businessOpsDetail->vendor_saleamount_6 > 0) {
    				$sales += $businessOpsDetail->vendor_saleamount_6;
    			}

                //double the 6 monthly sales to arrive at the annual sales
    			$sales = $sales * 2;
    		}
    	}else{
    		if (isset($businessOpsDetail->supplier_amount_1) && is_numeric($businessOpsDetail->supplier_amount_1) && $businessOpsDetail->supplier_amount_1 > 0) {
    			$sales += $businessOpsDetail->supplier_amount_1;
    		}

    		if (isset($businessOpsDetail->supplier_amount_2) && is_numeric($businessOpsDetail->supplier_amount_2) && $businessOpsDetail->supplier_amount_2 > 0) {
    			$sales += $businessOpsDetail->supplier_amount_2;
    		}

    		if (isset($businessOpsDetail->supplier_amount_3) && is_numeric($businessOpsDetail->supplier_amount_31) && $businessOpsDetail->supplier_amount_3 > 0) {
    			$sales += $businessOpsDetail->supplier_amount_3;
    		}
    	}

    	return $sales;
    }

    /*

    1.Total Debt / Shareholders Funds Ratio ===Done
( A3 + F + J + L ) / ( E - V1 - W1 ) ==
( A3 + F + J + L ) / ( E - V1 - W1 )
=(pref_share_capital_redeemable+long_term_borrowings+short_term_loans+curr_long_term_debt)/ (total_shareholders_funds - receivables_from_related_party -related_party_advances)
=(Preference Share Capital (Redeemable) + Long Term Borrowings + Short Term Loans (incl bank Borrowings) +  Current Portion of Long Term Debt ) + ( Total Shareholder Funds - Receivables from related party + Advances to related Party)
=( 0  + 150.42 + 524.83 + 42.24) + ( 158.6 - 0 + 20.79)
= (717.49)/ (179.39) = 
2.DEBT/EBIDTA====( A3 + F + J + L ) / LL  ==
(pref_share_capital_redeemable+long_term_borrowings+short_term_loans+curr_long_term_debt)/EBITDA ====Done



3.current_ratio ( Z - V1 - W1 -Y1 ) / N

(total_current_assets - receivables_from_related_party  - related_party_advances - capital_advances) / total_current_liabilities ====Done


4.roce

LL / ( ( S + @ - 1 S + T+ @ - 1 T + Z + @ - 1 Z ) / 2 ) * 100
(EBITDA) / (( total_fixed_assets + total_fixed_assets ))



    */
}