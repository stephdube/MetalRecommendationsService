@extends('_master')

@section('content')

<div class="album_data">
	Release title: <?php echo $album->album_title ?><br>
	Band: <?php echo $album->band_name ?> <br>
	Genre: <?php echo $album->genre ?> <br>
	Release type: <?php echo $album->release_type ?> <br>
	Country: <?php echo $album->country ?><br>
	Release date: <?php echo $album->release_date ?><br>
	Label: <?php echo $album->label ?> <br>
</div>
<div>
	Average rating: <?php echo $album->avg_rating ?><br>
	Review count: <?php echo $album->review_count ?><br>
</div>
<div class="album_stats">@include('album_stats')</div>

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

<div class="rating_stars">
	@include('rate_form')
</div>


@stop