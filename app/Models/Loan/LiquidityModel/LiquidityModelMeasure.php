<?php

namespace App\Models\Loan\LiquidityModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LiquidityModelMeasure extends Model {

    use SoftDeletes;
    public $table = "liquidity_model_measures";

    protected $fillable = [
        'dimension_id',
        'label',
        'description',
        'dimension_type',
        'measure',
        'operand',
        'single_value',
        'begin_range',
        'end_range',
        'status'
    ];

    public function dimension(){
        return $this->belongsTo('App\Models\Loan\LiquidityModel\LiquidityModelDimension','dimension_id','id')->where('status','=','1');
    }
}