<?php 
		$rating_categories = array($album->rat10, $album->rat20, $album->rat30, $album->rat40, $album->rat50, $album->rat60, $album->rat70, $album->rat80, $album->rat90, $album->rat100);
	?>

<table class="chart">
	<?php for($j=sizeof($rating_categories) - 1; $j >= 0; $j--): ?>
	<tr>
		<td><?php if($j!=0){
			echo ($j*10+1);
		}
		else echo $j;
			?> - <?=($j*10+10)?></td>
		<?php for($i = 1; $i <= $rating_categories[$j]; $i++):?>
			<td class="bar"></td>
		<?php endfor ?>
	</tr>
	<?php endfor; ?>
</table>
<i>Category | Number of ratings</i>