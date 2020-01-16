<?php

namespace App\Http\Controllers\Admin;

use App\Models\MasterData;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Input;
use Illuminate\Support\Facades\Redirect;
use App\Helpers\validLoanUrlhelper;
use Auth;

class MasterDataController extends BaseAdminController {

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

        $masterData = MasterData::all();
           // $subViewType = 'masterData';
               $sideTab = 'masterData';
        return view('admin.masterdata.index',compact('masterData','sideTab'));
    }

    /**
     * Datasource for the master questions Data Grid.
     *
     * @return \Cartalyst\DataGrid\DataGrid
     */
    public function getMasterDataGrid() {
        $columns = [
            'id',
            'name',
            'type',
            'value',
            'sortorder',
            'status',
        ];

        $settings = [
            'sort'      => 'id',
            'direction' => 'asc',
            'max_results' => 10,
            'threshold'	  => 20,
            'throttle' => 20,
        ];

        $masterData = MasterData::all();

        $transformer = function($element)
        {
            $element['edit_uri'] = url("/admin/masterdata/edit/{$element['id']}");

            return $element;
        };
        return DataGrid::make($masterData, $columns, $settings, $transformer);
    }

    public function getEdit($id)
    {
        $masterData = MasterData::find($id);
        $attributeStatus = MasterData::attributeStatus();
        $chosenStatus = $masterData->status;
        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);
        $formaction = 'Admin\MasterDataController@postEdit';
           $sideTab = 'masterData';
        return view('admin.masterdata.createedit',compact('masterData','formaction','sideTab', 'attributeStatus', 'chosenStatus','removeMandatory'));
    }



    public function getCreate()
    {
        $masterData = null;
        $attributeStatus = MasterData::attributeStatus();
        $chosenStatus = null;
        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);
        $formaction = 'Admin\MasterDataController@postEdit';
              $sideTab = 'masterData';
        return view('admin.masterdata.createedit',compact('masterData','formaction','sideTab', 'attributeStatus', 'chosenStatus','removeMandatory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function postEdit(Request $request){
        $input = Input::all();

        $id = $input['id'];
        $data = null;

        if(isset($id)) {
            $data = MasterData::find($id);
        }
        $rules = array(
            'type' => 'required',
            'name' => 'required',
            'value' => 'required',
            'sortorder' => 'required|numeric',
            'status' => 'required|numeric'
        );

        $this->validate($request, $rules);
        $input = $request->all();
       // dd($data);
        $data = MasterData::updateOrCreate(array('id' => $id), $input);
//        if (Cache::has($data->type))
//        {
//            Cache::forget($data->type);
//        }
        session()->flash('flash_message','MasterData Details were successfully saved!');

        $redirectPath = 'admin/masterdata';
        return Redirect::to($redirectPath)->withInput();
    }
}