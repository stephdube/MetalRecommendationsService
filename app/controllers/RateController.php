<?php

class RateController extends BaseController {

	public function postRemember() {

		$albums_to_remember = Input::get('remember');

		foreach ($albums_to_remember as $album_id)
		{
			$insert[] = array(
				'user_id' => Auth::id(),
				'album_id' => $album_id
			);

		}

		try{
			DB::table('bookmarks')->insert($insert);
		}
		catch(Exception $e)
		{
			echo "Whoops, one of those is already in your bookmarks";
		}

		echo Pre::render($albums_to_remember);

		echo Auth::id();



	}
}