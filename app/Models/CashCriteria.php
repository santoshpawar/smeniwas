<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CashCriteria extends Model
{
 
    protected $table='cash_criteria';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'loan_id', 'selectSources1', 'selectSources2', 'selectSources3', 'selectSources4', 'calculatedScore1', 
        'calculatedScore2', 'calculatedScore3', 'calculatedScore4', 'lastCashBalance', 'cashVSinvest', 
        'lowstClosingBalance', 'trendClosingBalance','liquidityRemark', 'effectivScore1', 'effectivScore2', 'effectivScore3', 'effectivScore4', 'cashFlowScore'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

  /*  public function SrcOfFund()
    {
        return $this->belongsTo('App\Models\SrcOfFund');
    }*/
 
}
