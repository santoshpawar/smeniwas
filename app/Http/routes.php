<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Display all SQL executed in Eloquent


//echo "System is in maintenance Mode";
//die();
Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');
Route::get('home/praposal', 'HomeController@praposalDashboard');
Route::get('home/loanapplication', 'HomeController@analystDashboard');
Route::get('home/source/{userId?}', 'HomeController@homeSource');
Route::get('home/ca-source', 'HomeController@homeCaSource');
Route::get('home/ca-user-loans/{userId?}', 'HomeController@caUserLoans');
Route::get('loans/wizard/processData', 'Loans\LoanWizardController@processData');

Route::controller('register/wizard','Register\RegistrationWizardController');
Route::controller('loans/wizard','Loans\LoanWizardController');
Route::get('browser', 'WelcomeController@browser');

Route::controller('register/sme','Register\SMEUserProfileController');
Route::controller('loans/pdf', 'Pdf\PrintController');
Route::controller('loans/praposalPdf', 'Pdf\PraposalprintController');

Route::get('loans/company-background/{endUseList?}/{loanProduct?}/{amount?}/{loanTenure?}/{companySharePledged?}/{bscNscCode?}/{loanId?}', 'Loans\LoansController@getCompanyBackground');
Route::get('loans/promoter/{endUseList?}/{loanType?}/{amount?}/{loanTenure?}/{companySharePledged?}/{bscNscCode?}/{loanId?}', 'Loans\LoansController@getPromoter');
Route::get('loans/financial/{endUseList?}/{loanType?}/{amount?}/{loanTenure?}/{companySharePledged?}/{bscNscCode?}/{loanId?}', 'Loans\LoansController@getFinancial');
Route::get('loans/application/{endUseList?}/{loanType?}/{amount?}/{loanTenure?}/{companySharePledged?}/{bscNscCode?}/{afterShare?}/{loanId?}', 'Loans\LoansController@getApplication');
Route::get('loans/uploaddoc/{endUseList?}/{loanType?}/{amount?}/{loanTenure?}/{companySharePledged?}/{bscNscCode?}/{loanId?}', 'Loans\LoansController@getUploaddoc');


Route::get('loans/praposal/company-background/{endUseList?}/{loanProduct?}/{amount?}/{loanTenure?}/{companySharePledged?}/{bscNscCode?}/{loanId?}', 'Loans\LoansController@getPraposalCompanyBackground');
Route::get('loans/praposal/details/{endUseList?}/{loanType?}/{amount?}/{loanTenure?}/{companySharePledged?}/{bscNscCode?}/{loanId?}', 'Loans\LoansController@getPraposalDeatils');
Route::get('loans/praposal/finsummary/{endUseList?}/{loanType?}/{amount?}/{loanTenure?}/{companySharePledged?}/{bscNscCode?}/{loanId?}', 'Loans\LoansController@getPraposalFinsummary');

Route::get('loans/praposal/checklist/{endUseList?}/{loanType?}/{amount?}/{loanTenure?}/{companySharePledged?}/{bscNscCode?}/{loanId?}', 'Loans\LoansController@getPraposalChecklist');


Route::get('loans/praposal/keyloanterm/{endUseList?}/{loanType?}/{amount?}/{loanTenure?}/{companySharePledged?}/{bscNscCode?}/{loanId?}', 'Loans\LoansController@getKeyloanTerm');
Route::get('loans/praposal/application/{endUseList?}/{loanType?}/{amount?}/{loanTenure?}/{companySharePledged?}/{bscNscCode?}/{afterShare?}/{loanId?}', 'Loans\LoansController@getPraposalApplication');
Route::get('loans/praposal/uploaddoc/{endUseList?}/{loanType?}/{amount?}/{loanTenure?}/{companySharePledged?}/{bscNscCode?}/{loanId?}', 'Loans\LoansController@getPraposalUploaddoc');
Route::get('loans/praposal/approver/{endUseList?}/{loanType?}/{amount?}/{loanTenure?}/{companySharePledged?}/{bscNscCode?}/{loanId?}', 'Loans\LoansController@getApprover');
																																														
Route::get('loans/praposal/repayment/{endUseList?}/{loanType?}/{amount?}/{loanTenure?}/{companySharePledged?}/{bscNscCode?}/{loanId?}', 'Loans\LoansController@getRepayment');

Route::get('loans/praposal/loancomment/{endUseList?}/{loanType?}/{amount?}/{loanTenure?}/{companySharePledged?}/{bscNscCode?}/{loanId?}', 'Loans\LoansController@getLoancomment');

Route::get('loans/praposal/createchecklist/{endUseList?}/{loanType?}/{amount?}/{loanTenure?}/{companySharePledged?}/{bscNscCode?}/{loanId?}', 'Loans\LoansController@getChecklist');

// Route::get('loans/praposal/loanrepayment/{endUseList?}/{loanType?}/{amount?}/{loanTenure?}/{companySharePledged?}/{bscNscCode?}/{loanId?}', 'Loans\LoansController@getRepayment');

// Route::get('loans/praposal/createchecklist/{endUseList?}/{loanType?}/{amount?}/{loanTenure?}/{companySharePledged?}/{bscNscCode?}/{loanId?}', 'Loans\LoansController@getUploadLoanAdmindoc');

// //new
// Route::get('loans/praposal/createchecklist/{endUseList?}/{loanType?}/{amount?}/{loanTenure?}/{companySharePledged?}/{bscNscCode?}/{loanId?}', 'Loans\LoansController@getChecklist')->name('ImageUpload');


