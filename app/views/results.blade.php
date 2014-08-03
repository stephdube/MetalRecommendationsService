@extends('_master')

@section('content')
<h4>Your search results:</h4>

@if(Auth::check())
<form method="POST" action="/remember">
@endif
<table id="album_list">
	<tr>
		<th>Release details</th>
		<th>Distribution (??)</th>
		<th>Average rating</th>
		<th>Number of ratings</th>
	@if(Auth::check())
		<th>My rating</th>
		<th>Remember for later</th>
	@endif
	</tr>
<?php foreach ($albums as $album): ?>
	<tr>
		<td class="first_row">
			Album: <?php echo $album->album_title ?><br>
			Band: <?php echo $album->band_name ?> <br>
			Genre: <?php echo $album->genre ?> <br>
			Release Type: <?php echo $album->release_type ?> <br>
			Country: <?php echo $album->country ?><br>
			Released: <?php echo $album->release_date ?><br>
			Label: <?php echo $album->label ?> <br>
		</td>

		<td>
			0-10: <?php echo $album->rat10 ?> <br>
			10-20: <?php echo $album->rat20 ?> <br>
			20-30: <?php echo $album->rat30 ?> <br>
			30-40: <?php echo $album->rat40 ?> <br>
			40-50: <?php echo $album->rat50 ?> <br>
			50-60: <?php echo $album->rat60 ?> <br>
			60-70: <?php echo $album->rat70 ?> <br>
			70-80: <?php echo $album->rat80 ?> <br>
			80-90: <?php echo $album->rat90 ?> <br>
			90-100: <?php echo $album->rat100 ?> <br>
		</td>

		<td>
			<?php echo $album->avg_rating ?>
		</td>

		<td>
			<?php echo $album->review_count ?>
		</td>

	@if(Auth::check())
		<td>
			<div class="rating">
			<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
			</div>
			<select name="rate_<?php echo $album->album_id ?>">
				<?php for($i = 1; $i<=10; $i++): ?>
					<option value='<?php echo $i; ?>'><?php echo $i; ?></option>
				<?php endfor; ?>
			</select>
		</td>

		<td>
			Add <input type="checkbox" name="remember[]" value="<?php echo $album->album_id ?>">
		</td>
	@endif
	</tr>
<?php endforeach; ?>

@if(Auth::check())
	<tr>
	<td colspan="5"></td>
	<td><input type="submit" value="Remember these"></br></td>
	</tr>
</form>
@endif
</table>
@stop