<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSharesColumnToLoans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('loans', function($table)
       {
        
        //$table->integer('loan_tenure')->nullable(); //Tenure in Year
        $table->string('bscNscCode')->after('loan_tenure');  //
        $table->string('companySharePledged')->after('bscNscCode');
        });
   }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('loans');
    }
}
