<?php

namespace App\Helpers\Ratios;

use App\Helpers\ExpressionHelper;
use App\Models\Loan\Loan;
use App\Helpers\Ratios\EvalMath;
use TestCase;

class ExpressionTest extends TestCase {

    public function testExpression(){
/*
        $math = new EvalMath();
        $math->suppress_errors=true;
        $result = $math->evaluate('(21 != 3) & (2 == 3)');
//        $result = $math->evaluate('(21 > 3)');
        $this->assertEquals(4, $result);

        $result = $math->evaluate('2/0');
        $this->assertEquals(false, $result);

        $loan = Loan::where('type','=', 'LAP')->first();
        $helper = new ExpressionHelper($loan->id);
        $balanceSheetExpressionsMap = $helper->calculateBalanceSheetFormulae();
        $this->assertEquals(3, $balanceSheetExpressionsMap->count());

        $profitLossExpressionsMap = $helper->calculateProfitLossFormulae();
        $this->assertEquals(3, $profitLossExpressionsMap->count());

        $ratiosExpressionsMap = $helper->calculateRatios();
        $this->assertEquals(3, $ratiosExpressionsMap->count());
*/
        $helper = new ExpressionHelper(10004);
        $profitLossExpressionsMap = $helper->calculateRatios();
        echo $profitLossExpressionsMap;
    }
}