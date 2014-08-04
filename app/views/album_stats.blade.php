<?php 
		$rating_categories = array($album->rat10, $album->rat20, $album->rat30, $album->rat40, $album->rat50, $album->rat60, $album->rat70, $album->rat80, $album->rat90, $album->rat100);
	?>

	<table>
		<tr><th>Rating Category</th><th colspan="<?php echo max($rating_categories)?>">Number of ratings</th></tr>
		<?php for($j=sizeof($rating_categories) - 1; $j >= 0; $j--): ?>
			<tr>
				<td><?php echo ($j*10+1)?> - <?php echo ($j*10+10)?></td>
				<?php for($i = 1; $i <= $rating_categories[$j]; $i++):?>
					<td class="bar"></td>
				<?php endfor ?>
			</tr>
		<?php endfor; ?>
	</table>