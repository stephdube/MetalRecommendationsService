<?php

Route::get('/', function(){
		return View::make('index');
	}
);

/*--------------------------------------------------------
*	Generate form for users to log in
*---------------------------------------------------------*/
Route::get('/login', 'UserController@getLogin');

/*--------------------------------------------------------
*	Process form to log users in
*---------------------------------------------------------*/
Route::post('/login', ['before' => 'csrf', 'uses' => 'UserController@postLogin'] );

/*--------------------------------------------------------
*	Log users out
*---------------------------------------------------------*/
Route::get('/logout', ['before' => 'auth', 'uses' => 'UserController@getLogout'] );

/*--------------------------------------------------------
*	Generate form for users to create account
*---------------------------------------------------------*/
Route::get('/signup', 'UserController@getSignup');

/*--------------------------------------------------------
*	Process form for users to create account
*---------------------------------------------------------*/
Route::post('/signup', ['before' => 'csrf', 'uses' => 'UserController@postSignup'] );

/*--------------------------------------------------------
*	Display form for searching through albums/releases
*---------------------------------------------------------*/
Route::get('/search', 'SearchController@getSearch');

/*--------------------------------------------------------
*	Process form and search through albums/releases
*---------------------------------------------------------*/
Route::post('/search', 'SearchController@postSearch');

/*----------------------------------------------------------------------
* 	Display information about selected release and enable user to rate it
*----------------------------------------------------------------------*/
Route::get('/album', function()
{
	return View::make('album');

});

Route::post('/remember', ['before' => 'auth', 'uses' => 'BookmarkController@postRemember'] );

Route::post('/remove', ['before' => 'auth', 'uses' => 'BookmarkController@postRemove'] );