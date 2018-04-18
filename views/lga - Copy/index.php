<?php
/* @var $this yii\web\View */
	use yii\helpers\Html;

	use yii\widgets\LinkPager;
?>
<h2 class="page-header">All Available LGAs</h2>

<?php if($lgas) : ?>

	<ul class="list-group">

		<?php foreach($lgas as $lga) : ?>

			<li class="list-group-item">

				<?=$lga->lga_name?> : <?=$lga->lga_description?>
				 

			</li>

		<?php endforeach; ?>

	</ul>
<?php else: ?>
	Not available
<?php endif; ?>

<?= LinkPager::widget(['pagination'=>$pagination]) ?>