<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClosingSrcUses extends Model
{
 
    protected $table='closing_src_uses';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'loan_id','cPeriod_1','cPeriod_2','cPeriod_3','cPeriod_4','cPeriod_5','cPeriod_6'
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
