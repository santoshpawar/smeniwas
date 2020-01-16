<?php

namespace App\Http\Controllers\Admin;

use App\Models\Questions\MasterQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Models\Questions\ConfiguredQuestion;
use App\Models\Questions\QuestionMapping;
use App\Models\Questions\ConfiguredField;
use App\Models\Questions\ConfiguredCondition;
use App\Models\MasterData;
use App\Helpers\FormatHelper;
use App\Helpers\validLoanUrlhelper;
use Auth;


class QuestionsAdminController extends BaseAdminController {


    public function __construct() {
        //This will ensure that all routes handled by this controller are first authenticated
        $this->middleware('auth');
    }

    public function getIndex(){
        $masterQuestions = MasterQuestion::all();
        $currentUser = Auth::user();
         $sideTab = 'quesData';
        return view('admin.questions.index', compact('currentUser','masterQuestions','sideTab'));
    }

    public function getConfiguredQuestion($masterQuestionId){
        $configuredQuestion = ConfiguredQuestion::where('conf_master_id','=',$masterQuestionId)->get();
//        dd(FormatHelper::formatLoanType($configuredQuestion[0]->loan_type));
         $sideTab = 'quesData';
        return view('admin.questions.configuredquestions', compact('masterQuestionId','sideTab','configuredQuestion'));
    }

    public function getMappings($confQuestionId,$masterQuestionId){
        $mappings = QuestionMapping::with('configuredField','configuredCondition')->where('conf_question_id','=',$confQuestionId)->get();//
         $sideTab = 'quesData';
        return view('admin.questions.questionmappings', compact('confQuestionId','sideTab','mappings','masterQuestionId'));
    }

    /**
     * Datasource for the master questions Data Grid.
     *
     * @return \Cartalyst\DataGrid\DataGrid
     */
    public function getMasterQuestionsGrid()
    {
        $columns = [
            'id',
            'questionnumber',
            'question_label',
            'category_label',
            'status',
        ];

        $settings = [
            'sort'      => 'questionnumber',
            'direction' => 'asc',
            'max_results' => 10,
            'threshold'	  => 5,
            'throttle' => 5,
        ];

        $masterQuestions = MasterQuestion::all();

        $transformer = function($element)
        {
            $element['view_uri'] = url("/admin/questions/configured-question/{$element['id']}");

            return $element;
        };

        return DataGrid::make($masterQuestions, $columns, $settings, $transformer);
    }

    /**
     * Datasource for the configured questions Data Grid.
     *
     * @return \Cartalyst\DataGrid\DataGrid
     */
    public function getConfiguredQuestionsGrid($masterQuestionId)
    {
        $columns = [
            'id',
            'loan_type',
            'status',
        ];

        $settings = [
            'sort'      => 'loan_type',
            'direction' => 'asc',
            'max_results' => 10,
            'threshold'	  => 5,
            'throttle' => 5,
        ];

        $configuredQuestion = ConfiguredQuestion::where('conf_master_id','=',$masterQuestionId)->get();

        $transformer = function($element)
        {
            $element['view_uri'] = url("/admin/questions/mappings/{$element['id']}");

            return $element;
        };

        return DataGrid::make($configuredQuestion, $columns, $settings, $transformer);
    }

    /**
     * Datasource for the question mappings Data Grid.
     *
     * @return \Cartalyst\DataGrid\DataGrid
     */
    public function getQuestionMappingGrid($confQuestionId)
    {
        $columns = [
            'id',
            'condition_name',
            'field_name',
            'clause',
            'status',
        ];

        $settings = [
            'sort'      => 'id',
            'direction' => 'asc',
            'max_results' => 10,
            'threshold'	  => 5,
            'throttle' => 5,
        ];

        $mappings = QuestionMapping::with('configuredField','configuredCondition')->where('conf_question_id','=',$confQuestionId)->where('status','=',1)->get();

        $transformedMappings = $mappings->map(function ($mapping){
            $fieldName = $mapping->configuredField->config_field_name;
            $conditionName = $mapping->configuredCondition->config_condition_name;
            $clause = $mapping->getClause();
            //$subsetArr = $mapping->lists('id','operand','single_value','begin_range','end_range','status');
            $subsetArr = array(
                "id" => $mapping->id,
                "field_name" => $fieldName,
                "condition_name" => $conditionName,
                "clause" => $clause,
                "status" => $mapping->status
            );
               // dd($subsetArr);
            return $subsetArr;
        });

        //dd($transformedMappings);
        /*
        $transformer = function($element)
        {
            $element['view_uri'] = url("/admin/questions/details/{$element['id']}");

            return $element;
        };*/

        return DataGrid::make($transformedMappings, $columns, $settings);
    }

