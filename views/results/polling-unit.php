<?php
/* @var $this yii\web\View */
	use yii\helpers\Html;
	use app\models\Lga;
    use app\models\AnnouncedPuResults;
    use app\models\States;
    use app\models\Ward;
	use app\models\PollingUnit;

	// use yii\widgets\LinkPager;
?>

<div class="container">

<h2 class="page-header">
    Polling Units Results
    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->role =='admin') : ?>
           
        <a href="new_pu" class="btn btn-primary pull-right">New</a>

    <?php endif; ?>
</h2>


<p>Please Select an LGA below to View Corresponding Election Result</p>

<!-- Selecting State -->
<label for="state_id">State</label>
<?= Html::dropDownList('state_id',$selection = null, States::find()
                    ->select(['state_name', 'state_id'])
                    ->orderBy('state_name')
                    ->indexBy('state_id')
                    ->column(), [
                        'prompt'=>'Select State',
                        'onchange'=>'
                            $.post("'.Yii::$app->urlManager->createUrl('/results/list-lga-by-state?id=').'"+$(this).val(), function(data){
                            $("select[name=lga_id]").html(data);
                        });'

                    ], ['class'=>'form-control'])?>

<!-- Selecting LGA -->
<label for="lga_id">Local Government Area</label>
<?= Html::dropDownList('lga_id',$selection = null, Lga::find()
                    ->select(['lga_name', 'lga_id'])
                    ->indexBy('lga_id')
                    ->column(), [
                        'prompt'=>'Select Local Government Area',
                        'onchange'=>'
                            $.post("'.Yii::$app->urlManager->createUrl('/results/list-polling-unit-uid-by-lga?id=').'"+$(this).val(), function(data){
                            $("select[name=uniqueid]").html(data);
                        });'
                    ], ['class'=>'form-control'])?>

<!-- Selecting Polling Unit -->
<label for="uniqueid">Polling Unit</label>
<?= Html::dropDownList('uniqueid',$selection = null, PollingUnit::find()
                    ->select(['polling_unit_name', 'uniqueid'])
                    ->indexBy('uniqueid')
                    ->column(), [
                        'prompt'=>'Select Local Government Area',
                        'onchange'=>'
                            $.post("'.Yii::$app->urlManager->createUrl('/results/list-result-by-polling-unit-uid?id=').'"+$(this).val(), function(data){
                            $("div.results").html(data);
                        });'
                    ], ['class'=>'form-control'])?>





</div>

<div class="container results"></div>