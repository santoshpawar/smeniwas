<?php

namespace App\Helpers\Ratios;

interface Expression {

    public function resolve($modelsList, $singleExpressionsMap = null);
    public function getKeyReference();
    public function isFormula();
    /*
    public function getPeriod();
    public function getValue();
    public function isEvaluated();
    */
}