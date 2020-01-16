<?php

namespace App\Models\Loan\Bankallocation;

use App\Models\Common\ConfigurableParameter;
use App\Models\Common\OperandComparison;
use App\Models\Loan\AnalystModel\AnalystModelRating;
use App\Models\Loan\FinancialData\Ratio;
use Config;
use Illuminate\Database\Eloquent\Model;
use Log;

class BankAllocationDimension extends Model {

    use OperandComparison;

    public $table = "conf_bank_allocation_dimension";

    protected $fillable = [
        'category_id',
        'type',
        'name',
        'description',
        'model',
        'attribute',
        'operand',
        'single_value',
        'begin_range',
        'end_range',
        'sortorder',
        'status',
    ];

    public function category(){
        return $this->belongsTo('App\Models\Bankallocation\BankAllocationCategory','category_id','id')->where('status','=','1');
    }

    public function subDimensions(){
        return $this->hasMany('App\Models\Loan\Bankallocation\BankAllocationSubDimension','dimension_id','id')->where('status','=','1');
    }

    public function isValidAllocation($loan, $user){

        if(!$this->status){
            return true;
        }

        $isValid = false;
        Log::debug("Beginning Bank Allocation check for dimension - ", [$this->name]);

        if(!isset($loan) || !isset($user)){
            return false;
        }

        $ltvParamName = Config::get('constants.CONST_BK_ALO_DIM_LTV');
        if(strcmp($this->name, $ltvParamName) ==0){
            return $this->handleSpecialRatios($loan);
        }

        $value = $this->fetchAttributeValue($loan, $user);

        if(strcmp($this->attribute, "fin_cibilscore") == 0 && strcmp($loan->fin_doyouknowcibil,"No") == 0) {
            $isValid = true;
        }else {
            if (isset($value)) {
                $isValid = $this->checkIsValid($value);
            } else {
                $isValid = true;
            }
        }

        Log::debug("Completed Bank Allocation check for dimension.  ", [$this->name, $isValid]);

        return $isValid;
    }

    protected function handleSpecialRatios($loan){
        $securityDetails = $loan->getSecurityDetails()->get()->first();
        $loanAmount = $loan->loan_amount;
        $collateralValue = 0;
        $ltvRatio = 0;
        $collateralType=null;
        $doesLtvPass = false;
        if(isset($securityDetails)){
            $collateralValue = $securityDetails->latest_valuation;
            $collateralType = $securityDetails->collateral_type;
        }

        if($collateralValue > 0 && isset($collateralType)){
            $ltvRatio =  $collateralValue/ $loanAmount;
        }

        $confParam = new ConfigurableParameter();
        $ltvResidential = $confParam->getParamValueOrDefault('bank_allocation','LTV Residential', 0.7);
        $ltvCommercial = $confParam->getParamValueOrDefault('bank_allocation','LTV Commercial', 0.6);
        $ltvIndustrial = $confParam->getParamValueOrDefault('bank_allocation','LTV Industrial', 0.55);
        $ltvFarmhouse = $confParam->getParamValueOrDefault('bank_allocation','LTV Farm House', 0.5);

        if(strcmp("Residential", $collateralType) ==0){
            if($ltvRatio >= $ltvResidential){
                $doesLtvPass = true;
            }else{
                $doesLtvPass = false;
            }
        }else if(strcmp("Commercial", $collateralType) ==0){
            if($ltvRatio >= $ltvCommercial){
                $doesLtvPass = true;
            }else{
                $doesLtvPass = false;
            }
        }else if(strcmp("Industrial", $collateralType) ==0){
            if($ltvRatio >= $ltvIndustrial){
                $doesLtvPass = true;
            }else{
                $doesLtvPass = false;
            }
        }else if(strcmp("Land Agri", $collateralType) ==0 || (strcmp("Land Non-Agri", $collateralType) ==0)){
            if($ltvRatio >= $ltvFarmhouse){
                $doesLtvPass = true;
            }else{
                $doesLtvPass = false;
            }
        }
        Log::debug("Completed Bank Allocation check for dimension.  ", [$this->name, $doesLtvPass, $ltvRatio, $collateralType]);
        return $doesLtvPass;
    }

