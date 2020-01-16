<?php
/**
 * Created by PhpStorm.
 * User: BV111601
 * Date: 5/7/2015
 * Time: 2:38 AM
 */

namespace App\Http\Controllers\Admin;

use App\Models\Loan\LiquidityModel\LiquidityModelCategory;
use App\Models\Loan\LiquidityModel\LiquidityModelDimension;
use App\Models\Loan\LiquidityModel\LiquidityModelMeasure;

use App\Models\MasterData;
use App\Models\Loan\FinancialData\FinancialGroup;
use App\Models\Loan\FinancialData\FinancialEntry;
use Config;
use Illuminate\Http\Request;
use Input;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Helpers\validLoanUrlhelper;

class LiquidityModelAdminController extends BaseAdminController {

    public function __construct() {
        //This will ensure that all routes handled by this controller are first authenticated
        $this->middleware('auth');
    }

    /**
     * Display a listing of categories in grid format.
     *
     * @return Response
     */
    public function getIndex(){
        $categories = LiquidityModelCategory::all();
         
        $sideTab = 'liquidityData';
        return view('admin.liquiditymodel.index', compact('sideTab','categories'));
    }

    /**
     * Display a listing of dimensions in grid format.
     *
     * @return Response
     */
    public function getDimensions($categoryId){
        $dimensions = LiquidityModelDimension::where('category_id','=',$categoryId)->orderBy('sortorder', 'asc')->get();
        $sideTab = 'liquidityData';
        return view('admin.liquiditymodel.dimensions', compact('sideTab','categoryId','dimensions'));
    }

    /**
     * Display a listing of measures in grid format.
     *
     * @return Response
     */
    public function getMeasures($dimensionId,$categoryId){
        $measures = LiquidityModelMeasure::where('dimension_id','=',$dimensionId)->get();
        $sideTab = 'liquidityData';
        return view('admin.liquiditymodel.measures', compact('sideTab','dimensionId','categoryId','measures'));
    }

    public function getEditDimension($id)
    {
        $dimensionData = LiquidityModelDimension::find($id);
        $parentDimensionsList = array(NULL => '') + LiquidityModelDimension::where('status','=', 1)->get()->lists('label', 'id')->all();
        $categoryId = $dimensionData->category_id;
        $attributeStatus = MasterData::attributeStatus();
        $chosenStatus = $dimensionData->status;

        $attributeIsApplicable = MasterData::yesNoTypes();
        $chosenIsApplicable = null;
        $modelsList = $this->getDimensionsModelList();
        $ratioTemp = array();
        $findRatio = FinancialGroup::where('type','=','Ratio')->get();
        foreach($findRatio as $key) {
            $ratioTemp[] = array(NULL => '') + FinancialEntry::where('group_id', '=', $key->id)->get()->lists('entry','id')->all();
        }
        $ratioList = call_user_func_array('array_merge', $ratioTemp);
        $dimensionType = array(NULL => '','0' => 'Single','1' => 'Parent','2' => 'Hybrid');

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);

