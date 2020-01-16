<?php namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;
 
class PraposalDetails extends Model
{
	    public $table = "praposal_details";
	protected $fillable=[
	'id', 'loan_id', 'promoterBackground', 'lastAuditedTurnover', 'vintageBusiness', 'briefProducts', 
	'briefCustomers', 'historyEquityInfusion', 'commentaryProfitability', 'commentaryLiquidityWC', 
	'commentaryBalanceSheet', 'totalBorrowing6Month', 'amountHighCostGT16Loans', 'detailsLoanPurpose','othr_eduprofdegree'
	];
	public function getLoan(){
		return $this->belongsTo('App\Models\Loan\Loan','loan_id','id');
	}
	public function getUser(){
		return $this->belongsTo('App\Models\User','user_id','id');
	}
}
