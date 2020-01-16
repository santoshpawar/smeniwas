<?php namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model {

    public $table = "loans_uploads";
     
    protected $fillable = [
        'loan_id',

        //1 st tab
        'finyear_file1_path',
       
        'finyear_file2_path',
        'finyear_file3_path',
        'bank_name1',
        'bank_period1',
        'bank_file1_path',
        'bank_name2',
        'bank_period2',
        'bank_file2_path',
        'bank_name3',
        'bank_period3',
        'bank_file3_path',
        'cibilreport_file_path',
        //'pancard_file_path',
        'compancard_file_path',
        'vatreg_file_path',
        
        // 'shopestablish_file_path',
        'cor_file_path',
        'gurav_file_path',
        'rent_file_path',
        'udyog_file_path',
        'electricity_file_path',


        'addproof_file_path',
        'kyc_extra_file1_path',
        'kyc_extra_file2_path',
        

        //2nd tab
        'prom_bank_stmt_file_path',
        'prom_networth_file_path',
        'prom_cibilreport_file_path',
        'prom_kyc_addproof_name',
        'prom_kyc_addproof_file_path',
        'prom_idproof_name',
        'prom_idproof_file_path',
        'prom_visiting_file_path',
        'prom_pancard_file_path',
        'other_promoter_file_path',

        ///not known

        'business_corporate_file_path',

        //tab 3
        'business_cert_ecom_file_path',

        'business_invoice_equi1_file_path',
        'business_invoice_equi2_file_path',
        'business_invoice_equi3_file_path',
        
        'business_invoice_bill1_file_path',
        'business_invoice_bill2_file_path',
        'business_invoice_bill3_file_path',
        'business_invoice_bill4_file_path',
        'business_invoice_bill5_file_path',

        //new
        'business_invoice_bill6_file_path',
        'business_invoice_bill7_file_path',
       

        //4th tab
        'last_pro_val_report1_path',
        'last_pro_val_report2_path',
        'last_pro_val_report3_path',
        'pro_title_search_report1_path',
        'pro_title_search_report2_path',
        'pro_title_search_report3_path',
        'pro_tax_card1_path',
        'pro_tax_card2_path',
        'pro_tax_card3_path',
        'oc1_path',
        'oc2_path',
        'oc3_path',
        'society_share_cert1_path',
        'society_share_cert2_path',
        'society_share_cert3_path',
        'copy_7_12_extract1_path',
        'copy_7_12_extract2_path',
        'copy_7_12_extract3_path',
        'copy_last_sales_pur1_path',
        'copy_last_sales_pur2_path',
        'copy_last_sales_pur3_path',
        'municipal_plan1_path',
        'municipal_plan2_path',
        'municipal_plan3_path',
        'electricity_bill_1_path',
        'electricity_bill_2_path',
        'electricity_bill_2_path',


    ];

    public function getLoan(){
        return $this->belongsTo('App\Models\Loan\Loan','loan_id','id');
    }
}