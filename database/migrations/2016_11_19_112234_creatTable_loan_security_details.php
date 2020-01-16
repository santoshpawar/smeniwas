<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatTableLoanSecurityDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loans_security_details', function (Blueprint $table) {
            
       /* $table->string('natureOfInventory')->after('avl_doc_name_12');
        $table->string('typeOfInventory')->after('natureOfInventory');
        $table->string('otherSecurityOther')->after('typeOfInventory');  */
        $table->string('is_any_other_security')->after('otherSecurityOther');  
        //
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loans_security_details', function (Blueprint $table) {
            //
        });
    }
}
