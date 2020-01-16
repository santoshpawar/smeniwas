<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveReceivablesColumnsFromFinancialBalanceSheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('financials_balance_sheet', function (Blueprint $table) {
            $table->dropColumn(['receivables_less_180', 'receivables_more_180']);            
        });
    }
}
