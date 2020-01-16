<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPatColumnToFinantialProfitLossTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('financials_profit_loss', function (Blueprint $table) {
            $table->double('pat')->nullable()->after('tax');
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
            $table->dropColumn('pat');
        });
    }
}
