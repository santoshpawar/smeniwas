<?php

namespace App\Models\Loan\AnalystModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cache;

class AnalystModelCategory extends Model {
    public $table = "analyst_model_categories";

    protected $fillable = [
        'label',
        'description',
        'weight',
        'status'
    ];

    public function dimensions(){
        return $this->hasMany('App\Models\Loan\AnalystModel\AnalystModelDimension','category_id','id')->where('status','=','1');
    }

    public function mergeRecord($ratingDetailRecord){
        foreach($this->dimensions as $dimension){
            if($dimension->id == $ratingDetailRecord->dimension_id){
                $dimension->is_applicable = $ratingDetailRecord->is_applicable;
                $dimension->selected_measure_id = $ratingDetailRecord->measure_id;
                $dimension->selected_rating_details_id = $ratingDetailRecord->id;
                return true;
            }
        }

        return false;
    }

    public function autoCalculateRatioMeasures($ratiosList){
        foreach($this->dimensions as $dimension){
            if($dimension->hasRatio() && $ratiosList->has($dimension->ratio_id)){
                $ratio = $ratiosList->get($dimension->ratio_id);
                $dimension->autoCalculateMeasureValue($ratio->value);
            }
        }
    }

    public function autoCalculateDefaults($loan){
       
        if(!isset($loan)){
            return;
        }

        foreach($this->dimensions as $dimension){
            if($dimension->hasTrend()){
                $dimension->calculateTrend($loan);
            }else{
                $dimension->calculateDefault($loan);
            }
        }
    }

    private static function fetchAnalystModelCategory($keyName, $addEmptyFirstElement=true){
        $cacheTimeout = Config::get('constants.MD_CACHE_TIMEOUT');
        $categoryData = null;
        Cache::forget($keyName);

        if(Cache::has($keyName)){
            $categoryData = Cache::get($keyName);
        }else{
            $categoryData = AnalystModelDimension::where('label', "=", $keyName)->lists('label','weight')->all();
            if($addEmptyFirstElement) {
                $categoryData = array(NULL => '') + $categoryData;
            }
            Cache::put($keyName, $categoryData, $cacheTimeout);
        }
        return $categoryData;
    }
}