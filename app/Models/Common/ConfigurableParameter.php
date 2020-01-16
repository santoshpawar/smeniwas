<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class ConfigurableParameter extends Model {
    public $table = "conf_parameters";

    protected $fillable = [
        'model',
        'parameter_name',
        'description',
        'parameter_value',
        'status'
    ];

    public static function getParamValueOrDefault($modelName, $parameterName, $defaultValue = null){
        $foundModel = ConfigurableParameter::where('model','=',$modelName)
            ->where('parameter_name','=',$parameterName)
            ->where('status','=', 1)->get()->first();

        if(!isset($foundModel)){
            if(isset($defaultValue)){
                return $defaultValue;
            }else{
                return null;
            }
        }
        if(isset($foundModel->parameter_value)){
            return $foundModel->parameter_value;
        }

        if(isset($defaultValue)){
            return $defaultValue;
        }

        return null;
    }
}