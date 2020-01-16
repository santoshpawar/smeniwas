<?php

use App\Models\Loan\FinancialData\FinancialGroup;
use App\Models\Loan\FinancialData\FinancialEntry;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class FinEntriesNewHeadsSeeder extends Seeder
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

        $group = FinancialGroup::where('name','=','Shareholders Funds')->get()->first();

        //insert configuration entries
        DB::table('conf_financial_entries')->insert(array(

            array('group_id'=> $group->id , 'entry' => 'Equity Share Capital', 'description' => '', 'calculation_method' => 'Manual', 'formula_reference' => 'A1', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'equity_share_capital', 'sortorder' => 5, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Preference Share Capital (Compulsorily Convertible)', 'description' => '', 'calculation_method' => 'Manual', 'formula_reference' => 'A2', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'pref_share_capital_comp_conv', 'sortorder' => 10, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Preference Share Capital (Redeemable)', 'description' => '', 'calculation_method' => 'Manual', 'formula_reference' => 'A3', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'pref_share_capital_redeemable', 'sortorder' => 15, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Share Premium', 'description' => '', 'calculation_method' => 'Manual', 'formula_reference' => 'B1', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'share_premium', 'sortorder' => 25, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Other Reserves (net of Revaluation Reserves)', 'description' => '', 'calculation_method' => 'Manual', 'formula_reference' => 'B2', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'other_reserves', 'sortorder' => 30, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Share Application Money', 'description' => '', 'calculation_method' => 'Manual', 'formula_reference' => 'B3', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'share_application_money', 'sortorder' => 35, 'status' =>1),
        ));

		$group = FinancialGroup::where('name','=','Non Current Assets')->get()->first();

		//insert configuration entries
        DB::table('conf_financial_entries')->insert(array(

            array('group_id'=> $group->id , 'entry' => 'Land and Building', 'description' => '', 'calculation_method' => 'Manual', 'formula_reference' => 'O1', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'land_and_building', 'sortorder' => 5, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Plant and Machinery', 'description' => '', 'calculation_method' => 'Manual', 'formula_reference' => 'O2', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'plant_and_machinery', 'sortorder' => 10, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Capital Work In Progress', 'description' => '', 'calculation_method' => 'Manual', 'formula_reference' => 'O3', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'capital_work_in_progress', 'sortorder' => 15, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Others', 'description' => '', 'calculation_method' => 'Manual', 'formula_reference' => 'O4', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'nca_others', 'sortorder' => 20, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Long Term Investments', 'description' => '', 'calculation_method' => 'Manual', 'formula_reference' => 'T1', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'long_term_investments', 'sortorder' => 50, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Short Term Investments', 'description' => '', 'calculation_method' => 'Manual', 'formula_reference' => 'T2', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'short_term_investments', 'sortorder' => 55, 'status' =>1),
        ));

		$group = FinancialGroup::where('name','=','Current Assets')->get()->first();

		//insert configuration entries
        DB::table('conf_financial_entries')->insert(array(

            array('group_id'=> $group->id , 'entry' => 'Receivables from related party', 'description' => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'V1', 'formula' => '( V11 + V12 )', 'model' => 'financials_balance_sheet', 'attribute' => 'receivables_from_related_party', 'sortorder' => 20, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Receivables < 180 days from unrelated party', 'description' => '', 'calculation_method' => 'Manual', 'formula_reference' => 'V21', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'receivables_less_180_unrelated', 'sortorder' => 25, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Receivables > 180 days from unrelated party', 'description' => '', 'calculation_method' => 'Manual', 'formula_reference' => 'V22', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'receivables_more_180_unrelated', 'sortorder' => 15, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Receivables from unrelated party', 'description' => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'V2', 'formula' => '( V21 + V22 )', 'model' => 'financials_balance_sheet', 'attribute' => 'receivables_from_unrelated_party', 'sortorder' => 20, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Finished Goods', 'description' => '', 'calculation_method' => 'Manual', 'formula_reference' => 'X1', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'finished_goods', 'sortorder' => 50, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'WIP', 'description' => '', 'calculation_method' => 'Manual', 'formula_reference' => 'X2', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'wip', 'sortorder' => 55, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Raw Materials', 'description' => '', 'calculation_method' => 'Manual', 'formula_reference' => 'X3', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'raw_materials', 'sortorder' => 60, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Capital Advances', 'description' => '', 'calculation_method' => 'Manual', 'formula_reference' => 'Y1', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'capital_advances', 'sortorder' => 70, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Advances to Suppliers', 'description' => '', 'calculation_method' => 'Manual', 'formula_reference' => 'Y2', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'advances_to_suppliers', 'sortorder' => 75, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Mat Credit', 'description' => '', 'calculation_method' => 'Manual', 'formula_reference' => 'Y3', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'mat_credit', 'sortorder' => 80, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Advance Tax', 'description' => '', 'calculation_method' => 'Manual', 'formula_reference' => 'Y4', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'advance_tax', 'sortorder' => 85, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Others (Extra)', 'description' => '', 'calculation_method' => 'Manual', 'formula_reference' => 'Y5', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'ca_others', 'sortorder' => 90, 'status' =>1),
        ));

		$group = FinancialGroup::where('name','=','Non Current Liabilities')->get()->first();

		//insert configuration entries
        DB::table('conf_financial_entries')->insert(array(

            array('group_id'=> $group->id , 'entry' => 'Deffered Tax Liability', 'description' => '', 'calculation_method' => 'Manual', 'formula_reference' => 'GH', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'deffered_tax_liability', 'sortorder' => 15, 'status' =>1),
        ));

        $group = FinancialGroup::where('name','=','Current Liabilities')->get()->first();

        //insert configuration entries
        DB::table('conf_financial_entries')->insert(array(

            array('group_id'=> $group->id , 'entry' => 'Short Term Provisions', 'description' => '', 'calculation_method' => 'Manual', 'formula_reference' => 'LM', 'formula' => '', 'model' => 'financials_balance_sheet', 'attribute' => 'short_term_provisions', 'sortorder' => 20, 'status' =>1),
        ));

        
        //TAX & PAT
        $group = FinancialGroup::where('name','=','Tax & PAT')->get()->first();

        //update configuration entries
        DB::table('conf_financial_entries')->where('group_id', '=', $group->id)->where('formula_reference', '=', 'PP')->update(

            array('formula_reference' => 'RR', 'formula' => 'PP - QQ', 'sortorder' => 20, 'status' =>1)
        );

        //update configuration entries
        DB::table('conf_financial_entries')->where('group_id', '=', $group->id)->where('formula_reference', '=', 'OO')->update(

            array('formula_reference' => 'QQ', 'formula' => 'QQ1 + QQ2', 'sortorder' => 15, 'status' =>1)
        );

        //insert configuration entries
        DB::table('conf_financial_entries')->insert(array(

            array('group_id'=> $group->id , 'entry' => 'Current Tax', 'description' => '', 'calculation_method' => 'Manual', 'formula_reference' => 'QQ1', 'formula' => '', 'model' => 'financials_profit_loss', 'attribute' => 'current_tax', 'sortorder' => 5, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Deffered Tax', 'description' => '', 'calculation_method' => 'Manual', 'formula_reference' => 'QQ2', 'formula' => '', 'model' => 'financials_profit_loss', 'attribute' => 'deffered_tax', 'sortorder' => 10, 'status' =>1)
        ));
        

        //Others & PBT
        $group = FinancialGroup::where('name','=','Others & PBT')->get()->first();

        //update configuration entries
        DB::table('conf_financial_entries')->where('group_id', '=', $group->id)->where('formula_reference', '=', 'NN')->update(

            array('formula_reference' => 'PP', 'formula' => 'LL + MM - NN - OO', 'sortorder' => 20, 'status' =>1)
        );

        DB::table('conf_financial_entries')->where('group_id', '=', $group->id)->where('formula_reference', '=', 'MM')->update(

            array('formula_reference' => 'OO', 'formula' => '', 'sortorder' => 15, 'status' =>1)
        );

        DB::table('conf_financial_entries')->where('group_id', '=', $group->id)->where('formula_reference', '=', 'LL')->update(

            array('formula_reference' => 'NN', 'formula' => '', 'sortorder' => 10, 'status' =>1)
        );

        DB::table('conf_financial_entries')->where('group_id', '=', $group->id)->where('formula_reference', '=', 'KK')->update(

            array('formula_reference' => 'MM', 'formula' => '', 'sortorder' => 5, 'status' =>1)
        );

        //Operating Expenses & EBITDA
        $group = FinancialGroup::where('name','=','Operating Expenses & EBITDA')->get()->first();

        //update configuration entries
        DB::table('conf_financial_entries')->where('group_id', '=', $group->id)->where('formula_reference', '=', 'JJ')->update(

            array('formula_reference' => 'LL', 'formula' => 'EE - FF - GG - HH - II - JJ - KK', 'sortorder' => 45, 'status' =>1)
        );

        DB::table('conf_financial_entries')->where('group_id', '=', $group->id)->where('formula_reference', '=', 'II')->update(

            array('formula_reference' => 'KK', 'formula' => '', 'sortorder' => 40, 'status' =>1)
        );

        //insert configuration entries
        DB::table('conf_financial_entries')->insert(array(

            array('group_id'=> $group->id , 'entry' => 'Repairs and Maintenance', 'description' => '', 'calculation_method' => 'Manual', 'formula_reference' => 'II', 'formula' => '', 'model' => 'financials_profit_loss', 'attribute' => 'repairs', 'sortorder' => 30, 'status' =>1),
            array('group_id'=> $group->id , 'entry' => 'Legal and Professional Charges (other than finance related)', 'description' => '', 'calculation_method' => 'Manual', 'formula_reference' => 'JJ', 'formula' => '', 'model' => 'financials_profit_loss', 'attribute' => 'legal_charges', 'sortorder' => 35, 'status' =>1)
        ));

        //Ratios
        $group = FinancialGroup::where('name','=','Profitability ratios')->get()->first();

        //update configuration entries
        DB::table('conf_financial_entries')->where('group_id', '=', $group->id)->where('formula_reference', '=', 'AAA')->update(

            array('formula' => '( LL / CC ) * 100')
        );

        DB::table('conf_financial_entries')->where('group_id', '=', $group->id)->where('formula_reference', '=', 'BBB')->update(

            array('formula' => '( RR / CC ) * 100')
        );

        DB::table('conf_financial_entries')->where('group_id', '=', $group->id)->where('formula_reference', '=', 'CCC')->update(

            array('formula' => 'EE / ( FF + GG + HH + KK )')
        );

        DB::table('conf_financial_entries')->where('group_id', '=', $group->id)->where('formula_reference', '=', 'DDD')->update(

            array('formula' => 'LL / OO')
        );

        DB::table('conf_financial_entries')->where('group_id', '=', $group->id)->where('formula_reference', '=', 'EEE')->update(

            array('formula' => '( LL / ( OO + @ - 1 L ) )')
        );

        //insert configuration entries
        DB::table('conf_financial_entries')->insert(array(

            array('group_id'=> $group->id , 'entry' => 'Contribution/Other Fixed Expenses', 'description' => '', 'calculation_method' => 'Calculated', 'formula_reference' => 'COFE', 'formula' => 'EE / ( GG + HH + II + JJ + KK )', 'model' => 'financials_ratios', 'attribute' => 'contribution_expences', 'sortorder' => 20, 'status' =>1),
        ));

        $group = FinancialGroup::where('name','=','Leverage Ratios')->get()->first();

        DB::table('conf_financial_entries')->where('group_id', '=', $group->id)->where('formula_reference', '=', 'FFF')->update(

            array('formula' => '( A3 + F + J + L ) / ( E - V2 - W2 )')
        );

        DB::table('conf_financial_entries')->where('group_id', '=', $group->id)->where('formula_reference', '=', 'GGG')->update(

            array('formula' => '( A3 + F + J + L ) / LL')
        );

        DB::table('conf_financial_entries')->where('group_id', '=', $group->id)->where('formula_reference', '=', 'HHH')->update(

            array('formula' => '( A3 + F + L ) / LL')
        );

        DB::table('conf_financial_entries')->where('group_id', '=', $group->id)->where('formula_reference', '=', 'III')->update(

            array('formula' => '( ( E - V2 - W2 ) / ( S + T + Z ) ) * 100')
        );

        DB::table('conf_financial_entries')->where('group_id', '=', $group->id)->where('formula_reference', '=', 'IIA')->update(

            array('formula' => '( ( A3 + F + J + L ) / CC )')
        );

        $group = FinancialGroup::where('name','=','Liquidity Ratios')->get()->first();

        DB::table('conf_financial_entries')->where('group_id', '=', $group->id)->where('formula_reference', '=', 'JJJ')->update(

            array('formula' => '( V1 + V2 ) / CC * 365')
        );

        DB::table('conf_financial_entries')->where('group_id', '=', $group->id)->where('formula_reference', '=', 'KKK')->update(

            array('formula' => 'X / CC * 365')
        );

        DB::table('conf_financial_entries')->where('group_id', '=', $group->id)->where('formula_reference', '=', 'LLL')->update(

            array('formula' => 'K / CC * 365')
        );

        DB::table('conf_financial_entries')->where('group_id', '=', $group->id)->where('formula_reference', '=', 'MMM')->update(

            array('formula' => '( V1 + V2 + X - K ) / CC * 365')
        );

        DB::table('conf_financial_entries')->where('group_id', '=', $group->id)->where('formula_reference', '=', 'NNN')->update(

            array('formula' => '( Z - V2 - W1 ) / N')
        );

        $group = FinancialGroup::where('name','=','Asset Turnover Ratios')->get()->first();

        DB::table('conf_financial_entries')->where('group_id', '=', $group->id)->where('formula_reference', '=', 'OOO')->update(

            array('formula' => 'LL / ( ( @ - 1 S + @ - 1 T + @ - 1 Z ) / 3 )')
        );

        DB::table('conf_financial_entries')->where('group_id', '=', $group->id)->where('formula_reference', '=', 'PPP')->update(

            array('formula' => '( RR / E ) * 100')
        );

        DB::table('conf_financial_entries')->where('group_id', '=', $group->id)->where('formula_reference', '=', 'QQQ')->update(

            array('formula' => 'CC / Q')
        );

        DB::table('conf_financial_entries')->where('group_id', '=', $group->id)->where('formula_reference', '=', 'RRR')->update(

            array('formula' => 'CC / ( S + T + Z )')
        );

        DB::table('conf_financial_entries')->where('group_id', '=', $group->id)->where('formula_reference', '=', 'SSS')->update(

            array('formula' => '( ZB / E ) * 100')
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
