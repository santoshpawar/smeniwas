<?php

namespace App\Models\Loan\Bankallocation;

use Illuminate\Database\Eloquent\Model;

class BankAllocationCategory extends Model {
    public $table = "conf_bank_allocation_category";

    protected $fillable = [
        'profile_id',
        'name',
        'description',
        'sortorder',
        'status',
    ];

    public function profile(){
        return $this->belongsTo('App\Models\Bankallocation\BankAllocationProfile','profile_id','id')->where('status','=','1');
    }

    public function dimensions(){
        return $this->hasMany('App\Models\Loan\Bankallocation\BankAllocationDimension','category_id','id')->where('status','=','1');
    }

    public function isValidAllocation($loan, $user){
        if(!isset($this->dimensions)){
            return false;
        }

        foreach($this->dimensions as $dimension){
            if(!$dimension->isValidAllocation($loan, $user)){
                return false;
            }
        }

        return true;
    }
}