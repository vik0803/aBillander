<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombinationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('combinations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('reference', 32)->nullable();
			$table->string('ean13', 13)->nullable();

			$table->integer('quantity_onhand')->default(0);			// In Stock; on hand
			$table->integer('quantity_onorder')->default(0);		// On order; Quantity on Purchase Orders (pendiente de recibir)
			$table->integer('quantity_allocated')->default(0);		// Allocated; Quantity on Sale Orders (reservado)
																	// Available: instock + onorder - allocated

			$table->integer('reorder_point')->default(0);			// Acts like safety stock or minimum stock
			$table->integer('maximum_stock')->default(0);	
			
			$table->decimal('price', 20, 6)->default(0.0);
			$table->decimal('cost_price', 20, 6)->default(0.0);
			$table->decimal('cost_average', 20, 6)->default(0.0);

//			$table->string('supplier_reference', 32)->nullable();
			$table->integer('supply_lead_time')->unsigned()->default(0);

			$table->string('location', 64)->nullable();
			$table->decimal('width', 20, 6)->nullable()->default(0.0);   // cm
			$table->decimal('height', 20, 6)->nullable()->default(0.0);
			$table->decimal('depth', 20, 6)->nullable()->default(0.0);
			$table->decimal('weight', 20, 6)->nullable()->default(0.0);  // kg

			$table->integer('warranty_period')->unsigned()->default(0);
			
			$table->text('notes')->nullable();
			$table->tinyInteger('publish_to_web')->default(0);
			$table->tinyInteger('blocked')->default(0);					// Sales not allowed
			$table->tinyInteger('active')->default(1);

			$table->tinyInteger('is_default')->default(0);				// Is default combination? Mainly for webshop use
			
			$table->integer('product_id')->unsigned()->nullable(false);
//			$table->integer('main_supplier_id')->unsigned()->nullable();
			
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
		Schema::drop('combinations');
	}

}
