<?php namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;

class BuyerDetail extends Model {
    public $table = "loans_buyer_details";

    protected $fillable = [
        'loan_id',
        'buyer_serial_num',
        'buyer_name',
        'avg_monthly_sale',
        'invoice_date_1',
        'amount_1',
        'payment_terms_1',
        'invoice_date_2',
        'amount_2',
        'payment_terms_2',
        'invoice_date_3',
        'amount_3',
        'payment_terms_3',
        'invoice_date_4',
        'amount_4',
        'payment_terms_4',
        'invoice_date_5',
        'amount_5',
        'payment_terms_5'
    ];

    public function getLoan(){
        return $this->belongsTo('App\Models\Loan\Loan','loan_id','id');
    }

}