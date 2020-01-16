<?php namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class MobileAppData extends Model {

    public $table = "mobile_app_data";

    protected $fillable = [
        'Firm_Name',
        'EntityType',
        'BusinessType',
        'KeyProduct',
        'AuditedTurnover',
        'FirmPan',
        'FirmRegNo',
        'OwnerName',
        'Email',
        'Address',
        'City',
        'State',
        'Pincode',
        'Contact',
        'CibilScore',
        'LenderName',
        'OutstandingAmt',
        'MonthlyEmi',
        'Liability',
        'Degree',
        'PromoType',
        'Independent',
        'OwnedVehicle',
        'MarketValue',
        'OwnedProperty',
        'CustomerNature',
        'OfficePremiseOwned',
        'OfficePremiseRented',
        'ManufacturePremise',
        'BankName',
        'Amount',
        'cust1',
        'sale1',
        'year1',
        'cust2',
        'sale2',
        'year2',
        'cust3',
        'sale3',
        'year3',
        'CashSales',
        'LoanPurpose',
        'ReqAmt',
        'PropType',
        'ColAddress',
        'ColCity',
        'ColPincode',
        'LatestVal',
        'CollateralType',
        'status'
    ];

    public function getUser(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function getUserProfile(){
        return $this->belongsTo('App\Models\UserProfile','user_id','user_id');
    }


}