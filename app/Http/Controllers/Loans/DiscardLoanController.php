<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/22/2015
 * Time: 3:58 PM
 */

namespace App\Http\Controllers\Loans;


use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Models\Loan\Loan;
use Input;

class DiscardLoanController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Response
     * @internal param $loanId
     */

    public function discardLoan(){
        $loanId = Input::get('loan_id');
        $loan_status = Input::get('loan_status');
        //echo "Loan id : ".$loanId." "."Loan Status : ".$loan_status;
        if(isset($loanId)){
            $loans = Loan::find($loanId);
            if(isset($loans)) {
                $updatedLoan = Loan::where('id', $loanId)->update(array('loan_disable' => 'Y'));
                echo $updatedLoan;
                if($updatedLoan){
                    echo "successfully discarded";
                }else{
                    echo "oops somthing went wrong!!";
                }
            }
        }
    }
}