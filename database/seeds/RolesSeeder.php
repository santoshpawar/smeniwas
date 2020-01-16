<?php

// MasterDataSeeder.php
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //MasterData::unguard();
        //delete users table records
        DB::table('roles')->truncate();

        //insert some dummy records
        DB::table('roles')->insert(array(
            array('slug' => Config::get('constants.RL_SME'), 'name' => 'Small & Medium Enterprise'),
            array('slug' => Config::get('constants.RL_ANALYST'), 'name' => 'Data Analyst'),
            array('slug' => Config::get('constants.RL_CP'), 'name' => 'Channel Partner'),
            array('slug' => Config::get('constants.RL_ADMIN'), 'name' => 'Administrator'),
            array('slug' => Config::get('constants.RL_EXECUTIVE'), 'name' => 'Data Entry Executive'),
            array('slug' => Config::get('constants.RL_BANK_USER'), 'name' => 'Bank User'),
            array('slug' => Config::get('constants.RL_MANAGEMENT'), 'name' => 'Management'),
        ));
    }
}