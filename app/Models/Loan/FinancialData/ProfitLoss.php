<?php

namespace App\Models\Loan\FinancialData;

use Illuminate\Database\Eloquent\Model;

class ProfitLoss extends Model {

    public $table = "financials_profit_loss";

    protected $fillable = [
        'loan_id',
        'period',
        'net_sales',
        'oth_op_income',
        'net_revenue',
        'raw_materials_cost',
        'gross_profit',
        'salary_cost',
        'manuf_cost',
        'advertising_cost',
        'repairs',
        'legal_charges',
        'admin_costs',
        'ebitda',
        'other_income',
        'depreciation_cost',
        'finance_cost',
        'pbt',
        'current_tax',
        'deffered_tax',
        'tax',
        'pat'
    ];
}