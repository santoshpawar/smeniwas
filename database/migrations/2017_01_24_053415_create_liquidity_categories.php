<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiquidityCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquidity_model_categories', function (Blueprint $table) {
            $table->increments('id');
       
            $table->string('type');
            $table->string('label');
            $table->string('description');
            $table->double('weight');
            $table->string('status');
            $table->timestamps();
         
            $table->softDeletes();
        });
        Schema::create('liquidity_model_dimensions', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('liquidity_model_categories');
            $table->integer('parent_dimension_id')->unsigned()->nullable();
            $table->foreign('parent_dimension_id')->references('id')->on('liquidity_model_dimensions');
            $table->integer('ratio_id')->unsigned()->nullable();
            $table->foreign('ratio_id')->references('id')->on('conf_financial_entries');
            $table->integer('dimension_type'); //0 - Single, 1 - Parent; 2 - Hybrid
            $table->string('label');
            $table->string('description');
            $table->double('weight');
            $table->boolean('is_applicable');
            $table->boolean('is_trend');
            $table->string('model')->nullable();
            $table->string('attribute')->nullable();
            $table->integer('status');
            $table->integer('sortorder')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('liquidity_model_measures', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('dimension_id')->unsigned();
            $table->foreign('dimension_id')->references('id')->on('liquidity_model_dimensions');
            $table->string('label');
            $table->string('description')->nullable();
            $table->double('measure');
            $table->string('operand')->nullable();
            $table->double('single_value')->nullable();
            $table->double('begin_range')->nullable();
            $table->double('end_range')->nullable();
            $table->integer('status');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('liquidity_model_ratings', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('loan_id')->unsigned();
            $table->foreign('loan_id')->references('id')->on('loans');
            $table->double('total_score');
            $table->string('model_type');
            $table->string('final_rating')->nullable();
            $table->boolean('developer_funding_type')->nullable();
            $table->boolean('has_defect')->nullable();
            $table->integer('defect_type_id')->unsigned()->nullable();
            $table->foreign('defect_type_id')->references('id')->on('master_data');
            $table->double('final_score');
            $table->double('final_haircut')->nullable();
            $table->integer('status');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('liquidity_model_rating_details', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('ratings_id')->unsigned();
            $table->foreign('ratings_id')->references('id')->on('liquidity_model_ratings');
            $table->integer('dimension_id')->unsigned();
            $table->foreign('dimension_id')->references('id')->on('liquidity_model_dimensions');
            $table->integer('measure_id')->unsigned();
            $table->foreign('measure_id')->references('id')->on('liquidity_model_measures');
            $table->boolean('is_applicable');
            $table->integer('status');
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
       Schema::drop('liquidity_model_rating_details');
        Schema::drop('liquidity_model_ratings');
        Schema::drop('liquidity_model_measures');
        Schema::drop('liquidity_model_dimensions');
        Schema::drop('liquidity_model_categories');
    }
}
