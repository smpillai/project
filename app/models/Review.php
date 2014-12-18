<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;


class Review extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $fillable = array('content', 'rating', 'movieid', 'userid');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'reviews';
}
