<?php
/* @var $this yii\web\View */
	use yii\helpers\Html;
	use app\models\AnnouncedPuResults;

?>
<h2 class="page-header">Polling Units Results</h2>

<?php if($pu_uniqueids) : ?>
	
			<?php foreach($pu_uniqueids as $pu_uniqueid) : ?>

				<?php

				$results = AnnouncedPuResults::find()
							->where(['polling_unit_uniqueid'=>$pu_uniqueid])
							->all();

				?>

			<?php endforeach; ?>	
			<?php $total = 0; ?>
			<?php if($results) : ?>
				<table class="table table-header table-bordered table-striped">
						<thead>
							<th>Polling Unit Name</th>
							<th>Polling Unit Ward</th>
							<th>Polling Unit Lga</th>
							<th>Party Name</th>
							<th>Party Score</th>
						</thead>
						<tbody>
						<?php foreach($results as $result) : ?>

							<tr>
								<td><?=$result->polling_unit->polling_unit_name; ?></td>
								<td><?=$result->polling_unit->ward->ward_name; ?></td>
								<td><?=$result->polling_unit->lga->lga_name; ?></td>
								<td><?=$result->party_abbreviation; ?></td>
								<td><?=$result->party_score; ?></td>
							</tr>

						<?php $total += $result->party_score; ?>

						<?php endforeach; ?>

						<tr>
							<td colspan="4"><strong class="text-center">Total</strong></td>
							<td><strong><?=$total?></strong></td>
						</tr>

						
					</tbody>
				</table>
			<?php else: ?>
				No Result available For This LGA.
			<?php endif; ?>
			
<?php else: ?>
	No Result available For This LGA.
<?php endif; ?>
