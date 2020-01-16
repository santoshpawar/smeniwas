<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('password_resets', function(Blueprint $table)
		{
			$table->string('email')->index();
			$table->string('token')->index();
			$table->timestamp('created_at');
		});

		Schema::create('user_profiles', function(Blueprint $table)
		{
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('referredby_userid')->unsigned()->nullable();
            $table->foreign('referredby_userid')->references('id')->on('users');

            $table->string('name_of_firm'); //name of firm

            $table->string('owner_purpose_of_loan')->nullable();
            $table->string('owner_entity_type')->nullable();
            $table->string('owner_name')->nullable();

            $table->string('address')->nullable();
            $table->string('owner_city')->nullable();
            $table->string('owner_state')->nullable();
            $table->string('pincode')->nullable();
            $table->string('contact1')->nullable();
            $table->string('contact2')->nullable();
            $table->string('latest_turnover')->nullable();
            $table->double('required_amount')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->engine = 'InnoDB';
		});

		Schema::create('master_data', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('type');
			//$table->enum('type',array('PRODUCTS_TYPE','STATE', 'ENTITY_TYPE','BUSINESS_NATURE','INDUSTRY_TYPE', 'PROPERTY_TYPE', 'COMMERCIAL_TYPE', 'RESIDENTIAL_TYPE', 'LAND_TYPE', 'RELATION_WITH_APPLICANT_TYPE'));
			$table->string('name');
			$table->string('value');
			$table->integer('sortorder');
			$table->integer('status')->default(1);
			$table->timestamps();
			$table->softDeletes();
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
		Schema::drop('password_resets');
		Schema::drop('user_profiles');
		Schema::drop('master_data');
	}

}
