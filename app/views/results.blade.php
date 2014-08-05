@extends('_master')

@section('content')

@include('login_prompter')

@if(Auth::check())
<form method="POST" action="/remember">
@endif
<table id="album_list">
	<caption><h2>Your search results</h2></caption>
	<tr>
		<th>Release details</th>
		<th>Rating Distribution</th>
		<th>Average rating</th>
		<th>Number of ratings</th>
	@if(Auth::check())
		<th>My rating</th>
		<th>Remember for later</th>
	@endif
	</tr>
<?php foreach ($albums as $album): ?>
	<tr>
		<td class="band_info_col">
			Album: <a href='/album?id=<?php echo $album->album_id?>'>
				<?php echo $album->album_title ?></a><br>
			Band: <?php echo $album->band_name ?> <br>
			Genre: <?php echo $album->genre ?> <br>
			Release Type: <?php echo $album->release_type ?> <br>
			Country: <?php echo $album->country ?><br>
			Released: <?php echo $album->release_date ?><br>
			Label: <?php echo $album->label ?> <br>
		</td>

		<td class="rating_stats_col">
			@include('album_stats')
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
			<?php for($i = 0; $i<=100; $i+=10): ?>
				<span><a href="/rate?id=<?=$album->album_id?>">☆</a></span>
			<?php endfor; ?>
			</div>
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