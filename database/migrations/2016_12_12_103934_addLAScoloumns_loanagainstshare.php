<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLAScoloumnsLoanagainstshare extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loan_against_shares', function (Blueprint $table) {
               $table->string('ratingAgencies')->after('lastOneMonthPrice');
               $table->string('creditRatingof')->after('ratingAgencies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loan_against_shares', function (Blueprint $table) {
            //
        });
    }
}
