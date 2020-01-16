<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsesOfFundsData extends Model
{
 
    protected $table='uses_of_funds_data';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'loan_id','uses_id','uperiod_1','uperiod_2','uperiod_3','uperiod_4','uperiod_5','uperiod_6'
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
