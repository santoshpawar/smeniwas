<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
//use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Http\Request;
use Validator;
use Input;
use Auth;


class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest', ['except' => 'getLogout']);
	}

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getLogin(){
		return view('auth.login');
	}

	public function postLogin(Request $request){

		$input = Input::all();
//		$input = $request->input();
//		dd($input);
		$userId = null;
		$userInputValue = null;
		$loginUserIdValue= null;
		$fieldsArr = [];
		$rulesArr = [];
		$messagesArr = [];

		if(isset($input['login_userid'])){
			$userId = $input['login_userid'];
			if(isset($input[$input['login_userid']]) && isset($input['userdetail'])){
				$input[$input['login_userid']] = $input['userdetail'];
				$userInputValue = $input['userdetail'];
			}
		}
//		dd($userId);

		if(isset($userId)) {
			$fieldsArr[$userId] = $userInputValue;
			$rulesArr[$userId] = 'required';
			if(strcmp($userId, "email") === 0) {
				$messagesArr[$userId . 'required'] = 'The Email field is required.';
			}else{
				$messagesArr[$userId . 'required'] = 'The PAN # field is required.';
			}
		}
		$fieldsArr['login_userid'] = $userId;
		$rulesArr['login_userid'] = 'required';
		$messagesArr['login_userid.required'] = 'The Login With field is required.';
		$fieldsArr['password'] = $input['password'];
		$rulesArr['password'] = 'required';
		$messagesArr['password.required'] = 'The Password field is required.';

		$validator = Validator::make($fieldsArr,$rulesArr, $messagesArr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}
			$credentialsArr = ['password' => $input['password']];
			$credentialsArr = array_add($credentialsArr, $userId, $input[$input['login_userid']]);

//			if(Sentinel::authenticate($credentialsArr)){
        if(Auth::attempt($credentialsArr)){
				return redirect()->intended($this->redirectPath());
			}
			return redirect($this->loginPath())->withInput($request->only($userId, 'remember'))->withErrors(array($userId => $this->getFailedLoginMessage()));
	}

	protected function getFailedLoginMessage(){
		return 'These credentials do not match our records.';
	}

	public function getLogout(){
        Auth::logout();
//		$this->auth->logout();
//		Sentinel::logout(null, true);
		return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : 'http://smeniwas.com/');
	}

	public function redirectPath(){
		if (property_exists($this, 'redirectPath')) {
			return $this->redirectPath;
		}
		return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
	}

	public function loginPath(){
		return property_exists($this, 'loginPath') ? $this->loginPath : '/auth/login';
	}
}
