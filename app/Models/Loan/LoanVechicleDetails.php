<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/17/2015
 * Time: 11:55 AM
 */

namespace App\Models\Loan;


use Illuminate\Database\Eloquent\Model;

class LoanVechicleDetails extends Model{

    public $table = "loans_vehicle_details";

    protected $fillable = [
        'loan_id',
        'vehicleName',
        'vehicleOutstanding',
        'vehicleMonthlyEmi',
         
         
    ];

    public function getLoan(){
        return $this->belongsTo('App\Models\Loan\Loan','loan_id','id');
    }

}