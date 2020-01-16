<?php namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use App\Models\Common\ConfigurableParameter;
use App\Models\User;
use App\Models\Loan\Loan;
use App\Models\UserProfile;
use Carbon\Carbon;
use App\Models\Messenger\Thread;
use App\Models\Messenger\Message;
use App\Models\Messenger\Participant;
use Illuminate\Database\Eloquent\ModelNotFoundException;
//use Cartalyst\Auth\Laravel\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Auth;
use App\Models\Roles;
use App\Helpers\FileHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Models\Loan\Bankallocation\LoansBankAllocation;
use App\Models\Loan\LoansStatus;

class MessagesController extends Controller
{
    /**
     * Just for testing - the user should be logged in. In a real
     * app, please use standard authentication practices
     */
    public function __construct()
    {
        //This will ensure that all routes handled by this controller are first authenticated
        $this->middleware('auth');
    }

    /**
     * Show all of the message threads to the user
     *
     * @return mixed
     */
    public function index()
    {
        $toSmeNiwas = 'SMENiwas';
        $currentUserId = Auth::getUser()->id;
        $currentUserName = Auth::getUser()->username;
        $user = Auth::getUser();
        if ($user->isAnalyst() || $user->isAdmin() || $user->isExecutive() || $user->isManagement()) {
            $inbox = Participant::where('user_id', '=', $currentUserId)->orwhere('user_id', '=', '-1')->where('deleted_at', null)->latest('created_at')->get();
        } else {
            $inbox = Participant::where('user_id', '=', $currentUserId)->where('to_user_delete', '=', null)->where('deleted_at', null)->latest('created_at')->get();
        }
        $count = Participant::forUserWithNewMessages($currentUserId)->count();
        return view('messenger.index', compact('threads', 'inbox', 'currentUserId', 'currentUserName', 'count', 'toSmeNiwas'));
    }

    /**
     * Shows a message thread
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $fileDownloadUrl = null;
        $toSmeNiwas = 'SMENiwas';
        try {
            $userId = Auth::getUser()->id;
            $msg = Participant::where('id', '=', $id)->get()->first();
            $thread = Thread::where('id', '=', $msg->thread_id)->get()->first();

        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');
            return redirect('messages');
        }
        $users = User::where('id', $msg->from_user_id)->get();
        $count = Participant::forUserWithNewMessages($userId)->count();
        if ($msg->user_id == $userId) {
            $msg->markAsRead($userId, $msg->id);
        }
        if (isset($msg) && $msg->upload_file != null) {
            $fileHelper = new FileHelper();
            $fileDownloadUrl = $fileHelper->getFileDownloadURL($msg->upload_file);
        }
        return view('messenger.show', compact('thread', 'users', 'msg', 'thread', 'count', 'fileDownloadUrl', 'toSmeNiwas'));
    }

    /**
     * Creates a new message thread
     *
     * @return mixed
     */
    public function create()
    {
        $users = array();
        $toSmeNiwas = 'SMENiwas';
        $currentUserId = Auth::getUser()->id;
        $user = Auth::getUser();

        if($user->isBankUser())
        {
            $users = array(NULL => '') + LoansBankAllocation::where('bank_id','=',$user->bank_id)->get()->lists('loan_id','loan_id')->toArray();
        }
        else if ($user->isAnalyst() || $user->isAdmin() || $user->isExecutive() || $user->isManagement()) {
            $role = Roles::where('slug', '=', 'SME')->orWhere('slug', '=', 'CP')->get();
            foreach ($role as $value) {
                $getUsers[] = $value->users()->get()->toArray();
            }
            $users = call_user_func_array('array_merge', $getUsers);
        }
//        dd($users);
        $count = Participant::forUserWithNewMessages($currentUserId)->count();
        return view('messenger.create', compact('users', 'count', 'toSmeNiwas'));
    }

