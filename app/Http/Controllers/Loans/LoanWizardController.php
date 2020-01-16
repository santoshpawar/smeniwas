<?php
namespace App\Http\Controllers\Loans;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Common\ConfigurableParameter;
use App\Models\MasterData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Input;
use App\Models\Loan\Loan;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Redirect;
use Auth;
use URL;

class LoanWizardController extends Controller {

    public static $instance_variables = array();

    public function __construct() {
        //This will ensure that all routes handled by this controller are first authenticated
       // $this->middleware('auth');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
        $industryTypes = MasterData::industryTypes(false);
        $endUse = MasterData::endUseList(false) ;
		return view('loans.loan_wizard.index')->with(['industryTypes' => $industryTypes, 'endUse' => $endUse]);
	}

    /**
     * @param Request $request
     * @return mixed
     */
    public function postIndex(Request $request)
    {
        $input = Input::all();
        $loanType = "";
        $amount = 0;
        $loanTenure = 0;

        $turnover = $input['turnOver'];
        $end_use = $input['endUse'];
        $com_business_type = $input['businessType'];
        $com_industry_segment = $input['industrySegment'];
        $com_co_business_old = $input['businessAge'];

        $fin_doyouknowcibil = "N";
        $fin_cibilscore = $input['cibilScore'];
        if($fin_cibilscore > 0)
        {
            $fin_doyouknowcibil = "Y";
        }
        $fin_addmonthlyintrest = $input['additionalIncome'];


        if (Session::has('recommendedProduct')) {
            $loanType = Session::get('recommendedProduct');
            $amount = Session::get('recommendedAmount');
            $loanTenure = Session::get('recommendedTenure');
        }

        if ($loanType != "" && $amount > 0 && $loanTenure > 0)
        {
            /*$loan = $this->createAndSaveNewLoan($loanType, $amount, $loanTenure);
            $loanId = $loan->id;
            $endUseList = $end_use; //$loan->end_use;

            Loan::where('id', $loanId)->update(array('turnover' => $turnover, 'end_use' => $end_use, 'com_business_type' => $com_business_type,'com_industry_segment' => $com_industry_segment, 'com_co_business_old' => $com_co_business_old, 'fin_doyouknowcibil' => $fin_doyouknowcibil, 'fin_cibilscore' => $fin_cibilscore, 'fin_addmonthlyintrest' => $fin_addmonthlyintrest));

            $redirectUrl = $this->generateRedirectURL('loans/company-background', $endUseList, $loanType, $amount, $loanTenure, $loanId);
            return Redirect::to($redirectUrl);*/

            return redirect('loans/index?EU='.$end_use.'&LT='.$loanType.'&AMT='.$amount.'&TN='.$loanTenure);

        }
        else
        {
            return redirect('loans');
        }

    }

    /**
     * @param $loanType
     * @param $amount
     * @param $loanTenure
     * @return Loan
     */
    protected function createAndSaveNewLoan($loanType, $amount, $loanTenure)
    {
        $user = Auth::user();
        $userProfile =  Auth::user()->userProfile();
        $loan = new Loan();
        $loan->user_id = $user->id;
        $loan->type = $loanType;
        $loan->loan_amount = $amount;
        $loan->loan_tenure = $loanTenure;
        //$loan->turnover = $userProfile->latest_turnover;
        $loan->save();

        return $loan;
    }


