<?php

namespace App\Helpers;

use App\Models\Loan\FinancialData\BalanceSheet;
use App\Models\Loan\FinancialData\FinancialGroup;
use App\Models\Loan\FinancialData\ProfitLoss;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;

class ExpressionHelper {

    private $loanId;

    public function __construct($loanId){
        $this->loanId = $loanId;
    }

    protected function fetchExpressions($entryType){
        $groups = FinancialGroup::where('type','=',$entryType)->where('status','=',1)->orderBy('sortorder')->with(['financialEntries' => function ($query) {
            $query->where('status','=',1)->orderBy('sortorder');
        }])->get();
        $confEntries = new Collection();
        foreach($groups as $group){
            $confEntries->push($group->financialEntries->all());
        }
        $confEntries = $confEntries->flatten();

        $expressionsList = new Collection();

        foreach($confEntries as $entry){
            $expression = $entry->getExpression();
            $expressionsList->push($expression);
        }

        return $expressionsList;
    }

    public function calculateBalanceSheetFormulae($modelsList=null){
        $dataSource = Config::get('constants.CONST_FIN_GROUP_TYPE_BS');
        if(!isset($modelsList)) {
            $modelsList = $this->fetchModelList($dataSource);
        }
        $expressionsList = $this->fetchExpressions($dataSource);
        $resultsMap = $this->evaluateExpressions($expressionsList, $modelsList);
        return $resultsMap;
    }

    public function calculateProfitLossFormulae($modelsList=null){
        $dataSource = Config::get('constants.CONST_FIN_GROUP_TYPE_PL');
        if(!isset($modelsList)) {
            $modelsList = $this->fetchModelList($dataSource);
        }
        $expressionsList = $this->fetchExpressions($dataSource);
        $resultsMap = $this->evaluateExpressions($expressionsList, $modelsList);
        return $resultsMap;
    }

    public function calculateCashflows(){
        $dataSource = Config::get('constants.CONST_FIN_GROUP_TYPE_CF');
        $expressionsList = $this->fetchExpressions($dataSource);
        $bsResultsMap = $this->calculateBalanceSheetFormulae();
        $plResultsMap = $this->calculateProfitLossFormulae();
        $resultsMap = new Collection($bsResultsMap);

        foreach ($plResultsMap->keys() as $period) {
            $resultsPeriodsCollection = null;

            $plPeriodsMap = $plResultsMap->offsetGet($period);
            if($resultsMap->offsetExists($period)){
                $resultsPeriodsCollection = $resultsMap->offsetGet($period);
            }else{
                $resultsPeriodsCollection = new Collection();
                $resultsMap->offsetSet($period, $resultsPeriodsCollection);
            }

            foreach($plPeriodsMap->keys() as $key){
                $resultsPeriodsCollection->offsetSet($key, $plPeriodsMap->offsetGet($key));
            }
        }

        $ratiosResultsMap = $this->evaluateFormulaExpressions(null, $expressionsList, $resultsMap);
        return $ratiosResultsMap;
    }

    public function calculateRatios(){
        $dataSource = Config::get('constants.CONST_FIN_GROUP_TYPE_RATIO');
        $expressionsList = $this->fetchExpressions($dataSource);
        $bsResultsMap = $this->calculateBalanceSheetFormulae();
        $plResultsMap = $this->calculateProfitLossFormulae();
        $resultsMap = new Collection($bsResultsMap);

        foreach($plResultsMap->keys() as $period){
            $resultsPeriodsCollection = null;

            $plPeriodsMap = $plResultsMap->offsetGet($period);
            if($resultsMap->offsetExists($period)){
                $resultsPeriodsCollection = $resultsMap->offsetGet($period);
            }else{
                $resultsPeriodsCollection = new Collection();
                $resultsMap->offsetSet($period, $resultsPeriodsCollection);
            }

            foreach($plPeriodsMap->keys() as $key){
                $resultsPeriodsCollection->offsetSet($key, $plPeriodsMap->offsetGet($key));
            }
        }

        $ratiosResultsMap = $this->evaluateFormulaExpressions(null, $expressionsList, $resultsMap);
        return $ratiosResultsMap;
    }

