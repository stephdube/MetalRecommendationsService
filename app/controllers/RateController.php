<?php

class RateController extends BaseController {

	public function postRemember() {

		$albums_to_remember = Input::get('remember');

		foreach ($albums_to_remember as $album_id)
		{
			$album = DB::table('albums')->select('album_title')
					->where('album_id', $album_id)->get();

			$title = $album[0]->album_title;

			try{
				DB::table('bookmarks')->insert(array('user_id' => Auth::id(), 'album_id' => $album_id));


				echo $title . " added to list!<br>";
			}
			catch(Exception $e)
			{
				echo "Whoops, " . $title . " is already in your bookmarks!<br>";
			}

		}	
	}
}