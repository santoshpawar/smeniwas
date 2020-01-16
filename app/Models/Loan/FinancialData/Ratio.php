<?php

namespace App\Models\Loan\FinancialData;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Ratio extends Model {

    public $table = "financials_ratios";

    protected $fillable = [
        'loan_id',
        'ratio_id',
        'period',
        'name',
        'value',
    ];

    public static function periodsRatioIdMap($loanId){
        $savedRatiosList = Ratio::where('loan_id','=', $loanId)->get();
        $periodsRatioIdMap = new Collection();
        foreach($savedRatiosList as $ratioRecord){
            $period = $ratioRecord->period;
            $ratioIdMap = null;
            if($periodsRatioIdMap->offsetExists($period)){
                $ratioIdMap = $periodsRatioIdMap->offsetGet($period);
            }else{
                $ratioIdMap = new Collection();
                $periodsRatioIdMap->offsetSet($period, $ratioIdMap);
            }

            $ratioIdMap->put($ratioRecord->ratio_id, $ratioRecord);
        }

        return $periodsRatioIdMap;
    }
}