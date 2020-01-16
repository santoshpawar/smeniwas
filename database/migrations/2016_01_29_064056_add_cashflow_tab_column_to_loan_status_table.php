<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCashflowTabColumnToLoanStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loans_status', function (Blueprint $table) {
            $table->string('cashflow')->nullable()->after('input_p&l');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loans_status', function (Blueprint $table) {
            $table->dropColumn('cashflow');
        });
    }
}
