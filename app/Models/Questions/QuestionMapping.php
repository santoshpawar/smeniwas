<?php

namespace App\Models\Questions;

use App\Models\Common\OperandComparison;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionMapping extends Model {

    use SoftDeletes;
    use OperandComparison;

    protected $table = "conf_question_mappings";
    protected $primaryKey = "id";

    protected $fillable = [
        'conf_question_id',
        'conf_field_id',
        'conf_condition_id',
        'operand',
        'single_value',
        'begin_range',
        'end_range',
        'status'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function configuredField(){
        return $this->hasOne('App\Models\Questions\ConfiguredField', 'id', 'conf_field_id')->where('status','=','1');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function configuredCondition(){
        return $this->hasOne('App\Models\Questions\ConfiguredCondition', 'id', 'conf_condition_id')->where('status','=','1');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function configuredQuestion(){
        return $this->hasOne('App\Models\Questions\ConfiguredQuestion', 'id', 'conf_question_id');
    }

    public function matches($loan = null, $userProfile = null){

        if(!isset($loan)){
            return false;
        }

        if(strcmp($this->configuredQuestion()->get()->first()->loan_type,$loan->type) !== 0){
            return false;
        }

        $field = $this->configuredField()->get()->first();

        $fieldName = $field->config_field_name;
        $fieldEntity = $field->field_entity;
        $targetValueType = $field->target_value_type;
        $operand = $this->operand;

        $userInputValue = null;

        if(strcmp($fieldEntity,"UserProfile") === 0) {
            if(isset($userProfile)) {
                $userInputValue = $userProfile->getAttribute($fieldName);
            }else{
                return false;
            }
        }else if(strcmp($fieldEntity,"Loan") === 0){
            if(isset($loan)) {
                $userInputValue = $loan->getAttribute($fieldName);
            }else{
                return false;
            }
        }

        if(!isset($userInputValue)){
            return false;
        }

        if(strcmp($targetValueType,"Single") === 0){
            return $this->checkAssignmentOperations($operand, $userInputValue, $this->single_value);
        }else if(strcmp($targetValueType,"Range") === 0){
            $beginRange = $this->begin_range;
            $endRange = $this->end_range;

            if(strcmp($operand,"between") === 0){
                if($beginRange <= $userInputValue && $userInputValue <= $endRange){
                    return true; //Successful match
                }else{
                    return false; //Did not match
                }
            }else if(strcmp($operand,"not between") === 0){
                if(!($beginRange <= $userInputValue && $userInputValue <= $endRange)){
                    return true; //Successful match
                }else{
                    return false; //Did not match
                }
            }else {
                return $this->checkAssignmentOperations($operand, $userInputValue, $this->single_value);
            }
        }

        return false;
    }

    /*
    protected function checkAssignmentOperations($operand, $userInputValue){
        if(strcmp($operand,"=") === 0){
            if(strcmp($userInputValue, $this->single_value) == 0){
                return true; //Successful match
            }else{
                return false; //Did not match
            }
        }else if(strcmp($operand,"!=") === 0){
            if(!strcmp($userInputValue, $this->single_value) === 0){
                return true; //Successful match
            }else{
                return false; //Did not match
            }
        }else if(strcmp($operand,">") === 0){
            if($userInputValue > $this->single_value){
                return true; //Successful match
            }else{
                return false; //Did not match
            }
        }else if(strcmp($operand,">=") === 0){
            if($userInputValue >= $this->single_value){
                return true; //Successful match
            }else{
                return false; //Did not match
            }
        }else if(strcmp($operand,"<") === 0){
            if($userInputValue < $this->single_value){
                return true; //Successful match
            }else{
                return false; //Did not match
            }
        }else if(strcmp($operand,"<=") === 0){
            if($userInputValue <= $this->single_value){
                return true; //Successful match
            }else{
                return false; //Did not match
            }
        }
    }*/

    public function getClause(){
        $clause = "";

        $field = null;
        if($this->configuredField) {
            $field = $this->configuredField;
        }else{
            $field = $this->configuredField()->get()->first();
        }

        $fieldName = $field->config_field_name;
        $fieldEntity = $field->field_entity;
        $targetValueType = $field->target_value_type;
        $operand = $this->operand;

        $clause = $this->getFormattedClause($fieldEntity, $fieldName, $targetValueType, $operand, $this->single_value, $this->begin_range, $this->end_range);

        return $clause;
    }
}
