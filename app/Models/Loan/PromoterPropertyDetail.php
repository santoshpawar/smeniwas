<?php namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;

class PromoterPropertyDetail extends Model {

    public $table = "loans_promoter_property_details";

    protected $fillable = [
        'loan_id',
        'property_type',
        'market_value',
        'location_city',
        'other_city_name',
        'is_mortgage'
    ];

    public function getLoan(){
        return $this->belongsTo('App\Models\Loan\Loan','loan_id','id');
    }
}