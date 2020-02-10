<?php namespace App\Models\Loan\LoanRepayment;

use Illuminate\Database\Eloquent\Model;

class LoanRepaymentsDetails extends Model
{
 public $table = "loans_repayment_details";
 protected $fillable=[
 
  'loan_id' ,
  'month',
  'date',
  'noOfDays',
  'chequeNo',
  'loanOutstanding',
  'intersetDue',
  'principalDue',
  'tds',
  'netInterest',
  'netAmountDue',
  'totalDue',
  'receipt',
  'arrears',
  'penalInterest',
  'cumIntEarned'

];
public function getLoan(){
  return $this->belongsTo('App\Models\Loan\Loan','loan_id','id');
} 

//use App\Models\Loan\LoanRepayment\LoanRepaymentsDetails;
/*public function getLoanRepayments(){
  return $this->belongsTo('App\Models\Loan\LoanRepayment\LoanRepaymentsDetails','loan_id','id');
}*/
public function getUser(){
  return $this->belongsTo('App\Models\User','user_id','id');
}
}
