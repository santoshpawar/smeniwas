<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/2/2015
 * Time: 4:09 PM
 */

namespace App\Helpers;
use App\Models\Loan\Loan;



class UploadDocHelper {
    protected $loan;
    protected $isMandatory;

    public function __construct($loan) {
        $this->loan = $loan;
        $this->isMandatory = false;
    }

    public function isMandatory($name,$value)
    {
        $loanId = null;
        $loan = null;
        $loan = $this->loan;
        if (isset($loan)) {
            $loanId = $this->loan->id;
            $model = null;
            $model = $this->loan->getSecurityDetails()->get()->first();
            if (isset($model)) {
                $model = $model->toArray();
                foreach ($model as $key => $val) {
                    if ($val == $value && $val != '0') {
                        $this->isMandatory = true;
                        break;
                    } else {
                        $this->isMandatory = false;
                    }
                }
            }
            return $this->isMandatory;
        }
    }

}