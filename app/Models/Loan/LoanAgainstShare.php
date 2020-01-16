<?php namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
class LoanAgainstShare extends Model
{
	    public $table = "loan_against_shares";
	protected $fillable=[
	'id',
	'loan_id',
	'dailyVolume',
	'pramoterHolding',
	'percentageHolding',
	'currentQuarter',
	'previousQuarter',
	'highPrice',
	'lowPrice',
	'lastOneMonthPrice',
	'marketCapitalisation',  
	'ratingAgencies',
	'creditRatingof'
	];
	public function getLoan(){
		return $this->belongsTo('App\Models\Loan\Loan','loan_id','id');
	}
	public function getUser(){
		return $this->belongsTo('App\Models\User','user_id','id');
	}
}
