<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinancialRatiosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('conf_financial_groups', function(Blueprint $table) {
			$table->increments('id');
			$table->string('type'); //Balance Sheet, Profit & Loss, Ratio
			$table->string('name')->unique();
			$table->string('description')->nullable();
			$table->integer('sortorder');
			$table->integer('visible')->default(1);
			$table->integer('header')->default(0);
			$table->integer('status')->default(1);
			$table->timestamps();
			$table->softDeletes();
			$table->engine = 'InnoDB';
		});

		Schema::create('conf_financial_entries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('group_id')->unsigned();
			$table->foreign('group_id')->references('id')->on('conf_financial_groups');
			$table->string('entry')->unique();
			$table->string('description')->nullable();
			$table->string('calculation_method'); //Manual / Calculated
			$table->string('formula_reference')->unique();
			$table->string('formula')->nullable();
			$table->string('model');
			$table->string('attribute');
			$table->integer('percentage')->default(0);
			$table->string('threshold_condition')->nullable();
			$table->double('threshold')->nullable();
			$table->integer('sortorder');
			$table->string('status');
			$table->timestamps();
			$table->softDeletes();
			$table->engine = 'InnoDB';
		});

		// Table for storing balance sheet Loans/NewLap/Business
		Schema::create('financials_balance_sheet', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('loan_id')->unsigned();
			$table->foreign('loan_id')->references('id')->on('loans');

			$table->string('period');

			$table->double('share_capital')->nullable();
			$table->double('reserves')->nullable();
			$table->double('net_worth')->nullable();
			$table->double('loans')->nullable();
			$table->double('total_shareholders_funds')->nullable();
			$table->double('long_term_borrowings')->nullable();
			$table->double('long_term_liabilities')->nullable();
			$table->double('long_term_provisions')->nullable();
			$table->double('total_long_term_liabilities')->nullable();
			$table->double('short_term_loans')->nullable();
			$table->double('trade_payables')->nullable();
			$table->double('curr_long_term_debt')->nullable();
			$table->double('other_current_liabilities')->nullable();
			$table->double('total_current_liabilities')->nullable();
			$table->double('total_liabilities')->nullable();
			$table->double('tangible_assets')->nullable();
			$table->double('depreciation')->nullable();
			$table->double('net_fixed_assets')->nullable();
			$table->double('intangible_assets')->nullable();
			$table->double('total_fixed_assets')->nullable();
			$table->double('investments')->nullable();
			$table->double('cash_balance')->nullable();
			$table->double('receivables_less_180')->nullable();
			$table->double('receivables_more_180')->nullable();
			$table->double('related_party_advances')->nullable();
			$table->double('third_party_advances')->nullable();
			$table->double('inventories')->nullable();
			$table->double('other_current_assets')->nullable();
			$table->double('total_current_assets')->nullable();
			$table->double('total_assets')->nullable();
            $table->double('contingent_liabilities')->nullable();

			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('financials_profit_loss', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('loan_id')->unsigned();
			$table->foreign('loan_id')->references('id')->on('loans');

			$table->string('period');

			$table->double('net_sales')->nullable();
			$table->double('oth_op_income')->nullable();
			$table->double('net_revenue')->nullable();
			$table->double('raw_materials')->nullable();
			$table->double('gross_profit')->nullable();
			$table->double('salary_cost')->nullable();
			$table->double('manuf_cost')->nullable();
			$table->double('advertising_cost')->nullable();
			$table->double('admin_costs')->nullable();
			$table->double('ebitda')->nullable();
			$table->double('other_income')->nullable();
			$table->double('depreciation')->nullable();
			$table->double('finance_cost')->nullable();
			$table->double('tax')->nullable();

			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('financials_ratios', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('loan_id')->unsigned();
			$table->foreign('loan_id')->references('id')->on('loans');

			$table->integer('ratio_id')->unsigned();
			$table->foreign('ratio_id')->references('id')->on('conf_financial_entries');

			$table->string('period');

			$table->string('name');
			$table->double('value');

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
		Schema::drop('financials_balance_sheet');
		Schema::drop('financials_profit_loss');
		Schema::drop('financials_ratios');

		Schema::drop('conf_financial_entries');
		Schema::drop('conf_financial_groups');
	}

}
