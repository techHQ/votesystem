<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\linkPager;
?>
<h2 class="page-header">Polling Unit Details</h2>
<?php if(null !== yii::$app->session->getFlash('success')) : ?>
     <div class="alert alert-success"><?php echo yii::$app->session->getFlash('success'); ?></div>
<?php endif; ?>
<ul class="list-group">
 <?php foreach($models as $model) :?>
 	<!-- &category=<?php //echo $cat->id ;?> -->
     <li class="list-group-item"><strong>Name:</strong> <?php echo $model->polling_unit_name ;?></li>
     <li class="list-group-item"><strong>Description:</strong> <?php echo $model->polling_unit_description ;?></li>
     <li class="list-group-item"><strong>Unit Officer:</strong> <?php echo $model->polling_unit_user ;?></li>
     <li class="list-group-item"><strong>Total Votes:</strong>  </li>
 <?php endforeach ;?>
</ul>

<?= linkPager::widget(['pagination'=>$pagination]) ; ?>