    /**
     * @param $id
     * @return Response
     */
    public function getEdit($id,$masterQuestionId){
        $questionData = ConfiguredQuestion::find($id);
        $attributeQuestion = array(NULL => '') + MasterQuestion::get()->lists('question_label', 'id')->all();
        $chosenQuestion = MasterQuestion::where('id','=',$questionData->conf_master_id)->get()->first();
        $attributeStatus = MasterData::attributeStatus();
        $chosenStatus = $questionData->status;
        $attributeLoanProductType = MasterData::loanProductType();
        $chosenLoanProductType = $questionData->loan_type;

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);

        $formaction = 'Admin\QuestionsAdminController@postEdit';
         $sideTab = 'quesData';
        return view('admin.questions.createeditquestion', compact('formaction','sideTab','masterQuestionId','questionData','attributeStatus','chosenStatus','attributeQuestion','chosenQuestion','attributeLoanProductType','chosenLoanProductType','removeMandatory'));
    }

    public function getCreate($masterQuestionId){
        $questionData = null;
        $attributeQuestion = array(NULL => '') + MasterQuestion::get()->lists('question_label', 'id')->all();
        $chosenQuestion = null;
        $attributeStatus = MasterData::attributeStatus();
        $chosenStatus = null;
        $attributeLoanProductType = MasterData::loanProductType();
        $chosenLoanProductType = null;

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);

        $formaction = 'Admin\QuestionsAdminController@postEdit';
         $sideTab = 'quesData';
        return view('admin.questions.createeditquestion', compact('formaction','sideTab','masterQuestionId','questionData','attributeStatus','chosenStatus','attributeQuestion','chosenQuestion','attributeLoanProductType','chosenLoanProductType','removeMandatory'));
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
        if(!isset($id)) {
            $rules = array(
                'conf_master_id' => 'required',
                'loan_type' => 'required',
                'status' => 'required'
            );
        }
        else {
            $rules = array(
                'loan_type' => 'required',
                'status' => 'required'
            );
        }

        $this->validate($request, $rules);

        if(!isset($id)) {
            $questionFind = ConfiguredQuestion::where('conf_master_id', '=', $input['conf_master_id'])->where('loan_type', '=', $input['loan_type'])->get();
            if (isset($questionFind) && count($questionFind) > 0) {
                return Redirect::back()->withErrors('The entry already exist.')->withInput();
            }
        }
        else
        {
            $questionFind = ConfiguredQuestion::where('conf_master_id', '=', $input['conf_master_id'])->where('loan_type', '=', $input['loan_type'])->where('id', '!=',$id)->get();
            if (isset($questionFind) && count($questionFind) > 0) {
                return Redirect::back()->withErrors('The entry already exist.')->withInput();
            }
        }
        $input = $request->all();
        $question = ConfiguredQuestion::updateOrCreate(array('id' => $id), $input);

        session()->flash('flash_message','Successfully saved!');
        $redirectPath = 'admin/questions/configured-question/'.$input['conf_master_id'];
        return Redirect::to($redirectPath)->withInput();
    }

    public function getDelete($id)
    {
        $questionData = ConfiguredQuestion::find($id);
        if(count($questionData->questionMappings()->get()) == 0) {
            $questionData->delete();
            session()->flash('flash_message','Deleted successfully!');
            return Redirect::back();
        }
        else
        {
            return Redirect::back()->withErrors('Some question mappings are associated with the related question.The question can not be deleted.');
        }
    }

    /**
     * @param $id
     * @return Response
     */
    public function getEditMappings($id,$confQuestionId,$masterQuestionId){
        $questionMappingData = QuestionMapping::find($id);
        $attributeConfField = array(NULL => '') + ConfiguredField::get()->lists('config_field_name', 'id')->all();
        $chosenConfField = $questionMappingData->config_field_name;
        $attributeConfCondition = array(NULL => '') + ConfiguredCondition::get()->lists('config_condition_name', 'id')->all();
        $chosenConfCondition = $questionMappingData->config_condition_name;
        $attributeOperand = array(NULL => '') + array('=' => '=','!=' => '!=','<' => '<', '<=' => '<=', '>' => '>', '>=' => '>=','between' => 'Between');
        $chosenOperand = $questionMappingData->operand;
        $attributeStatus = MasterData::attributeStatus();
        //$chosenQuestion = MasterQuestion::where('id','=',$masterQuestionId)->get()->first();

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);

        $chosenStatus = null;

        $formaction = 'Admin\QuestionsAdminController@postEditMappings';
         $sideTab = 'quesData';
        return view('admin.questions.createeditquestionmappings', compact('formaction','sideTab','questionMappingData','masterQuestionId','confQuestionId','attributeStatus','chosenStatus','attributeConfField','chosenConfField','attributeConfCondition','chosenConfCondition','attributeOperand','chosenOperand','removeMandatory'));
    }

    public function getCreateMappings($confQuestionId,$masterQuestionId){
        $questionMappingData = null;
        $attributeConfField = array(NULL => '') + ConfiguredField::get()->lists('config_field_name', 'id')->all();
        $chosenConfField = null;
        $attributeConfCondition = array(NULL => '') + ConfiguredCondition::get()->lists('config_condition_name', 'id')->all();
        $chosenConfCondition = null;
        $attributeOperand = array(NULL => '') + array('=' => '=','!=' => '!=','<' => '<', '<=' => '<=', '>' => '>', '>=' => '>=','between' => 'Between');
        $chosenOperand = null;
        $attributeStatus = MasterData::attributeStatus();
        //$chosenQuestion = MasterQuestion::where('id','=',$masterQuestionId)->get()->first();
        $chosenStatus = null;

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);
          $sideTab = 'quesData';
        $formaction = 'Admin\QuestionsAdminController@postEditMappings';
        return view('admin.questions.createeditquestionmappings', compact('formaction','sideTab','questionMappingData','masterQuestionId','confQuestionId','attributeStatus','chosenStatus','attributeConfField','chosenConfField','attributeConfCondition','chosenConfCondition','attributeOperand','chosenOperand','removeMandatory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function postEditMappings(Request $request){
        $input = Input::all();
//        dd($input);
        $id = $input['id'];

        $rules = array(
                'conf_field_id' => 'required',
                'conf_condition_id' => 'required',
                'operand' => 'required',
                'single_value' => 'numeric|required_if:operand,=|required_if:operand,!=|required_if:operand,<|required_if:operand,<=|required_if:operand,>|required_if:operand,>=',
                'begin_range' => 'numeric|required_if:operand,between',
                'end_range' => 'numeric|required_if:operand,between',
                'status' => 'required'
        );

        $this->validate($request, $rules);

        $input = $request->all();
        $questionMapping = QuestionMapping::updateOrCreate(array('id' => $id), $input);
        if(isset($questionMapping) && strcmp($questionMapping->operand,"between") == 0) {
            $questionMapping->single_value = null;
            $questionMapping->save();}
        else {
            $questionMapping->begin_range = null;
            $questionMapping->end_range = null;
            $questionMapping->save();
        }

        session()->flash('flash_message','Successfully saved!');
        $redirectPath = 'admin/questions/mappings/'.$input['conf_question_id'].'/'.$input['masterQuestionId'];
        return Redirect::to($redirectPath)->withInput();
    }

    public function getDeleteMappings($id)
    {
        $questionMapping = QuestionMapping::find($id);
        $questionMapping->delete();
        session()->flash('flash_message','Deleted successfully!');
        return Redirect::back();
    }


}