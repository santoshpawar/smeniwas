<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankAllocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conf_bank_allocation_profile', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('bank_id')->unsigned()->references('id')->on('bank_master_datas');
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->integer('sortorder');
            $table->string('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('conf_bank_allocation_category', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('profile_id')->unsigned()->references('id')->on('conf_bank_allocation_profile');
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('sortorder');
            $table->string('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('conf_bank_allocation_dimension', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('category_id')->unsigned()->references('id')->on('conf_bank_allocation_category');
            $table->string('type');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('model')->nullable();
            $table->string('attribute')->nullable();
            $table->string('operand')->nullable();
            $table->double('single_value')->nullable();
            $table->double('begin_range')->nullable();
            $table->double('end_range')->nullable();
            $table->integer('sortorder');
            $table->string('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('conf_bank_allocation_sub_dimension', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('dimension_id')->unsigned()->references('id')->on('conf_bank_allocation_dimension');
            $table->string('value')->nullable();
            $table->string('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('loans_bank_allocations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('loan_id')->unsigned()->references('id')->on('loans');
            $table->integer('bank_id')->unsigned()->references('id')->on('bank_master_datas');
            $table->integer('allocation_type')->unsigned();
            $table->integer('loan_status')->unsigned();
            $table->string('bank_query_status')->nullable();
            $table->longText('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['loan_id', 'bank_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('loans_bank_allocations');
        Schema::drop('conf_bank_allocation_profile');
        Schema::drop('conf_bank_allocation_category');
        Schema::drop('conf_bank_allocation_dimension');
        Schema::drop('conf_bank_allocation_sub_dimension');
    }
}
