<?php namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;

class CompetitorDetail extends Model {
    public $table = "loans_security_details";

    protected $fillable = [
        'loan_id',
        'name',
        'competitor_type'
    ];

    public function getLoan(){
        return $this->belongsTo('App\Models\Loan\Loan','loan_id','id');
    }
}