<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->string('password', 60);

			$table->string('home_page', 128)->nullable();		// Redirect after login to route_home
			$table->string('firstname', 32)->nullable();
			$table->string('lastname', 32)->nullable();

			$table->rememberToken();							// $table->string('remember_token', 100)->nullable();

			$table->tinyInteger('is_admin')->default(0);		// Role here
			$table->tinyInteger('active')->default(1);

			$table->integer('language_id')->unsigned()->nullable(false); 

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
		Schema::drop('users');
	}

}
