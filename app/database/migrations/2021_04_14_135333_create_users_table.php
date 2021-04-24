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
            $table->String('username', 50)->unique();
            $table->String('email', 50)->unique();
            $table->String('password', 100);
            $table->String('remember_token')->nullable();
            $table->String('type', 8);
            $table->String('telephone', 11)->nullable();
            $table->String('qq', 11)->nullable();
            $table->String('weibo', 11)->nullable();
            $table->String('Intro', 255)->nullable();
            $table->String('portrait', 255)->nullable();
			$table->timestamps();
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
