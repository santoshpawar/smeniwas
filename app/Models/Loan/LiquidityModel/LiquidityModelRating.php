<?php

namespace App\Models\Loan\LiquidityModel;

use Illuminate\Database\Eloquent\Model;

class LiquidityModelRating extends Model {

    public $table = "liquidity_model_ratings";
    protected $fillable = [
        'loan_id',
        'model_type',
        'final_rating',
        'developer_funding_type',
        'has_defect',
        'defect_type_id',
        'final_score',
        'final_haircut',
        'status'
    ];

    public function ratingDetails(){
        return $this->hasMany('App\Models\Loan\LiquidityModel\LiquidityModelRatingDetails','ratings_id','id')->where('status','=','1');
    }
}