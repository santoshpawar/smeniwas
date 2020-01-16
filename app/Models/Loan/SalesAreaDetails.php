<?php namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;

class SalesAreaDetails  extends Model {
    public $table = "loans_salesarea_details";

    protected $fillable = [
        'loan_id',
        'sales_area_type',
        'city_name',
        'city_name_1',
        'city_name_2',
        'multi_state_1',
        'multi_state_2',
        'multi_state_3',
        'multi_state_4',
        'multi_state_5'
    ];

    public function getLoan(){
        return $this->belongsTo('App\Models\Loan\Loan','loan_id','id');
    }

}