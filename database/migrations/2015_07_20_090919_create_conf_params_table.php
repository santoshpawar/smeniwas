<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfParamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conf_parameters', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('model')->nullable();
            $table->string('parameter_name')->unique();
            $table->text('description')->nullable();
            $table->text('parameter_value');
            $table->string('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';
        });

        Schema::create('conf_industry_type_sector_outlook_mapping', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('master_data_id')->unsigned()->references('id')->on('master_data')->unique();
            $table->integer('sector_outlook_measure_id')->unsigned()->references('id')->on('analyst_model_measures');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('conf_parameters');
        Schema::drop('conf_industry_type_sector_outlook_mapping');
    }
}
