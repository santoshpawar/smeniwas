<?php

namespace App\Models\Loan\FinancialData;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class FinancialGroup extends Model {
    public $table = "conf_financial_groups";

    protected $fillable = [
        'group_id',
        'type',
        'name',
        'description',
        'sortorder',
        'status'
    ];

    public function financialEntries(){
        return $this->hasMany('App\Models\Loan\FinancialData\FinancialEntry','group_id','id')->where('status',"=",1)->orderBy('sortOrder');
    }

    public function isRatio()
    {
        $ratioType = Config::get('constants.CONST_FIN_GROUP_TYPE_RATIO');
        if(strcmp($this->type, $ratioType) === 0){
            return true;
        }
        else {
            return false;
        }
    }
}