    /**
     * Creates a new message thread
     *
     * @return mixed
     */
    public function compose($loanId, $userId)
    {
        $toSmeNiwas = 'SMENiwas';
        $currentUserId = Auth::getUser()->id;
        $toUser = User::where('id', '=', $userId)->get()->first();
        $toUserEmail = $toUser->email;
        $users = User::where('id', '!=', Auth::getUser()->id)->get()->lists('email', 'id')->all();
        $count = Participant::forUserWithNewMessages($currentUserId)->count();
        return view('messenger.compose', compact('users', 'loanId', 'userId', 'toUserEmail', 'count', 'toSmeNiwas'));
    }

    /**
     * Stores a new message thread
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        $input = Input::all();
//        dd($input);
        $rules = array(
            'recipients' => 'required',
            'subject' => 'required',
            'message' => 'required'
        );

        //validate
        $validator = \Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return \Redirect::back()->withErrors($validator)->withInput();
        }

        if (Auth::user()->isBankUser()) {

            $user_id = Loan::find($input['loanId']);

            if (isset($input['loanId']) && $input['loanId'] != '') {
                $thread = Thread::Create([
                    'loan_id' => $input['loanId'],
                    'subject' => $input['subject'],
                ]);

                if (Input::has('recipients')) {
                        $message = Participant::Create([
                            'thread_id' => $thread->id,
                            'from_user_id' => Auth::getUser()->id,
                            'user_id' => $user_id->user_id,
                            'body' => $input['message'],
                            'source' => 'bank',
                        ]);

                }
            } else {
                $thread = Thread::Create([
                    'loan_id' => null,
                    'subject' => $input['subject'],
                ]);
                if (Input::has('recipients')) {
                    foreach ($input['recipients'] as $user_id) {
                        $message = Participant::Create([
                            'thread_id' => $thread->id,
                            'from_user_id' => Auth::getUser()->id,
                            'user_id' => $user_id->user_id,
                            'body' => $input['message'],
                            'source' => 'normal',
                        ]);
                    }
                }
            }
        }
        elseif (Auth::user()->isSME() || Auth::user()->isCA()) {
            if (isset($input['loanId']) && $input['loanId'] != '') {

                $thread = Thread::Create([
                    'loan_id' => $input['loanId'],
                    'subject' => $input['subject'],
                ]);

                $message = Participant::Create([
                    'thread_id' => $thread->id,
                    'from_user_id' => Auth::getUser()->id,
                    'user_id' => -1,
                    'body' => $input['message'],
                    'source' => 'bank',
                ]);

            } else {
                $thread = Thread::Create([
                    'loan_id' => null,
                    'subject' => $input['subject'],
                ]);

                $message = Participant::Create([
                    'thread_id' => $thread->id,
                    'from_user_id' => Auth::getUser()->id,
                    'user_id' => -1,
                    'body' => $input['message'],
                    'source' => 'normal',
                ]);
            }
        } else {
            if (isset($input['loanId']) && $input['loanId'] != '') {
                $thread = Thread::Create([
                    'loan_id' => $input['loanId'],
                    'subject' => $input['subject'],
                ]);

                if (Input::has('recipients')) {
                    foreach ($input['recipients'] as $user_id) {
                        $message = Participant::Create([
                            'thread_id' => $thread->id,
                            'from_user_id' => Auth::getUser()->id,
                            'user_id' => $user_id,
                            'body' => $input['message'],
                            'source' => 'bank',
                        ]);
                    }
                }
            } else {
                $thread = Thread::Create([
                    'loan_id' => null,
                    'subject' => $input['subject'],
                ]);
                if (Input::has('recipients')) {
                    foreach ($input['recipients'] as $user_id) {
                        $message = Participant::Create([
                            'thread_id' => $thread->id,
                            'from_user_id' => Auth::getUser()->id,
                            'user_id' => $user_id,
                            'body' => $input['message'],
                            'source' => 'normal',
                        ]);
                    }
                }
            }
        }
        if ($request->file('upload_file')) {
            $file = $request->file('upload_file');
            $directory = 'Threads';
            $originalFileName = $file->getClientOriginalName();
            $uploadedFileName = $directory. '/'. 'thread_' . $message->id . '-' . $originalFileName;
            $oldFileName = null;

            if (isset($message) && !empty($message->upload_file)) {
                $oldFileName = $message->upload_file;
            }

            $fileHelper = new FileHelper();
            $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
            $message->upload_file = $uploadedFileName;
            $message->save();
        }

        $sender = Auth::getUser();
        if (Auth::user()->isBankUser()) {
            $user_id = Loan::find($input['loanId']);
            $receiver = User::find($user_id->user_id);
        }
        else {
            foreach ($input['recipients'] as $user_id) {
                $receiver = User::find($user_id);
            }
        }

        if (isset($input['loanId']) && $input['loanId'] != '') {
            $loan = Loan::find($input['loanId']);

                if (Auth::user()->isAnalyst()) {
                    $loanStatus = LoansStatus::where('loan_id','=',$input['loanId'])->get()->first();
                    if(isset($loanStatus) && count($loanStatus) > 0) {
                        $loanStatus->niwas_query_status = 'Y';
                        $loanStatus->save();
                    }
                } elseif (Auth::user()->isBankUser()) {
                    $loanStatus = LoansBankAllocation::where('loan_id','=',$input['loanId'])->where('bank_id','=',Auth::user()->bank_id)->get()->first();
                    if(isset($loanStatus) && count($loanStatus) > 0) {
                        $loanStatus->bank_query_status = 'Y';
                        $loanStatus->save();
                    }
                }
//            $loan->status = "5";
//            $loan->save();
            $this->sendMail('emails.querymail',array('from' => $sender->email,'to' => $receiver->email,'loanID' => $input['loanId'],'subject' => $input['subject'],'bodyMessage' => $input['message']), $sender->email, 'Query Message From SMENiwas!');
            $this->sendMail('emails.querymail', array('from' => $sender->email, 'to' => $receiver->email, 'loanID' => $input['loanId'], 'subject' => $input['subject'], 'bodyMessage' => $input['message']), $receiver->email, 'Query Message From SMENiwas!');
            $confParam = new ConfigurableParameter();
            $message = $confParam->getParamValueOrDefault('sms_template','Received Query');
            if(isset($receiver)){
                $userProfile = $receiver->userProfile();
                if(isset($userProfile) && isset($userProfile->contact1)){
                   $mobileNumber = $userProfile->contact1;
                    $this->sendSMS($mobileNumber, $message);
                }
            }

        }
        if(isset($input['loanId']) && $input['loanId'] != '') {
            session()->flash('flash_message','Query has been sent successfully!');
            return redirect('home');
        }
        else {
            session()->flash('flash_message','Query has been sent successfully!');

            return redirect('messaging');
        }
    }

    public function sent()
    {
        $currentUserId = Auth::getUser()->id;
        $currentUserName = Auth::getUser()->username;
        $toSmeNiwas = 'SMENiwas';
        $sent = Participant::where('from_user_id', '=', $currentUserId)->where('source', '!=', 'bank')->where('from_user_delete', '=', null)->where('deleted_at', null)->latest('created_at')->get();
        $count = Participant::forUserWithNewMessages($currentUserId)->count();
        return view('messenger.sent', compact('threads', 'threads_message', 'sent', 'sentUsername', 'currentUserId', 'currentUserName', 'count', 'toSmeNiwas'));
    }

    public function sentreply()
    {
        $toSmeNiwas = 'SMENiwas';
        $currentUserId = Auth::getUser()->id;
        $currentUserName = Auth::getUser()->username;
        $sent = Participant::where('from_user_id', '=', $currentUserId)->where('source', '=', 'bank')->where('from_user_delete', '=', null)->where('deleted_at', null)->latest('created_at')->get();
        $count = Participant::forUserWithNewMessages($currentUserId)->count();
        return view('messenger.sentreply', compact('threads', 'threads_message', 'sent', 'sentUsername', 'currentUserId', 'currentUserName', 'count','toSmeNiwas'));
    }

    /**
     * Reply message thread
     *
     * @return mixed
     */
    public function reply($threadeId)
    {
        $toSmeNiwas = 'SMENiwas';
        $currentUserId = Auth::getUser()->id;
        $msg = Participant::where('id', '=', $threadeId)->get()->first();
        $thread = Thread::where('id', '=', $msg->thread_id)->get()->first();
//        $users =  User::where('id', '!=', Auth::getUser()->id)->get()->lists('email', 'id')->all();
        if($currentUserId == $msg->from_user_id ) {
            if($msg->user_id != -1)
            {
                $toUser = User::where('id', '=', $msg->user_id)->get()->first();
                if ($toUser->isAnalyst() || $toUser->isAdmin() || $toUser->isExecutive() || $toUser->isManagement()) {
                    $toUserEmail = $toSmeNiwas;
                }
                else {
                    $toUserEmail = $toUser->email;
                }
            }
            else {
                $toUserEmail = $toSmeNiwas;
            }
        }
        else{
            $toUser = User::where('id', '=', $msg->from_user_id)->get()->first();
            if ($toUser->isAnalyst() || $toUser->isAdmin() || $toUser->isExecutive() || $toUser->isManagement()) {
                $toUserEmail = $toSmeNiwas;
            }
            else {
                $toUserEmail = $toUser->email;
            }
        }
        $count = Participant::forUserWithNewMessages($currentUserId)->count();

        return view('messenger.reply', compact('users', 'msg', 'thread', 'messageId', 'count', 'toUserEmail', 'toSmeNiwas','toUser'));
    }

