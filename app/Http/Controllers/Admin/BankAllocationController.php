<?php

namespace App\Http\Controllers\Admin;

use App\Models\BankMasterData;
use App\Models\Loan\Bankallocation\BankAllocationProfile;
use App\Models\Loan\Bankallocation\BankAllocationCategory;
use App\Models\Loan\Bankallocation\BankAllocationDimension;
use App\Models\Loan\Bankallocation\BankAllocationSubDimension;
use App\Models\MasterData;
use Illuminate\Http\Request;
use Input;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Helpers\validLoanUrlhelper;
use Auth;



class BankAllocationController extends BaseAdminController {

    public function __construct() {
        //This will ensure that all routes handled by this controller are first authenticated
        $this->middleware('auth');
    }

    /**
     * Display a listing of master data in grid format.
     *
     * @return Response
     */
    public function getIndex(){
        $bankProfileData = BankAllocationProfile::all();
        $attributeBank = array(NULL => '') + BankMasterData::lists('name','id')->all();

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);

        $formaction = 'Admin\BankAllocationController@postCopyProfile';
          $sideTab = 'bankAlloData';
        return view('admin.bankallocation.index',compact('sideTab','bankProfileData','formaction','attributeBank','removeMandatory'));
    }

    /**
     * Display a listing of bank allocation category in grid format.
     *
     * @return Response
     */
    public function getCategory($bankId){
        $bankDetails = BankAllocationProfile::find($bankId);
        $categories = BankAllocationCategory::where('profile_id','=',$bankId)->orderBy('sortorder', 'asc')->get();
          $sideTab = 'bankAlloData';
        return view('admin.bankallocation.category', compact('sideTab','bankId','categories','bankDetails'));
    }

    public function getDimension($categoryId,$bankId){
        $bankDetails = BankAllocationProfile::find($bankId);
        $dimensions = BankAllocationDimension::where('category_id','=',$categoryId)->orderBy('sortorder', 'asc')->get();
        //dd($categoryId,$bankId,$dimensions);

          $sideTab = 'bankAlloData';
        return view('admin.bankallocation.dimension', compact('sideTab','categoryId','bankId','dimensions','bankDetails'));
    }

    public function getSubDimension($dimensionId,$categoryId,$bankId){
        $bankDetails = BankAllocationProfile::find($bankId);
        $subDimensions = BankAllocationSubDimension::where('dimension_id','=',$dimensionId)->get();
          $sideTab = 'bankAlloData';
        return view('admin.bankallocation.subdimension', compact('sideTab','dimensionId','categoryId','bankId','subDimensions','bankDetails'));
    }

    public function getEdit($id)
    {
        $bankProfileData = BankAllocationProfile::find($id);
        $attributeStatus = MasterData::attributeStatus();
        $chosenStatus = $bankProfileData->status;
        $attributeBank = array(NULL => '') + BankMasterData::lists('name','id')->all();
        $chosenBank = $bankProfileData->bank_id;

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);

        $formaction = 'Admin\BankAllocationController@postEdit';
        $setDisable = 'disabled';
          $sideTab = 'bankAlloData';
        return view('admin.bankallocation.createedit',compact('sideTab','bankProfileData','formaction', 'attributeStatus', 'chosenStatus','attributeBank','chosenBank','setDisable','removeMandatory'));
    }

    public function getEditCategory($id,$bankId)
    {
        $bankCategoryData = BankAllocationCategory::find($id);
        $attributeStatus = MasterData::attributeStatus();
        $chosenStatus = $bankCategoryData->status;
        $setDisable = 'disabled';

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);

        $formaction = 'Admin\BankAllocationController@postEditCategory';
          $sideTab = 'bankAlloData';
        return view('admin.bankallocation.createeditcategory',compact('sideTab','bankCategoryData','bankId','formaction', 'attributeStatus', 'chosenStatus','setDisable','removeMandatory'));
    }

    function getCreateDimension($categoryId ,$bankId){
        //dd($categoryId,$bankId);
        $bankDimensionData = null;
        $chosenOperand = null;
        $bankCategoryData = BankAllocationCategory::find($categoryId);
        $categoryName = $bankCategoryData->name;
        $attributeStatus = MasterData::attributeStatus();
        $chosenStatus = $bankCategoryData->status;
        $setDisable = 'disabled';

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);

        $attributeOperand = array(NULL => '') + array('IN' => 'IN', 'NOTIN' => 'NOT IN', '=' => '=', '!=' => '!=', '<' => '<', '<=' => '<=', '>' => '>', '>=' => '>=', 'between' => 'Between');

        $formaction = 'Admin\BankAllocationController@postEditDimension';
          $sideTab = 'bankAlloData';
        return view('admin.bankallocation.createeditdimension',compact('sideTab','bankDimensionData','id','categoryId','categoryName','bankId','formaction', 'attributeStatus', 'chosenStatus','setDisable','attributeOperand','chosenOperand','removeMandatory'));
    }

    public function getEditDimension($id,$categoryId,$bankId)
    {
        //dd($id,$categoryId,$bankId);
        $bankCategoryData = BankAllocationCategory::find($categoryId);
        $categoryName = $bankCategoryData->name;
        $bankDimensionData = BankAllocationDimension::find($id);
        //dd($bankDimensionData);
        $attributeStatus = MasterData::attributeStatus();
        $chosenStatus = $bankDimensionData->status;
        $setDisable = 'disabled';
        if( $bankDimensionData->model == 'user_profiles' && $bankDimensionData->attribute == 'owner_entity_type' ||
            $bankDimensionData->model == 'loans' && $bankDimensionData->attribute == 'com_industry_segment' ||
            $bankDimensionData->model == 'loans' && $bankDimensionData->attribute == 'com_co_business_old' ||
            $bankDimensionData->model == 'user_profiles' && $bankDimensionData->attribute == 'owner_state' ||
            $bankDimensionData->model == 'user_profiles' && $bankDimensionData->attribute == 'owner_city' ||
            $bankDimensionData->model == 'loans' && $bankDimensionData->attribute == 'type' ||
            $bankDimensionData->model == 'loans_security_details' && $bankDimensionData->attribute == 'collateral_type' ||
            $bankDimensionData->model == 'loans_security_details' && $bankDimensionData->attribute == 'city' )
        {
            $attributeOperand = array(NULL => '') + array('IN' => 'IN', 'NOTIN' => 'NOT IN');
//            $attributeOperand = array(NULL => '') + array('=' => '=', '!=' => '!=', '<' => '<', '<=' => '<=', '>' => '>', '>=' => '>=', 'between' => 'Between', 'IN' => 'IN', 'NOTIN' => 'NOT IN');
        }
        else
        {
            $attributeOperand = array(NULL => '') + array('=' => '=', '!=' => '!=', '<' => '<', '<=' => '<=', '>' => '>', '>=' => '>=', 'between' => 'Between');
        }
        $chosenOperand = null;

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);

        $formaction = 'Admin\BankAllocationController@postEditDimension';
          $sideTab = 'bankAlloData';
        return view('admin.bankallocation.createeditdimension',compact('sideTab','bankDimensionData','id','categoryId','categoryName','bankId','formaction', 'attributeStatus', 'chosenStatus','setDisable','attributeOperand','chosenOperand','removeMandatory'));
    }

    public function getValues()
    {
        $id = Input::get('dimension_id');
        $subDimensionData = BankAllocationDimension::find($id);

        if($subDimensionData->model == 'user_profiles' && $subDimensionData->attribute == 'owner_entity_type')
        {
            $sub_lists = MasterData::where('type','=','ENTITY_TYPE')->lists('name', 'value');
        }
        elseif($subDimensionData->model == 'loans' && $subDimensionData->attribute == 'com_industry_segment')
        {
            $sub_lists = MasterData::where('type','=','INDUSTRY_TYPE')->lists('name', 'value');
        }
        elseif($subDimensionData->model == 'loans' && $subDimensionData->attribute == 'com_co_business_old')
        {
            $sub_lists = MasterData::where('type','=','BUSINESS_VINTAGE')->lists('name', 'value');
        }
        elseif($subDimensionData->model == 'user_profiles' && $subDimensionData->attribute == 'owner_city')
        {
            $sub_lists = MasterData::where('type','=','CITY')->lists('name', 'value');
        }
        elseif($subDimensionData->model == 'loans' && $subDimensionData->attribute == 'type')
        {
            $sub_lists = MasterData::where('type','=','LOAN_PRODUCT_TYPE')->lists('name', 'value');
        }
        elseif($subDimensionData->model == 'loans_security_details' && $subDimensionData->attribute == 'collateral_type')
        {
            $sub_lists = MasterData::where('type','=','PROPERTY_TYPE')->lists('name', 'value');
        }
        elseif($subDimensionData->model == 'loans_security_details' && $subDimensionData->attribute == 'city')
        {
            $sub_lists = MasterData::where('type','=','CITY')->lists('name', 'value');
        }
        else
        {
            $sub_lists = array();
        }
        return $sub_lists;
    }

    public function getEditSubDimension($id,$dimensionId,$categoryId,$bankId)
    {
        $bankDetails = BankAllocationProfile::find($bankId);
        $subDimensionData = BankAllocationSubDimension::find($id);

        $dimensionData = BankAllocationDimension::find($dimensionId);

        if($dimensionData->model == 'user_profiles' && $dimensionData->attribute == 'owner_entity_type')
        {
            $sub_lists = MasterData::where('type','=','ENTITY_TYPE')->lists('name', 'value')->toArray();
            $attributeValue = array(NULL => '') + $sub_lists;
        }
        elseif($dimensionData->model == 'loans' && $dimensionData->attribute == 'com_industry_segment')
        {
            $sub_lists = MasterData::where('type','=','INDUSTRY_TYPE')->lists('name', 'value')->toArray();
            $attributeValue = array(NULL => '') + $sub_lists;
        }
        elseif($dimensionData->model == 'loans' && $dimensionData->attribute == 'com_co_business_old')
        {
            $sub_lists = MasterData::where('type','=','BUSINESS_VINTAGE')->lists('name', 'value')->toArray();
            $attributeValue = array(NULL => '') + $sub_lists;
        }
        elseif($dimensionData->model == 'user_profiles' && $dimensionData->attribute == 'owner_city')
        {
            $sub_lists = MasterData::where('type','=','CITY')->lists('name', 'value')->toArray();
            $attributeValue = array(NULL => '') + $sub_lists;
        }
        elseif($dimensionData->model == 'loans' && $dimensionData->attribute == 'type')
        {
            $sub_lists = MasterData::where('type','=','LOAN_PRODUCT_TYPE')->lists('name', 'value')->toArray();
            $attributeValue = array(NULL => '') + $sub_lists;
        }
        elseif($dimensionData->model == 'loans_security_details' && $dimensionData->attribute == 'collateral_type')
        {
            $sub_lists = MasterData::where('type','=','PROPERTY_TYPE')->lists('name', 'value')->toArray();
            $attributeValue = array(NULL => '') + $sub_lists;
        }
        elseif($dimensionData->model == 'loans_security_details' && $dimensionData->attribute == 'city')
        {
            $sub_lists = MasterData::where('type','=','CITY')->lists('name', 'value')->toArray();
            $attributeValue = array(NULL => '') + $sub_lists;
        }
        else
        {
            $attributeValue = array();
        }

        $attributeStatus = MasterData::attributeStatus();
        $chosenStatus = $subDimensionData->status;
        $attributeDimension = array(NULL => '') + BankAllocationDimension:: where(function ($query) {
                $query->where('model', '=', 'user_profiles')->where('attribute', '=', 'owner_entity_type')->
                orWhere('model', '=', 'loans')->where('attribute', '=', 'com_industry_segment')->
                orWhere('model', '=', 'loans')->where('attribute', '=', 'com_co_business_old')->
                orWhere('model', '=', 'user_profiles')->where('attribute', '=', 'owner_city')->
                orWhere('model', '=', 'loans')->where('attribute', '=', 'type')->
                orWhere('model', '=', 'loans_security_details')->where('attribute', '=', 'collateral_type')->
                orWhere('model', '=', 'loans_security_details')->where('attribute', '=', 'city');
            })->where('status','=','1')->lists('name','id')->all();

//        $attributeDimension = array(NULL => '') + BankAllocationDimension:: where(function ($query) {
//                $query->where('operand', '=', 'IN')->orWhere('operand', '=', 'NOTIN');
//            })->where('status','=','1')->lists('name','id')->all();

        $chosenDimension = null;
        $chosenValue = $subDimensionData->value;

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);

        $formaction = 'Admin\BankAllocationController@postEditSubDimension';
          $sideTab = 'bankAlloData';
        return view('admin.bankallocation.createeditsubdimension',compact('sideTab','subDimensionData','id','dimensionId','categoryId','bankId','formaction', 'attributeStatus', 'chosenStatus','attributeDimension','chosenDimension','attributeValue','chosenValue','removeMandatory','bankDetails'));
    }

    public function getCreateSubDimension($dimensionId,$categoryId,$bankId)
    {
        $subDimensionData = null;
        $bankDetails = BankAllocationProfile::find($bankId);
        $dimensionData = BankAllocationDimension::find($dimensionId);

        //dd($dimensionData);

        if($dimensionData->model == 'user_profiles' && $dimensionData->attribute == 'owner_entity_type')
        {
            $sub_lists = MasterData::where('type','=','ENTITY_TYPE')->lists('name', 'value')->toArray();
            $attributeValue = array(NULL => '') + $sub_lists;
        }
        elseif($dimensionData->model == 'loans' && $dimensionData->attribute == 'com_industry_segment')
        {
            $sub_lists = MasterData::where('type','=','INDUSTRY_TYPE')->lists('name', 'value')->toArray();
            $attributeValue = array(NULL => '') + $sub_lists;
        }
        elseif($dimensionData->model == 'loans' && $dimensionData->attribute == 'com_co_business_old')
        {
            $sub_lists = MasterData::where('type','=','BUSINESS_VINTAGE')->lists('name', 'value')->toArray();
            $attributeValue = array(NULL => '') + $sub_lists;
        }
        elseif($dimensionData->model == 'user_profiles' && $dimensionData->attribute == 'owner_state')
        {
            $sub_lists = MasterData::where('type','=','STATE')->lists('name', 'value')->toArray();
            $attributeValue = array(NULL => '') + $sub_lists;
        }
        elseif($dimensionData->model == 'user_profiles' && $dimensionData->attribute == 'owner_city')
        {
            $sub_lists = MasterData::where('type','=','CITY')->lists('name', 'value')->toArray();
            $attributeValue = array(NULL => '') + $sub_lists;
        }
        elseif($dimensionData->model == 'loans' && $dimensionData->attribute == 'type')
        {
            $sub_lists = MasterData::where('type','=','LOAN_PRODUCT_TYPE')->lists('name', 'value')->toArray();
            $attributeValue = array(NULL => '') + $sub_lists;
        }
        elseif($dimensionData->model == 'loans_security_details' && $dimensionData->attribute == 'collateral_type')
        {
            $sub_lists = MasterData::where('type','=','PROPERTY_TYPE')->lists('name', 'value')->toArray();
            $attributeValue = array(NULL => '') + $sub_lists;
        }
        elseif($dimensionData->model == 'loans_security_details' && $dimensionData->attribute == 'city')
        {
            $sub_lists = MasterData::where('type','=','CITY')->lists('name', 'value')->toArray();
            $attributeValue = array(NULL => '') + $sub_lists;
        }
        else
        {
            $attributeValue = array();
        }

        //dd($attributeValue);

        $attributeStatus = MasterData::attributeStatus();
        $chosenStatus = null;
        $attributeDimension = array(NULL => '') + BankAllocationDimension:: where(function ($query) {
                $query->where('model', '=', 'user_profiles')->where('attribute', '=', 'owner_entity_type')->
                orWhere('model', '=', 'loans')->where('attribute', '=', 'com_industry_segment')->
                orWhere('model', '=', 'loans')->where('attribute', '=', 'com_co_business_old')->
                orWhere('model', '=', 'user_profiles')->where('attribute', '=', 'owner_state')->
                orWhere('model', '=', 'user_profiles')->where('attribute', '=', 'owner_city')->
                orWhere('model', '=', 'loans')->where('attribute', '=', 'type')->
                orWhere('model', '=', 'loans_security_details')->where('attribute', '=', 'collateral_type')->
                orWhere('model', '=', 'loans_security_details')->where('attribute', '=', 'city');
        })->where('status','=','1')->lists('name','id')->all();

//        $attributeDimension = array(NULL => '') + BankAllocationDimension:: where(function ($query) {
//                $query->where('operand', '=', 'IN')->orWhere('operand', '=', 'NOTIN');
//            })->where('status','=','1')->lists('name','id')->all();

        $chosenDimension = null;
        $chosenValue = null;

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);

        $formaction = 'Admin\BankAllocationController@postEditSubDimension';
          $sideTab = 'bankAlloData';
        return view('admin.bankallocation.createeditsubdimension',compact('sideTab','subDimensionData','dimensionId','categoryId','bankId','formaction', 'attributeStatus', 'chosenStatus','attributeDimension','chosenDimension','attributeValue','chosenValue','removeMandatory','bankDetails'));
    }

    public function postCopyProfile(Request $request){
        $input = Input::all();
//        dd($input);
        $id = $input['id'];
        $data = null;
        if(isset($id)) {
            $data = BankAllocationProfile::find($id);
        }
        $rules = array(
            'bank_id' => 'required|unique:conf_bank_allocation_profile,bank_id,'.$id,
            'name' => 'required',
            'description' => 'required',
        );

        $this->validate($request, $rules);
        $input = $request->all();
//        dd($data,$input);

        $bankProfiles = BankAllocationProfile::updateOrCreate(array('id' => $id), $input);

        $finParametersCategory = new BankAllocationCategory();
        $finParametersCategory->profile_id = $bankProfiles->id;
        $finParametersCategory->name = 'Financial Parameters';
        $finParametersCategory->sortorder = 5;
        $finParametersCategory->status = 1;
        $finParametersCategory->save();

        $busParametersCategory = new BankAllocationCategory();
        $busParametersCategory->profile_id = $bankProfiles->id;
        $busParametersCategory->name = 'Business Parameters';
        $busParametersCategory->sortorder = 10;
        $busParametersCategory->status = 1;
        $busParametersCategory->save();

        $refCheckParametersCategory = new BankAllocationCategory();
        $refCheckParametersCategory->profile_id = $bankProfiles->id;
        $refCheckParametersCategory->name = 'Reference Check/Credit Check';
        $refCheckParametersCategory->sortorder = 15;
        $refCheckParametersCategory->status = 1;
        $refCheckParametersCategory->save();

        $transactionParametersCategory = new BankAllocationCategory();
        $transactionParametersCategory->profile_id = $bankProfiles->id;
        $transactionParametersCategory->name = 'Transaction Parameters';
        $transactionParametersCategory->sortorder = 20;
        $transactionParametersCategory->status = 1;
        $transactionParametersCategory->save();

        DB::table('conf_bank_allocation_dimension')->insert(array(
            array('category_id'=> $finParametersCategory->id, 'type' => 'Loan', 'name' => 'Turnover Tolerance', 'description' => 'Min/Max Tolerance range for turnover', 'model' => 'loans', 'attribute' => 'turnover', 'operand' => 'between', 'single_value' => null, 'begin_range' => 25, 'end_range' => 100, 'sortorder' => 5, 'status' => 1 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'EBITDA Margin Ratio Tolerance', 'description' => 'EBITDA Margin Tolerance', 'model' => 'financials_ratios', 'attribute' => 'ebitda_netrevenue', 'operand' => '>', 'single_value' => 0, 'begin_range' => null, 'end_range' => null, 'sortorder' => 10, 'status' => 1 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'PAT Margin Ratio Tolerance', 'description' => 'PAT Margin Tolerance', 'model' => 'financials_ratios', 'attribute' => 'pat_netrevenue', 'operand' => '>', 'single_value' => 0, 'begin_range' => null, 'end_range' => null, 'sortorder' => 11, 'status' => 1 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'Debt / EBITDA Ratio Tolerance', 'description' => 'Debt / EBITDA Tolerance', 'model' => 'financials_ratios', 'attribute' => 'total_debt_ebitda', 'operand' => '>', 'single_value' => 4, 'begin_range' => null, 'end_range' => null, 'sortorder' => 15, 'status' => 1 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'Debt / Turnover Ratio Tolerance', 'description' => 'Debt/Turnover Ratio Tolerance', 'model' => 'financials_ratios', 'attribute' => 'debt_turnover_ratio', 'operand' => '>', 'single_value' => 4, 'begin_range' => null, 'end_range' => null, 'sortorder' => 20, 'status' => 1 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'Networth / Total Assets Ratio Tolerance', 'description' => 'Networth / Total Assets Ratio Tolerance', 'model' => 'financials_ratios', 'attribute' => 'solvency_ratio', 'operand' => '>', 'single_value' => 4, 'begin_range' => null, 'end_range' => null, 'sortorder' => 20, 'status' => 1 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'Debt / Equity Ratio Tolerance', 'description' => 'Debt/Equity Ratio Tolerance', 'model' => 'financials_ratios', 'attribute' => 'debt_funds_ratio', 'operand' => '>', 'single_value' => 4, 'begin_range' => null, 'end_range' => null, 'sortorder' => 20, 'status' => 1 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Credit', 'name' => 'Credit Model Tolerance', 'description' => 'Credit Model Tolerance', 'model' => 'analyst_model_ratings', 'attribute' => 'final_score', 'operand' => '>', 'single_value' => 75, 'begin_range' => null, 'end_range' => null, 'sortorder' => 25, 'status' => 1 ),

            array('category_id'=> $busParametersCategory->id, 'type' => 'User Profile', 'name' => 'Legal Entity Negative List', 'description' => 'Legal Entity Negative List', 'model' => 'user_profiles', 'attribute' => 'owner_entity_type', 'operand' => 'NOTIN', 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 30, 'status' => 1 ),
            array('category_id'=> $busParametersCategory->id, 'type' => 'Loan', 'name' => 'Industry Segment Negative List', 'description' => 'Industry Segment Negative List', 'model' => 'loans', 'attribute' => 'com_industry_segment', 'operand' => 'NOTIN', 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 35, 'status' => 1 ),
            array('category_id'=> $busParametersCategory->id, 'type' => 'Loan', 'name' => 'Vintage Threshold', 'description' => 'Vintage Threshold', 'model' => 'loans', 'attribute' => 'com_co_business_old', 'operand' => 'IN', 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 40, 'status' => 1 ),
            array('category_id'=> $busParametersCategory->id, 'type' => 'User Profile', 'name' => 'Location Negative List', 'description' => 'Negative List of location of client', 'model' => 'user_profiles', 'attribute' => 'owner_city', 'operand' => 'NOTIN', 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 45, 'status' => 1 ),

            array('category_id'=> $refCheckParametersCategory->id, 'type' => 'Loan', 'name' => 'CIBIL Score Threshold', 'description' => 'CIBIL Score Threshold', 'model' => 'loans', 'attribute' => 'fin_cibilscore', 'operand' => '>=', 'single_value' => 500, 'begin_range' => null, 'end_range' => null, 'sortorder' => 50, 'status' => 1 ),

            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Loan', 'name' => 'Product Negative List', 'description' => 'Negative List of Products', 'model' => 'loans', 'attribute' => 'type', 'operand' => 'NOTIN', 'single_value' => NULL, 'begin_range' => null, 'end_range' => null, 'sortorder' => 55, 'status' => 1 ),
            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Loan', 'name' => 'Loan Amount Range', 'description' => 'Range of Loan Amount', 'model' => 'loans', 'attribute' => 'loan_amount', 'operand' => 'between', 'single_value' => NULL, 'begin_range' => 5, 'end_range' => 100, 'sortorder' => 60, 'status' => 1 ),

            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Loan', 'name' => 'Offered Security Type Negative List', 'description' => 'Negative List of type of security offered', 'model' => 'loans_security_details', 'attribute' => 'collateral_type', 'operand' => 'NOTIN', 'single_value' => NULL, 'begin_range' => null, 'end_range' => null, 'sortorder' => 65, 'status' => 1 ),
            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Loan', 'name' => 'Collateral City Negative List', 'description' => 'Negative List of cities for offered collateral', 'model' => 'loans_security_details', 'attribute' => 'city', 'operand' => 'NOTIN', 'single_value' => NULL, 'begin_range' => null, 'end_range' => null, 'sortorder' => 70, 'status' => 1 ),
            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Collateral', 'name' => 'Collateral Model Score Tolerance', 'description' => 'Collateral Model Score Tolerance', 'model' => 'analyst_model_ratings', 'attribute' => 'final_haircut', 'operand' => '>', 'single_value' => 40, 'begin_range' => null, 'end_range' => null, 'sortorder' => 75, 'status' => 1 ),

        ));

        $legalData = BankAllocationDimension::where('name','=', 'Legal Entity Negative List')->get();
        foreach($legalData as $value)
        {
            $temp = BankAllocationSubDimension::where('dimension_id','=',$value->id)->get();
                if(isset($temp) && count($temp) == 0) {
                    BankAllocationSubDimension::Create([
                        'dimension_id' => $value->id,
                        'value' => 'Partnership Firm',
                    ]);
                    BankAllocationSubDimension::Create([
                        'dimension_id' => $value->id,
                        'value' => 'LLP',
                    ]);
                }
        }

        $IndustryData = BankAllocationDimension::where('name','=', 'Industry Segment Negative List')->get();
        foreach($IndustryData as $value)
        {
            $temp = BankAllocationSubDimension::where('dimension_id','=',$value->id)->get();
            if(isset($temp) && count($temp) == 0) {
                BankAllocationSubDimension::Create([
                    'dimension_id' => $value->id,
                    'value' => 'Abrasives & Grinding',
                ]);
                BankAllocationSubDimension::Create([
                    'dimension_id' => $value->id,
                    'value' => '2 & 3 Wheelers',
                ]);
            }
        }

        $vintageData = BankAllocationDimension::where('name','=', 'Vintage Threshold')->get();
        foreach($vintageData as $value)
        {
            $temp = BankAllocationSubDimension::where('dimension_id','=',$value->id)->get();
            if(isset($temp) && count($temp) == 0) {
                BankAllocationSubDimension::Create([
                    'dimension_id' => $value->id,
                    'value' => '2',
                ]);
                BankAllocationSubDimension::Create([
                    'dimension_id' => $value->id,
                    'value' => '3',
                ]);
            }
        }

        $locationData = BankAllocationDimension::where('name','=', 'Location Negative List')->get();
        foreach($locationData as $value)
        {
            $temp = BankAllocationSubDimension::where('dimension_id','=',$value->id)->get();
            if(isset($temp) && count($temp) == 0) {
                BankAllocationSubDimension::Create([
                    'dimension_id' => $value->id,
                    'value' => 'Agartala',
                ]);
                BankAllocationSubDimension::Create([
                    'dimension_id' => $value->id,
                    'value' => 'Agra',
                ]);
            }
        }

        $productData = BankAllocationDimension::where('name','=', 'Product Negative List')->get();
        foreach($productData as $value)
        {
            $temp = BankAllocationSubDimension::where('dimension_id','=',$value->id)->get();
            if(isset($temp) && count($temp) == 0) {
                BankAllocationSubDimension::Create([
                    'dimension_id' => $value->id,
                    'value' => 'CC',
                ]);
                BankAllocationSubDimension::Create([
                    'dimension_id' => $value->id,
                    'value' => 'STL',
                ]);
            }
        }

        $offeredData = BankAllocationDimension::where('name','=', 'Offered Security Type Negative List')->get();
        foreach($offeredData as $value)
        {
            $temp = BankAllocationSubDimension::where('dimension_id','=',$value->id)->get();
            if(isset($temp) && count($temp) == 0) {
                BankAllocationSubDimension::Create([
                    'dimension_id' => $value->id,
                    'value' => 'Commercial',
                ]);
                BankAllocationSubDimension::Create([
                    'dimension_id' => $value->id,
                    'value' => 'Residential',
                ]);
            }
        }

        $collateralData = BankAllocationDimension::where('name','=', 'Collateral City Negative List')->get();
        foreach($collateralData as $value)
        {
            $temp = BankAllocationSubDimension::where('dimension_id','=',$value->id)->get();
            if(isset($temp) && count($temp) == 0) {
                BankAllocationSubDimension::Create([
                    'dimension_id' => $value->id,
                    'value' => 'Agartala',
                ]);
                BankAllocationSubDimension::Create([
                    'dimension_id' => $value->id,
                    'value' => 'Agra',
                ]);
            }
        }

        session()->flash('flash_message','Bank Profile Details were successfully saved!');

        $redirectPath = 'admin/bankallocation';
        return Redirect::to($redirectPath);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function postEdit(Request $request){
        $input = Input::all();
//        dd($input);
        $id = $input['id'];
        $data = null;
        if(isset($id)) {
            $data = BankAllocationProfile::find($id);
        }
        $rules = array(
            'bank_id' => 'required|unique:conf_bank_allocation_profile,bank_id,'.$id,
            'name' => 'required',
            'description' => 'required',
            'sortorder' => 'numeric',
            'status' => 'required|numeric'
        );

        $this->validate($request, $rules);
        $input = $request->all();
//        dd($data,$input);
        BankAllocationProfile::updateOrCreate(array('id' => $id), $input);
        session()->flash('flash_message','Bank Profile Details were successfully saved!');

        $redirectPath = 'admin/bankallocation';
        return Redirect::to($redirectPath)->withInput();
    }

    public function postEditCategory(Request $request){
        $input = Input::all();
        $id = $input['id'];
        $data = null;

        if(isset($id)) {
            $data = BankAllocationCategory::find($id);
        }
        $rules = array(
            'sortorder' => 'numeric',
//            'description' => 'required',
            'status' => 'required|numeric'
        );

        $this->validate($request, $rules);
        $input = $request->all();
//        dd($data,$input);
        BankAllocationCategory::updateOrCreate(array('id' => $id), $input);
        session()->flash('flash_message','Category Details were successfully saved!');

        $redirectPath = 'admin/bankallocation/category/'.$input['bankId'];
        return Redirect::to($redirectPath)->withInput();
    }

    public function postEditDimension(Request $request){
        $input = Input::all();
//        dd($input);
        $id = $input['id'];
        $data = null;
        if(isset($id)) {
            $data = BankAllocationDimension::find($id);
        }
        $rules = array(
            'operand' => 'required',
            'sortorder' => 'numeric',
            'description' => 'required',
            'single_value' => 'required_if:operand,=|required_if:operand,!|required_if:operand,>|required_if:operand,>=|required_if:operand,<|required_if:operand,<=',
            'begin_range' => 'required_if:operand,between',
            'end_range' => 'required_if:operand,between',
            'status' => 'required|numeric'
        );

        $this->validate($request, $rules);
        $input = $request->all();
//        dd($data,$input);
        $dimensionMeasure = BankAllocationDimension::updateOrCreate(array('id' => $id), $input);

        if($input['operand'] == 'IN' || $input['operand'] == 'NOTIN')
        {
            $dimensionMeasure->single_value = null;
            $dimensionMeasure->begin_range = null;
            $dimensionMeasure->end_range = null;
            $dimensionMeasure->save();
        }
        elseif(isset($dimensionMeasure) && strcmp($dimensionMeasure->operand,"between") == 0) {
            $dimensionMeasure->single_value = null;
            $dimensionMeasure->save();
        }
        else {
            $dimensionMeasure->begin_range = null;
            $dimensionMeasure->end_range = null;
            $dimensionMeasure->save();
        }
        session()->flash('flash_message','Dimension Details were successfully saved!');

        $redirectPath = 'admin/bankallocation/dimension/'.$input['category_id'].'/'.$input['bankId'];
        return Redirect::to($redirectPath)->withInput();
    }

    public function postEditSubDimension(Request $request){
        $input = Input::all();
//        dd($input);
        $id = $input['id'];
        $data = null;
        if(isset($id)) {
            $data = BankAllocationSubDimension::find($id);
        }
        $rules = array(
//            'dimension_id' => 'required',
            'value' => 'required',
            'status' => 'required|numeric'
        );
        
        $this->validate($request, $rules);
        $input = $request->all();
//        dd($data,$input);
        $input['dimension_id'] = $input['dimensionId'];
        $query = BankAllocationSubDimension::where('dimension_id','=',$input['dimension_id'])->where('value','=',$input['value'])->where('id', '!=',$id)->get();

        if( $query->count() > 0 )
        {
            return Redirect::back()->withErrors('The value has been taken already.')->withInput();
        }
        BankAllocationSubDimension::updateOrCreate(array('id' => $id), $input);

        session()->flash('flash_message','Sub Dimension Details were successfully saved!');

        $redirectPath = 'admin/bankallocation/sub-dimension/'.$input['dimensionId'].'/'.$input['categoryId'].'/'.$input['bankId'];
        return Redirect::to($redirectPath)->withInput();
    }

    public function getDeleteSubDimension($id)
    {
        $creditMeasure = BankAllocationSubDimension::find($id);
        $creditMeasure->delete();
        session()->flash('flash_message','Sub-dimension Deleted successfully!');
        return Redirect::back();
    }
}