<?php namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;
 
class LoanRepayments extends Model
{
	    public $table = "loans_repayment";
	protected $fillable=[
	'id', 'loan_id', 
	   'cust_name',
   'guarantor_name',
   'cust_address',
   'guarantor_address',
   'cust_number',
   'guarantor_number',
   'email',
   'email2',
   'TypeofLoan',
   'TypeofRepayment',
   'p',
   'r',
   'n',
   't',
   'loansanction',
   'date1','date2','date3','date4','date5','date6','date7','date8','date9','date10','date11','date12','date13','date14','date15','date16','date17','date18','date19','date20','date21','date22','date23','date24','date25','date26','date27','date28','date29','date30','date31','date32','date33','date34','date35','date36','date37','date38','date39','date40','date41','date42','date43','date44','date45','date46','date47','date48',
   
   'first_date',
    'two_date',
    // 'os',
    'os1','os2','os3','os4','os5','os6','os7','os8','os9','os10','os11','os12','os13','os14','os15','os16','os17','os18','os19','os20','os21','os22','os23','os24','os25','os26','os27','os28','os29','os30','os31','os32','os33','os34','os35','os36',

     // 'interestdue',
     'interestdue1','interestdue2','interestdue3','interestdue4','interestdue5','interestdue6','interestdue7','interestdue8','interestdue9','interestdue10','interestdue11','interestdue12','interestdue13','interestdue14','interestdue15','interestdue16','interestdue17','interestdue18','interestdue19','interestdue20','interestdue21','interestdue22','interestdue23','interestdue24','interestdue25','interestdue26','interestdue27','interestdue28','interestdue29','interestdue30','interestdue31','interestdue32','interestdue33','interestdue34','interestdue35','interestdue36',

     // 'pd',
     'pd1','pd2','pd3','pd4','pd5','pd6','pd7','pd8','pd9','pd10','pd11','pd12','pd13','pd14','pd15','pd16','pd17','pd18','pd19','pd20','pd21','pd22','pd23','pd24','pd25','pd26','pd27','pd28','pd29','pd30','pd31','pd32','pd33','pd34','pd35','pd36',

       // 'tds',
       'tds1','tds2','tds3','tds4','tds5','tds6','tds7','tds8','tds9','tds10','tds11','tds12','tds13','tds14','tds15','tds16','tds17','tds18','tds19','tds20','tds21','tds22','tds23','tds24','tds25','tds26','tds27','tds28','tds29','tds30','tds31','tds32','tds33','tds34','tds35','tds36',

         // 'netinterest',
         'netinterest1','netinterest2','netinterest3','netinterest4','netinterest5','netinterest6','netinterest7','netinterest8','netinterest9','netinterest10','netinterest11','netinterest12','netinterest13','netinterest14','netinterest15','netinterest16','netinterest17','netinterest18','netinterest19','netinterest20','netinterest21','netinterest22','netinterest23','netinterest24','netinterest25','netinterest26','netinterest27','netinterest28','netinterest29','netinterest30','netinterest31','netinterest32','netinterest33','netinterest34','netinterest35','netinterest36',


       // 'netamtdue',
       'netamtdue1','netamtdue2','netamtdue3','netamtdue4','netamtdue5','netamtdue6','netamtdue7','netamtdue8','netamtdue9','netamtdue10','netamtdue11','netamtdue12','netamtdue13','netamtdue14','netamtdue15','netamtdue16','netamtdue17','netamtdue18','netamtdue19','netamtdue20','netamtdue21','netamtdue22','netamtdue23','netamtdue24','netamtdue25','netamtdue26','netamtdue27','netamtdue28','netamtdue29','netamtdue30','netamtdue31','netamtdue32','netamtdue33','netamtdue34','netamtdue35','netamtdue36',







	 //end for loanadmin create checklist


	];
	public function getLoan(){
		return $this->belongsTo('App\Models\Loan\Loan','loan_id','id');
	}
	public function getUser(){
		return $this->belongsTo('App\Models\User','user_id','id');
	}
}
