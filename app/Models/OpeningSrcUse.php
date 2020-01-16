<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpeningSrcUse extends Model
{
 
    protected $table='opening_src_uses';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'loan_id','surPeriod_1','surPeriod_2','surPeriod_3','surPeriod_4','surPeriod_5','surPeriod_6'
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
