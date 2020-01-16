<?php
namespace App\Models\faker;
use Illuminate\Support\Facades\Config;

class LoansFaker extends \Faker\Provider\Base
{
//    public function loan_application_id($nbWords = 5){
//        /*
//        $sentence = $this->generator->randomLetter($nbWords);
//        return substr($sentence, 0, strlen($sentence) - 1);
//        */
//        return md5(uniqid(rand(), true));
//    }

    public function type($nbWords = 5){
        return $this->generator->randomElement([Config::get('constants.CONST_LOAN_TYPE_CC'), Config::get('constants.CONST_LOAN_TYPE_STL'), Config::get('constants.CONST_LOAN_TYPE_LAP'), Config::get('constants.CONST_LOAN_TYPE_UBL'), Config::get('constants.CONST_LOAN_TYPE_EFL'), Config::get('constants.CONST_LOAN_TYPE_VF'), Config::get('constants.CONST_LOAN_TYPE_CSCF')]);
    }

    public function status($nbWords = 5){
//        return $this->generator->randomElement(['Pending','Rejected','Approved']);
        //return $this->generator->randomElement(['1','2','3','4','5']);
        return $this->generator->randomElement(['1']);
    }

    public function promoter_generation_type($nbWords = 5){
        return $this->generator->randomElement(['1st Generation','2nd Generation','3rd or More Generation']);
    }

    public function promoter_background($nbWords = 5){
        return $this->generator->randomElement(['Professionals',' Technocrats','Business Family']);
    }

    public function loan_amount($nbWords = 5){
        return $this->generator->numberBetween(1, 500);
    }

    public function loan_tenure($nbWords = 5){
        return $this->generator->numberBetween(1, 10);
    }

    public function end_use($nbWords = 5){
        return $this->generator->randomElement([Config::get('constants.CONST_END_USE_FI'), Config::get('constants.CONST_END_USE_FD'), Config::get('constants.CONST_END_USE_PV'), Config::get('constants.CONST_END_USE_PE'), Config::get('constants.CONST_END_USE_PP'), Config::get('constants.CONST_END_USE_MRMP')
            ,Config::get('constants.CONST_END_USE_MFAP'),Config::get('constants.CONST_END_USE_STAPCFP'),Config::get('constants.CONST_END_USE_CE'),Config::get('constants.CONST_END_USE_BRECP'),Config::get('constants.CONST_END_USE_PPE'),Config::get('constants.CONST_END_USE_LTW')]);
    }
}