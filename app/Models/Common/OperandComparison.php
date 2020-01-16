<?php

namespace App\Models\Common;


trait OperandComparison {
    public function checkAssignmentOperations($operand, $userInputValue, $single_value){
        if(strcmp($operand,"=") === 0){
            if(strcmp($userInputValue, $single_value) == 0){
                return true; //Successful match
            }else{
                return false; //Did not match
            }
        }else if(strcmp($operand,"!=") === 0){
            if(!strcmp($userInputValue, $single_value) === 0){
                return true; //Successful match
            }else{
                return false; //Did not match
            }
        }else if(strcmp($operand,">") === 0){
            if($userInputValue > $single_value){
                return true; //Successful match
            }else{
                return false; //Did not match
            }
        }else if(strcmp($operand,">=") === 0){
            if($userInputValue >= $single_value){
                return true; //Successful match
            }else{
                return false; //Did not match
            }
        }else if(strcmp($operand,"<") === 0){
            if($userInputValue < $single_value){
                return true; //Successful match
            }else{
                return false; //Did not match
            }
        }else if(strcmp($operand,"<=") === 0){
            if($userInputValue <= $single_value){
                return true; //Successful match
            }else{
                return false; //Did not match
            }
        }
    }

    /**
     * @param $fieldEntity
     * @param $fieldName
     * @param $targetValueType
     * @param $operand
     * @return string
     */
    protected function getFormattedClause($fieldEntity, $fieldName, $targetValueType, $operand, $single_value, $begin_range, $end_range)
    {
        $clause = $fieldEntity . "." . $fieldName;

        if (strcmp($targetValueType, "Single") === 0) {
            $clause = $clause . " " . $operand . " " . $single_value;
            return $clause;
        } else {
            if ((strcmp($operand, "between") === 0) || (strcmp($operand, "not between") === 0)) {
                $clause = $clause . " " . $operand . " (" . $begin_range . " AND " . $end_range . ") ";
                return $clause;
            } else {
                $clause = $clause . " " . $operand . " " . $single_value;
                return $clause;
            }
        }
    }
}