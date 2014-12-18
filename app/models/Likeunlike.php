<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Likeunlike extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;


	protected $fillable = array('content', 'reviewid', 'commentid' 'userid');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'likeunlikes';
}
