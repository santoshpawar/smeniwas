<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class
MasterData extends Model {
    public $table = "master_data";

    protected $fillable = [
        'type',
        'name',
        'value',
        'sortorder',
        'status'
    ];

    public static function entityTypes(){
        return MasterData::fetchMasterData(Config::get('constants.MD_ENTITY_TYPE'));
    } 
    public static function natureOfBusinessActivity(){
        return MasterData::fetchMasterData(Config::get('constants.MD_NATURE_OF_BUSINESS_ACTIVITY'));
    }

    public static function businessNatures(){
        return MasterData::fetchMasterData(Config::get('constants.MD_BUSINESS_NATURE'));
    }

    public static function industryTypes($addEmptyFirstElement = true){
        return MasterData::fetchMasterData(Config::get('constants.MD_INDUSTRY_TYPE'), $addEmptyFirstElement);
    }

    public static function purposeOfLoan(){
        return MasterData::fetchMasterData(Config::get('constants.MD_PURPOSE_OF_LOAN'));
    }

    public static function states(){
        return MasterData::fetchMasterData(Config::get('constants.MD_STATE'));
    }
    public static function cities(){
        return MasterData::fetchMasterData(Config::get('constants.MD_CITY'));
    }

    public static function removeMandatory(){
        return MasterData::fetchMasterData(Config::get('constants.MD_REMOVE_MANDATORY'));
    }

    public static function companyPositionTypes(){
        return MasterData::fetchMasterData(Config::get('constants.MD_COMPANY_POSITION_TYPE'), false);
    }

    public static function productTypes(){
        return MasterData::fetchMasterData(Config::get('constants.MD_PRODUCTS_TYPE'));
    }
    public static function propertyTypes(){
        return MasterData::fetchMasterData(Config::get('constants.MD_PROPERTY_TYPE'));
    } 

    public static function propertyLands(){
        return MasterData::fetchMasterData(Config::get('constants.MD_PROPERTY_LAND'));
    }

    public static function craditRatings(){
        return MasterData::fetchMasterData(Config::get('constants.MD_CRADIT_RATINGS'));
    }
    public static function ratingAgencies(){
        return MasterData::fetchMasterData(Config::get('constants.MD_RATING_AGENCY'));
    }
    public static function commercialTypes(){
        return MasterData::fetchMasterData(Config::get('constants.MD_COMMERCIAL_TYPE'));
    }
    public static function residentialTypes(){
        return MasterData::fetchMasterData(Config::get('constants.MD_RESIDENTIAL_TYPE'));
    }
    public static function landTypes(){
        return MasterData::fetchMasterData(Config::get('constants.MD_LAND_TYPE'));
    }

    public static function lenderTypes(){
        return MasterData::fetchMasterData(Config::get('constants.MD_LENDER_TYPE'));
    }

    public static function relationWithApplicantTypes(){
        return MasterData::fetchMasterData(Config::get('constants.MD_RELATION_WITH_APPLICANT_TYPE'));
    }

    public static function addressProofTypes(){
        return MasterData::fetchMasterData(Config::get('constants.MD_ADDRESS_PROOF_TYPE'));

    }
    public static function tenureYearList(){
        return MasterData::fetchMasterData(Config::get('constants.MD_TENURE_YEAR'));

    }
    public static function promoterGenrationType(){
        return MasterData::fetchMasterData(Config::get('constants.MD_PROMOTER_GENERATION_TYPE'), false);

    }
    public static function promoterBackground(){
        return MasterData::fetchMasterData(Config::get('constants.MD_PROMOTER_BACKGROUND'), false);

    }
    public static function sales(){
        return MasterData::fetchMasterData(Config::get('constants.MD_SALES'), false);

    }
    public static function ownerTypeList(){
        return MasterData::fetchMasterData(Config::get('constants.MD_OWNER_TYPE_LIST'));

    }
    public static function loanType(){
        return MasterData::fetchMasterData(Config::get('constants.MD_LOAN_TYPE'), false);
    }
    public static function BalanceSheet_FY(){
        return MasterData::fetchMasterData(Config::get('constants.MD_BALANCE_SHEET_FY'), false);
    }

    public static function maxFY(){
        $maxYear = null;
        $yearsArray = MasterData::fetchMasterData(Config::get('constants.MD_BALANCE_SHEET_FY'), false);
        if(isset($yearsArray)){
            $maxYear = max(array_keys($yearsArray));
        }

        return $maxYear;
    }


    public static function userType(){
        return MasterData::fetchMasterData(Config::get('constants.MD_END_USER_TYPE'), false);
    }

    public static function familyType(){
        return MasterData::fetchMasterData(Config::get('constants.MD_NO_OF_FAMILIES'), false);
    }

    public static function attributeStatus(){
        return MasterData::fetchMasterData(Config::get('constants.MD_ATTRIBUTE_STATUS'), false);
    }

    public static function purchasedEquipmentTypes(){
        return MasterData::fetchMasterData(Config::get('constants.MD_PURCHASED_EQUIPMENT_TYPE'), false);
    } 
    public static function typeOfInventory(){
        return MasterData::fetchMasterData(Config::get('constants.MD_TYPE_OF_INVENTORY'), false);
    }
     public static function natureOfInventory(){
        return MasterData::fetchMasterData(Config::get('constants.MD_NATURE_OF_INVENTORY'), false);
    }

    public static function yesNoTypes($addEmptyFirstElement = true){
        return MasterData::fetchMasterData(Config::get('constants.MD_YES_NO_TYPE'), $addEmptyFirstElement);
    }

    public static function expressionTypes(){
        return MasterData::fetchMasterData(Config::get('constants.MD_EXPRESSION_TYPE'), true);
    }

    public static function degreeTypes(){
        return MasterData::fetchMasterData(Config::get('constants.MD_DEGREE_TYPE'), true);
    }

    public static function loanProductType(){
        return MasterData::fetchMasterData(Config::get('constants.MD_LOAN_PRODUCT_TYPE'));
    }

    public static function wizardUserType(){
        return MasterData::fetchMasterData(Config::get('constants.MD_WIZARD_USER_TYPE'), true);
    }

    public static function maxBankStatement(){
        return Config::get('constants.MD_MAX_BANK_STATEMENT');
    }

    public static function documentTypes(){
        return MasterData::fetchMasterData(Config::get('constants.MD_DOCUMENT_TYPE'), false);
    }

    public static function otherSecurityTypes(){
        return MasterData::fetchMasterData(Config::get('constants.MD_OTHER_SECURITY_TYPE'), false);
    }

    public static function propertyOwnerTypes()
    {
        return MasterData::fetchMasterData(Config::get('constants.MD_PROPERTY_OWNER_TYPE'), false);
    } 
    public static function propertyPropertyIs()
    {
        return MasterData::fetchMasterData(Config::get('constants.MD_PROPERTY_PROPERTY_IS'), false);
    }

    public static function endUseList($addEmptyFirstElement = true){
        return MasterData::fetchMasterData(Config::get('constants.MD_END_USE_LIST'), $addEmptyFirstElement);
    }
    public static function paymentTermsType($addEmptyFirstElement = true){
        return MasterData::fetchMasterData(Config::get('constants.MD_PAYMENT_TERMS_TYPE'), $addEmptyFirstElement);
    }

    public static function collateralDefectTypes(){
        return MasterData::fetchFullMasterData(Config::get('constants.MD_COLLATERAL_DEFECT_TYPE'));
    }

    public static function termsAndCondition(){
        return MasterData::fetchFullMasterData(Config::get('constants.MD_TERMS_AND_CONDITION'));
    }

    public static function businessVintage(){
        return MasterData::fetchMasterData(Config::get('constants.MD_BUSINESS_VINTAGE'));
    }

    public static function creditRatingPoints(){
        return MasterData::fetchMasterData(Config::get('constants.MD_CREDIT_RATING_POINTS'), FALSE);
    }
    public static function liquidityRatingPoints(){
        return MasterData::fetchMasterData(Config::get('constants.MD_LIQUIDITY_RATING_POINTS'), FALSE);
    }

    public static function insuranceProductType(){
        return MasterData::fetchMasterData(Config::get('constants.MD_INSURANCE_PRODUCT_TYPE'));
    }

    public static function assetsToBeInsured(){
        return MasterData::fetchMasterData(Config::get('constants.MD_INSURANCE_ASSETS_TO_BE_ISURED'));
    }

    public static function insuranceInventoryTypes(){
        return MasterData::fetchMasterData(Config::get('constants.MD_INSURANCE_INVENTORY_TYPES'));
    }

    public static function inlandTypes(){
        return MasterData::fetchMasterData(Config::get('constants.MD_INSURANCE_MARINE_INLAND_TYPE'));
    }

    public static function cargoTypes(){
        return MasterData::fetchMasterData(Config::get('constants.MD_INSURANCE_MARINE_CARGO_TYPE'));
    }

    public static function riskTypes(){
        return MasterData::fetchMasterData(Config::get('constants.MD_INSURANCE_MARINE_RISK_TYPE'));
    }

    private static function fetchFullMasterData($keyName){
        $cacheTimeout = Config::get('constants.MD_CACHE_TIMEOUT');
        $masterData = null;
        Cache::forget($keyName);

        if(Cache::has($keyName)){
            $masterData = Cache::get($keyName);
        }else{
            $masterData = MasterData::orderBy('sortorder')->where('type', "=", $keyName)->get();
            Cache::put($keyName, $masterData, $cacheTimeout);
        }
        return $masterData;
    }

    private static function fetchMasterData($keyName, $addEmptyFirstElement=true){
        $cacheTimeout = Config::get('constants.MD_CACHE_TIMEOUT');
        $masterData = null;
        Cache::forget($keyName);

        if(Cache::has($keyName)){
            $masterData = Cache::get($keyName);
        }else{
            $masterData = MasterData::orderBy('sortorder')->where('type', "=", $keyName)->lists('name','value')->all();
            if($addEmptyFirstElement) {
                $masterData = array(NULL => '') + $masterData;
            }
            Cache::put($keyName, $masterData, $cacheTimeout);
        }
        return $masterData;
    }
}