    protected function fetchAttributeValue($loan, $user){
        $model = null;
        $value = null;
        if(strcmp($this->type, Config::get('constants.CONST_BK_ALO_TYPE_LOAN')) == 0){
            if(strcmp($this->model, Config::get('constants.CONST_LOANS_TABLE')) == 0){
                $value = $loan->getAttribute($this->attribute);
            }else if(strcmp($this->model, Config::get('constants.CONST_LOANS_SECURITY_DETAILS_TABLE')) == 0){
                $securityDetail = $loan->getSecurityDetails()->get()->first();
                if(isset($securityDetail)) {
                    $value = $securityDetail->getAttribute($this->attribute);
                }
            }
        }else if(strcmp($this->type, Config::get('constants.CONST_BK_ALO_TYPE_RATIO')) == 0 &&
            strcmp($this->model, Config::get('constants.CONST_RATIOS_TABLE')) == 0){
            $ratio = Ratio::where('loan_id', '=', $loan->id)->where('name', '=', $this->attribute)->orderBy('period', 'DESC')->get()->first();
            if(isset($ratio)) {
                $value = $ratio->value;
            }
        }else if(strcmp($this->type, Config::get('constants.CONST_ANALYST_MODEL_TYPE_CREDIT')) == 0 &&
            strcmp($this->model, Config::get('constants.CONST_CREDIT_TABLE')) == 0){
            $rating = AnalystModelRating::where('loan_id','=', $loan->id)->where('model_type','=',  Config::get('constants.CONST_BK_ALO_TYPE_CREDIT'))->get()->first();
            if(isset($rating)){
                if(strcmp($this->attribute,"final_haircut") == 0){
                    $value = 100 - $rating->getAttribute($this->attribute);
                }else {
                    $value = $rating->getAttribute($this->attribute);
                }
            }
        }else if(strcmp($this->type, Config::get('constants.CONST_BK_ALO_TYPE_COLLATERAL')) == 0 &&
            strcmp($this->model, Config::get('constants.CONST_COLLATERAL_TABLE')) == 0){
            $rating = AnalystModelRating::where('loan_id','=', $loan->id)->where('model_type','=',  Config::get('constants.CONST_BK_ALO_TYPE_COLLATERAL'))->get()->first();
            if(isset($rating)){
                $value = $rating->getAttribute($this->attribute);
            }
        }else if(strcmp($this->type, Config::get('constants.CONST_BK_ALO_TYPE_USER_PROFILE')) == 0 &&
            strcmp($this->model, Config::get('constants.CONST_USER_PROFILES_TABLE')) == 0){
            $userProfile = $user->userProfile();
            if(isset($userProfile)){
                $value = $userProfile->getAttribute($this->attribute);
            }
        }

        return $value;
    }

    protected function checkIsValid($value){
        $isValid = false;
        if(isset($this->operand)){
            if(strcmp($this->operand,"between") === 0){
                $beginRange = $this->begin_range;
                $endRange = $this->end_range;
                if($beginRange <= $value && $value <= $endRange) {
                    $isValid = true;
                }
            }else if(strcmp($this->operand,"IN") === 0 || strcmp($this->operand,"NOTIN") === 0) {

                if(isset($subDimensions)) {
                    $subDimensions = $this->subDimensions;
                }else{
                    $subDimensions = $this->subDimensions()->get();
                }
                if(isset($subDimensions)){
                    $subDimensionValuesList = $subDimensions->map(function($subDimension){
                        return $subDimension->value;
                    });

                    if(isset($subDimensionValuesList)){
                        $containsValue = $subDimensionValuesList->has($value);

                        if(strcmp($this->operand,"IN") === 0 && $containsValue){
                            $isValid = true;
                        }

                        if(strcmp($this->operand,"NOTIN") === 0 && !$containsValue){
                            $isValid = true;
                        }
                    }
                }
            }else {
                if($this->checkAssignmentOperations($this->operand, $value, $this->single_value)){
                    $isValid = true;
                }
            }
        }
        return $isValid;
    }
}