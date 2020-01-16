<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigurableFormsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('conf_question_masters', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('questionnumber');
			$table->string('question_label'); //The category label to which this question belongs to
			$table->string('category_label'); //The category label to which this question belongs to
			$table->integer('status')->default(1); //Active/Inactive
			$table->timestamps();
			$table->softDeletes();
			$table->engine = 'InnoDB';
			//$table->unique('question_label');
			$table->unique('questionnumber');
		});

		Schema::create('conf_questions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('conf_master_id')->unsigned();
			$table->foreign('conf_master_id')->references('id')->on('conf_question_masters');
			$table->string('loan_type');
			$table->integer('status')->default(1);
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('conf_fields', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('config_field_name');
			$table->string('field_entity'); //UserProfile or Loan object
			$table->string('target_value_type'); //Single value or ranged value
			$table->string('value_source_type'); //user-defined, or master data lookup
			$table->string('masterdata_lookup_type')->nullable(); //The corresponding lookup type in masterdata
			$table->integer('status')->default(1);
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('conf_conditions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('config_condition_name');
			$table->integer('status')->default(1);
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('conf_question_mappings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('conf_question_id')->unsigned();
			$table->foreign('conf_question_id')->references('id')->on('conf_questions');
			$table->integer('conf_field_id')->unsigned();
			$table->foreign('conf_field_id')->references('id')->on('conf_fields');
			$table->integer('conf_condition_id')->unsigned();
			$table->foreign('conf_condition_id')->references('id')->on('conf_conditions');
			$table->string('operand')->default('=');
			$table->string('single_value')->nullable();
			$table->string('begin_range')->nullable();
			$table->string('end_range')->nullable();
			$table->integer('status')->default(1);
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
		Schema::drop('conf_question_mappings');
		Schema::drop('conf_fields');
		Schema::drop('conf_conditions');
		Schema::drop('conf_questions');
		Schema::drop('conf_question_masters');
	}
}
