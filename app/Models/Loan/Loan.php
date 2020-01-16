<?php namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Loan extends Model {
    protected $fillable = [
        'user_id',
        'referredby_userid',
        'loan_disable',
        'type',
        'loan_amount', //enduse
        'loan_tenure',  //
        'companySharePledged',
        'bscNscCode',
        'turnover',
        'end_use',
        'status',
        'com_business_type',
        'gst',
        'com_cin_no',
        'com_vat',
        'com_service_tax_no',
        'com_industry_segment',
        'com_number_mfglocations',
        'com_number_officebranch',
        'com_co_business_old',
        'com_venture_capital_funded',
        'com_name_of_vc_fund',
        'com_geographical_areasales',
        'com_your_salestype',
        'com_annual_value_exports',
        'com_your_salestoa',
        'com_areyou_distributor',
        'com_areyou_companyname',
        'com_areyou_productname',
        'com_key_productservice_offered',
        'fin_grossfixedassets',
        'fin_grossvalueofplant',
        'fin_numofexistingloan',
        'fin_doyouknowcibil',
        'fin_cibilscore',
        'other_outstandingamount',
        'other_totalmonthlyemi'
    ];

//    public function getLoan(){
//        return $this->hasMany('App\Models\Loan\Loan','user_id','id');
//    }

    public function getUser(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function getUserProfile(){
        return $this->belongsTo('App\Models\UserProfile','user_id','user_id');
    }
       public function getPraposalBackground(){
        return $this->hasOne('App\Models\Loan\PraposalBackground','loan_id', 'id');
    }   

    public function getChecklist(){
        return $this->hasOne('App\Models\Loan\LoanAdminChecklists','loan_id','id');
    }

      public function getPraposalDetails(){
        return $this->hasOne('App\Models\Loan\PraposalDetails','loan_id', 'id');
    }

    public function getSalesAreaDetails(){
        return $this->hasOne('App\Models\Loan\SalesAreaDetails','loan_id', 'id');
    }

    public function getPromoterDetails(){
        return $this->hasOne('App\Models\Loan\PromoterDetails','loan_id', 'id');
    }

    public function getPromoterKycDetails(){
        return $this->hasMany('App\Models\Loan\PromoterKycDetails','loan_id', 'id');
    }

    public function getPromoterPropertyDetails(){
        return $this->hasMany('App\Models\Loan\PromoterPropertyDetail','loan_id', 'id');
    }

    public function getBalanceSheetDetails(){
        return $this->hasMany('App\Models\Loan\BalanceSheetDetail','loan_id', 'id');
    }

    public function getProfitLossDetails(){
        return $this->hasMany('App\Models\Loan\ProfitLossDetail','loan_id', 'id');
    }

    public function getExistingLoanDetails(){
        return $this->hasMany('App\Models\Loan\ExistingLoanDetail','loan_id', 'id');
    }

    public function getBusinessOperationalDetails(){
        return $this->hasOne('App\Models\Loan\BusinessOperationalDetail','loan_id', 'id');
    }
    public function getLoanAgainstShare(){
        return $this->hasOne('App\Models\Loan\LoanAgainstShare','loan_id', 'id');
    }

    public function getSecurityDetails(){
        return $this->hasOne('App\Models\Loan\SecurityDetail','loan_id', 'id');
    }

    public function getCompetitorDetails(){
        return $this->hasOne('App\Models\Loan\CompetitorDetail','loan_id', 'id');
    }

    public function getBuyerDetails(){
        return $this->hasOne('App\Models\Loan\BuyerDetail','loan_id', 'id');
    }

    public function getUploads(){
        return $this->hasOne('App\Models\Loan\Upload','loan_id', 'id');
    }
    public function getUploadSecurityDetails(){
        return $this->hasOne('App\Models\Loan\UploadsSecurityDetails','loan_id', 'id');
    }

    public function getAnalystBalanceSheetDetails(){
        return $this->hasMany('App\Models\Loan\FinancialData\BalanceSheet','loan_id', 'id');
    }


    public function getBankAllocationDetails($bankId = null){
        if(!isset($bankId)) {
            return $this->hasMany('App\Models\Loan\Bankallocation\LoansBankAllocation', 'loan_id', 'id');
        }else{
            $bankAllocations = $this->hasMany('App\Models\Loan\Bankallocation\LoansBankAllocation', 'loan_id', 'id')->get();
            foreach($bankAllocations as $bankAllocation){
                if($bankAllocation->bank_id == $bankId){
                    return $bankAllocation;
                }
            }
            return null;
        }
    }
}