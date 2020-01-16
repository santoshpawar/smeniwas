<?php
namespace App\Models\Questions;

use Illuminate\Database\Eloquent\Model;

class MasterQuestion extends Model {

    public $table = "conf_question_masters";

    public function getConfiguredQuestions(){
        return $this->hasMany('App\Models\Questions\ConfiguredQuestion','conf_master_id','id')->get();
    }
}