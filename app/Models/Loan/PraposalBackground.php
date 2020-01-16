<?php namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;
 
class PraposalBackground extends Model
{
	    public $table = "praposal_background";
	protected $fillable=[
	'id', 'loan_id', 'borrower_name', 'promoter_name', 'praposal_source', 'legal_entity_type', 'com_industry_segment','com_business_type',
	 'customer', 'business_address', 'niwas_branch_officer',  'amount' ,  'praposedAmount' , 'finalAmount' ,  'security' ,
	  'existingTenor' ,  'praposedTenor' ,  'totalTenor' ,    'existingInterestRate' ,  'praposedInterestRate' ,
	    'totalInterestRate' , 'dealy', 'disbursement_date', 'loan_purpose','security','praposalSourceOthers','existingLoan'
	];
	public function getLoan(){
		return $this->belongsTo('App\Models\Loan\Loan','loan_id','id');
	}
	public function getUser(){
		return $this->belongsTo('App\Models\User','user_id','id');
	}
}
