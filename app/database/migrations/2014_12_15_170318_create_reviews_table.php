<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('reviews', function($table)
								{
									$table->increments('id');
									$table->text('content');
									$table->integer('rating');
									$table->integer('movieid');
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
		Schema::drop('reviews');
	}

}
