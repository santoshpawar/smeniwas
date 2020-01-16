<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableFinancialsProfitLoss extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('financials_profit_loss', function (Blueprint $table) {
            $table->double('repairs')->nullable()->after('advertising_cost');
            $table->double('legal_charges')->nullable()->after('repairs');
            $table->double('pbt')->nullable()->after('finance_cost');
            $table->double('current_tax')->nullable()->after('pbt');
            $table->double('deffered_tax')->nullable()->after('current_tax');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('financials_profit_loss', function (Blueprint $table) {
            $table->dropColumn(['repairs', 'legal_charges', 'pbt', 'current_tax', 'deffered_tax']); 
        });
    }
}
