<?php namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;

class ProfitLossDetail  extends Model {
    public $table = "loans_profitloss_details";

    protected $fillable = [
        'loan_id',
        'finyear',
        'sales',
        'revenue',
        'ebitda_profit',
        'interest_expense',
        'pat'
    ];

    public function getLoan(){
        return $this->belongsTo('App\Models\Loan\Loan','loan_id','id');
    }

}