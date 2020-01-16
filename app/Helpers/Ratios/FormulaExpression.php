<?php

namespace App\Helpers\Ratios;

use App\Models\Loan\BalanceSheet;
use App\Models\Loan\ProfitLoss;
use Illuminate\Support\Collection;
use App\Helpers\Ratios\EvalMath;
use Illuminate\Support\Facades\Config;
use Log;

class FormulaExpression extends SingleExpression {

    protected $calculationMethod;
    protected $formulaReference;
    protected $formula;
    /*protected $modelName;
    protected $modelAttribute;*/
    protected $isPercentage;
    protected $thresholdCondition;
    protected $threshold;
    protected $value;
    protected $expressionEvaluator;

    public function __construct($entryId, $calculationMethod, $formulaReference, $formula, $modelName, $modelAttribute, $isPercentage, $thresholdCondition, $threshold) {
        $this->entryId = $entryId;
        $this->calculationMethod = $calculationMethod;
        $this->formulaReference = $formulaReference;
        $this->formula = $formula;
        $this->modelName = $modelName;
        $this->modelAttribute = $modelAttribute;
        $this->isPercentage = $isPercentage;
        $this->thresholdCondition = $thresholdCondition;
        $this->threshold = $threshold;

        $this->expressionEvaluator = new EvalMath();
        $this->expressionEvaluator->suppress_errors=true;
    }

    public function resolve($modelsList, $expressionsMap=null, $currentPeriod = null, $resultsMap = null){
        $value = 0;
        $isInvalidExpression = false;
        $isCombinedThreshold = false;
        if(strcmp($this->calculationMethod,"Calculated") === 0 && strlen($this->formula) > 0) {
            $components = new Collection(explode(" ", $this->formula));
            $searchExpressionsMap = $expressionsMap;
            $expressionString = "";
            $operandPeriodLookup = false;
            $isAnyOperandPeriodLookup = false;
            $isPeriodLookupPrevious = false;
            $isPeriodLookupNext = false;

            foreach ($components as $component) {
                $expression = null;
                $isOperand = self::$operandList->contains($component);

                if($component == ''){
                    continue;
                }

                if($component == '@'){
                    $operandPeriodLookup = true;
                    $isAnyOperandPeriodLookup = true;
                }

                if (!$isOperand && !is_numeric($component) ) {
                    if ($searchExpressionsMap->offsetExists($component)) {
                        $expressionValue = $searchExpressionsMap->offsetGet($component);
                        $value = null;
                        if(isset($expressionValue)){
                            $value = $expressionValue->getValue();
                        }
                        if(isset($value)) {
                            $expressionString = $expressionString . $value;
                        }else{
                            $isInvalidExpression = true;
                        }
                    } else {
                        $expressionString = $expressionString . "0";
                        $isInvalidExpression = true;
                    }

                    if($operandPeriodLookup){
                        $searchExpressionsMap = $expressionsMap;
                        $operandPeriodLookup = false;//reset
                    }
                } else if (!$operandPeriodLookup) {
                    $expressionString = $expressionString . $component;
                    if(!$isOperand && !is_numeric($component)) {
                        $isInvalidExpression = true;
                    }
                } else if($operandPeriodLookup){
                    if($component == '-'){
                        $isPeriodLookupPrevious = true;
                    }else if($component == '+'){
                        $isPeriodLookupNext = true;
                    }else if(is_numeric($component)){
                        $periodLookupOffset = $component;
                        $foundLookupExpressionMap = $this->findLookupExpressionsMap($periodLookupOffset, $isPeriodLookupPrevious, $isPeriodLookupNext, $currentPeriod, $resultsMap);
                        if(!isset($foundLookupExpressionMap)){
                            return null;
                        }else{
                            $searchExpressionsMap = $foundLookupExpressionMap;
                        }
                    }
                }
            }

            $value = $this->expressionEvaluator->evaluate($expressionString);

            if($value === false){
                $value = 0;
                $isInvalidExpression = true;
            }

            $value = round($value, Config::get('constants.CONST_FIN_DATA_PRECISION'));
        }

        $expressionValue = new ExpressionValue($this->entryId, $this->modelName, $this->modelAttribute, $value, $this->isPercentage, $this->thresholdCondition, $this->threshold, $isInvalidExpression, $isCombinedThreshold);
        return $expressionValue;
    }

    public function getKeyReference(){
        return $this->formulaReference;
    }

    public function isFormula()
    {
        return true;
    }

    protected function findLookupExpressionsMap($periodLookupOffset, $isPeriodLookupPrevious, $isPeriodLookupNext, $currentPeriod, $resultsMap){
        $keysArr = $resultsMap->keys()->sort()->values()->all();

        if($isPeriodLookupNext){
            $keysArr = $resultsMap->keys()->all();
        }

        $currentPeriodPosition = array_search($currentPeriod, $keysArr);
        $desiredPosition = -1;
        $desiredPeriod = null;

        if($isPeriodLookupPrevious){
            $desiredPosition = $currentPeriodPosition - $periodLookupOffset;
        }else if($isPeriodLookupNext){
            $desiredPosition = $currentPeriodPosition + $periodLookupOffset;
        }

        if($desiredPosition < 0 || $desiredPosition > count($keysArr)){
            return null;
        }else{
            $desiredPeriod = $keysArr[$desiredPosition];
            if($resultsMap->offsetExists($desiredPeriod)){
                return $resultsMap->offsetGet($desiredPeriod);
            }else{
                return null;
            }
        }
    }


}

FormulaExpression::init();

function Avg($arr){
    if (!count($arr)) return 0;
}