<?php

class AlbumController extends BaseController {

	public function getAlbum() {

		$album_id = Input::get('id');

		$album = DB::table('albums')
			->join('bands', 'bands.band_id', '=', 'albums.band_id') 
			->leftJoin('reviews', 'reviews.album_id', '=', 'albums.album_id') 
			->select('albums.album_id', 'albums.album_title', 'bands.band_name', 'bands.genre', 'albums.release_type', 'bands.country', 'albums.release_date', 'albums.label', DB::raw('AVG(rating) as avg_rating'), DB::raw('count(rating) as review_count'), DB::raw('count(CASE WHEN rating <= 10 THEN 1 ELSE null END) as rat10'),
				DB::raw('count(CASE WHEN 10 < rating AND rating <= 20 THEN 1 END) as rat20'),
				DB::raw('count(CASE WHEN 20 < rating AND rating <= 30 THEN 1 END) as rat30'),
				DB::raw('count(CASE WHEN 30 < rating AND rating <= 40 THEN 1 END) as rat40'),
				DB::raw('count(CASE WHEN 40 < rating AND rating <= 50 THEN 1 END) as rat50'),
				DB::raw('count(CASE WHEN 50 < rating AND rating <= 60 THEN 1 END) as rat60'),
				DB::raw('count(CASE WHEN 60 < rating AND rating <= 70 THEN 1 END) as rat70'),
				DB::raw('count(CASE WHEN 70 < rating AND rating <= 80 THEN 1 END) as rat80'),
				DB::raw('count(CASE WHEN 80 < rating AND rating <= 90 THEN 1 END) as rat90'),
				DB::raw('count(CASE WHEN 90 < rating THEN 1 END) as rat100'))
			->groupBy('albums.album_id', 'albums.album_title', 'bands.band_name', 'bands.genre', 'albums.release_type', 'bands.country', 'albums.release_date', 'albums.label')
			->where('albums.album_id', $album_id)->get();

		if (empty($album)){
			//return Redirect::to('/')
				//->with('flash_message', 'Sorry, no such album');
			echo "idk " . $album_id . " " . Pre::render($album);
		}
		else {
			$album = $album[0];

			$this_bookmark = DB::table('bookmarks')
				->where('user_id', Auth::id())
				->where('album_id', $album->album_id)->get();

			$this_rating = DB::table('ratings')
				->where('user_id', Auth::id())
				->where('album_id', $album->album_id)->get();

			$this_rating = $this_rating[0];

			return View::make('album')
				->with('album', $album)
				->with('this_bookmark', $this_bookmark)
				->with('this_rating', $this_rating);
		}
	}
}