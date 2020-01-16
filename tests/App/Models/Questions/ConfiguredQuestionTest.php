<?php

namespace App\Models\Questions;


use TestCase;
use App\Models\Loan\Loan;
use App\Models\Questions\ConfiguredQuestion;
use Illuminate\Support\Facades\Config;

class ConfiguredQuestionTest extends TestCase {

    public function testLAP(){
        /*
        $loan = new Loan();
        $loan->type = Config::get('constants.CONST_LOAN_TYPE_LAP');
        $loan->loan_amount = 45;
        $loan->turnover = 4;

        $cq = ConfiguredQuestion::find(31);

        //Remove question
        $this->assertEquals(true, $cq->isQuestionRemoved($loan));

        //Do not remove question
        $loan->loan_amount = 300.5;
        $this->assertEquals(false, $cq->isQuestionRemoved($loan));

        //Do not remove question
        $loan->turnover = 5000;
        $loan->loan_amount = 49;
        $this->assertEquals(true, $cq->isQuestionRemoved($loan));

        //Remove question
        $loan->turnover = 2400;
        $loan->loan_amount = 75;
        $this->assertEquals(true, $cq->isQuestionRemoved($loan));

        //Check that if no criteria is configured for a question, then it should not be deleted
        $cq = ConfiguredQuestion::find(1);
        $this->assertEquals(false, $cq->isQuestionRemoved($loan));
        */
    }
}