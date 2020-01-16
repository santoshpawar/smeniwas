<?php

namespace App\Http\Controllers\Pdf;


use App\Http\Controllers\Controller;
use App\Models\Address;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use App\Models\Roles;
use PDF;
use Auth;
use App\Models\MasterData;
use App\Helpers\validLoanUrlhelper;


/**
 * Class ReportController
 *
 * @package App\Http\Controllers\Pdf
 */
class ReportController extends controller{

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

    public function getIndex(Request $request){

        $formaction = 'Pdf\ReportController@postIndex';
//        $role = \Cartalyst\Sentinel\Roles\EloquentRole::where('slug','=','SME')->get()->first();
        $role = Roles::where('slug','=','SME')->get()->first();
        $users = array(NULL => '') + $role->users()->get()->lists('email', 'id')->all();

        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory,['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser,$isRemoveMandatory);

        return view('reports.search_report', compact('users','formaction','removeMandatory'));
    }

    public function postIndex(Request $request){

        $input = Input::all();

        $rules = array(
            'user' => 'required'
        );

        $this->validate($request, $rules);
        if (count($input['user']) > 1) {
            foreach ($input['user'] as $user_id) {
                if($user_id != '') {
                    $user = User::where('id', '=', $user_id)->get()->first();
                    $user_profile = UserProfile::where('user_id', '=', $user_id)->get()->first();

                    if(isset($user_profile) && count($user_profile) > 0) {

                        $userPan[] = $user_profile->owner_name;
                        $companyNature[] = $user_profile->name_of_firm;
                        $entityType[] = $user_profile->owner_entity_type;
                        $address[] = $user_profile->address;
                        $city[] = $user_profile->owner_city;
                        $state[] = $user_profile->owner_state;
                        $pincode[] = $user_profile->pincode;
                        $phone[] = $user_profile->contact1;
                        $latestTurnover[] = $user_profile->latest_turnover;
                        $requiredAmount[] = $user_profile->required_amount;
                        $emailId[] = $user->email;
                    }
                    else {
                        $userPan[] = null;
                        $companyNature[] = null;
                        $entityType[] = null;
                        $address[] = null;
                        $city[] = null;
                        $state[] = null;
                        $pincode[] = null;
                        $phone[] = null;
                        $latestTurnover[] = null;
                        $requiredAmount[] = null;
                        $emailId[] = null;
                    }

                }
            }

            $paramsArr = ['userPan' => $userPan,
                'companyNature' => $companyNature,
                'entityType' =>$entityType,
                'address' => $address,
                'city' => $city,
                'state' => $state,
                'pincode' => $pincode,
                'phone' => $phone,
                'latestTurnover' => $latestTurnover,
                'requiredAmount' => $requiredAmount,
                'emailId' => $emailId,
            ];
            $pdfFileName = "sme_report.pdf";
            return PDF::loadView('reports.sme_report', $paramsArr)->download($pdfFileName);
//            return view('reports.sme_report',$paramsArr);
        }
        else {
            return \Redirect::back();
        }
    }
}