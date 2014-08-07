@extends('_master')

@section('content')

<div class="album_data">
	Release title: <?php echo $album->album_title ?><br>
	Band: <a href="/band?id=<?=$album->band_id?>">
	<?= $album->band_name ?></a><br>
	Genre: <?=$album->genre ?> <br>
	Release type: <?=$album->release_type ?> <br>
	Country: <?=$album->country ?><br>
	Release date: <?=$album->release_date ?><br>
	Label: <?=$album->label ?> <br>
</div>
<div>
	Average rating: <?php echo $album->avg_rating ?><br>
	Review count: <?php echo $album->review_count ?><br>
</div>

<div class="album_stats">
	@include('album_stats')
</div>

<div class="bookmark_form">
	<?php if (!empty($this_bookmark)): ?>
		<form method="POST" action="/remove">
			Remove this from bookmarks? 
			<input type="hidden" name="remove" value="<?= $album->album_id ?>">
			<input type="submit" value="Remove">
		</form>
	<?php else:?>
		<form method="POST" action="/remember">
			Add this to bookmarks? 
			<input type="hidden" name="remember[]" value="<?= $album->album_id ?>">
			<input type="submit" value="Add">
		</form>
	<?php endif;?>
</div>

<div class="rating_form">
	<form method="POST" action="/rate">
		@include('rate_form')
	<input type="hidden" name="album" value="<?=$album->album_id?>">
	<?php if(!empty($this_rating)): ?>
		<input type="hidden" name="prev_rating" value="<?=$this_rating->rating?>">
	<?php else: ?>
		<input type="hidden" name="prev_rating" value="none">
	<?php endif; ?>
	<input type="submit" value="Rate">
	</form>
</div>

@stop