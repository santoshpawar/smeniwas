<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanAgainstSharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_against_shares', function (Blueprint $table) {
         $table->increments('id');
         $table->integer('loan_id')->unsigned();
         $table->foreign('loan_id')->references('id')->on('loans');

         $table->integer('dailyVolume')->unsigned();
         $table->double('pramoterHolding')->unsigned();
         $table->double('percentageHolding')->unsigned();
         $table->integer('highPrice')->unsigned();
         $table->integer('lowPrice')->unsigned();
         $table->integer('lastOneMonthPrice')->unsigned();
  

         $table->timestamps();
         $table->softDeletes();
     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('loan_against_shares');
    }
}
