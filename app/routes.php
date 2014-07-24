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
	// If user supplied album name, save it, otherwise make it an empty string
	$album = (Input::get('album_name') ? Input::get('album_name') : '');
	// If user supplied band name, save it, otherwise make it an empty string
	$band = (Input::get('band_name') ? Input::get('band_name') : '');
	// If search by genre, save, or make empty string
	$genre = (Input::get('genre') ? Input::get('genre') : '');
	// Search by country...
	$country = (Input::get('country') ? Input::get('country') : '');
	// If user specified ordering, save preference. Default to sort by Rating.
	$order_by = (Input::get('order_by') ? Input::get('order_by'):'avg_rating');
	// Note if user wants exact matches
	$albums_compare=(Input::get('exact_album_title')?"=":"LIKE");
	$bands_compare = (Input::get('exact_band_title')?"=":'LIKE');
	$genres_compare = (Input::get('exact_genre')?"=":'LIKE');
	// Save specified release type, if any
	$release_type = (Input::get('release_type') ? Input::get('release_type') : '');
	$label = (Input::get('label') ? Input::get('label') : '');

	return View::make('search_results')
		->with('album',$album)
		->with('band',$band)
		->with('genre', $genre)
		->with('order_by', $order_by)
		->with('albums_compare', $albums_compare)
		->with('bands_compare', $bands_compare)
		->with('genres_compare', $genres_compare)
		->with('release_type', $release_type)
		->with('country', $country);
});

// Once someone selects an album, go to the album's rating page to rate it..
Route::get('/album', function()
{
	$album_id = Input::get('id');
	echo $album_id;
});