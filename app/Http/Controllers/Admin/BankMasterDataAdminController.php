<?php

namespace App\Http\Controllers\Admin;

use App\Models\BankMasterData;
use App\Models\MasterData;
use Illuminate\Http\Request;
use Input;
use Illuminate\Support\Facades\Redirect;
use App\Helpers\validLoanUrlhelper;
use Auth;

class BankMasterDataAdminController extends BaseAdminController {

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
        $bankMasterData = BankMasterData::all();
//        dd($bankMasterData);

        $sideTab = 'bankData';
        return view('admin.bankmasterdata.index',compact('sideTab','bankMasterData'));
    }

    /**
     * Datasource for the master questions Data Grid.
     *
     * @return \Cartalyst\DataGrid\DataGrid
     */
    public function getBankMasterDataGrid() {
        $columns = [
            'id',
            'name',
            'description',
            'status',
        ];

        $settings = [
            'sort'      => 'id',
            'direction' => 'asc',
            'max_results' => 10,
            'threshold'	  => 20,
            'throttle' => 20,
        ];

        $bankMasterData = BankMasterData::all();

        $transformer = function($element)
        {
            $element['edit_uri'] = url("/admin/bankmasterdata/edit/{$element['id']}");

            return $element;
        };
        return DataGrid::make($bankMasterData, $columns, $settings, $transformer);
    }

    public function getEdit($id)
    {
        $bankMasterData = BankMasterData::find($id);
        $attributeStatus = MasterData::attributeStatus();
        $chosenStatus = $bankMasterData->status;

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);

        $formaction = 'Admin\BankMasterDataAdminController@postEdit';
        $sideTab = 'bankData';
        return view('admin.bankmasterdata.createedit',compact('sideTab','bankMasterData','formaction', 'attributeStatus', 'chosenStatus','removeMandatory'));
    }

    public function getCreate()
    {
        $bankMasterData = null;
        $attributeStatus = MasterData::attributeStatus();
        $chosenStatus = null;

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);

        $formaction = 'Admin\BankMasterDataAdminController@postEdit';
        $sideTab = 'bankData';
        return view('admin.bankmasterdata.createedit',compact('sideTab','bankMasterData','formaction', 'attributeStatus', 'chosenStatus','removeMandatory'));
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
            $data = BankMasterData::find($id);
        }
        $rules = array(
            'name' => 'required',
            'description' => 'required',
            'status' => 'required|numeric'
        );

        $this->validate($request, $rules);
        $input = $request->all();
//        dd($data,$input);
        BankMasterData::updateOrCreate(array('id' => $id), $input);
        session()->flash('flash_message','Bank Master Data Details were successfully saved!');

        $redirectPath = 'admin/bankmasterdata';
        return Redirect::to($redirectPath)->withInput();
    }
}