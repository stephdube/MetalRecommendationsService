@extends('_master')

@section('content')
<form method="POST" action="/search" id="search_form">
<table id="search">
<tr>
	<td>Title:</td>
	<td><input type="text" name="album_name"><br>
	<input type="checkbox" name="exact_album_title">Exact match?</td>
</tr>
<tr>
	<td>Band:</td>
	<td><input type="text" name="band_name"><br>
	<input type="checkbox" name="exact_band_name">Exact match?</td>
</tr>
<tr>
	<td>Genre:</td>
	<td?<input type="text" name="genre"></td>
</tr>
<tr>
	<td>Country:</td>
	<td> <select name="country">
			<option value="">Any country</option>
			<?php foreach($countries as $country):?>
			<option value="<?php echo $country->country?>">
				<?php echo $country->country?></option>
			<?php endforeach;?> 
		</select>
	</td>
</tr>
<tr>
	<td>Release Type:</td> 
	<td><select name="release_type">
		<option value="">Any type</option>
		<?php foreach($release_types as $release_type):?>
		<option value="<?php echo $release_type->release_type?>">
			<?php echo $release_type->release_type?></option>
		<?php endforeach;?> 
	</select>
	</td>
</tr>
<tr>
	<td>Label:</td>
	<td><select name="label">
		<option value="">Any label</option>
		<?php foreach($labels as $label):?>
		<option value='<?php echo $label->label?>'>
			<?php echo $label->label?></option>
		<?php endforeach;?> 
	</select> <br>
	Other: <input type="text" name="unlisted_label"><br>
	<input type="checkbox" name="no_label" value="N/A">Indie</td>
</tr>
<tr>
	<td>Order results by:</td>
	<td><ul>
	<li>Average rating <input type="radio" name="order_by" value="avg_rating"></li>
	<li>Number of ratings<input type="radio" name="order_by" value="review_count"></li>
	<li>Alphabetically by album title <input type="radio" name="order_by" value="album_title"></li>
	<li>Alphabetically by band name <input type="radio" name="order_by" value="band_name"></li>
	</ul></td>
</tr>
<tr>
	<td>Show releases with</td>
	<td><select name="reviews">
		<?php for($i=0; $i<21; $i++):?>
			<option value='<?php echo $i; ?>'><?php echo $i; ?></option>
		<?php endfor; ?>
		</select>or more ratings</td>
</tr>
</table>

<!--input type="hidden" name="band_id" value=""-->

<input type="submit" value="Search"></br>
</form>


@stop