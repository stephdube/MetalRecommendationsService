<?php

class BookmarkController extends BaseController {

	public function postRemember() {

		$albums_to_remember = Input::get('remember');

		$flash_message = '';

		// add all the albums checked off to user's bookmark list if possible
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

	public function postRemove() {

		$album_to_remove = Input::get('remove');

		$album = DB::table('albums')->select('album_title')
					->where('album_id', $album_to_remove)->get();

		$title = $album[0]->album_title;

		// surround with try/catch just in case user hits refresh before they are redirected
		try {
			DB::table('bookmarks')
				->where('album_id', $album_to_remove)
				->where('user_id', Auth::id())
				->delete();
		} catch(Exception $e){
			return Redirect::to('/')
			->with('flash_message', "Something went wrong");
		}

		$flash_message = $title . " has been removed from your bookmarks";

		return Redirect::to('/')
			->with('flash_message', $flash_message);
	}
}