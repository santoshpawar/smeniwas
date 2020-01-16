<?php

namespace App\Http\Controllers\Admin;

use App\Models\Common\ConfigurableParameter;
use App\Models\Common\ConfIndustryTypeSectorOutlookMapping;
use App\Models\MasterData;
use Illuminate\Http\Request;
use Input;
use Illuminate\Support\Facades\Redirect;
use App\Models\Loan\AnalystModel\AnalystModelDimension;
use App\Helpers\validLoanUrlhelper;
use Auth;

class ConfigurationDataAdminController extends BaseAdminController {

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
        $parameterMasterData = ConfigurableParameter::all();

         $sideTab = 'paramData';
        return view('admin.parameters.index',compact('sideTab','parameterMasterData'));
    }

    /**
     * Display a listing of master data in grid format.
     *
     * @return Response
     */
    public function getIndustryType(){
        $industryTypeData = ConfIndustryTypeSectorOutlookMapping::all();
         $sideTab = 'indData';
        return view('admin.parameters.industrytype',compact('sideTab','industryTypeData'));
    }

    public function getEdit($id)
    {
        $parameterMasterData = ConfigurableParameter::find($id);
        $attributeStatus = MasterData::attributeStatus();
        $chosenStatus = $parameterMasterData->status;

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);

        $formaction = 'Admin\ConfigurationDataAdminController@postEdit';
         $sideTab = 'paramData';
        return view('admin.parameters.createedit',compact('sideTab','parameterMasterData','formaction', 'attributeStatus', 'chosenStatus','removeMandatory'));
    }

    public function getCreate()
    {
        $parameterMasterData = null;
        $attributeStatus = MasterData::attributeStatus();
        $chosenStatus = null;

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);

        $formaction = 'Admin\ConfigurationDataAdminController@postEdit';
         $sideTab = 'paramData';
        return view('admin.parameters.createedit',compact('sideTab','parameterMasterData','formaction', 'attributeStatus', 'chosenStatus','removeMandatory'));
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
            $data = ConfigurableParameter::find($id);
        }
        $rules = array(
//            'description' => 'required',
            'parameter_value' => 'required|numeric',
            'status' => 'required|numeric'
        );

        $this->validate($request, $rules);
        $input = $request->all();
//        dd($data,$input);
        ConfigurableParameter::updateOrCreate(array('id' => $id), $input);
        session()->flash('flash_message','Parameter Configuration Details were successfully saved!');

        $redirectPath = 'admin/parameterdata';
        return Redirect::to($redirectPath)->withInput();
    }

    public function getEditIndustryType($id)
    {
        $measureData = ConfIndustryTypeSectorOutlookMapping::find($id);
        $masterData = MasterData::orderBy('sortorder')->where('type', "=", 'INDUSTRY_TYPE')->lists('value','id')->all();
        $sectorOutlookDimension = AnalystModelDimension::where('label','=', 'Sector Outlook')->get()->first();
        $listData = $sectorOutlookDimension->measures()->get()->lists('label','id')->toArray();

        $industryType = array(NULL => '') + $masterData;
        $chosenIndustryType = $measureData->master_data_id;
        $measuresList = array(NULL => '') + $listData;
        $chosenSectorOutlookDimension = $measureData->sector_outlook_measure_id;

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);

        $formaction = 'Admin\ConfigurationDataAdminController@postEditIndustryType';
         $sideTab = 'indData';
        return view('admin.parameters.createeditindustrytype',compact('sideTab','measureData','formaction', 'industryType', 'chosenIndustryType','measuresList','chosenSectorOutlookDimension','removeMandatory'));
    }

    public function getCreateIndustryType()
    {
        $measureData = null;
        $masterData = MasterData::orderBy('sortorder')->where('type', "=", 'INDUSTRY_TYPE')->lists('value','id')->all();
        $sectorOutlookDimension = AnalystModelDimension::where('label','=', 'Sector Outlook')->get()->first();
        $listData = $sectorOutlookDimension->measures()->get()->lists('label','id')->toArray();

        $industryType = array(NULL => '') + $masterData;
        $chosenIndustryType = null;
        $measuresList = array(NULL => '') + $listData;
        $chosenSectorOutlookDimension = null;

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);

        $formaction = 'Admin\ConfigurationDataAdminController@postEditIndustryType';
         $sideTab = 'indData';
        return view('admin.parameters.createeditindustrytype',compact('sideTab','measureData','formaction', 'industryType', 'chosenIndustryType','measuresList','chosenSectorOutlookDimension','removeMandatory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function postEditIndustryType(Request $request){
        $input = Input::all();
        $id = $input['id'];
        $data = null;

        if(isset($id)) {
            $data = ConfIndustryTypeSectorOutlookMapping::find($id);
        }
        $rules = array(
            'master_data_id' => 'required|unique:conf_industry_type_sector_outlook_mapping,master_data_id,'.$id,
            'sector_outlook_measure_id' => 'required'
        );

        $this->validate($request, $rules);
        $input = $request->all();
        ConfIndustryTypeSectorOutlookMapping::updateOrCreate(array('id' => $id), $input);
        session()->flash('flash_message','Details were successfully saved!');

        $redirectPath = 'admin/industrytype';
        return Redirect::to($redirectPath)->withInput();
    }

    public function getDeleteIndustryType($id)
    {
        $creditMeasure = ConfIndustryTypeSectorOutlookMapping::find($id);
        $creditMeasure->delete();
        session()->flash('flash_message','Industry Type Deleted successfully!');
        return Redirect::back();
    }
}