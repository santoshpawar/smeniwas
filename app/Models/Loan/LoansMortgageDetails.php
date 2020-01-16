<?php
 

namespace App\Models\Loan;


use Illuminate\Database\Eloquent\Model;

class LoansMortgageDetails extends Model{

    public $table = "loans_mortgage_details";

    protected $fillable = [
        'loan_id',
        'mortName',
        'mortOutstanding',
        'mortOutstanding'
         
    ];

    public function getLoan(){
        return $this->belongsTo('App\Models\Loan\Loan','loan_id','id');
    }

}