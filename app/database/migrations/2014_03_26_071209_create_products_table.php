<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('description')->nullable();
			$table->float('unitprice');
			$table->string('unit');
			$table->float('unitsinstock')->nullable();
			$table->float('discount')->default(0);
			$table->string('status')->nullable();
			$table->integer('business_id')->unsigned();

			$table->softDeletes();

			$table->unique(array('name', 'business_id'));
			$table->index('name');
			$table->foreign('business_id')->references('id')->on('businesses');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}

}
