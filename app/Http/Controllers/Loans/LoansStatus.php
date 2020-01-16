<?php
namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;

class LoansStatus extends Model {
    public $table = "loans_status";

    protected $fillable = [
        'loan_id',
        'background',
        'promoter_details',
        'financials',
        'business_details',
        'security_details',
        'upload_documents',
        'input_blsheet',
        'input_p&l',
        'cashflow',
        'calculated_ratios',
        'credit_model',
        'liquidity_model',
        'collateral_model',
        'niwas_query_status',
        'rejected',
        'sentApprovar',
        'remark',
        'praposalApproved'

    ];
}