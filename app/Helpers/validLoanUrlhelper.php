<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/10/2015
 * Time: 12:25 PM
 */
 namespace App\Helpers;
use App\Models\Common\ConfigurableParameter;
use App\Models\Loan\Loan;
use App\Models\UserProfile;
use App\Models\Loan\LoansStatus;
use App\Models\Loan\SecurityDetail;
use Config;
use Auth;
use App\Models\MasterData;

class validLoanUrlhelper {

    public function isValidLoan($loanId){
        $valid = false;
        $loan = null;
//        $user = Sentinel::getUser();
        $user = Auth::user();
        $userID = $user->id;
        $userProfile = UserProfile::find($userID);
        if(isset($loanId) && isset($user)){
            $loan = Loan::find($loanId);
            if(!isset($loan))
            {
                return false;
            }
//            dd($user,$userID,$userProfile,$loan,$user->isSME(),$user->isCA(),$user->id,$loan->user_id,$userProfile->referredby_userid);
            if($user->isSME() || $user->isCA()) {
                if(isset($loan))
                {
                    if ($user->id == $loan->user_id) {
                        $valid = true;
                    }elseif($user->id == $userProfile->referredby_userid) {
                        $valid = true;
                    }
                    else {
                        //$valid = false;
                        return false;
                    }
                }
                else
                {
                    return view('loans.error');
                }
            }elseif($user->isAnalyst())
            {
               // $status = $loan->status;
                $valid = true;
            }else{
                $valid = true;
            }
        }
        return $valid;
    }

    public function collateralModel($loanId){
        $isVisible = false;
        $loan = null;
        $securityDetails = null;
        $loanType = Config::get('constants.CONST_LOAN_TYPE_UBL');
        if(isset($loanId)) {
            $loan = Loan::find($loanId);
            $securityDetails = SecurityDetail::where('loan_id', '=', $loanId)->first();
            if (isset($securityDetails)) {
                if (!isset($securityDetails->is_collateral_property) || $securityDetails->is_collateral_property == 0 || $loan->type == $loanType) {
                    $isVisible = false;
                } else {
                    $isVisible = true;
                }
            }
        }
        return $isVisible;
    }

    public function securityTab($loanId,$loanType){
        $isVisible = true;
        $type = Config::get('constants.CONST_LOAN_TYPE_UBL');
        if(isset($loanType) && $loanType == $type){
            $isVisible = false;
        }
        return $isVisible;
    }

    public function securityTabHideShow($endUseList){
        $isVisible = true;
        $type = Config::get('constants.CONST_END_USE_FD');
        if(isset($endUseList) && $endUseList == $type){
            $isVisible = false;
        }
        return $isVisible;
    }

    public function getMandatory($user,$isRemoveMandatory){
        $isVisible = true;

        $starSign = MasterData::where('name', '=', $isRemoveMandatory)->first();
        if(isset($user) && $isRemoveMandatory == $starSign){
            $isVisible = '';
        }
        else{
            $isVisible =  $starSign->value;
        }
        return $isVisible;
    }

    public function CurrentTabStatus($loanId,$tabName){
        $isEnable = null;
        $isDisabled = '';
        $confParam = new ConfigurableParameter();
        $isEnable = $confParam->getParamValueOrDefault('loans_tab_disable','Loans Tab Disable');

        if($isEnable == Config::get('constants.CONST_LOAN_TAB_DISABLE_YES') && $isEnable != Config::get('constants.CONST_LOAN_TAB_DISABLE_NO')) {
            if (isset($loanId)) {
                $loanStatus = LoansStatus::where('loan_id', '=', $loanId)->first();
                if ($loanStatus != null && isset($loanStatus)) {
                    if ($loanStatus->$tabName != 'Y') {
                        $isDisabled = 'disabled';
                    } else {
                        $isDisabled = "enabled";
                    }
                } else {
                    $isDisabled = 'disabled';
                }
            }
        }
        return $isDisabled;
    }

     public function getTabStatus($loanId,$tabName){
        $status = '';
        $isEnable = null;
        $confParam = new ConfigurableParameter();
        $isEnable = $confParam->getParamValueOrDefault('loans_tab_disable','Loans Tab Disable');
         if($isEnable == Config::get('constants.CONST_LOAN_TAB_DISABLE_YES') && $isEnable != Config::get('constants.CONST_LOAN_TAB_DISABLE_NO')) {
            if (isset($loanId)) {
                $loanStatus = LoansStatus::where('loan_id', '=', $loanId)->first();
                if ($loanStatus != null && isset($loanStatus)) {
                    $status = $loanStatus->$tabName;
                }
            }
        }
        return $status;
    }

    public function discardingApplication(){
        $isEnable = false;
        $confParam = new ConfigurableParameter();
        $discardApplication = $confParam->getParamValueOrDefault('loan_application_discard','Loans Application Discard');
        if($discardApplication == Config::get('constants.CONST_DISCARD_LOAN_APPLICATION_YES') && $discardApplication != Config::get('constants.CONST_DISCARD_LOAN_APPLICATION_NO')) {
            $isEnable = true;
        }
        return $isEnable;
    }




}
