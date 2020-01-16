<?php

namespace App\Helpers\Ratios;


class ExpressionValue {

    protected $entryId;
    protected $expressionModelName;
    protected $expressionAttributeName;
    protected $expressionValue;
    protected $isPercentage;
    protected $threshold;
    protected $thresholdCondition;
    protected $isInvalidExpression;
    protected $isCombinedThreshold;

    public function __construct($entryId, $expressionModelName, $expressionAttributeName, $expressionValue, $isPercentage=false, $thresholdCondition=null, $threshold=null, $isInvalidExpression = false, $isCombinedThreshold = false){
        $this->entryId = $entryId;
        $this->expressionModelName = $expressionModelName;
        $this->expressionAttributeName = $expressionAttributeName;
        $this->expressionValue = $expressionValue;
        $this->isPercentage = $isPercentage;
        $this->thresholdCondition = $thresholdCondition;
        $this->threshold = $threshold;
        if(isset($isInvalidExpression)) {
            $this->isInvalidExpression = $isInvalidExpression;
        }else{
            $this->isInvalidExpression = false;
        }

        $this->isCombinedThreshold = $isCombinedThreshold;
    }

    public function getEntryId(){
        return $this->entryId;
    }

    public function getModelName(){
        return $this->expressionModelName;
    }

    public function getAttributeName(){
        return $this->expressionAttributeName;
    }

    public function getValue(){
        return $this->expressionValue;
    }

    public function hasThreshold(){
        return isset($this->threshold) && isset($this->thresholdCondition);
    }

    public function isThresholdBreached(){

        if(!$this->hasThreshold()){//threshold is not breached if it is not set
            return false;
        }

        if($this->isCombinedThreshold){

            if($this->isInvalidExpression()){
                return true;
            }


            if($this->getValue()){
                return true;
            }else{
                return false;
            }
        }

        if(strcmp($this->thresholdCondition,"=") === 0){
            if(strcmp($this->threshold, $this->expressionValue) == 0){
                return true; //Successful match
            }else{
                return false; //Did not match
            }
        }else if(strcmp($this->thresholdCondition,"!=") === 0){
            if(!strcmp($this->threshold, $this->expressionValue) === 0){
                return true; //Successful match
            }else{
                return false; //Did not match
            }
        }else if(strcmp($this->thresholdCondition,">") === 0){
            if($this->expressionValue > $this->threshold){
                return true; //Successful match
            }else{
                return false; //Did not match
            }
        }else if(strcmp($this->thresholdCondition,">=") === 0){
            if($this->expressionValue >= $this->threshold){
                return true; //Successful match
            }else{
                return false; //Did not match
            }
        }else if(strcmp($this->thresholdCondition,"<") === 0){
            if($this->expressionValue < $this->threshold){
                return true; //Successful match
            }else{
                return false; //Did not match
            }
        }else if(strcmp($this->thresholdCondition,"<=") === 0){
            if($this->expressionValue <= $this->threshold){
                return true; //Successful match
            }else{
                return false; //Did not match
            }
        }
    }

    public function isInvalidExpression(){
        return $this->isInvalidExpression;
    }
}