    public function mergeValuesIntoCollection($targetCollection, $financialDataExpressionsMap){
        $mergedCollection = new Collection();
        $row = 0;
        foreach($targetCollection as $target){
            if(isset($target['period']) && $financialDataExpressionsMap->offsetExists($target['period'])){
                $mergedRecord = new Collection();
                if(isset($target['id'])) {
                    $mergedRecord->put('id', $target['id']);
                }
                $mergedRecord->put('loan_id', $target['loan_id']);
                $mergedRecord->put('period', $target['period']);

                $financialDataExpression = $financialDataExpressionsMap->offsetGet($target['period']);
                foreach($financialDataExpression as $expression){
                    $attributeName = $expression->getAttributeName();
                    $expressionValue = strval($expression->getValue());
                    if(isset($target[$attributeName])){
                        $mergedRecord->put($attributeName, $expressionValue);
                    }
                }

                $mergedCollection->push($mergedRecord->all());
            }
            $row++;
        }

        return $mergedCollection;
    }

    public function getCalculatedRatiosArr($financialDataExpressionsMap, $existingPeriodsRatioIdMap){

        $calculatedRatiosList = new Collection();
        foreach($financialDataExpressionsMap->keys() as $period) {
            $resultsPeriodsCollection = new Collection();
            $periodsRatioIdMap = null;

            if($existingPeriodsRatioIdMap->offsetExists($period)) {
                $periodsRatioIdMap = $existingPeriodsRatioIdMap->offsetGet($period);
            }else{
                $periodsRatioIdMap = new Collection();
            }

            if(!isset($periodsRatioIdMap)){
                $periodsRatioIdMap = new Collection();
            }

            $financialDataExpression = $financialDataExpressionsMap->offsetGet($period);
            foreach ($financialDataExpression as $expression) {
                $attributeName = $expression->getAttributeName();
                $expressionValue = strval($expression->getValue());
                if (isset($expression) && !$expression->isInvalidExpression()) {
                    $recordId = null;

                    if($periodsRatioIdMap->offsetExists($expression->getEntryId())){
                        $existingRatioRecord = $periodsRatioIdMap->offsetGet($expression->getEntryId());
                        $recordId = $existingRatioRecord->id;
                    }
                    $valuesArray = null;
                    if(isset($recordId)){
                        $valuesArray = ['id' => $recordId, 'loan_id' => $this->loanId, 'ratio_id' => $expression->getEntryId(), 'period' => $period, 'name' => $attributeName, 'value' => $expressionValue];
                    }else{
                        $valuesArray = ['loan_id' => $this->loanId, 'ratio_id' => $expression->getEntryId(), 'period' => $period, 'name' => $attributeName, 'value' => $expressionValue];
                    }

                    $calculatedRatiosList->push($valuesArray);
                }
            }
        }
        return $calculatedRatiosList->all();
    }

    protected function evaluateExpressions($expressionsList, $modelsList){
        $resultsMap = new Collection();
        $formulasList = new Collection();

        foreach($expressionsList as $expression) {
            if ($expression->isFormula()) {
                $formulasList->push($expression);
            } else {
                $periodsMap = $expression->resolve($modelsList);

                foreach($periodsMap->keys() as $period){
                    $periodValue = $periodsMap->offsetGet($period);
                    $periodReferenceMap = null;

                    if($resultsMap->offsetExists($period)){
                        $periodReferenceMap = $resultsMap->offsetGet($period);
                    }else{
                        $periodReferenceMap = new Collection();
                        $resultsMap->offsetSet($period, $periodReferenceMap);
                    }

                    $periodReferenceMap->offsetSet($expression->getKeyReference(), $periodValue);
                }
            }
        }

        $formulaResultsMap = $this->evaluateFormulaExpressions($modelsList, $formulasList, $resultsMap);

        return $resultsMap;
        /*
        $allResultsPeriodMap = new Collection();

        foreach($formulaResultsMap->keys() as $period){
            $formulaPeriodMap = $formulaResultsMap->offsetGet($period);
            $resultsPeriodMap = $resultsMap->offsetGet($period);
            $allResultsPeriodMap->offsetSet($period, $resultsPeriodMap->merge($formulaPeriodMap));
        }

        return $allResultsPeriodMap;
        */
    }

