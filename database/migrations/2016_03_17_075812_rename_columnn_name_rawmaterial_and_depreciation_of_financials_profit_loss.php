<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnnNameRawmaterialAndDepreciationOfFinancialsProfitLoss extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('financials_profit_loss', function (Blueprint $table) {
            $table->renameColumn('raw_materials', 'raw_materials_cost');
            $table->renameColumn('depreciation', 'depreciation_cost');
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
            $table->renameColumn('raw_materials_cost', 'raw_materials');
            $table->renameColumn('depreciation_cost', 'depreciation');
        });
    }
}
