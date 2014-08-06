<div class="suggested_for_user">
<h3>Suggested for you</h3>

<?php

// We want to look at their latest ratings, but not too many
$count = 0;

foreach($ratings as $rating){
	if($count < 3){
		// We'll only base suggestions off of albums they liked
		if ($rating->rating >= 70){
			echo "<h4>Because you liked ".$rating->album_title." ...</h4>";
			// Use the Similar Artists table to list similar bands...
			$similar_bands = DB::table('similar_bands')
				->join('bands', 'bands.band_id', '=', 'similar_bands.band_2')
				->select('score','band_id','band_name','genre','country')
				->where('band_1', $rating->band_id)
				->where('score','>',0)
				->orderBy('score','desc')
				->take(10)
				->get();
			foreach($similar_bands as $band){
				echo "<a href='/band?id=$band->band_id'>".$band->band_name."</a>". " (".$band->country.", ".$band->genre.")<br>";
			}
		}
		// Find other reviews of this album that are within close range of this user's review and then find a couple albums that those reviewers loved

		$count++;
	}
}

?>
<div class="suggested_for_user">