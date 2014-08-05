<?php

class RateController extends BaseController {

	public function postRate() {
		$rating = Input::get('rating');
		$album_id = Input::get('album');
		$prev_rating = Input::get('prev_rating');
		$user = Auth::id();

		echo "rating: " . $rating . " album: " . $album_id . "was rated " 
		. $prev_rating;

		$album = DB::table('albums')->select('album_title')
					->where('album_id', $album_id)->get();

		$title = $album[0]->album_title;
		
		// add initial rating of this album by this user
		if($prev_rating == "none"){
			DB::table('ratings')->insert(array('album_id'=> $album_id, 'user_id' => Auth::id(), 'rating'=>$rating));
		}

		// change this user's rating for this album
		else {
			DB::table('ratings')->where('user_id', Auth::id())
				->where('album_id', $album_id)
				->update(array('rating' => $rating));
		}

		return Redirect::to('/')
			->with('flash_message', 'Thanks for reviewing ' . $title . '!');	
	}
}