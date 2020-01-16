    <?php
use App\Models\Questions\ConfiguredQuestion;
use App\Models\Questions\MasterQuestion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class QuestionsConfigurationSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        //Eloquent::unguard();

        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        //delete child and then parent table records
        DB::table('conf_question_mappings')->truncate();
        DB::table('conf_fields')->truncate();
        DB::table('conf_conditions')->truncate();
        DB::table('conf_questions')->truncate();
        DB::table('conf_question_masters')->truncate();
        //insert question master entries
        DB::table('conf_question_masters')->insert(array(

            //Company/Business Background (A) - Kyc details - A1
            array('question_label' => 'Select Business Type', 'category_label'=> 'Company/Business Background - KYC Details', 'questionnumber'=>'A1.1', 'status' => 1),
            array('question_label' => 'VAT', 'category_label'=> 'Company/Business Background - KYC Details', 'questionnumber'=>'A1.2', 'status' => 1),
            array('question_label' => 'Certificate of Incorporation Number (CIN)', 'category_label'=> 'Company/Business Background - KYC Details', 'questionnumber'=>'A1.3', 'status' => 1),
            array('question_label' => 'Service Tax', 'category_label'=> 'Company/Business Background - KYC Details', 'questionnumber'=> 'A1.4', 'status' => 1),

            //Company/Business Background - Business Background - A2
            array('question_label' => 'Select Industry Segment', 'category_label'=> 'Company/Business Background', 'questionnumber'=> 'A2.1', 'status' => 1),
            array('question_label' => 'Number of Manufacturing locations of your business', 'category_label'=> 'Company/Business Background', 'questionnumber'=> 'A2.2', 'status' => 1),
            array('question_label' => 'Number of Office Branches', 'category_label'=> 'Company/Business Background', 'questionnumber'=> 'A2.3', 'status' => 1),
            array('question_label' => 'How many years old is the business/company?', 'category_label'=> 'Company/Business Background', 'questionnumber'=> 'A2.4', 'status' => 1),
            array('question_label' => 'What is your geographical area of Operation / Sales', 'category_label'=> 'Company/Business Background', 'questionnumber'=> 'A2.5', 'status' => 1),
            //Company/Business Background - Customer/Sales Details - A3
            array('question_label' => 'Are your Sales ?', 'category_label'=> 'Company/Business  Background', 'questionnumber'=> 'A3.1', 'status' => 1),
            array('question_label' => 'Are Your Sales to a?', 'category_label'=> 'Company/Business  Background', 'questionnumber'=> 'A3.2', 'status' => 1),
            array('question_label' => 'Are you a distributor/stockists of any company', 'category_label'=> 'Company/Business  Background', 'questionnumber'=> 'A3.3', 'status' => 1),
            array('question_label' => 'Key Products/Services Offered (give brief description)', 'category_label'=> 'Company/Business  Background', 'questionnumber'=> 'A3.4', 'status' => 1),
            //Promoter/Director Details (B) - KYC Details - B1
            array('question_label' => 'KYC Details', 'category_label'=> 'Promoter/Director Details - KYC Details', 'questionnumber'=> 'B1', 'status' => 1),
            array('question_label' => 'Name', 'category_label'=> 'Promoter/Director Details - KYC Details', 'questionnumber'=> 'B1.1', 'status' => 1),
            array('question_label' => 'Director Identification Number (DIN)', 'category_label'=> 'Promoter/Director Details - KYC Details', 'questionnumber'=> 'B1.2', 'status' => 1),
            array('question_label' => 'PAN Card Number', 'category_label'=> 'Promoter/Director Details - KYC Details', 'questionnumber'=> 'B1.3', 'status' => 1),
            array('question_label' => 'Address Proof Type', 'category_label'=> 'Promoter/Director Details - KYC Details', 'questionnumber'=> 'B1.4', 'status' => 1),
            array('question_label' => 'ID of chosen address proof', 'category_label'=> 'Promoter/Director Details - KYC Details', 'questionnumber'=> 'B1.5', 'status' => 1),
            array('question_label' => 'Address', 'category_label'=> 'Promoter/Director Details - KYC Details', 'questionnumber'=> 'B1.6', 'status' => 1),
            array('question_label' => 'State', 'category_label'=> 'Promoter/Director Details - KYC Details', 'questionnumber'=> 'B1.7', 'status' => 1),
            array('question_label' => 'Pin Code', 'category_label'=> 'Promoter/Director Details - KYC Details', 'questionnumber'=> 'B1.8', 'status' => 1),
            //Promoter/Director Details (B) - Financial Details (Assets Owned By Promoters) - B2.1
            array('question_label' => 'Vehicle Owned', 'category_label'=> 'Promoter/Director Details - Financial Details', 'questionnumber'=> 'B2.1', 'status' => 1),
            array('question_label' => 'Properties Owned', 'category_label'=> 'Promoter/Director Details - Financial Details', 'questionnumber'=> 'B2.2', 'status' => 1),
            array('question_label' => 'Other Assets Owned', 'category_label'=> 'Promoter/Director Details - Financial Details', 'questionnumber'=> 'B2.3', 'status' => 1),
            array('question_label' => 'Total Assets Owned', 'category_label'=> 'Promoter/Director Details - Financial Details', 'questionnumber'=> 'B2.4', 'status' => 1),
            //Promoter/Director Details (B) - Financial Details (Liabilities of Promoters) B2.2
            array('question_label' => 'Personnel Loan/Overdraft', 'category_label'=> 'Promoter/Director Details - Financial Details', 'questionnumber'=> 'B2.5', 'status' => 1),
            array('question_label' => 'Vehicle Loan', 'category_label'=> 'Promoter/Director Details - Financial Details', 'questionnumber'=> 'B2.6', 'status' => 1),
            array('question_label' => 'Mortgage Loan', 'category_label'=> 'Promoter/Director Details - Financial Details', 'questionnumber'=> 'B2.7', 'status' => 1),
            //Promoter/Director Details (B) - Financial Details (Other Market Borrowings Loan)
            array('question_label' => 'Other Market Borrowings Loan', 'category_label'=> 'Promoter/Director Details - Financial Details', 'questionnumber'=> 'B2.8', 'status' => 1),
            //Promoter/Director Details - Financial Details (Credit Card Details)
            array('question_label' => 'Credit Card Details', 'category_label'=> 'Promoter/Director Details - Financial Details', 'questionnumber'=> 'B2.9', 'status' => 1),
            //Promoter/Director Details - Financial Details (Total Liabilities)
            array('question_label' => 'Total Liabilities', 'category_label'=> 'Promoter/Director Details - Financial Details', 'questionnumber'=> 'B2.10', 'status' => 1),
            //Promoter/Director Details - Financial Details (Net Worth Total)
            array('question_label' => 'NetWorth Total', 'category_label'=> 'Promoter/Director Details - Financial Details', 'questionnumber'=> 'B2.11', 'status' => 1),
            //Promoter/Director Details - Other Details - B3
            array('question_label' => 'Education/Professional Degree', 'category_label'=> 'Promoter/Director Details - Other Details', 'questionnumber'=> 'B3.1', 'status' => 1),
            array('question_label' => 'Promoters Are', 'category_label'=> 'Promoter/Director Details - Other Details', 'questionnumber'=> 'B3.2', 'status' => 1),
            array('question_label' => 'Number of independent families involved in business', 'category_label'=> 'Promoter/Director Details - Other Details', 'questionnumber'=> 'B3.3', 'status' => 1),
            array('question_label' => 'Does promoters have other sources of income (rental, interest etc)', 'category_label'=> 'Promoter/Director Details - Other Details', 'questionnumber'=> 'B3.4', 'status' => 1),
            array('question_label' => 'Do you know you CIBIL Score ?', 'category_label'=> 'Promoter/Director Details - Other Details', 'questionnumber'=> 'B3.5', 'status' => 1),
            //Business Operational Details (D)
            array('question_label' => 'Is your Office Premise (Owned / Rented)', 'category_label'=> 'Business Operational Details', 'questionnumber'=> 'D3.1', 'status' => 1),
            array('question_label' => 'Is your Manufacturing premise on (Owned/Leased)', 'category_label'=> 'Business Operational Details', 'questionnumber'=> 'D3.2', 'status' => 1),
            array('question_label' => 'Do you have any long term contracts with any customers', 'category_label'=> 'Business Operational Details', 'questionnumber'=> 'D3.4', 'status' => 1),
            // Business Operational Details - Top 3 Debtors - As on Date
            array('question_label' => 'As on Date', 'category_label'=> 'Business Operational Details', 'questionnumber'=> 'D3.5.1', 'status' => 1),
            // Business Operational Details - Top 3 Debtors - As on Last Audited Balance Sheet
            array('question_label' => 'Name of Debtors', 'category_label'=> 'Business Operational Details', 'questionnumber'=> 'D3.5.2', 'status' => 1),
            // Business Operational Details - Top 3 Suppliers
            array('question_label' => 'Top 3 Suppliers', 'category_label'=> 'Business Operational Details', 'questionnumber'=> 'D3.6', 'status' => 1),
            // Business Operational Details - Details of Compititors
            array('question_label' => 'Details of Compititors', 'category_label'=> 'Business Operational Details', 'questionnumber'=> 'D3.7', 'status' => 1),
            array('question_label' => 'Which of the following positions are present in your company ( Select one or more as applicable )', 'category_label'=> 'Business Operational Details', 'questionnumber'=> 'D3.8', 'status' => 1),
            array('question_label' => 'Which of the above are held by professional other than promoters ( Select one or more as applicable )', 'category_label'=> 'Business Operational Details', 'questionnumber'=> 'D3.9', 'status' => 1),
            array('question_label' => 'Are You any of the following', 'category_label'=> 'Business Operational Details', 'questionnumber'=> 'D3.10', 'status' => 1),
            //Security Details (E)
            array('question_label' => 'Collateral Property', 'category_label'=> 'Security Details', 'questionnumber'=> 'E1', 'status' => 1),
            array('question_label' => 'Other Security', 'category_label'=> 'Security Details', 'questionnumber'=> 'E2', 'status' => 1),
            array('question_label' => 'Details of Equipment being Purchased', 'category_label'=> 'Security Details', 'questionnumber'=> 'E3', 'status' => 1),
            array('question_label' => 'Details of Receivable Discounted', 'category_label'=> 'Security Details', 'questionnumber'=> 'E4', 'status' => 1),
            //Upload Documents (F) - Company KYC & Financials (F1)
            array('question_label' => 'Last 3 financial year Balance sheet', 'category_label'=> 'Upload Documents', 'questionnumber'=> 'F1.1', 'status' => 1),
            array('question_label' => 'Bank Statement', 'category_label'=> 'Upload Documents', 'questionnumber'=> 'F1.2', 'status' => 1),
            array('question_label' => 'KYC Details', 'category_label'=> 'Upload Documents', 'questionnumber'=> 'F1.3', 'status' => 1),
            //Upload Documents (F)- Promoter KYC & Financials (F2)
            array('question_label' => 'Bank Statements', 'category_label'=> 'Upload Documents', 'questionnumber'=> 'F2.1', 'status' => 1),
            array('question_label' => 'Financials', 'category_label'=> 'Upload Documents', 'questionnumber'=> 'F2.2', 'status' => 1),
            array('question_label' => 'KYC Details', 'category_label'=> 'Upload Documents', 'questionnumber'=> 'F2.3', 'status' => 1),
            //Upload Documents (F) - Business/Contracts (F3)
            array('question_label' => 'Corporate Presentation/Note on Business', 'category_label'=> 'Upload Documents', 'questionnumber'=> 'F3.1', 'status' => 1),
            array('question_label' => 'Certificate with E-commerce Company/Large Retailer/OEM', 'category_label'=> 'Upload Documents', 'questionnumber'=> 'F3.2', 'status' => 1),
            array('question_label' => 'Invoice Copy of Equipment Purchase', 'category_label'=> 'Upload Documents', 'questionnumber'=> 'F3.3', 'status' => 1),
            array('question_label' => 'Copy of Invoice/Bill details', 'category_label'=> 'Upload Documents', 'questionnumber'=> 'F3.4', 'status' => 1),
            //Upload Documents (F) - Security Documents Details(F4)
            array('question_label' => 'Security Documents Details', 'category_label'=> 'Upload Documents', 'questionnumber'=> 'F4', 'status' => 1),

            ));




        $loanType = Config::get('constants.CONST_LOAN_TYPE_LAP');
        $stlLoanType = Config::get('constants.CONST_LOAN_TYPE_STL');
        $eflLoanType = Config::get('constants.CONST_LOAN_TYPE_EFL');
        $ublLoanType = Config::get('constants.CONST_LOAN_TYPE_UBL');
        $vflLoanType = Config::get('constants.CONST_LOAN_TYPE_VF');
        $cscflLoanType = Config::get('constants.CONST_LOAN_TYPE_CSCF');

        DB::table('conf_questions')->insert(array(
            //Loan Against Property
            //B2.1
            array('conf_master_id' => '23', 'loan_type'=> $loanType , 'status' => 1),
            //B2.5
            array('conf_master_id' => '27', 'loan_type'=> $loanType , 'status' => 1),
            //B2.6
            array('conf_master_id' => '28', 'loan_type'=> $loanType , 'status' => 1),
            //B2.8
            array('conf_master_id' => '30', 'loan_type'=> $loanType , 'status' => 1),
            //B3.1
            array('conf_master_id' => '34', 'loan_type'=> $loanType , 'status' => 1),
            //B3.3
            array('conf_master_id' => '36', 'loan_type'=> $loanType , 'status' => 1),
            //B2.7
            array('conf_master_id' => '29', 'loan_type'=> $loanType , 'status' => 1),
            //B2.9
            array('conf_master_id' => '31', 'loan_type'=> $loanType , 'status' => 1),
            //D3.7
            array('conf_master_id' => '45', 'loan_type'=> $loanType , 'status' => 1),
            //D3.8
            array('conf_master_id' => '46', 'loan_type'=> $loanType , 'status' => 1),
            //D3.9
            array('conf_master_id' => '47', 'loan_type'=> $loanType , 'status' => 1),
            //D3.1
            array('conf_master_id' => '39', 'loan_type'=> $loanType , 'status' => 1),
            //D3.2
            array('conf_master_id' => '40', 'loan_type'=> $loanType , 'status' => 1),
            //D3.6
            array('conf_master_id' => '44', 'loan_type'=> $loanType , 'status' => 1),
            //D3.5.1
            array('conf_master_id' => '42', 'loan_type'=> $loanType , 'status' => 1),
            //E3
            array('conf_master_id' => '51', 'loan_type'=> $loanType , 'status' => 1),
            //E4
            array('conf_master_id' => '52', 'loan_type'=> $loanType , 'status' => 1),
            //F2.1
            array('conf_master_id' => '56', 'loan_type'=> $loanType , 'status' => 1),
            //F3.2
            array('conf_master_id' => '60', 'loan_type'=> $loanType , 'status' => 1),
            //F3.3
            array('conf_master_id' => '61', 'loan_type'=> $loanType , 'status' => 1),
            //F3.4
            array('conf_master_id' => '62', 'loan_type'=> $loanType , 'status' => 1),


            //Secured Term Loan
            //D3.8
            array('conf_master_id' => '46', 'loan_type'=> $stlLoanType , 'status' => 1),
            //F3.2
            array('conf_master_id' => '60', 'loan_type'=> $stlLoanType , 'status' => 1),
            //B3.1
            array('conf_master_id' => '34', 'loan_type'=> $stlLoanType , 'status' => 1),
            //B2.1
            array('conf_master_id' => '23', 'loan_type'=> $stlLoanType , 'status' => 1),
            //B2.6
            array('conf_master_id' => '28', 'loan_type'=> $stlLoanType , 'status' => 1),
            //B2.8
            array('conf_master_id' => '30', 'loan_type'=> $stlLoanType , 'status' => 1),
            //B3.3
            array('conf_master_id' => '36', 'loan_type'=> $stlLoanType , 'status' => 1),
            //B2.5
            array('conf_master_id' => '27', 'loan_type'=> $stlLoanType , 'status' => 1),
            //B2.7
            array('conf_master_id' => '29', 'loan_type'=> $stlLoanType , 'status' => 1),
            //B2.9
            array('conf_master_id' => '31', 'loan_type'=> $stlLoanType , 'status' => 1),
            //F2.1
            array('conf_master_id' => '56', 'loan_type'=> $stlLoanType , 'status' => 1),


            //Equipment Finance Loan
            //B2.1
            array('conf_master_id' => '23', 'loan_type'=> $eflLoanType , 'status' => 1),
            //B2.5
            array('conf_master_id' => '27', 'loan_type'=> $eflLoanType , 'status' => 1),
            //B2.6
            array('conf_master_id' => '28', 'loan_type'=> $eflLoanType , 'status' => 1),
            //B2.7
            array('conf_master_id' => '29', 'loan_type'=> $eflLoanType , 'status' => 1),
            //B2.8
            array('conf_master_id' => '30', 'loan_type'=> $eflLoanType , 'status' => 1),
            //B2.9
            array('conf_master_id' => '31', 'loan_type'=> $eflLoanType , 'status' => 1),
            //B3.1
            array('conf_master_id' => '34', 'loan_type'=> $eflLoanType , 'status' => 1),
            //D3.5.1
            array('conf_master_id' => '42', 'loan_type'=> $eflLoanType , 'status' => 1),
            //D3.7
            array('conf_master_id' => '45', 'loan_type'=> $eflLoanType , 'status' => 1),
            //D3.8
            array('conf_master_id' => '46', 'loan_type'=> $eflLoanType , 'status' => 1),
            //E1
            array('conf_master_id' => '49', 'loan_type'=> $eflLoanType , 'status' => 1),
            //E4
            array('conf_master_id' => '52', 'loan_type'=> $eflLoanType , 'status' => 1),
            //F2.1
            array('conf_master_id' => '56', 'loan_type'=> $eflLoanType , 'status' => 1),
            //F3.2
            array('conf_master_id' => '60', 'loan_type'=> $eflLoanType , 'status' => 1),
            //F3.4
            array('conf_master_id' => '62', 'loan_type'=> $eflLoanType , 'status' => 1),
            //F4
            array('conf_master_id' => '63', 'loan_type'=> $eflLoanType , 'status' => 1),

            //Unsecured Business Loan
            //E1
            array('conf_master_id' => '49', 'loan_type'=> $ublLoanType , 'status' => 1),
            //E2
            array('conf_master_id' => '50', 'loan_type'=> $ublLoanType , 'status' => 1),
            //E3
            array('conf_master_id' => '51', 'loan_type'=> $ublLoanType , 'status' => 1),
            //E4
            array('conf_master_id' => '52', 'loan_type'=> $ublLoanType , 'status' => 1),
            //F3.2
            array('conf_master_id' => '60', 'loan_type'=> $ublLoanType , 'status' => 1),
            //F3.3
            array('conf_master_id' => '61', 'loan_type'=> $ublLoanType , 'status' => 1),
            //F3.4
            array('conf_master_id' => '62', 'loan_type'=> $ublLoanType , 'status' => 1),
            //F4
            array('conf_master_id' => '63', 'loan_type'=> $ublLoanType , 'status' => 1),
            //B3.1
            array('conf_master_id' => '34', 'loan_type'=> $ublLoanType , 'status' => 1),
            //D3.5.1
            array('conf_master_id' => '42', 'loan_type'=> $ublLoanType , 'status' => 1),
            //D3.8
            array('conf_master_id' => '46', 'loan_type'=> $ublLoanType , 'status' => 1),

            //Vendor Finance to Ecommerce Vendors , Sale Bill / Invoice Discounting, Supplier Finance
            //D3.5.1
            array('conf_master_id' => '42', 'loan_type'=> $vflLoanType , 'status' => 1),
            //D3.7
            array('conf_master_id' => '45', 'loan_type'=> $vflLoanType , 'status' => 1),
            //D3.8
            array('conf_master_id' => '46', 'loan_type'=> $vflLoanType , 'status' => 1),
            //E1
            array('conf_master_id' => '49', 'loan_type'=> $vflLoanType , 'status' => 1),
            //E3
            array('conf_master_id' => '51', 'loan_type'=> $vflLoanType , 'status' => 1),
            //B3.1
            array('conf_master_id' => '34', 'loan_type'=> $vflLoanType , 'status' => 1),
            //B2.1
            array('conf_master_id' => '23', 'loan_type'=> $vflLoanType , 'status' => 1),
            //B2.6
            array('conf_master_id' => '28', 'loan_type'=> $vflLoanType , 'status' => 1),
            //B2.8
            array('conf_master_id' => '30', 'loan_type'=> $vflLoanType , 'status' => 1),
            //F2.1
            array('conf_master_id' => '56', 'loan_type'=> $vflLoanType , 'status' => 1),
            //B2.4
            array('conf_master_id' => '26', 'loan_type'=> $vflLoanType , 'status' => 1),
            //B2.5
            array('conf_master_id' => '27', 'loan_type'=> $vflLoanType , 'status' => 1),
            //B2.7
            array('conf_master_id' => '29', 'loan_type'=> $vflLoanType , 'status' => 1),
            //B2.9
            array('conf_master_id' => '31', 'loan_type'=> $vflLoanType , 'status' => 1),
            //F3.3
            array('conf_master_id' => '61', 'loan_type'=> $vflLoanType , 'status' => 1),
            //F4
            array('conf_master_id' => '63', 'loan_type'=> $vflLoanType , 'status' => 1),

            //Channel Finance for Medium to Large Corporates (where FLDG or other comfort is being offered)
            //B3.1
            array('conf_master_id' => '34', 'loan_type'=> $cscflLoanType , 'status' => 1),
            //B2.1
            array('conf_master_id' => '23', 'loan_type'=> $cscflLoanType , 'status' => 1),
            //B2.6
            array('conf_master_id' => '28', 'loan_type'=> $cscflLoanType , 'status' => 1),
            //B2.8
            array('conf_master_id' => '30', 'loan_type'=> $cscflLoanType , 'status' => 1),
            //D3.5.1
            array('conf_master_id' => '42', 'loan_type'=> $cscflLoanType , 'status' => 1),
            //D3.7
            array('conf_master_id' => '45', 'loan_type'=> $cscflLoanType , 'status' => 1),
            //D3.8
            array('conf_master_id' => '46', 'loan_type'=> $cscflLoanType , 'status' => 1),
            //E1
            array('conf_master_id' => '49', 'loan_type'=> $cscflLoanType , 'status' => 1),
            //E3
            array('conf_master_id' => '51', 'loan_type'=> $cscflLoanType , 'status' => 1),
            //F2.1
            array('conf_master_id' => '56', 'loan_type'=> $cscflLoanType , 'status' => 1),
            //B2.4
            array('conf_master_id' => '26', 'loan_type'=> $cscflLoanType , 'status' => 1),
            //B2.5
            array('conf_master_id' => '27', 'loan_type'=> $cscflLoanType , 'status' => 1),
            //B2.7
            array('conf_master_id' => '29', 'loan_type'=> $cscflLoanType , 'status' => 1),
            //B2.9
            array('conf_master_id' => '31', 'loan_type'=> $cscflLoanType , 'status' => 1),
            //F3.3
            array('conf_master_id' => '61', 'loan_type'=> $cscflLoanType , 'status' => 1),
            //F4
            array('conf_master_id' => '63', 'loan_type'=> $cscflLoanType , 'status' => 1),
            //B3.3
            array('conf_master_id' => '36', 'loan_type'=> $cscflLoanType , 'status' => 1),


        ));

        //insert question_mappings entries
        DB::table('conf_fields')->insert(array(
            array('config_field_name'=>'loan_amount', 'field_entity' => 'Loan', 'target_value_type'=>'Range', 'value_source_type' => 'UserDefined', 'masterdata_lookup_type'=>null),
            array('config_field_name'=>'turnover', 'field_entity' => 'Loan', 'target_value_type'=>'Range', 'value_source_type' => 'UserDefined', 'masterdata_lookup_type'=>null),

        ));

        //insert conf_conditions entries
        DB::table('conf_conditions')->insert(array(
            array('config_condition_name'=>'Loan Amount < 50 lacs, Turnover < 5 cr'),
            array('config_condition_name'=>'Loan Amount 50 lacs-3 cr, Turnover < 5 cr'),
            array('config_condition_name'=>'Loan Amount < 50 lacs, Turnover 5-20 cr'),
            array('config_condition_name'=>'Loan Amount 50 lacs-3 cr, Turnover 5-20 cr'),
            array('config_condition_name'=>'Loan Amount < 50 lacs, Turnover > 20 cr'),
            array('config_condition_name'=>'Loan Amount 50 lacs-3 cr, Turnover > 20 cr'),
            array('config_condition_name'=>'Loan Amount 3-10 cr, Turnover < 5 cr'),
            array('config_condition_name'=>'Loan Amount 3-10 cr, Turnover 5-20 cr'),
            array('config_condition_name'=>'Loan Amount 3-10 cr, Turnover > 20 cr'),
            array('config_condition_name'=>'Loan Amount > 10 cr, Turnover > 20 cr'),

            array('config_condition_name'=>'Loan Amount < 50 lacs, Turnover < 10 cr'),
            array('config_condition_name'=>'Loan Amount < 50 lacs, Turnover > 10 cr'),
            array('config_condition_name'=>'Loan Amount 50 lacs-2 cr, Turnover < 10 cr'),
            array('config_condition_name'=>'Loan Amount 50 lacs-2 cr, Turnover > 10 cr'),

            array('config_condition_name'=>'Loan Amount < 50 lacs, Turnover 5-25 cr'),
            array('config_condition_name'=>'Loan Amount < 50 lacs, Turnover > 25 cr'),
            array('config_condition_name'=>'Loan Amount 50 lacs-3 cr, Turnover 5-25 cr'),
            array('config_condition_name'=>'Loan Amount 50 lacs-3 cr, Turnover > 25 cr'),
            array('config_condition_name'=>'Loan Amount 3-10 cr, Turnover 5-25 cr'),
            array('config_condition_name'=>'Loan Amount 3-10 cr, Turnover > 25 cr'),
            array('config_condition_name'=>'Loan Amount > 10 cr, Turnover > 25 cr'),


        ));

        //insert question_mappings entries
        //LAP entries

        $loanType = Config::get('constants.CONST_LOAN_TYPE_LAP');

        //Loan Amount <50 Lacs and Turnover < 5 cr
           $questionNumber = "B2.1";
           $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
           DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),

            ));
            $questionNumber = "B2.6";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),

            ));
            $questionNumber = "D3.7";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),

            ));

           $questionNumber = "D3.8";
           $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
           DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),

            ));
            $questionNumber = "D3.9";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
            ));
            $questionNumber = "E3";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(

                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
            ));

            $questionNumber = "E4";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId , 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
            ));
            $questionNumber = "F3.2";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
            ));
            $questionNumber = "F3.3";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
            ));
            $questionNumber = "F3.4";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
            ));

            //Loan Amount 50 Lacs to 3 crore and Turnover < 5 cr

            $questionNumber = "D3.7";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 2, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 2, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
            ));
            $questionNumber = "D3.8";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 2, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 2, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
            ));
            $questionNumber = "E3";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 2, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 2, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
            ));
            $questionNumber = "E4";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 2, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 2, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
            ));
            $questionNumber = "F3.2";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1,  'conf_condition_id'=> 2, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 2, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
            ));
            $questionNumber = "F3.3";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 2, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 2, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
            ));
            $questionNumber = "F3.4";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 2, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 2, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
            ));

            //Loan Amount < 50 Lacs and Turnover 5-20 cr
            $questionNumber = "B3.1";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
            ));
            $questionNumber = "B2.1";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
            ));
            $questionNumber = "B2.6";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
            ));
            $questionNumber = "B2.8";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
            ));
            $questionNumber = "D3.5.1";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
            ));
            $questionNumber = "D3.7";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
            ));
            $questionNumber = "D3.8";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
            ));
            $questionNumber = "E3";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
            ));
            $questionNumber = "E4";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
            ));
            $questionNumber = "F2.1";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
            ));
            $questionNumber = "F3.2";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
            ));
            $questionNumber = "F3.3";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
            ));
            $questionNumber = "F3.4";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
            ));

            //Loan Amount 50 Lacs - 3 cr and Turnover 5-20 cr
            $questionNumber = "B3.1";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
            ));
            $questionNumber = "B2.1";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
            ));
            $questionNumber = "B2.6";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
            ));
            $questionNumber = "B2.8";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
            ));
            $questionNumber = "D3.5.1";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
            ));
            $questionNumber = "E3";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
            ));
            $questionNumber = "E4";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId , 'conf_field_id'=> 1, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId , 'conf_field_id'=> 2, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
            ));
            $questionNumber = "F2.1";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
            ));
            $questionNumber = "F3.2";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
            ));
            $questionNumber = "F3.3";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
            ));
            $questionNumber = "F3.4";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
            ));

           //Loan Amount < 50 Lacs and Turnover >20 cr
            $questionNumber = "B3.1";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));
            $questionNumber = "B3.3";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));
            $questionNumber = "B2.1";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));
            $questionNumber = "B2.5";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));
            $questionNumber = "B2.6";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));
            $questionNumber = "B2.7";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));
            $questionNumber = "B2.8";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));
            $questionNumber = "B2.9";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));
            $questionNumber = "D3.1";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));
            $questionNumber = "D3.2";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));

            $questionNumber = "D3.5.1";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));

            $questionNumber = "D3.6";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));

            $questionNumber = "D3.7";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));

            $questionNumber = "D3.8";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));
            $questionNumber = "D3.9";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));

            $questionNumber = "E3";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));

            $questionNumber = "E4";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));

            $questionNumber = "F2.1";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));

            $questionNumber = "F3.2";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));

            $questionNumber = "F3.3";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));

            $questionNumber = "F3.4";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));


           //Loan Amount 50 Lacs to 3 cr and Turnover >20 cr
            $questionNumber = "B3.1";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));

            $questionNumber = "D3.5.1";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));

            $questionNumber = "D3.6";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));

            $questionNumber = "D3.7";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));

            $questionNumber = "D3.8";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));

            $questionNumber = "D3.9";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));

            $questionNumber = "E3";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));

            $questionNumber = "E4";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));

            $questionNumber = "F2.1";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));

            $questionNumber = "F3.2";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));

            $questionNumber = "F3.3";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));

            $questionNumber = "F3.4";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));

            //Loan Amount 3-10 cr, Turnover < 5 cr
            $questionNumber = "D3.8";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 7, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 7, 'operand' => '<', 'single_value' => 5000, 'begin_range' => null, 'end_range' => null ),
            ));
            $questionNumber = "E3";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 7, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 7, 'operand' => '<', 'single_value' => 5000, 'begin_range' => null, 'end_range' => null ),
            ));
            $questionNumber = "E4";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 7, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 7, 'operand' => '<', 'single_value' => 5000, 'begin_range' => null, 'end_range' => null ),
            ));
            $questionNumber = "F3.2";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 7, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 7, 'operand' => '<', 'single_value' => 5000, 'begin_range' => null, 'end_range' => null ),
            ));
            $questionNumber = "F3.3";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 7, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 7, 'operand' => '<', 'single_value' => 5000, 'begin_range' => null, 'end_range' => null ),
            ));
            $questionNumber = "F3.4";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 7, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 7, 'operand' => '<', 'single_value' => 5000, 'begin_range' => null, 'end_range' => null ),
            ));

        //Loan Amount 3-10 cr and Turnover  5-20 cr
            $questionNumber = "E3";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 8, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=>8 , 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
            ));

            $questionNumber = "E4";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 8, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=>8 , 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),

            ));

            $questionNumber = "F3.2";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 8, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=>8 , 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
            ));

            $questionNumber = "F3.3";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 8, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=>8 , 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
            ));

            $questionNumber = "F3.4";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 8, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=>8 , 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
            ));

          //Loan Amount 3-10 cr and Turnover > 20 cr
            $questionNumber = "B3.1";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 9, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
                array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 9, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));

            $questionNumber = "E3";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=>$confQuestionId , 'conf_field_id'=> 1, 'conf_condition_id'=> 9, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 9, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),

            ));

            $questionNumber = "E4";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=>$confQuestionId , 'conf_field_id'=> 1, 'conf_condition_id'=> 9, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 9, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));

            $questionNumber = "F2.1";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=>$confQuestionId , 'conf_field_id'=> 1, 'conf_condition_id'=> 9, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 9, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));

            $questionNumber = "F3.2";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=>$confQuestionId , 'conf_field_id'=> 1, 'conf_condition_id'=> 9, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 9, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));

            $questionNumber = "F3.3";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=>$confQuestionId , 'conf_field_id'=> 1, 'conf_condition_id'=> 9, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
                array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 9, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));

            $questionNumber = "F3.4";
            $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $loanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
            DB::table('conf_question_mappings')->insert(array(
                array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 9, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
                array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 9, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
            ));

        //for Secured Term Loan & CC/OD/Lon Term WC (secured by some collateral)
        //Loan Amount <50 Lacs and Turnover < 5 cr
        $questionNumber = "D3.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),

        ));
        $questionNumber = "F3.2";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),

        ));
        //Loan Amount < 50 Lacs and Turnover 5-20 cr
        $questionNumber = "B3.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "B2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "B2.6";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "B2.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "D3.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));

        //Loan Amount < 50 Lacs and Turnover >20 cr
        $questionNumber = "B3.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B3.3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.5";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.6";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.7";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.9";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.2";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));

        //Loan Amount 50 Lacs to 3 crore and Turnover < 5 cr
        $questionNumber = "F3.2";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 2, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 2, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));

        //Loan Amount 50 Lacs - 3 cr and Turnover 5-20 cr
        $questionNumber = "F3.2";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));

        //Loan Amount 50 Lacs to 3 cr and Turnover >20 cr
        $questionNumber = "B2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.6";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.2";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));

        //Loan Amount 3-10 cr, Turnover < 5 cr
        $questionNumber = "F3.2";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 7, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 7, 'operand' => '<', 'single_value' => 5000, 'begin_range' => null, 'end_range' => null ),
        ));
        //Loan Amount 3-10 cr and Turnover  5-20 cr
        $questionNumber = "F3.2";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 8, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=>8 , 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));

        //Loan Amount 3-10 cr and Turnover > 20 cr
        $questionNumber = "F3.2";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 9, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 9, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        //Loan Amount > 10 cr, Turnover > 20 cr
        $questionNumber = "F3.2";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $stlLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 10, 'operand' => '>', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 10, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));

        //Equipment Finance Loan
        //Loan Amount <50 Lacs and Turnover < 5 cr
        $questionNumber = "D3.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),

        ));
        $questionNumber = "E1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),

        ));
        $questionNumber = "E4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),

        ));
        $questionNumber = "F3.2";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),

        ));
        $questionNumber = "F3.4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),

        ));
        $questionNumber = "F4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),

        ));
        //Loan Amount < 50 Lacs and Turnover 5-20 cr
        $questionNumber = "D3.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "B2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "B2.6";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "B2.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "E1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "E4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "F3.2";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "F3.4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "F4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));

        //Loan Amount < 50 Lacs and Turnover >20 cr
        $questionNumber = "B3.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.5";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.6";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.7";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.9";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.5.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.7";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.2";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));

        //Loan Amount 50 Lacs to 3 crore and Turnover < 5 cr
        $questionNumber = "D3.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 2, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 2, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 2, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 2, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.2";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 2, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 2, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 2, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 2, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));

        //Loan Amount 50 Lacs - 3 cr and Turnover 5-20 cr
        $questionNumber = "B2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "B2.6";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "D3.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "E4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "F3.2";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "F3.4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));

        //Loan Amount 50 Lacs to 3 cr and Turnover >20 cr
        $questionNumber = "B3.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.5.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.6";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.2";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));

        //Loan Amount 3-10 cr, Turnover < 5 cr
        $questionNumber = "F3.2";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 7, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 7, 'operand' => '<', 'single_value' => 5000, 'begin_range' => null, 'end_range' => null ),
        ));

        //Loan Amount 3-10 cr and Turnover  5-20 cr
        $questionNumber = "D3.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 8, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=>8 , 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "E4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 8, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=>8 , 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "F3.2";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 8, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=>8 , 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "F3.4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 8, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=>8 , 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));

        //Loan Amount 3-10 cr and Turnover > 20 cr
        $questionNumber = "B2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 9, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 9, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.6";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 9, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 9, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.5.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 9, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 9, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 9, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 9, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 9, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 9, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.2";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 9, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 9, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $eflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 9, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 9, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));

        //Unsecured Business Loan
        //Loan Amount < 50 lacs, Turnover < 10 cr
        $questionNumber = "E1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 11, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 11, 'operand' => '<', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E2";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 11, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 11, 'operand' => '<', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 11, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 11, 'operand' => '<', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 11, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 11, 'operand' => '<', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.2";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 11, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 11, 'operand' => '<', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 11, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 11, 'operand' => '<', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 11, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 11, 'operand' => '<', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 11, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 11, 'operand' => '<', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));

        //Loan Amount < 50 lacs, Turnover > 10 cr
        $questionNumber = "B3.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 12, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 12, 'operand' => '>', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.5.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 12, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 12, 'operand' => '>', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 12, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 12, 'operand' => '>', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 12, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 12, 'operand' => '>', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E2";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 12, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 12, 'operand' => '>', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 12, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 12, 'operand' => '>', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 12, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 12, 'operand' => '>', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.2";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 12, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 12, 'operand' => '>', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 12, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 12, 'operand' => '>', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 12, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 12, 'operand' => '>', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 12, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 12, 'operand' => '>', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));

        //Loan Amount 50 lacs-2 cr, Turnover < 10 cr
        $questionNumber = "E1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 13, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 200 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 13, 'operand' => '<', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E2";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 13, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 200 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 13, 'operand' => '<', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 13, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 200 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 13, 'operand' => '<', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 13, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 200 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 13, 'operand' => '<', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.2";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 13, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 200 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 13, 'operand' => '<', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 13, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 200 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 13, 'operand' => '<', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 13, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 200 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 13, 'operand' => '<', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 13, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 200 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 13, 'operand' => '<', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));

        //Loan Amount 50 lacs-2 cr, Turnover > 10 cr
        $questionNumber = "D3.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 14, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 200 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 14, 'operand' => '>', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 14, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 200 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 14, 'operand' => '>', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E2";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 14, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 200 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 14, 'operand' => '>', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 14, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 200 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 14, 'operand' => '>', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 14, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 200 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 14, 'operand' => '>', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.2";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 14, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 200 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 14, 'operand' => '>', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 14, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 200 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 14, 'operand' => '>', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 14, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 200 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 14, 'operand' => '>', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $ublLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 14, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 200 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 14, 'operand' => '>', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
        ));

        //Vendor Finance to Ecommerce Vendors , Sale Bill / Invoice Discounting, Supplier Finance
        //Loan Amount <50 Lacs and Turnover < 5 cr
        $questionNumber = "D3.5.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.7";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));

        //Loan Amount < 50 Lacs and Turnover 5-20 cr
        $questionNumber = "B3.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "B2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "B2.6";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "B2.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "D3.5.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "D3.7";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "D3.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "E1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "E3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "F2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 3, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 3, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));

        //Loan Amount < 50 Lacs and Turnover >20 cr
        $questionNumber = "B3.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.5";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.6";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.7";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.9";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.5.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.7";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 5, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 5, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));

        //Loan Amount 50 Lacs to 3 crore and Turnover < 5 cr
        $questionNumber = "D3.5.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 2, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 2, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.7";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 2, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 2, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 2, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 2, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 2, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 2, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 2, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 2, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));

        //Loan Amount 50 Lacs - 3 cr and Turnover 5-20 cr
        $questionNumber = "D3.5.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "D3.7";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "D3.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "E3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "F3.3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "F4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 4, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));

        //Loan Amount 50 Lacs to 3 cr and Turnover >20 cr
        $questionNumber = "B2.6";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B3.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.5.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.5.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.7";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 6, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 6, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));

        //Loan Amount 3-10 cr and Turnover  5-20 cr
        $questionNumber = "D3.5.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 8, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=>8 , 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "D3.7";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 8, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=>8 , 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "D3.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 8, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=>8 , 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "E3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 8, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=>8 , 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));
        $questionNumber = "F3.3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 8, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=>8 , 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2000 ),
        ));

        //Loan Amount 3-10 cr and Turnover > 20 cr
        $questionNumber = "D3.5.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 9, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 9, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.7";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 9, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 9, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 9, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 9, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 9, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 9, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 9, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 9, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $vflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 9, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 9, 'operand' => '>', 'single_value' => 2000, 'begin_range' => null, 'end_range' => null ),
        ));


        //Channel Finance for Medium to Large Corporates (where FLDG or other comfort is being offered)
        //Loan Amount <50 Lacs and Turnover < 5 cr
        $questionNumber = "B3.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.6";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.5.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.7";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 1, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 1, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));

        //Loan Amount < 50 Lacs and Turnover 5-25 cr
        $questionNumber = "B3.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 15, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 15, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2500 ),
        ));
        $questionNumber = "B2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 15, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 15, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2500 ),
        ));
        $questionNumber = "B2.4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 15, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 15, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2500 ),
        ));
        $questionNumber = "B2.5";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 15, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 15, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2500 ),
        ));
        $questionNumber = "B2.6";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 15, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 15, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2500 ),
        ));
        $questionNumber = "B2.7";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 15, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 15, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2500 ),
        ));
        $questionNumber = "B2.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 15, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 15, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2500 ),
        ));
        $questionNumber = "B2.9";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 15, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 15, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2500 ),
        ));
        $questionNumber = "D3.5.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 15, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 15, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2500 ),
        ));
        $questionNumber = "D3.7";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 15, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 15, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2500 ),
        ));
        $questionNumber = "D3.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 15, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 15, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2500 ),
        ));
        $questionNumber = "E1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 15, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 15, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2500 ),
        ));
        $questionNumber = "E3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 15, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 15, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2500 ),
        ));
        $questionNumber = "F2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 15, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 15, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2500 ),
        ));
        $questionNumber = "F3.3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 15, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 15, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2500 ),
        ));
        $questionNumber = "F4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 15, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 15, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2500 ),
        ));

        //Loan Amount < 50 Lacs and Turnover >25 cr
        $questionNumber = "B3.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 16, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 16, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B3.3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 16, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 16, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 16, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 16, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 16, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 16, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.5";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 16, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 16, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.6";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 16, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 16, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.7";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 16, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 16, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 16, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 16, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.9";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 16, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 16, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.5.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 16, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 16, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.7";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 16, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 16, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 16, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 16, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 16, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 16, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 16, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 16, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 16, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 16, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 16, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 16, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId,'conf_field_id'=> 1, 'conf_condition_id'=> 16, 'operand' => '<', 'single_value' => 50, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 16, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));

        //Loan Amount 50 Lacs to 3 crore and Turnover < 5 cr
        $questionNumber = "B2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 2, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 2, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.6";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 2, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 2, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 2, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 2, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.5.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 2, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 2, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.7";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 2, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 2, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 2, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 2, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 2, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 2, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));

        $questionNumber = "F3.3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 2, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId, 'conf_field_id'=> 2, 'conf_condition_id'=> 2, 'operand' => '<', 'single_value' => 500, 'begin_range' => null, 'end_range' => null ),
        ));

        //Loan Amount 50 Lacs - 3 cr and Turnover 5-25 cr
        $questionNumber = "B3.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 17, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 17, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2500 ),
        ));
        $questionNumber = "B3.3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 17, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 17, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2500 ),
        ));
        $questionNumber = "D3.5.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 17, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 17, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2500 ),
        ));
        $questionNumber = "D3.7";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 17, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 17, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2500 ),
        ));
        $questionNumber = "E3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 17, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 17, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2500 ),
        ));
        $questionNumber = "F2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 17, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 17, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2500 ),
        ));
        $questionNumber = "F3.3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 17, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 17, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2500 ),
        ));
        $questionNumber = "F4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 17, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 17, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2500 ),
        ));

        //Loan Amount 50 Lacs to 3 cr and Turnover > 25 cr
        $questionNumber = "B3.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 18, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 18, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 18, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 18, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 18, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 18, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.5";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 18, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 18, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.6";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 18, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 18, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.7";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 18, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 18, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 18, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 18, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.9";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 18, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 18, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.5.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 18, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 18, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.7";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 18, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 18, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 18, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 18, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 18, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 18, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 18, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 18, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 18, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 18, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 18, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 18, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 18, 'operand' => 'between', 'single_value' => null, 'begin_range' => 50, 'end_range' => 300 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 18, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));

        //Loan Amount 3-10 cr, Turnover < 5 cr
        $questionNumber = "B2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 7, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 7, 'operand' => '<', 'single_value' => 5000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.6";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 7, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 7, 'operand' => '<', 'single_value' => 5000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "B2.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 7, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 7, 'operand' => '<', 'single_value' => 5000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.7";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 7, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 7, 'operand' => '<', 'single_value' => 5000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 7, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 7, 'operand' => '<', 'single_value' => 5000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 7, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 7, 'operand' => '<', 'single_value' => 5000, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 7, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 7, 'operand' => '<', 'single_value' => 5000, 'begin_range' => null, 'end_range' => null ),
        ));

        //Loan Amount 3-10 cr and Turnover  5-25 cr
        $questionNumber = "D3.5.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 19, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=>19, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2500 ),
        ));
        $questionNumber = "D3.7";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 19, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=>19, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2500 ),
        ));
        $questionNumber = "E3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 19, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=>19, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2500 ),
        ));
        $questionNumber = "F3.3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1, 'conf_condition_id'=> 19, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=>19, 'operand' => 'between', 'single_value' => null, 'begin_range' => 500, 'end_range' => 2500 ),
        ));

        //Loan Amount 3-10 cr and Turnover > 25 cr
        $questionNumber = "B3.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 20, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 20, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.5.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 20, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 20, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.7";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 20, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 20, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "D3.8";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 20, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 20, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "E3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 20, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 20, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 20, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 20, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 20, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 20, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F4";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 20, 'operand' => 'between', 'single_value' => null, 'begin_range' => 300, 'end_range' => 1000 ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 20, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));

        //Loan Amount > 10 cr, Turnover > 25 cr
        $questionNumber = "F2.1";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 20, 'operand' => '>', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 20, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));
        $questionNumber = "F3.3";
        $confQuestionId = DB::table('conf_questions')->where('conf_question_masters.questionnumber', '=', $questionNumber)->where('conf_questions.loan_type', '=', $cscflLoanType)->join('conf_question_masters', 'conf_question_masters.id', '=', 'conf_questions.conf_master_id')->select('conf_questions.id')->get()[0]->id;
        DB::table('conf_question_mappings')->insert(array(
            array('conf_question_id'=>$confQuestionId ,'conf_field_id'=> 1,  'conf_condition_id'=> 20, 'operand' => '>', 'single_value' => 1000, 'begin_range' => null, 'end_range' => null ),
            array('conf_question_id'=> $confQuestionId ,'conf_field_id'=> 2, 'conf_condition_id'=> 20, 'operand' => '>', 'single_value' => 2500, 'begin_range' => null, 'end_range' => null ),
        ));

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}