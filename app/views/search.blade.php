@extends('_master')

@section('content')

<?php

$countries = DB::table('bands')->select('country')
	->groupBy('country')->get();

$labels = DB::table('albums')->select('label', DB::raw('count(*) as count'))
	->where('label', '!=', 'N/A')
	->groupBy('label')->having('count', '>', 50)->get();


	foreach($labels as $label)
	{
		echo $label->label . "," . $label->count . "<br>";
	}

$release_types = DB::table('albums')->select('release_type')
	->groupBy('release_type')->get();
?>

<form method="POST" action="/search">

Title: <input type="text" name="album_name">
	<input type="checkbox" name="exact_album_title">Exact match?<br>

Band: <input type="text" name="band_name">
	<input type="checkbox" name="exact_band_name">Exact match?<br>

Genre: <input type="text" name="genre">
	<input type="checkbox" name="exact_genre">Exact match?<br>

Country: <select name="country">
		<option value="">Any country</option>
		<?php foreach($countries as $country):?>
		<option value="<?php echo $country->country?>">
			<?php echo $country->country?></option>
		<?php endforeach;?> 
	</select><br>

Release Type: <select name="release_type">
		<option value="">Any</option>
		<?php foreach($release_types as $release_type):?>
		<option value="<?php echo $release_type->release_type?>">
			<?php echo $release_type->release_type?></option>
		<?php endforeach;?> 
	</select><br>

Label: <select name="label">
		<option value="">Any</option>
		<?php foreach($labels as $label):?>
		<option value="<?php echo $label->label?>">
			<?php echo $label->label?></option>
		<?php endforeach;?> 
	</select> Other label: <input type="text" name="label">
	<input type="checkbox" name="label">No label<br><br>

Order results by: <ul>
	<li>Average rating <input type="radio" name="order_by" value="avg_rating"></li>
	<li>Number of ratings<input type="radio" name="order_by" value="review_count"></li>
	<li>Alphabetically by album title <input type="radio" name="order_by" value="album_title"></li>
	<li>Alphabetically by band name <input type="radio" name="order_by" value="band_name"></li>
	<br>
<input type="submit" value="Search"></br>
</form>


@stop