    protected function evaluateFormulaExpressions($modelsList, $formulasList, $resultsMap){
        $formulaResultsMap = new Collection();
        foreach($resultsMap->keys() as $period){
            $resultsPeriodsExpressionsMap = $resultsMap->offsetGet($period);
            foreach($formulasList as $formulaExpression){
                $formulaValue = $formulaExpression->resolve($modelsList, $resultsPeriodsExpressionsMap, $period, $resultsMap);

                if(isset($formulaValue)) {
                    $formulaPeriodsMap = null;

                    if ($formulaResultsMap->offsetExists($period)) {
                        $formulaPeriodsMap = $formulaResultsMap->offsetGet($period);
                    } else {
                        $formulaPeriodsMap = new Collection();
                        $formulaResultsMap->offsetSet($period, $formulaPeriodsMap);
                    }
                    $resultsPeriodsExpressionsMap->offsetSet($formulaExpression->getKeyReference(), $formulaValue);

                    $formulaPeriodsMap->offsetSet($formulaExpression->getKeyReference(), $formulaValue);
                }
            }
        }
        return $formulaResultsMap;
    }

    protected function fetchModelList($dataSource){
        $modelsList = null;
        if (strcmp($dataSource, "Balance Sheet") === 0) {
            $modelsList = BalanceSheet::where("loan_id", "=", $this->loanId)->get();
        } else if (strcmp($dataSource, "Profit & Loss") === 0) {
            $modelsList = ProfitLoss::where("loan_id", "=", $this->loanId)->get();
        } else if (strcmp($dataSource, "Ratio") === 0) {
            $modelsList = ProfitLoss::where("loan_id", "=", $this->loanId)->get();
        }
        return $modelsList;
    }

    public function getCalculatedCashflowsArr($financialDataExpressionsMap, $existingPeriodsCashflowIdMap){

        $calculatedCashflowsList = new Collection();
        foreach($financialDataExpressionsMap->keys() as $period) {
            $resultsPeriodsCollection = new Collection();
            $periodsCashflowIdMap = null;

            if($existingPeriodsCashflowIdMap->offsetExists($period)) {
                $periodsCashflowIdMap = $existingPeriodsCashflowIdMap->offsetGet($period);
            }else{
                $periodsCashflowIdMap = new Collection();
            }

            if(!isset($periodsCashflowIdMap)){
                $periodsCashflowIdMap = new Collection();
            }

            $financialDataExpression = $financialDataExpressionsMap->offsetGet($period);
            foreach ($financialDataExpression as $expression) {
                $attributeName = $expression->getAttributeName();
                $expressionValue = strval($expression->getValue());
                if (isset($expression) && !$expression->isInvalidExpression()) {
                    $recordId = null;

                    if($periodsCashflowIdMap->offsetExists($expression->getEntryId())){
                        $existingCashflowRecord = $periodsCashflowIdMap->offsetGet($expression->getEntryId());
                        $recordId = $existingCashflowRecord->id;
                    }
                    $valuesArray = null;
                    if(isset($recordId)){
                        $valuesArray = ['id' => $recordId, 'loan_id' => $this->loanId, 'cashflow_id' => $expression->getEntryId(), 'period' => $period, 'name' => $attributeName, 'value' => $expressionValue];
                    }else{
                        $valuesArray = ['loan_id' => $this->loanId, 'cashflow_id' => $expression->getEntryId(), 'period' => $period, 'name' => $attributeName, 'value' => $expressionValue];
                    }

                    $calculatedCashflowsList->push($valuesArray);
                }
            }
        }
        return $calculatedCashflowsList->all();
    }
}