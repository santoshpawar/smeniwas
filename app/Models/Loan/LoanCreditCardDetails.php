<?php namespace App\Models\Loan;


use Illuminate\Database\Eloquent\Model;

class LoanCreditCardDetails extends Model{

    public $table = "loans_creditcard_details";

    protected $fillable = [
        'loan_id',
        'ccName',
        'ccOutstanding'
 
    ];

    public function getLoan(){
        return $this->belongsTo('App\Models\Loan\Loan','loan_id','id');
    }

}