<?php

namespace App\Http\Controllers\Insurances;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;
use App\Models\MasterData;
use App\Helpers\validLoanUrlhelper;

use Auth;
use Input;

class InsurancesController extends BaseInsurancesController
{
    public function __construct()
    {
        //This will ensure that all routes handled by this controller are first authenticated
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex($insuranceType=null, $insuranceId = null)
    {
        $businessVintage = MasterData::businessVintage();
        $insurance_product = MasterData::insuranceProductType();
        $industryTypes = MasterData::industryTypes();
        $chosenInsuranceProduct =null;
        $yesnotype = MasterData::yesNoTypes();
        $chosenYesNoType = null;
        $insurance = null;

        $existingAnotherTypeCount = 0;

        if(isset($existingAnotherTypeDetails)){
            $existingAnotherTypeCount = count($existingAnotherTypeDetails);
        }
        $maxAnotherTypes = Config::get('constants.CONST_MAX_ANOTHER_TYPES');
        $temp_array = array();
        for($i = 0; $i < 5; $i++) {
            if($i < $existingAnotherTypeCount) {
                array_push($temp_array, $existingAnotherTypeDetails[$i]->toArray());
            } else {
                array_push($temp_array,"");
            }
        }

        $user = null;
        $userProfile =  null;
        
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();

        $removeMandatory = $removeMandatoryHelper->getMandatory($user,$isRemoveMandatory);

        $setDisable = '';

        $user = Auth::user();
        if(isset($user)){
            $userID = $user->id;
            $userEmail = $user->email;
        }

        $formaction = 'Insurances\InsurancesController@postIndex';
        $subViewType = 'insurances._choose_insurance';
        return view('insurances.createedit', compact('formaction', 'subViewType','insuranceType','insuranceId','businessVintage','removeMandatory','industryTypes','yesnotype','chosenYesNoType','existingAnotherTypeCount','maxAnotherTypes','setDisable','insurance_product','chosenInsuranceProduct','insurance','userID'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function postIndex(Request $request){
        $input = Input::all();

        $insuranceId = isset($input['insuranceId']) ? $input['insuranceId'] : null;
        $insuranceProduct = isset($input['insurance_product']) ? $input['insurance_product'] :null;
        $businessType = isset($input['business_type']) ? $input['business_type'] :null;
        $noOfMfgLocations = isset($input['number_mfglocations']) ? $input['number_mfglocations'] :null;
        $industrySegment = isset($input['industry_segment']) ? $input['industry_segment'] : null;
        $businessOld = isset($input['co_business_old']) ? $input['co_business_old'] : null;
        $keyProductserviceOffered = isset($input['key_productservice_offered']) ? $input['key_productservice_offered'] : null;
        $existingPolicyYesNo = isset($input['policy_exists']) ? $input['policy_exists'] : null;
        $loan = null;
        $insurance = null;
        
        //dd($input,$insurance);

        $fieldsArr = array();
        $rulesArr = array();
        $messagesArr = array();

        // $rules = array(
        //     'business_type' => 'required',
        //     'industry_segment' => 'required',
        //     'co_business_old' => 'required|numeric',
        //     'key_productservice_offered' => 'required',
        //     'insurance_product' => 'required'
        // );

        // if (isset($existingPolicyYesNo) && $existingPolicyYesNo != null && $existingPolicyYesNo != '0') {

        //     $rules['existingPolicy'] = 'required';

        //     $counter = (int)$input['policy_counter_storage'];
            
        //     for ($i =0; $i <= $counter; $i++) {

        //         $rules['name_of_insured_comp' . $i] = 'required';
        //     }
        // }

        // $this->validate($request, $rules);

        //dd($input, $endUseList,$insuranceId, $insuranceProduct);

        if ($insuranceProduct == 'FI') {

            $redirectUrl = $this->generateRedirectURL('insurances/fire-insurance', $insuranceProduct, $insuranceId);
        
        } elseif ($insuranceProduct == 'MI') {

            $redirectUrl = $this->generateRedirectURL('insurances/marine-insurance', $insuranceProduct, $insuranceId);

        } elseif ($insuranceProduct == 'II') {

            $redirectUrl = $this->generateRedirectURL('insurances/industrial-insurance', $insuranceProduct, $insuranceId);

        } elseif ($insuranceProduct == 'SI') {

            $redirectUrl = $this->generateRedirectURL('insurances/shop-insurance', $insuranceProduct, $insuranceId);

        } elseif ($insuranceProduct == 'CI') {

            $redirectUrl = $this->generateRedirectURL('insurances/corporate-insurance', $insuranceProduct, $insuranceId);
        }

        return Redirect::to($redirectUrl);
    }

    public function getFireInsurance($insuranceType, $insuranceId = null){
        $cities = MasterData::cities();
        $states = MasterData::states();
        $assetsToBeInsured = MasterData::assetsToBeInsured();
        $inventoryTypes = MasterData::insuranceInventoryTypes();
        $existingAnotherTypeCount = 0;
        $formaction = 'Insurances\InsurancesController@postFireInsurance';
        $subViewType = 'insurances._fire_insurance';
        $bl_year = $this->setFinancialYears();

        if(isset($existingAnotherTypeDetails)){
            $existingAnotherTypeCount = count($existingAnotherTypeDetails);
        }
        $maxAnotherTypes = Config::get('constants.CONST_MAX_ANOTHER_TYPES');
        $temp_array = array();
        for($i = 0; $i < 5; $i++) {
            if($i < $existingAnotherTypeCount) {
                array_push($temp_array, $existingAnotherTypeDetails[$i]->toArray());
            } else {
                array_push($temp_array,"");
            }
        }
        return view('insurances.createedit', compact('formaction','subViewType','cities','states','assetsToBeInsured','bl_year','inventoryTypes','maxAnotherTypes','existingAnotherTypeCount','insuranceType','insuranceId'));
    }

    public function getMarineInsurance($insuranceType, $insuranceId = null)
    {
        $inlandTypes = MasterData::inlandTypes();
        $cargoTypes = MasterData::cargoTypes();
        $riskTypes = MasterData::riskTypes();
        $existingAnotherTypeCount = 0;
        $formaction = 'Insurances\InsurancesController@postMarineInsurance';
        $subViewType = 'insurances._marine_insurance';
        return view('insurances.createedit', compact('formaction','subViewType','inlandTypes','cargoTypes','riskTypes','existingAnotherTypeCount','insuranceType','insuranceId'));
    }

    public function getIndustrialInsurance($insuranceType, $insuranceId = null)
    {
        $assetsToBeInsured = MasterData::assetsToBeInsured();
        $inventoryTypes = MasterData::insuranceInventoryTypes();
        $existingAnotherTypeCount = 0;
        $formaction = 'Insurances\InsurancesController@postIndustrialInsurance';
        $subViewType = 'insurances._industrial_insurance';
        $bl_year = $this->setFinancialYears();

        if(isset($existingAnotherTypeDetails)){
            $existingAnotherTypeCount = count($existingAnotherTypeDetails);
        }
        $maxAnotherTypes = Config::get('constants.CONST_MAX_ANOTHER_TYPES');
        $temp_array = array();
        for($i = 0; $i < 5; $i++) {
            if($i < $existingAnotherTypeCount) {
                array_push($temp_array, $existingAnotherTypeDetails[$i]->toArray());
            } else {
                array_push($temp_array,"");
            }
        }
        return view('insurances.createedit', compact('formaction','subViewType','assetsToBeInsured','bl_year','inventoryTypes','maxAnotherTypes','existingAnotherTypeCount','insuranceType','insuranceId'));
    }

    public function getShopInsurance($insuranceType, $insuranceId = null)
    {
        $assetsToBeInsured = MasterData::assetsToBeInsured();
        $inventoryTypes = MasterData::insuranceInventoryTypes();
        $existingAnotherTypeCount = 0;
        $formaction = 'Insurances\InsurancesController@postShopInsurance';
        $subViewType = 'insurances._shop_insurance';
        $bl_year = $this->setFinancialYears();

        if(isset($existingAnotherTypeDetails)){
            $existingAnotherTypeCount = count($existingAnotherTypeDetails);
        }
        $maxAnotherTypes = Config::get('constants.CONST_MAX_ANOTHER_TYPES');
        $temp_array = array();
        for($i = 0; $i < 5; $i++) {
            if($i < $existingAnotherTypeCount) {
                array_push($temp_array, $existingAnotherTypeDetails[$i]->toArray());
            } else {
                array_push($temp_array,"");
            }
        }
        return view('insurances.createedit', compact('formaction','subViewType','assetsToBeInsured','bl_year','inventoryTypes','maxAnotherTypes','existingAnotherTypeCount','insuranceType','insuranceId'));
    }

    public function getCorporateInsurance($insuranceType, $insuranceId = null)
    {
        $cities = MasterData::cities();
        $states = MasterData::states();
        $assetsToBeInsured = MasterData::assetsToBeInsured();
        $inventoryTypes = MasterData::insuranceInventoryTypes();
        $existingAnotherTypeCount = 0;
        $formaction = 'Insurances\InsurancesController@postCorporateInsurance';
        $subViewType = 'insurances._corporate_insurance';
        $bl_year = $this->setFinancialYears();

        if(isset($existingAnotherTypeDetails)){
            $existingAnotherTypeCount = count($existingAnotherTypeDetails);
        }
        $maxAnotherTypes = Config::get('constants.CONST_MAX_ANOTHER_TYPES');
        $temp_array = array();
        for($i = 0; $i < 5; $i++) {
            if($i < $existingAnotherTypeCount) {
                array_push($temp_array, $existingAnotherTypeDetails[$i]->toArray());
            } else {
                array_push($temp_array,"");
            }
        }
        return view('insurances.createedit', compact('formaction','subViewType','cities','states','assetsToBeInsured','bl_year','inventoryTypes','maxAnotherTypes','existingAnotherTypeCount','insuranceType','insuranceId'));
    }


    protected function generateRedirectURL($redirectUrl, $insuranceType, $insuranceId){
       
        if(isset($insuranceType)){
            $redirectUrl = $redirectUrl . '/' . $insuranceType;
        }

        if(isset($insuranceId)){
            $redirectUrl = $redirectUrl . '/' . $insuranceId;
        }

        return $redirectUrl;
    }

    protected function getIsDisabled($user = null, $isAnalyst=false){
        if(!isset($user)) {
            $user = Auth::getUser();
        }
        if(isset($user)){
            if(!$isAnalyst && !$user->isSME()){
                return 'disabled';
            }elseif($isAnalyst && !$user->isSMENiwasEmployee()){
                return 'disabled';
            }
        }
        return '';
    }

    public function setFinancialYears(){
        
        return $this->dummyDate();

        // $currentFinancialYear = intval(date('Y'));
        // $currentMonth = intval(date('m'));
        // $currentFY = null;
        // if ($currentMonth > 3) {
        //     // FY is current - next year
        //     $currentFY = $currentFinancialYear;
        // } else {
        //     // FY is prev - current year
        //     $currentFY = $currentFinancialYear - 1;
        // }

        // // Check current date falls between provisional range
        // $currentDateTimestamp = strtotime(date('Y-m-d'));
        // $provisionalStartDate = strtotime(date('Y').'-07-01');
        // $provisionalEndDate = strtotime(date('Y').'-10-31');

        // $goTillLastYear = 3;
        // if ($currentDateTimestamp >= $provisionalStartDate && $currentDateTimestamp <= $provisionalEndDate) {
        //     // In provision
        //     $goTillLastYear = 4;
        // } else if ($currentDateTimestamp < $provisionalStartDate) {
        //     // $currentFY = $currentFY - 1;
        //     $goTillLastYear = 3;
        // } else {
        //     $goTillLastYear = 4;
        // }

        // $fin_bl_year = [];
        // $secondPart = null;
        // for($i = $currentFY, $l = $currentFY - $goTillLastYear; $i > $l; $i--) {

        //     $secondPart = str_replace('20', '', ($i));
        //     $fin_bl_year[('FY' . ($i-1) . '-' . $secondPart)] = ('FY' . ($i-1) . '-' . $secondPart);
        // }

        // return $fin_bl_year;


        ////////////////////////////////////////////////////////////
        // $bl_year = MasterData::BalanceSheet_FY();

        // $fin_bl_year = [];
        // $currentYear = date('Y');
        // $currentDateTimestamp   = strtotime(date('Y-m-d'));
        // $finStartDateTimestamp  = strtotime(date('Y').'-07-01');
        // $finEndDateTimestamp    = strtotime(date('Y').'-10-31');

        // foreach ($bl_year as $year) {

        //     $fin_year = explode('-', explode('FY', $year)[1]);

        //     if($fin_year[0] == (int)($currentYear - 1)) {

        //         if(($currentDateTimestamp >= $finStartDateTimestamp && ($currentDateTimestamp <= $finEndDateTimestamp))) {

        //             for($i=$fin_year[0]; $i > (int)($fin_year[0]-4); $i--) {

        //                 $fin_bl_year['FY'. $i . '-' . (int)(explode('20', $i)[1] + 1)] = 'FY'. $i . '-' . (int)(explode('20', $i)[1] + 1);
        //             }

                    
        //         } else if(($currentDateTimestamp >= $finEndDateTimestamp)) {

        //             for($i=$fin_year[0]; $i > (int)($fin_year[0]-3); $i--) {

        //                 $fin_bl_year['FY'. $i . '-' . (int)(explode('20', $i)[1] + 1)] = 'FY'. $i . '-' . (int)(explode('20', $i)[1] + 1);
        //             }

        //         } else {
        //             for($i=(int)($fin_year[0]-1); $i > (int)($fin_year[0]-4); $i--) {

        //                 $fin_bl_year['FY'. $i . '-' . (int)(explode('20', $i)[1] + 1)] = 'FY'. $i . '-' . (int)(explode('20', $i)[1] + 1);
        //             }
        //         }
        //     }
        // }
        // return $fin_bl_year;
    }

    public function dummyDate(){

        $currentFinancialYear = 2016;
        $currentMonth = 1;
        $currentFY = null;
        if ($currentMonth > 6) {
            // FY is current - next year
            $currentFY = $currentFinancialYear;
        } else {
            // FY is prev - current year
            $currentFY = $currentFinancialYear - 1;
        }

        // Check current date falls between provisional range
        $currentDateTimestamp = strtotime($currentFinancialYear . '-' . $currentMonth . '-11');
        $provisionalStartDate = strtotime($currentFinancialYear.'-07-01');
        $provisionalEndDate = strtotime($currentFinancialYear.'-10-31');

        $goTillLastYear = 3;
        if ($currentDateTimestamp >= $provisionalStartDate && $currentDateTimestamp <= $provisionalEndDate) {
            // In provision
            $goTillLastYear = 4;
        } else if ($currentDateTimestamp > $provisionalStartDate) {
            // $currentFY = $currentFY - 1;
            $goTillLastYear = 3;
        } else {
            $goTillLastYear = 3;
        }

        $fin_bl_year = [];
        $secondPart = null;
        for($i = $currentFY, $l = $currentFY - $goTillLastYear; $i > $l; $i--) {

            $firstPart = ($i-1);
            $secondPart = str_replace('20', '', ($i));
            $value = 'FY' . $firstPart . '-' . $secondPart;
            
            if($currentMonth <= 10) {

                if(str_replace('20', '', $currentFinancialYear) == str_replace('20', '', ($i))){

                    $value .= '(Provisional)';
                }
            }

            
            $fin_bl_year[('FY' . $firstPart . '-' . $secondPart)] = ($value);
        }

        return $fin_bl_year;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
