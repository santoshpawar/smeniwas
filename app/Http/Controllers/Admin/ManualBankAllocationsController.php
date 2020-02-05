<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\BankMasterData;
use App\Models\Loan\Bankallocation\LoansBankAllocation;
use App\Models\Loan\Loan;
use DB;
use Input;
use Redirect;
use App\Models\MasterData;
use App\Helpers\validLoanUrlhelper;
use Auth;


class ManualBankAllocationsController extends BaseAdminController {

    public function __construct() {
        //This will ensure that all routes handled by this controller are first authenticated
        $this->middleware('auth');
    }

    /**
     * Display a listing of Bank Allocations.
     *
     * @return Response
     */
    public function getIndex(){
        $allocatedLoans = DB::table('loans_bank_allocations')
            ->join('loans', 'loans.id', '=', 'loans_bank_allocations.loan_id')
            ->join('bank_master_datas', 'bank_master_datas.id', '=', 'loans_bank_allocations.bank_id')
            ->select('loans.*', 'loans_bank_allocations.id as bank_allocation_id', 'bank_master_datas.name as bank_name', 'loans_bank_allocations.allocation_type as allocation_type')
            ->get();
              $sideTab = 'manBankAlloData';
        return view('admin.manualallocation.index',compact('sideTab','allocatedLoans'));
    }

    public function getDelete($bankAllocationId){
        LoansBankAllocation::destroy($bankAllocationId);
        return Redirect::to('admin/manualallocation');
    }

    public function getCreate(){
       $loansList = [NULL => ''] + Loan::where('status', '=', 22)->get()->lists('id', 'id')->all();
       $banksList = [NULL => ''] + BankMasterData::where('status','=', 1)->get()->lists('name','id')->all();

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);
         $sideTab = 'manBankAlloData';
       $formaction = 'Admin\ManualBankAllocationsController@postCreate';
       return view('admin.manualallocation.create',compact('sideTab','loansList','banksList','formaction','removeMandatory'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function postCreate(Request $request)
    {
        $rules = array(
            'loan_id' => 'required|unique:loans_bank_allocations,loan_id,NULL,id,bank_id,' . Input::get('bank_id'),
            'bank_id' => 'required',
        );
        $this->validate($request, $rules);
        $input = Input::all();
        LoansBankAllocation::updateOrCreate(['id' => null], $input);
        session()->flash('flash_message','Manual Bank Allocation Details were successfully saved!');
        return Redirect::to('admin/manualallocation');
    }
}