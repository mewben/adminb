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
        // Creates the users table
        Schema::create('users', function($table)
        {
            $table->increments('id');
            $table->string('username');
            $table->string('email');
            $table->string('password');
            $table->string('confirmation_code')->nullable();
            $table->boolean('confirmed')->default(false);
            $table->string('status')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->unique('username');
            $table->unique('email');
            $table->index('username');
            $table->index('email');
        });

        // Creates password reminders table
        Schema::create('password_reminders', function(Blueprint $table)
        {
            $table->string('email');
            $table->string('token');
            $table->timestamp('created_at');

            $table->primary('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('password_reminders');
        Schema::drop('users');
    }

}
