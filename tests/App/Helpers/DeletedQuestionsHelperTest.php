<?php

namespace tests\App\Helpers;

use TestCase;
use App\Helpers\DeletedQuestionsHelper;
use App\Models\Loan\Loan;
use Illuminate\Support\Facades\Config;

class DeletedQuestionsHelperTest extends TestCase {

    public function testLAP(){
        $loan = new Loan();
        $loan->type = Config::get('constants.CONST_LOAN_TYPE_LAP');
        $loan->loan_amount = 45;
        $loan->turnover = 4;

        $helper = new DeletedQuestionsHelper($loan);

        /*
        $this->assertEquals(false, $helper->isQuestionRemoved(1));
        $this->assertEquals(true, $helper->isQuestionValid(1));

        $masterQuestionNumsArray = range(1,49);

        $test1DeletedArray = array(31,32,33,34,35,36);
        $test1ValidArray = array_merge(array(),array_diff($masterQuestionNumsArray, $test1DeletedArray));
        $this->assertEquals($test1DeletedArray, $helper->getDeletedQuestionNumbers()->toArray(), "Scenario 1 - Deleted - Loan Amount < 50 Lacs And Turnover < 5 Cr");
        $this->assertEquals($test1ValidArray, $helper->getValidQuestionNumbers()->toArray(), "Scenario 1 - Valid - Loan Amount < 50 Lacs And Turnover < 5 Cr");

        $loan->loan_amount = 100;
        $helper = new DeletedQuestionsHelper($loan);
        $test2DeletedArray = array(31,32,33,34,35,36);
        $test2ValidArray = array_merge(array(),array_diff($masterQuestionNumsArray, $test2DeletedArray));
        $this->assertEquals($test2DeletedArray, $helper->getDeletedQuestionNumbers()->toArray(), "Scenario 2 - Deleted - Loan Amount 50 Lacs-3 Cr And Turnover < 5 Cr");
        $this->assertEquals($test2ValidArray, $helper->getValidQuestionNumbers()->toArray(), "Scenario 2 - Valid - Loan Amount 50 Lacs-3 Cr And Turnover < 5 Cr");

        $loan->loan_amount = 350;
        $helper = new DeletedQuestionsHelper($loan);
        $test3DeletedArray = array();
        $test3ValidArray = array_merge(array(),array_diff($masterQuestionNumsArray, $test3DeletedArray));
        $this->assertEquals($test3DeletedArray, $helper->getDeletedQuestionNumbers()->toArray(), "Scenario 3 - Deleted - Loan Amount > 3 Cr And Turnover < 5 Cr");
        $this->assertEquals($test3ValidArray, $helper->getValidQuestionNumbers()->toArray(), "Scenario 3 - Valid - Loan Amount > 3 Cr And Turnover < 5 Cr");

        $loan->loan_amount = 34;
        $loan->turnover = 514;
        $helper = new DeletedQuestionsHelper($loan);
        $test4DeletedArray = array(11,12,13 ,21,22, 24, 27, 28, 29, 31,32,33,34,35,36);
        $test4ValidArray = array_merge(array(),array_diff($masterQuestionNumsArray, $test4DeletedArray));
        $this->assertEquals($test4DeletedArray, $helper->getDeletedQuestionNumbers()->toArray(), "Scenario 4 - Deleted - Loan Amount < 50 Lacs And Turnover 5 to 25 Cr");
        $this->assertEquals($test4ValidArray, $helper->getValidQuestionNumbers()->toArray(), "Scenario 4 - Valid - Loan Amount < 50 Lacs And Turnover 5 to 25 Cr");

        $loan->loan_amount = 234;
        $loan->turnover = 514;
        $helper = new DeletedQuestionsHelper($loan);
        $test5DeletedArray = array(11,12,13 , 21,22,23,24, 27, 28,29, 31,32,33,34,35,36);
        $test5ValidArray = array_merge(array(),array_diff($masterQuestionNumsArray, $test5DeletedArray));
        $this->assertEquals($test5DeletedArray, $helper->getDeletedQuestionNumbers()->toArray(), "Scenario 5 - Deleted - Loan Amount 50 Lacs to 3 Cr And Turnover 5 to 25 Cr");
        $this->assertEquals($test5ValidArray, $helper->getValidQuestionNumbers()->toArray(), "Scenario 5 - Valid - Loan Amount 50 Lacs to 3 Cr And Turnover 5 to 25 Cr");

        $loan->loan_amount = 1011;
        $loan->turnover = 5000;
        $helper = new DeletedQuestionsHelper($loan);
        $test6DeletedArray = array();
        $test6ValidArray = array_merge(array(),array_diff($masterQuestionNumsArray, $test6DeletedArray));
        $this->assertEquals($test6DeletedArray, $helper->getDeletedQuestionNumbers()->toArray(), "Scenario 6 - Deleted - Loan Amount > 3 Cr And Turnover > 25 Cr");
        $this->assertEquals($test6ValidArray, $helper->getValidQuestionNumbers()->toArray(), "Scenario 6 - Valid - Loan Amount > 3 Cr And Turnover > 25 Cr");

        $loan->loan_amount = 9;
        $loan->turnover = 2600;
        $helper = new DeletedQuestionsHelper($loan);
        $test7DeletedArray = array(11,12,13 , 21,22,24, 25,27, 28, 29, 31,32,33,34,35,36);
        $test7ValidArray = array_merge(array(),array_diff($masterQuestionNumsArray, $test7DeletedArray));
        $this->assertEquals($test7DeletedArray, $helper->getDeletedQuestionNumbers()->toArray(), "Scenario 7 - Deleted - Loan Amount < 50 lacs And Turnover > 25 Cr");
        $this->assertEquals($test7ValidArray, $helper->getValidQuestionNumbers()->toArray(), "Scenario 7 - Valid - Loan Amount < 50 lacs And Turnover > 25 Cr");

        $loan->loan_amount = 70;
        $loan->turnover = 2600;
        $helper = new DeletedQuestionsHelper($loan);
        $test8DeletedArray = array(11,12,13, 23, 24,25,27,28,31,32,33,34,35,36);
        $test8ValidArray = array_merge(array(),array_diff($masterQuestionNumsArray, $test8DeletedArray));
        $this->assertEquals($helper->getDeletedQuestionNumbers()->toArray(), $test8DeletedArray, "Scenario 8 - Deleted - Loan Amount 50 lacs to 3 cr and Turnover > 25 Cr");
        $this->assertEquals($test8ValidArray, $helper->getValidQuestionNumbers()->toArray(), "Scenario 8 - Valid - Loan Amount 50 lacs to 3 cr and Turnover > 25 Cr");

        $loan->loan_amount = 301;
        $loan->turnover = 2600;
        $helper = new DeletedQuestionsHelper($loan);
        $test9DeletedArray = array();
        $test9ValidArray = array_merge(array(),array_diff($masterQuestionNumsArray, $test9DeletedArray));
        $this->assertEquals($helper->getDeletedQuestionNumbers()->toArray(), $test9DeletedArray, "Scenario 9 - Deleted - No deleted questions");
        $this->assertEquals($test9ValidArray, $helper->getValidQuestionNumbers()->toArray(), "Scenario 9 - Valid - No deleted question");

        $loan->loan_amount = 25;
        $loan->turnover = 50;
        $helper = new DeletedQuestionsHelper($loan);
        $this->assertEquals($helper->isQuestionRemoved("D2"), true, "Scenario I 1a - Loan Amount < 50L & Turnover < 5 Cr");
        $this->assertEquals($helper->isQuestionValid("D2"), false, "Scenario I 1b - Loan Amount < 50L & Turnover < 5 Cr");

        $this->assertEquals($helper->isQuestionRemoved("A1"), false, "Scenario I 2a - Loan Amount < 50L & Turnover < 5 Cr");
        $this->assertEquals($helper->isQuestionValid("A1"), true, "Scenario I 2b - Loan Amount < 50L & Turnover < 5 Cr");

        $loan->loan_amount = 35;
        $loan->turnover =625;
        $this->assertEquals($helper->isQuestionRemoved("D1"), true, "Scenario II 1a - Loan Amount < 50L & Turnover 5-20 Cr");
        $this->assertEquals($helper->isQuestionValid("D1"), false, "Scenario II 1b - Loan Amount < 50L & Turnover 5-20 Cr");

        $this->assertEquals($helper->isQuestionRemoved("B2.5.2"), false, "Scenario II 1a - Loan Amount < 50L & Turnover 5-20 Cr");
        $this->assertEquals($helper->isQuestionValid("B2.5.2"), true, "Scenario II 1b - Loan Amount < 50L & Turnover 5-20 Cr");

        $loan->loan_amount = 8;
        $loan->turnover = 45;
        $this->assertEquals($helper->isQuestionRemoved("B2.1"), true, "Scenario III 1a - Loan Amount < 50L & Turnover > 20 Cr");
        $this->assertEquals($helper->isQuestionValid("B2.1"), false, "Scenario III 1b - Loan Amount < 50L & Turnover > 20 Cr");

        $this->assertEquals($helper->isQuestionRemoved("C.7"), false, "Scenario III 1a - Loan Amount < 50L & Turnover 5-20 Cr");
        $this->assertEquals($helper->isQuestionValid("C.7"), true, "Scenario III 1b - Loan Amount < 50L & Turnover 5-20 Cr");
*/
        $loan = new Loan();
        $loan->type = Config::get('constants.CONST_LOAN_TYPE_LAP');
        $loan->loan_amount = 45;
        $loan->turnover = 400;

        $helper = new DeletedQuestionsHelper($loan);
        $this->assertEquals($helper->isQuestionRemoved("D3.9"), true, "Scenario III 1a - Loan Amount < 50L & Turnover > 20 Cr");
        $this->assertEquals($helper->isQuestionValid("D3.9"), false, "Scenario III 1b - Loan Amount < 50L & Turnover > 20 Cr");
    }
}