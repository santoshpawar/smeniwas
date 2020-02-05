<?php 
namespace App\Models\Loan\LoanRepayment;
use Illuminate\Database\Eloquent\Model;
 
class LoanRepayments extends Model
{
	public $table = "loan_repayment_Master";
	protected $fillable=[
	 'id', 
   'loan_id',
   'TypeofLoan',
   'TypeofRepayment',
   'principal',
   'interest',
   'loan_amount',
   'tenor',
   'loanDisDate',
   'emiStartDate',
   'moratorium',
    'tds',
  'penalRate'
 

	];
	public function getLoan(){
		return $this->belongsTo('App\Models\Loan\Loan','loan_id','id');

	}
	public function getUser(){
		return $this->belongsTo('App\Models\User','user_id','id');
	}	
	public function getRepaymentDetails(){
		return $this->belongsTo('App\Models\LoanRepayment\LoanRepaymentsDetails','loan_id','loan_id');
	}
}
