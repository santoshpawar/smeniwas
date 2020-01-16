<?php

namespace App\Helpers;


class LiquidityModelRatingHelper {

    protected $ratingModel;
    protected $liquidityModelsCategoriesList;

    public function __construct($ratingModel, $liquidityModelsCategoriesList){
        $this->ratingModel = $ratingModel;
        $this->liquidityModelsCategoriesList = $liquidityModelsCategoriesList;
    }

    public function merge(){
        foreach ($this->ratingModel->ratingDetails as $record) {
            $dimensionId = $record->dimension_id;
        }
    }

    protected function mergeRecord($record){
        foreach($this->liquidityModelsCategoriesList as $model){

        }
    }
}