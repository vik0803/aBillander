<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('companies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name_fiscal', 128)->nullable(false);			// Company
			$table->string('name_commercial', 64)->nullable();
			$table->string('identification', 64)->nullable(false);			// VAT ID or the like (only companies & pro's?)

			$table->string('website', 128)->nullable();

			$table->string('company_logo', 128)->nullable();				// Usually lives in: /public/img/ 
																			// Image types?
			$table->text('notes')->nullable();

			// ToDo: extra fields: "Registro mercantil" and the like

			$table->integer('address_id')->unsigned()->nullable(false); 
			$table->integer('currency_id')->unsigned()->nullable(false); 
			
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('companies');
	}

}
