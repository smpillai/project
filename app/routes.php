<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/',  array(
						'as' =>'home',
						'uses' => 'HomeController@home'
					  )
          );


Route::get('/audience/loggedin/{username}', array
					(
						'as' =>'audience-profile-user',
						'uses' => 'AudienceProfileController@user'
					)
			);




Route::group( array('before'=>'auth'), function()
				{

				Route::group( array('before' => 'csrf'), function()
								{

										Route::post('/audience/change-password', 
													array
													(
													    'as' => 'audience-change-password-post', 
														'uses' => 'AudienceController@postChangePassword'
													)
										  		);

										
										Route::post('/movie-review-system/add-movie', 
													array
													(
													    'as' => 'moviereviewsystem-add-movie-post', 
														'uses' => 'MoviereviewsystemController@postAddMovie'
													)
										  		);

										Route::post('/movie-review-system/add-movie-review/{id}', array(
											    'as' => 'moviereviewsystem-add-movie-review-post', 
												'uses' => 'MoviereviewsystemController@postAddMovieReview'
											)
									  );

										Route::post('/movie-review-system/add-movie-review-comment/{id}', array(
											    'as' => 'moviereviewsystem-add-movie-review-comment-post', 
												'uses' => 'MoviereviewsystemController@postAddMovieReviewComment'
											)
									  );

										
										Route::post('/movie-review-system/review/{id}/edit', array(
											    'as' => 'moviereviewsystem-edit-movie-review-post', 
												'uses' => 'MoviereviewsystemController@postEditMovieReview'
											)
									  );

										Route::post('/movie-review-system/review/{id}/delete', array(
											    'as' => 'moviereviewsystem-delete-movie-review-post', 
												'uses' => 'MoviereviewsystemController@postDeleteMovieReview'
											)
									  );

									Route::post('/movie-review-system/comment/{id}/edit', array(
											    'as' => 'moviereviewsystem-comment-edit-post', 
												'uses' => 'MoviereviewsystemController@postEditComment'
											)
									  );

									Route::post('/movie-review-system/comment/{id}/delete', array(
											    'as' => 'moviereviewsystem-comment-delete-post', 
												'uses' => 'MoviereviewsystemController@postDeleteComment'
											)
									  );

								}
							);

							Route::get('/audience/change-password', array(
											    'as' => 'audience-change-password', 
												'uses' => 'AudienceController@getChangePassword'
											)
									  );

							Route::get('/audience/signout', array(
											    'as' => 'audience-sign-out', 
												'uses' => 'AudienceController@getSignOut'
											)
									  );

							Route::get('/administrator/signout', array(
											    'as' => 'administrator-sign-out', 
												'uses' => 'AdministratorController@getSignOut'
											)
									  );

							Route::get('/movie-review-system/add-movie', array(
											    'as' => 'moviereviewsystem-add-movie', 
												'uses' => 'MoviereviewsystemController@getAddMovie'
											)
									  );

							Route::get('/movie-review-system/index-movie', array(
											    'as' => 'moviereviewsystem-index-movie', 
												'uses' => 'MoviereviewsystemController@getIndexMovie'
											)
									  );

							Route::get('/movie-review-system/movie/{id}', array(
											    'as' => 'moviereviewsystem-view-movie', 
												'uses' => 'MoviereviewsystemController@getViewMovie'
											)
									  );

							Route::get('/movie-review-system/add-movie-review/{id}', array(
											    'as' => 'moviereviewsystem-add-movie-review', 
												'uses' => 'MoviereviewsystemController@getAddMovieReview'
											)
									  );

							
							Route::get('/movie-review-system/review/{id}', array(
											    'as' => 'moviereviewsystem-view-review', 
												'uses' => 'MoviereviewsystemController@getViewMovieReview'
											)
									  );

							Route::get('/movie-review-system/review/{id}/edit', array(
											    'as' => 'moviereviewsystem-view-review-edit', 
												'uses' => 'MoviereviewsystemController@getEditMovieReview'
											)
									  );
							
							
							Route::get('/movie-review-system/add-movie-review-comment/{id}', array(
											    'as' => 'moviereviewsystem-add-movie-review-comment', 
												'uses' => 'MoviereviewsystemController@getAddMovieReviewComment'
											)
									  );

							Route::get('/movie-review-system/comment/{id}/edit', array(
											    'as' => 'moviereviewsystem-comment-edit', 
												'uses' => 'MoviereviewsystemController@getEditComment'
											)
									  );

							
							Route::get('/movie-review-system/review/{id}/delete', array(
											    'as' => 'moviereviewsystem-delete-movie-review', 
												'uses' => 'MoviereviewsystemController@getDeleteMovieReview'
											)
									  );

							Route::get('/movie-review-system/comment/{id}/delete', array(
											    'as' => 'moviereviewsystem-comment-delete', 
												'uses' => 'MoviereviewsystemController@getDeleteComment'
											)
									  );
				}
);

Route::group( array('before'=>'guest'), function()
				{

					Route::group( array('before' => 'csrf'), function()
									{

										Route::post('/audience/create', array(
													    'as' => 'audience-create-post', 
														'uses' => 'AudienceController@postCreate'
																			)
									  				);

										Route::post('/administrator/signin', array(
													    'as' => 'administrator-sign-in-post', 
														'uses' => 'AdministratorController@postSignIn'
													)
											  );

										Route::post('/audience/signin', array(
														    'as' => 'audience-sign-in-post', 
															'uses' => 'AudienceController@postSignIn'
														)
												  );

										Route::post('/audience/forgot-password', array
														(
													    'as' => 'audience-forgot-password-post', 
														'uses' => 'AudienceController@postForgotPassword'
														)
													);
							  
									}
								);

					
				
				Route::get('/audience/forgot-password', array
									(
									    'as' => 'audience-forgot-password', 
										'uses' => 'AudienceController@getForgotPassword'
									)
							  );

				Route::get('/audience/recover/{code}', array(
									    'as' => 'audience-recover', 
										'uses' => 'AudienceController@getRecover'
									)
							  );


				Route::get('/administrator/signin', array(
									    'as' => 'administrator-sign-in', 
										'uses' => 'AdministratorController@getSignIn'
									)
							  );

				Route::get('/audience/signin', array(
									    'as' => 'audience-sign-in', 
										'uses' => 'AudienceController@getSignIn'
									)
							  );


					Route::get('/audience/create', array(
									    'as' => 'audience-create', 
										'uses' => 'AudienceController@getCreate'
									)
							  );

					Route::get('/audience/activate/{code}', array(
									    'as' => 'audience-activate', 
										'uses' => 'AudienceController@getActivate'
									)
							  );

				}
			);

