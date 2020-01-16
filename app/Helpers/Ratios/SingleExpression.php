<?php

namespace App\Helpers\Ratios;

use Illuminate\Support\Collection;

class SingleExpression implements Expression {

    protected $entryId;
    protected $calculationMethod;
    protected $formulaReference;
    protected $formula;
    protected $modelName;
    protected $modelAttribute;
    protected $period;
    protected $value;
    protected $modelList;

    protected static $operandList;

    public function __construct($entryId, $calculationMethod, $formulaReference, $formula, $modelName, $modelAttribute) {
        $this->entryId = $entryId;
        $this->calculationMethod = $calculationMethod;
        $this->formulaReference = $formulaReference;
        $this->formula = $formula;
        $this->modelName = $modelName;
        $this->modelAttribute = $modelAttribute;
    }

    public static function init(){
        self::$operandList = new Collection(array("+", "-", "*", "/", "(", ")", "@"));
    }

    public function resolve($modelsList, $singleExpressionsMap = null)
    {
        $periodsMap = new Collection();
        if(strcmp($this->calculationMethod,"Manual") === 0) {
            foreach($modelsList as $model){
                if(isset($model) && $model->offsetExists($this->modelAttribute)) {
                    $period = $model->getAttribute('period');
                    $value = $model->getAttribute($this->modelAttribute);
                    $expressionValue = new ExpressionValue($this->entryId, $this->modelName, $this->modelAttribute, $value);

                    $periodsMap->offsetSet($period, $expressionValue);
                }
            }
        }

        return $periodsMap;
    }

    public function getKeyReference(){
        return $this->formulaReference;
    }

    public function isFormula()
    {
        return false;
    }
}