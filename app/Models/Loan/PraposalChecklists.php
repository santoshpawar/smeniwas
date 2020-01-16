<?php namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;
 
class PraposalChecklists extends Model
{
	    public $table = "praposal_checklist";
	protected $fillable=[
	'id', 'loan_id', 'com_business_type', 'business_address', 'com_co_business_old', 'businessDescription', 'lastAuditedTurnover', 'othr_cibilscore', 
	'threeYearsFinancials', 'profitableLast2Years', 'ratioBreaches', 'ratioBreachesDescrip', 'KYC', 'customerVisit', 'customerVisitDescription','creditCell', 
	'creditCellDescription', 'refrenceCheck', 'refreanceCheckDescription', 'bankStatment', 'bankStatmentDescrip', 'latestTotalBorrowing',
	 'anyDefaultLenders', 'securityProvided', 'latestDEratio', 'securityProvidedDescrip', 'liquidityModel', 'liquidityModelDescrip', 
	 'daviationLoanMatrix', 'daviationLoanMatrixDescrip', 'companyKYC', 'disbursement_date', 'loan_purpose', 'recomndation',

	 //new for loanadmin create checklist
	 //kyc of business start

	 'moa_applicable1',
	 'moa_document1',
	 'moa_discrepancies1',
	 'moa_remark1',
	 //'moa_attachment1',

	 'cor_applicable1',
	 'cor_document1',
	 'cor_discrepancies1',
	 'cor_remark1',
	 //'cor_attachment1',

	 'pan_applicable1',
	 'pan_document1',
	 'pan_discrepancies1',
	 'pan_remark1',
	 //'pan_attachment1',

	 'shopcertificate_applicable1',
	 'shopcertificate_document1',
	 'shopcertificate_discrepancies1',
	 'shopcertificate_remark1',
	 //'shopcertificate_attachment1',

	 'gstcertificate_applicable1',
	 'gstcertificate_document1',
	 'gstcertificate_discrepancies1',
	 'gstcertificate_remark1',
	 //'gstcertificate_attachment1',

	 'ghumastalicence_applicable1',
	 'ghumastalicence_document1',
	 'ghumastalicence_discrepancies1',
	 'ghumastalicence_remark1',
	 //'ghumastalicence_attachment1',


	 'rentagreement_applicable1',
	 'rentagreement_document1',
	 'rentagreement_discrepancies1',
	 'rentagreement_remark1',
	 //'rentagreement_attachment1',


	 'udyogadhar_applicable1',
	 'udyogadhar_document1',
	 'udyogadhar_discrepancies1',
	 'udyogadhar_remark1',
	 //'udyogadhar_attachment1',


	 'electricitybill_applicable1',
	 'electricitybill_document1',
	 'electricitybill_discrepancies1',
	 'electricitybill_remark1',
	 //'electricitybill_attachment1',

	 'cibilofentity_applicable1',
	 'cibilofentity_document1',
	 'cibilofentity_discrepancies1',
	 'cibilofentity_remark1',
	 //'cibilofentity_attachment1',


	 'other1_applicable1',
	 'other1_document1',
	 'other1_remarks',

	 //kyc of promoter start

	 'pan2_applicable1',
	 'pan2_document1',
	 'pan2_discrepancies1',
	 'pan2_remark2',
	 //'pan2_attachment1',

	 'addressproof_applicable1',
	 'addressproof_document1',
	 'addressproof_discrepancies1',
	 'addressproof_remark2',
	 //'addressproof_attachment1',

	 'networthcertificate_applicable1',
	 'networthcertificate_document1',
	 'networthcertificate_discrepancies1',
	 'networthcertificate_remark2',
	 //'networthcertificate_attachment1',

	 'cibilofpromoter_applicable1',
	 'cibilofpromoter_document1',
	 'cibilofpromoter_discrepancies1',
	 'cibilofpromoter_remark2',
	 //'cibilofpromoter_attachment1',

	 'other2_applicable1',
	 'other2_document1',
	 'other2_remarks',

	//  //kyc of loan documents start

	 'acceptedtermsheet_applicable1',
	 'acceptedtermsheet_document1',
	 'acceptedtermsheet_discrepancies1',
	 'acceptedtermsheet_remark3',
	 //'acceptedtermsheet_attachment1',

	 'loanagreement_applicable1',
	 'loanagreement_document1',
	 'loanagreement_discrepancies1',
	 'loanagreement_remark3',
	 //'loanagreement_attachment1',

	 'personalguarantee_applicable1',
	 'personalguarantee_document1',
	 'personalguarantee_discrepancies1',
	 'personalguarantee_remark3',
	 //'personalguarantee_attachment1',

	 'signatureverification_applicable1',
	 'signatureverification_document1',
	 'signatureverification_discrepancies1',
	 'signatureverification_remark3',
	 //'signatureverification_attachment1',

	 'dpn_applicable1',
	 'dpn_document1',
	 'dpn_discrepancies1',
	 'dpn_remark3',
	 //'dpn_attachment1',

	 'boardresolve_applicable1',
	 'boardresolve_document1',
	 'boardresolve_discrepancies1',
	 'boardresolve_remark3',
	 //'boardresolve_attachment1',


	 'other3_applicable1',
	 'other3_document1',
	 'other3_remarks',

	//  //kyc of security started below
	'mortgagedocument_applicable1',
    'mortgagedocument_document1',
    'mortgagedocument_discrepancies1',
    'mortgagedocument_remark4',

    'hypothicationagreement_applicable1',
    'hypothicationagreement_document1',
    'hypothicationagreement_discrepancies1',
    'hypothicationagreement_remark4',

    'escrowagreement_applicable1',
    'escrowagreement_document1',
    'escrowagreement_discrepancies1',
    'escrowagreement_remark4',

    'nachagreement_applicable1',
    'nachagreement_document1',
    'nachagreement_discrepancies1',
    'nachagreement_remark4',

    'pdc_applicable1',
    'pdc_document1',
    'pdc_discrepancies1',
    'pdc_remark4',

    'pdccoveringletter_applicable1',
    'pdccoveringletter_document1',
    'pdccoveringletter_discrepancies1',
    'pdccoveringletter_remark4',


    'other4_applicable1',
    'other4_document1',
    'other4_remarks',



	 //end for loanadmin create checklist


	];
	public function getLoan(){
		return $this->belongsTo('App\Models\Loan\Loan','loan_id','id');
	}
	public function getUser(){
		return $this->belongsTo('App\Models\User','user_id','id');
	}
}