// //new 
// Route::post('loans/praposal/createchecklist/{endUseList?}/{loanType?}/{amount?}/{loanTenure?}/{companySharePledged?}/{bscNscCode?}/{loanId?}', 'Loans\LoansController@upload')->name('ImageUpload');

// Route::post('ImageUpload','LoansController@upload')->name('ImageUpload');


//Route::get('loans/profile-loan-details/{endUseList?}/{loanProduct?}/{amount?}/{loanTenure?}/{companySharePledged?}/{bscNscCode?}/{loanId?}', 'Loans\LoansController@getPraposalProfileLoanDetails');
Route::controller('loans', 'Loans\LoansController');

Route::controller('register/ca','Register\CAUserProfileController');
Route::controller('register/admin','Register\AdminUserProfileController');
Route::controller('register/analyst','Register\AnalystUserProfileController');
Route::controller('register/broker','Register\BrokerUserProfileController');

Route::controller('download_file', 'Pdf\DownloadFileController');
Route::controller('search_report', 'Pdf\ReportController');


Route::controller('admin/masterdata','Admin\MasterDataController');
Route::controller('admin/users','Admin\UsersAdminController');
Route::controller('admin/questions','Admin\QuestionsAdminController');
Route::controller('admin/creditmodel','Admin\CreditModelAdminController');
Route::controller('admin/liquiditymodel','Admin\LiquidityModelAdminController');
Route::controller('admin/financialdata','Admin\FinancialDataAdminController');
Route::controller('admin/bankmasterdata','Admin\BankMasterDataAdminController');
Route::controller('admin/bankallocation','Admin\BankAllocationController');
Route::controller('admin/parameterdata','Admin\ConfigurationDataAdminController');
Route::get('admin/industrytype','Admin\ConfigurationDataAdminController@getIndustryType');
Route::get('/admin/parameters/create-industry-type','Admin\ConfigurationDataAdminController@getCreateIndustryType');
Route::get('/admin/parameters/edit-industry-type','Admin\ConfigurationDataAdminController@getEditIndustryType');
Route::controller('admin/manualallocation','Admin\ManualBankAllocationsController');
Route::post('copyprofile', 'Admin\BankAllocationController@postCopyProfile');

Route::get('aboutus/wwr','StaticPageController@wwr');
Route::get('aboutus/whyus','StaticPageController@whyUs');
Route::get('successStories','StaticPageController@successStories');
Route::get('aboutus/keymgmt','StaticPageController@keymgmt');
Route::get('aboutus/teammembers','StaticPageController@teammembers');
Route::get('application_process/howtoapply','StaticPageController@howToApply');
Route::get('application_process/info_required','StaticPageController@infoRequired');
Route::get('application_process/track_application','StaticPageController@trackApplication');
Route::get('application_process/doc_required','StaticPageController@docRequired');
Route::get('contactus','StaticPageController@contactUs');
Route::post('contactus','StaticPageController@popstContactUs');
Route::post('application_process/track_application','StaticPageController@postTrackApplication');
Route::get('discard/loan','Loans\DiscardLoanController@discardLoan');
Route::get('products/loans','StaticPageController@loanproducts');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['prefix' => 'messaging'], function () {
	Route::get('/', ['as' => 'messaging', 'uses' => 'Messages\MessagesController@index']);
	Route::get('/sent', ['as' => 'messaging.sent', 'uses' => 'Messages\MessagesController@sent']);
	Route::get('/sentreply', ['as' => 'messaging.sentreply', 'uses' => 'Messages\MessagesController@sentreply']);
	Route::get('create', ['as' => 'messaging.create', 'uses' => 'Messages\MessagesController@create']);
	Route::get('compose/{loanId}/{userId}', ['as' => 'messaging.compose', 'uses' => 'Messages\MessagesController@compose']);
	Route::get('reply/{messageId}', ['as' => 'messaging.reply', 'uses' => 'Messages\MessagesController@reply']);
	Route::post('/', ['as' => 'messages.store', 'uses' => 'Messages\MessagesController@store']);
	Route::get('{id}', ['as' => 'messaging.show', 'uses' => 'Messages\MessagesController@show']);
	Route::get('delete-message/{messageId}', ['as' => 'messaging.delete-message', 'uses' => 'Messages\MessagesController@getDeleteMessages']);
	Route::put('{id}', ['as' => 'messaging.update', 'uses' => 'Messages\MessagesController@update']);
});

Route::get('ajax/values','Admin\BankAllocationController@getValues');


Route::get(
	'zip', function () {
		$files = glob(public_path().'/vendor');
		\Zipper::make(public_path().'/test_'.date('Y-m-d').'.zip')->folder('test')->add($files);
		return view('home');
	});


	Route::get('/system/mail/{to}/{toName}/{subject}/{contents}/{template_id}', function($to, $toName, $subject, $contents,$template_id)
	{
		if(isset($template_id) && $template_id != 0) {

			Mail::send('emails.template_'.$template_id.'',['contents' => $contents], function($message) use ($to, $toName, $subject) {
				$message->to($to, $toName)->subject($subject);
			});

		}else {

			Mail::send('emails.blank',['contents' => $contents], function($message) use ($to, $toName, $subject) {
				$message->to($to, $toName)->subject($subject);
			});
		}

	});

	Route::controller('insurances', 'Insurances\InsurancesController');
