<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/17/2015
 * Time: 11:55 AM
 */

namespace App\Models\Loan;


use Illuminate\Database\Eloquent\Model;

class LoanOverdraftKycDetails extends Model{

    public $table = "loans_overdraft_kyc_details";

    protected $fillable = [
        'loan_id',
        'kyc_name',
        'overName',
        'overOutstanding',
        'overMonthlyEmi',
         
    ];

    public function getLoan(){
        return $this->belongsTo('App\Models\Loan\Loan','loan_id','id');
    }

}