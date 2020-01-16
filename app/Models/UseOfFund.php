<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UseOfFund extends Model
{
    
  // protected $table = 'uses_of_funds';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name'
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
