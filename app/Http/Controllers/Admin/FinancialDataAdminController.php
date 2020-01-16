<?php

namespace App\Http\Controllers\Admin;

use App\Models\Loan\FinancialData\FinancialGroup;
use App\Models\Loan\FinancialData\FinancialEntry;
use App\Models\MasterData;
use Illuminate\Http\Request;
use Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;
use App\Helpers\validLoanUrlhelper;
use Auth;

class FinancialDataAdminController extends BaseAdminController {

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
        $groups = FinancialGroup::all();

        $sideTab = 'finData';
        return view('admin.financialdata.index', compact('sideTab','groups'));
    }

    /**
     * Display a listing of entries in grid format.
     *
     * @return Response
     */
    public function getEntries($groupId){
        $entries = FinancialEntry::where('group_id','=',$groupId)->get();
        $sideTab = 'finData';
        return view('admin.financialdata.entries', compact('sideTab','groupId','entries'));
    }

    /**
     * Datasource for the groups Data Grid.
     *
     * @return \Cartalyst\DataGrid\DataGrid
     */
    public function getGroupsGrid()
    {
        $columns = [
            'id',
            'type',
            'name',
            'description',
            'sortorder',
            'status',
        ];

        $settings = [
            'sort'      => 'id',
            'direction' => 'asc',
            'max_results' => 10,
            'threshold'	  => 5,
            'throttle' => 5,
        ];

        $groups = FinancialGroup::all();

        $transformer = function($element)
        {
            $element['view_uri'] = url("/admin/financialdata/entries/{$element['id']}");
            $element['edit_uri'] = url("/admin/financialdata/edit-group/{$element['id']}");

            return $element;
        };

        return DataGrid::make($groups, $columns, $settings, $transformer);
    }

    /**
     * Datasource for the entries Data Grid.
     *
     * @return \Cartalyst\DataGrid\DataGrid
     */
    public function getEntriesGrid($groupId)
    {
        $columns = [
            'id',
            'entry',
            'description',
            'calculation_method',
            'model',
            'attribute',
            'sortorder',
            'status',
        ];

        $settings = [
            'sort'      => 'id',
            'direction' => 'asc',
            'max_results' => 10,
            'threshold'	  => 5,
            'throttle' => 5,
        ];

        $entries = FinancialEntry::where('group_id','=',$groupId)->get();

        $transformer = function($element)
        {
            $element['view_uri'] = url("/admin/financialdata/edit-entry/{$element['id']}");

            return $element;
        };

        return DataGrid::make($entries, $columns, $settings, $transformer);
    }


    public function getEditGroup($id)
    {
        $financialDataGroup = FinancialGroup::find($id);
        $attributeStatus = MasterData::attributeStatus();
//        dd($financialDataGroup);
//        $financialGroup = $financialDataGroup->financialGroup()->get()->first();
        $isRatio = false;

        $ratioType = Config::get('constants.CONST_FIN_GROUP_TYPE_RATIO');
        if(strcmp($financialDataGroup->type, $ratioType) === 0){
            $isRatio = true;
        }

        $chosenStatus = $financialDataGroup->status;

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);

        $formaction = 'Admin\FinancialDataAdminController@postEditGroup';
        $sideTab = 'finData';
        return view('admin.financialdata.createeditgroup',compact('sideTab','financialDataGroup','formaction','attributeStatus', 'chosenStatus','isRatio','removeMandatory'));
    }

    public function getCreateGroup()
    {
        $financialDataGroup = null;
        $attributeStatus = MasterData::attributeStatus();
        $chosenStatus = null;
        $isRatio = true;

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);

        $formaction = 'Admin\FinancialDataAdminController@postEditGroup';
        $sideTab = 'finData';
        return view('admin.financialdata.createeditgroup',compact('sideTab','financialDataGroup','formaction', 'attributeStatus', 'chosenStatus','isRatio','removeMandatory'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function postEditGroup(Request $request)
    {
        $input = Input::all();

        $id = $input['id'];
        $data = null;

        if(isset($id)) {
            $data = FinancialGroup::find($id);
        }
        $rules = array(
            'type' => 'required',
            'name' => 'required',
            'description' => 'required',
            'sortorder' => 'required|numeric',
            'status' => 'required|numeric'
        );

        $this->validate($request, $rules);
        $input = $request->all();
//        dd($data);
        FinancialGroup::updateOrCreate(array('id' => $id), $input);
        session()->flash('flash_message','Financial Data Group Details were successfully saved!');

        $redirectPath = 'admin/financialdata';
        return Redirect::to($redirectPath)->withInput();
    }


//    Code for Creating & Updating Financial Data Entries

    public function getEditEntry($id)
    {
        $financialDataEntry = FinancialEntry::find($id);

        $groupId = $financialDataEntry->group_id;
        $attributeStatus = MasterData::attributeStatus();
        $attributePercentage = MasterData::yesNoTypes();
        $attributeThresholdCondition = MasterData::expressionTypes();

        $financialDataGroup = $financialDataEntry->financialGroup()->get()->first();
        $isRatio = false;

        $ratioType = Config::get('constants.CONST_FIN_GROUP_TYPE_RATIO');

        if(strcmp($financialDataGroup->type, $ratioType) === 0){
            $isRatio = true;
        }
        $chosenStatus = $financialDataEntry->status;
        $chosenPercentage = $financialDataEntry->percentage;
        $chosenThresholdCondition = $financialDataEntry->threshold_condition;
//dd($chosenThresholdCondition);
        $groupTypeList = null;

        if($isRatio) {
            $groupTypeList = array(NULL => '') + FinancialGroup::where('status', '=', 1)->where('type', '=', $ratioType)->get()->lists('name', 'id')->all();
        }else{
            $groupTypeList = array(NULL => '') + FinancialGroup::where('status', '=', 1)->get()->lists('name', 'id')->all();
        }

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);

        $formaction = 'Admin\FinancialDataAdminController@postEditEntry';
        $sideTab = 'finData';
        return view('admin.financialdata.createeditentry',compact('sideTab','financialDataEntry','formaction','attributeStatus', 'attributePercentage', 'attributeThresholdCondition', 'chosenStatus', 'chosenPercentage', 'chosenThresholdCondition','groupId','groupTypeList', 'isRatio','removeMandatory'));
    }

    public function getCreateEntry($groupId)
    {
        $financialDataEntry = null;


        $attributeStatus = MasterData::attributeStatus();
        $attributePercentage = MasterData::yesNoTypes();
        $attributeThresholdCondition = MasterData::expressionTypes();
        $chosenStatus = null;
        $chosenPercentage = null;
        $chosenThresholdCondition = null;
        $isRatio = false;
        $groupType = null;

        $group = FinancialGroup::find($groupId);

        if ($group->status == 1) {
            
            $groupType = $group->type;
        }    


        if ($groupType == Config::get('constants.CONST_FIN_GROUP_TYPE_BS')) {
            
            $ratioType = Config::get('constants.CONST_FIN_GROUP_TYPE_BS');
            $isRatio = false;

        } elseif ($groupType == Config::get('constants.CONST_FIN_GROUP_TYPE_PL')) {
            
            $ratioType = Config::get('constants.CONST_FIN_GROUP_TYPE_PL');
            $isRatio = false;

        } elseif ($groupType == Config::get('constants.CONST_FIN_GROUP_TYPE_CF')) {
            
            $ratioType = Config::get('constants.CONST_FIN_GROUP_TYPE_CF');
            $isRatio = false;

        } elseif ($groupType == Config::get('constants.CONST_FIN_GROUP_TYPE_RATIO')) {
            
            $ratioType = Config::get('constants.CONST_FIN_GROUP_TYPE_RATIO');
            $isRatio = true;
        }

        $groupTypeList = array(NULL => '') + FinancialGroup::where('status','=', 1)->where('type', '=', $ratioType)->get()->lists('name', 'id')->all();
        //dd($groupTypeList);
        //dd($attributePercentage);
        $calculationMethodOptions = array('Manual'=>'Manual', 'Calculated'=>'Calculated');

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);

        $formaction = 'Admin\FinancialDataAdminController@postEditEntry';
        $sideTab = 'finData';
        return view('admin.financialdata.createeditentry',compact('sideTab','financialDataEntry','formaction', 'attributeStatus', 'attributePercentage', 'attributeThresholdCondition', 'chosenStatus', 'chosenPercentage','chosenThresholdCondition', 'groupId', 'groupTypeList', 'isRatio', 'calculationMethodOptions', 'removeMandatory', 'groupType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function postEditEntry(Request $request)
    {
        $input = Input::all();
      //dd($input);
        $id = $input['id'];
        $groupId = $input['group_id'];
        $data = null;

        if(isset($id)) {
            $data = FinancialEntry::find($id);
        }
        $rules = array(
            'entry' => 'required',
            'calculation_method' => 'required',
            'formula' => 'required',
            //'formula_reference' => 'required|unique:conf_financial_entries',
            'formula_reference' => 'required',
            'model' => 'required',
            'attribute' => 'required',
            //'percentage' => 'required',
            //'threshold' => 'required',
            //'threshold_condition' => 'required',
            'sortorder' => 'required',
            'status' => 'required|numeric'
        );

        if ($input['isRatio'] == "") {

            if ($input['calculation_method'] == "Manual") {
                unset($rules['formula']);
            }
            unset($rules['percentage']);
            unset($rules['threshold']);
            unset($rules['threshold_condition']);

        } 

        $this->validate($request, $rules);
        $input = $request->all();
        //dd($data);
        FinancialEntry::updateOrCreate(array('id' => $id), $input);
        session()->flash('flash_message','Financial Data Entry Details were successfully saved!');

        $redirectPath = 'admin/financialdata/entries/'.$groupId;
        return Redirect::to($redirectPath)->withInput();
    }
}