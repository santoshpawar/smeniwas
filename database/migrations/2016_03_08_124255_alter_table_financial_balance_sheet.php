<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableFinancialBalanceSheet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('financials_balance_sheet', function (Blueprint $table) {
            $table->double('land_and_building')->nullable()->after('total_liabilities');
            $table->double('plant_and_machinery')->nullable()->after('land_and_building');
            $table->double('capital_work_in_progress')->nullable()->after('plant_and_machinery');
            $table->double('nca_others')->nullable()->after('capital_work_in_progress');
            $table->double('long_term_investments')->nullable()->after('total_fixed_assets');
            $table->double('short_term_investments')->nullable()->after('long_term_investments');

            $table->double('receivables_less_180_related')->nullable()->after('cash_balance');
            $table->double('receivables_more_180_related')->nullable()->after('receivables_less_180_related');
            $table->double('receivables_from_related_party')->nullable()->after('receivables_more_180_related');
            $table->double('receivables_less_180_unrelated')->nullable()->after('receivables_from_related_party');
            $table->double('receivables_more_180_unrelated')->nullable()->after('receivables_less_180_unrelated');
            $table->double('receivables_from_unrelated_party')->nullable()->after('receivables_more_180_unrelated');
            $table->double('finished_goods')->nullable()->after('third_party_advances');
            $table->double('wip')->nullable()->after('finished_goods');
            $table->double('raw_materials')->nullable()->after('wip');
            $table->double('capital_advances')->nullable()->after('inventories');
            $table->double('advances_to_suppliers')->nullable()->after('capital_advances');
            $table->double('mat_credit')->nullable()->after('advances_to_suppliers');
            $table->double('advance_tax')->nullable()->after('mat_credit');
            $table->double('ca_others')->nullable()->after('advance_tax');

            $table->renameColumn('share_capital', 'equity_share_capital');
            $table->renameColumn('reserves', 'total_reserves');
            $table->double('pref_share_capital_comp_conv')->nullable()->after('share_capital');
            $table->double('pref_share_capital_redeemable')->nullable()->after('pref_share_capital_comp_conv');
            $table->double('total_share_capital')->nullable()->after('pref_share_capital_redeemable');
            $table->double('share_premium')->nullable()->after('total_share_capital');
            $table->double('other_reserves')->nullable()->after('share_premium');
            $table->double('share_application_money')->nullable()->after('other_reserves');

            $table->double('deffered_tax_liability')->nullable()->after('long_term_liabilities');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('financials_balance_sheet', function (Blueprint $table) {
            $table->dropColumn(['land_and_building', 'plant_and_machinery', 'capital_work_in_progress', 'nca_others', 'long_term_investments', 'short_term_investments']); 
            
            $table->dropColumn(['receivables_less_180_related', 'receivables_more_180_related', 'receivables_from_related_party', 'receivables_less_180_unrelated', 'receivables_more_180_unrelated', 'receivables_from_unrelated_party', 'finished_goods', 'wip', 'raw_materials', 'current_assets', 'advances_to_suppliers', 'mat_credit', 'advance_tax', 'ca_others']);
            
            $table->renameColumn('equity_share_capital', 'share_capital');
            $table->renameColumn('total_reserves', 'reserves');
            $table->dropColumn(['pref_share_capital_comp_conv', 'pref_share_capital_redeemable', 'total_share_capital', 'share_premium', 'other_reserves', 'share_application_money']);
            
            $table->dropColumn(['deffered_tax_liability']); 
        });
    }
}
