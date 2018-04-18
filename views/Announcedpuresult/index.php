<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\linkPager;
use app\models\Pollingunit;
?>
<h2 class="page-header">Polling Unit Results</h2>
<?php if(null !== yii::$app->session->getFlash('success')) : ?>
     <div class="alert alert-success"><?php echo yii::$app->session->getFlash('success'); ?></div>
<?php endif; ?>
<ul class="list-group">
 <?php foreach($puresults as $puresult) :?>
 	<!-- &category=<?php //echo $cat->id ;?> -->
    <li class="list-group-item"><a href="index.php?r=pollingunit/pollingunitinfo&id=<?php echo $puresult->polling_unit_uniqueid ;?> "> <?php echo  $puresult->party_abbreviation ; ?></a></li>
 <?php endforeach ;?>
</ul>

<?= linkPager::widget(['pagination'=>$pagination]) ; ?>