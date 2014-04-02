<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->enum('type', ['income', 'expense']);
			$table->date('date');
			$table->double('amount');
			$table->string('notes')->nullable();
			$table->integer('business_id');
			$table->string('status')->nullable();
			$table->timestamps();

			$table->index('type');
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
		Schema::drop('transactions');
	}

}
