<ul id="suggestions"><h2>Suggested for you</h2></ul>

<?php

// We want to look at their latest ratings, but not too many
$count = 0;

foreach($ratings as $rating){
	if($count < 3){
		// We'll only base suggestions off of albums they liked
		if ($rating->rating >= 70){
			// Use the Similar Artists table to list similar bands...
			$similar_bands = DB::table('similar_bands')
				->join('bands', 'bands.band_id', '=', 'similar_bands.band_2')
				->join('albums', 'albums.band_id', '=', 'bands.band_id')
				->join('reviews', 'reviews.album_id', '=', 'albums.album_id')
				->select('score', 'album_title', 'albums.album_id', 'albums.band_id','band_name','genre','country', DB::raw('AVG(rating) as avg_rating'))
				->where('band_1', $rating->band_id)
				->where('score','>',1)
				->orderBy('avg_rating', 'desc')
				->groupBy('bands.band_id')
				->take(10)
				->get();

			if(!empty($similar_bands))
			{
				echo "<ul><h4>Because you liked ".$rating->album_title."</h4>";
				foreach($similar_bands as $band){
					echo  "<li><a href='/album?id=$band->album_id?>'>". $band->album_title . "</a> by "."<a href='/band?id=$band->band_id'>".$band->band_name."</a>". " (".$band->country.", ".$band->genre.")</li>";
				}
				echo "</ul>";
			}

		}

		$count++;
	}
}

?>
</ul>