        $formaction = 'Admin\LiquidityModelAdminController@postSave';
        $sideTab = 'liquidityData';
        return view('admin.liquiditymodel.createedit',compact('sideTab','dimensionData','formaction','attributeStatus', 'chosenStatus','attributeIsApplicable', 'chosenIsApplicable', 'categoryId', 'parentDimensionsList','ratioList','dimensionType', 'modelsList','removeMandatory'));
    }

    public function getCreateDimension($categoryId)
    {
        $dimensionData = null;
        $parentDimensionsList = array(NULL => '') + LiquidityModelDimension::where('status','=', 1)->get()->lists('label', 'id')->all();
        $attributeStatus = MasterData::attributeStatus();
        $chosenStatus = null;
        $attributeIsApplicable = MasterData::yesNoTypes();
        $chosenIsApplicable = null;
        $modelsList = $this->getDimensionsModelList();
        $ratioTemp = array();
        $findRatio = FinancialGroup::where('type','=','Ratio')->get();
        foreach($findRatio as $key) {
            $ratioTemp[] = array(NULL => '') + FinancialEntry::where('group_id', '=', $key->id)->get()->lists('entry','id')->all();
        }
        $ratioList = call_user_func_array('array_merge', $ratioTemp);
        $dimensionType = array(NULL => '','0' => 'Single','1' => 'Parent','2' => 'Hybrid');

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);

        $formaction = 'Admin\LiquidityModelAdminController@postSave';
        $sideTab = 'liquidityData';
        return view('admin.liquiditymodel.createedit',compact('sideTab','dimensionData','formaction', 'attributeStatus', 'chosenStatus','attributeIsApplicable', 'chosenIsApplicable','categoryId', 'chosenParentDimension',  'parentDimensionsList','ratioList','dimensionType', 'modelsList','removeMandatory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function postSave(Request $request)
    {
        $input = Input::all();
//        dd($input);
        $id = $input['id'];
        $categoryId = $input['category_id'];
        $data = null;
        if(isset($id)) {
            $data = LiquidityModelDimension::find($id);
        }
        $rules = array(
            'label' => 'required',
            'description' => '',
            'dimension_type' => 'required',
            'is_applicable' => 'required',
            'weight' => 'required|numeric',
            'is_trend' => 'required',
            'model' => 'required_if:is_trend,1',
            'attribute' => 'required_if:is_trend,1',
            'status' => 'required|numeric'
        );

        $this->validate($request, $rules);
        if($input['parent_dimension_id'] == '')
        {
            $input['parent_dimension_id'] = null;
        }
        if($input['ratio_id'] == '')
        {
            $input['ratio_id'] = null;
        }
        LiquidityModelDimension::updateOrCreate(array('id' => $id), $input);
        session()->flash('flash_message','Credit-Model Dimension Details were successfully saved!');

        $redirectPath = 'admin/liquiditymodel/dimensions/'.$categoryId;
        return Redirect::to($redirectPath)->withInput();
    }


    public function getEditCategory($id)
    {
        $categoryData = LiquidityModelCategory::find($id);
        $attributeStatus = MasterData::attributeStatus();
        $chosenStatus = $categoryData->status;

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);

        $formaction = 'Admin\LiquidityModelAdminController@postEditCategory';
        $sideTab = 'liquidityData';
        return view('admin.liquiditymodel.createeditcategory',compact('sideTab','categoryData','formaction','attributeStatus', 'chosenStatus','removeMandatory'));
    }

    public function getCreateCategory()
    {
        $categoryData = null;
        $attributeStatus = MasterData::attributeStatus();
        $chosenStatus = null;

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);

        $formaction = 'Admin\LiquidityModelAdminController@postEditCategory';
        //$formaction = '';
        $sideTab = 'liquidityData';
        return view('admin.liquiditymodel.createeditcategory',compact('sideTab','categoryData','formaction', 'attributeStatus', 'chosenStatus','removeMandatory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function postEditCategory(Request $request)
    {
        $input = Input::all();

        $id = $input['id'];
        $data = null;

        if(isset($id)) {
            $data = LiquidityModelCategory::find($id);
        }
        $rules = array(
            'label' => 'required',
            'description' => '',
            'weight' => 'required|numeric',
            'status' => 'required|numeric'
        );

        $this->validate($request, $rules);
        $input = $request->all();
//        dd($data);
        LiquidityModelCategory::updateOrCreate(array('id' => $id), $input);
        session()->flash('flash_message','Credit-Model Category Details were successfully saved!');

        $redirectPath = 'admin/liquiditymodel';
        return Redirect::to($redirectPath)->withInput();
    }

    public function getEditMeasures($id,$dimensionId,$categoryId)
    {
        $questionMeasureData = LiquidityModelMeasure::find($id);
        $attributeOperand = array(NULL => '') + array('=' => '=','!=' => '!=','<' => '<', '<=' => '<=', '>' => '>', '>=' => '>=','between' => 'Between');
        $chosenOperand = $questionMeasureData->operand;
        $attributeStatus = MasterData::attributeStatus();
        $chosenStatus = $questionMeasureData->status;

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);

        $formaction = 'Admin\LiquidityModelAdminController@postEditMeasure';
        $sideTab = 'liquidityData';
        return view('admin.liquiditymodel.createeditmeasure', compact('sideTab','formaction','dimensionId','categoryId','questionMeasureData','attributeStatus','chosenStatus','attributeOperand','chosenOperand','removeMandatory'));
    }

    public function getCreateMeasures($dimensionId,$categoryId)
    {
        $questionMeasureData = null;
        $attributeOperand = array(NULL => '') + array('=' => '=','!=' => '!=','<' => '<', '<=' => '<=', '>' => '>', '>=' => '>=','between' => 'Between');
        $chosenOperand = null;
        $attributeStatus = MasterData::attributeStatus();
        $chosenStatus = null;

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);

        $formaction = 'Admin\LiquidityModelAdminController@postEditMeasure';
        $sideTab = 'liquidityData';
        return view('admin.liquiditymodel.createeditmeasure', compact('sideTab','formaction','dimensionId','categoryId','questionMeasureData','attributeStatus','chosenStatus','attributeOperand','chosenOperand','removeMandatory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function postEditMeasure(Request $request)
    {
        $input = Input::all();
//        dd($input);
        $id = $input['id'];
        $data = null;

        if(isset($id)) {
            $data = LiquidityModelMeasure::find($id);
        }
        $rules = array(
            'label' => 'required',
            'description' => '',
            'measure' => 'required|numeric',
            'status' => 'required'
        );

        $this->validate($request, $rules);
        $input = $request->all();
        $creditMeasure = LiquidityModelMeasure::updateOrCreate(array('id' => $id), $input);
        if($input['operand'] == '')
        {
            $creditMeasure->operand = null;
            $creditMeasure->single_value = null;
            $creditMeasure->begin_range = null;
            $creditMeasure->end_range = null;
            $creditMeasure->save();
        }
        elseif(isset($creditMeasure) && strcmp($creditMeasure->operand,"between") == 0) {
            $creditMeasure->single_value = null;
            $creditMeasure->save();
        }
        else {
            $creditMeasure->begin_range = null;
            $creditMeasure->end_range = null;
            $creditMeasure->save();
        }

        session()->flash('flash_message','Credit-Model Measures Details were successfully saved!');

        $redirectPath = 'admin/liquiditymodel/measures/'.$input['dimension_id'].'/'.$input['categoryId'];
        return Redirect::to($redirectPath)->withInput();
    }

    public function getDeleteMeasures($id)
    {
        $creditMeasure = LiquidityModelMeasure::find($id);
        $creditMeasure->delete();
        session()->flash('flash_message','Deleted successfully!');
        return Redirect::back();
    }

    /**
     * @return array
     */
    protected function getDimensionsModelList()
    {
        $modelsList = [NULL => '',  Config::get('constants.CONST_BS_TABLE') => 'Balance Sheet',  Config::get('constants.CONST_BUSINESS_DETAILS_TABLE') => 'Business Details', Config::get('constants.CONST_LOANS_TABLE') => 'Loans', Config::get('constants.CONST_PL_TABLE') => 'Profit & Loss',  Config::get('constants.CONST_PROMOTER_DETAILS_TABLE') => 'Promoter Details', Config::get('constants.CONST_LOANS_SALESAREA_TABLE') => 'Loan Sales Area Details'];
        return $modelsList;
    }
}