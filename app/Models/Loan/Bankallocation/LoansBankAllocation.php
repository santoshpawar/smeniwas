<?php

namespace App\Models\Loan\Bankallocation;

use Illuminate\Database\Eloquent\Model;

class LoansBankAllocation extends Model {

    public $table = "loans_bank_allocations";

    protected $fillable = [
        'loan_id',
        'bank_id',
        'allocation_type',
        'loan_status',
        'bank_query_status',
        'remarks',
    ];

    public function loan(){
        return $this->belongsTo('App\Models\Loan\Loan','loan_id','id');
    }

    public function bank(){
        return $this->belongsTo('App\Models\BankMasterData','bank_id','id');
    }
}