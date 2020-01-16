<?php

namespace App\Models\Loan\AnalystModel;

use Illuminate\Database\Eloquent\Model;

class AnalystModelRating extends Model {

    public $table = "analyst_model_ratings";
    protected $fillable = [
        'loan_id',
        'model_type',
        'property',
        'valueOfProperty',
        'expectedSale',
        'final_rating',
        'developer_funding_type',
        'has_defect',
        'defect_type_id',
        'final_score',
        'final_haircut',
        'status'
    ];



    public function ratingDetails(){
        return $this->hasMany('App\Models\Loan\AnalystModel\AnalystModelRatingDetails','ratings_id','id')->where('status','=','1');
    }
}