<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPropertyLandLoansSecurityDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loans_security_details', function (Blueprint $table) {
               $table->string('propertyLand')->after('collateral_type');
               $table->double('valuOfInventory')->after('typeOfInventory');
               $table->string('nameOfLessor')->after('propertyLand');
               $table->integer('is_any_other_security_no')->after('nameOfLessor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loans_security_detail', function (Blueprint $table) {
            //
        });
    }
}
