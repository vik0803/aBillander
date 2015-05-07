<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStockMovementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stock_movements', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamp('date');
			$table->string('model_name', 64)->nullable(false);    	// Stock movement may be owned by a shipping slip, invoice, stock adjustment...!
			$table->integer('document_id')->unsigned()->default(0);	// id of model_name
			$table->integer('document_line_id')->unsigned()->default(0);	// line id of document_id
			$table->string('document_reference');					// document_prefix + document_id of model_name (or supplier reference, etc.)
			$table->decimal('price');
			$table->integer('quantity');

			$table->text('notes')->nullable();
			
			$table->integer('product_id')->unsigned()->nullable(false);
			$table->integer('combination_id')->unsigned()->nullable(false)->default(0);
			$table->integer('warehouse_id')->unsigned()->nullable(false);
			$table->integer('movement_type_id')->unsigned()->nullable(false);			// Movement types: Input (Purchase order...), Output (Sales order,...), Stock Adjustment
			$table->integer('user_id')->unsigned()->nullable(false)->default(0);
			
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
		Schema::drop('stock_movements');
	}

}
