<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('customer_id')->unsigned();
			$table->date('date');
			$table->string('status')->nullable();
			$table->integer('business_id')->unsiged();
			$table->timestamps();

			$table->foreign('customer_id')->references('id')->on('customers');
			$table->foreign('business_id')->references('id')->on('businesses');
		});

		Schema::create('order_details', function(Blueprint $table)
		{
			$table->integer('order_id')->unsigned();
			$table->integer('product_id')->unsigned();
			$table->float('unitprice');
			$table->float('quantity');
			$table->float('discount');

			$table->foreign('order_id')->references('id')->on('orders');
			$table->foreign('product_id')->references('id')->on('products');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
		Schema::drop('order_details');
	}

}
