<?php

namespace App\Models\Loan\FinancialData;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Cashflow extends Model {

    public $table = "financials_cashflow";

    protected $fillable = [
        'loan_id',
        'cashflow_id',
        'period',
        'name',
        'value',
    ];

    public static function periodsCashflowIdMap($loanId){
        $savedCashflowsList = Cashflow::where('loan_id','=', $loanId)->get();
        $periodsCashflowIdMap = new Collection();
        foreach($savedCashflowsList as $cashflowRecord){
            $period = $cashflowRecord->period;
            $cashflowIdMap = null;
            if($periodsCashflowIdMap->offsetExists($period)){
                $cashflowIdMap = $periodsCashflowIdMap->offsetGet($period);
            }else{
                $cashflowIdMap = new Collection();
                $periodsCashflowIdMap->offsetSet($period, $cashflowIdMap);
            }

            $cashflowIdMap->put($cashflowRecord->cashflow_id, $cashflowRecord);
        }

        return $periodsCashflowIdMap;
    }
}