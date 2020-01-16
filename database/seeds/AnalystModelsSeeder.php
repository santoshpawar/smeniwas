<?php

use App\Models\Loan\FinancialData\FinancialEntry;
use Illuminate\Database\Seeder;

class AnalystModelsSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        //delete credit_measures table records
        DB::table('analyst_model_measures')->truncate();
        DB::table('analyst_model_dimensions')->truncate();
        DB::table('analyst_model_categories')->truncate();
        DB::table('analyst_model_rating_details')->truncate();
        DB::table('analyst_model_ratings')->truncate();


        //insert configuration entries for Credit Model Categories
        DB::table('analyst_model_categories')->insert(array(

            array('type' => 'Credit', 'label' =>'Background', 'description' => '', 'weight' => 20, 'status' => 1),
            array('type' => 'Credit', 'label' =>'Promoter Strength', 'description' => '', 'weight' => 25, 'status' => 1),
            array('type' => 'Credit', 'label' =>'Financials', 'description' => '', 'weight' => 30, 'status' => 1),
            array('type' => 'Credit', 'label' =>'Credit Profile', 'description' => '', 'weight' => 25, 'status' => 1),

        ));

        //insert configuration entries for Credit Model Dimensions
        DB::table('analyst_model_dimensions')->insert(array(

            array('category_id' => 1, 'description' => '','label' =>'Project pipeline', 'parent_dimension_id' => null, 'status' => 1, 'weight' => 7, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'model' => null, 'attribute' => null, 'sortorder' => 1),
            array('category_id' => 1, 'description' => '','label' =>'Sector Outlook', 'parent_dimension_id' => null, 'status' => 1, 'weight' => 7, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'model' => null, 'attribute' => null, 'sortorder' => 2),
            array('category_id' => 1, 'description' => '','label' =>'Business Regulatory environment', 'parent_dimension_id' => null, 'status' => 1, 'weight' => 10, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'model' => null, 'attribute' => null, 'sortorder' => 3),
            array('category_id' => 1, 'description' => '','label' =>'No of years in business', 'parent_dimension_id' => null, 'status' => 1, 'weight' => 10, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'model' => 'loans', 'attribute' => 'com_co_business_old', 'sortorder' => 4),
            array('category_id' => 1, 'description' => '','label' =>'Business legacy', 'parent_dimension_id' => null, 'status' => 1, 'weight' => 12, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'model' => 'loans_promoter_details', 'attribute' => 'othr_promoterare', 'sortorder' => 5),
            array('category_id' => 1, 'description' => '','label' =>'Business Diversification', 'parent_dimension_id' => null, 'status' => 1, 'weight' => 10, 'is_applicable' => true, 'dimension_type' => 1, 'is_trend' => false, 'model' => null, 'attribute' => null, 'sortorder' => 6),
            array('category_id' => 1, 'description' => '','label' =>'Products', 'parent_dimension_id' => 6, 'status' => 1, 'weight' => 2, 'is_applicable' => false, 'dimension_type' => 0, 'is_trend' => false, 'model' => null, 'attribute' => null, 'sortorder' => 7),
            array('category_id' => 1, 'description' => '','label' =>'Geography', 'parent_dimension_id' => 6, 'status' => 1, 'weight' => 2, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'model' => 'loans_salesarea_details', 'attribute' => 'sales_area_type', 'sortorder' => 8),
            array('category_id' => 1, 'description' => '','label' =>'Customer', 'parent_dimension_id' => 6, 'status' => 1, 'weight' => 3, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'model' => null, 'attribute' => null, 'sortorder' => 9),
            array('category_id' => 1, 'description' => '','label' =>'Supplier', 'parent_dimension_id' => 6, 'status' => 1, 'weight' => 3, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'model' => null, 'attribute' => null, 'sortorder' => 10),
            array('category_id' => 1, 'description' => '','label' =>'Office space', 'parent_dimension_id' => null, 'status' => 1, 'weight' => 7, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'model' => 'loans_businessoperation_details', 'attribute' => 'officepremise_type', 'sortorder' => 11),
            array('category_id' => 1, 'description' => '','label' =>'Market positions in business', 'parent_dimension_id' => null, 'status' => 1, 'weight' => 5, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'model' => null, 'attribute' => null, 'sortorder' => 12),
            array('category_id' => 1, 'description' => '','label' =>'Promoter background', 'parent_dimension_id' => null, 'status' => 1, 'weight' => 7, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'model' => 'loans_promoter_details', 'attribute' => 'othr_eduprofdegree', 'sortorder' => 13),
            array('category_id' => 1, 'description' => '','label' =>'No of families in business', 'parent_dimension_id' => null, 'status' => 1, 'weight' => 10, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'model' => 'loans_promoter_details', 'attribute' => 'othr_noofindependent', 'sortorder' => 14),
            array('category_id' => 1, 'description' => '','label' =>'Presence of professional at key positions (CFO, COO etc.)', 'parent_dimension_id' => null, 'status' => 1, 'weight' => 8, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'model' => null, 'attribute' => null, 'sortorder' => 15),
            array('category_id' => 1, 'description' => '','label' =>'Type and quality of customers', 'parent_dimension_id' => null, 'status' => 1, 'weight' => 7, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'model' => null, 'attribute' => null, 'sortorder' => 16),
            array('category_id' => 2, 'description' => '','label' =>'Promoter NW/Debt', 'parent_dimension_id' => null, 'status' => 1, 'weight' => 50, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'model' => null, 'attribute' => null, 'sortorder' => 17),
            array('category_id' => 2, 'description' => '','label' =>'Group Strength', 'parent_dimension_id' => null, 'status' => 1, 'weight' => 50, 'is_applicable' => false, 'dimension_type' => 1, 'is_trend' => false, 'model' => null, 'attribute' => null, 'sortorder' => 18),
            array('category_id' => 2, 'description' => '','label' =>'Top line', 'parent_dimension_id' => 18, 'status' => 1, 'weight' => 7, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'model' => null, 'attribute' => null, 'sortorder' => 19),
            array('category_id' => 2, 'description' => '','label' =>'PAT%', 'parent_dimension_id' => 18, 'status' => 1, 'weight' => 7, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'model' => null, 'attribute' => null, 'sortorder' => 20),
            array('category_id' => 2, 'description' => '','label' =>'D/E', 'parent_dimension_id' => 18, 'status' => 1, 'weight' => 7, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'model' => null, 'attribute' => null, 'sortorder' => 21),
            array('category_id' => 2, 'description' => '','label' =>'Group NW/Debt', 'parent_dimension_id' => 18, 'status' => 1, 'weight' => 7, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'model' => null, 'attribute' => null, 'sortorder' => 22),
            array('category_id' => 2, 'description' => '','label' =>'Presence of MNC banks', 'parent_dimension_id' => 18, 'status' => 1, 'weight' => 6, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'model' => null, 'attribute' => null, 'sortorder' => 23),
            array('category_id' => 2, 'description' => '','label' =>'Presence of Private banks', 'parent_dimension_id' => 18, 'status' => 1, 'weight' => 6, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'model' => null, 'attribute' => null, 'sortorder' => 24),
            array('category_id' => 2, 'description' => '','label' =>'PE present', 'parent_dimension_id' => 18, 'status' => 1, 'weight' => 10, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'model' => null, 'attribute' => null, 'sortorder' => 25),
            array('category_id' => 2, 'description' => '','label' =>'Subjective call on group strength', 'parent_dimension_id' => 18, 'status' => 1, 'weight' => 50, 'is_applicable' => false, 'dimension_type' => 2, 'is_trend' => false, 'model' => null, 'attribute' => null, 'sortorder' => 26),
        ));

        $entry = FinancialEntry::where('entry','=','Total Debt / Shareholders Funds ratio')->get()->first();
        DB::table('analyst_model_dimensions')->insert(array(
            array('category_id' => 3, 'description' => '','label' =>'Latest D/E ratio (excluding revaluation reserve)', 'parent_dimension_id' => null, 'ratio_id' => $entry->id, 'status' => 1, 'weight' => 10, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'sortorder' => 27),
        ));

        $entry = FinancialEntry::where('entry','=','Debt Service Coverage Ratio')->get()->first();
        DB::table('analyst_model_dimensions')->insert(array(
            array('category_id' => 3, 'description' => '','label' =>'Debt Service Coverage Ratio', 'parent_dimension_id' => null, 'ratio_id' => $entry->id, 'status' => 1, 'weight' => 10, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'sortorder' => 28),
        ));

        $entry = FinancialEntry::where('entry','=','Interest Coverage Ratio')->get()->first();
        DB::table('analyst_model_dimensions')->insert(array(
            array('category_id' => 3, 'description' => '','label' =>'Interest Coverage Ratio', 'parent_dimension_id' => null, 'ratio_id' => $entry->id, 'status' => 1, 'weight' => 10, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'sortorder' => 29),
        ));

		$entry = FinancialEntry::where('entry','=','Net Revenue / Total Assets')->get()->first();
			DB::table('analyst_model_dimensions')->insert(array(
				array('category_id' => 3, 'description' => '','label' =>'Net Revenue / Total Assets', 'parent_dimension_id' => null, 'ratio_id' => $entry->id, 'status' => 1, 'weight' => 10, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'sortorder' => 30),
			));

        $entry = FinancialEntry::where('entry','=','Total Debt / EBITDA')->get()->first();
        DB::table('analyst_model_dimensions')->insert(array(
            array('category_id' => 3, 'description' => '','label' =>'DEBT/EBIDTA', 'parent_dimension_id' => null, 'ratio_id' => $entry->id, 'status' => 1, 'weight' => 10, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'sortorder' => 40),
        ));

        DB::table('analyst_model_dimensions')->insert(array(
            array('category_id' => 3, 'description' => '','label' =>'Historical financial performance (trends)', 'parent_dimension_id' => null, 'status' => 1, 'weight' => 10, 'is_applicable' => false, 'dimension_type' => 1, 'is_trend' => false,  'model' => null, 'attribute' => null, 'sortorder' => 41),
            array('category_id' => 3, 'description' => '','label' =>'Revenue', 'parent_dimension_id' => 32, 'status' => 1, 'weight' => 5, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => true, 'model' => 'financials_profit_loss', 'attribute' => 'net_revenue', 'sortorder' => 42),
            array('category_id' => 3, 'description' => '','label' =>'EBITDA', 'parent_dimension_id' => 32, 'status' => 1, 'weight' => 5, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => true, 'model' => 'financials_profit_loss', 'attribute' => 'ebitda', 'sortorder' => 43),
        ));

        $entry = FinancialEntry::where('entry','=','Solvency (Shareholders Funds / Total Assets)')->get()->first();
        DB::table('analyst_model_dimensions')->insert(array(
            array('category_id' => 3, 'description' => '','label' =>'Solvency (Shareholders Funds/Total Assets)', 'parent_dimension_id' => null, 'ratio_id' => $entry->id, 'status' => 1, 'weight' => 10, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'sortorder' => 44),
        ));

        $entry = FinancialEntry::where('entry','=','Gross profit / Other Fixed Expenses')->get()->first();
        DB::table('analyst_model_dimensions')->insert(array(
            array('category_id' => 3, 'description' => '','label' =>'Gross profit/ fixed cost', 'parent_dimension_id' => null, 'ratio_id' => $entry->id, 'status' => 1, 'weight' => 10, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'sortorder' => 45),
        ));

        $entry = FinancialEntry::where('entry','=','Current Ratio')->get()->first();
        DB::table('analyst_model_dimensions')->insert(array(
            array('category_id' => 3, 'description' => '','label' =>'Current Ratio', 'parent_dimension_id' => null, 'ratio_id' => $entry->id, 'status' => 1, 'weight' => 5, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'sortorder' => 46),
        ));

        $entry = FinancialEntry::where('entry','=','ROE')->get()->first();
        DB::table('analyst_model_dimensions')->insert(array(
            array('category_id' => 3, 'description' => '','label' =>'RONW', 'parent_dimension_id' => null, 'ratio_id' => $entry->id, 'status' => 1, 'weight' => 3, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'sortorder' => 47),
        ));

        $entry = FinancialEntry::where('entry','=','ROCE (EBITDA/Average Total Assets)')->get()->first();
        DB::table('analyst_model_dimensions')->insert(array(
            array('category_id' => 3, 'description' => '','label' =>'ROCE', 'parent_dimension_id' => null, 'ratio_id' => $entry->id, 'status' => 1, 'weight' => 3, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'sortorder' => 48),
        ));

        $entry = FinancialEntry::where('entry','=','Contingent Liabilities / Net Worth')->get()->first();
        DB::table('analyst_model_dimensions')->insert(array(
            array('category_id' => 3, 'description' => '','label' =>'Contingent liability/NW', 'parent_dimension_id' => null, 'ratio_id' => $entry->id, 'status' => 1, 'weight' => 2, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'sortorder' => 49),
        ));

        $entry = FinancialEntry::where('entry','=','Total Debt / EBITDA')->get()->first();
        DB::table('analyst_model_dimensions')->insert(array(
            array('category_id' => 3, 'description' => '','label' =>'Loans & Advances (Given)/NW', 'parent_dimension_id' => null, 'ratio_id' => $entry->id, 'status' => 1, 'weight' => 2, 'is_applicable' => false, 'dimension_type' => 0, 'is_trend' => false, 'sortorder' => 50),
        ));

        DB::table('analyst_model_dimensions')->insert(array(
            array('category_id' => 3, 'description' => '','label' =>'Outlook for the company for next 1 year', 'parent_dimension_id' => null, 'status' => 1, 'weight' => 5, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'sortorder' => 51),
            array('category_id' => 4, 'description' => '','label' =>'Past history of delays in payment / CIBIL', 'parent_dimension_id' => null, 'status' => 1, 'weight' => 35, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'sortorder' => 52),
            array('category_id' => 4, 'description' => '','label' =>'Corporate Governance - Watchout, World Check & Google Checks', 'parent_dimension_id' => null, 'status' => 1, 'weight' => 25, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'sortorder' => 53),
            array('category_id' => 4, 'description' => '','label' =>'External Credit Rating (long term)', 'parent_dimension_id' => null, 'status' => 1, 'weight' => 25, 'is_applicable' => true, 'dimension_type' => 0, 'is_trend' => false, 'sortorder' => 54),
            array('category_id' => 4, 'description' => '','label' =>'Track record of the client with Bank', 'parent_dimension_id' => null, 'status' => 1, 'weight' => 15, 'is_applicable' => false, 'dimension_type' => 0, 'is_trend' => false, 'sortorder' => 55),

        ));

        //insert configuration entries for Credit Model Measures
        DB::table('analyst_model_measures')->insert(array(

            array('dimension_id' => 1, 'description' => '','label' =>'3 months', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 1, 'description' => '','label' =>'2 months', 'status' => 1, 'measure' => 0.5),
            array('dimension_id' => 1, 'description' => '','label' =>'<= 1 month', 'status' => 1, 'measure' => 0),
            array('dimension_id' => 2, 'description' => '','label' =>'Positive', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 2, 'description' => '','label' =>'Neutral', 'status' => 1, 'measure' => 0.5),
            array('dimension_id' => 2, 'description' => '','label' =>'Negative', 'status' => 1, 'measure' => 0),
            array('dimension_id' => 3, 'description' => '','label' =>'High Regulations', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 3, 'description' => '','label' =>'Medium Regulations', 'status' => 1, 'measure' => 0.5),
            array('dimension_id' => 3, 'description' => '','label' =>'Low Regulations', 'status' => 1, 'measure' => 0.25),
        ));

        DB::table('analyst_model_measures')->insert(array(
            array('dimension_id' => 4, 'description' => '','label' =>'< 5 yrs', 'status' => 1, 'measure' => 0, 'operand' => '=', 'single_value' => 1, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 4, 'description' => '','label' =>'5 - 10 yrs', 'status' => 1, 'measure' => 0.5, 'operand' => '=', 'single_value' => 2, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 4, 'description' => '','label' =>'> 10 yrs', 'status' => 1, 'measure' => 1, 'operand' => '=', 'single_value' => 3, 'begin_range' => NULL, 'end_range' => NULL),
        ));

        DB::table('analyst_model_measures')->insert(array(
            array('dimension_id' => 5, 'description' => '','label' =>'1st Gen', 'status' => 1, 'measure' => 0, 'operand' => '=', 'single_value' => 1, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 5, 'description' => '','label' =>'2nd Gen', 'status' => 1, 'measure' => 0.6, 'operand' => '=', 'single_value' => 2, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 5, 'description' => '','label' =>'3rd Gen', 'status' => 1, 'measure' => 1, 'operand' => '=', 'single_value' => 3, 'begin_range' => NULL, 'end_range' => NULL),
        ));

        DB::table('analyst_model_measures')->insert(array(
            array('dimension_id' => 7, 'description' => '','label' =>'Fully Diversified', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 7, 'description' => '','label' =>'Somewhat diversified', 'status' => 1, 'measure' => 0.5),
            array('dimension_id' => 7, 'description' => '','label' =>'Concentrated', 'status' => 1, 'measure' => 0),
        ));

        DB::table('analyst_model_measures')->insert(array(
            array('dimension_id' => 8, 'description' => '','label' =>'Diversified', 'status' => 1, 'measure' => 1, 'operand' => '=', 'single_value' => 0, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 8, 'description' => '','label' =>'Concentrated', 'status' => 1, 'measure' => 0, 'operand' => 'between', 'single_value' => NULL, 'begin_range' => 1, 'end_range' => 2),
        ));

        DB::table('analyst_model_measures')->insert(array(
            array('dimension_id' => 9, 'description' => '','label' =>'Diversified', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 9, 'description' => '','label' =>'Concentrated', 'status' => 1, 'measure' => 0),
            array('dimension_id' => 10, 'description' => '','label' =>'Diversified', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 10, 'description' => '','label' =>'Concentrated', 'status' => 1, 'measure' => 0),
        ));

        DB::table('analyst_model_measures')->insert(array(
            array('dimension_id' => 11, 'description' => '','label' =>'Own', 'status' => 1, 'measure' => 1, 'operand' => '=', 'single_value' => 1, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 11, 'description' => '','label' =>'Rented', 'status' => 1, 'measure' => 0, 'operand' => '=', 'single_value' => 2, 'begin_range' => NULL, 'end_range' => NULL),
        ));

        DB::table('analyst_model_measures')->insert(array(
            array('dimension_id' => 12, 'description' => '','label' =>'Top 5', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 12, 'description' => '','label' =>'Top 10', 'status' => 1, 'measure' => 0.5),
            array('dimension_id' => 12, 'description' => '','label' =>'> Top 10', 'status' => 1, 'measure' => 0),
        ));

        DB::table('analyst_model_measures')->insert(array(
            array('dimension_id' => 13, 'description' => '','label' =>'Professional', 'status' => 1, 'measure' => 1, 'operand' => '<=', 'single_value' => 2, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 13, 'description' => '','label' =>'Non - Professional', 'status' => 1, 'measure' => 0, 'operand' => '>=', 'single_value' => 3, 'begin_range' => NULL, 'end_range' => NULL),
        ));

        DB::table('analyst_model_measures')->insert(array(
            array('dimension_id' => 14, 'description' => '','label' =>'Single', 'status' => 1, 'measure' => 0, 'operand' => '=', 'single_value' => 1, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 14, 'description' => '','label' =>'Two', 'status' => 1, 'measure' => 0.5, 'operand' => '=', 'single_value' => 2, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 14, 'description' => '','label' =>'More than two', 'status' => 1, 'measure' => 1, 'operand' => '>', 'single_value' => 2, 'begin_range' => NULL, 'end_range' => NULL),
        ));
        DB::table('analyst_model_measures')->insert(array(
            array('dimension_id' => 15, 'description' => '','label' =>'Yes', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 15, 'description' => '','label' =>'No', 'status' => 1, 'measure' => 0),
            array('dimension_id' => 16, 'description' => '','label' =>'B2C', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 16, 'description' => '','label' =>'B2B - Good Quality', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 16, 'description' => '','label' =>'B2B - Avg Quality', 'status' => 1, 'measure' => 0.5),
            array('dimension_id' => 16, 'description' => '','label' =>'B2B - Avg Quality', 'status' => 1, 'measure' => 0.5),
            array('dimension_id' => 17, 'description' => '','label' =>'> 2', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 17, 'description' => '','label' =>'1.5 - 2', 'status' => 1, 'measure' => 0.8),
            array('dimension_id' => 17, 'description' => '','label' =>'1 - 1.5', 'status' => 1, 'measure' => 0.6),
            array('dimension_id' => 17, 'description' => '','label' =>'0.5 - 1', 'status' => 1, 'measure' => 0.4),
            array('dimension_id' => 17, 'description' => '','label' =>'0.3 - 0.5', 'status' => 1, 'measure' => 0.25),
            array('dimension_id' => 17, 'description' => '','label' =>'< 0.3', 'status' => 1, 'measure' => 0),
            array('dimension_id' => 19, 'description' => '','label' =>'> 1000 Cr.', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 19, 'description' => '','label' =>'> 500 Cr.', 'status' => 1, 'measure' => 0.75),
            array('dimension_id' => 19, 'description' => '','label' =>'> 250 Cr.', 'status' => 1, 'measure' => 0.5),
            array('dimension_id' => 19, 'description' => '','label' =>'< 250 Cr.', 'status' => 1, 'measure' => 0),
            array('dimension_id' => 20, 'description' => '','label' =>'> 10%', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 20, 'description' => '','label' =>'7% - 10%', 'status' => 1, 'measure' => 0.75),
            array('dimension_id' => 20, 'description' => '','label' =>'5% - 7%', 'status' => 1, 'measure' => 0.5),
            array('dimension_id' => 20, 'description' => '','label' =>'< 5%', 'status' => 1, 'measure' => 0.2),
            array('dimension_id' => 21, 'description' => '','label' =>'> 2.5', 'status' => 1, 'measure' => 0),
            array('dimension_id' => 21, 'description' => '','label' =>'2 - 2.5', 'status' => 1, 'measure' => 0.5),
            array('dimension_id' => 21, 'description' => '','label' =>'1.5 - 2', 'status' => 1, 'measure' => 0.75),
            array('dimension_id' => 21, 'description' => '','label' =>'1 - 1.5', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 22, 'description' => '','label' =>'> 2', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 22, 'description' => '','label' =>'1.5 - 2', 'status' => 1, 'measure' => 0.8),
            array('dimension_id' => 22, 'description' => '','label' =>'1 - 1.5', 'status' => 1, 'measure' => 0.6),
            array('dimension_id' => 22, 'description' => '','label' =>'0.5 - 1', 'status' => 1, 'measure' => 0.4),
            array('dimension_id' => 22, 'description' => '','label' =>'0.3 - 0.5', 'status' => 1, 'measure' => 0.25),
            array('dimension_id' => 22, 'description' => '','label' =>'< 0.3', 'status' => 1, 'measure' => 0),
            array('dimension_id' => 23, 'description' => '','label' =>'Yes', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 23, 'description' => '','label' =>'No', 'status' => 1, 'measure' => 0),
            array('dimension_id' => 24, 'description' => '','label' =>'Yes', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 24, 'description' => '','label' =>'No', 'status' => 1, 'measure' => 0),
            array('dimension_id' => 25, 'description' => '','label' =>'Yes - majority stake', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 25, 'description' => '','label' =>'Yes - Minority stake', 'status' => 1, 'measure' => 0.5),
            array('dimension_id' => 26, 'description' => '','label' =>'Excellent', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 26, 'description' => '','label' =>'Good', 'status' => 1, 'measure' => 0.75),
            array('dimension_id' => 26, 'description' => '','label' =>'Average', 'status' => 1, 'measure' => 0.5),
            array('dimension_id' => 26, 'description' => '','label' =>'Poor', 'status' => 1, 'measure' => 0),
        ));

        DB::table('analyst_model_measures')->insert(array(
            array('dimension_id' => 27, 'description' => '','label' =>'<1', 'status' => 1, 'measure' => 1, 'operand' => '<', 'single_value' => 1, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 27, 'description' => '','label' =>'1-1.5', 'status' => 1, 'measure' => 0.5, 'measure' => 1, 'operand' => 'between', 'single_value' => NULL, 'begin_range' => 1, 'end_range' => 1.5),
            array('dimension_id' => 27, 'description' => '','label' =>'1.5-2', 'status' => 1, 'measure' => 0, 'operand' => 'between', 'single_value' => NULL, 'begin_range' => 1.5, 'end_range' => 2),
            array('dimension_id' => 27, 'description' => '','label' =>'> 2', 'status' => 1, 'measure' => -1, 'operand' => '>', 'single_value' => 2, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 27, 'description' => '','label' =>'> 3', 'status' => 1, 'measure' => 0, 'operand' => '>', 'single_value' => 3, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 28, 'description' => '','label' =>'> 2', 'status' => 1, 'measure' => 1, 'operand' => '>', 'single_value' => 2, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 28, 'description' => '','label' =>'1.5 - 2', 'status' => 1, 'measure' => 0.6, 'operand' => 'between', 'single_value' => NULL, 'begin_range' => 1.5, 'end_range' => 2),
            array('dimension_id' => 28, 'description' => '','label' =>'1 - 1.5', 'status' => 1, 'measure' => 0.3, 'operand' => 'between', 'single_value' => NULL, 'begin_range' => 1, 'end_range' => 1.5),
            array('dimension_id' => 28, 'description' => '','label' =>'< 1', 'status' => 1, 'measure' => 0, 'operand' => '<', 'single_value' => 1, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 28, 'description' => '','label' =>'< 0.5', 'status' => 1, 'measure' => 0, 'operand' => '<', 'single_value' => 0.5, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 29, 'description' => '','label' =>'< 1.2', 'status' => 1, 'measure' => 0, 'operand' => '<', 'single_value' => 1.2, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 29, 'description' => '','label' =>'1.2 - 1.8', 'status' => 1, 'measure' => 0.3, 'operand' => 'between', 'single_value' => NULL, 'begin_range' => 1.2, 'end_range' => 1.8),
            array('dimension_id' => 29, 'description' => '','label' =>'1.8 - 2.5', 'status' => 1, 'measure' => 0.6, 'operand' => 'between', 'single_value' => NULL, 'begin_range' => 1.8, 'end_range' => 2.5),
            array('dimension_id' => 29, 'description' => '','label' =>'> 2.5', 'status' => 1, 'measure' => 1, 'operand' => '>', 'single_value' => 2.5, 'begin_range' => NULL, 'end_range' => NULL),
			array('dimension_id' => 30, 'description' => '','label' =>'< 0.5', 'status' => 1, 'measure' => 0, 'operand' => '<', 'single_value' => 0.5, 'begin_range' => NULL, 'end_range' => NULL),
			array('dimension_id' => 30, 'description' => '','label' =>'< 0.5', 'status' => 1, 'measure' => 0, 'operand' => '<', 'single_value' => 0.5, 'begin_range' => NULL, 'end_range' => NULL),
			array('dimension_id' => 30, 'description' => '','label' =>'0.5 - 1.0', 'status' => 1, 'measure' => 0.3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 0.5, 'end_range' => 1),
			array('dimension_id' => 30, 'description' => '','label' =>'1.0 - 1.5', 'status' => 1, 'measure' => 0.7, 'operand' => 'between', 'single_value' => null, 'begin_range' => 1, 'end_range' => 1.5),
			array('dimension_id' => 30, 'description' => '','label' =>'> 1.5', 'status' => 1, 'measure' => 1, 'operand' => '>', 'single_value' => 1.5, 'begin_range' => null, 'end_range' => null),
            array('dimension_id' => 31, 'description' => '','label' =>'< 1', 'status' => 1, 'measure' => 1, 'operand' => '<', 'single_value' => 1, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 31, 'description' => '','label' =>'1-2', 'status' => 1, 'measure' => 0.75, 'operand' => 'between', 'single_value' => NULL, 'begin_range' => 1, 'end_range' => 2),
            array('dimension_id' => 31, 'description' => '','label' =>'2-3', 'status' => 1, 'measure' => 0.5, 'operand' => 'between', 'single_value' => NULL, 'begin_range' => 2, 'end_range' => 3),
            array('dimension_id' => 31, 'description' => '','label' =>'3-4', 'status' => 1, 'measure' => 0.3, 'operand' => 'between', 'single_value' => NULL, 'begin_range' => 3, 'end_range' => 4),
            array('dimension_id' => 31, 'description' => '','label' =>'4-5', 'status' => 1, 'measure' => 0, 'operand' => 'between', 'single_value' => NULL, 'begin_range' => 4, 'end_range' => 5),
        ));

        DB::table('analyst_model_measures')->insert(array(
            array('dimension_id' => 33, 'description' => '','label' =>'+ve trend', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 33, 'description' => '','label' =>'No trend', 'status' => 1, 'measure' => 0.5),
            array('dimension_id' => 33, 'description' => '','label' =>'-ve trend', 'status' => 1, 'measure' => 0),
            array('dimension_id' => 34, 'description' => '','label' =>'+ve trend', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 34, 'description' => '','label' =>'No trend', 'status' => 1, 'measure' => 0.5),
            array('dimension_id' => 34, 'description' => '','label' =>'-ve trend', 'status' => 1, 'measure' => 0),
        ));

        DB::table('analyst_model_measures')->insert(array(
            array('dimension_id' => 35, 'description' => '','label' =>'< 0.2', 'status' => 1, 'measure' => 0, 'operand' => '<', 'single_value' => 0.2, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 35, 'description' => '','label' =>'> 0.2 and < 0.4', 'status' => 1, 'measure' => 0.3, 'operand' => 'between', 'single_value' => NULL, 'begin_range' => 0.2, 'end_range' => 0.4),
            array('dimension_id' => 35, 'description' => '','label' =>'> 0.4 and < 0.7', 'status' => 1, 'measure' => 0.6, 'operand' => 'between', 'single_value' => NULL, 'begin_range' => 0.4, 'end_range' => 0.7),
            array('dimension_id' => 35, 'description' => '','label' =>'> 0.7 and <= 1', 'status' => 1, 'measure' => 1, 'operand' => 'between', 'single_value' => null, 'begin_range' => 0.7, 'end_range' => 1),
            array('dimension_id' => 36, 'description' => '','label' =>'> 2', 'status' => 1, 'measure' => 1, 'operand' => '>', 'single_value' => 2, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 36, 'description' => '','label' =>'1.5 - 2', 'status' => 1, 'measure' => 0.8, 'operand' => 'between', 'single_value' => NULL, 'begin_range' => 1.5, 'end_range' => 2),
            array('dimension_id' => 36, 'description' => '','label' =>'1 - 1.5', 'status' => 1, 'measure' => 0.5, 'operand' => 'between', 'single_value' => NULL, 'begin_range' => 1, 'end_range' => 1.5),
            array('dimension_id' => 36, 'description' => '','label' =>'< 1', 'status' => 1, 'measure' => 0, 'operand' => '<', 'single_value' => 1, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 37, 'description' => '','label' =>'> 1.5', 'status' => 1, 'measure' => 1, 'operand' => '>', 'single_value' => 1.5, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 37, 'description' => '','label' =>'1 - 1.5', 'status' => 1, 'measure' => 0.8, 'operand' => 'between', 'single_value' => NULL, 'begin_range' => 1, 'end_range' => 1.5),
            array('dimension_id' => 37, 'description' => '','label' =>'0.7 - 1', 'status' => 1, 'measure' => 0.4, 'operand' => 'between', 'single_value' => NULL, 'begin_range' => 0.7, 'end_range' => 1),
            array('dimension_id' => 37, 'description' => '','label' =>'0.4 - 0.7', 'status' => 1, 'measure' => 0, 'operand' => 'between', 'single_value' => NULL, 'begin_range' => 0.4, 'end_range' => 0.7),
            array('dimension_id' => 38, 'description' => '','label' =>'> 15%', 'status' => 1, 'measure' => 1, 'operand' => '>', 'single_value' => 0.15, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 38, 'description' => '','label' =>'> 10%', 'status' => 1, 'measure' => 0.5, 'operand' => '>', 'single_value' => 0.1, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 38, 'description' => '','label' =>'< 10%', 'status' => 1, 'measure' => 0, 'operand' => '<', 'single_value' => 0.1, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 39, 'description' => '','label' =>'> 15%', 'status' => 1, 'measure' => 1, 'operand' => '>', 'single_value' => 0.15, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 39, 'description' => '','label' =>'> 10%', 'status' => 1, 'measure' => 0.5, 'operand' => '>', 'single_value' => 0.1, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 39, 'description' => '','label' =>'< 10%', 'status' => 1, 'measure' => 0, 'operand' => '<', 'single_value' => 0.1, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 40, 'description' => '','label' =>'<= 0%', 'status' => 1, 'measure' => 1, 'operand' => '<=', 'single_value' => 0, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 40, 'description' => '','label' =>'< 15%', 'status' => 1, 'measure' => 0.5, 'operand' => '<', 'single_value' => 0.15, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 40, 'description' => '','label' =>'< 25%', 'status' => 1, 'measure' => 0.25, 'operand' => '<', 'single_value' => 0.25, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 41, 'description' => '','label' =>'<= 0%', 'status' => 1, 'measure' => 1, 'operand' => '<=', 'single_value' => 0, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 41, 'description' => '','label' =>'< 15%', 'status' => 1, 'measure' => 0.5, 'operand' => '<', 'single_value' => 0.15, 'begin_range' => NULL, 'end_range' => NULL),
            array('dimension_id' => 41, 'description' => '','label' =>'< 40%', 'status' => 1, 'measure' => 0.25, 'operand' => '<', 'single_value' => 0.4, 'begin_range' => NULL, 'end_range' => NULL),
        ));

        DB::table('analyst_model_measures')->insert(array(
            array('dimension_id' => 42, 'description' => '','label' =>'Positive', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 42, 'description' => '','label' =>'Neutral', 'status' => 1, 'measure' => 0.5),
            array('dimension_id' => 42, 'description' => '','label' =>'Negative', 'status' => 1, 'measure' => 0),
            array('dimension_id' => 43, 'description' => '','label' =>'No Defaults', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 43, 'description' => '','label' =>'Delays not critical', 'status' => 1, 'measure' => 0.8),
            array('dimension_id' => 43, 'description' => '','label' =>'Critical delays', 'status' => 1, 'measure' => 0.5),
            array('dimension_id' => 43, 'description' => '','label' =>'Default', 'status' => 1, 'measure' => 0),
            array('dimension_id' => 44, 'description' => '','label' =>'Positive', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 44, 'description' => '','label' =>'Neutral', 'status' => 1, 'measure' => 0.5),
            array('dimension_id' => 44, 'description' => '','label' =>'Negative', 'status' => 1, 'measure' => 0),
            array('dimension_id' => 45, 'description' => '','label' =>'> A', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 45, 'description' => '','label' =>'A- to BBB', 'status' => 1, 'measure' => 0.5),
            array('dimension_id' => 45, 'description' => '','label' =>'BBB- to BB+', 'status' => 1, 'measure' => 0.2),
            array('dimension_id' => 45, 'description' => '','label' =>'<= BB', 'status' => 1, 'measure' => 0),
            array('dimension_id' => 45, 'description' => '','label' =>'Clean', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 45, 'description' => '','label' =>'Minor delays', 'status' => 1, 'measure' => 0.7),
            array('dimension_id' => 45, 'description' => '','label' =>'Serious delays', 'status' => 1, 'measure' => 0.3),
            array('dimension_id' => 45, 'description' => '','label' =>'Defaults', 'status' => 1, 'measure' => 0),
            array('dimension_id' => 46, 'description' => '','label' =>'Clean', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 46, 'description' => '','label' =>'Minor Delays', 'status' => 1, 'measure' => 0.7),
            array('dimension_id' => 46, 'description' => '','label' =>'Serious Delays', 'status' => 1, 'measure' => 0.3),
            array('dimension_id' => 46, 'description' => '','label' =>'Defaults', 'status' => 1, 'measure' => 0),
        ));

        //insert configuration entries for Collateral Model Categories
        DB::table('analyst_model_categories')->insert(array(
            array('type' => 'Collateral', 'label' =>'Real Estate', 'description' => '', 'weight' => 100, 'status' => 1),
        ));

        //insert configuration entries for Credit Model Dimensions
        DB::table('analyst_model_dimensions')->insert(array(
            array('category_id' => 5, 'description' => '','label' =>'City', 'parent_dimension_id' => null, 'status' => 1, 'weight' => 15, 'is_applicable' => true, 'dimension_type' => 0, 'sortorder' => 1),
            array('category_id' => 5, 'description' => '','label' =>'Property location', 'parent_dimension_id' => null, 'status' => 1, 'weight' => 20, 'is_applicable' => true, 'dimension_type' => 0, 'sortorder' => 1),
            array('category_id' => 5, 'description' => '','label' =>'Type of property (Commercial, Residential)', 'parent_dimension_id' => null, 'status' => 1, 'weight' => 20, 'is_applicable' => true, 'dimension_type' => 1, 'sortorder' => 1),
            array('category_id' => 5, 'description' => '','label' =>'- Commercial/residential/Industrial', 'parent_dimension_id' => 48, 'status' => 1, 'weight' => 50, 'is_applicable' => true, 'dimension_type' => 0, 'sortorder' => 1),
            array('category_id' => 5, 'description' => '','label' =>'- Super luxury/luxury/economic/low budget', 'parent_dimension_id' => 48, 'status' => 1, 'weight' => 25, 'is_applicable' => true, 'dimension_type' => 0, 'sortorder' => 1),
            array('category_id' => 5, 'description' => '','label' =>'- Old building/New building', 'parent_dimension_id' => 48, 'status' => 1, 'weight' => 25, 'is_applicable' => true, 'dimension_type' => 0, 'sortorder' => 1),
            array('category_id' => 5, 'description' => '','label' =>'Construction stage - Applicable only for RE funding', 'parent_dimension_id' => null, 'status' => 1, 'weight' => 30, 'is_applicable' => false, 'dimension_type' => 0, 'sortorder' => 1),
            array('category_id' => 5, 'description' => '','label' =>'Ability to liquidate (Direct, Trustee, 2nd charge etc., Self occupied/leased/empty)', 'parent_dimension_id' => null, 'status' => 1, 'weight' => 10, 'is_applicable' => true, 'dimension_type' => 0, 'sortorder' => 1),
            array('category_id' => 5, 'description' => '','label' =>'Self owned or Third party', 'parent_dimension_id' => null, 'status' => 1, 'weight' => 5, 'is_applicable' => true, 'dimension_type' => 0, 'sortorder' => 1),
        ));

        //insert configuration entries for Credit Model Measures
        DB::table('analyst_model_measures')->insert(array(
            array('dimension_id' => 47, 'description' => '','label' =>'Tier 1', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 47, 'description' => '','label' =>'Tier 2', 'status' => 1, 'measure' => 0.5),
            array('dimension_id' => 47, 'description' => '','label' =>'Tier 3', 'status' => 1, 'measure' => 0.3),
            array('dimension_id' => 47, 'description' => '','label' =>'Semi-Urban', 'status' => 1, 'measure' => 0.4),
            array('dimension_id' => 47, 'description' => '','label' =>'Rural', 'status' => 1, 'measure' => 0),

            array('dimension_id' => 48, 'description' => '','label' =>'Prime', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 48, 'description' => '','label' =>'Neutral', 'status' => 1, 'measure' => 0.5),
            array('dimension_id' => 48, 'description' => '','label' =>'Poor', 'status' => 1, 'measure' => 0),

            array('dimension_id' => 50, 'description' => '','label' =>'Residential', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 50, 'description' => '','label' =>'Commercial', 'status' => 1, 'measure' => 0.3),
            array('dimension_id' => 50, 'description' => '','label' =>'Industrial', 'status' => 1, 'measure' => 0.3),
            array('dimension_id' => 50, 'description' => '','label' =>'Land - Agricultural', 'status' => 1, 'measure' => 0.2),
            array('dimension_id' => 50, 'description' => '','label' =>'Land - Residential', 'status' => 1, 'measure' => 0.8),
            array('dimension_id' => 50, 'description' => '','label' =>'Land - Other', 'status' => 1, 'measure' => 0.5),
            array('dimension_id' => 50, 'description' => '','label' =>'Land with restricted use', 'status' => 1, 'measure' => 0.2),

            array('dimension_id' => 51, 'description' => '','label' =>'Low budget', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 51, 'description' => '','label' =>'Economic', 'status' => 1, 'measure' => 0.7),
            array('dimension_id' => 51, 'description' => '','label' =>'Luxury/Super luxury', 'status' => 1, 'measure' => 0.4),

            array('dimension_id' => 52, 'description' => '','label' =>'Age <= 5 yrs', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 52, 'description' => '','label' =>'Age - 5 to 15 yrs', 'status' => 1, 'measure' => 0.8),
            array('dimension_id' => 52, 'description' => '','label' =>'Age - 15 to 30 yrs', 'status' => 1, 'measure' => 0.4),
            array('dimension_id' => 52, 'description' => '','label' =>'Age - > 30 yrs', 'status' => 1, 'measure' => 0),

            array('dimension_id' => 53, 'description' => '','label' =>'Construction to begin - No approvals in place', 'status' => 1, 'measure' => 0),
            array('dimension_id' => 53, 'description' => '','label' =>'Construction to begin - Part approvals in place', 'status' => 1, 'measure' => 0),
            array('dimension_id' => 53, 'description' => '','label' =>'Construction to begin - All approvals in place', 'status' => 1, 'measure' => 0.5),
            array('dimension_id' => 53, 'description' => '','label' =>'Construction stage - < 20%', 'status' => 1, 'measure' => 0.1),
            array('dimension_id' => 53, 'description' => '','label' =>'Construction stage - < 20 - 50%', 'status' => 1, 'measure' => 0.15),
            array('dimension_id' => 53, 'description' => '','label' =>'Construction stage - < 50 - 75%', 'status' => 1, 'measure' => 0.3),
            array('dimension_id' => 53, 'description' => '','label' =>'Construction stage - > 75%', 'status' => 1, 'measure' => 0.55),
            array('dimension_id' => 53, 'description' => '','label' =>'Ready possession', 'status' => 1, 'measure' => 1),

            array('dimension_id' => 54, 'description' => '','label' =>'2nd Charge', 'status' => 1, 'measure' => 0),
            array('dimension_id' => 54, 'description' => '','label' =>'Independent - Self Occupied', 'status' => 1, 'measure' => 0.3),
            array('dimension_id' => 54, 'description' => '','label' =>'Independent - Leased', 'status' => 1, 'measure' => 0.6),
            array('dimension_id' => 54, 'description' => '','label' =>'Independent - Empty', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 54, 'description' => '','label' =>'Dependent - Self Occupied', 'status' => 1, 'measure' => 0.2),
            array('dimension_id' => 54, 'description' => '','label' =>'Dependent - Leased', 'status' => 1, 'measure' => 0.5),
            array('dimension_id' => 54, 'description' => '','label' =>'Dependent - Empty', 'status' => 1, 'measure' => 0.75),

            array('dimension_id' => 55, 'description' => '','label' =>'Self owned', 'status' => 1, 'measure' => 1),
            array('dimension_id' => 55, 'description' => '','label' =>'Single Third Party', 'status' => 1, 'measure' => 0.6),
            array('dimension_id' => 55, 'description' => '','label' =>'Multiple Third Parties', 'status' => 1, 'measure' => 0.4),
            array('dimension_id' => 55, 'description' => '','label' =>'Single Related Party', 'status' => 1, 'measure' => 0.8),
            array('dimension_id' => 55, 'description' => '','label' =>'Multiple Related Parties', 'status' => 1, 'measure' => 0.5),

        ));

            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}