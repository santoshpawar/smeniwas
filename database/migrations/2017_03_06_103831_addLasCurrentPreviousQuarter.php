<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLasCurrentPreviousQuarter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::table('loan_against_shares', function (Blueprint $table) {
          
               $table->string('currentQuarter')->after('ratingAgencies');
               $table->string('previousQuarter')->after('currentQuarter');
             
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
