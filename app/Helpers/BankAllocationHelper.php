<?php

namespace App\Helpers;

use App\Models\BankMasterData;
use App\Models\Loan\Bankallocation\BankAllocationProfile;
use App\Models\Loan\Bankallocation\LoansBankAllocation;
use Config;
use Log;

class BankAllocationHelper {

    public function allocate($loan, $user){
        $profiles = BankAllocationProfile::with('bank', 'categories', 'categories.dimensions', 'categories.dimensions.subDimensions')->where('status','=', 1)->get();
        foreach($profiles as $profile){
            Log::debug("Beginning Bank Allocation check for profile, loan - ", [$profile->name, $loan->id]);
            if($profile->isValidAllocation($loan, $user)){
                if(isset($profile->bank)) {
                    $bank = $profile->bank;
                    $this->performAllocation($loan, $bank);
                    Log::debug("Bank Allocation succeeded for profile, loan ", [$profile->name, $loan->id, $bank->id]);
                }else{
                    Log::debug("Bank Allocation check did not pass for profile, loan - ", [$profile->name, $loan->id]);
                }
            }else{
                Log::debug("Bank Allocation check did not pass for profile, loan - ", [$profile->name, $loan->id]);
            }
            Log::debug("Completed Bank Allocation check for profile, loan - ", [$profile->name, $loan->id]);
        }

        $nonProfilesBankList = BankMasterData::whereNotIn('id', $profiles->lists('bank_id'))->get();

        foreach($nonProfilesBankList as $nonBankProfile){
            $this->performAllocation($loan, $nonBankProfile);
            Log::debug("Bank Allocation check for bank without profile, loan - ", [$nonBankProfile->name, $loan->id]);
        }
    }

    protected function performAllocation($loan, $bank){
        Log::debug("Performing Bank Allocation for loan, bank ", [$loan->id, $bank->id]);
        $existingRecords = LoansBankAllocation::where('loan_id','=', $loan->id)->where('bank_id', '=', $bank->id)->get();
        if(!isset($existingRecords) || $existingRecords->count()==0){
            $newAllocation = new LoansBankAllocation();
            $newAllocation->loan_id = $loan->id;
            $newAllocation->bank_id = $bank->id;
            $newAllocation->allocation_type = 1;
            $newAllocation->save();
            Log::debug("Saved Bank Allocation for loan, bank ", [$loan->id, $bank->id]);
        }
        Log::debug("Performed Bank Allocation for loan, bank ", [$loan->id, $bank->id]);
    }

    public function calculateBankAllocationStatus($loanId){
        $allocations = LoansBankAllocation::where('loan_id', '=', $loanId)->get();
        $allocationStatus = Config::get('constants.CONST_LOAN_STATUS_TYPE_4');
        $isAnyAllocationPending = false;
        $isAnyAllocationApproved = false;
        $isAnyAllocationRejected = false;
        $areAllAllocationsRejected = false;

        foreach($allocations as $allocation){
            if($allocation->loan_status == Config::get('constants.CONST_LOAN_STATUS_TYPE_0')) {
                $isAnyAllocationPending = true;
            }else if($allocation->loan_status == Config::get('constants.CONST_LOAN_STATUS_TYPE_20')){
                $isAnyAllocationApproved = true;
            }else if($allocation->loan_status == Config::get('constants.CONST_LOAN_STATUS_TYPE_21')){
                $isAnyAllocationRejected = true;
            }
        }


        if($isAnyAllocationRejected && !$isAnyAllocationApproved && !$isAnyAllocationPending) {
            $areAllAllocationsRejected = true;
        }

        if($isAnyAllocationApproved) {
            $allocationStatus = Config::get('constants.CONST_LOAN_STATUS_TYPE_20');
        }else if($areAllAllocationsRejected){
            $allocationStatus = Config::get('constants.CONST_LOAN_STATUS_TYPE_21');
        }

        return $allocationStatus;
    }
}