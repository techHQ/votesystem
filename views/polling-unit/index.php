<?php

	use yii\helpers\Html;
	use yii\widgets\Linkpager;

?>

<h2 class="page-header">
	Available Polling Units
	<a href="index.php?r=polling-unit/create" class="btn btn-primary pull-right">New</a>
</h2>


<?php if($polling_units) : ?>
	<table class="table table-header table-bordered table-striped">
		<thead>
			<th>Polling Unit Name</th>
			<th>Polling Unit Ward</th>
			<th>Polling Unit Lga</th>
		</thead>
		<tbody>
			<?php foreach($polling_units as $polling_unit) : ?>
				<tr>
					<td><?=$polling_unit->polling_unit_name?></td>
					<td><?=$polling_unit->ward->ward_name?></td>
					<td><?=$polling_unit->lga->lga_name?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php else: ?>
	Not available
<?php endif; ?>

<?= LinkPager::widget(['pagination'=>$pagination]) ?>