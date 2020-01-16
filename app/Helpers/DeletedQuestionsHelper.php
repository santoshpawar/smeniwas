<?php

namespace App\Helpers;

use Illuminate\Support\Collection;
use App\Models\Questions\ConfiguredQuestion;

class DeletedQuestionsHelper {

    protected $loan;
    protected $deletedQuestionsMap;
    protected $validQuestionsMap;
    protected $isDisabled;

    public function __construct($loan) {
        $this->loan = $loan;
        $this->deletedQuestionsMap = new Collection();
        $this->validQuestionsMap = new Collection();
        $this->isDisabled = false;
        $this->calculateDeletedQuestions();
    }

    protected function calculateDeletedQuestions(){

        if(!$this->isValidData()){
            return;
        }

        $allLoanConfiguredQuestions = ConfiguredQuestion::with('questionMaster','questionMappings')->where('status','=',1)->where('loan_type','=',$this->loan->type)->get();

        foreach($allLoanConfiguredQuestions as $configuredQuestion){
            if($configuredQuestion->isQuestionRemoved($this->loan)){
                $this->deletedQuestionsMap->offsetSet($configuredQuestion->questionMaster->questionnumber, $configuredQuestion);
            }else{
                $this->validQuestionsMap->offsetSet($configuredQuestion->questionMaster->questionnumber, $configuredQuestion);
            }
        }
    }

    public function isQuestionRemoved($questionNumber){
        return $this->deletedQuestionsMap->has($questionNumber);
    }

    public function isQuestionValid($questionNumber){
        return !$this->isQuestionRemoved($questionNumber);
        /*
        if($this->validQuestionsMap->count() > 0) {
            return $this->validQuestionsMap->has($questionNumber);
        }else {
            return true;
        }*/
    }

    public function getDeletedQuestionNumbers(){
        return $this->deletedQuestionsMap->keys();
    }

    public function getValidQuestionNumbers(){
        return $this->validQuestionsMap->keys();
    }

    protected function isValidData(){
        if(isset($this->loan) && !$this->isDisabled){
            return true;
        }else{
            return false;
        }
    }
}