@extends('_master')

@section('content')

<form method="POST" action="/remember">

<table class="album_list">
	<caption><h2>Your search results</h2></caption>
	<tr>
		<th>Release details</th>
		<th>Rating Distribution</th>
		<th>Average rating</th>
		<th>Bookmark</th>
	</tr>
<?php foreach ($albums as $album): ?>
	<tr>
		<td colspan=4>
			<a href='/album?id=<?php echo $album->album_id?>'>
				<h3><?php echo $album->album_title ?></h3></a>
		</td>
	</tr>
	<tr>
		<td class="band_info_col">
			Band: <b><?php echo $album->band_name ?></b><br><br>
			Genre: <b><?php echo $album->genre ?></b><br><br>
			Release Type: <b><?php echo $album->release_type ?></b><br><br>
			Country: <b><?php echo $album->country ?></b><br><br>
			Released: <b><?php echo $album->release_date ?></b><br><br>
			Label: <b><?php echo $album->label ?></b><br><br>
		</td>

		<td class="rating_stats_col">
			<?php if ($album->review_count > 0):?>
				@include('album_stats')
			<?php endif;?>
		</td>

		<td>
			<meter style="font-size:larger" value="<?=$album->avg_rating ?>" min="0" max="100"><?=$album->avg_rating ?></meter><br>
			<?php if ($album->review_count > 0):?>
				(<?php echo round($album->avg_rating) ?>% avg from <?=$album->review_count;?> review<?php 
					if ($album->review_count > 1):?>s<?php endif;?>)
			<?php else:?>
				(0 reviews)
			<?php endif;?>
		</td>

		<td>
			Add <input type="checkbox" name="remember[]" value="<?php echo $album->album_id ?>">
		</td>
	</tr>
<?php endforeach; ?>

	<tr>
		<td colspan="3"></td>
		<td>
			@if(Auth::check())
				<input type="submit" value="Add to bookmarks"><br>
			@else 
				<i>Make an account<br> to remember albums<br> you're interested in!</i>
			@endif
		</td>
	</tr>
</form>

</table>
@stop