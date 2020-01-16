<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShortTermProvisionsColumnToFinancialsBalanceSheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('financials_balance_sheet', function (Blueprint $table) {
            $table->double('short_term_provisions')->nullable()->after('curr_long_term_debt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('financials_balance_sheet', function (Blueprint $table) {
            $table->dropColumn('short_term_provisions');
        });
    }
}
