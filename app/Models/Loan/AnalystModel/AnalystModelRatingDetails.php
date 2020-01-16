<?php

namespace App\Models\Loan\AnalystModel;

use Illuminate\Database\Eloquent\Model;

class AnalystModelRatingDetails extends Model {

    public $table = "analyst_model_rating_details";

    protected $fillable = [
        'id',
        'ratings_id',
        'dimension_id',
        'measure_id',
        'is_applicable',
        'status'
    ];
}