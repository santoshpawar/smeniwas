<?php

namespace App\Helpers;


class AnalystModelRatingHelper {

    protected $ratingModel;
    protected $analystModelsCategoriesList;

    public function __construct($ratingModel, $analystModelsCategoriesList){
        $this->ratingModel = $ratingModel;
        $this->analystModelsCategoriesList = $analystModelsCategoriesList;
    }

    public function merge(){
        foreach ($this->ratingModel->ratingDetails as $record) {
            $dimensionId = $record->dimension_id;
        }
    }

    protected function mergeRecord($record){
        foreach($this->analystModelsCategoriesList as $model){

        }
    }
}