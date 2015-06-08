<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        $this->call('BranchTableSeeder');
        $this->call('BusinessTableSeeder');
		$this->call('ServiceTableSeeder');
        $this->call('UserTableSeeder');
        $this->call('UserBusinessTableSeeder');
        $this->call('PriorityNumberTableSeeder');
        $this->call('PriorityQueueTableSeeder');
        $this->call('QueueSettingsTableSeeder');
        $this->call('TerminalTableSeeder');
        $this->call('TerminalUserTableSeeder');
        $this->call('TerminalTransactionTableSeeder');
	}

}
