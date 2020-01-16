<?php

namespace App\Models\Loan\FinancialData;

use App\Helpers\Ratios\SingleExpression;
use App\Helpers\Ratios\FormulaExpression;
use App\Helpers\Ratios\CombinedToleranceExpression;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class FinancialEntry extends Model {

    public $table = "conf_financial_entries";
    private $operandList;

    protected $fillable = [
        'group_id',
        'entry',
        'description',
        'calculation_method',
        'formula_reference',
        'formula',
        'model',
        'attribute',
        'percentage',
        'threshold_condition',
        'threshold',
        'sortorder',
        'status'
    ];

    public function __construct() {
        $this->operandList = new Collection(array("+", "-", "*", "/", "(", ")", "Avg"));

    }

    public function financialGroup(){
        return $this->belongsTo('App\Models\Loan\FinancialData\FinancialGroup','group_id','id');
    }

    public function hasFormula(){
        if((strcmp($this->calculation_method,"Calculated") === 0 || strcmp($this->calculation_method,"Combined Threshold") === 0) && strlen($this->formula) > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function hasCombinedTolerance(){
        if(strcmp($this->calculation_method,"Combined Threshold") === 0 && strlen($this->formula) > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function getExpression(){

        //$expressions = new Collection();
        $expression = null;

        if(!$this->hasFormula()){
            $expression = new SingleExpression($this->id, $this->calculation_method, $this->formula_reference, $this->formula, $this->model, $this->attribute);
        }else{
            if($this->hasCombinedTolerance()){
                $expression = new CombinedToleranceExpression($this->id, $this->calculation_method, $this->formula_reference, $this->formula, $this->model, $this->attribute, $this->isPercentage(), $this->threshold_condition, $this->threshold);
            }else {
                $expression = new FormulaExpression($this->id, $this->calculation_method, $this->formula_reference, $this->formula, $this->model, $this->attribute, $this->isPercentage(), $this->threshold_condition, $this->threshold);
            }
        }
        return $expression;
    }

    protected function fetchExpressionByFormulaReference($formulaReference){
        $formulaEntry = FinancialEntry::where('status','=', '1')->where('formula_reference',"=",$formulaReference)->get()->first();
        return $formulaEntry;
    }

    protected function isPercentage(){
        $isPercentage = false;
        if(isset($this->percentage) && $this->percentage == "1"){
            $isPercentage = true;
        }
        return $isPercentage;
    }
}