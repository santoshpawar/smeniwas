<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SrcTotal extends Model
{
 
    protected $table='src_total';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'loan_id','stPeriod_1','stPeriod_2','stPeriod_3','stPeriod_4','stPeriod_5','stPeriod_6','stPeriod_7'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

/*    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
 */
}
