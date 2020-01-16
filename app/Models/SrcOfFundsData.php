<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SrcOfFundsData extends Model
{
 
    protected $table='src_of_funds_data';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'loan_id','src_id','speriod_1','speriod_2','speriod_3','speriod_4','speriod_5','speriod_6'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

  /*  public function SrcOfFund()
    {
        return $this->belongsTo('App\Models\SrcOfFund');
    }*/
 
}