    /**
     * Process the Form Input Data and output the
     * Recommended Product, Tenure and Amount
     *
     */
    public function processData() {
        $input = Input::all();

        $businessType =  $input['businessType']; // Type of Business
        $industrySegment = $input['industrySegment']; // Industry Segment
        $endUse = $input['endUse']; // End Use
        $turnOver = floatval($input['turnOver']); // Turnover Amount
        $businessAge = $input['businessAge']; // Business Age
        $loanRequired = floatval(preg_replace('/[^0-9]/', '', $input['loanRequired'])); // Loan Required
        $totalEMI = floatval($input['totalEMI']) ; // Current EMI liability
        $totalBorrowing = floatval( $input['totalBorrowing']); // Total Borrowing
        $additionalEMIAmt = floatval($input['additionalEMIAmt']); // Additional EMI liability
        $otherIncomeSource = !empty($input['otherIncomeSource']) ? floatval($input['otherIncomeSource']) : 0; // Other Sources of Income
        $cibilScore = !empty($input['cibilScore']) ? $input['cibilScore'] : intval(550); // Cibil Score
        $collateralPropertyValue =  !empty($input['collateralPropertyValue']) ? floatval($input['collateralPropertyValue']) : 0; //Collateral Property Value
        $callRepresentative = false;

        $loantp = null;
        $loantenuer = null;

        /* Storing Form Data in Instance Variable */
        self::$instance_variables['businessType'] = $businessType;
        self::$instance_variables['industrySegment'] = $industrySegment;
        self::$instance_variables['endUse'] = $endUse;
        self::$instance_variables['turnOver'] = $turnOver;
        self::$instance_variables['totalEMI'] = $totalEMI;
        self::$instance_variables['loanRequired'] = $loanRequired;
        self::$instance_variables['totalBorrowing'] = $totalBorrowing;
        self::$instance_variables['additionalEMIAmt'] = $additionalEMIAmt;
        self::$instance_variables['otherIncomeSource'] = $otherIncomeSource;
        self::$instance_variables['cibilScore'] = $cibilScore;
        self::$instance_variables['collateralPropertyValue'] = $collateralPropertyValue;


        /* Calculation of Eligibile Amount X */
        $recommended_Product = null;
        $recommended_Amount = null;
        $recommended_Tenure = null;
        $security = null;
        $margin = null;
        $lowCibilScore = false;
        $loanDecisionRatio = null;


        $confParam = new ConfigurableParameter();
        $eligibleAmountdivider1 = $confParam->getParamValueOrDefault('loan_advisor','eligible amount divide rule1');
        $eligibleAmountdivider2 = $confParam->getParamValueOrDefault('loan_advisor','eligible amount divide rule2');
        $eligibleAmountdivider3 = $confParam->getParamValueOrDefault('loan_advisor','eligible amount divide rule3');
	//dd("eligible amount : " .$eligibleAmountdivider1);

        //dd($eligibleAmountdivider1." ".$eligibleAmountdivider2." ".$eligibleAmountdivider3);

        //Calculating first eligible amount
        if($businessType == 'Manufacturing' || $businessType == 'B2C') {
            $eligibleAmount1 = ( $turnOver / $eligibleAmountdivider1 ) -  ($totalBorrowing + $collateralPropertyValue);
        }
        else if($businessType == 'B2B') {
            $eligibleAmount1 = ( $turnOver / $eligibleAmountdivider2 ) -  ($totalBorrowing + $collateralPropertyValue);
        }
        else if($businessType == 'Trading') {
            $eligibleAmount1 = ( $turnOver / $eligibleAmountdivider3 ) -  ($totalBorrowing + $collateralPropertyValue);
        }

        //Calculating second eligible amount
        $eligibleAmount2 = $collateralPropertyValue;
        $margin1 = $confParam->getParamValueOrDefault('loan_advisor','margin1');
        $margin2 = $confParam->getParamValueOrDefault('loan_advisor','margin2');
        $margin3 = $confParam->getParamValueOrDefault('loan_advisor','margin3');

        //dd($margin1." ".$margin2." ".$margin3);

        /* Calculating third eligible amount */
        if($businessType == 'Manufacturing' || $businessType == 'B2B') {
            $margin = $margin1;
        }
        else if($businessType == 'Trading') {
            $margin = $margin2;
        }
        else if($businessType == 'B2C' ){
            $margin = $margin3;
        }
        $input_EMI = $additionalEMIAmt;
        $value_with_margin = ( ( ($turnOver * $margin) / 12 ) + $otherIncomeSource ) - $totalEMI;
        if( $value_with_margin < (0.4 * $input_EMI) ) {
            $eligibleAmount3 = 30 * 0.4 * $input_EMI;
        } else {
            $eligibleAmount3 = 25 * ($input_EMI + (0.7 * $otherIncomeSource));
        }

        //Final Eligible Amount
        if( $eligibleAmount2 == 0 ) {
            $eligibleAmount = min( $eligibleAmount1, $eligibleAmount3);
        } else {
            $eligibleAmount = min( $eligibleAmount1, $eligibleAmount2, $eligibleAmount3);
        }

        //Applying Vintage and Cibil Ratios
        $cibilScore1 = $confParam->getParamValueOrDefault('loan_advisor','cibil score1');
        $cibilScore2 = $confParam->getParamValueOrDefault('loan_advisor','cibil score2');
        $cibilScore3 = $confParam->getParamValueOrDefault('loan_advisor','cibil score3');

        //dd($cibilScore1." ".$cibilScore2." ".$cibilScore3);

        $cibilCalc1 = $confParam->getParamValueOrDefault('loan_advisor','cibil calc1');
        $cibilCalc2 = $confParam->getParamValueOrDefault('loan_advisor','cibil calc2');
        $cibilCalc3 = $confParam->getParamValueOrDefault('loan_advisor','cibil calc3');
        $cibilCalc4 = $confParam->getParamValueOrDefault('loan_advisor','cibil calc4');
        $cibilCalc5 = $confParam->getParamValueOrDefault('loan_advisor','cibil calc5');

        //dd($cibilCalc1." ".$cibilCalc2." ".$cibilCalc3." ".$cibilCalc4." ".$cibilCalc5);


        if( $cibilScore < $cibilScore1) {
            $recommended_Product = 'Thank You, we will get in touch with you.';
            $recommended_Amount = null;
            $recommended_Tenure = null;
            $lowCibilScore = true;
        }
        else if( $businessAge == 'less than 3' && $cibilScore >= $cibilScore1 && $cibilScore <= $cibilScore2) {
            $eligibleAmount = $cibilCalc1 * $eligibleAmount;
        }
        else if( $businessAge == '3 - 7' && $cibilScore >= $cibilScore1 && $cibilScore <= $cibilScore2) {
            $eligibleAmount = $cibilCalc2 * $eligibleAmount;
        }
        else if( $businessAge == 'greater than 7 - 12' && $cibilScore >= $cibilScore1 && $cibilScore <= $cibilScore2) {
            $eligibleAmount = $cibilCalc3 * $eligibleAmount;
        }
        else if( $businessAge == 'greater than 12' && $cibilScore >= $cibilScore1 && $cibilScore <= $cibilScore2) {
            $eligibleAmount = $cibilCalc4 * $eligibleAmount;
        }
        else if( $businessAge == 'less than 3' && $cibilScore > $cibilScore2) {
            $eligibleAmount = $cibilCalc1 * $eligibleAmount;
        }
        else if( $businessAge == '3 - 7' && $cibilScore > $cibilScore2) {
            $eligibleAmount = $cibilCalc3 * $eligibleAmount;
        }
        else if( $businessAge == 'greater than 7 - 12' && $cibilScore > $cibilScore2) {
            $eligibleAmount = $cibilCalc4 * $eligibleAmount;
        }
        else if( $businessAge == 'greater than 12' && $cibilScore > $cibilScore2) {
            $eligibleAmount = $cibilCalc5 * $eligibleAmount;
        }

        /* Instance Variable Storage */
        self::$instance_variables['eligibleAmount'] = $eligibleAmount;

        /* Decision Criteria */
        $recommendedAmount1 = $confParam->getParamValueOrDefault('loan_advisor','recommended amount1');
        $recommendedAmount2 = $confParam->getParamValueOrDefault('loan_advisor','recommended amount2');
        $recommendedAmount3 = $confParam->getParamValueOrDefault('loan_advisor','recommended amount3');
        $recommendedAmount4 = $confParam->getParamValueOrDefault('loan_advisor','recommended amount4');
        $recommendedAmount5 = $confParam->getParamValueOrDefault('loan_advisor','recommended amount5');
        $recommendedAmount6 = $confParam->getParamValueOrDefault('loan_advisor','recommended amount6');

       // dd($recommendedAmount1." ".$recommendedAmount2." ".$recommendedAmount3." ".$recommendedAmount4." ".$recommendedAmount5." ".$recommendedAmount6 );

        $loan_decision_ratio1 = $confParam->getParamValueOrDefault('loan_advisor','Loan decision ratio1');
        $loan_decision_ratio2 = $confParam->getParamValueOrDefault('loan_advisor','Loan decision ratio2');
        $loan_decision_ratio3 = $confParam->getParamValueOrDefault('loan_advisor','Loan decision ratio3');

        //dd($loan_decision_ratio1." ".$loan_decision_ratio2." ".$loan_decision_ratio3);

        $turnOverAmount1 = $confParam->getParamValueOrDefault('loan_advisor','turnover amount1');
        $turnOverAmount2 = $confParam->getParamValueOrDefault('loan_advisor','turnover amount2');
        $turnOverAmount3 = $confParam->getParamValueOrDefault('loan_advisor','turnover amount3');

       // dd($turnOverAmount1." ".$turnOverAmount2." ".$turnOverAmount3);

        if(!($lowCibilScore)) {
            $loanDecisionRatio = ($eligibleAmount/$loanRequired);

            self::$instance_variables['loanDecisionRatio'] = $loanDecisionRatio;

            if( $loanDecisionRatio >= $loan_decision_ratio3 ) {
                /* First EndUse */
                if( $endUse == 'PPE' || $endUse == 'BRECP' || $endUse == 'PV') {
                    $recommended_Amount = $loanRequired;
                    if( $recommended_Amount <= $recommendedAmount1 ) {
                        $recommended_Product = 'Unsecured Business Loan';
                        $recommended_Tenure = '5 years';

                        $loantp = 'UBL';
                        $loantenuer = 5;
                    } else if( $recommended_Amount > $recommendedAmount1 ) {
                        $recommended_Product = 'Loan Against Property';
                        $recommended_Tenure = '5 - 8 years';

                        $loantp = 'LAP';
                        $loantenuer = 5;
                    }
                }
                else if( $endUse == 'FI' || $endUse == 'FD' || $endUse == 'STAPCFP' || $endUse == 'MRMP') {
                    $recommended_Amount = $loanRequired;
                    if( $recommended_Amount < $recommendedAmount1 ) {
                        $recommended_Product = 'Unsecured Business Loan';
                        $recommended_Tenure = '1 - 3 years';
                        $security = 'Receivable Discounting through escrow of payments received';

                        $loantp = 'UBL';
                        $loantenuer = 1;

                    } else {
                        $recommended_Product = 'Working Capital / Secured Term Loan';
                        $recommended_Tenure = '1 year / 3 - 5 years';
                        $security = 'Backed by charge on current assets and some collateral min 1x';

                        $loantp = 'CC';
                        $loantenuer = 3;
                    }
                }
                else if( $endUse == 'PE' ) {
                    $recommended_Amount = $loanRequired;
                    if( $recommended_Amount < $recommendedAmount5 ) {
                        $recommended_Product = 'Equipment Finance';
                        $recommended_Tenure = '5 years';
                        $security = '1.5x security of equipement';

                        $loantp = 'EFL';
                        $loantenuer = 5;
                    } else {
                        $recommended_Product = 'Secured Term Loan';
                        $recommended_Tenure = '3 - 5 years';
                        $security = 'Mix of equipment and collateral as security';

                        $loantp = 'STL';
                        $loantenuer = 3;
                    }
                }
                else if( $endUse == 'PP') {
                    $recommended_Amount = $loanRequired;
                    $recommended_Product = 'Loan Against Property';
                    $recommended_Tenure = '5 - 8 years';
                    $security = '1.33 - 1.5x cover depending on property';

                    $loantp = 'LAP';
                    $loantenuer = 5;
                }
                else if( $endUse == 'CE' || $endUse == 'STAPCFP' || $endUse == 'LTW' || $endUse == 'MFAP') {
                    $recommended_Amount = $loanRequired;
                    if( $recommended_Amount < $recommendedAmount1) {
                        $recommended_Product = 'Unsecured Business Loan';
                        $recommended_Tenure = '5 years';

                        $loantp = 'UBL';
                        $loantenuer = 5;
                    } else if( $recommended_Amount > $recommendedAmount1 && $recommended_Amount < $recommendedAmount6 && $turnOver > $turnOverAmount1) {
                        $recommended_Product = 'Term Loan';
                        $recommended_Tenure = '5 years';
                        $security = '1.5x fixed asset cover or 1.5x receivable cover with escrow';

                        $loantp = 'STL';
                        $loantenuer = 5;
                    } else {
                        $recommended_Product = 'Secured Term Loan / Loan Against Property';
                        $recommended_Tenure = '5 years';
                        $security = 'Collateral cover of min 1.5x';

                        $loantp = 'STL';
                        $loantenuer = 5;
                    }
                }
                /*----- END OF FIRST MAIN DECISION CRITERIA --------*/
            }
            else if( $loanDecisionRatio <= $loan_decision_ratio2 ) {
                if($loanDecisionRatio <= $loan_decision_ratio1) {
                    $recommended_Product = 'Required Loan amount is very high compared to possible loan sanction. Our representative will call you to understand your requirement';
                    $recommended_Amount = null;
                    $recommended_Tenure = null;
                } else {
                    $recommended_Product = 'Thank You, we will get in touch with you.';
                    $callRepresentative = true;
                }
                /*----- END OF SECOND MAIN DECISION CRITERIA ----------*/
            }
            else if( $loanDecisionRatio > $loan_decision_ratio2 && $loanDecisionRatio < $loan_decision_ratio3 ) {
                /* Applying end use criteria */
                if( $endUse == 'PPE' || $endUse == 'BRECP' || $endUse == 'PV') {

                    //Calculating Recommended Amount for criteria 1
                    $recommended_Amount = min( $eligibleAmount, $loanRequired);

                    //Calculating Product and Tenure
                    if( $recommended_Amount <= $recommendedAmount1) {
                        $recommended_Product = 'Unsecured Business Loan';
                        $recommended_Tenure = '5 years';

                        $loantp = 'UBL';
                        $loantenuer = 5;

                    } else if( $recommended_Amount > $recommendedAmount1 ) {
                        $recommended_Product = 'Loan Against Property';
                        $recommended_Tenure = '5 - 8 years';

                        $loantp = 'LAP';
                        $loantenuer = 5;
                    }

                } /* END First enduse Decision Criteria */
                else if( $endUse == 'FI' || $endUse == 'STAPCFP' || $endUse == 'MRMP' || $endUse == 'FD') {

                    //Calculating Recommended Amount for Criteria 2
                    $recommended_Amount = min( (1.2 * $eligibleAmount), $loanRequired );

                    //Calculating Product and Tenure
                    if( $recommended_Amount < $recommendedAmount1 ) {
                        $recommended_Product = 'Unsecured Business Loan';
                        $recommended_Tenure = '1 - 3 years';
                        $security = 'OR Receivable Discounting through escrow of payments received with tenor of 1-3 years';

                        $loantp = 'UBL';
                        $loantenuer = 1;
                    } else if ( $recommended_Amount > $recommendedAmount1 && $recommended_Amount < $recommendedAmount3 ) {
                        $recommended_Product = 'Unsecured Business Loan';
                        $recommended_Tenure = '5 years';

                        $loantp = 'UBL';
                        $loantenuer = 5;
                    } else {
                        $recommended_Product = 'Working Capital Or Secured Term Loan';
                        $recommended_Tenure = '3 - 5 years';
                        $security = 'Backed by charge on current assets and some collateral min 1x';

                        $loantp = 'CC';
                        $loantenuer = 3;
                    }

                } /* END Second enduse Decision Criteria */
                else if( $endUse == 'PE' ) {

                    //Calculating Recommended Amount for criteria 3
                    $recommended_Amount = min( $eligibleAmount, $loanRequired);

                    //Calculating Product and Tenure
                    if( ($recommended_Amount < $recommendedAmount2 && $turnOver > $turnOverAmount1) || ($recommended_Amount > (1.5 * $loanRequired)) ) {
                        $recommended_Product = 'Equipment Loan';
                        $recommended_Tenure = '5 years';
                        $security = 'Security of equipment with 1.5-2x cover';

                        $loantp = 'EFL';
                        $loantenuer = 5;
                    }
                    else if ( $recommended_Amount > $recommendedAmount2 && $recommended_Amount < $recommendedAmount5 && $turnOver > $turnOverAmount2 ) {
                        $recommended_Product = 'Equipment Loan';
                        $recommended_Tenure = '5 years';
                        $security = 'Security of equipment with 1.5-2x cover';

                        $loantp = 'EFL';
                        $loantenuer = 5;
                    }
                    else {
                        if( $cibilScore > $cibilScore3 && $businessAge == '3 - 7' || $businessAge == 'greater than 7 - 12' || $businessAge == 'greater than 12') {
                            $recommended_Product = 'Equipment Finance';
                            $recommended_Tenure = '5 years';
                            $security = 'Min 1.5 - 2x security if equipment';

                            $loantp = 'EFL';
                            $loantenuer = 5;
                        }
                        else {
                            $recommended_Product = 'Secured Term Loan Or Loan Against Property';
                            $recommended_Tenure = '3 - 5 years';
                            $security = 'Mix of equipment and some collateral property overall 1.5 - 2x cover';

                            $loantp = 'STL';
                            $loantenuer = 3;
                        }
                    }
                } /* END Third enduse Decision Criteria */
                else if( $endUse == 'PP') {

                    //Calculating recommended Amount
                    $recommended_Amount = min( (1.2 * $eligibleAmount), $loanRequired );

                    //Calculating Product and Tenure
                    /*  Product is LAP with tenor of 5-8 years and security of 1.33-2x cover depending on property */
                    $recommended_Product = 'Loan Against Property';
                    $recommended_Tenure = '5 - 8 years';
                    $security = 'Security of 1.33-2x cover depending on property';

                    $loantp = 'LAP';
                    $loantenuer = 5;

                } /* END Fourth enduse Decision Criteria */
                else if( $endUse == 'CE' || $endUse == 'LTW' || $endUse == 'STAPCFP' || $endUse == 'MFAP') {

                    //Calculating recommended Amount
                    $recommended_Amount = min( (1.2 * $eligibleAmount), $loanRequired );

                    //Calculating Recommended Product and turnover
                    if( $recommended_Amount < $recommendedAmount1 && $turnOver > $turnOverAmount3 ) {
                        $recommended_Product = 'Unsecured Business Loan';
                        $recommended_Tenure = '5 years';

                        $loantp = 'UBL';
                        $loantenuer = 5;
                    }
                    /* If recommended amount is > 50  lacs but less than 2  cr and turnover is > 10  cr  then give product as term loan with 5 years , 1.5x fixed asset cover */
                    else if( $recommended_Amount > $recommendedAmount1 && $recommended_Amount < $recommendedAmount4 && $turnOver > $turnOverAmount1) {
                        $recommended_Product = 'Term Loan';
                        $recommended_Tenure = '5 years';
                        $security = ' 1.5x fixed asset cover or 1.5x receivable cover with escrow of payments received';

                        $loantp = 'STL';
                        $loantenuer = 5;
                    }
                    /*   For anything other than above, the Product to be secured Term Loan or LAP with tenor 5 years and collateral cover of min 1.5x */
                    else {
                        $recommended_Product = 'Secured Term Loan Or Loan Against Property';
                        $recommended_Tenure = '5 years';
                        $security = 'Collateral cover of min 1.5x';

                        $loantp = 'STL';
                        $loantenuer = 5;
                    }
                } /* END Fifth enduse Decision Criteria */
                /*---------- END THIRD MAIN DECISION CRITERIA ---------------*/
            }
            $recommended_Amount = round($recommended_Amount, 0, PHP_ROUND_HALF_UP);
        } /* END Main if */

        self::$instance_variables['recommended_Product'] = $recommended_Product;
        self::$instance_variables['recommended_Amount'] = $recommended_Amount;
        self::$instance_variables['recommended_Tenure'] = $recommended_Tenure;
        self::$instance_variables['security'] = $security;

        Session::set('recommendedProduct', $loantp);
        Session::set('recommendedAmount', $recommended_Amount);
        Session::set('recommendedTenure', $loantenuer);

        echo '<h3>Loan Required - '.$loanRequired.' Lakhs</h3>';
        if( isset($recommended_Amount) && !empty($recommended_Amount) ) {
            echo '<h3>Loan Recommended (Most Likely to get sanctioned) - '.$recommended_Amount.' Lakhs</h3>';
           /* echo '<br><br><h3>Do you want to proceed to the recommendations?</h3>';*/
        }

        if($callRepresentative) {
            echo '<h3>If you would like to continue with your original loan requirement pl call our representative at 10:00 AM  to 05:00 PM<br/>If you wish to proceed with our recommended loan amount please proceed with application</h3>';
            echo '<br><br><h3>Do you want to proceed to create a new loan?</h3>';
            die();
        }

        if($recommended_Product == 'Thank You, we will get in touch with you.') {
            echo '<h3>'.$recommended_Product.'</h3>';
            echo '<hr><h3>Do you want proceed to create a new loan? &nbsp;<a href="/loans/"><button type="button" class="btn btn-success" id="submitt">&nbsp;Apply New Loan</button></a></h3>';

        } else {
            echo '<h3>Structure Recommended</h3>';
            echo '<ul>';
            echo '<li><h3>Product - '.$recommended_Product.'</h3></li>';
            if( isset($recommended_Tenure) && !empty($recommended_Tenure)) {
                echo '<li><h3>Tenure - '.$recommended_Tenure.'</h3></li>';
            }
            if( isset($security) && !empty($recommended_Tenure) ) {
                echo '<li><h3>Security - '.$security.'</h3></li>';
            }
            echo '</ul>';

            if(!empty($recommended_Tenure) || !empty($recommended_Tenure))
            {
                echo '<hr><h3>Do you want to proceed to the recommendations? &nbsp;<button type="submit" class="btn btn-success" id="submitt">&nbsp;Proceed Recommendations</button></h3>';
                echo '<h3>OR</h3><h3>Do you want proceed to create a new loan? &nbsp;<a href="/loans/"><button type="button" class="btn btn-success" id="submitt">&nbsp;Apply New Loan</button></a></h3>';

            }
            else
            {
                //$url = URL::to('/loans/');
                echo '<hr><h3>Do you want proceed to create a new loan? &nbsp;<a href="'.URL::to('/loans/').' "><button type="button" class="btn btn-success" id="submitt">&nbsp;Apply New Loan</button></a></h3>';
            }

        }

    }



    protected function generateRedirectURL($redirectUrl, $loanType, $endUseList, $amount, $loanTenure, $loanId){
        if(isset($endUseList)){
            $redirectUrl = $redirectUrl . '/' . $endUseList;
        }
        if(isset($loanType)){
            $redirectUrl = $redirectUrl . '/' . $loanType;
        }

        if(isset($amount)){
            $redirectUrl = $redirectUrl . '/' . $amount;
        }

        if(isset($loanTenure)){
            $redirectUrl = $redirectUrl . '/' . $loanTenure;
        }

        if(isset($loanId)){
            $redirectUrl = $redirectUrl . '/' . $loanId;
        }

        return $redirectUrl;
    }

}
