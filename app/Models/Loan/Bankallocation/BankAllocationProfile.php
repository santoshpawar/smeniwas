<?php

namespace App\Models\Loan\Bankallocation;

use Illuminate\Database\Eloquent\Model;

class BankAllocationProfile extends Model {

    public $table = "conf_bank_allocation_profile";

    protected $fillable = [
        'bank_id',
        'name',
        'description',
        'sortorder',
        'status',
    ];

    public function bank(){
        return $this->belongsTo('App\Models\BankMasterData','bank_id','id')->where('status','=','1');
    }

    public function categories(){
        return $this->hasMany('App\Models\Loan\Bankallocation\BankAllocationCategory','profile_id','id')->where('status','=','1');
    }

    public function isValidAllocation($loan, $user){
        if(!isset($this->categories)){
            return false;
        }

        foreach($this->categories as $category){
            if(!$category->isValidAllocation($loan, $user)){
                return false;
            }
        }

        return true;
    }
}