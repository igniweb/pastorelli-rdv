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
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->enum('role', ['super-admin', 'admin', 'guest']);
			$table->string('login')->unique();
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('email')->nullable();
			$table->string('tel')->nullable();
			$table->string('password');
			$table->timestamps();

			$table->engine = 'InnoDB';
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
