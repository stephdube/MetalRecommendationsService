<?php

class AlbumController extends BaseController {

	public function getAlbum() {

		// randomized album search
		if(Input::get('id') == "random")
		{
			$selection_size = 1000;

			$albums = DB::table('albums')
				->select('album_id')->take($selection_size)
				->get();
	
			$album_id = $albums[rand(1, $selection_size)]->album_id;

		}
		else {
			$album_id = Input::get('id');
		}


		$album = DB::table('albums')
			->join('bands', 'bands.band_id', '=', 'albums.band_id') 
			// has to be leftJoin or it will exclude albums with no reviews
			->leftJoin('reviews', 'reviews.album_id', '=', 'albums.album_id')
			->select('albums.album_id', 
				'albums.album_title', 
				'bands.band_name', 
				'bands.genre', 
				'albums.release_type', 
				'bands.country', 
				'albums.release_date', 
				'albums.label',
				'bands.band_id',
				DB::raw('AVG(reviews.rating) as avg_rating'), 
				DB::raw('count(reviews.rating) as review_count'), 
				DB::raw('count(CASE WHEN reviews.rating <= 10 THEN 1 ELSE null END) as rat10'),
				DB::raw('count(CASE WHEN 10 < reviews.rating AND reviews.rating <= 20 THEN 1 END) as rat20'),
				DB::raw('count(CASE WHEN 20 < reviews.rating AND reviews.rating <= 30 THEN 1 END) as rat30'),
				DB::raw('count(CASE WHEN 30 < reviews.rating AND reviews.rating <= 40 THEN 1 END) as rat40'),
				DB::raw('count(CASE WHEN 40 < reviews.rating AND reviews.rating <= 50 THEN 1 END) as rat50'),
				DB::raw('count(CASE WHEN 50 < reviews.rating AND reviews.rating <= 60 THEN 1 END) as rat60'),
				DB::raw('count(CASE WHEN 60 < reviews.rating AND reviews.rating <= 70 THEN 1 END) as rat70'),
				DB::raw('count(CASE WHEN 70 < reviews.rating AND reviews.rating <= 80 THEN 1 END) as rat80'),
				DB::raw('count(CASE WHEN 80 < reviews.rating AND reviews.rating <= 90 THEN 1 END) as rat90'),
				DB::raw('count(CASE WHEN 90 < reviews.rating THEN 1 END) as rat100'))
			->groupBy('albums.album_id', 'albums.album_title', 'bands.band_name', 'bands.genre', 'albums.release_type', 'bands.country', 'albums.release_date', 'albums.label')
			->where('albums.album_id', $album_id)->get();

		// check if query returned anything before moving forward
		if (empty($album)){
			return Redirect::to('/')
				->with('flash_message', 'Sorry, no such album');
		}

		$album = $album[0];

		// Incorporate newly acquired data with older data
		$user_ratings = DB::table('ratings')
			->select('rating')
			->where('album_id', $album->album_id)->get();

		// Check if this album has any reviews to analyze
		$total_reviews = $album->review_count + sizeof($user_ratings);
		if($total_reviews != 0){

			// Loop through reviews, track # to find avg, etc.
			$new_review_sum = 0;
			foreach($user_ratings as $rating){

			$new_review_sum += $rating->rating;

				// add these ratings to the rating category "buckets"
				switch (true){
					case ($rating->rating <= 10):
						$album->rat10++;
						break;
					case ($rating->rating > 10 && $rating->rating <=20):
						$album->rat20 ++;
						break;
					case ($rating->rating > 20 && $rating->rating <=30):
						$album->rat30 ++;
						break;
					case ($rating->rating > 30 && $rating->rating <=40):
						$album->rat40 ++;							break;
					case ($rating->rating > 40 && $rating->rating <=50):
						$album->rat50 ++;
						break;
					case ($rating->rating > 50 && $rating->rating <=60):
						$album->rat60 ++;
						break;
					case ($rating->rating > 60 && $rating->rating <=70):							$album->rat70 ++;
						break;
					case ($rating->rating > 70 && $rating->rating <=80):
						$album->rat80++;
						break;
					case ($rating->rating > 80 && $rating->rating <=90):
						$album->rat90 ++;
						break;
					case ($rating->rating > 90 && $rating->rating <=100):
						$album->rat100 ++;
						break;
				}
			}
			// based on new numbers, calculate new average rating for this album
			$album->avg_rating = (($album->avg_rating*$album->review_count) + $new_review_sum) / $total_reviews;

			// assign new total to old variable name to pass to View
			$album->review_count = $total_reviews;
		}
			
		$this_bookmark = DB::table('bookmarks')
			->where('user_id', Auth::id())
			->where('album_id', $album->album_id)->get();

		$this_rating = DB::table('ratings')
			->where('user_id', Auth::id())
			->where('album_id', $album->album_id)->get();

		$this_rating = (!empty($this_rating)) ? $this_rating[0] : $this_rating;

		return View::make('album')
			->with('album', $album)
			->with('this_bookmark', $this_bookmark)
			->with('this_rating', $this_rating);
	}
}