<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVcfundNameColumnToLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->integer('com_venture_capital_funded')->nullable()->after('com_co_business_old');
            $table->string('com_name_of_vc_fund')->nullable()->after('com_venture_capital_funded');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn('com_venture_capital_funded');
            $table->dropColumn('com_name_of_vc_fund');
        });
    }
}
