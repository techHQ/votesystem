<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\linkPager;
?>
<h2 class="page-header">Local Government<a href="index.php?r=ward/create" class="btn btn-primary pull-right">Add More LGA</a></h2>
<?php if(null !== yii::$app->session->getFlash('success')) : ?>
     <div class="alert alert-success"><?php echo yii::$app->session->getFlash('success'); ?></div>
<?php endif; ?>
<ul class="list-group">
 <?php foreach($lgas as $lga) :?>
 	<!-- &category=<?php //echo $cat->id ;?> -->
     <li class="list-group-item"><a href="index.php?r=lga/info&id=<?php echo $lga->lga_id ;?> "> <?php echo $lga->lga_name ;?></a></li>
 <?php endforeach ;?>
</ul>

<?= linkPager::widget(['pagination'=>$pagination]) ; ?>