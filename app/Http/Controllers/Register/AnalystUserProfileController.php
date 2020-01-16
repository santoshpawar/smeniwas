<?php namespace App\Http\Controllers\Register;

//use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Address;
use App\Models\MasterData;
use App\Models\User;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Session;
//use Proengsoft\JsValidation\JsValidator;
use Illuminate\Support\Facades\Storage;
use Validator;
use JsValidator;
use Input;
use Mail;
use Auth;

use Illuminate\Auth\Passwords\DatabaseTokenRepository;
use DB;

/**
 * @property array cadetailsValidationRules
 */
class AnalystUserProfileController extends Controller{

    protected $indexValidationRules = [
        'username' => 'required|alpha_num|unique:users',
        'email' => 'required|email|unique:users'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $formaction = 'Register\AnalystUserProfileController@postIndex';
        $subViewType = 'register.analyst._form_analyst_register';

        $user = Auth::user();
       
        $id = $user->id;
        
        $userProfile = $user->userProfile();
//        dd($user,$id);
        if(isset($user)) {
            $analyst_name = $user->username;
            $analyst_email = $user->email;
        }
        $validator = JsValidator::make($this->indexValidationRules);

        return view('register.analyst.createedit', compact('formaction', 'subViewType', 'validator','userProfile','analyst_name','analyst_email'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */

    public function postIndex(Request $request)
    {
        $input = Input::all();
        $user = Auth::user();
        $id = $user->id;
//        dd($input,$id);

        $input = $request->all();
        User::updateOrCreate(array('id' => $id),['username' => $input['analyst_name'], 'email' => $input['analyst_email']]);

        session()->flash('flash_message','User Details were successfully saved!');

        $redirectPath = 'register/analyst';
        return Redirect::to($redirectPath)->withInput();
    }

    protected function generateToken($user){
        $connection = DB::connection();

        $table = 'password_resets';

        $key = Config::get('app.key');

        $expire = 60;

        $dbRepository = new DatabaseTokenRepository($connection, $table, $key, $expire);
        return $dbRepository->create($user);
    }

}