<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('taxes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 64)->nullable(false);
			$table->decimal('percent', 8, 3)->default(0.0);

			$table->decimal('extra_percent', 8, 3)->default(0.0);		// Recargo de Equivalencia (Spain only)

			$table->tinyInteger('active')->default(1);
			
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
		Schema::drop('taxes');
	}

}
