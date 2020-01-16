<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('address3')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('pincode');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        Schema::create('loans', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('referredby_userid')->unsigned()->nullable();
            $table->foreign('referredby_userid')->references('id')->on('users');

            $table->integer('registered_address_id')->unsigned()->nullable();
            $table->foreign('registered_address_id')->references('id')->on('addresses');

            $table->string('loan_disable')->nullable()->default('N');//Loan Disable
            $table->string('type');
            $table->double('loan_amount')->nullable();	//Loan Amount
            $table->integer('loan_tenure')->nullable();	//Tenure in Year
            $table->string('bscNscCode');  //
            $table->string('companySharePledged');

            $table->double('turnover')->nullable();	//Latest Audited Turnover
            $table->string('end_use')->nullable();	//End Use List
            $table->integer('status')->nullable();

            //======Company/Business Background ========//
            //======KYC Details================//
            $table->string('com_business_type')->nullable(); //Business Type
            $table->string('com_cin_no')->nullable(); //Certificate of Incorporation Number
            $table->string('com_vat')->nullable(); //VAT Registration Number
            $table->string('com_service_tax_no')->nullable(); //Service Tax Registration Number
            //================================//

            //======Business BG================//
            $table->string('com_industry_segment')->nullable();	//Select Industry Segment
            $table->string('com_number_mfglocations')->nullable();	//Number of Manufacturing locations of your business
            $table->integer('com_number_officebranch')->nullable();	//Number of Office Branches
            $table->string('com_co_business_old')->nullable(); //How many years old is the business/company
            //============================================//

            //======Customer Sales Details================//
            $table->string('com_your_salestype')->nullable();;	//Are your Sales? = Domestic/Export/Both
            $table->string('com_annual_value_exports')->nullable();;	//Are your Sales? = Annual Value Exports
            $table->string('com_your_salestoa')->nullable();;	//Are Your Sales to a? = Large Company   Small & Medium Business   Retail Customers
            $table->string('com_areyou_distributor')->nullable();;	//Are you a distributor/stockists of any company = Yes/No
            $table->string('com_areyou_companyname')->nullable();;	//Company Name
            $table->string('com_areyou_productname')->nullable();;	//product Name
            $table->string('com_key_productservice_offered')->nullable();;	//Key Products/Services Offered (give brief description)
            //===========================================//

            //======Promoter/Director Details========//
            //stored in loans_promoterdtls table
            //================================================//

            //======Financial Information Company========//
            //======Balance Sheet Details=====//
            //stored in loans_blsheetdtl table
            //=================================//

            //======Proffit and Loss Details=====//
            //stored in loans_proffitloss table
            //=================================//

            //======Other Details=====//
            $table->string('fin_grossfixedassets')->nullable();;	 //Total Gross Fixed Assets
            $table->string('fin_grossvalueofplant')->nullable();;	 //Gross Value of Plant & Machinery (before depreciation)
            $table->string('fin_numofexistingloan')->nullable();;	 //Number of Existing Loan
            //=========================//
            //=========================//
            //Saving existing loan details in loans_existingloandtl
            //=========================//
            $table->string('fin_doyouknowcibil')->nullable();;	 //Do you know you CIBIL Score?
            $table->integer('fin_cibilscore')->nullable();;	 //Enter CIBIL Score
            $table->string('fin_addmonthlyintrest')->nullable();;	 //What is additional monthly interest + EMI liability that business can service? (Rs Lacs)
            //================================================//

            $table->string('other_outstandingamount')->nullable(); //Existing Loan Details other Outstanding Amount
            $table->string('other_totalmonthlyemi')->nullable();//Existing Loan Details other Total Monthly EMI

            //======Business Operational Details========//
            //save into  loans_businessoperationdtl table
            //==========================================//

            //======Security Details========//
            //save into  loans_securitydtl table
            //==========================================//

            $table->timestamps();
            $table->softDeletes();
        });
        DB::statement('ALTER TABLE loans AUTO_INCREMENT = 10001' );

        Schema::create('loans_salesarea_details', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('loan_id')->unsigned();
            $table->foreign('loan_id')->references('id')->on('loans');
            $table->string('sales_area_type')->nullable(); //What is your geographical area of Operation / Sales
            $table->string('city_name')->nullable(); //If selects City
            $table->string('city_name_1')->nullable(); //If selects City
            $table->string('city_name_2')->nullable(); //If selects City
            $table->string('multi_state_1')->nullable(); //if select multi city
            $table->string('multi_state_2')->nullable(); //if select multi city
            $table->string('multi_state_3')->nullable(); //if select multi city
            $table->string('multi_state_4')->nullable(); //if select multi city
            $table->string('multi_state_5')->nullable(); //if select multi city

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('loans_promoter_details', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('loan_id')->unsigned();
            $table->foreign('loan_id')->references('id')->on('loans');

            //======KYC Details=====//
            //save promotrs kyc detils in loans_promoter_kyc_details table
            //=====================//

            //======Financial Details=====//
            //===Assets Owned By Promoters ==//
            $table->string('fin_vehiclesowned')->nullable();;	//Vehicles Owned
            $table->double('fin_vehiclesowned_marketvalue')->nullable();;	//Market Value
            $table->string('fin_propertiesowned')->nullable();;	//Properties Owned
            $table->double('fin_fixeddeposit')->nullable();;	//Fixed Deposits
            $table->double('fin_mutualfunds')->nullable();;	//Mutual Funds
            $table->integer('fin_listedshares')->nullable();;	//Listed Shares Owned

            //==promoterliability==//
            //==Liabilities of Promoters==//
            $table->string('pl_bankname')->nullable();;	// Name of Bank
            $table->double('pl_amtoutstanding')->nullable();;	// Amount Outstanding
            $table->double('pl_monthlyemi')->nullable();;	// Monthly EMI
            $table->double('pl_totalliability')->nullable();;	// Total Liability

            //==Vehicle Loan ==//
            $table->string('vloan_bankname')->nullable();;	// Name of Bank
            $table->double('vloan_amtoutstanding')->nullable();;	// Amount Outstanding
            $table->double('vloan_monthlyemi')->nullable();;	// Monthly EMI
            $table->double('vloan_totalliability')->nullable();;	// Total Liability

            //==Mortgage Loan ==//
            $table->string('mortloan_bankname')->nullable();;	// Name of Bank
            $table->double('mortloan_amtoutstanding')->nullable();;	// Amount Outstanding
            $table->double('mortloan_monthlyemi')->nullable();;	// Monthly EMI
            $table->double('mortloan_totalliability')->nullable();;	// Total Liability

            //== Other Market Borrowings Loan  ==//
            $table->string('borrowloan_bankname')->nullable();;	// Name of Bank
            $table->double('borrowloan_amtoutstanding')->nullable();;	// Amount Outstanding
            $table->double('borrowloan_monthlyemi')->nullable();;	// Monthly EMI
            $table->string('borrowloan_totalliability')->nullable();;	// Total Liability

            //== Credit Card Details ==//
            $table->string('cc_bankname')->nullable();;	// Name of Card Issuer
            $table->double('cc_amtoutstanding')->nullable();;	// Amount Outstanding
            //==========================//
            $table->double('total_liablity')->nullable();;	// Networth Amount
            $table->double('networth')->nullable();;	// Networth Amount

            //==================================//

            //======Other Details=====//
            $table->string('othr_eduprofdegree')->nullable();;	 //Education/professional degree
            $table->string('othr_promoterare')->nullable();;	 //Promoters are (1st Generation Entrepreneurs,2nd Generation,3rd or More Generation)
            $table->string('othr_noofindependent')->nullable();; //Number of independent families involved in business

            $table->string('othr_sourceofincome')->nullable();;	 //Does promoter have other sources of income? (Interest, rental, others)
            $table->string('othr_doyouknowcibil')->nullable();; //Do you know you CIBIL Score?
            $table->integer('othr_cibilscore')->nullable();; //Enter CIBIL Score
            //==================================//

            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('loans_promoter_kyc_details', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('loan_id')->unsigned();
            $table->foreign('loan_id')->references('id')->on('loans');

            //======KYC Details=====//
            $table->string('kyc_name')->nullable();	//Your company has which of the following positions?
            $table->string('kyc_address_proof')->nullable();
            $table->string('kyc_proof_id')->nullable();
            $table->string('kyc_pan')->nullable();
            $table->string('kyc_din')->nullable();
            $table->string('kyc_address')->nullable();
            $table->string('kyc_state')->nullable();
            $table->string('kyc_pin')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });



        Schema::create('loans_promoter_property_details', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('loan_id')->unsigned();
            $table->foreign('loan_id')->references('id')->on('loans');
            $table->string('property_type')->nullable();	//Type of Property
            $table->double('market_value')->nullable(); //Market Value
            $table->string('location_city')->nullable(); //Location city
            $table->string('other_city_name')->nullable(); //Other Location city
            $table->string('is_mortgage')->nullable(); //Is it mortgaged=Yes/No
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('loans_balancesheet_details', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('loan_id')->unsigned();
            $table->foreign('loan_id')->references('id')->on('loans');
            $table->string('finyear')->nullable();	//Financial Year
            $table->double('networth')->nullable(); //Networth
            $table->double('total_debt')->nullable(); // Total Debt
            $table->double('term_debt')->nullable(); // Term Debt
            $table->double('debtors')->nullable(); // Debtors
            $table->double('inventory')->nullable(); // Inventory
            $table->double('creditors')->nullable(); // Creditors
            $table->double('net_fixed_assets')->nullable(); // Net Fixed Assets
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('loans_profitloss_details', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('loan_id')->unsigned();
            $table->foreign('loan_id')->references('id')->on('loans');
            $table->string('finyear')->nullable();	//Financial Year
            $table->double('revenue')->nullable(); //Revenue
            $table->double('ebitda_profit')->nullable(); // EBITDA/Operating Profit
            $table->double('interest_expense')->nullable(); // Interest Expense
            $table->double('pat')->nullable(); // PAT
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('loans_existingloan_details', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('loan_id')->unsigned();
            $table->foreign('loan_id')->references('id')->on('loans');
            $table->string('name')->nullable();	//Name
            $table->string('loan_type')->nullable(); //Type of Loan
            $table->double('amount_outstanding')->nullable(); // Outstanding Amount
            $table->double('amount_monthlyemi')->nullable(); // Monthly EMI Amount
            $table->integer('balance_tenure')->nullable(); // Balance Tenure
            $table->string('security_provided')->nullable(); // Security Provided
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('loans_businessoperation_details', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('loan_id')->unsigned();
            $table->foreign('loan_id')->references('id')->on('loans');

            $table->string('officepremise_type')->nullable();;	 //Is your Office Premise = Owned/Rented
            $table->double('approx_value')->nullable();;	 //Approx value
            $table->double('monthly_rentpaid')->nullable();;	 //Monthly Rent Paid
            $table->string('mfgpremise_type')->nullable();;	 //Is your Manufacturing premise on = Onwned/Leased
            $table->double('approx_land_value')->nullable();;	 // Approx Value of Land

            //Top 3 customers Basis Annual Sales
            //====================================
            $table->string('top3_custname_1')->nullable();	//Customer Name
            $table->double('top3_annsales_1')->nullable(); //Annual Sales Amount
            $table->string('top3_relationsince_1')->nullable(); // Relationship Since
            $table->string('top3_custname_2')->nullable();	//Customer Name
            $table->double('top3_annsales_2')->nullable(); //Annual Sales Amount
            $table->string('top3_relationsince_2')->nullable(); // Relationship Since
            $table->string('top3_custname_3')->nullable();	//Customer Name
            $table->double('top3_annsales_3')->nullable(); //Annual Sales Amount
            $table->string('top3_relationsince_3')->nullable(); // Relationship Since
            //=====================

            //===Do you have any long term contracts with any customers===//
            $table->string('longterm_contracts_type')->nullable();;	 // Do you have any long term contracts with any customers = Yes/No
            $table->string('longterm_name')->nullable();;	 // Names
            $table->string('longterm_years')->nullable();;	 // Number of years of contracts
            $table->double('longterm_ann_contract_value')->nullable();;	 // Annual Value of Contracts
            $table->integer('longterm_numofyear')->nullable();;	 // Numbers of years of customer sale relationship details
            //==========================================//


            //Top 3 debtors
            //====================================
            //As ON Date
            $table->string('ao_name_of_debtor_1')->nullable(); // Name of Debtor
            $table->double('ao_amount_outstanding_1')->nullable(); // Amount Outstanding
            $table->string('ao_period_outstanding_1')->nullable(); // Period Outstanding
            $table->string('ao_name_of_debtor_2')->nullable(); // Name of Debtor
            $table->double('ao_amount_outstanding_2')->nullable(); // Amount Outstanding
            $table->string('ao_period_outstanding_2')->nullable(); // Period Outstanding
            $table->string('ao_name_of_debtor_3')->nullable(); // Name of Debtor
            $table->double('ao_amount_outstanding_3')->nullable(); // Amount Outstanding
            $table->string('ao_period_outstanding_3')->nullable(); // Period Outstanding
            //====================================
            //As on Last Audited Balance Sheet
            $table->string('aud_name_of_debtor_1')->nullable(); // Name of Debtor
            $table->double('aud_amount_outstanding_1')->nullable(); // Amount Outstanding
            $table->string('aud_period_outstanding_1')->nullable(); // Period Outstanding
            $table->string('aud_name_of_debtor_2')->nullable(); // Name of Debtor
            $table->double('aud_amount_outstanding_2')->nullable(); // Amount Outstanding
            $table->string('aud_period_outstanding_2')->nullable(); // Period Outstanding
            $table->string('aud_name_of_debtor_3')->nullable(); // Name of Debtor
            $table->double('aud_amount_outstanding_3')->nullable(); // Amount Outstanding
            $table->string('aud_period_outstanding_3')->nullable(); // Period Outstanding
            //====================================
            //Top 3 suppliers
            $table->string('supplier_name_1')->nullable(); // Name of Supplier 1
            $table->double('supplier_amount_1')->nullable(); // Annual Amount 1
            $table->string('supplier_relation_1')->nullable(); // Relation Since 1
            $table->string('supplier_ref_name_1')->nullable(); // Reference Name 1
            $table->string('supplier_ref_contact_1')->nullable(); // Reference Contact 1
            $table->string('supplier_name_2')->nullable(); // Name of Supplier 2
            $table->double('supplier_amount_2')->nullable(); // Annual Amount 2
            $table->string('supplier_relation_2')->nullable(); // Relation Since 2
            $table->string('supplier_ref_name_2')->nullable(); // Reference Name 2
            $table->string('supplier_ref_contact_2')->nullable(); // Reference Contact 2
            $table->string('supplier_name_3')->nullable(); // Name of Supplier 3
            $table->double('supplier_amount_3')->nullable(); // Annual Amount 3
            $table->string('supplier_relation_3')->nullable(); // Relation Since 3
            $table->string('supplier_ref_name_3')->nullable(); // Reference Name 3
            $table->string('supplier_ref_contact_3')->nullable(); // Reference Contact 3

            //=====Details of competitors=======//
            $table->string('competitor_name_1')->nullable();	//Name 1
            $table->string('competitor_type_1')->nullable(); //Type of competitor 1
            $table->string('competitor_name_2')->nullable();	//Name 2
            $table->string('competitor_type_2')->nullable(); //Type of competitor 2
            $table->string('competitor_name_3')->nullable();	//Name 3
            $table->string('competitor_type_3')->nullable(); //Type of competitor 3
            $table->string('competitor_name_4')->nullable();	//Name 4
            $table->string('competitor_type_4')->nullable(); //Type of competitor 4

            //=====Which of the following positions are present in your company =======//
            $table->string('fin_positions_1')->nullable();;	 //Which of the following positions are present in your company
            $table->string('fin_positions_2')->nullable();;	 //Which of the following positions are present in your company
            $table->string('fin_positions_3')->nullable();;	 //Which of the following positions are present in your company
            $table->string('fin_positions_4')->nullable();;	 //Which of the following positions are present in your company
            $table->string('fin_positions_5')->nullable();;	 //Which of the following positions are present in your company

            $table->string('fin_profession_1')->nullable();;	 //Which of the above are held by professional other than promoters
            $table->string('fin_profession_2')->nullable();;	 //Which of the above are held by professional other than promoters
            $table->string('fin_profession_3')->nullable();;	 //Which of the above are held by professional other than promoters
            $table->string('fin_profession_4')->nullable();;	 //Which of the above are held by professional other than promoters
            $table->string('fin_profession_5')->nullable();;	 //Which of the above are held by professional other than promoters
            //===========================================//


            //=====================================================
            $table->string('relationship_type')->nullable();;	 //Are You any of the following
            //Monthly sales details for last 6 months
            $table->string('vendor_service_name')->nullable(); // Name of the Ecommerce company
            $table->string('vendor_relation_since')->nullable(); // Relationship Since
            $table->string('vendor_period_1')->nullable(); // Period
            $table->double('vendor_saleamount_1')->nullable(); // Sale Amount
            $table->string('vendor_products_sold_1')->nullable(); // Products Sold
            $table->string('vendor_period_2')->nullable(); // Period
            $table->double('vendor_saleamount_2')->nullable(); // Sale Amount
            $table->string('vendor_products_sold_2')->nullable(); // Products Sold
            $table->string('vendor_period_3')->nullable(); // Period
            $table->double('vendor_saleamount_3')->nullable(); // Sale Amount
            $table->string('vendor_products_sold_3')->nullable(); // Products Sold
            $table->string('vendor_period_4')->nullable(); // Period
            $table->double('vendor_saleamount_4')->nullable(); // Sale Amount
            $table->string('vendor_products_sold_4')->nullable(); // Products Sold
            $table->string('vendor_period_5')->nullable(); // Period
            $table->double('vendor_saleamount_5')->nullable(); // Sale Amount
            $table->string('vendor_products_sold_5')->nullable(); // Products Sold
            $table->string('vendor_period_6')->nullable(); // Period
            $table->double('vendor_saleamount_6')->nullable(); // Sale Amount
            $table->string('vendor_products_sold_6')->nullable(); // Products Sold
            //=====================================================

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('loans_security_details', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('loan_id')->unsigned();
            $table->foreign('loan_id')->references('id')->on('loans');

            $table->boolean('is_collateral_property')->nullable();	 //Collateral Property = Yes/No
            $table->string('othersecurity_type')->nullable();	 //Other Security radiobutton value
            $table->string('others_value')->nullable();	 //Other Security text-box value
            //======Type Of Security Offered - Collateral property
            $table->string('collateral_type')->nullable();	 //Type of collateral offered
            $table->string('area')->nullable();	 //Area
            $table->string('city')->nullable();	 //City
            $table->string('pincode')->nullable();	 //Pincode
            $table->string('owner')->nullable();	 //Owner
            $table->double('latest_valuation')->nullable();	 //Latest Valuation
            $table->string('occupied_type')->nullable();	 //IS = Self Occupied/Rented/Empty

            $table->string('equipment_type')->nullable();	 //Type of Equipment
            $table->string('equipment_type_others')->nullable();	 //Others Equipment type Value
            $table->string('description')->nullable();	 // Brief Description
            $table->string('sourced_type')->nullable(); // Sourced

            $table->string('manufacturer_name_mandatory')->nullable();	 // Name of Manufacturer Mandatory
            $table->integer('manufacture_year_mandatory')->nullable();	 // Year of Manufacture Mandatory

            $table->string('manufacturer_name')->nullable();	 // Name of Manufacturer
            $table->integer('manufacture_year')->nullable();	 // Year of Manufacture

            $table->double('invoice_cif_in_lacs')->nullable();	 //Invoice CIF Value in Lacs
            $table->double('custom_duty')->nullable();	 //Custom Duty
            $table->double('invoice_cif_in_usd')->nullable();	 //Invoice CIF Value in USD
            $table->double('invoice_value')->nullable();	 //Invoice Value in Lacs
            $table->string('avl_doc_name_1')->nullable();
            $table->string('avl_doc_name_2')->nullable();
            $table->string('avl_doc_name_3')->nullable();
            $table->string('avl_doc_name_4')->nullable();
            $table->string('avl_doc_name_5')->nullable();
            $table->string('avl_doc_name_6')->nullable();
            $table->string('avl_doc_name_7')->nullable();
            $table->string('avl_doc_name_8')->nullable();
            $table->string('avl_doc_name_9')->nullable();
            $table->string('avl_doc_name_10')->nullable();
            $table->string('avl_doc_name_11')->nullable();
            $table->string('avl_doc_name_12')->nullable();
            $table->string('avl_doc_name_12')->nullable();

            //
         //   $table->string('otherSecurityOther')->nullable();
          
            //======Buyers Details===//
            //save buyer details on loans_buyersdetls table ====//
            //=========================================//

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('loans_buyer_details', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('loan_id')->unsigned();
            $table->foreign('loan_id')->references('id')->on('loans');
            $table->integer('buyer_serial_num')->nullable();
            $table->string('buyer_name')->nullable();	//Name Of Buyer
            $table->double('avg_monthly_sale')->nullable(); //Average Monthly sales details for last 3 months
            $table->string('invoice_date_1')->nullable(); //Date of Invoice
            $table->double('amount_1')->nullable(); //Invoice Amount
            $table->string('payment_terms_1')->nullable(); //Payment Terms
            $table->string('invoice_date_2')->nullable(); //Date of Invoice
            $table->double('amount_2')->nullable(); //Invoice Amount
            $table->string('payment_terms_2')->nullable(); //Payment Terms
            $table->string('invoice_date_3')->nullable(); //Date of Invoice
            $table->double('amount_3')->nullable(); //Invoice Amount
            $table->string('payment_terms_3')->nullable(); //Payment Terms
            $table->string('invoice_date_4')->nullable(); //Date of Invoice
            $table->double('amount_4')->nullable(); //Invoice Amount
            $table->string('payment_terms_4')->nullable(); //Payment Terms
            $table->string('invoice_date_5')->nullable(); //Date of Invoice
            $table->double('amount_5')->nullable(); //Invoice Amount
            $table->string('payment_terms_5')->nullable(); //Payment Terms
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('loans_uploads', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('loan_id')->unsigned();
            $table->foreign('loan_id')->references('id')->on('loans');
            //KYC Details
            //================================================
            //Financials Reports/Balance Sheets
            $table->string('finyear_file1_path')->nullable();	//Balancesheet file for financial year1
            $table->string('finyear_file2_path')->nullable(); //Balancesheet file for financial year1
            $table->string('finyear_file3_path')->nullable(); //Balancesheet file for financial year1
            //Bank Statement
            $table->string('bank_name1')->nullable();	//Name of Bank
            $table->integer('bank_period1')->nullable(); //Period for Month/Year
            $table->string('bank_file1_path')->nullable(); //Upload File
            $table->string('bank_name2')->nullable();	//Name of Bank
            $table->integer('bank_period2')->nullable(); //Period for Month/Year
            $table->string('bank_file2_path')->nullable(); //Upload File
            $table->string('bank_name3')->nullable();	//Name of Bank
            $table->integer('bank_period3')->nullable(); //Period for Month/Year
            $table->string('bank_file3_path')->nullable(); //Upload File
            //CIBIL Report
            $table->string('cibilreport_file_path')->nullable(); //CIBIL Report
            //KYC Details
            $table->string('pancard_file_path')->nullable(); //PAN Card
            $table->string('vatreg_file_path')->nullable(); //VAT Registration Certificate
            $table->string('shopestablish_file_path')->nullable(); //Shop and Establishment Certificate
            $table->string('addproof_file_path')->nullable(); //Address Proof of Company Business
            $table->string('kyc_extra_file1_path')->nullable(); //KYC Details Extra field 1
            $table->string('kyc_extra_file2_path')->nullable(); //KYC Details Extra field 2
            //Promoter kyc and financial
            //================================================
            //Bank Statement
            $table->string('prom_bank_stmt_file_path')->nullable(); // Bank Statements
            //Financials
            $table->string('prom_networth_file_path')->nullable(); // Networth Certificate
            $table->string('prom_cibilreport_file_path')->nullable(); // CIBIL report
            //KYC Details
            $table->string('prom_kyc_addproof_name')->nullable(); // Address Proof name
            $table->string('prom_kyc_addproof_file_path')->nullable(); // Address Proof
            $table->string('prom_idproof_name')->nullable(); // Identity Proof Name
            $table->string('prom_idproof_file_path')->nullable(); // Identity Proof
            $table->string('prom_visiting_file_path')->nullable(); // Identity Proof
            $table->string('prom_pancard_file_path')->nullable(); // PAN Card of Promoter
            $table->string('business_corporate_file_path')->nullable(); // Corporate Presentation/Note on Business
            $table->string('business_cert_ecom_file_path')->nullable(); // Certificate with E-commerce Company/Large Retailer/OEM
            $table->string('business_invoice_equi1_file_path')->nullable(); // Invoice Copy of Equipment Purchase 1
            $table->string('business_invoice_equi2_file_path')->nullable(); // Invoice Copy of Equipment Purchase 2
            $table->string('business_invoice_equi3_file_path')->nullable(); // Invoice Copy of Equipment Purchase 3
            $table->string('business_invoice_bill1_file_path')->nullable(); // Copy of Invoice/Bill details
            $table->string('business_invoice_bill2_file_path')->nullable(); // Copy of Invoice/Bill details
            $table->string('business_invoice_bill3_file_path')->nullable(); // Copy of Invoice/Bill details
            $table->string('business_invoice_bill4_file_path')->nullable(); // Copy of Invoice/Bill details
            $table->string('business_invoice_bill5_file_path')->nullable(); // Copy of Invoice/Bill details

            $table->string('last_pro_val_report1_path')->nullable(); //Last Property Valuation Report
            $table->string('last_pro_val_report2_path')->nullable(); // Last Property Valuation Report
            $table->string('last_pro_val_report3_path')->nullable(); // Last Property Valuation Report

            $table->string('pro_title_search_report1_path')->nullable(); // Property Title Search Report
            $table->string('pro_title_search_report2_path')->nullable(); // Property Title Search Report
            $table->string('pro_title_search_report3_path')->nullable(); // Property Title Search Report

            $table->string('pro_tax_card1_path')->nullable(); // Proper Tax Card copy
            $table->string('pro_tax_card2_path')->nullable(); // Proper Tax Card copy
            $table->string('pro_tax_card3_path')->nullable(); // Proper Tax Card copy

            $table->string('oc1_path')->nullable(); // Occupation Certificate copy
            $table->string('oc2_path')->nullable(); // Occupation Certificate copy
            $table->string('oc3_path')->nullable(); // Occupation Certificate copy

            $table->string('society_share_cert1_path')->nullable(); // Society Share Certificate copy
            $table->string('society_share_cert2_path')->nullable(); // Society Share Certificate copy
            $table->string('society_share_cert3_path')->nullable(); // Society Share Certificate copy

            $table->string('copy_7_12_extract1_path')->nullable(); // Copy of 7 - 12 Extract
            $table->string('copy_7_12_extract2_path')->nullable(); // Copy of 7 - 12 Extract
            $table->string('copy_7_12_extract3_path')->nullable(); // Copy of 7 - 12 Extract

            $table->string('copy_last_sales_pur1_path')->nullable(); // Copy of Last Sales/Purchase Deed
            $table->string('copy_last_sales_pur2_path')->nullable(); // Copy of Last Sales/Purchase Deed
            $table->string('copy_last_sales_pur3_path')->nullable(); // Copy of Last Sales/Purchase Deed

            $table->string('municipal_plan1_path')->nullable(); // Municipal Plan
            $table->string('municipal_plan2_path')->nullable(); // Municipal Plan
            $table->string('municipal_plan3_path')->nullable(); // Municipal Plan

            $table->string('electricity_bill_1_path')->nullable(); // Electricity Bill
            $table->string('electricity_bill_2_path')->nullable(); // Electricity Bill
            $table->string('electricity_bill_3_path')->nullable(); // Electricity Bill

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('loans_status', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('loan_id')->unsigned();
            $table->foreign('loan_id')->references('id')->on('loans');
            $table->string('background')->nullable();	//Company Background Status
            $table->string('promoter_details')->nullable();	//Promoters Details Status
            $table->string('financials')->nullable();	//Financial details Status
            $table->string('business_details')->nullable();	//Business Details Status
            $table->string('security_details')->nullable();	//Security Details Status
            $table->string('upload_documents')->nullable();	//Upload Documents Status
            $table->string('input_blsheet')->nullable();	//Input Balance Sheet Status
            $table->string('input_p&l')->nullable();	//Input P & L Status
            $table->string('calculated_ratios')->nullable();	//Company Background Status
            $table->string('credit_model')->nullable();	//Company Background Status
            $table->string('collateral_model')->nullable();	//Company Background Status
            $table->string('niwas_query_status')->nullable();	//Status to be set to Y if a query is received from SMENiwas
            $table->string('rejected')->nullable();	//Status to be set to Y if loan is rejected
            $table->text('remark')->nullable();	//Reason for loan rejection
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('mobile_app_data', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('Firm_Name');
            $table->string('EntityType');
            $table->string('BusinessType');
            $table->string('KeyProduct');
            $table->integer('AuditedTurnover');
            $table->string('FirmPan');
            $table->string('FirmRegNo');
            $table->string('OwnerName');
            $table->string('Email');
            $table->string('Address');
             $table->string('City');
             $table->string('State');
             $table->integer('Pincode');
             $table->integer('Contact');
             $table->integer('CibilScore');
             $table->string('LenderName');
             $table->integer('OutstandingAmt');
             $table->integer('MonthlyEmi');
             $table->integer('Liability');
             $table->string('Degree');
             $table->string('PromoType');
             $table->string('Independent');
             $table->string('OwnedVehicle');
             $table->integer('MarketValue');
             $table->integer('OwnedProperty');
             $table->string('CustomerNature');
             $table->integer('OfficePremiseOwned')->nullable();
             $table->integer('OfficePremiseRented')->nullable();
             $table->integer('ManufacturePremise')->nullable();
             $table->string('BankName');
             $table->integer('Amount');
             $table->string('cust1');
             $table->string('sale1');
             $table->string('year1');
             $table->string('cust2');
             $table->string('sale2');
             $table->string('year2');
             $table->string('cust3');
             $table->string('sale3');
             $table->string('year3');
             $table->integer('CashSales');
             $table->string('LoanPurpose');
             $table->integer('ReqAmt');
             $table->string('PropType');
             $table->string('ColAddress');
             $table->string('ColCity');
             $table->integer('ColPincode');
             $table->integer('LatestVal');
             $table->string('CollateralType');
             $table->integer('status')->nullable()->default(0);//Loan Status
             $table->timestamps();
             $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('existing_lenders');
        Schema::drop('company_positions');
        Schema::drop('third_party_details');
        Schema::drop('property_details');
        Schema::drop('uploads');
        Schema::drop('promoter_details');
        Schema::drop('financials');
        Schema::drop('loans');
        Schema::drop('businesses');
        Schema::drop('addresses');
        Schema::drop('mobile_app_data');
    }

}
