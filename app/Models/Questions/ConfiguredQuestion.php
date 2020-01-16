<?php

namespace App\Models\Questions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConfiguredQuestion extends Model {

    use SoftDeletes;

    public $table = "conf_questions";

    protected $fillable = [
        'conf_master_id',
        'loan_type',
        'status',
    ];
    protected $dates = ['deleted_at'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function questionMaster(){
        return $this->hasOne('App\Models\Questions\MasterQuestion', 'id', 'conf_master_id')->where('status','=','1');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questionMappings(){
       // return $this->hasMany('App\Models\Questions\QuestionMapping', 'conf_question_id', 'id')->where('status','=','1')->get();
        return $this->hasMany('App\Models\Questions\QuestionMapping', 'conf_question_id', 'id')->where('status','=','1');
    }

    public function isQuestionRemoved($loan, $userProfile=null){
        $isQuestionRemoved = false;
        $mappings = null;
        if($this->questionMappings){
            $mappings = $this->questionMappings;
        }else {
            $mappings = $this->questionMappings()->get();
        }
        $conditionsStore = new Collection();

        foreach($mappings as $mapping ){
            $doesMappingMatch = $mapping->matches($loan, $userProfile);
            $fieldId = $mapping->conf_field_id;
            $conditionId = $mapping->conf_condition_id;

            $fieldsStore = null;
            if($conditionsStore->offsetExists($conditionId)){
                $fieldsStore = $conditionsStore->offsetGet($conditionId);
            }else{
                $fieldsStore = new Collection();
                $conditionsStore->offsetSet($conditionId, $fieldsStore);
            }

            if($fieldsStore->offsetExists($fieldId)) {
                if ($fieldsStore->offsetGet($fieldId) === false && $doesMappingMatch) {
                    $fieldsStore->offsetSet($fieldId, $doesMappingMatch);
                }
            }else{
                $fieldsStore->offsetSet($fieldId, $doesMappingMatch);
            }
        }

        foreach($conditionsStore as $condition){
            if(!$condition->contains(false) && $condition->count() > 0){
                $isQuestionRemoved = true;
                break;
            }
        }

        //$isQuestionRemoved = (!$conditionsStore->contains(false) && $conditionsStore->count()>0);
        return $isQuestionRemoved;
    }
}