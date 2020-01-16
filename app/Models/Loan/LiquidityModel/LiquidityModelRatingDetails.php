<?php

namespace App\Models\Loan\LiquidityModel;

use Illuminate\Database\Eloquent\Model;

class LiquidityModelRatingDetails extends Model {

    public $table = "liquidity_model_rating_details";

    protected $fillable = [
        'id',
        'ratings_id',
        'dimension_id',
        'measure_id',
        'is_applicable',
        'status'
    ];
}