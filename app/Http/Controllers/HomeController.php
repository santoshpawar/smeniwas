<?php namespace App\Http\Controllers;

use App\Helpers\FormatHelper;
use App\Helpers\validLoanUrlhelper;
use App\Models\Loan\Loan;
use App\Models\UserProfile;
use Config;
use DB;
use Illuminate\Database\Eloquent\Collection;
use Auth;


class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{


    $user = Auth::user();
        //        $user = Sentinel::getUser();
    $loans = null;
    $userProfile = null;
    $discardApplication = null;
    $isDiscardApplication = null;

    $discardApplication = new validLoanUrlhelper();
    $isDiscardApplication = $discardApplication->discardingApplication();

    if($user->isSME()){
      $loans = Loan::all()->where('user_id',$user->id);
    }else if($user->isAnalyst() || $user->isLoanAdmin()) {
     
      $loans = Loan::where('status','>=',Config::get('constants.CONST_LOAN_STATUS_TYPE_2'))->where('loan_disable','=','N')->get();
    
          
       
           // $ratiosList = Ratio::where('loan_id', '=', $loanId)->where('period', '=', $maxFY)->get();

              /* DB::table('loans')
          ->where('status', '>=', Config::get('constants.CONST_LOAN_STATUS_TYPE_2')) // find your user by their email
          ->where('loan_disable', '=', 'Y')*/
        }else if($user->isCA()) {
        
            /*
            $loans = new Collection();
            $loans->push(Loan::where('user_id','=', $user->id)->first());
            */
//            $loans = Loan::all()->where('user_id',$userId);
            $userProfile = UserProfile::all()->where('referredby_userid',$user->id);
          }else if($user->isExecutive()){
            $loans = Loan::where('status','=',Config::get('constants.CONST_LOAN_STATUS_TYPE_1'))->get();
          }else if($user->isBankUser() && isset($user->bank_id)) {
            $loans = Loan::whereHas('getBankAllocationDetails', function ($query) use($user) {
              $query->where('bank_id', '=', $user->bank_id);
            })->get();
          }else if($user->isAdmin()){
            $loans = Loan::with('getUserProfile')->get();

          }else if($user->isApproverUser()){
            $loans = array();
           // $loans = Loan::with('getUserProfile')->get();
            $loans = Loan::where('status','>=',Config::get('constants.CONST_LOAN_STATUS_TYPE_21'))->where('loan_disable','=','N')->get();
               
           // $loans = Loan::where('status','=',Config::get('constants.CONST_LOAN_STATUS_TYPE_23'))->get();
          }else if($user->isLoanAdmin()){
            $loans = array();
           // $loans = Loan::with('getUserProfile')->get();
            $loans = Loan::where('status','>=',Config::get('constants.CONST_LOAN_STATUS_TYPE_24'))->where('loan_disable','=','N')->get();
               
                
           // $loans = Loan::where('status','=',Config::get('constants.CONST_LOAN_STATUS_TYPE_23'))->get();
          }else{
           $loans = array();
         }
         $praposal=false;
         return view('home.home',compact('loans','user','userProfile','isDiscardApplication','praposal'));
       }

       public function praposalDashboard()
       {
        $user = Auth::user();
          // $user = Sentinel::getUser();
        $loans = null;
        $userProfile = null;
        $discardApplication = null;
        $isDiscardApplication = null;
        $discardApplication = new validLoanUrlhelper();
        $isDiscardApplication = $discardApplication->discardingApplication();

        if($user->isSME()){
          $loans = Loan::all()->where('user_id',$user->id);
        }else if($user->isAnalyst() || $user->isLoanAdmin()) {
          $loans = Loan::where('status','>=',Config::get('constants.CONST_LOAN_STATUS_TYPE_2'))->where('loan_disable','=','N')->get();
          //$loans = Loan::all()->where('user_id',$user->id);
             // $ratiosList = Ratio::where('loan_id', '=', $loanId)->where('period', '=', $maxFY)->get();

                /* DB::table('loans')
            ->where('status', '>=', Config::get('constants.CONST_LOAN_STATUS_TYPE_2')) // find your user by their email
            ->where('loan_disable', '=', 'Y')*/
          }else if($user->isCA()) {
            /*
            $loans = new Collection();
            $loans->push(Loan::where('user_id','=', $user->id)->first());
            */
            // $loans = Loan::all()->where('user_id',$userId);
            $userProfile = UserProfile::all()->where('referredby_userid',$user->id);
          }else if($user->isExecutive()){
            $loans = Loan::where('status','=',Config::get('constants.CONST_LOAN_STATUS_TYPE_1'))->get();
          }else if($user->isBankUser() && isset($user->bank_id)) {
            $loans = Loan::whereHas('getBankAllocationDetails', function ($query) use($user) {
              $query->where('bank_id', '=', $user->bank_id);
            })->get();
          }else if($user->isAdmin()){
            $loans = Loan::with('getUserProfile')->get();
          }
          else {
            $loans = array();
            // $loans = Loan::all();
          }
          $praposal=true;
          return view('home.home',compact('loans','user','userProfile','isDiscardApplication','praposal'));
        }

        public function analystDashboard()
        {
          $user = Auth::user();
          // $user = Sentinel::getUser();
          $loans = null;
          $userProfile = null;
          $discardApplication = null;
          $isDiscardApplication = null;
          $discardApplication = new validLoanUrlhelper();
          $isDiscardApplication = $discardApplication->discardingApplication();

          if($user->isSME()){
            $loans = Loan::all()->where('user_id',$user->id);
          }else if($user->isAnalyst() || $user->isLoanAdmin()) {

            $loans = Loan::where('status','>=',Config::get('constants.CONST_LOAN_STATUS_TYPE_1'))->where('loan_disable','=','N')->get();
         //    $loans = Loan::where('status','>=',Config::get('constants.CONST_LOAN_STATUS_TYPE_2'))->get();

             // $ratiosList = Ratio::where('loan_id', '=', $loanId)->where('period', '=', $maxFY)->get();

                /* DB::table('loans')
            ->where('status', '>=', Config::get('constants.CONST_LOAN_STATUS_TYPE_2')) // find your user by their email
            ->where('loan_disable', '=', 'Y')*/
          }else if($user->isCA()) {
            /*
            $loans = new Collection();
            $loans->push(Loan::where('user_id','=', $user->id)->first());
            */
            // $loans = Loan::all()->where('user_id',$userId);
            $userProfile = UserProfile::all()->where('referredby_userid',$user->id);
          }else if($user->isExecutive()){
            $loans = Loan::where('status','=',Config::get('constants.CONST_LOAN_STATUS_TYPE_1'))->get();
          }else if($user->isBankUser() && isset($user->bank_id)) {
            $loans = Loan::whereHas('getBankAllocationDetails', function ($query) use($user) {
              $query->where('bank_id', '=', $user->bank_id);
            })->get();
          }else if($user->isAdmin()){
            $loans = Loan::with('getUserProfile')->get();
          }
          else {
            $loans = array();
            // $loans = Loan::all();
          }
          $analystDashboard=true;
          return view('home.home',compact('loans','user','userProfile','isDiscardApplication','analystDashboard'));
        }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function caUserLoans($id = null)
    {
      if(isset($id)) {
        $loans = null;
        $userID = $id;
        $loans = DB::table('loans')->where('user_id', '=', $userID)->get();
//            dd($userID,$loans);
        $isCAUserLoan = true;
        $discardApplication = null;
        $isDiscardApplication = null;
        $discardApplication = new validLoanUrlhelper();
        $isDiscardApplication = $discardApplication->discardingApplication();
        return view('home.home',compact('isCAUserLoan','loans','isDiscardApplication'));
      }

    }

	/**
	 * @return mixed
     */
	public function homeSource($userId = null){
		$environment = new Environment();

		$columns = array(
			'id',
			'type',
      'end_use',
      'status',
      'loan_amount',
      'loan_tenure',
      'promoter_generation_type',
      'promoter_background',
    );
		$settings = array(
			'sort'        => 'id',
			'direction'   => 'asc',
			'max_results' => 10,
			'threshold'	  => 5,
			'throttle' => 5,
    );

		$user = Auth::user();
		$loans = null;

		if($user->isSME()){
			$loans = Loan::all()->where('user_id',$user->id);
		}else if($user->isAnalyst() || $user->isLoanAdmin()) {
      $loans = new Collection();
      $loans->push(Loan::where('type','=', 'LAP')->first());
    }else if($user->isCA() && isset($userId)) {
            /*
            $loans = new Collection();
            $loans->push(Loan::where('user_id','=', $user->id)->first());
            */
            $loans = Loan::all()->where('user_id',$userId);
          }else {
           $loans = Loan::all();
         }

         $transformer = function($element)
         {

           $type = $element['type'];
           $endUseList = $element['end_use'];
           $element['edit_url'] = url("loans/company-background/{$type}/{$endUseList}/{$element['loan_amount']}/{$element['loan_tenure']}/{$element['id']}");

           $endUseLabelValue = FormatHelper::formatEndUseList($endUseList);
           $element['end_use_label'] = $endUseLabelValue;

           $labelValue = FormatHelper::formatLoanType($type);
           $element['type_label'] = $labelValue;

           return $element;
         };

         return DataGrid::make($loans, $columns, $settings, $transformer);
       }


    /**
     * @return mixed
     */
    public function homecaSource(){
      $environment = new Environment();

      $columns = array(
        'user_id',
        'name_of_firm',
        'owner_purpose_of_loan',
        'owner_entity_type',
        'owner_name',
        'address',
        'latest_turnover',
        'required_amount',
      );
      $settings = array(
        'sort'        => 'id',
        'direction'   => 'asc',
        'max_results' => 10,
        'threshold'	  => 5,
        'throttle' => 5,
      );

      $user = Auth::user();
      $userProfile = null;
      $loans = null;

      if($user->isCA()){
        $userProfile = UserProfile::all()->where('referredby_userid',$user->id);
      }

      $transformer = function($element)
      {
        $element['edit_url'] = url("register/wizard/edit-profile/{$element['user_id']}");
        $element['redirect_url'] = url("home/ca-user-loans/{$element['user_id']}");

        $endUseList = $element['owner_purpose_of_loan'];
        $endUseLabelValue = FormatHelper::formatEndUseList($endUseList);
        $element['purpose_of_loan_label'] = $endUseLabelValue;

        return $element;
      };

      return DataGrid::make( $userProfile, $columns, $settings, $transformer);
    }
  }
