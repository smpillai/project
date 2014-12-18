<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserAdmin extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		DB::table('users')->insert( 
									array
									(
									 'email' => 'vikrant.symantec@gmail.com',
									 'username' => 'administrator', 
									 'password' => Hash::make('admin123'), 
									 'code' => str_random(50),
									  'active' => 1,
									  'created_at' => date('Y-m-d H:m:s'),
									  'updated_at' => date('Y-m-d H:m:s')
									)
			);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		DB::table('users')->where('username', '=', 'administrator')->delete();
	}

}