    /**
     * Adds a new message to a current thread
     *
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $input = Input::all();
//        dd($input);
        try {
            $message = Participant::findOrFail($id);
            $thread = Thread::where('id', '=', $message->thread_id)->get()->first();
//            $user = User::find($message->user_id);
            foreach ($input['recipients'] as $user_id) {
                if(Auth::getUser()->id == $user_id ) {
                    $user = User::find($message->user_id);
                }
                else
                {
                    $user = User::find($user_id);
                }
            }
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');
            return redirect('messages');
        }

        if ($user->isAnalyst() || $user->isAdmin() || $user->isExecutive() || $user->isManagement()) {
            if (isset($thread->loan_id) && $thread->loan_id != '') {
                if (Input::has('recipients')) {
                    foreach ($input['recipients'] as $user_id) {
                        $messages = Participant::Create([
                            'thread_id' => $thread->id,
                            'from_user_id' => Auth::getUser()->id,
                            'user_id' => -1,
                            'body' => $input['message'],
                            'source' => 'bank',
                        ]);
                    }
                }
            } else {
                if (Input::has('recipients')) {
                    foreach ($input['recipients'] as $user_id) {

                        $messages = Participant::Create([
                            'thread_id' => $thread->id,
                            'from_user_id' => Auth::getUser()->id,
                            'user_id' => -1,
                            'body' => $input['message'],
                            'source' => 'normal',
                        ]);
                    }
                }
            }
        } else {
            if (isset($thread->loan_id) && $thread->loan_id != '') {
                if (Input::has('recipients')) {
                    foreach ($input['recipients'] as $user_id) {
                        if(Auth::getUser()->id == $user_id ) {
                            $messages = Participant::Create([
                                'thread_id' => $thread->id,
                                'from_user_id' => Auth::getUser()->id,
                                'user_id' => $message->user_id,
                                'body' => $input['message'],
                                'source' => 'bank',
                            ]);
                        }
                        else {
                            $messages = Participant::Create([
                                'thread_id' => $thread->id,
                                'from_user_id' => Auth::getUser()->id,
                                'user_id' => $user_id,
                                'body' => $input['message'],
                                'source' => 'bank',
                            ]);
                        }
                    }
                }
            } else {

                if (Input::has('recipients')) {
                    foreach ($input['recipients'] as $user_id) {
                        if(Auth::getUser()->id == $user_id ) {
                            $messages = Participant::Create([
                                'thread_id' => $thread->id,
                                'from_user_id' => Auth::getUser()->id,
                                'user_id' => $message->user_id,
                                'body' => $input['message'],
                                'source' => 'normal',
                            ]);
                        }
                        else {
                            $messages = Participant::Create([
                                'thread_id' => $thread->id,
                                'from_user_id' => Auth::getUser()->id,
                                'user_id' => $user_id,
                                'body' => $input['message'],
                                'source' => 'normal',
                            ]);
                        }
                    }
                }
            }
        }

        if ($request->file('upload_file')) {
            $file = $request->file('upload_file');
            $directory = 'Threads';
            $originalFileName = $file->getClientOriginalName();
            $uploadedFileName = $directory. '/'. 'thread_' . $messages->id . '-' . $originalFileName;
            $oldFileName = null;

            if (isset($messages) && !empty($messages->upload_file)) {
                $oldFileName = $messages->upload_file;
            }

            $fileHelper = new FileHelper();

            $fileHelper->uploadFile($directory, $uploadedFileName, File::get($file), $oldFileName);
            $messages->upload_file = $uploadedFileName;
            $messages->save();
        }

        $sender = Auth::getUser();
        foreach ($input['recipients'] as $user_id) {
            $receiver = User::find($user_id);
        }

        if (isset($thread->loan_id) && $thread->loan_id != '') {
            $loan = Loan::find($thread->loan_id);
            if($sender->id == $message->user_id) {
                if ($user->isAnalyst()) {
                    $loanStatus = LoansStatus::where('loan_id', '=', $thread->loan_id)->get()->first();
                    if (isset($loanStatus) && count($loanStatus) > 0) {
                        $loanStatus->niwas_query_status = 'N';
                        $loanStatus->save();
                    }
                } elseif ($user->isBankUser()) {
                    $loanStatus = LoansBankAllocation::where('loan_id', '=', $thread->loan_id)->where('bank_id', '=', $user->bank_id)->get()->first();
                    if (isset($loanStatus) && count($loanStatus) > 0) {
                        $loanStatus->bank_query_status = 'N';
                        $loanStatus->save();
                    }
                }
                $thread->is_replied = '1';
                $thread->save();

                $this->sendMail('emails.querymail', array('from' => $sender->email, 'to' => $receiver->email, 'loanID' => $thread->loan_id, 'subject' => $input['subject'], 'bodyMessage' => $input['message']), $sender->email, 'Query Message From SMENiwas!');
//              $this->sendMail('emails.querymail', array('from' => $sender->email, 'to' => $receiver->email, 'loanID' => $thread->loan_id, 'subject' => $input['subject'], 'bodyMessage' => $input['message']), $receiver->email, 'Query Message From SMENiwas!');
                $confParam = new ConfigurableParameter();
                $message = $confParam->getParamValueOrDefault('sms_template', 'Received Query');
                if (isset($receiver)) {
                    $userProfile = $receiver->userProfile();
                    if (isset($userProfile) && isset($userProfile->contact1)) {
                        $mobileNumber = $userProfile->contact1;
                        $this->sendSMS($mobileNumber, $message);
                    }
                }
            }
        }

        return redirect('messaging');
    }

    public function getDeleteMessages($id)
    {
        $user = Auth::getUser();
        $getMessage = Participant::find($id);
        if($getMessage->user_id == -1)
        {
            if ($user->id == $getMessage->from_user_id) {
                $getMessage->from_user_delete = 1;
                $getMessage->save();
            } else {
                if($getMessage->to_user_delete == NULL)
                {
                    $getMessage->to_user_delete = $user->id;
                }
                else {
                    $getMessage->to_user_delete = $getMessage->to_user_delete . "," . $user->id;
                }
                $getMessage->save();
            }
        }
        else
        {
            if ($user->id == $getMessage->from_user_id) {
                $getMessage->from_user_delete = 1;
                $getMessage->save();
            } elseif ($user->id == $getMessage->user_id) {
                $getMessage->to_user_delete = 1;
                $getMessage->save();
            }
            if ($getMessage->from_user_delete == 1 && $getMessage->to_user_delete == 1) {
                $getMessage->delete();
            }
        }

        session()->flash('flash_message', 'Deleted successfully!');
        return Redirect::back();
    }
}
