<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call('MasterDataSeeder');
		$this->command->info('Master Data table seeded!');
		$this->call('RolesSeeder');
		$this->command->info('Roles table seeded!');
		$this->call('QuestionsConfigurationSeeder');
		$this->command->info('Question configuration tables seeded!');
		$this->call('LoansSeeder');
		$this->command->info('Loans table seeded with dummy data!');
		$this->call('FinancialEntriesSeeder');
		$this->command->info('Financial entries configuration tables seeded!');
        $this->call('AnalystModelsSeeder');
        $this->command->info('Analyst credit and collateral model configuration tables seeded!');
        $this->call('ConfigurableParamsSeeder');
        $this->command->info('Configurable parameter tables seeded!');
        $this->call('BankAllocationSeeder');
        $this->command->info('Bank Master and Bank Allocations tables seeded!');
        $this->call('ConfFinEntriesCashflowSeeder');
        $this->command->info('Financial entries configuration for cashflow tables seeded!');
	}
}
