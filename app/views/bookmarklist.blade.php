<ul id="bookmarks"><h4>My Bookmarks</h4>
	<?php // Get all user's bookmarks
		$bookmarks = DB::table('albums')
			->join('bookmarks', 'bookmarks.album_id', '=', 'albums.album_id')
			->join('bands', 'bands.band_id', '=', 'albums.band_id')
			->where('user_id', Auth::id())->get();
	?>

	<?php // Display bookmarks
		foreach($bookmarks as $bookmark): ?>

		<li>
			<a href="/album?id=<?php echo $bookmark->album_id?>"><i>
				<?php echo $bookmark->album_title ?></i></a> 
				by <?php echo $bookmark->band_name ?> 
				(<?php echo $bookmark->release_date ?>, 
				<?php echo $bookmark->label ?>) <br>
		</li><br>
	<?php endforeach ?>

	<?php if(empty($bookmarks)): ?>
		You have not bookmarked any albums for review.
	<?php endif; ?>

</ul>
