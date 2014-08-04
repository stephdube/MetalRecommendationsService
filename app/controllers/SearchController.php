<?php

class SearchController extends BaseController {

	public function getSearch() {
		
		// queries needed to generate drop-down options in form
		$countries = DB::table('countries')->select('country')->get();

		$labels = DB::table('labels')->select('label')
			->where('count', '>', 75)->get();

		$release_types = DB::table('albums')->select('release_type')
			->groupBy('release_type')->get();

		return View::make('search')
			->with('countries', $countries)
			->with('labels', $labels)
			->with('release_types', $release_types);
	}

	public function postSearch(){

		// Check for album query
		$album = (Input::get('album_name') ? Input::get('album_name') : '');
		// Note if user wants exact matches
		$albums_compare=(Input::get('exact_album_title')?"=":"LIKE");

		// Check for band query and for what kind of search to make
		$band = (Input::get('band_name') ? Input::get('band_name') : '');
		$bands_compare = (Input::get('exact_band_title')?"=":'LIKE');

		// If not looking for an exact match on album name, edit album query string
		$album = (($albums_compare=='LIKE') ? "%".$album."%" : $album);
		// If not looking for an exact match on band name, edit band query string
		$band = (($bands_compare=='LIKE') ? "%".$band."%" : $band);

		// Check for genre query
		$genre = (Input::get('genre') ? Input::get('genre') : '');

		// Check for country query (always looking for exact match)
		$country = (Input::get('country') ? Input::get('country') : '');

		// Check for release-type query
		$release_type = (Input::get('release_type') ? Input::get('release_type') : '');
		
		// Check for label query
		$label = (Input::get('label') ? Input::get('label') : '');
		if (Input::get('unlisted_label')){
			$label = Input::get('unlisted_label');
		}
		if (Input::get('no_label')){
			$label = Input::get('no_label');
		}

		// Check for sort preference (default sort by rating)
		$order_by = (Input::get('order_by') ? Input::get('order_by'):'avg_rating');

		if ($order_by == 'avg_rating' || $order_by == 'review_count')
		{ 	// If sorting by ratings, put highest at top
			$direction = 'desc';
		} 
		else 
		{	// If sorting alphabetically, put beginning of alphabet at top
			$direction = 'asc';
		}

		// Check for review number query
		$reviews = Input::get('reviews');

		// Query for albums that match user's search input along with relevant album-data
		$albums = DB::table('albums')
			->join('bands', 'bands.band_id', '=', 'albums.band_id') 
			// get band info for album
			->leftJoin('reviews', 'reviews.album_id', '=', 'albums.album_id') 
			// get review info for album
			->select('albums.album_id', 'albums.album_title', 'bands.band_name', 'bands.genre', 'albums.release_type', 'bands.country', 'albums.release_date', 'albums.label', DB::raw('AVG(rating) as avg_rating'), DB::raw('count(rating) as review_count'), 
			// Aggregate data about reviews... This divides possible scores into buckets and counts how many reviews an album has in each bucket, to give a better idea of how the album has been received than a simple average would give.
				DB::raw('count(CASE WHEN rating <= 10 THEN 1 ELSE null END) as rat10'),
				DB::raw('count(CASE WHEN 10 < rating AND rating <= 20 THEN 1 END) as rat20'),
				DB::raw('count(CASE WHEN 20 < rating AND rating <= 30 THEN 1 END) as rat30'),
				DB::raw('count(CASE WHEN 30 < rating AND rating <= 40 THEN 1 END) as rat40'),
				DB::raw('count(CASE WHEN 40 < rating AND rating <= 50 THEN 1 END) as rat50'),
				DB::raw('count(CASE WHEN 50 < rating AND rating <= 60 THEN 1 END) as rat60'),
				DB::raw('count(CASE WHEN 60 < rating AND rating <= 70 THEN 1 END) as rat70'),
				DB::raw('count(CASE WHEN 70 < rating AND rating <= 80 THEN 1 END) as rat80'),
				DB::raw('count(CASE WHEN 80 < rating AND rating <= 90 THEN 1 END) as rat90'),
				DB::raw('count(CASE WHEN 90 < rating THEN 1 END) as rat100'))
			// Filter albums user's search queries
			->take(25)
			->where(function($query) use ($album, $albums_compare, $band, $bands_compare, $genre, $release_type, $country, $label)
			{
				if (!empty($album))
				{	// user wants to search by album titles
					$query->where('album_title', $albums_compare, $album);
				}
				if (!empty($band))
				{	// user wants to search by band name
					$query->where('band_name', $bands_compare, $band);
				}
				if (!empty($genre))
				{	// user wants to search by genre
					$query->where('genre', "LIKE", "%$genre%");
				}
				if (!empty($country))
				{	// user wants to search by country
					$query->where('country', "=", $country);
				}
				if (!empty($release_type))
				{	// user wants to search by release type
					$query->where('release_type', "=", $release_type);
				}
				if (!empty($label))
				{	// user wants to search by label
					$query->where('label', "=", $label);
				}
			})
			// Combine data into unique rows based on albums
			->groupBy('albums.album_id', 'albums.album_title', 'bands.band_name', 'bands.genre', 'albums.release_type', 'bands.country', 'albums.release_date', 'albums.label')
			->having('review_count', '>=', $reviews)
			->orderBy($order_by, $direction)
			->get();

			if(empty($albums)){
				return Redirect::to('search')
					->with('flash_message', 'Your search did not yield any results')
					->withInput();
			}
			else {
				// queries needed to generate drop-down options in form
				$countries = DB::table('countries')->select('country')->get();
				$labels = DB::table('labels')->select('label')
					->where('count', '>', 75)->get();
				$release_types = DB::table('albums')->select('release_type')
					->groupBy('release_type')->get();

				return View::make('results')
					->with('albums',$albums)
					->with('countries', $countries)
					->with('labels', $labels)
					->with('release_types', $release_types);
			}
	}
}