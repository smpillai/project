<?php

class MoviereviewsystemController extends BaseController
{

	public function getIndexMovie()
	{
		return View::make('moviereviewsystem.index')->with('movies', Movie::all());  //order_by('id')->get());//
	}

	public function getAddMovie()
	{
		return View::make('moviereviewsystem.addmovie');
	}

	public function postAddMovie()
	{
		$validator = Validator::make(	Input::all(), 
										array(
											   'moviename'  			=> 'required|max:50|min:1|unique:movies'
											)
									);


		if($validator->fails())
		{
			return Redirect::route('moviereviewsystem-add-movie')->withErrors($validator)->withInput();
		}
		else
		{
			
			//add movie in Database
			$moviename = Input::get('moviename');
			
			$movie = Movie::create( array(
											'moviename' => $moviename
										 )
								   );			
	
			if($movie)
			{
				
				return Redirect::route('moviereviewsystem-index-movie')->with('message', 'New Movie has been added in the Movie Database.');
			}
			
		}
		
		return Redirect::route('moviereviewsystem-add-movie')->with('message', 'Adding new movie failed.');		
	}

	public function getViewMovie($id)
	{
		//$reviewss = Review::where('movieid', '=', $id);

		return View::make('moviereviewsystem.viewmovie')->with('message', 'Movie Review Page')->with('movie', Movie::find($id))
					->with('reviews', Review::all());
	}

	public function getAddMovieReview($id)
	{
		return View::make('moviereviewsystem.addmoviereview')->with('movieid', $id);	
	}

	public function postAddMovieReview($id)
	{
		$validator = Validator::make(	Input::all(), 
										array(
											   'content'  			=> 'required|min:1',
											   'rating'				=> 'required'
											)
									);


		if($validator->fails())
		{
			return Redirect::route('moviereviewsystem-add-movie-review', $id)->withErrors($validator)->withInput();
		}
		else
		{
			
			//add movie review in Database
			$content = Input::get('content');
			$rating = Input::get('rating');
			
			$review = Review::create( array(
											'content' => $content,
											'rating' => $rating,
											'movieid' => $id,
											'userid' => Auth::user()->id
										 )
								   );			
	
			if($review)
			{
				
				return Redirect::route('moviereviewsystem-view-movie', $id)->with('message', 'New Movie Review has been added in the Movie Database.');
			}
			
		}
		
		return Redirect::route('moviereviewsystem-add-movie-review', $id)->with('message', 'Adding New Movie Review failed.');		
	}

	public function getViewMovieReview($id)
	{
		//$commentss = Comment::where('reviewid', '=', '7');//$id);

		return View::make('moviereviewsystem.viewmoviereview')
					->with('message', 'Movie Review Comments Page')
					->with('review', Review::find($id))
					->with('comments', Comment::all());
	}

	public function getAddMovieReviewComment($id)
	{
		return View::make('moviereviewsystem.addmoviereviewcomment')->with('reviewid', $id);	
	}

	public function postAddMovieReviewComment($id)
	{
		$validator = Validator::make(	Input::all(), 
										array(
											   'content'  			=> 'required|min:1'
											)
									);


		if($validator->fails())
		{
			return Redirect::route('moviereviewsystem-add-movie-review-comment', $id)->withErrors($validator)->withInput();
		}
		else
		{
			
			//add movie review comment in Database
			$content = Input::get('content');
			
			$comment = Comment::create( array(
											'content' => $content,
											'reviewid' => $id,
											'userid' => Auth::user()->id
										 )
								   );			
	
			if($comment)
			{
				
				return Redirect::route('moviereviewsystem-view-review', $id)->with('message', 'New Review comment has been added in the Movie Database.');
			}
			
		}
		
		return Redirect::route('moviereviewsystem-add-movie-review-comment', $id)->with('message', 'Adding New Review Comment failed.');	

	}

	public function getEditMovieReview($id)
	{
		return View::make('moviereviewsystem.editmoviereview')
					->with('review', Review::find($id));
	}

	public function postEditMovieReview($id)
	{
		$validator = Validator::make(	Input::all(), 
										array(
											   'content'  			=> 'required|min:1',
											    'rating'			=> 'required'
											)
									);


		if($validator->fails())
		{
			return Redirect::route('moviereviewsystem-view-review-edit', $id)->withErrors($validator)->withInput();
		}
		else
		{
			
			//add movie review in Database
			$content = Input::get('content');
			$rating = Input::get('rating');
			
			$review = Review::find($id);
			if($review)
			{
				$review->content = $content;
				$review->rating = $rating;	

				if($review->save())
				{			
				
					return Redirect::route('moviereviewsystem-view-review', $id)->with('message', 'Movie Review has been modified in the Movie Database.');
				}
			}
			
		}
		
		return Redirect::route('moviereviewsystem-view-review-edit', $id)->with('message', 'Editing Movie Review failed.');	
	}

	public function getDeleteMovieReview($id)
	{
		$review = Review::find($id);
		if($review)
		{
			$movieid = $review->movieid;
			if($review->delete())
			{
				return Redirect::route('moviereviewsystem-view-movie', $movieid)->with('message', 'Movie Review has been deleted from Movie Review Database.');
			}
		}
		
		return Redirect::route('moviereviewsystem-view-review', $id)->with('message', 'Deleting Movie Review failed.');	
	}

    public function	postDeleteMovieReview($id)
	{
		/*
		$review = Review::find($id);
		if($review)
		{
			$movieid = $review->movieid;
			if($review->delete())
			{
				return Redirect::route('administrator-view-movie', $movieid)->with('message', 'Movie Review has been deleted from Movie Review Database.');
			}
		}
		
		return Redirect::route('administrator-view-review', $id)->with('message', 'Deleting Movie Review failed.');	
		*/
	}

    public function	getEditComment($id)
	{
		return View::make('moviereviewsystem.editcomment')
					->with('comment', Comment::find($id));
	}
	
	public function postEditComment($id)
	{
		$validator = Validator::make(	Input::all(), 
										array(
											   'content'  			=> 'required|min:1'
											)
									);


		if($validator->fails())
		{
			return Redirect::route('moviereviewsystem-comment-edit', $id)->withErrors($validator)->withInput();
		}
		else
		{
			
			//add movie review in Database
			$content = Input::get('content');
			
			$comment = Comment::find($id);
			if($comment)
			{
				$comment->content = $content;

				if($comment->save())
				{			
				
					return Redirect::route('moviereviewsystem-view-review', $comment->reviewid)->with('message', 'Review Comment has been modified in the Movie Database.');
				}
			}
			
		}
		
		return Redirect::route('moviereviewsystem-comment-edit', $id)->with('message', 'Editing Review Comment failed.');	
	}

	public function getDeleteComment($id)
	{
		$comment = Comment::find($id);
		if($comment)
		{
			$reviewid = $comment->reviewid;
			if($comment->delete())
			{
				return Redirect::route('moviereviewsystem-view-review', $reviewid)->with('message', 'Review Comment has been deleted from Movie Review Database.');
			}
		}
		
		return Redirect::route('moviereviewsystem-view-review', $reviewid)->with('message', 'Deleting Review Comment failed.');	
	}

    public function	postDeleteComment($id)
	{

	}
}