<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\linkPager;
?>
<h2 class="page-header">State Government<a href="index.php?r=ward/create" class="btn btn-primary pull-right">Add More State</a></h2>
<?php if(null !== yii::$app->session->getFlash('success')) : ?>
     <div class="alert alert-success"><?php echo yii::$app->session->getFlash('success'); ?></div>
<?php endif; ?>
<ul class="list-group">
 <?php foreach($states as $state) :?>
 	<!-- &category=<?php //echo $cat->id ;?> -->
     <li class="list-group-item"><a href="index.php?r=lga/info&id= "> <?php echo $state->state_name ;?></a></li>
 <?php endforeach ;?>
</ul>

<?= linkPager::widget(['pagination'=>$pagination]) ; ?>