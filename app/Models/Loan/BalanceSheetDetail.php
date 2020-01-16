<?php

namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;

class BalanceSheetDetail extends Model {
    public $table = "loans_balancesheet_details";

    protected $fillable = [
        'loan_id',
        'finyear',
        'networth',
        'total_debt',
        'term_debt',
        'debtors',
        'inventory',
        'creditors',
        'net_fixed_assets'
    ];

    public function getLoan(){
        return $this->belongsTo('App\Models\Loan\Loan','loan_id','id');
    }
}