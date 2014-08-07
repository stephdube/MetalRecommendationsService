@extends('_master')

@section('content')

<table class="album_list">
	<tr><th colspan=2><?php echo $album->album_title ?> by <?= $album->band_name ?></th>
	</tr>
	<tr class="band_info_col">
		<td>Type:</td><td><?=$album->release_type ?></td>
	</tr>
	<tr class="band_info_col">	
		<td>Country:</td><td><?=$album->country ?></td>
	</tr>
	<tr class="band_info_col">	
		<td>Date:</td><td><?=$album->release_date ?></td>
	</tr>
	<tr class="band_info_col">	
		<td>Label:</td><td><?=$album->label ?></td>
	</tr>
	<tr class="band_info_col">
		<td>Genre:</td><td><?=$album->genre ?></td>
	</tr>
	<tr class="band_info_col">
		<td>Average rating:</td>
		<td><meter style="font-size:larger" value="<?=$album->avg_rating ?>" min="0" max="100"><?=$album->avg_rating ?></meter><br>
			<?php if ($album->review_count > 0):?>
				(<?php echo round($album->avg_rating) ?>% avg from <?=$album->review_count;?> review<?php 
					if ($album->review_count > 1):?>s<?php endif;?>)
			<?php else:?>
				(0 reviews)
			<?php endif;?>
		</td>
	</tr>
<?php if ($album->review_count > 0):?>
	<tr class="rating_stats_col">
		<td>Distribution of ratings</td>
		<td>
			<?php if ($album->review_count > 0):?>
				@include('album_stats')
			<?php endif;?>
		</td>
	</tr>
<?php endif;?>
	<tr>
		<td></td>
		<td>
			<?php if (!empty($this_bookmark)): ?>
				<form method="POST" action="/remove">
					<input type="hidden" name="remove" value="<?= $album->album_id ?>">
					<input type="submit" value="Remove from bookmarks">
				</form>
			<?php else:?>
				<form method="POST" action="/remember">
					<input type="hidden" name="remember[]" value="<?= $album->album_id ?>">
					<input type="submit" value="Bookmark">
				</form>
			<?php endif;?>
		</td>
	</tr>
	<tr>
		<td></td>
		<td class="rating_stats_col">
			See more from <a href="/band?id=<?=$album->band_id?>"><br>
			<?= $album->band_name ?></a>
		<td>
	</tr>
	<tr>
		<td></td>
		<td colspan=2 class="rating_stats_col">
			<form method="POST" action="/rate">
				@include('rate_form')
				<input type="hidden" name="album" value="<?=$album->album_id?>">
				<?php if(!empty($this_rating)): ?>
					<input type="hidden" name="prev_rating" value="<?=$this_rating->rating?>">
				<?php else: ?>
					<input type="hidden" name="prev_rating" value="none">
				<?php endif; ?>
				<input type="submit" value="Submit">
			</form>
		</td>
	</tr>
</table>

	
@stop