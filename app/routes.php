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
Route::get('/album', ['before' => 'auth', 'uses' =>'AlbumController@getAlbum']);

Route::get('/random', function(){
	$albums = DB::table('albums')
		->select('album_id')->get();

	return Redirect::action('AlbumController@getAlbum', 
		array('id' => $albums[rand(1, sizeof($albums)-1)]->album_id));
});

/*----------------------------------------------------------------------
* 	Add and remove selected releases to user's Bookmarks
*----------------------------------------------------------------------*/
Route::post('/remember', ['before' => 'auth', 'uses' => 'BookmarkController@postRemember'] );

Route::post('/remove', ['before' => 'auth', 'uses' => 'BookmarkController@postRemove'] );

/*----------------------------------------------------------------------
* 	Add user's ratings
*----------------------------------------------------------------------*/
Route::post('/rate', ['before' => 'auth', 'uses' => 'RateController@postRate'] );



/* 
*  Debugging route
*/
Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>environment.php</h1>';
    $path   = base_path().'/environment.php';

    try {
        $contents = 'Contents: '.File::getRequire($path);
        $exists = 'Yes';
    }
    catch (Exception $e) {
        $exists = 'No. Defaulting to `production`';
        $contents = '';
    }

    echo "Checking for: ".$path.'<br>';
    echo 'Exists: '.$exists.'<br>';
    echo $contents;
    echo '<br>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(Config::get('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    print_r(Config::get('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    } 
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});

Route::get('seed',function(){
			// Import data for Albums table
		DB::connection()->getpdo()->exec('LOAD DATA INFILE "C:/MAMP/htdocs/p4/metalData/MAAlbums.csv" INTO TABLE albums FIELDS TERMINATED BY ";;" LINES TERMINATED BY "\r\n"');
		DB::table('albums')->where('album_id', '=', 0)
			->update(array('album_id'=>1));

		// Import data for Bands table
		DB::connection()->getpdo()->exec('LOAD DATA INFILE "C:/MAMP/htdocs/p4/metalData/MABands.csv" INTO TABLE bands FIELDS TERMINATED BY ";;;" LINES TERMINATED BY "\r\n"');
		DB::table('bands')->where('band_id', '=', 0)
			->update(array('band_id'=>1));

		// Import data for Countries table
		DB::connection()->getpdo()->exec('LOAD DATA INFILE "C:/MAMP/htdocs/p4/metalData/countries.csv" INTO TABLE countries FIELDS TERMINATED BY "," LINES TERMINATED BY "\r\n"');

		// Import data for Labels table
		DB::connection()->getpdo()->exec('LOAD DATA INFILE "C:/MAMP/htdocs/p4/metalData/labels.csv" INTO TABLE labels FIELDS TERMINATED BY "," LINES TERMINATED BY "\r\n"');

		// Import data for Reviews table
		DB::connection()->getpdo()->exec('LOAD DATA INFILE "C:/MAMP/htdocs/p4/metalData/MAReviews.csv" INTO TABLE reviews FIELDS TERMINATED BY "," LINES TERMINATED BY "\r\n"');

		// Import data for Similar Bands table
		DB::connection()->getpdo()->exec('LOAD DATA INFILE "C:/MAMP/htdocs/p4/metalData/MASimilarArtists.csv" INTO TABLE similar_bands FIELDS TERMINATED BY "," LINES TERMINATED BY "\r\n"');
	
});