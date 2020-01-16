<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Config;

class FormatHelper {

    public static function formatLoanType($value){
        $labelValue = $value;
        if ($value === Config::get('constants.CONST_LOAN_TYPE_CC')){
            $labelValue =  "Secured Short Term WC/CC/OD Loan";
        }else if ($value === Config::get('constants.CONST_LOAN_TYPE_STL')){
            $labelValue =  "Secured Term Loan";
        }else if($value === Config::get('constants.CONST_LOAN_TYPE_LAP')){
            $labelValue = "Loan Against Property";
        }else if ($value === Config::get('constants.CONST_LOAN_TYPE_UBL')){
            $labelValue =  "Unsecured Business Loan";
        }else if ($value === Config::get('constants.CONST_LOAN_TYPE_EFL')){
            $labelValue =  "Equipment Finance";
        }else if ($value === Config::get('constants.CONST_LOAN_TYPE_VF')){
            //$labelValue =  "Vendor Finance/Bill Discounting/Receivable Finance";
            $labelValue =  "Receivable Finance";
        }else if ($value === Config::get('constants.CONST_LOAN_TYPE_CSCF')){
            $labelValue =  "Corporate Supply Chain Finance";
        }
        return $labelValue;
    }

    public static function formatEndUseList($value){
        $endUseLabelValue = $value;
        if ($value === Config::get('constants.CONST_END_USE_FI')){
            $endUseLabelValue =  "Finance Inventory";
        }else if ($value === Config::get('constants.CONST_END_USE_FD')){
            $endUseLabelValue =  "Finance Debtors";
        }else if($value === Config::get('constants.CONST_END_USE_PV')){
            $endUseLabelValue = "Payment to Vendors";
        }else if ($value === Config::get('constants.CONST_END_USE_PE')){
            $endUseLabelValue =  "Purchase of  Equipment";
        }else if ($value === Config::get('constants.CONST_END_USE_PP')){
            $endUseLabelValue =  "Purchase of Property";
        }else if ($value === Config::get('constants.CONST_END_USE_MRMP')){
            $endUseLabelValue =  "Margin For LC For Raw Material Purchase";
        }else if ($value === Config::get('constants.CONST_END_USE_MFAP')){
            $endUseLabelValue =  "Margin For LC For Fixed Asset Purchase";
        }else if ($value === Config::get('constants.CONST_END_USE_STAPCFP')){
            $endUseLabelValue =  "Short Term Advance Payment to Contractors For Project";
        }else if ($value === Config::get('constants.CONST_END_USE_CE')){
            $endUseLabelValue =  "Capital Expenditure";
        }else if ($value === Config::get('constants.CONST_END_USE_BRECP')){
            $endUseLabelValue =  "Business Running Expenses/Short Term Cashflow Mismatch/Tax Payment";
        }else if ($value === Config::get('constants.CONST_END_USE_PPE')){
            $endUseLabelValue =  "Promoters Personal Expenses";
        }else if ($value === Config::get('constants.CONST_END_USE_LTW')){
            $endUseLabelValue =  "Long Term WC";
        }
        return $endUseLabelValue;
    }

    public static function calculateAndFormatStatus($loan, $user){
        $loanStatus = "";
        if(isset($user) && isset($loan)){
            $originalLoanStatus = $loan->status;
            $calculatedLoanStatus = $originalLoanStatus;
            $fwdToBankStatus = Config::get('constants.CONST_LOAN_STATUS_TYPE_4');

            if($originalLoanStatus >= $fwdToBankStatus) {
                if ($user->isBankUser() && isset($user->bank_id)) {
                    $bankAllocation = $loan->getBankAllocationDetails($user->bank_id);

                    if(isset($bankAllocation)){
                        if(isset($bankAllocation->loan_status) && $bankAllocation->loan_status > 0){
                            $calculatedLoanStatus = $bankAllocation->loan_status;
                        }else{
                            $calculatedLoanStatus = $fwdToBankStatus;
                        }
                    }
                }
            }
                     
                    
            $loanStatus = self::formatStatusType($calculatedLoanStatus);
        }

        return $loanStatus;
    }

    public static function formatStatusType($value){
        $statusValue = $value;
        if ($value == Config::get('constants.CONST_LOAN_STATUS_TYPE_0') || $value == Config::get('constants.CONST_LOAN_STATUS_TYPE_1')){
            $statusValue =  "Application Form Pending";
        }else if ($value == Config::get('constants.CONST_LOAN_STATUS_TYPE_2')){
            $statusValue =  "Document Upload Pending";
        }else if($value == Config::get('constants.CONST_LOAN_STATUS_TYPE_3')){
            $statusValue = "Application Submitted";
        }else if ($value == Config::get('constants.CONST_LOAN_STATUS_TYPE_4')){
            $statusValue =  "Application Forwarded to Bank";
        }else if ($value == Config::get('constants.CONST_LOAN_STATUS_TYPE_5')){
            $statusValue =  "Query Received";
        }else if ($value == Config::get('constants.CONST_LOAN_STATUS_TYPE_20')){
            $statusValue =  "Approved";
        }else if ($value == Config::get('constants.CONST_LOAN_STATUS_TYPE_21')){
            $statusValue =  "Rejected";
        }else if ($value == Config::get('constants.CONST_LOAN_STATUS_TYPE_22')){
            $statusValue =  "Proposal Forwarded to Approver";
        }else if ($value == Config::get('constants.CONST_LOAN_STATUS_TYPE_23')){
            $statusValue =  "Proposal Rejected";
        }else if ($value == Config::get('constants.CONST_LOAN_STATUS_TYPE_24')){
            $statusValue =  "Proposal Approved";
        }

        return $statusValue;
    }
}