<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikeunlikeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('likeunlikes', function($table)
								{
									$table->increments('id');
									$table->integer('content');
									$table->integer('reviewid');
									$table->integer('commentid');
									$table->integer('userid');
									$table->timestamps();
								}
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
		Schema::drop('likeunlikes');
	}

}
