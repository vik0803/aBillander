<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

// ? use database\seeds\ConfigurationsTableSeeder;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// $this->call('UserTableSeeder');

		$this->call('ConfigurationsTableSeeder');
        $this->command->info('Configuration table seeded!');
	}

}
