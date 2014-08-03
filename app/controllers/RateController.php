<?php

class RateController extends BaseController {

	public function postRemember() {

		$albums_to_remember = Input::get('remember');

		foreach ($albums_to_remember as $album_id)
		{
			$bookmark = new Bookmark();

			$bookmark->user_id = Auth::id();
			$bookmark->album_id = $album_id;

			$bookmark->save();

		}

		echo Pre::render($albums_to_remember);

		echo "user id: " . Auth::id();



	}
}