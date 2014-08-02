@extends('_master')

@section('content')
<!--Display search form-->

<form method="POST" action="/search">

Title: <input type="text" name="album_name">
	<input type="checkbox" name="exact_album_title">Exact match?<br>

Band: <input type="text" name="band_name">
	<input type="checkbox" name="exact_band_name">Exact match?<br>

Genre: <input type="text" name="genre"><br>

Country: <select name="country">
		<option value="">Any country</option>
		<?php foreach($countries as $country):?>
		<option value="<?php echo $country->country?>">
			<?php echo $country->country?></option>
		<?php endforeach;?> 
	</select><br>

Release Type: <select name="release_type">
		<option value="">Any type</option>
		<?php foreach($release_types as $release_type):?>
		<option value="<?php echo $release_type->release_type?>">
			<?php echo $release_type->release_type?></option>
		<?php endforeach;?> 
	</select><br>

Label: <select name="label">
		<option value="">Any label</option>
		<?php foreach($labels as $label):?>
		<option value='<?php echo $label->label?>'>
			<?php echo $label->label?></option>
		<?php endforeach;?> 
	</select> 
	Other: <input type="text" name="unlisted_label">
	<input type="checkbox" name="no_label" value="N/A">Indie<br><br>

Order results by: <ul>
	<li>Average rating <input type="radio" name="order_by" value="avg_rating"></li>
	<li>Number of ratings<input type="radio" name="order_by" value="review_count"></li>
	<li>Alphabetically by album title <input type="radio" name="order_by" value="album_title"></li>
	<li>Alphabetically by band name <input type="radio" name="order_by" value="band_name"></li>
</ul>

Show releases with <select name="reviews">
	<?php for($i=0; $i<21; $i++):?>
		<option value='<?php echo $i; ?>'><?php echo $i; ?></option>
	<?php endfor; ?>
</select>or more ratings<br><br>


<input type="submit" value="Search"></br>
</form>


<?php

if(!empty($albums)){
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
}
?>

@stop