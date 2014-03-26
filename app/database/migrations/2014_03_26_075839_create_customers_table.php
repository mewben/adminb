<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('address')->nullable();
			$table->string('email')->nullable();
			$table->string('contact')->nullable();
			$table->string('status')->nullable();
			$table->integer('business_id')->unsigned();

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
		Schema::drop('customers');
	}

}
