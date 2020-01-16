<?php

use App\Models\Loan\Bankallocation\BankAllocationCategory;
use App\Models\Loan\Bankallocation\BankAllocationDimension;
use App\Models\Loan\Bankallocation\BankAllocationProfile;
use App\Models\BankMasterData;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class BankAllocationSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        //delete conf_bank_allocation_sub_dimension table records
        DB::table('conf_bank_allocation_sub_dimension')->truncate();

        //delete conf_bank_allocation_dimension table records
        DB::table('conf_bank_allocation_dimension')->truncate();

        //delete conf_bank_allocation_category table records
        DB::table('conf_bank_allocation_category')->truncate();

        //delete conf_bank_allocation_profile table records
        DB::table('conf_bank_allocation_profile')->truncate();

        //delete bank_master_datas table records
        DB::table('bank_master_datas')->truncate();

        $this->createRBLDetails();
        $this->createYesBankDetails();
        $this->createRatnakarBankDetails();
        $this->createAxisBankDetails();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }

    private function createRBLDetails(){
        $rblBank = new BankMasterData();
        $rblBank->name = 'Religare Bank Ltd.';
        $rblBank->save();

        /*
        $rblProfile = new BankAllocationProfile();
        $rblProfile->bank_id = $rblBank->id;
        $rblProfile->name = 'Religare Bank - Secured Loans Allocation Profile';
        $rblProfile->description = 'Bank Allocation Profile for Religare for Secured Loans Criteria';
        $rblProfile->sortorder = 5;
        $rblProfile->status = 1;
        $rblProfile->save();

        $finParametersCategory = new BankAllocationCategory();
        $finParametersCategory->profile_id = $rblProfile->id;
        $finParametersCategory->name = 'Financial Parameters';
        $finParametersCategory->sortorder = 5;
        $finParametersCategory->status = 1;
        $finParametersCategory->save();

        $busParametersCategory = new BankAllocationCategory();
        $busParametersCategory->profile_id = $rblProfile->id;
        $busParametersCategory->name = 'Business Parameters';
        $busParametersCategory->sortorder = 10;
        $busParametersCategory->status = 1;
        $busParametersCategory->save();

        $refCheckParametersCategory = new BankAllocationCategory();
        $refCheckParametersCategory->profile_id = $rblProfile->id;
        $refCheckParametersCategory->name = 'Reference Check/Credit Check';
        $refCheckParametersCategory->sortorder = 15;
        $refCheckParametersCategory->status = 1;
        $refCheckParametersCategory->save();

        $transactionParametersCategory = new BankAllocationCategory();
        $transactionParametersCategory->profile_id = $rblProfile->id;
        $transactionParametersCategory->name = 'Transaction Parameters';
        $transactionParametersCategory->sortorder = 20;
        $transactionParametersCategory->status = 1;
        $transactionParametersCategory->save();

        //insert conf_bank_allocation_dimension entries
        DB::table('conf_bank_allocation_dimension')->insert(array(
            array('category_id'=> $finParametersCategory->id, 'type' => 'Loan', 'name' => 'Turnover Tolerance', 'description' => 'Min/Max Tolerance range for turnover', 'model' => 'loans', 'attribute' => 'turnover', 'operand' => 'between', 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 5, 'status' => 0 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Loan', 'name' => 'Tenure Tolerance', 'description' => 'Min/Max Tolerance range for loan tenure', 'model' => 'loans', 'attribute' => 'loan_tenure', 'operand' => '<=', 'single_value' => 10, 'begin_range' => null, 'end_range' => null, 'sortorder' => 6, 'status' => 1 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'EBITDA Margin Ratio Tolerance', 'description' => 'EBITDA Margin Tolerance', 'model' => 'financials_ratios', 'attribute' => 'ebitda_netrevenue', 'operand' => null, 'single_value' => 0, 'begin_range' => null, 'end_range' => null, 'sortorder' => 10, 'status' => 0 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'PAT Margin Ratio Tolerance', 'description' => 'PAT Margin Tolerance', 'model' => 'financials_ratios', 'attribute' => 'pat_netrevenue', 'operand' => '>', 'single_value' => 0, 'begin_range' => null, 'end_range' => null, 'sortorder' => 11, 'status' => 0 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'Debt / EBITDA Ratio Tolerance', 'description' => 'Debt / EBITDA Tolerance', 'model' => 'financials_ratios', 'attribute' => 'total_debt_ebitda', 'operand' => '>', 'single_value' => 4, 'begin_range' => null, 'end_range' => null, 'sortorder' => 15, 'status' => 0 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'Debt / Turnover Ratio Tolerance', 'description' => 'Debt/Turnover Ratio Tolerance', 'model' => 'financials_ratios', 'attribute' => 'debt_turnover_ratio', 'operand' => '>', 'single_value' => 4, 'begin_range' => null, 'end_range' => null, 'sortorder' => 20, 'status' => 0 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'Networth / Total Assets Ratio Tolerance', 'description' => 'Networth / Total Assets Ratio Tolerance', 'model' => 'financials_ratios', 'attribute' => 'solvency_ratio', 'operand' => '>', 'single_value' => 4, 'begin_range' => null, 'end_range' => null, 'sortorder' => 20, 'status' => 0 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'Debt / Equity Ratio Tolerance', 'description' => 'Debt/Equity Ratio Tolerance', 'model' => 'financials_ratios', 'attribute' => 'debt_funds_ratio', 'operand' => '>', 'single_value' => 4, 'begin_range' => null, 'end_range' => null, 'sortorder' => 20, 'status' => 0 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Credit', 'name' => 'Credit Model Tolerance', 'description' => 'Credit Model Tolerance', 'model' => 'analyst_model_ratings', 'attribute' => 'final_score', 'operand' => '>', 'single_value' => 75, 'begin_range' => null, 'end_range' => null, 'sortorder' => 25, 'status' => 0 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Loan', 'name' => 'LTV Ratio', 'description' => 'LTV Ratio', 'model' => null, 'attribute' => null, 'operand' => null, 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 80, 'status' => 1 ),

            array('category_id'=> $busParametersCategory->id, 'type' => 'User Profile', 'name' => 'Legal Entity List', 'description' => 'Legal Entity Negative List', 'model' => 'user_profiles', 'attribute' => 'owner_entity_type', 'operand' => 'NOTIN', 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 30, 'status' => 0 ),
            array('category_id'=> $busParametersCategory->id, 'type' => 'Loan', 'name' => 'Industry Segment List', 'description' => 'Industry Segment List', 'model' => 'loans', 'attribute' => 'com_industry_segment', 'operand' => 'NOTIN', 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 35, 'status' => 1 ),
            array('category_id'=> $busParametersCategory->id, 'type' => 'Loan', 'name' => 'Vintage Threshold', 'description' => 'Vintage Threshold', 'model' => 'loans', 'attribute' => 'com_co_business_old', 'operand' => 'NOTIN', 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 40, 'status' => 1 ),
            array('category_id'=> $busParametersCategory->id, 'type' => 'User Profile', 'name' => 'Location List', 'description' => 'List of location of client', 'model' => 'user_profiles', 'attribute' => 'owner_city', 'operand' => 'IN', 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 45, 'status' => 1 ),

            array('category_id'=> $refCheckParametersCategory->id, 'type' => 'Loan', 'name' => 'CIBIL Score Threshold', 'description' => 'CIBIL Score Threshold', 'model' => 'loans', 'attribute' => 'fin_cibilscore', 'operand' => '>=', 'single_value' => 700, 'begin_range' => null, 'end_range' => null, 'sortorder' => 50, 'status' => 1 ),

            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Loan', 'name' => 'Product List', 'description' => 'List of Products', 'model' => 'loans', 'attribute' => 'type', 'operand' => 'IN', 'single_value' => NULL, 'begin_range' => null, 'end_range' => null, 'sortorder' => 55, 'status' => 0 ),
            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Loan', 'name' => 'Loan Amount Range', 'description' => 'Range of Loan Amount', 'model' => 'loans', 'attribute' => 'loan_amount', 'operand' => 'between', 'single_value' => NULL, 'begin_range' => 20, 'end_range' => 250, 'sortorder' => 60, 'status' => 1 ),

            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Loan', 'name' => 'Offered Security Type List', 'description' => 'Negative List of type of security offered', 'model' => 'loans_security_details', 'attribute' => 'collateral_type', 'operand' => 'NOTIN', 'single_value' => NULL, 'begin_range' => null, 'end_range' => null, 'sortorder' => 65, 'status' => 0 ),
            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Loan', 'name' => 'Collateral City List', 'description' => 'List of cities for offered collateral', 'model' => 'loans_security_details', 'attribute' => 'city', 'operand' => 'IN', 'single_value' => NULL, 'begin_range' => null, 'end_range' => null, 'sortorder' => 70, 'status' => 0 ),
            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Collateral', 'name' => 'Collateral Model Score Tolerance', 'description' => 'Collateral Model Score Tolerance', 'model' => 'analyst_model_ratings', 'attribute' => 'final_haircut', 'operand' => '>', 'single_value' => 40, 'begin_range' => null, 'end_range' => null, 'sortorder' => 75, 'status' => 0 ),

        ));

        //insert conf_industry_type_sector_outlook_mapping entries
        DB::table('conf_bank_allocation_sub_dimension')->insert([

            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Gems and Jewelery'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Chit Funds'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Nidhis'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Money lending'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Lottery & Gambling'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Transporters'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Astrologers / Purohits'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Building Material suppliers'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Waste/Scrap merchants'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Verification Agencies'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Collection Repossession Agencies'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'HUFs, BOI, Charitable Trust & Society'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Cyber cafes'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Internet Companies'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Labor contractors'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Multi- level Network Marketing'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Cable Operators/Video library/Video Parlors'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'STD/PCO outlets'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Entertainment Industry'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Petrol pumps'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Newspaper printing'],


            ['dimension_id' => BankAllocationDimension::where('name','=', 'Vintage Threshold')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => '1'],

            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Ahmedabad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Bavla'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Chhatral'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Gandhinagar'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Himatnagar'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Kadi'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Kalol'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Kheda'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Mehsana'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Nadiad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Barnala'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Bhatinda'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Malout'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Mansa'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Bangalore'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Hosur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Krishnagiri'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Ambala'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Baddi'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Chandigarh'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Mohali'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Panchkula'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Patiala'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Solan'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Zirakpur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Chennai'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Kancheepuram'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Tiruchirappalli'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Tiruvallur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Coimbatore'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Erode'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Namakkal'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Tirupur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Salem'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Hyderabad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Indore'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Khargone'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Pithampur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Ujjain'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Jaipur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Jalandhar'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Jodhpur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Karnal'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Panipat'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Yamunanagar'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Hooghly'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Howrah'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Kolkata'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Ludhiana'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Mumbai'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Navi Mumbai'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Thane'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Nagpur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Nashik'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Delhi'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Ghaziabad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Noida'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Gurgaon'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Faridabad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Sonepat'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Pune'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Raipur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Gandhidham'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Rajkot'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Navsari'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Surat'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Valsad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Vapi'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Vadodara'],

            ['dimension_id' => BankAllocationDimension::where('name','=', 'Product List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'STL'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Product List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'CC'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Product List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'LAP'],

            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Ahmedabad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Bavla'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Chhatral'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Gandhinagar'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Himatnagar'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Kadi'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Kalol'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Kheda'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Mehsana'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Nadiad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Barnala'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Bhatinda'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Malout'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Mansa'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Bangalore'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Hosur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Krishnagiri'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Ambala'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Baddi'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Chandigarh'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Mohali'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Panchkula'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Patiala'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Solan'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Zirakpur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Chennai'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Kancheepuram'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Tiruchirappalli'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Tiruvallur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Coimbatore'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Erode'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Namakkal'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Tirupur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Salem'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Hyderabad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Indore'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Khargone'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Pithampur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Ujjain'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Jaipur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Jalandhar'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Jodhpur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Karnal'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Panipat'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Yamunanagar'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Hooghly'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Howrah'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Kolkata'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Ludhiana'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Mumbai'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Navi Mumbai'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Thane'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Nagpur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Nashik'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Delhi'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Ghaziabad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Noida'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Gurgaon'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Faridabad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Sonepat'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Pune'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Raipur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Gandhidham'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Rajkot'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Navsari'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Surat'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Valsad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Vapi'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Vadodara'],
        ]);

        //Unsecured Profile from 5 lacs to 20 Lacs

        $rblProfile = new BankAllocationProfile();
        $rblProfile->bank_id = $rblBank->id;
        $rblProfile->name = 'Religare Bank - Unsecured Loans 5-20 Lacs Allocation Profile';
        $rblProfile->description = 'Bank Allocation Profile from 5 to 20 Lacs for Religare for Unsecured Loans Criteria';
        $rblProfile->sortorder = 10;
        $rblProfile->status = 1;
        $rblProfile->save();

        $finParametersCategory = new BankAllocationCategory();
        $finParametersCategory->profile_id = $rblProfile->id;
        $finParametersCategory->name = 'Financial Parameters';
        $finParametersCategory->sortorder = 5;
        $finParametersCategory->status = 1;
        $finParametersCategory->save();

        $busParametersCategory = new BankAllocationCategory();
        $busParametersCategory->profile_id = $rblProfile->id;
        $busParametersCategory->name = 'Business Parameters';
        $busParametersCategory->sortorder = 10;
        $busParametersCategory->status = 1;
        $busParametersCategory->save();

        $refCheckParametersCategory = new BankAllocationCategory();
        $refCheckParametersCategory->profile_id = $rblProfile->id;
        $refCheckParametersCategory->name = 'Reference Check/Credit Check';
        $refCheckParametersCategory->sortorder = 15;
        $refCheckParametersCategory->status = 1;
        $refCheckParametersCategory->save();

        $transactionParametersCategory = new BankAllocationCategory();
        $transactionParametersCategory->profile_id = $rblProfile->id;
        $transactionParametersCategory->name = 'Transaction Parameters';
        $transactionParametersCategory->sortorder = 20;
        $transactionParametersCategory->status = 1;
        $transactionParametersCategory->save();

        //insert conf_bank_allocation_dimension entries
        DB::table('conf_bank_allocation_dimension')->insert(array(
            array('category_id'=> $finParametersCategory->id, 'type' => 'Loan', 'name' => 'Turnover Tolerance', 'description' => 'Min/Max Tolerance range for turnover', 'model' => 'loans', 'attribute' => 'turnover', 'operand' => '>=', 'single_value' => 100, 'begin_range' => null, 'end_range' => null, 'sortorder' => 5, 'status' => 1 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Loan', 'name' => 'Tenure Tolerance', 'description' => 'Min/Max Tolerance range for loan tenure', 'model' => 'loans', 'attribute' => 'loan_tenure', 'operand' => '<=', 'single_value' => 3, 'begin_range' => null, 'end_range' => null, 'sortorder' => 6, 'status' => 1 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'EBITDA Margin Ratio Tolerance', 'description' => 'EBITDA Margin Tolerance', 'model' => 'financials_ratios', 'attribute' => 'ebitda_netrevenue', 'operand' => null, 'single_value' => 0, 'begin_range' => null, 'end_range' => null, 'sortorder' => 10, 'status' => 0 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'PAT Margin Ratio Tolerance', 'description' => 'PAT Margin Tolerance', 'model' => 'financials_ratios', 'attribute' => 'pat_netrevenue', 'operand' => '>', 'single_value' => 0, 'begin_range' => null, 'end_range' => null, 'sortorder' => 11, 'status' => 0 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'Debt / EBITDA Ratio Tolerance', 'description' => 'Debt / EBITDA Tolerance', 'model' => 'financials_ratios', 'attribute' => 'total_debt_ebitda', 'operand' => '>', 'single_value' => 4, 'begin_range' => null, 'end_range' => null, 'sortorder' => 15, 'status' => 0 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'Debt / Turnover Ratio Tolerance', 'description' => 'Debt/Turnover Ratio Tolerance', 'model' => 'financials_ratios', 'attribute' => 'debt_turnover_ratio', 'operand' => '>', 'single_value' => 4, 'begin_range' => null, 'end_range' => null, 'sortorder' => 20, 'status' => 0 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'Networth / Total Assets Ratio Tolerance', 'description' => 'Networth / Total Assets Ratio Tolerance', 'model' => 'financials_ratios', 'attribute' => 'solvency_ratio', 'operand' => '>', 'single_value' => 4, 'begin_range' => null, 'end_range' => null, 'sortorder' => 20, 'status' => 0 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'Debt / Equity Ratio Tolerance', 'description' => 'Debt/Equity Ratio Tolerance', 'model' => 'financials_ratios', 'attribute' => 'debt_funds_ratio', 'operand' => '>', 'single_value' => 4, 'begin_range' => null, 'end_range' => null, 'sortorder' => 20, 'status' => 0 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Credit', 'name' => 'Credit Model Tolerance', 'description' => 'Credit Model Tolerance', 'model' => 'analyst_model_ratings', 'attribute' => 'final_score', 'operand' => '>', 'single_value' => 75, 'begin_range' => null, 'end_range' => null, 'sortorder' => 25, 'status' => 0 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Loan', 'name' => 'LTV Ratio', 'description' => 'LTV Ratio', 'model' => null, 'attribute' => null, 'operand' => null, 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 80, 'status' => 1 ),

            array('category_id'=> $busParametersCategory->id, 'type' => 'User Profile', 'name' => 'Legal Entity List', 'description' => 'Legal Entity Negative List', 'model' => 'user_profiles', 'attribute' => 'owner_entity_type', 'operand' => 'NOTIN', 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 30, 'status' => 0 ),
            array('category_id'=> $busParametersCategory->id, 'type' => 'Loan', 'name' => 'Industry Segment List', 'description' => 'Industry Segment List', 'model' => 'loans', 'attribute' => 'com_industry_segment', 'operand' => 'NOTIN', 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 35, 'status' => 1 ),
            array('category_id'=> $busParametersCategory->id, 'type' => 'Loan', 'name' => 'Vintage Threshold', 'description' => 'Vintage Threshold', 'model' => 'loans', 'attribute' => 'com_co_business_old', 'operand' => 'NOTIN', 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 40, 'status' => 1 ),
            array('category_id'=> $busParametersCategory->id, 'type' => 'User Profile', 'name' => 'Location List', 'description' => 'List of location of client', 'model' => 'user_profiles', 'attribute' => 'owner_city', 'operand' => 'IN', 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 45, 'status' => 1 ),

            array('category_id'=> $refCheckParametersCategory->id, 'type' => 'Loan', 'name' => 'CIBIL Score Threshold', 'description' => 'CIBIL Score Threshold', 'model' => 'loans', 'attribute' => 'fin_cibilscore', 'operand' => '>=', 'single_value' => 700, 'begin_range' => null, 'end_range' => null, 'sortorder' => 50, 'status' => 1 ),

            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Loan', 'name' => 'Product List', 'description' => 'List of Products', 'model' => 'loans', 'attribute' => 'type', 'operand' => 'IN', 'single_value' => NULL, 'begin_range' => null, 'end_range' => null, 'sortorder' => 55, 'status' => 0 ),
            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Loan', 'name' => 'Loan Amount Range', 'description' => 'Range of Loan Amount', 'model' => 'loans', 'attribute' => 'loan_amount', 'operand' => 'between', 'single_value' => NULL, 'begin_range' => 5, 'end_range' => 20, 'sortorder' => 60, 'status' => 1 ),

            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Loan', 'name' => 'Offered Security Type List', 'description' => 'Negative List of type of security offered', 'model' => 'loans_security_details', 'attribute' => 'collateral_type', 'operand' => 'NOTIN', 'single_value' => NULL, 'begin_range' => null, 'end_range' => null, 'sortorder' => 65, 'status' => 0 ),
            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Loan', 'name' => 'Collateral City List', 'description' => 'List of cities for offered collateral', 'model' => 'loans_security_details', 'attribute' => 'city', 'operand' => 'IN', 'single_value' => NULL, 'begin_range' => null, 'end_range' => null, 'sortorder' => 70, 'status' => 0 ),
            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Collateral', 'name' => 'Collateral Model Score Tolerance', 'description' => 'Collateral Model Score Tolerance', 'model' => 'analyst_model_ratings', 'attribute' => 'final_haircut', 'operand' => '>', 'single_value' => 40, 'begin_range' => null, 'end_range' => null, 'sortorder' => 75, 'status' => 0 ),

        ));

        //insert conf_industry_type_sector_outlook_mapping entries
        DB::table('conf_bank_allocation_sub_dimension')->insert([

            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Gems and Jewelery'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Chit Funds'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Nidhis'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Money lending'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Lottery & Gambling'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Transporters'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Astrologers / Purohits'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Building Material suppliers'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Waste/Scrap merchants'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Verification Agencies'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Collection Repossession Agencies'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'HUFs, BOI, Charitable Trust & Society'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Cyber cafes'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Internet Companies'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Labor contractors'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Multi- level Network Marketing'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Cable Operators/Video library/Video Parlors'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'STD/PCO outlets'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Entertainment Industry'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Petrol pumps'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Newspaper printing'],


            ['dimension_id' => BankAllocationDimension::where('name','=', 'Vintage Threshold')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => '1'],

            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Ahmedabad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Bavla'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Chhatral'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Gandhinagar'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Himatnagar'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Kadi'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Kalol'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Kheda'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Mehsana'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Nadiad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Barnala'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Bhatinda'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Malout'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Mansa'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Bangalore'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Hosur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Krishnagiri'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Ambala'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Baddi'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Chandigarh'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Mohali'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Panchkula'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Patiala'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Solan'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Zirakpur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Chennai'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Kancheepuram'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Tiruchirappalli'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Tiruvallur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Coimbatore'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Erode'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Namakkal'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Tirupur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Salem'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Hyderabad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Indore'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Khargone'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Pithampur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Ujjain'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Jaipur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Jalandhar'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Jodhpur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Karnal'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Panipat'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Yamunanagar'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Hooghly'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Howrah'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Kolkata'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Ludhiana'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Mumbai'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Navi Mumbai'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Thane'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Nagpur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Nashik'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Delhi'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Ghaziabad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Noida'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Gurgaon'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Faridabad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Sonepat'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Pune'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Raipur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Gandhidham'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Rajkot'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Navsari'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Surat'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Valsad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Vapi'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Vadodara'],

            ['dimension_id' => BankAllocationDimension::where('name','=', 'Product List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'STL'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Product List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'CC'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Product List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'LAP'],

            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Ahmedabad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Bavla'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Chhatral'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Gandhinagar'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Himatnagar'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Kadi'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Kalol'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Kheda'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Mehsana'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Nadiad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Barnala'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Bhatinda'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Malout'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Mansa'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Bangalore'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Hosur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Krishnagiri'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Ambala'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Baddi'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Chandigarh'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Mohali'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Panchkula'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Patiala'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Solan'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Zirakpur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Chennai'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Kancheepuram'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Tiruchirappalli'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Tiruvallur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Coimbatore'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Erode'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Namakkal'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Tirupur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Salem'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Hyderabad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Indore'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Khargone'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Pithampur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Ujjain'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Jaipur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Jalandhar'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Jodhpur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Karnal'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Panipat'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Yamunanagar'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Hooghly'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Howrah'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Kolkata'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Ludhiana'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Mumbai'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Navi Mumbai'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Thane'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Nagpur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Nashik'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Delhi'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Ghaziabad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Noida'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Gurgaon'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Faridabad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Sonepat'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Pune'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Raipur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Gandhidham'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Rajkot'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Navsari'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Surat'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Valsad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Vapi'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Vadodara'],
        ]);

        //Unsecured Profile from 20 Lacs to 50 Lacs

        $rblProfile = new BankAllocationProfile();
        $rblProfile->bank_id = $rblBank->id;
        $rblProfile->name = 'Religare Bank - Unsecured Loans 20-50 Lacs Allocation Profile';
        $rblProfile->description = 'Bank Allocation Profile from 20 to 50 Lacs for Religare for Unsecured Loans Criteria';
        $rblProfile->sortorder = 10;
        $rblProfile->status = 1;
        $rblProfile->save();

        $finParametersCategory = new BankAllocationCategory();
        $finParametersCategory->profile_id = $rblProfile->id;
        $finParametersCategory->name = 'Financial Parameters';
        $finParametersCategory->sortorder = 5;
        $finParametersCategory->status = 1;
        $finParametersCategory->save();

        $busParametersCategory = new BankAllocationCategory();
        $busParametersCategory->profile_id = $rblProfile->id;
        $busParametersCategory->name = 'Business Parameters';
        $busParametersCategory->sortorder = 10;
        $busParametersCategory->status = 1;
        $busParametersCategory->save();

        $refCheckParametersCategory = new BankAllocationCategory();
        $refCheckParametersCategory->profile_id = $rblProfile->id;
        $refCheckParametersCategory->name = 'Reference Check/Credit Check';
        $refCheckParametersCategory->sortorder = 15;
        $refCheckParametersCategory->status = 1;
        $refCheckParametersCategory->save();

        $transactionParametersCategory = new BankAllocationCategory();
        $transactionParametersCategory->profile_id = $rblProfile->id;
        $transactionParametersCategory->name = 'Transaction Parameters';
        $transactionParametersCategory->sortorder = 20;
        $transactionParametersCategory->status = 1;
        $transactionParametersCategory->save();

        //insert conf_bank_allocation_dimension entries
        DB::table('conf_bank_allocation_dimension')->insert(array(
            array('category_id'=> $finParametersCategory->id, 'type' => 'Loan', 'name' => 'Turnover Tolerance', 'description' => 'Min/Max Tolerance range for turnover', 'model' => 'loans', 'attribute' => 'turnover', 'operand' => '>=', 'single_value' => 200, 'begin_range' => null, 'end_range' => null, 'sortorder' => 5, 'status' => 1 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Loan', 'name' => 'Tenure Tolerance', 'description' => 'Min/Max Tolerance range for loan tenure', 'model' => 'loans', 'attribute' => 'loan_tenure', 'operand' => '<=', 'single_value' => 3, 'begin_range' => null, 'end_range' => null, 'sortorder' => 6, 'status' => 1 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'EBITDA Margin Ratio Tolerance', 'description' => 'EBITDA Margin Tolerance', 'model' => 'financials_ratios', 'attribute' => 'ebitda_netrevenue', 'operand' => null, 'single_value' => 0, 'begin_range' => null, 'end_range' => null, 'sortorder' => 10, 'status' => 0 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'PAT Margin Ratio Tolerance', 'description' => 'PAT Margin Tolerance', 'model' => 'financials_ratios', 'attribute' => 'pat_netrevenue', 'operand' => '>', 'single_value' => 0, 'begin_range' => null, 'end_range' => null, 'sortorder' => 11, 'status' => 0 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'Debt / EBITDA Ratio Tolerance', 'description' => 'Debt / EBITDA Tolerance', 'model' => 'financials_ratios', 'attribute' => 'total_debt_ebitda', 'operand' => '>', 'single_value' => 4, 'begin_range' => null, 'end_range' => null, 'sortorder' => 15, 'status' => 0 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'Debt / Turnover Ratio Tolerance', 'description' => 'Debt/Turnover Ratio Tolerance', 'model' => 'financials_ratios', 'attribute' => 'debt_turnover_ratio', 'operand' => '>', 'single_value' => 4, 'begin_range' => null, 'end_range' => null, 'sortorder' => 20, 'status' => 0 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'Networth / Total Assets Ratio Tolerance', 'description' => 'Networth / Total Assets Ratio Tolerance', 'model' => 'financials_ratios', 'attribute' => 'solvency_ratio', 'operand' => '>', 'single_value' => 4, 'begin_range' => null, 'end_range' => null, 'sortorder' => 20, 'status' => 0 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'Debt / Equity Ratio Tolerance', 'description' => 'Debt/Equity Ratio Tolerance', 'model' => 'financials_ratios', 'attribute' => 'debt_funds_ratio', 'operand' => '>', 'single_value' => 4, 'begin_range' => null, 'end_range' => null, 'sortorder' => 20, 'status' => 0 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Credit', 'name' => 'Credit Model Tolerance', 'description' => 'Credit Model Tolerance', 'model' => 'analyst_model_ratings', 'attribute' => 'final_score', 'operand' => '>', 'single_value' => 75, 'begin_range' => null, 'end_range' => null, 'sortorder' => 25, 'status' => 0 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Loan', 'name' => 'LTV Ratio', 'description' => 'LTV Ratio', 'model' => null, 'attribute' => null, 'operand' => null, 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 80, 'status' => 1 ),

            array('category_id'=> $busParametersCategory->id, 'type' => 'User Profile', 'name' => 'Legal Entity List', 'description' => 'Legal Entity Negative List', 'model' => 'user_profiles', 'attribute' => 'owner_entity_type', 'operand' => 'NOTIN', 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 30, 'status' => 0 ),
            array('category_id'=> $busParametersCategory->id, 'type' => 'Loan', 'name' => 'Industry Segment List', 'description' => 'Industry Segment List', 'model' => 'loans', 'attribute' => 'com_industry_segment', 'operand' => 'NOTIN', 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 35, 'status' => 1 ),
            array('category_id'=> $busParametersCategory->id, 'type' => 'Loan', 'name' => 'Vintage Threshold', 'description' => 'Vintage Threshold', 'model' => 'loans', 'attribute' => 'com_co_business_old', 'operand' => 'NOTIN', 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 40, 'status' => 1 ),
            array('category_id'=> $busParametersCategory->id, 'type' => 'User Profile', 'name' => 'Location List', 'description' => 'List of location of client', 'model' => 'user_profiles', 'attribute' => 'owner_city', 'operand' => 'IN', 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 45, 'status' => 1 ),

            array('category_id'=> $refCheckParametersCategory->id, 'type' => 'Loan', 'name' => 'CIBIL Score Threshold', 'description' => 'CIBIL Score Threshold', 'model' => 'loans', 'attribute' => 'fin_cibilscore', 'operand' => '>=', 'single_value' => 700, 'begin_range' => null, 'end_range' => null, 'sortorder' => 50, 'status' => 1 ),

            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Loan', 'name' => 'Product List', 'description' => 'List of Products', 'model' => 'loans', 'attribute' => 'type', 'operand' => 'IN', 'single_value' => NULL, 'begin_range' => null, 'end_range' => null, 'sortorder' => 55, 'status' => 0 ),
            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Loan', 'name' => 'Loan Amount Range', 'description' => 'Range of Loan Amount', 'model' => 'loans', 'attribute' => 'loan_amount', 'operand' => 'between', 'single_value' => NULL, 'begin_range' => 20, 'end_range' => 50, 'sortorder' => 60, 'status' => 1 ),

            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Loan', 'name' => 'Offered Security Type List', 'description' => 'Negative List of type of security offered', 'model' => 'loans_security_details', 'attribute' => 'collateral_type', 'operand' => 'NOTIN', 'single_value' => NULL, 'begin_range' => null, 'end_range' => null, 'sortorder' => 65, 'status' => 0 ),
            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Loan', 'name' => 'Collateral City List', 'description' => 'List of cities for offered collateral', 'model' => 'loans_security_details', 'attribute' => 'city', 'operand' => 'IN', 'single_value' => NULL, 'begin_range' => null, 'end_range' => null, 'sortorder' => 70, 'status' => 0 ),
            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Collateral', 'name' => 'Collateral Model Score Tolerance', 'description' => 'Collateral Model Score Tolerance', 'model' => 'analyst_model_ratings', 'attribute' => 'final_haircut', 'operand' => '>', 'single_value' => 40, 'begin_range' => null, 'end_range' => null, 'sortorder' => 75, 'status' => 0 ),

        ));

        //insert conf_industry_type_sector_outlook_mapping entries
        DB::table('conf_bank_allocation_sub_dimension')->insert([

            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Gems and Jewelery'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Chit Funds'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Nidhis'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Money lending'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Lottery & Gambling'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Transporters'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Astrologers / Purohits'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Building Material suppliers'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Waste/Scrap merchants'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Verification Agencies'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Collection Repossession Agencies'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'HUFs, BOI, Charitable Trust & Society'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Cyber cafes'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Internet Companies'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Labor contractors'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Multi- level Network Marketing'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Cable Operators/Video library/Video Parlors'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'STD/PCO outlets'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Entertainment Industry'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Petrol pumps'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Industry Segment List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Newspaper printing'],


            ['dimension_id' => BankAllocationDimension::where('name','=', 'Vintage Threshold')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => '1'],

            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Ahmedabad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Bavla'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Chhatral'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Gandhinagar'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Himatnagar'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Kadi'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Kalol'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Kheda'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Mehsana'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Nadiad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Barnala'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Bhatinda'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Malout'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Mansa'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Bangalore'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Hosur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Krishnagiri'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Ambala'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Baddi'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Chandigarh'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Mohali'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Panchkula'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Patiala'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Solan'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Zirakpur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Chennai'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Kancheepuram'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Tiruchirappalli'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Tiruvallur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Coimbatore'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Erode'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Namakkal'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Tirupur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Salem'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Hyderabad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Indore'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Khargone'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Pithampur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Ujjain'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Jaipur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Jalandhar'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Jodhpur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Karnal'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Panipat'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Yamunanagar'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Hooghly'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Howrah'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Kolkata'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Ludhiana'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Mumbai'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Navi Mumbai'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Thane'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Nagpur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Nashik'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Delhi'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Ghaziabad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Noida'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Gurgaon'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Faridabad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Sonepat'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Pune'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Raipur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Gandhidham'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Rajkot'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Navsari'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Surat'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Valsad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Vapi'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Vadodara'],

            ['dimension_id' => BankAllocationDimension::where('name','=', 'Product List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'STL'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Product List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'CC'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Product List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'LAP'],

            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Ahmedabad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Bavla'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Chhatral'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Gandhinagar'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Himatnagar'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Kadi'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Kalol'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Kheda'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Mehsana'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Nadiad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Barnala'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Bhatinda'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Malout'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Mansa'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Bangalore'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Hosur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Krishnagiri'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Ambala'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Baddi'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Chandigarh'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Mohali'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Panchkula'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Patiala'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Solan'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Zirakpur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Chennai'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Kancheepuram'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Tiruchirappalli'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Tiruvallur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Coimbatore'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Erode'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Namakkal'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Tirupur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Salem'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Hyderabad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Indore'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Khargone'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Pithampur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Ujjain'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Jaipur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Jalandhar'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Jodhpur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Karnal'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Panipat'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Yamunanagar'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Hooghly'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Howrah'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Kolkata'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Ludhiana'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Mumbai'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Navi Mumbai'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Thane'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Nagpur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Nashik'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Delhi'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Ghaziabad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Noida'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Gurgaon'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Faridabad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Sonepat'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Pune'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Raipur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Gandhidham'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Rajkot'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Navsari'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Surat'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Valsad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Vapi'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Vadodara'],

        ]);
        */
    }

    private function createYesBankDetails(){
        $yesBank = new BankMasterData();
        $yesBank->name = 'Yes Bank Ltd.';
        $yesBank->description = 'Yes Bank';
        $yesBank->save();

        $yesBankProfile = new BankAllocationProfile();
        $yesBankProfile->bank_id = $yesBank->id;
        $yesBankProfile->name = 'Yes Bank Loans Allocation Profile';
        $yesBankProfile->description = 'Bank Allocation Profile for Yes Bank';
        $yesBankProfile->sortorder = 10;
        $yesBankProfile->status = 1;
        $yesBankProfile->save();



        $finParametersCategory = new BankAllocationCategory();
        $finParametersCategory->profile_id = $yesBankProfile->id;
        $finParametersCategory->name = 'Financial Parameters';
        $finParametersCategory->sortorder = 5;
        $finParametersCategory->status = 1;
        $finParametersCategory->save();

        $busParametersCategory = new BankAllocationCategory();
        $busParametersCategory->profile_id = $yesBankProfile->id;
        $busParametersCategory->name = 'Business Parameters';
        $busParametersCategory->sortorder = 10;
        $busParametersCategory->status = 1;
        $busParametersCategory->save();

        $refCheckParametersCategory = new BankAllocationCategory();
        $refCheckParametersCategory->profile_id = $yesBankProfile->id;
        $refCheckParametersCategory->name = 'Reference Check/Credit Check';
        $refCheckParametersCategory->sortorder = 15;
        $refCheckParametersCategory->status = 1;
        $refCheckParametersCategory->save();

        $transactionParametersCategory = new BankAllocationCategory();
        $transactionParametersCategory->profile_id = $yesBankProfile->id;
        $transactionParametersCategory->name = 'Transaction Parameters';
        $transactionParametersCategory->sortorder = 20;
        $transactionParametersCategory->status = 1;
        $transactionParametersCategory->save();

        //insert conf_bank_allocation_dimension entries
        DB::table('conf_bank_allocation_dimension')->insert(array(
            array('category_id'=> $finParametersCategory->id, 'type' => 'Loan', 'name' => 'Turnover Tolerance', 'description' => 'Min/Max Tolerance range for turnover', 'model' => 'loans', 'attribute' => 'turnover', 'operand' => '>=', 'single_value' => 200, 'begin_range' => null, 'end_range' => null, 'sortorder' => 5, 'status' => 1 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Loan', 'name' => 'Tenure Tolerance', 'description' => 'Min/Max Tolerance range for loan tenure', 'model' => 'loans', 'attribute' => 'loan_tenure', 'operand' => null, 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 6, 'status' => 0 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'EBITDA Margin Ratio Tolerance', 'description' => 'EBITDA Margin Tolerance', 'model' => 'financials_ratios', 'attribute' => 'ebitda_netrevenue', 'operand' => '>=', 'single_value' => 3, 'begin_range' => null, 'end_range' => null, 'sortorder' => 10, 'status' => 1 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'PAT Margin Ratio Tolerance', 'description' => 'PAT Margin Tolerance', 'model' => 'financials_ratios', 'attribute' => 'pat_netrevenue', 'operand' => '>=', 'single_value' => 3, 'begin_range' => null, 'end_range' => null, 'sortorder' => 11, 'status' => 1 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'Debt / EBITDA Ratio Tolerance', 'description' => 'Debt / EBITDA Tolerance', 'model' => 'financials_ratios', 'attribute' => 'total_debt_ebitda', 'operand' => '<=', 'single_value' => 6, 'begin_range' => null, 'end_range' => null, 'sortorder' => 15, 'status' => 1 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'Debt / Turnover Ratio Tolerance', 'description' => 'Debt/Turnover Ratio Tolerance', 'model' => 'financials_ratios', 'attribute' => 'debt_turnover_ratio', 'operand' => null, 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 20, 'status' => 0 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'Networth / Total Assets Ratio Tolerance', 'description' => 'Networth / Total Assets Ratio Tolerance', 'model' => 'financials_ratios', 'attribute' => 'solvency_ratio', 'operand' => '>=', 'single_value' => 20, 'begin_range' => null, 'end_range' => null, 'sortorder' => 22, 'status' => 1 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'Debt / Equity Ratio Tolerance', 'description' => 'Debt/Equity Ratio Tolerance', 'model' => 'financials_ratios', 'attribute' => 'debt_funds_ratio', 'operand' => '<=', 'single_value' => 5, 'begin_range' => null, 'end_range' => null, 'sortorder' => 23, 'status' => 1 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Credit', 'name' => 'Credit Model Tolerance', 'description' => 'Credit Model Tolerance', 'model' => 'analyst_model_ratings', 'attribute' => 'final_score', 'operand' => '>=', 'single_value' => 35, 'begin_range' => null, 'end_range' => null, 'sortorder' => 25, 'status' => 1 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Loan', 'name' => 'LTV Ratio', 'description' => 'LTV Ratio', 'model' => null, 'attribute' => null, 'operand' => null, 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 80, 'status' => 0 ),

            array('category_id'=> $busParametersCategory->id, 'type' => 'User Profile', 'name' => 'Legal Entity List', 'description' => 'Legal Entity Negative List', 'model' => 'user_profiles', 'attribute' => 'owner_entity_type', 'operand' => null, 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 30, 'status' => 0 ),
            array('category_id'=> $busParametersCategory->id, 'type' => 'Loan', 'name' => 'Industry Segment List', 'description' => 'Industry Segment List', 'model' => 'loans', 'attribute' => 'com_industry_segment', 'operand' => null, 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 35, 'status' => 0 ),
            array('category_id'=> $busParametersCategory->id, 'type' => 'Loan', 'name' => 'Vintage Threshold', 'description' => 'Vintage Threshold', 'model' => 'loans', 'attribute' => 'com_co_business_old', 'operand' => 'NOTIN', 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 40, 'status' => 1 ),
            array('category_id'=> $busParametersCategory->id, 'type' => 'User Profile', 'name' => 'Location List', 'description' => 'List of location of client', 'model' => 'user_profiles', 'attribute' => 'owner_city', 'operand' => null, 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 45, 'status' => 0 ),

            array('category_id'=> $refCheckParametersCategory->id, 'type' => 'Loan', 'name' => 'CIBIL Score Threshold', 'description' => 'CIBIL Score Threshold', 'model' => 'loans', 'attribute' => 'fin_cibilscore', 'operand' => '>=', 'single_value' => 450, 'begin_range' => null, 'end_range' => null, 'sortorder' => 50, 'status' => 1 ),

            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Loan', 'name' => 'Product List', 'description' => 'List of Products', 'model' => 'loans', 'attribute' => 'type', 'operand' => null, 'single_value' => NULL, 'begin_range' => null, 'end_range' => null, 'sortorder' => 55, 'status' => 0 ),
            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Loan', 'name' => 'Loan Amount Range', 'description' => 'Range of Loan Amount', 'model' => 'loans', 'attribute' => 'loan_amount', 'operand' => null, 'single_value' => NULL, 'begin_range' => null, 'end_range' => null, 'sortorder' => 60, 'status' => 0 ),

            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Loan', 'name' => 'Offered Security Type List', 'description' => 'Negative List of type of security offered', 'model' => 'loans_security_details', 'attribute' => 'collateral_type', 'operand' => 'NOTIN', 'single_value' => NULL, 'begin_range' => null, 'end_range' => null, 'sortorder' => 65, 'status' => 1 ),
            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Loan', 'name' => 'Collateral City List', 'description' => 'List of cities for offered collateral', 'model' => 'loans_security_details', 'attribute' => 'city', 'operand' => NULL, 'single_value' => NULL, 'begin_range' => null, 'end_range' => null, 'sortorder' => 70, 'status' => 0 ),
            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Collateral', 'name' => 'Collateral Model Score Tolerance', 'description' => 'Collateral Model Score Tolerance', 'model' => 'analyst_model_ratings', 'attribute' => 'final_haircut', 'operand' => '<=', 'single_value' => 60, 'begin_range' => null, 'end_range' => null, 'sortorder' => 75, 'status' => 1 ),

        ));

        //insert conf_industry_type_sector_outlook_mapping entries
        DB::table('conf_bank_allocation_sub_dimension')->insert([

            ['dimension_id' => BankAllocationDimension::where('name','=', 'Vintage Threshold')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => '1'],

            ['dimension_id' => BankAllocationDimension::where('name','=', 'Offered Security Type List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Land Agri'],
        ]);
    }

    private function createRatnakarBankDetails(){
        $yesBank = new BankMasterData();
        $yesBank->name = 'Ratnakar Bank Ltd.';
        $yesBank->description = 'Ratnakar Bank';
        $yesBank->save();

        $yesBankProfile = new BankAllocationProfile();
        $yesBankProfile->bank_id = $yesBank->id;
        $yesBankProfile->name = 'Ratnakar Bank Allocation Profile';
        $yesBankProfile->description = 'Bank Allocation Profile for Ratnakar Bank';
        $yesBankProfile->sortorder = 15;
        $yesBankProfile->status = 1;
        $yesBankProfile->save();



        $finParametersCategory = new BankAllocationCategory();
        $finParametersCategory->profile_id = $yesBankProfile->id;
        $finParametersCategory->name = 'Financial Parameters';
        $finParametersCategory->sortorder = 5;
        $finParametersCategory->status = 1;
        $finParametersCategory->save();

        $busParametersCategory = new BankAllocationCategory();
        $busParametersCategory->profile_id = $yesBankProfile->id;
        $busParametersCategory->name = 'Business Parameters';
        $busParametersCategory->sortorder = 10;
        $busParametersCategory->status = 1;
        $busParametersCategory->save();

        $refCheckParametersCategory = new BankAllocationCategory();
        $refCheckParametersCategory->profile_id = $yesBankProfile->id;
        $refCheckParametersCategory->name = 'Reference Check/Credit Check';
        $refCheckParametersCategory->sortorder = 15;
        $refCheckParametersCategory->status = 1;
        $refCheckParametersCategory->save();

        $transactionParametersCategory = new BankAllocationCategory();
        $transactionParametersCategory->profile_id = $yesBankProfile->id;
        $transactionParametersCategory->name = 'Transaction Parameters';
        $transactionParametersCategory->sortorder = 20;
        $transactionParametersCategory->status = 1;
        $transactionParametersCategory->save();

        //insert conf_bank_allocation_dimension entries
        DB::table('conf_bank_allocation_dimension')->insert(array(
            array('category_id'=> $finParametersCategory->id, 'type' => 'Loan', 'name' => 'Turnover Tolerance', 'description' => 'Min/Max Tolerance range for turnover', 'model' => 'loans', 'attribute' => 'turnover', 'operand' => 'between', 'single_value' => null, 'begin_range' => 200, 'end_range' => 500, 'sortorder' => 5, 'status' => 1 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Loan', 'name' => 'Tenure Tolerance', 'description' => 'Min/Max Tolerance range for loan tenure', 'model' => 'loans', 'attribute' => 'loan_tenure', 'operand' => null, 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 6, 'status' => 0 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'EBITDA Margin Ratio Tolerance', 'description' => 'EBITDA Margin Tolerance', 'model' => 'financials_ratios', 'attribute' => 'ebitda_netrevenue', 'operand' => '>=', 'single_value' => 10, 'begin_range' => null, 'end_range' => null, 'sortorder' => 10, 'status' => 1 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'PAT Margin Ratio Tolerance', 'description' => 'PAT Margin Tolerance', 'model' => 'financials_ratios', 'attribute' => 'pat_netrevenue', 'operand' => '>=', 'single_value' => 10, 'begin_range' => null, 'end_range' => null, 'sortorder' => 11, 'status' => 1 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'Debt / EBITDA Ratio Tolerance', 'description' => 'Debt / EBITDA Tolerance', 'model' => 'financials_ratios', 'attribute' => 'total_debt_ebitda', 'operand' => '<=', 'single_value' => 3.5, 'begin_range' => null, 'end_range' => null, 'sortorder' => 15, 'status' => 1 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'Debt / Turnover Ratio Tolerance', 'description' => 'Debt/Turnover Ratio Tolerance', 'model' => 'financials_ratios', 'attribute' => 'debt_turnover_ratio', 'operand' => null, 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 20, 'status' => 0 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'Networth / Total Assets Ratio Tolerance', 'description' => 'Networth / Total Assets Ratio Tolerance', 'model' => 'financials_ratios', 'attribute' => 'solvency_ratio', 'operand' => '>=', 'single_value' => 40, 'begin_range' => null, 'end_range' => null, 'sortorder' => 22, 'status' => 1 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Ratio', 'name' => 'Debt / Equity Ratio Tolerance', 'description' => 'Debt/Equity Ratio Tolerance', 'model' => 'financials_ratios', 'attribute' => 'debt_funds_ratio', 'operand' => '<=', 'single_value' => 2, 'begin_range' => null, 'end_range' => null, 'sortorder' => 23, 'status' => 1 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Credit', 'name' => 'Credit Model Tolerance', 'description' => 'Credit Model Tolerance', 'model' => 'analyst_model_ratings', 'attribute' => 'final_score', 'operand' => '>=', 'single_value' => 50, 'begin_range' => null, 'end_range' => null, 'sortorder' => 25, 'status' => 1 ),
            array('category_id'=> $finParametersCategory->id, 'type' => 'Loan', 'name' => 'LTV Ratio', 'description' => 'LTV Ratio', 'model' => null, 'attribute' => null, 'operand' => null, 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 80, 'status' => 0 ),

            array('category_id'=> $busParametersCategory->id, 'type' => 'User Profile', 'name' => 'Legal Entity List', 'description' => 'Legal Entity Negative List', 'model' => 'user_profiles', 'attribute' => 'owner_entity_type', 'operand' => 'NOTIN', 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 30, 'status' => 1 ),
            array('category_id'=> $busParametersCategory->id, 'type' => 'Loan', 'name' => 'Industry Segment List', 'description' => 'Industry Segment List', 'model' => 'loans', 'attribute' => 'com_industry_segment', 'operand' => null, 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 35, 'status' => 0 ),
            array('category_id'=> $busParametersCategory->id, 'type' => 'Loan', 'name' => 'Vintage Threshold', 'description' => 'Vintage Threshold', 'model' => 'loans', 'attribute' => 'com_co_business_old', 'operand' => 'NOTIN', 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 40, 'status' => 1 ),
            array('category_id'=> $busParametersCategory->id, 'type' => 'User Profile', 'name' => 'City Location List', 'description' => 'List of city locations of client', 'model' => 'user_profiles', 'attribute' => 'owner_city', 'operand' => null, 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 45, 'status' => 0 ),
            array('category_id'=> $busParametersCategory->id, 'type' => 'User Profile', 'name' => 'States Location List', 'description' => 'List of state locations of client', 'model' => 'user_profiles', 'attribute' => 'owner_state', 'operand' => 'NOTIN', 'single_value' => null, 'begin_range' => null, 'end_range' => null, 'sortorder' => 46, 'status' => 1 ),

            array('category_id'=> $refCheckParametersCategory->id, 'type' => 'Loan', 'name' => 'CIBIL Score Threshold', 'description' => 'CIBIL Score Threshold', 'model' => 'loans', 'attribute' => 'fin_cibilscore', 'operand' => '>=', 'single_value' => 650, 'begin_range' => null, 'end_range' => null, 'sortorder' => 50, 'status' => 1 ),

            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Loan', 'name' => 'Product List', 'description' => 'List of Products', 'model' => 'loans', 'attribute' => 'type', 'operand' => 'NOTIN', 'single_value' => NULL, 'begin_range' => null, 'end_range' => null, 'sortorder' => 55, 'status' => 1 ),
            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Loan', 'name' => 'Loan Amount Range', 'description' => 'Range of Loan Amount', 'model' => 'loans', 'attribute' => 'loan_amount', 'operand' => '<=', 'single_value' => 1500, 'begin_range' => null, 'end_range' => null, 'sortorder' => 60, 'status' => 1 ),

            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Loan', 'name' => 'Offered Security Type List', 'description' => 'Negative List of type of security offered', 'model' => 'loans_security_details', 'attribute' => 'collateral_type', 'operand' => 'NOTIN', 'single_value' => NULL, 'begin_range' => null, 'end_range' => null, 'sortorder' => 65, 'status' => 1 ),
            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Loan', 'name' => 'Collateral City List', 'description' => 'List of cities for offered collateral', 'model' => 'loans_security_details', 'attribute' => 'city', 'operand' => 'IN', 'single_value' => NULL, 'begin_range' => null, 'end_range' => null, 'sortorder' => 70, 'status' => 1 ),
            array('category_id'=> $transactionParametersCategory->id, 'type' => 'Collateral', 'name' => 'Collateral Model Score Tolerance', 'description' => 'Collateral Model Score Tolerance', 'model' => 'analyst_model_ratings', 'attribute' => 'final_haircut', 'operand' => '<=', 'single_value' => 60, 'begin_range' => null, 'end_range' => null, 'sortorder' => 75, 'status' => 1 ),

        ));

        //insert conf_industry_type_sector_outlook_mapping entries
        DB::table('conf_bank_allocation_sub_dimension')->insert([
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Legal Entity List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Partnership Firm'],

            ['dimension_id' => BankAllocationDimension::where('name','=', 'Vintage Threshold')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => '1'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Vintage Threshold')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => '2'],

            ['dimension_id' => BankAllocationDimension::where('name','=', 'States Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Uttar Pradesh'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'States Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Bihar'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'States Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Odisha'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'States Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Arunachal Pradesh'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'States Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Manipur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'States Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Meghalaya'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'States Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Mizoram'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'States Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Nagaland'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'States Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Sikkim'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'States Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Tripura'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'States Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'Jammu and Kashmir'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'States Location List')->where('category_id','=',$busParametersCategory->id)->get()->first()->id, 'value' => 'West Bengal'],

            ['dimension_id' => BankAllocationDimension::where('name','=', 'Product List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'UBL'],


            ['dimension_id' => BankAllocationDimension::where('name','=', 'Offered Security Type List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Land Agri'],

            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Mumbai'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'National Capital Territory of Delhi'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Bangalore'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Chennai'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Pune'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Ahmedabad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Hyderabad'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Jaipur'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Chandigarh'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Nashik'],
            ['dimension_id' => BankAllocationDimension::where('name','=', 'Collateral City List')->where('category_id','=',$transactionParametersCategory->id)->get()->first()->id, 'value' => 'Nagpur'],
        ]);
    }

    private function createAxisBankDetails(){
        $axisBank = new BankMasterData();
        $axisBank->name = 'Axis Bank Ltd.';
        $axisBank->description = 'Axis Bank';
        $axisBank->save();

    }
}