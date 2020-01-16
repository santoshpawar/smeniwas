<?php namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;

class PromoterDetails extends Model {

    public $table = "loans_promoter_details";

    protected $fillable = [
        'loan_id',
        'fin_vehiclesowned',
        'fin_vehiclesowned_marketvalue',
        'fin_propertiesowned',
        'fin_fixeddeposit',
        'fin_mutualfunds',
        'fin_listedshares',
        'pl_bankname',
        'pl_amtoutstanding',
        'pl_monthlyemi',
        'pl_totalliability',
        'vloan_bankname',
        'vloan_amtoutstanding',
        'vloan_monthlyemi',
        'vloan_totalliability',
        'mortloan_bankname',
        'mortloan_amtoutstanding',
        'mortloan_monthlyemi',
        'mortloan_totalliability',
        'borrowloan_bankname',
        'borrowloan_amtoutstanding',
        'borrowloan_monthlyemi',
        'borrowloan_totalliability',
        'cc_bankname',
        'cc_amtoutstanding',
        'total_liablity',
        'networth',
        'othr_eduprofdegree',
        'othr_promoterare',
        'othr_noofindependent',
        'othr_sourceofincome',
        'othr_doyouknowcibil',
        'othr_cibilscore',
    ];

    public function getLoan(){
        return $this->belongsTo('App\Models\Loan\Loan','loan_id','id');
    }

}