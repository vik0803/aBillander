<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCombinationWarehouseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('combination_warehouse', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('combination_id')->unsigned()->index();
			$table->foreign('combination_id')->references('id')->on('combinations')->onDelete('cascade');

			$table->integer('warehouse_id')->unsigned()->index();
			$table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');

			$table->integer('quantity')->default(0);
			
			$table->timestamps();
			
			// Also see: http://johnveldboom.com/posts/5/working-with-data-in-pivot-tables-using-laravel-4-eloquent-orm
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('combination_warehouse');
	}

}
