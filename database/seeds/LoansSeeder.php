<?php

use App\Models\Faker\LoansFaker;
use App\Models\User;
use Faker\Factory as Faker;
use App\Models\Roles;

// MasterDataSeeder.php
use Illuminate\Database\Seeder;
require "vendor/autoload.php";
class LoansSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('financials_balance_sheet')->truncate();
        DB::table('financials_profit_loss')->truncate();
        //delete conf_financial_entries table records
        DB::table('financials_ratios')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('loans')->delete();
        DB::table('users')->delete();
        DB::table('user_profiles')->delete();

        $faker = Faker::create();
        $faker->addProvider(new LoansFaker($faker));

        $adminUser = $this->createAndActivateUser('admin', 'admin@test.com', 'password',Config::get('constants.RL_ADMIN') );
        $smeUser = $this->createAndActivateUser('sme', 'sme@test.com', 'password',Config::get('constants.RL_SME') );
        $analystUser = $this->createAndActivateUser('analyst', 'analyst@test.com', 'password',Config::get('constants.RL_ANALYST') );
        $caUser = $this->createAndActivateUser('cp', 'cp@test.com', 'password',Config::get('constants.RL_CP') );
        $bankUser = $this->createAndActivateUser('bankUser', 'bank@test.com', 'password',Config::get('constants.RL_BANK_USER') );
        $bankUser->bank_id=1;
        $executiveUser = $this->createAndActivateUser('executiveUser', 'executive@test.com', 'password',Config::get('constants.RL_EXECUTIVE') );

        foreach (range(1, 100) as $index)
        {
            DB::table('loans')->insert([
                'user_id'    => $smeUser->id,
//                'loan_application_id' => $faker->loan_application_id,
                'type' => $faker->type,
                'loan_amount' => $faker->loan_amount,
                'loan_tenure' => $faker->loan_tenure,
                'status' => $faker->status,
                'end_use' => $faker->end_use
                //below commented by satish
                //'promoter_generation_type' => $faker->promoter_generation_type,
                //'promoter_background' => $faker->promoter_background,

            ]);
        }

        DB::table('user_profiles')->insert(array(
            array('user_id' => '1', 'referredby_userid' => null, 'name_of_firm' => 'Admin Firm','owner_purpose_of_loan'=>'FI',
                'owner_entity_type'=> 'Partnership Firm','owner_name' => 'User Admin', 'address' => 'Mumbai', 'owner_city' => 'Mumbai',
                'owner_state'=> 'Maharashtra','pincode'=> '411011','contact1'=> '9898989898', 'contact2' => '', 'latest_turnover' => '70', 'required_amount'=> '10'),

            array('user_id' => '2', 'referredby_userid' => null, 'name_of_firm' => 'SME Firm','owner_purpose_of_loan'=>'PP',
                'owner_entity_type'=> 'Pvt Ltd Company','owner_name' => 'User SME', 'address' => 'Andheri West', 'owner_city' => 'Mumbai',
                'owner_state'=> 'Maharashtra','pincode'=> '411012','contact1'=> '9898989899', 'contact2' => '', 'latest_turnover' => '60', 'required_amount'=> '15'),

            array('user_id' => '3', 'referredby_userid' => null, 'name_of_firm' => 'Analyst Firm','owner_purpose_of_loan'=>'PV',
                'owner_entity_type'=> 'LLP','owner_name' => 'User Analyst', 'address' => 'Andheri East', 'owner_city' => 'Mumbai',
                'owner_state'=> 'Maharashtra','pincode'=> '411013','contact1'=> '9898989895', 'contact2' => '', 'latest_turnover' => '50', 'required_amount'=> '10'),

            array('user_id' => '4', 'referredby_userid' => null, 'name_of_firm' => 'CP Firm','owner_purpose_of_loan'=>'FI',
                'owner_entity_type'=> 'Partnership Firm','owner_name' => 'User CP', 'address' => 'Vashi', 'owner_city' => 'Mumbai',
                'owner_state'=> 'Maharashtra','pincode'=> '411014','contact1'=> '9898989896', 'contact2' => '', 'latest_turnover' => '80', 'required_amount'=> '15'),

            array('user_id' => '5', 'referredby_userid' => null, 'name_of_firm' => 'Bank Firm','owner_purpose_of_loan'=>'PE',
                'owner_entity_type'=> 'Pvt Ltd Company','owner_name' => 'User Bank', 'address' => 'Powai', 'owner_city' => 'Mumbai',
                'owner_state'=> 'Maharashtra','pincode'=> '411015','contact1'=> '9898989897', 'contact2' => '', 'latest_turnover' => '75', 'required_amount'=> '10'),

            array('user_id' => '6', 'referredby_userid' => null, 'name_of_firm' => 'Executive Firm','owner_purpose_of_loan'=>'FD',
                'owner_entity_type'=> 'Trust','owner_name' => 'User Executive', 'address' => 'Powai', 'owner_city' => 'Mumbai',
                'owner_state'=> 'Maharashtra','pincode'=> '411016','contact1'=> '9898989898', 'contact2' => '', 'latest_turnover' => '40', 'required_amount'=> '10'),
        ));
    }

    protected function createAndActivateUser($userName, $email, $password, $role){
        $user = new User();
        $user->userName = $userName;
        $user->email = $email;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->save();

//        $role = Sentinel::findRoleBySlug($role);
        $role = Roles::where('slug', '=', $role)->get()->first();
        $role->users()->attach($user);
        $user->push();
        $user->save();

//        $activation = new EloquentActivation();
//        $activation->user_id = $user->id;
//        $activation->code = str_random(32);
//        $activation->completed = 1;
//        $activation->save();

        return $user;
    }
}