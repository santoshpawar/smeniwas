<?php

namespace App\Models\Loan\FinancialData;

use Illuminate\Database\Eloquent\Model;

class BalanceSheet extends Model {

    public $table = "financials_balance_sheet";

    protected $fillable = [
        'loan_id',
        'period',
        
        'equity_share_capital',
        'pref_share_capital_comp_conv',
        'pref_share_capital_redeemable',
        'total_share_capital',
        'share_premium',
        'other_reserves',
        'share_application_money',
        'share_application_money',
        'total_reserves',
        'net_worth',
        'loans',
        'total_shareholders_funds',

        'long_term_borrowings',
        'long_term_liabilities',
        'deffered_tax_liability',
        'long_term_provisions',
        'total_long_term_liabilities',

        'short_term_loans',
        'trade_payables',
        'curr_long_term_debt',
        'short_term_provisions',
        'other_current_liabilities',
        'total_current_liabilities',
        'total_liabilities',
        

        'land_and_building',
        'plant_and_machinery',
        'capital_work_in_progress',
        'nca_others',
        'tangible_assets',
        'depreciation',
        'net_fixed_assets',
        'intangible_assets',
        'total_fixed_assets',
        'long_term_investments',
        'short_term_investments',
        'investments',

        'cash_balance',
        'receivables_less_180_related',
        'receivables_more_180_related',
        'receivables_from_related_party',
        'receivables_less_180_unrelated',
        'receivables_more_180_unrelated',
        'receivables_from_unrelated_party',
        'related_party_advances',
        'third_party_advances',
        'finished_goods',
        'wip',
        'raw_materials',
        'inventories',
        'capital_advances',
        'advances_to_suppliers',
        'mat_credit',
        'advance_tax',
        'ca_others',
        'other_current_assets',
        'total_current_assets',
        'total_assets',

        'contingent_liabilities'
    ];
}