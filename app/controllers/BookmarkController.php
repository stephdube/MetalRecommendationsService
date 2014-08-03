<?php

class RateController extends BaseController {

	public function postRemember() {

		$albums_to_remember = Input::get('remember');

		$flash_message = '';

		foreach ($albums_to_remember as $album_id)
		{
			$album = DB::table('albums')->select('album_title')
					->where('album_id', $album_id)->get();

			$title = $album[0]->album_title;

			try{
				DB::table('bookmarks')->insert(array('user_id' => Auth::id(), 'album_id' => $album_id));

				$flash_message .= $title . " added to list!<br>";
			}
			// An exception will be thrown if user tries to add duplicates primary key to the table
			catch(Exception $e)
			{
				$flash_message .= $title . " is already in your bookmarks!<br>";
			}
		};
		
		return Redirect::to('/')
			->with('flash_message', $flash_message);
	}
}