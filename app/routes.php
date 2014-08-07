<?php

Route::get('/', function(){
		return View::make('index');
	}
);

/*--------------------------------------------------------
*	Generate and process form for users to log in
*---------------------------------------------------------*/
Route::get('/login', 'UserController@getLogin');

Route::post('/login', ['before' => 'csrf', 'uses' => 'UserController@postLogin']);

/*--------------------------------------------------------
*	Log users out
*---------------------------------------------------------*/
Route::get('/logout', ['before' => 'auth', 'uses' => 'UserController@getLogout']);

/*--------------------------------------------------------
*	Generate and process form for users to create account
*---------------------------------------------------------*/
Route::get('/signup', 'UserController@getSignup');

Route::post('/signup', ['before' => 'csrf', 'uses' => 'UserController@postSignup']);

/*--------------------------------------------------------
*	Display and process form for searching through albums/releases
*---------------------------------------------------------*/
Route::get('/search', 'SearchController@getSearch');

Route::post('/search', 'SearchController@postSearch');

/*--------------------------------------------------------
*	Display all albums for a specified band
*---------------------------------------------------------*/
Route::get('/band', 'SearchController@postSearch');

/*----------------------------------------------------------------------
* 	Display information about selected release and enable user to rate it.
* 	Redirect guests away from this page.
*----------------------------------------------------------------------*/
Route::get('/album', ['before' => 'auth', 'uses' =>'AlbumController@getAlbum']);

/*----------------------------------------------------------------------
* 	Add and remove selected releases to user's Bookmarks
*----------------------------------------------------------------------*/
Route::post('/remember', ['before' => 'auth', 'uses' => 'BookmarkController@postRemember'] );

Route::post('/remove', ['before' => 'auth', 'uses' => 'BookmarkController@postRemove']);

/*----------------------------------------------------------------------
* 	Add and update user's Ratings
*----------------------------------------------------------------------*/
Route::post('/rate', ['before' => 'auth', 'uses' => 'RateController@postRate'] );

Route::get('/about', function(){
	return View::make('about');
});
