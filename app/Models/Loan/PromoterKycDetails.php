<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/17/2015
 * Time: 11:55 AM
 */

namespace App\Models\Loan;


use Illuminate\Database\Eloquent\Model;

class PromoterKycDetails extends Model{

    public $table = "loans_promoter_kyc_details";

    protected $fillable = [
        'loan_id',
        'kyc_name',
        'kyc_address_proof',
        'kyc_proof_id',
        'kyc_pan',
        'kyc_din',
        'kyc_address',
        'kyc_state',
        'kyc_pin'
    ];

    public function getLoan(){
        return $this->belongsTo('App\Models\Loan\Loan','loan_id','id');
    }

}