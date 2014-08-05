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
			<?php 
				// check if User has rated this album
				$this_rating = DB::table('ratings')
					->where('user_id', Auth::id())
					->where('album_id', $album->album_id)->get();
			?>
				<?php if (!empty($this_rating)):?>
					<?php for($i=0; $i < ($this_rating[0]->rating/10); $i++):?>
						<span class="user_rated">★</span>
					<?php endfor?>
					<?php for($j=0; $j < (10 - ($this_rating[0]->rating/10)); $j++):?>
						<span class="user_unrated">★</span>
					<?endfor?>
				<?php else:?>
					@include('rate_form')
					<a href="/album?id=<?=$album->album_id?>"><button type="button">Rate</button></a>
				<?php endif;?>
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