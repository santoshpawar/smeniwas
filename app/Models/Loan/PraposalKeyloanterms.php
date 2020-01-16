<?php namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;
 
class PraposalKeyloanterms extends Model
{
	    public $table = "praposal_keyloanterm";
	protected $fillable=[
	'id', 'loan_id', 'borrower','lender','guarantors','amount','purpose','facility','tenor','interest_rate','processing_fee','legal_fee',
	'repayment_schedule','prepayment_penalty','security','pre_disbursement_conditions','fin_conv_debt_ebitda','fin_conv_debt_equity_ratio',
	'fin_conv_current_ratio','other_convenants_standerds_withaddiotion','fin_conv_interest_cov_ratio','fin_conv_other','other_convenants_standerds_withaddiotion',
	'recomndation','lastRowriskMitigants'];
	public function getLoan(){
		return $this->belongsTo('App\Models\Loan\Loan','loan_id','id');
	}
	public function getUser(){
		return $this->belongsTo('App\Models\User','user_id','id');
	}
}
