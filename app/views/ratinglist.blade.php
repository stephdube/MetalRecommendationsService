<div class="user_rating_list">
<ul id="ratings"><h4>My Ratings</h4>
	<?php // Get all user's ratings
		$ratings = DB::table('albums')
			->join('ratings', 'ratings.album_id', '=', 'albums.album_id')
			->join('bands', 'bands.band_id', '=', 'albums.band_id')
			->where('user_id', Auth::id())
			->orderBy('review_date', 'desc')->get();
	?>

	<?php if(empty($ratings)): ?>
		You have not rated any albums for review.
	
	<?php else: ?>
		<?php foreach($ratings as $rating): ?>
		<li>
			<a href="/album?id=<?php echo $rating->album_id?>"><i>
				<?php echo $rating->album_title ?></i></a> 
				by <?php echo $rating->band_name ?> 
				(<?php echo $rating->release_date ?>, 
				<?php echo $rating->label ?>) <br>
			Your rating:<br>
			<?php for($i=0; $i < ($rating->rating/10); $i++):?>
                <span class="user_rated">★</span>
            <?php endfor?>
            <?php for($j=0; $j < (10 - ($rating->rating/10)); $j++):?>
               <span class="user_unrated">★</span>
            <?php endfor?>
        <br><br>
        </li>
		<?php endforeach ?>
<div><!-- end user-rating-list section-->
		{{-- If the user has submitted ratings, display suggestions for more --}}
		@include('suggestions')
	<?php endif; ?>