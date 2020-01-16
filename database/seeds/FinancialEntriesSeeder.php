<?php

use App\Models\Loan\FinancialData\FinancialGroup;
use App\Models\Loan\Loan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class FinancialEntriesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        //delete conf_financial_entries table records
        DB::table('conf_financial_groups')->truncate();

        //delete conf_financial_entries table records
        DB::table('conf_financial_entries')->truncate();

        //insert configuration groups
        DB::table('conf_financial_groups')->insert(array(
            array('type'=>'Balance Sheet', 'name' => 'Assets', 'description' => 'All Asset Entries for Balance Sheet', 'sortorder' => 5, 'visible'=>1, 'header' => 1),
            array('type'=>'Balance Sheet', 'name' => 'Non Current Assets', 'description' => 'Non Current Assets for Balance Sheet', 'sortorder' => 10, 'visible'=>1, 'header' => 0),
            array('type'=>'Balance Sheet', 'name' => 'Current Assets', 'description' => 'Current Assets for Balance Sheet', 'sortorder' => 15, 'visible'=>1, 'header' => 0),

            array('type'=>'Balance Sheet', 'name' => 'Liabilities', 'description' => 'All Liability Entries for Balance Sheet', 'sortorder' => 20, 'visible'=>1, 'header' => 1),
            array('type'=>'Balance Sheet', 'name' => 'Shareholders Funds', 'description' => 'Shareholders Funds Entries for Balance Sheet', 'sortorder' => 25, 'visible'=>1, 'header' => 0),
            array('type'=>'Balance Sheet', 'name' => 'Non Current Liabilities', 'description' => 'Non Current Liabilities for Balance Sheet', 'sortorder' => 30, 'visible'=>1, 'header' => 0),
            array('type'=>'Balance Sheet', 'name' => 'Current Liabilities', 'description' => 'Current Liabilities for Balance Sheet', 'sortorder' => 35, 'visible'=>1, 'header' => 0),

            array('type'=>'Balance Sheet', 'name' => 'Contingent Liabilities', 'description' => 'Contingent Liabilities for Balance Sheet', 'sortorder' => 40, 'visible'=>1, 'header' => 0),

            array('type'=>'Profit & Loss', 'name' => 'Operating Income', 'description' => 'Operating Revenue and Expenses', 'sortorder' => 5, 'visible'=>0, 'header' => 0),
            array('type'=>'Profit & Loss', 'name' => 'Operating Expenses & EBITDA', 'description' => 'Operating Expenses & EBITDA', 'sortorder' => 10, 'visible'=>0, 'header' => 0),
            array('type'=>'Profit & Loss', 'name' => 'Others & PBT', 'description' => 'Others & PBT', 'sortorder' => 10, 'visible'=>0, 'header' => 0),
            array('type'=>'Profit & Loss', 'name' => 'Tax & PAT', 'description' => 'Tax & PAT', 'sortorder' => 15, 'visible'=>0, 'header' => 0),

            array('type'=>'Ratio', 'name' => 'Profitability ratios', 'description' => 'Profitability ratios', 'sortorder' => 5, 'visible'=>1, 'header' => 0),
            array('type'=>'Ratio', 'name' => 'Leverage Ratios', 'description' => 'Leverage Ratios', 'sortorder' => 10, 'visible'=>1, 'header' => 0),
            array('type'=>'Ratio', 'name' => 'Liquidity Ratios', 'description' => 'Liquidity Ratios', 'sortorder' => 15, 'visible'=>1, 'header' => 0),
            array('type'=>'Ratio', 'name' => 'Asset Turnover Ratios', 'description' => 'Asset Turnover Ratios', 'sortorder' => 20, 'visible'=>1, 'header' => 0),
            array('type'=>'Ratio', 'name' => 'Combined Thresholds', 'description' => 'Combined Thresholds', 'sortorder' => 25, 'visible'=>0, 'header' => 0),
        ));

        $group = FinancialGroup::where('name','=','Shareholders Funds')->get()->first();
        //insert configuration entries
        DB::table('conf_financial_entries')->insert(array(

            array('group_id'=> $group->id , 'entry' => 'Share Capital', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'A', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'share_capital', 'sortorder' => 5, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Reserves (net of Revaluation Reserves)', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'B', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'reserves', 'sortorder' => 10, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Net worth', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'C', 'formula' => 'A + B', 'model' => 'financials_balance_sheet', 'attribute' => 'net_worth', 'sortorder' => 15, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Loans/Preference shares from promoters both short term and long term', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'D', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'loans', 'sortorder' => 20, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Total Shareholder Funds', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'E', 'formula' => 'C + D', 'model' => 'financials_balance_sheet', 'attribute' => 'total_shareholders_funds', 'sortorder' => 25, 'status' =>1),
        ));

        $group = FinancialGroup::where('name','=','Non Current Liabilities')->get()->first();
        DB::table('conf_financial_entries')->insert(array(
            array('group_id'=> $group->id , 'entry' => 'Long Term Borrowings', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'F', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'long_term_borrowings', 'sortorder' => 5, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Other Long term Liabilities', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'G', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'long_term_liabilities', 'sortorder' => 10, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Long Term Provisions', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'H', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'long_term_provisions', 'sortorder' => 15, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Total Long term Liabilities', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'I', 'formula' => 'F + G + H', 'model' => 'financials_balance_sheet', 'attribute' => 'total_long_term_liabilities', 'sortorder' => 20, 'status' =>1),
        ));

        $group = FinancialGroup::where('name','=','Current Liabilities')->get()->first();
        DB::table('conf_financial_entries')->insert(array(
            array('group_id'=> $group->id, 'entry' => 'Short Term Loans (incl bank Borrowings)', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'J', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'short_term_loans', 'sortorder' => 5, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Trade Payables', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'K', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'trade_payables', 'sortorder' => 10, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Current Portion of Long Term Debt', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'L', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'curr_long_term_debt', 'sortorder' => 15, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Other Current Liabilities', 'description'  => '','calculation_method' => 'Manual', 'formula_reference' => 'M', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'other_current_liabilities', 'sortorder' => 20, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Total Current Liabilities', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'N', 'formula' => 'J + K + L + M', 'model' => 'financials_balance_sheet', 'attribute' => 'total_current_liabilities', 'sortorder' => 25, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Total Liabilities', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'N1', 'formula' => 'E + I + N', 'model' => 'financials_balance_sheet', 'attribute' => 'total_liabilities', 'sortorder' => 25, 'status' =>1),
        ));

        $group = FinancialGroup::where('name','=','Non Current Assets')->get()->first();
        DB::table('conf_financial_entries')->insert(array(
            array('group_id'=> $group->id, 'group_id'=> $group->id, 'entry' => 'Gross Tangible Assets + WIP', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'O', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'tangible_assets', 'sortorder' => 5, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Total Depreciation', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'P', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'depreciation', 'sortorder' => 10, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Net Fixed Assets', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'Q', 'formula' => 'O - P', 'model' => 'financials_balance_sheet', 'attribute' => 'net_fixed_assets', 'sortorder' => 15, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Intangible Assets', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'R', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'intangible_assets', 'sortorder' => 20, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Total Fixed Assets', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'S', 'formula' => 'Q + R', 'model' => 'financials_balance_sheet', 'attribute' => 'total_fixed_assets', 'sortorder' => 25, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Investments', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'T', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'investments', 'sortorder' => 30, 'status' =>1),
        ));

        $group = FinancialGroup::where('name','=','Current Assets')->get()->first();
        DB::table('conf_financial_entries')->insert(array(
            array('group_id'=> $group->id, 'entry' => 'Cash Balance + Liquid Investments', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'U', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'cash_balance', 'sortorder' => 5, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Receivables < 180 days', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'V1', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'receivables_less_180', 'sortorder' => 10, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Receivables > 180 days', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'V2', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'receivables_more_180', 'sortorder' => 15,  'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Advances to related Party', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'W1', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'related_party_advances', 'sortorder' => 20, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Advances to third Party', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'W2', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'third_party_advances', 'sortorder' => 25, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Inventories', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'X', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'inventories', 'sortorder' => 30, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Other Current Assets', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'Y', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'other_current_assets', 'sortorder' => 35, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Total Current Assets', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'Z', 'formula' => 'U + V1 + V2 + W1 + W2 + X + Y', 'model' => 'financials_balance_sheet', 'attribute' => 'total_current_assets', 'sortorder' => 40, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Total Assets', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'ZA', 'formula' => 'S + T + Z', 'model' => 'financials_balance_sheet', 'attribute' => 'total_assets', 'sortorder' => 45, 'status' =>1),
        ));

        $group = FinancialGroup::where('name','=','Contingent Liabilities')->get()->first();
        DB::table('conf_financial_entries')->insert(array(
            array('group_id'=> $group->id, 'entry' => 'Contingent Liabilities', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'ZB', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'contingent_liabilities', 'sortorder' => 5, 'status' =>1),
        ));

        $group = FinancialGroup::where('name','=','Operating Income')->get()->first();
        DB::table('conf_financial_entries')->insert(array(
            array('group_id'=> $group->id, 'entry' => 'Net Sales (After Excise, Octroi, Service Tax etc)', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'AA', 'formula' => '', 'model' => 'financials_profit_loss', 'attribute' => 'net_sales', 'sortorder' => 5, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Other Operating / Related Income', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'BB', 'formula' => '', 'model' => 'financials_profit_loss', 'attribute' => 'oth_op_income', 'sortorder' => 10, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Total Income', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'CC', 'formula' => 'AA + BB', 'model' => 'financials_profit_loss', 'attribute' => 'net_revenue', 'sortorder' => 15, 'status' =>1),
        ));

        $group = FinancialGroup::where('name','=','Operating Expenses & EBITDA')->get()->first();
        DB::table('conf_financial_entries')->insert(array(
            array('group_id'=> $group->id, 'entry' => 'Cost of Raw Material', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'DD', 'formula' => '', 'model' => 'financials_profit_loss', 'attribute' => 'raw_materials', 'sortorder' => 5, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Gross Profit', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'EE', 'formula' => 'CC - DD', 'model' => 'financials_profit_loss', 'attribute' => 'gross_profit', 'sortorder' => 10, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Salary Cost', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'FF', 'formula' => '', 'model' => 'financials_profit_loss', 'attribute' => 'salary_cost', 'sortorder' => 15, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Manufacturing Cost Incl. Power', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'GG', 'formula' => '', 'model' => 'financials_profit_loss', 'attribute' => 'manuf_cost', 'sortorder' => 20, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Business Development / Marketing / Advertising / Distribution / Commission', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'HH', 'formula' => '', 'model' => 'financials_profit_loss', 'attribute' => 'advertising_cost', 'sortorder' => 25, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Other Admin and Fixed Costs', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'II', 'formula' => '', 'model' => 'financials_profit_loss', 'attribute' => 'admin_costs', 'sortorder' => 30, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'EBITDA', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'JJ', 'formula' => 'EE - FF - GG - HH - II', 'model' => 'financials_profit_loss', 'attribute' => 'ebitda', 'sortorder' => 35, 'status' =>1),
        ));

        $group = FinancialGroup::where('name','=','Others & PBT')->get()->first();
        DB::table('conf_financial_entries')->insert(array(
            array('group_id'=> $group->id, 'entry' => 'Other Income', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'KK', 'formula' => '', 'model' => 'financials_profit_loss', 'attribute' => 'other_income', 'sortorder' => 5, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Depreciation & Amortization', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'LL', 'formula' => '', 'model' => 'financials_profit_loss', 'attribute' => 'depreciation', 'sortorder' => 10, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Finance Costs, Bank Ccharges, LC Commission etc', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'MM', 'formula' => '', 'model' => 'financials_profit_loss', 'attribute' => 'finance_cost', 'sortorder' => 15, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'PBT', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'NN', 'formula' => 'JJ + KK - LL - MM', 'model' => 'financials_profit_loss', 'attribute' => 'pbt', 'sortorder' => 20, 'status' =>1),
        ));

        $group = FinancialGroup::where('name','=','Tax & PAT')->get()->first();
        DB::table('conf_financial_entries')->insert(array(
            array('group_id'=> $group->id, 'entry' => 'Tax', 'description'  => '', 'calculation_method' => 'Manual', 'formula_reference' => 'OO', 'formula' => '', 'model' => 'financials_profit_loss', 'attribute' => 'tax', 'sortorder' => 5, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'PAT', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'PP', 'formula' => 'NN - OO', 'model' => 'financials_profit_loss', 'attribute' => 'pat', 'sortorder' => 10, 'status' =>1),
        ));

        //Ratios
        $group = FinancialGroup::where('name','=','Profitability ratios')->get()->first();
        DB::table('conf_financial_entries')->insert(array(
            array('group_id'=> $group->id, 'entry' => 'EBITDA Margin', 'description'  => 'EBITDA/Net Revenue', 'calculation_method' => 'Calculated', 'formula_reference' => 'AAA', 'formula' => '( JJ / CC ) * 100', 'model' => 'financials_ratios', 'attribute' => 'ebitda_netrevenue', 'percentage' => 1, 'threshold_condition' => '<', 'threshold' => 2, 'sortorder' => 5, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'PAT Margin', 'description'  => 'PAT/Net revenue', 'calculation_method' => 'Calculated', 'formula_reference' => 'BBB', 'formula' => '( PP / CC ) * 100', 'model' => 'financials_ratios', 'attribute' => 'pat_netrevenue', 'percentage' => 1, 'threshold_condition' => '<', 'threshold' => 0, 'sortorder' => 10, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Gross profit / Other Fixed Expenses', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'CCC', 'formula' => 'EE / ( FF + GG + HH + II )', 'model' => 'financials_ratios', 'attribute' => 'gross_proft_fixed_expns', 'percentage' => 0, 'threshold_condition' => null, 'threshold' => null, 'sortorder' => 15, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Interest Coverage ratio', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'DDD', 'formula' => 'JJ / MM', 'model' => 'financials_ratios', 'attribute' => 'interest_coverage_ratio', 'percentage' => 0, 'threshold_condition' => '<', 'threshold' => 1.2, 'sortorder' => 20, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Debt Service Coverage ratio', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'EEE', 'formula' => '( JJ / ( MM + @ - 1 L ) )', 'model' => 'financials_ratios', 'attribute' => 'debt_service_coverage_ratio', 'percentage' => 0, 'threshold_condition' => null, 'threshold' => null, 'sortorder' => 25, 'status' =>1),
        ));

        $group = FinancialGroup::where('name','=','Leverage Ratios')->get()->first();
        DB::table('conf_financial_entries')->insert(array(
            array('group_id'=> $group->id, 'entry' => 'Total Debt / Shareholders Funds ratio', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'FFF', 'formula' => '( F + J + L ) / ( E - V2 - W2 )', 'model' => 'financials_ratios', 'attribute' => 'debt_funds_ratio', 'percentage' => 0, 'threshold_condition' => '>', 'threshold' => 3.5, 'sortorder' => 5, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Total Debt / EBITDA', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'GGG', 'formula' => '( F + J + L ) / JJ', 'model' => 'financials_ratios', 'attribute' => 'total_debt_ebitda', 'percentage' => 0, 'threshold_condition' => '>', 'threshold' => 4, 'sortorder' => 10, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Term Debt / EBITDA', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'HHH', 'formula' => '( F + L ) / JJ', 'model' => 'financials_ratios', 'attribute' => 'term_debt_ebitda', 'percentage' => 0, 'threshold_condition' => '>', 'threshold' => 3, 'sortorder' => 15, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Solvency (Shareholders Funds / Total Assets)', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'III', 'formula' => '( ( E - V2 - W2 ) / ( S + T + Z ) ) * 100', 'model' => 'financials_ratios', 'attribute' => 'solvency_ratio', 'percentage' => 1, 'threshold_condition' => '<', 'threshold' => 25, 'sortorder' => 20, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Debt/Turnover Ratio', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'IIA', 'formula' => '( ( F + J + L ) / CC )', 'model' => 'financials_ratios', 'attribute' => 'debt_turnover_ratio', 'percentage' => 0, 'threshold_condition' => null, 'threshold' => null, 'sortorder' => 25, 'status' =>1),
        ));

        $group = FinancialGroup::where('name','=','Liquidity Ratios')->get()->first();
        DB::table('conf_financial_entries')->insert(array(
            array('group_id'=> $group->id, 'entry' => 'Receivable Days', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'JJJ', 'formula' => '( V1 + V2 ) / CC * 365', 'model' => 'financials_ratios', 'attribute' => 'receivable_days', 'percentage' => 0, 'threshold_condition' => '>', 'threshold' => 150, 'sortorder' => 5, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Inventory days', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'KKK', 'formula' => 'X / CC * 365', 'model' => 'financials_ratios', 'attribute' => 'inventory_days', 'percentage' => 0, 'threshold_condition' => '>', 'threshold' => 150, 'sortorder' => 10, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Payable Days', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'LLL', 'formula' => 'K / CC * 365', 'model' => 'financials_ratios', 'attribute' => 'payable_days', 'percentage' => 0, 'threshold_condition' => '>', 'threshold' => 150, 'sortorder' => 15, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'NWC Days', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'MMM', 'formula' => '( V1 + V2 + X - K ) / CC * 365', 'model' => 'financials_ratios', 'attribute' => 'nwc_days', 'percentage' => 0, 'threshold_condition' => '>', 'threshold' => 120, 'sortorder' => 20, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Current Ratio', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'NNN', 'formula' => '( Z - V2 - W1 ) / N', 'model' => 'financials_ratios', 'attribute' => 'current_ratio', 'percentage' => 0, 'threshold_condition' => '<', 'threshold' => 1, 'sortorder' => 25, 'status' =>1),
        ));

        $group = FinancialGroup::where('name','=','Asset Turnover Ratios')->get()->first();
        DB::table('conf_financial_entries')->insert(array(
            array('group_id'=> $group->id, 'entry' => 'ROCE (EBITDA/Average Total Assets)', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'OOO', 'formula' => 'JJ / ( ( @ - 1 S + @ - 1 T + @ - 1 Z ) / 3 )', 'model' => 'financials_ratios', 'attribute' => 'roce', 'percentage' => 0, 'threshold_condition' => '<', 'threshold' => 7, 'sortorder' => 5, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'ROE', 'description'  => '(PAT/Average Shareholders� Funds)', 'calculation_method' => 'Calculated', 'formula_reference' => 'PPP', 'formula' => '( PP / E ) * 100', 'model' => 'financials_ratios', 'attribute' => 'roe', 'percentage' => 1, 'threshold_condition' => '<', 'threshold' => 5, 'sortorder' => 10, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Net Revenue / Net Fixed Assets', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'QQQ', 'formula' => 'CC / Q', 'model' => 'financials_ratios', 'attribute' => 'net_revenue_fixed_assets', 'percentage' => 0, 'threshold_condition' => '<', 'threshold' => 1.5, 'sortorder' => 15, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Net Revenue / Total Assets', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'RRR', 'formula' => 'CC / ( S + T + Z )', 'model' => 'financials_ratios', 'attribute' => 'net_revenue_total_assets', 'percentage' => 0, 'threshold_condition' => '<', 'threshold' => 1, 'sortorder' => 20, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Contingent Liabilities / Net Worth', 'description'  => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'SSS', 'formula' => 'ZB / E', 'model' => 'financials_ratios', 'attribute' => 'contingent_liabilities_net_worth', 'percentage' => 0, 'threshold_condition' => null, 'threshold' => null, 'sortorder' => 25, 'status' =>1),
        ));

        $group = FinancialGroup::where('name','=','Combined Thresholds')->get()->first();
        DB::table('conf_financial_entries')->insert(array(
            array('group_id'=> $group->id, 'entry' => 'Payable And Debt/Equity Threshold', 'description'  => 'Payable>120 days and Debt/Equity>3', 'calculation_method' => 'Combined Threshold', 'formula_reference' => 'AAAA', 'formula' => '( KKK > 120 ) and ( EEE > 3 )', 'model' => null, 'attribute' => null, 'percentage' => 0, 'threshold_condition' => null, 'threshold' => null, 'sortorder' => 5, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'EBITDA Margin and Term Debt/EBITDA', 'description'  => 'EBITDA Margin<5% and Term Debt/EBITDA>2.5', 'calculation_method' => 'Combined Threshold', 'formula_reference' => 'BBBB', 'formula' => '( AAA < 5 ) and ( GGG > 2.5 )', 'model' => null, 'attribute' => null, 'percentage' => 0, 'threshold_condition' => null, 'threshold' => null, 'sortorder' => 10, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'ROCE and Debt/Shareholders Funds', 'description'  => 'ROCE<10% and Debt/Shareholders Funds >2.5x', 'calculation_method' => 'Combined Threshold', 'formula_reference' => 'CCCC', 'formula' => '( NNN < 10 ) and ( EEE > 2.5 )', 'model' => null, 'attribute' => null, 'percentage' => 0, 'threshold_condition' => null, 'threshold' => null, 'sortorder' => 10, 'status' =>1),
            array('group_id'=> $group->id, 'entry' => 'Net Revenue/Fixed Assets and NWC days', 'description'  => 'Net Revenue/Fixed Assets < 2 and NWC days > 90', 'calculation_method' => 'Combined Threshold', 'formula_reference' => 'DDDD', 'formula' => '( PPP < 2 ) and ( LLL > 90 )', 'model' => null, 'attribute' => null, 'percentage' => 0, 'threshold_condition' => null, 'threshold' => null, 'sortorder' => 10, 'status' =>1),
        ));

        $loan = Loan::where('type','=', 'LAP')->first();

        //delete table records
        DB::table('financials_balance_sheet')->truncate();

        DB::table('financials_balance_sheet')->insert(array(
            array('loan_id' => $loan->id, 'period'  => 'FY2010-11', 'equity_share_capital'  => 100, 'total_reserves' => 12, 'net_worth' => 21, 'loans' => 24, 'long_term_borrowings' => 12, 'long_term_liabilities' => 12, 'long_term_provisions' => 5, 'short_term_loans' => 0.4, 'trade_payables' => 0.5, 'curr_long_term_debt' => 1, 'other_current_liabilities' => 0.9, 'tangible_assets' => 3.2, 'depreciation' => 1.2, 'net_fixed_assets' => 5, 'intangible_assets' => 3.5, 'investments' => 134.45, 'cash_balance' => 5.4, 'receivables_less_180_related' => 0.4, 'receivables_more_180_related' => 1.5, 'related_party_advances' => 3.5, 'third_party_advances' => 1.2, 'inventories' => 0.45, 'other_current_assets' => 24.4, 'total_current_assets' => 3, 'total_shareholders_funds' => 37, 'total_long_term_liabilities' => 29, 'total_current_liabilities' => 2.8, 'total_liabilities' => 68.8, 'total_fixed_assets'=> 46.35),
            array('loan_id' => $loan->id, 'period'  => 'FY2011-12', 'equity_share_capital'  => 200, 'total_reserves' => 22, 'net_worth' => 26, 'loans' => 29, 'long_term_borrowings' => 52, 'long_term_liabilities' => 72, 'long_term_provisions' => 15, 'short_term_loans' => 1.4, 'trade_payables' => 1.5, 'curr_long_term_debt' => 2, 'other_current_liabilities' => 2.9, 'tangible_assets' => 4.2, 'depreciation' => 2.2, 'net_fixed_assets' => 6, 'intangible_assets' => 5.5, 'investments' => 3, 'cash_balance' => 6.4, 'receivables_less_180_related' => 1.4, 'receivables_more_180_related' => 3.5, 'related_party_advances' => 4.5, 'third_party_advances' => 350.65, 'inventories' => 1.45, 'other_current_assets' => 19.4, 'total_current_assets' => 4, 'total_shareholders_funds' => 23.45, 'total_long_term_liabilities' => 19, 'total_current_liabilities' => 7.8, 'total_liabilities' => 50.25, 'total_fixed_assets'=> 17.9),
            array('loan_id' => $loan->id, 'period'  => 'FY2012-13', 'equity_share_capital'  => 300, 'total_reserves' => 32, 'net_worth' => 29, 'loans' => 34, 'long_term_borrowings' => 72, 'long_term_liabilities' => 62, 'long_term_provisions' => 25, 'short_term_loans' => 2.4, 'trade_payables' => 2.5, 'curr_long_term_debt' => 3, 'other_current_liabilities' => 3.9, 'tangible_assets' => 479.65, 'depreciation' => 3.2, 'net_fixed_assets' => 7, 'intangible_assets' => 6.5, 'investments' => 4, 'cash_balance' => 7.4, 'receivables_less_180_related' => 2.4, 'receivables_more_180_related' => 4.5, 'related_party_advances' => 5.5, 'third_party_advances' => 3.2, 'inventories' => 2.45, 'other_current_assets' => 24.4, 'total_current_assets' => 2, 'total_shareholders_funds' => 38, 'total_long_term_liabilities' => 13, 'total_current_liabilities' => 11.8, 'total_liabilities' => 62.8, 'total_fixed_assets'=> 18.9),
        ));

        //delete table records
        DB::table('financials_profit_loss')->truncate();

        DB::table('financials_profit_loss')->insert(array(
            array('loan_id' => $loan->id, 'period'  => 'FY2010-11', 'net_sales'  => 100, 'oth_op_income' => 12, 'net_revenue' => 21, 'raw_materials_cost' => 24, 'gross_profit' => 12, 'salary_cost' => 12, 'manuf_cost' => 5, 'advertising_cost' => 0.4, 'admin_costs' => 0.5, 'ebitda' => 1, 'other_income' => 0.9, 'depreciation_cost' => 3.2, 'finance_cost' => 1.2, 'tax' => 5),
            array('loan_id' => $loan->id, 'period'  => 'FY2011-12', 'net_sales'  => 101, 'oth_op_income' => 13, 'net_revenue' => 23, 'raw_materials_cost' => 26, 'gross_profit' => 12, 'salary_cost' => 13, 'manuf_cost' => 6, 'advertising_cost' => 0.7, 'admin_costs' => 0.4, 'ebitda' => 2, 'other_income' => 1.9, 'depreciation_cost' => 6.2, 'finance_cost' => 4.2, 'tax' => 15),
            array('loan_id' => $loan->id, 'period'  => 'FY2012-13', 'net_sales'  => 102, 'oth_op_income' => 14, 'net_revenue' => 24, 'raw_materials_cost' => 27, 'gross_profit' => 13, 'salary_cost' => 14, 'manuf_cost' => 7, 'advertising_cost' => 0.8, 'admin_costs' => 0.8, 'ebitda' => 3, 'other_income' => 2.9, 'depreciation_cost' => 5.2, 'finance_cost' => 7.2, 'tax' => 3),
        ));

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}