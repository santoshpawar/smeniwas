<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsesTotal extends Model
{
 
    protected $table='uses_total';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'loan_id','utPeriod_1','utPeriod_2','utPeriod_3','utPeriod_4','utPeriod_5','utPeriod_6'
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
