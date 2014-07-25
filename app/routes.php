<?php

Route::get('/', function(){
		return View::make('index');
	}
);

/*--------------------------------------------------------
*	Generate form for users to log in
*---------------------------------------------------------*/
Route::get('/login', 
	// if user is already logged in, redirect away from login form
	array('before' => 'guest',
        function() {
            return View::make('login');
        }
    )
);

/*--------------------------------------------------------
*	Process form to log users in
*---------------------------------------------------------*/
Route::post('/login', 
    array('before' => 'csrf', 
        function() {

            $credentials = Input::only('username', 'password');

            if (Auth::attempt($credentials, $remember = true)) {
                return Redirect::intended('/')->with('flash_message', 'Welcome back');
            }
            else {
                return Redirect::to('/login')->with('flash_message', 'Log in failed; please try again.');
            }

            return Redirect::to('login');
        }
    )
);

/*--------------------------------------------------------
*	Log users out
*---------------------------------------------------------*/
Route::get('/logout', function() {

    # Log out
    Auth::logout();

    # Send them to the homepage
    return Redirect::to('/');

});

/*--------------------------------------------------------
*	Generate form for users to create account
*---------------------------------------------------------*/
Route::get('/signup', 
	// if account already exists, redirect users away from signup form
	array('before'=>'guest', 
		function(){
			return View::make('signup');
		}
	)
);

/*--------------------------------------------------------
*	Process form for users to create account
*---------------------------------------------------------*/
Route::post('/signup', 
    array('before' => 'csrf', 
        function() {

            $user = new User;
            $user->username    = Input::get('username');
            $user->password = Hash::make(Input::get('password'));

            # Try to add the user 
            try {
                $user->save();
            }
            # Fail
            catch (Exception $e) {
                return Redirect::to('/signup')->with('flash_message', 'Sign up failed; please try again.')->withInput();
            }

            # Log the user in
            Auth::login($user);

            return Redirect::to('/')->with('flash_message', 'Welcome to Metal Recommendations');

        }
    )
);

/*--------------------------------------------------------
*	Display form for searching through albums/releases
*---------------------------------------------------------*/
Route::get('/search', function()
{
	return View::make('search');
});

/*--------------------------------------------------------
*	Process form and search through albums/releases
*---------------------------------------------------------*/
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
	if (Input::get('reviews') > 0){
		$reviews = Input::get('reviews');
	}
	else {
		$reviews = '';
	}

	return View::make('search_results')
		->with('album',$album)
		->with('albums_compare', $albums_compare)
		->with('band',$band)
		->with('bands_compare', $bands_compare)
		->with('genre', $genre)
		->with('country', $country)
		->with('release_type', $release_type)
		->with('label', $label)
		->with('order_by', $order_by)
		->with('reviews', $reviews);
});

/*----------------------------------------------------------------------
* 	Display information about selected release and enable user to rate it
*----------------------------------------------------------------------*/
Route::get('/album', function()
{
	$album_id = Input::get('id');
	echo $album_id;
});