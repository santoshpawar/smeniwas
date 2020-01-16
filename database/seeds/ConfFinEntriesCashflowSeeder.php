<?php

use App\Models\Loan\FinancialData\FinancialGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class ConfFinEntriesCashflowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        //insert configuration groups
        DB::table('conf_financial_groups')->insert(array(
            array('type'=>'Cashflow', 'name' => 'Cashflow from Operations', 'description' => 'Cashflow from Operations', 'sortorder' => 5, 'visible'=>1, 'header' => 1),
            array('type'=>'Cashflow', 'name' => 'Cashflow from Investing Activities', 'description' => 'Cashflow from Investing Activities', 'sortorder' => 10, 'visible'=>1, 'header' => 1),
            array('type'=>'Cashflow', 'name' => 'Cashflow from Financing Activities', 'description' => 'Cashflow from Financing Activities', 'sortorder' => 15, 'visible'=>1, 'header' => 1),
            array('type'=>'Cashflow', 'name' => 'Surplus (Deficit)', 'description' => 'Surplus (Deficit)', 'sortorder' => 15, 'visible'=>1, 'header' => 1)
        ));

        $group = FinancialGroup::where('name','=','Cashflow from Operations')->get()->first();

        // //insert configuration entries
        DB::table('conf_financial_entries')->insert(array(

            array('group_id'=> $group->id, 'entry' => 'Profit After Tax', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'CFA', 'formula' => 'PP', 'model' => 'financials_cashflow', 'attribute' => 'pat', 'sortorder' => 5, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Depreciation', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'CFB', 'formula' => 'LL', 'model' => 'financials_cashflow', 'attribute' => 'depreciation', 'sortorder' => 10, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Interest & Finance Charges', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'CFC', 'formula' => 'MM', 'model' => 'financials_cashflow', 'attribute' => 'finance_cost', 'sortorder' => 15, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Net Increase in Current Assets', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'CFD', 'formula' => '( Z - U ) - ( ( @ - 1 Z ) - ( @ - 1 U ) )', 'model' => 'financials_cashflow', 'attribute' => 'net_inc_in_current_assets', 'sortorder' => 20, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Net increase in Current Liabilities', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'CFE', 'formula' => 'K + M - ( @ - 1 K ) - ( @ - 1 M )', 'model' => 'financials_cashflow', 'attribute' => 'net_inc_in_current_liabilities', 'sortorder' => 25, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Net Incr (Decr) in WC', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'CFF', 'formula' => 'CFD - CFE', 'model' => 'financials_cashflow', 'attribute' => 'net_inc_dec_wc', 'sortorder' => 30, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Net Incr (Decr) in Provisions', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'CFG', 'formula' => '( H - @ - 1 H )', 'model' => 'financials_cashflow', 'attribute' => 'net_inc_dec_provisions', 'sortorder' => 35, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Net Cashflow from Operations', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'CFH', 'formula' => '( PP + LL + MM - CFF + CFG )', 'model' => 'financials_cashflow', 'attribute' => 'net_cf_from_operation', 'sortorder' => 40, 'status' =>1)

        ));

		$group = FinancialGroup::where('name','=','Cashflow from Investing Activities')->get()->first();

		DB::table('conf_financial_entries')->insert(array(

			array('group_id'=> $group->id, 'entry' => 'Net Increase in Investments', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'CFI', 'formula' => '( T - @ - 1 T )', 'model' => 'financials_cashflow', 'attribute' => 'net_inc_in_investment', 'sortorder' => 5, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Net Increase in Fixed Asssets', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'CFJ', 'formula' => '( O - @ - 1 O )', 'model' => 'financials_cashflow', 'attribute' => 'net_inc_in_fixed_assets', 'sortorder' => 10, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Net addition due to investing activities', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'CFK', 'formula' => '( CFI + CFJ )', 'model' => 'financials_cashflow', 'attribute' => 'net_add_due_to_investing_activities', 'sortorder' => 15, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Net Cashflow after Investing Activities', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'CFL', 'formula' => '( CFH - CFK )', 'model' => 'financials_cashflow', 'attribute' => 'net_cf_after_investing_activities', 'sortorder' => 20, 'status' =>1)
            
		));

		$group = FinancialGroup::where('name','=','Cashflow from Financing Activities')->get()->first();

        DB::table('conf_financial_entries')->insert(array(

        	array('group_id'=> $group->id, 'entry' => 'Interest', 'description' => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'CFM', 'formula' => 'MM', 'model' => 'financials_cashflow', 'attribute' => 'interest', 'sortorder' => 5, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Net Loan Addition (Repayment)', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'CFN', 'formula' => '( F + G  - ( @ - 1 F ) - ( @ - 1 G ) + J + L - ( @ - 1 J ) - ( @ - 1 L ) )', 'model' => 'financials_cashflow', 'attribute' => 'net_loan_addition', 'sortorder' => 10, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Net shareholder Loan Addition (Repayment)', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'CFO', 'formula' => '( D - @ - 1 D )', 'model' => 'financials_cashflow', 'attribute' => 'net_shareholder_loan_addition', 'sortorder' => 15, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Net shareholder equity addition (other than PAT)', 'description' => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'CFP', 'formula' => '( C - ( @ - 1 C ) - PP )', 'model' => 'financials_cashflow', 'attribute' => 'net_shareholder_equity_addition', 'sortorder' => 20, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Net Addition due to financing activity', 'description' => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'CFQ', 'formula' => '( CFN + CFO + CFP - MM )', 'model' => 'financials_cashflow', 'attribute' => 'net_add_due_to_fin_activity', 'sortorder' => 25, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Net Cashflow after Financing Activity', 'description' => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'CFR', 'formula' => '( CFQ + CFL )', 'model' => 'financials_cashflow', 'attribute' => 'net_cf_after_fin_activity', 'sortorder' => 30, 'status' =>1)
            
        ));

        $group = FinancialGroup::where('name','=','Surplus (Deficit)')->get()->first();

        DB::table('conf_financial_entries')->insert(array(

        	array('group_id'=> $group->id, 'entry' => 'Opening Cash and Cash Equivalents', 'description' => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'CFS', 'formula' => '( @ - 1 U )', 'model' => 'financials_cashflow', 'attribute' => 'opening_cash', 'sortorder' => 5, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Surplus (Deficit) during the year', 'description' => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'CFT', 'formula' => 'CFR', 'model' => 'financials_cashflow', 'attribute' => 'surplus', 'sortorder' => 10, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Closing Cash and Cash Equivalent', 'description' => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'CFU', 'formula' => '( ( @ - 1 U ) + CFR )', 'model' => 'financials_cashflow', 'attribute' => 'closing_cash', 'sortorder' => 15, 'status' =>1)

        ));


		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
