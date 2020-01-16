<?php

namespace App\Helpers\Ratios;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;

class CombinedToleranceExpression extends FormulaExpression {

    protected static $combinedToleranceOperandsList;

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

    public static function init(){
        self::$combinedToleranceOperandsList = new Collection(["and", "or", "*", "/", "<", "<=", ">", ">=", "=", "(", ")"]);
    }

    public function resolve($modelsList, $expressionsMap=null){
        $value = 0;
        $isInvalidExpression = false;
        $isCombinedThreshold = false;
        if(strcmp($this->calculationMethod,"Combined Threshold") === 0 && strlen($this->formula) > 0) {
            $components = new Collection(explode(" ", $this->formula));

            $expressionString = "";
            foreach ($components as $component) {
                $expression = null;
                $isOperand = self::$combinedToleranceOperandsList->contains($component);
                if (!$isOperand && !is_numeric($component) ) {
                    if ($expressionsMap->offsetExists($component)) {
                        $expressionValue = $expressionsMap->offsetGet($component);
                        $value = null;
                        if(isset($expressionValue) && !$expressionValue->isInvalidExpression()){
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
                } else {
                    $expressionString = $expressionString . " " . $component;
                    if(!$isOperand && !is_numeric($component)) {
                        $isInvalidExpression = true;
                    }
                }
            }

            $value = null;

            $expressionString = str_replace("and"," & ",$expressionString);
            $expressionString = str_replace("or"," | ",$expressionString);

            $value = $this->expressionEvaluator->evaluate($expressionString);

            if(isset($this->expressionEvaluator->last_error)){
                $value = false;
                $isInvalidExpression = true;
            }else {
                //$value = round($value, Config::get('constants.CONST_FIN_DATA_PRECISION'));
                $isInvalidExpression = false;
            }

            $isCombinedThreshold = true;
            $this->thresholdCondition = $expressionString;
            $this->threshold = "";
        }

        $expressionValue = new ExpressionValue($this->entryId, $this->modelName, $this->modelAttribute, $value, $this->isPercentage, $this->thresholdCondition, $this->threshold, $isInvalidExpression, $isCombinedThreshold);
        return $expressionValue;
    }
}

CombinedToleranceExpression::init();