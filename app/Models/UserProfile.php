<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserProfile extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id',
        'referredby_userid',
        'name_of_firm',
        'owner_entity_type',
        'natureOfBusinessActivity',
        'owner_name',
        'address',
        'owner_city',
        'owner_state',
        'pincode',
        'contact1',
        'contact2',
        'latest_turnover',
        'owner_purpose_of_loan',
        'required_amount'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function registeredAddress(){
        return $this->belongsTo('App\Models\Address','registered_address_id','id');
    }
    public function operatingAddress(){
        return $this->belongsTo('App\Models\Address','operating_address_id','id');
    }

    public function subsidiary(){
        return $this->hasOne('App\Models\UserProfile','id','subsidiary_id')->first();
    }

    public function parentCompany(){
        return $this->belongsTo('App\Models\UserProfile','id', 'subsidiary_id');
    }

    public function getLoans(){
        return $this->hasMany('App\Models\Loan\Loan','user_id','user_id');
    }
}
