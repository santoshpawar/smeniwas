<?php namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;

class ExistingLoanDetail extends Model {
    public $table = "loans_existingloan_details";

    protected $fillable = [
        'loan_id',
        'name',
        'loan_type',
        'amount_outstanding',
        'amount_monthlyemi',
        'balance_tenure',
        'security_provided'
    ];

    public function getLoan(){
        return $this->belongsTo('App\Models\Loan\Loan','loan_id','id');
    }
}