<?php

Route::get('/', function()
{
	return View::make('index');
});

Route::get('/login', function()
{
	return View::make('login');
});

Route::get('/signup', function()
{
	return View::make('signup');
});

Route::get('/search', function()
{
	return View::make('search');
});

Route::post('/search', function()
{
	// Check for album query
	$album = (Input::get('album_name') ? Input::get('album_name') : '');
	// Note if user wants exact matches
	$albums_compare=(Input::get('exact_album_title')?"=":"LIKE");

	// Check for band query and for what kind of search to make
	$band = (Input::get('band_name') ? Input::get('band_name') : '');
	$bands_compare = (Input::get('exact_band_title')?"=":'LIKE');

	// Check for genre query
	$genre = (Input::get('genre') ? Input::get('genre') : '');
	$genres_compare = (Input::get('exact_genre')?"=":'LIKE');

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

	// Check for review number query
	$reviews = Input::get('reviews');

	return View::make('search_results')
		->with('album',$album)
		->with('albums_compare', $albums_compare)
		->with('band',$band)
		->with('bands_compare', $bands_compare)
		->with('genre', $genre)
		->with('genres_compare', $genres_compare)
		->with('country', $country)
		->with('release_type', $release_type)
		->with('label', $label)
		->with('order_by', $order_by)
		->with('reviews', $reviews);
});

// Once someone selects an album, go to the album's rating page to rate it..
Route::get('/album', function()
{
	$album_id = Input::get('id');
	echo $album_id;
});