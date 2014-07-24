@extends('_master')

@section('content')
<?php

echo "<a href='/search'>Search again?</a><br>";

if ($order_by == 'avg_rating' || $order_by == 'review_count')
{ 	// If sorting by ratings, put highest at top
	$direction = 'desc';
} 
else 
{	// If sorting alphabetically, put beginning of alphabet at top
	$direction = 'asc';
}

// If not looking for an exact match on album name, edit album query string
$album = (($albums_compare=='LIKE') ? "%".$album."%" : $album);
// If not looking for an exact match on band name, edit band query string
$band = (($bands_compare=='LIKE') ? "%".$band."%" : $band);
// If not looking for an exact match on genre, edit genre query string
$genre = (($genres_compare=='LIKE') ? "%".$genre."%" : $genre);

// Query for albums that match user's search input along with relevant album-data
$albums = DB::table('albums')
	->join('bands', 'bands.band_id', '=', 'albums.band_id') // get band info for album
	->leftJoin('reviews', 'reviews.album_id', '=', 'albums.album_id') // get review info for album
	->select('albums.album_id', 'albums.album_title', 'bands.band_name', 'bands.genre', 'albums.release_type', 'bands.country', 'albums.release_date', 'albums.label', DB::raw('AVG(rating) as avg_rating'), DB::raw('count(rating) as review_count'), 
	// Aggregate data about reviews... This divides possible scores into buckets and counts how many reviews an album has in each bucket, to give a better idea of how the album has been received than a simple average would give.
		DB::raw('count(CASE WHEN rating <= 10 THEN 1 ELSE null END) as rat10'),
		DB::raw('count(CASE WHEN 10 < rating AND rating <= 20 THEN 1 END) as rat20'),
		DB::raw('count(CASE WHEN 20 < rating AND rating <= 30 THEN 1 END) as rat30'),
		DB::raw('count(CASE WHEN 30 < rating AND rating <= 40 THEN 1 END) as rat40'),
		DB::raw('count(CASE WHEN 40 < rating AND rating <= 50 THEN 1 END) as rat50'),
		DB::raw('count(CASE WHEN 50 < rating AND rating <= 60 THEN 1 END) as rat60'),
		DB::raw('count(CASE WHEN 60 < rating AND rating <= 70 THEN 1 END) as rat70'),
		DB::raw('count(CASE WHEN 70 < rating AND rating <= 80 THEN 1 END) as rat80'),
		DB::raw('count(CASE WHEN 80 < rating AND rating <= 90 THEN 1 END) as rat90'),
		DB::raw('count(CASE WHEN 90 < rating THEN 1 END) as rat100'))
	// Filter albums user's search queries
	->where(function($query) use ($album, $albums_compare, $band, $bands_compare, $genre, $genres_compare, $release_type, $country)
	{
		if (!empty($album))
		{	// user wants to search by album titles
			$query->where('album_title', $albums_compare, $album);
		}
		if (!empty($band))
		{	// user wants to search by band name
			$query->where('band_name', $bands_compare, $band);
		}
		if (!empty($genre))
		{	// user wants to search by genre
			$query->where('genre', $genres_compare, $genre);
		}
		if (!empty($release_type))
		{	// user wants to search by release type
			$query->where('release_type', "=", $release_type);
		}
		if (!empty($country))
		{	// user wants to search by country
			$query->where('country', "=", $country);
		}
	})
	// Combine data into unique rows based on albums
	->groupBy('albums.album_id', 'albums.album_title', 'bands.band_name', 'bands.genre', 'albums.release_type', 'bands.country', 'albums.release_date', 'albums.label')
	->orderBy($order_by, $direction)
	->get();

	//echo Pre::render($albums);

	echo "<ul>";
	foreach ($albums as $album){
		echo "<li>";
		echo "Album: <a href='/album?id=" . $album->album_id ."'>" . $album->album_title . "</a><br>";
		echo "Band: " . $album->band_name . "<br>";
		echo "Genre: " . $album->genre . "<br>";
		echo "Release Type: " . $album->release_type . "<br>";
		echo "Country: " . $album->country . "<br>";
		echo "Released: " . $album->release_date . "<br>";
		echo "Label: " . $album->label . "<br>";
		echo "Average rating of this album: " . $album->avg_rating . "<br>";
		echo "Number of ratings: " . $album->review_count . "<br>";
		echo "</li><br><br>";
	}
	echo "</ul>";


?>
@stop