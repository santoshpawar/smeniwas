<?php

namespace App\Models\Common;

use App\Models\MasterData;
use Illuminate\Database\Eloquent\Model;
use App\Models\Loan\AnalystModel\AnalystModelMeasure;

class ConfIndustryTypeSectorOutlookMapping extends Model {
    public $table = "conf_industry_type_sector_outlook_mapping";

    protected $fillable = [
        'master_data_id',
        'sector_outlook_measure_id',
        'status'
    ];

    public static function getMasterDataId($masterDataId){
        $masterData = MasterData::where('id', '=', $masterDataId)->where('type', '=', 'INDUSTRY_TYPE')->get()->first();
        if(isset($masterData)){
            return $masterData->name;
        }

        return null;
    }

    public static function getMeasureId($sectorOutlookMeasureId){
        $measureData = AnalystModelMeasure::where('id', '=', $sectorOutlookMeasureId)->get()->first();
        if(isset($measureData)){
            return $measureData->label;
        }

        return null;
    }

    public static function getMappedMeasureId($industryType){
        $masterData = MasterData::where('name', '=', $industryType)->where('type', '=', 'INDUSTRY_TYPE')->get()->first();
        if(isset($masterData)){
            $masterDataId = $masterData->id;
            $record = ConfIndustryTypeSectorOutlookMapping::where('master_data_id','=', $masterDataId)->get()->first();
            if(isset($record)){
                return $record->sector_outlook_measure_id;
            }
        }

        return null;
    }
}