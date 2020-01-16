<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('loans_overdraft_kyc_details', function(Blueprint $table)
       {
        $table->increments('id');
        $table->integer('loan_id')->unsigned();
        $table->foreign('loan_id')->references('id')->on('loans');

            //======KYC Details=====//
            $table->string('overName')->nullable(); //Your company has which of the following positions?
            $table->string('overOutstanding')->nullable();
            $table->string('overMonthlyEmi')->nullable();
        

            $table->timestamps();
            $table->softDeletes();
        });

       Schema::create('loans_vehicle_details', function(Blueprint $table)
       {
        $table->increments('id');
        $table->integer('loan_id')->unsigned();
        $table->foreign('loan_id')->references('id')->on('loans');

            //======KYC Details=====//
            $table->string('vehicleName')->nullable(); //Your company has which of the following positions?
            $table->string('vehicleOutstanding')->nullable();
            $table->string('vehicleMonthlyEmi')->nullable();
         

            $table->timestamps();
            $table->softDeletes();
        });

       Schema::create('loans_mortgage_details', function(Blueprint $table)
       {
        $table->increments('id');
        $table->integer('loan_id')->unsigned();
        $table->foreign('loan_id')->references('id')->on('loans');

            //======KYC Details=====//
            $table->string('mortName')->nullable(); //Your company has which of the following positions?
            $table->string('mortOutstanding')->nullable();
            $table->string('mortMonthlyEmi')->nullable();
            

            $table->timestamps();
            $table->softDeletes();
        }); 

       Schema::create('loans_creditCard_details', function(Blueprint $table)
       {
        
        $table->increments('id');
        $table->integer('loan_id')->unsigned();
        $table->foreign('loan_id')->references('id')->on('loans');

            //======KYC Details=====//
            $table->string('ccName')->nullable(); //Your company has which of the following positions?
            $table->string('ccOutstanding')->nullable();
           

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
         Schema::drop('loans_overdraft_kyc_details');
         Schema::drop('loans_vehicle_details');
         Schema::drop('loans_mortgage_details');
         Schema::drop('loans_creditCard_details');
    }
}
