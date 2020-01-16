<?php

use App\Models\Loan\AnalystModel\AnalystModelDimension;
use App\Models\MasterData;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class ConfigurableParamsSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        //delete conf_parameters table records
        DB::table('conf_parameters')->truncate();

        //delete conf_industry_type_sector_outlook table records
        DB::table('conf_industry_type_sector_outlook_mapping')->truncate();

        //insert conf_parameters entries
        DB::table('conf_parameters')->insert(array(
            //$eligibleAmount
            array('model'=>'loan_advisor', 'parameter_name' => 'eligible amount divide rule1', 'description' => null, 'parameter_value'=>1.3),
            array('model'=>'loan_advisor', 'parameter_name' => 'eligible amount divide rule2', 'description' => null, 'parameter_value'=>1.8),
            array('model'=>'loan_advisor', 'parameter_name' => 'eligible amount divide rule3', 'description' => null, 'parameter_value'=>2.2),

            array('model'=>'loan_advisor', 'parameter_name' => 'margin1', 'description' => null, 'parameter_value'=>0.3),
            array('model'=>'loan_advisor', 'parameter_name' => 'margin2', 'description' => null, 'parameter_value'=>0.12),
            array('model'=>'loan_advisor', 'parameter_name' => 'margin3', 'description' => null, 'parameter_value'=>0.5),

            //$cibilScore (Cibil Score)
            array('model'=>'loan_advisor', 'parameter_name' => 'cibil score1', 'description' => null, 'parameter_value'=>500),
            array('model'=>'loan_advisor', 'parameter_name' => 'cibil score2', 'description' => null, 'parameter_value'=>600),
            array('model'=>'loan_advisor', 'parameter_name' => 'cibil score3', 'description' => null, 'parameter_value'=>650),

            //Cibil calculation
            array('model'=>'loan_advisor', 'parameter_name' => 'cibil calc1', 'description' => null, 'parameter_value'=>0.7),
            array('model'=>'loan_advisor', 'parameter_name' => 'cibil calc2', 'description' => null, 'parameter_value'=>1),
            array('model'=>'loan_advisor', 'parameter_name' => 'cibil calc3', 'description' => null, 'parameter_value'=>1.1),
            array('model'=>'loan_advisor', 'parameter_name' => 'cibil calc4', 'description' => null, 'parameter_value'=>1.2),
            array('model'=>'loan_advisor', 'parameter_name' => 'cibil calc5', 'description' => null, 'parameter_value'=>1.4),

            // $recommended_Amount (recommended amount)
            array('model'=>'loan_advisor', 'parameter_name' => 'recommended amount1', 'description' => null, 'parameter_value'=>50),
            array('model'=>'loan_advisor', 'parameter_name' => 'recommended amount2', 'description' => null, 'parameter_value'=>75),
            array('model'=>'loan_advisor', 'parameter_name' => 'recommended amount3', 'description' => null, 'parameter_value'=>100),
            array('model'=>'loan_advisor', 'parameter_name' => 'recommended amount4', 'description' => null, 'parameter_value'=>200),
            array('model'=>'loan_advisor', 'parameter_name' => 'recommended amount5', 'description' => null, 'parameter_value'=>300),
            array('model'=>'loan_advisor', 'parameter_name' => 'recommended amount6', 'description' => null, 'parameter_value'=>500),


            // $turnOver (turnover amount)
            array('model'=>'loan_advisor', 'parameter_name' => 'turnover amount1', 'description' => null, 'parameter_value'=>1000),
            array('model'=>'loan_advisor', 'parameter_name' => 'turnover amount2', 'description' => null, 'parameter_value'=>2000),
            array('model'=>'loan_advisor', 'parameter_name' => 'turnover amount3', 'description' => null, 'parameter_value'=>500),


            // $loanDecisionRatio
            array('model'=>'loan_advisor', 'parameter_name' => 'Loan decision ratio1', 'description' => null, 'parameter_value'=>0.25),
            array('model'=>'loan_advisor', 'parameter_name' => 'Loan decision ratio2', 'description' => null, 'parameter_value'=>0.5),
            array('model'=>'loan_advisor', 'parameter_name' => 'Loan decision ratio3', 'description' => null, 'parameter_value'=>0.9),

            array('model'=> Config::get('constants.CONST_ANALYST_MODEL_TYPE_CREDIT'), 'parameter_name' => 'Revenue Trend - Positive Tolerance', 'description' => 'Credit Model Positive Tolerance for the Revenue Trend condition. The parameter value is x in the condition, and should be specified as a whole or number, in percentage, and has a default value of 6. Condition is - If Revenue growth is > x% its a +ve trend , if  growth between y and x% its neutral.', 'parameter_value'=> 6),
            array('model'=> Config::get('constants.CONST_ANALYST_MODEL_TYPE_CREDIT'), 'parameter_name' => 'Revenue Trend - Negative Tolerance', 'description' => 'Credit Model Negative Tolerance for the Revenue Trend condition. The parameter value is x in the condition, and should be specified as a whole or number, in percentage, and has a default value of 0. Condition is - If Revenue growth is below y then its negative.', 'parameter_value'=> 0),
            array('model'=> Config::get('constants.CONST_ANALYST_MODEL_TYPE_CREDIT'), 'parameter_name' => 'EBITDA Trend - Positive Tolerance', 'description' => 'Credit Model Positive Tolerance for the EBITDA Trend condition. The parameter value is x in the condition, and should be specified as a whole or number, in percentage, and has a default value of 6. Condition is - If EBITDA growth is > x% its a +ve trend , if  growth between y and x% its neutral.', 'parameter_value'=> 6),
            array('model'=> Config::get('constants.CONST_ANALYST_MODEL_TYPE_CREDIT'), 'parameter_name' => 'EBITDA Trend - Negative Tolerance', 'description' => 'Credit Model Negative Tolerance for the EBITDA Trend condition. The parameter value is x in the condition, and should be specified as a whole or number, in percentage, and has a default value of 0. Condition is - If EBITDA growth is below y then its negative.', 'parameter_value'=> 0),

            array('model'=> Config::get('constants.CONST_ANALYST_MODEL_TYPE_CREDIT'), 'parameter_name' => 'Customer Sales Revenue Tolerance', 'description' => 'Credit Model Tolerance for the Customer row field condition in Business Diversification section. The parameter value is x in the condition, and should be specified as a decimal, and has a default value of 0.6. Condition is - If latest year annual Sales amount in business details > x% of Revenue of Profit & Loss Details tab, then it is concentrated, else diversified.', 'parameter_value'=> 0.6),
            array('model'=> Config::get('constants.CONST_ANALYST_MODEL_TYPE_CREDIT'), 'parameter_name' => 'Customer Supplier Revenue Tolerance', 'description' => 'Credit Model Tolerance for the Supplier row field condition in Business Diversification section. The parameter value is x in the condition, and should be specified as a decimal, and has a default value of 0.45. Condition is - If latest year annual Sales amount in business details > x% of Revenue of Profit & Loss Details tab, then it is concentrated, else diversified.', 'parameter_value'=> 0.45),
            array('model'=> Config::get('constants.CONST_ANALYST_MODEL_TYPE_CREDIT'), 'parameter_name' => 'Group Strength Row Sub-Items Tolerance', 'description' => 'Credit Model Tolerance for the Group Strength row sub-items condition. The parameter value is x in the condition, and should be specified as a whole number, and has a default value of 2500. Condition is - If promoter turnover < x lacs (25 cr), then all group strength sub items applicable = No, but editable.', 'parameter_value'=> 2500),

            //Disabled Tab functionality
            array('model'=>'loans_tab_disable', 'parameter_name' => 'Loans Tab Disable', 'description' => 'SME cannot proceed to the next tab unless he completes one tab.', 'parameter_value'=>'0'),

            //Discarding Loan Application functionality
            array('model'=>'loan_application_discard', 'parameter_name' => 'Loans Application Discard', 'description' => null, 'parameter_value'=>'0'),


            //LTV Parameters
            array('model'=>'bank_allocation', 'parameter_name' => 'LTV Residential', 'description' => 'Bank Allocation LTV Value for Residential Parameter', 'parameter_value'=>'0.7'),
            array('model'=>'bank_allocation', 'parameter_name' => 'LTV Commercial', 'description' => 'Bank Allocation LTV Value for Commercial Parameter', 'parameter_value'=>'0.6'),
            array('model'=>'bank_allocation', 'parameter_name' => 'LTV Industrial', 'description' => 'Bank Allocation LTV Value for Industrial Parameter', 'parameter_value'=>'0.55'),
            array('model'=>'bank_allocation', 'parameter_name' => 'LTV Farm House', 'description' => 'Bank Allocation LTV Value for Farm House Parameter', 'parameter_value'=>'0.5'),

            array('model'=>'sms_template', 'parameter_name' => 'Received Query', 'description' => 'SMS Message to be sent on receiving a new query message', 'parameter_value'=>'You have received a new query. Please logon to SME Niwas to view and reply to it!'),
            array('model'=>'sms_template', 'parameter_name' => 'Post Signup', 'description' => 'SMS Message to be sent post signup', 'parameter_value'=>'Welcome to SME Niwas! Please login to the website to continue! Please check your registered email for further instructions.'),
            array('model'=>'template', 'parameter_name' => 'Track Application', 'description' => 'SMS and Email Message to be sent on tracking application', 'parameter_value'=>'Welcome to SME Niwas! Your Application Status is'),

            //Loan Terms & Conditions
            array('model'=>'loan', 'parameter_name' => 'Loan T&C', 'description' => 'Terms & Condition Text for Loan Application', 'parameter_value'=>'1) Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi.Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, <br><br>2) Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi.Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,'),

        ));

        $sectorOutlookDimension = AnalystModelDimension::where('label','=', 'Sector Outlook')->get()->first();
        $measuresList = $sectorOutlookDimension->measures()->get();
        $positiveMeasureId = $measuresList->filter(function ($measure){
            if(strcmp($measure->label, "Positive") == 0){
                return true;
            }
        })->first()->id;

        $nuetralMeasureId = $measuresList->filter(function ($measure){
            if(strcmp($measure->label, "Neutral") == 0){
                return true;
            }
        })->first()->id;

        $negativeMeasureId = $measuresList->filter(function ($measure){
            if(strcmp($measure->label, "Negative") == 0){
                return true;
            }
        })->first()->id;

        //insert conf_industry_type_sector_outlook_mapping entries
        DB::table('conf_industry_type_sector_outlook_mapping')->insert(array(
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Abrasives & Grinding')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','2 & 3 Wheelers')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Adhesive')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Advertising')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Agricultural Implements')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Air-Conditioners & Refrigerators')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Airline Tranport Services - Freight')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Aluminum & Aluminum Products - Extruded Products')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Aluminum & Aluminum Products - Others')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Aluminum & Aluminum Products - Wires & Foils')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Animation')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Apparels')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Architect Firms')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Assets Financing Services')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Auto Ancillaries -Axies')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Auto Ancillaries -Clutches,Gears & Brakes')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Auto Ancillaries -General')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Auto Ancillaries -Lighting')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Auto Ancillaries -Rubber')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Ayurvedic & Unani Herbs')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Bakery Sweets - No Retail Shop')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Bakery Sweets - With Own Retail Shop')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Bakery Sweets - With Rented Retail Shop')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Bathroom Fittings- Branded')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Bathroom Fittings- Unbranded')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Bearings')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Bed & Table Linen')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Bio-Fuel')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Biotech')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Blankets, Carpets, Rugs & Mats')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),

            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Boilers & Turbines')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),

            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Bone Meal')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Bottled Water')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Breweries')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Brewery Machinery')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Brokerage Houses')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Business & Assets Management Services')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Car Rental Services')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Cassettes & Cd')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Castings & Forgings')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Cellular Mobile Phone Services')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Cement')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Cement Sheet')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Ceramics Tiles & Sanitary Wares')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Clocks & Watches')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Coal & Lignite')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Coffee - Curing Works')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Coffee - Trader')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Communication & Broadcasting')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Communicaton Services')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Compressors & Pump')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Computer - Education')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Computer Hardware - Assembler')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Computer Hardware-Components/Spare Parts Dealer')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Computer Hardware - Retailer')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Computer Hardware - Unbranded Hardware')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Confectionery Branded')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Confectionery Unbranded')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Construction')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Construction Equipment')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Consumer Electronics - Branded Goods')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Consumer Electronics - Components Spare Part')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Consumer Electronics - Unbranded Goods')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Copper & Copper Products')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Cotton Textiles')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Courier')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Courier - Domestic & International')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Cycle & Accessories')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Dairy')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Dairy Machinery')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Database Services')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Distilleries')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Drugs & Pharmaceuticals. Bulk Drug/Apl')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Drugs & Pharmaceuticals. Composite')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Drugs & Pharmaceuticals .Exporter')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Drugs & Pharmaceuticals. Formulation')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Drugs & Pharmaceuticals .Research')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Drugs & Pharmaceuticals .Retailer')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Dry Cells')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Dusters / Sprayer')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Dyes & Pigments')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Editable Oils & Solvent Extracts')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Education Consulting')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Electrical Appliances/Components- Branded')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Electrical Appliances/Components- Unbranded')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Electrical Machinery')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Electricity Energy')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Engines')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Event Managemennt Services')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Fasteners')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Fats & Oils And Derived Products')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Ferro Alloys Products')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Fertilizers')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Film')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Financial & Leasing Services')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Floriculture')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Fmcg Product')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Fmcg Toileteries')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Food Processing')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Food Products')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Footwear')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Fuel Dealers')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Gas Cylinders / Containers')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Gears')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Gems & Jewellery')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Generators, Transformers & Switchgears - Parts')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Glass & Glass Products - Lab Ware')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Glass & Glass Products - Tableware')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Good Transport Services –air')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Good Transport Services -Hire Vehicles')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Good Transport Services -Owns Vehicles')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Hand Pump')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Hand Tools')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Health Centers/ Hospitals - Primary')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Health Centre/Hospitals Tertiary')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Home Furniture & Furnishing - Manufacture')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Hospital & Diagnostic Centers')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Hotel & Restaurants')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Housing Finance Services')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Industrial Furnaces')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Industrial Gases')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Industrial Machinery - Others')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Insect Repellers')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Instrument Cooling Fans')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Internet Services')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Inverter')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Iron And Steel')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Ites/ Call Centers - Kpo')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Ites/ Call Centers - Bpo')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Jute Textiles')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Kitchen & Sanitary Items')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Lcvs Hcvs - Commercial Vehicles Dealer')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Leather & Leather Product')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Legal Services')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Locomotives')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Lpg Storage & Distribution')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Lubricants - Branded')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Lubricants -Unbranded')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Luggage - Branded')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Luggage - Unbranded')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Machine Tools')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Machinery Used In Food & Beverage Industries')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Maintenance Of Buildings')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Management Consultancy Services')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Marble & Granite')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Marble & Granite - Import/Export')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Marble & Granite -Domestic')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Marble & Granite-Gang Saw Units')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Marine Foods')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Market Research & Public Opinion Polling')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Marketing Of Telefilms/Serials/Tv Programme')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Material Handling Equipments')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Mechinical & Electrical Equipement')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Media')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Medical Equipment')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Medical Supplies - Disposables')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Medical Supplies - Sl')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Medical Transcription')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Membership Organisation')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Metal Rolling Machines')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Metallic Minerals')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Metalloys Products')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Meter Electricity')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Milling Products')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Minerals & Energy Sources')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Mining, Construction & Earth Moving Machinery')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Motion Picture')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Motors & Generators')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Nbfs')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Non Alcoholic Beverages')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Non Metallic Mineral Products')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Non Metallic Minerals')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Non-Electrical Machinery')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Non-Ferrous Metals')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Office Stationery - Exports')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Office Stationery -Domestic')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Oil Drilling & Allied Services')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Optical Fibres')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Opticians')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Organic & Inorganic Chemicals')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Other Agricultural Corp')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Other Communication Services')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Other Industries')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Other Professionals')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Other Textiles')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Other Textiles Products')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Packaging - Foil Packaging')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Packaging - Glass Container')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Packaging - Machine Mfg')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Packaging - Paper Packaging')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Packaging- Plastic Containers')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Paints & Varnishes')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Paper & Paper Products')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Passenger Car Dealers')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Pesticides')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Pharma Machinery')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Photocopiers & Services')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Photographic And Allied Products')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Placement & Requipment')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Plastic & Plastic Products - Branded')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Plastic & Plastic Products - Commercial')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Plastic & Plastic Products - Engineering')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Plastic & Plastic Products - Household')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Plastic & Plastic Products - Unbranded')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Plumbing & Allied Services')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Pollution Control')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Polyester Film')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Polymers')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Poultry & Meat Products - Hatchery')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Poultry & Meat Products - Poultry Farm')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Power Tillers')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Power Transmission Line Services')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Precision Dies & Parts')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Pressure Vessels')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Printing Machinery')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Public Relations')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Publishing')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','R&D Services')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Railway Transport')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Railway Wagons')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Razors & Blades')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Recreation & Amusement Parks')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Rectified Spirit')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Refinery')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Refractories & Intermediates')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Renting Services')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Repair Services')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Reservoirs & Tanks')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Rice')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Rice Mill Machinery')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Rubber & Plastic Products Machinery')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Rubber Industry')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Sacks & Bags')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Salt')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Sanitary Towels')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Saw Blades')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Screws, Bolts, Nuts Etc')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Seeds')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Sewing Machines')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Shipping Transport Services')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Ships, Boats Etc')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Silk Textiles')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Software & Erp')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Solar Appliances')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Solar Energy')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Soya Bean Products')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Specialty Chemicals')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Spices/ Dry Fruits - Packaged Spices')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Spices/Dry Fruits - Dry Fruits')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Spices/Dry Fruits - Spices')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Sports Goods')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Starches')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Storage & Warehousing')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Storage Batteries')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Sugar - Wholesaler')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Sugar -Distributor')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Sugar Manufacturing Machinery')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Tax & Audit')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Tea')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Technical Consultancy & Engineering Services')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Telecom Distributor - Accessories')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Telecom Distributor - Handsets')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Telecom Networking Equipment')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Textiles - Synthetic')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Textiles Machinery')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Textured Yarn')->get()->first()->id, 'sector_outlook_measure_id' => $nuetralMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Thermal Electricity')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Tobacco Tob Products')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Tours & Travel Services - Package Tours')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Tours & Travel Services -Iata Commission')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Tractors Dealers')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Transformers')->get()->first()->id, 'sector_outlook_measure_id' => $negativeMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Transmission Towers & Structurals')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Transport Equipment')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
            array('master_data_id'=> MasterData::where('type','=','INDUSTRY_TYPE')->where('status','=',1)->where('name','=','Tyres')->get()->first()->id, 'sector_outlook_measure_id' => $positiveMeasureId),
        ));

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}