<?php

namespace App\Models\Loan\Bankallocation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAllocationSubDimension extends Model {

    public $table = "conf_bank_allocation_sub_dimension";
    use SoftDeletes;
    protected $fillable = [
        'dimension_id',
        'value',
        'status',
    ];

    public function dimension(){
        return $this->belongsTo('App\Models\Bankallocation\BankAllocationDimension','dimension_id','id')->where('status','=','1');
    }
}