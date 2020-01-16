<?php namespace App\Console\Commands;

use App\Models\Loan\Loan;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class EmailIncompleteApplicants extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'smeniwas:emailincompleteapplicants';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Email Incomplete Applicants Command description.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $userId = array();
        $emailId = null;
        static  $emailAddress = array();
        $userId  = Loan::where('status', '=', 'Draft')->lists('user_id')->all();
        for($i=0;$i<count($userId);$i++){
            $emailAddress[$i] = $this->getUserEmail($userId[$i]);
        }
       // $this->info($emailAddress[1]);
      for($i=0;$i<count($emailAddress);$i++)
       {
           $emailId = $emailAddress[$i];
           Mail::raw('You forget to Fill some field Please check it',function($message) use ($emailId)
           {
               $message->from('ankit@logitia.com', 'Sme Niwas Notify');
               $message->to($emailId);
           });
           if( count(Mail::failures()) > 0 ) {
               $this->info("sending failed for this ".$emailId);
           }else{
               $this->info("Successfully sent email to ".$emailId);
           }
       }
	}
    public function getUserEmail($id){
        $userEmail = User::where('id', '=', $id)->lists('email')->all();
        return $userEmail[0];
    }

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			//['example', InputArgument::REQUIRED, 'An example argument.'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			//['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
		];
	}

}
