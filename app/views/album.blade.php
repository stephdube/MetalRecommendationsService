@extends('_master')

@section('content')

	Release title: <?php echo $album->album_title ?><br>
	Band: <?php echo $album->band_name ?> <br>
	Genre: <?php echo $album->genre ?> <br>
	Release type: <?php echo $album->release_type ?> <br>
	Country: <?php echo $album->country ?><br>
	Release date: <?php echo $album->release_date ?><br>
	Label: <?php echo $album->label ?> <br>

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

<?php if (!empty($this_rating)): ?>
	Your gave this album a rating of <?php echo $this_rating->rating; ?>/100.<br>
	Change your vote?<br><br>
<?php endif; ?>

	<form method="POST" action="/rate">
	<fieldset class="rating">
    <legend>Please rate:</legend>
    <input type="radio" id="star10" name="rating" value="100" /><label for="star10">10 stars</label>
    <input type="radio" id="star9" name="rating" value="90" /><label for="star9">9 stars</label>
    <input type="radio" id="star8" name="rating" value="80" /><label for="star8">8 stars</label>
    <input type="radio" id="star7" name="rating" value="70" /><label for="star7">7 stars</label>
    <input type="radio" id="star6" name="rating" value="60" /><label for="star6">6 stars</label>
    <input type="radio" id="star5" name="rating" value="50" /><label for="star5">5 stars</label>
    <input type="radio" id="star4" name="rating" value="40" /><label for="star4">4 stars</label>
    <input type="radio" id="star3" name="rating" value="30" /><label for="star3">3 stars</label>
    <input type="radio" id="star2" name="rating" value="20" /><label for="star2">2 stars</label>
    <input type="radio" id="star1" name="rating" value="10" /><label for="star1">1 star</label>
</fieldset><br>
<input type="hidden" name="album" value="<?=$album->album_id?>">
<?php if(!empty($this_rating)): ?>
	<input type="hidden" name="prev_rating" value="<?=$this_rating->rating?>">
<?php else: ?>
	<input type="hidden" name="prev_rating" value="none">
<?php endif; ?>
<input type="submit" value="Rate">
</form>

@stop