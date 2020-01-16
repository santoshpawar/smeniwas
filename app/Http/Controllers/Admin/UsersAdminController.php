<?php

/**
 * Created by PhpStorm.
 * User: BV111601
 * Date: 4/20/2015
 * Time: 11:46 PM
 */

namespace App\Http\Controllers\Admin;

use App\Models\BankMasterData;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Models\Roles;
use App\Models\MasterData;
use App\Helpers\validLoanUrlhelper;
use DB;

class UsersAdminController extends BaseAdminController {

    public function __construct() {
        //This will ensure that all routes handled by this controller are first authenticated
        $this->middleware('auth');
    }

    public function getIndex() {
        $currentUser = Auth::user();
        $users= User::all(); 
        $users = User::with('roles')->with('MobileAppDataDetail');
        $users = $users->with('getRefereedUserDetail')->get();
        $roles = DB::table('roles')->lists('name', 'id');
        $subViewType='admin.users._user';
      
         $sideTab = 'userData';
        return view('admin.users.index', compact('currentUser', 'users', 'roles','subViewType','sideTab'));
    }

    /**
     * Datasource for the users Data Grid.
     *
     * @return \Cartalyst\DataGrid\DataGrid
     */
    public function getGrid() {
        $columns = [
            'id',
            'email',
            'username',
            'created_at' => 'created_at',
        ];

        $settings = [
            'sort' => 'created_at',
            'direction' => 'desc',
        ];

        $users = User::all();

        $transformer = function($element) {
            $element['edit_uri'] = url("/admin/users/edit/{$element['id']}");

            return $element;
        };

        return DataGrid::make($users, $columns, $settings, $transformer);
        //return datagrid($this->users->grid(), $columns, $settings, $transformer);
    }

    /**
     * @param $id
     * @return Response
     */
    public function getEdit($id) {

        $mobileAppEmail = [];
        $user = User::find($id);


        $userProfile = $user->userProfile();

//        $roles = DB::table('roles')
//            ->where('slug', '<>', 'SME')
//            ->where('slug', '<>', 'CP')->lists('name','id');
        $roles = DB::table('roles')->lists('name', 'id');
        $userRoles = $user->roles()->get()->lists('id')->all();

        $bankName = array(NULL => '') + DB::table('bank_master_datas')
                        ->where('status', '=', '1')->lists('name', 'id');
        $chosenBankName = null;
        if (isset($user)) {
            $chosenBankName = $user->bank_id;
        }
        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory, ['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser, $isRemoveMandatory);


        if (isset($user)) {
            $userID = $user->id;
            $userEmail = $user->email;
        }
        if (isset($userID)) {
            $mobileAppEmail = DB::table('mobile_app_data')->where('Email', $userEmail)
                    ->first();
        }
        //  print_r($mobileAppEmail); die;
//        dd($userRoles,$chosenBankName);


        $formaction = 'Admin\UsersAdminController@postEdit';
        $subViewType = 'admin.users._user';
          $sideTab = 'userData';
        return view('admin.users.createedit', compact('formaction', 'subViewType', 'sideTab','user', 'roles', 'userRoles', 'bankName', 'chosenBankName', 'removeMandatory', 'userProfile', 'mobileAppEmail'));
    }

    public function getCreate() {
        $user = null;

        // $roles = DB::table('roles')
        //                 ->where('slug', '<>', 'SME')
        //                 ->where('slug', '<>', 'CP')->lists('name', 'id');

            $roles = DB::table('roles')->lists('name', 'id');
//        $roles = \Cartalyst\Sentinel\Roles\EloquentRole::all()->lists('name','id')->all();
//        $bankName = DB::table('bank_master_datas')->lists('name');
        $bankName = array(NULL => '') + DB::table('bank_master_datas')
                        ->where('status', '=', '1')->lists('name', 'id');
        $chosenBankName = null;
        $forUser = Auth::getUser();
        $isRemoveMandatory = MasterData::removeMandatory();
        $isRemoveMandatory = array_except($isRemoveMandatory, ['']);
        $removeMandatoryHelper = new validLoanUrlhelper();
        $removeMandatory = $removeMandatoryHelper->getMandatory($forUser, $isRemoveMandatory);

        $userRoles = null;
        $formaction = 'Admin\UsersAdminController@postEdit';
        $subViewType = 'admin.users._user';
          $sideTab = 'userData';
        return view('admin.users.createedit', compact('formaction', 'subViewType','sideTab', 'user', 'roles', 'userRoles', 'bankName', 'chosenBankName', 'removeMandatory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function postEdit(Request $request) {
        $input = Input::all();
//        dd($input);
        $id = $input['id'];
        if (isset($id)) {
            $user = User::find($id);
        }

        $rules = array(
            'username' => 'required|alpha_num|unique:users,username,' . $id,
            'password' => 'required|alpha_num|confirmed|min:6',
            'email' => 'required|email|unique:users,email,' . $id,
            'roles' => 'required',
//            'bank_id' => 'required_with:roles,6'
        );

        $this->validate($request, $rules);

        $formUserRolesArr = $input['roles'];

        $input = $request->all();

        foreach ($formUserRolesArr as $value) {
            if ($value == '6') {
                if (isset($input['bank_id']) && $input['bank_id'] == '') {
                    return Redirect::back()->withErrors('The bank name field is required.')->withInput();
                }
            }
        }
        if (isset($input['bank_id']) && $input['bank_id'] == '') {
            $input['bank_id'] = null;
        }
        $input['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
        $user = User::updateOrCreate(array('id' => $id), $input);

        $dbUserRolesArr = $user->roles()->get()->lists('id')->all();

        //Find out the additional values which are present in the DB, but not in the newly saved form. These values need to be deleted.
        $toDeleteDBValuesArr = array_diff($dbUserRolesArr, $formUserRolesArr);
        //Find out the extra values which are present in the newly saved form. These values need to be inserted
        $newFormValuesArr = array_diff($formUserRolesArr, $dbUserRolesArr);

//        dd($dbUserRolesArr);

        foreach ($newFormValuesArr as $roleId) {
//            $role = Sentinel::findRoleById($roleId);
            $role = Roles::where('id', '=', $roleId)->get()->first();
            $role->users()->attach($user);
        }

        foreach ($toDeleteDBValuesArr as $roleId) {
//            $role = Sentinel::findRoleById($roleId);
            $role = Roles::where('id', '=', $roleId)->get()->first();
            $role->users()->detach($user);
        }

        $UserRolesArr = $user->roles()->where('user_id', '=', $user->id)->where('role_id', '=', '6')->get()->count();
//        dd($UserRolesArr);
        if ($UserRolesArr == 0) {
            $user->bank_id = null;
            $user->save();
        }


        session()->flash('flash_message', 'User Details were successfully saved!');
        $redirectPath = 'admin/users';
        return Redirect::to($redirectPath)->withInput();
    }

    /**
     * @param $id
     * @return Response
     */
    public function getPermissions($id) {
        $user = User::find($id);
        $formaction = 'Admin\UsersAdminController@postPermissions';
        $subViewType = 'admin.users._permissions';
          $sideTab = 'userData';
        return view('admin.users.createedit', compact('formaction', 'subViewType', 'user','sideTab'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function postPermissions(Request $request) {
        $rules = array();
    }

}
