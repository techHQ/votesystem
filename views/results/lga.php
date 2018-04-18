<?php
?>

<?php
/* @var $this yii\web\View */
    use yii\helpers\Html;
    use app\models\Lga;
    use app\models\AnnouncedPuResults;
    use app\models\States;

?>

<div class="container">

<h2 class="page-header">LGAs Results</h2>

<p>Please Select A State below to View Corresponding LGA Election Result</p>

<label for="state_name">State</label>

<?= Html::dropDownList('state',$selection = null, States::find()
                    ->orderBy('state_name')
                    ->select(['state_name', 'state_id'])
                    ->indexBy('state_id')
                    ->column(), [
                        'prompt'=>'Select State',
                        'onchange'=>'
                            $.post("'.Yii::$app->urlManager->createUrl('/results/list-lga-by-state?id=').'"+$(this).val(), function(data){
                            $("select[name=lga_id]").html(data);
                        });'
                    ], ['class'=>'form-control'])?>

<label for="lga_id">Local Government Area</label>

<?= Html::dropDownList('lga_id',$selection = null, Lga::find()
                    ->select(['lga_name', 'lga_id'])
                    ->indexBy('lga_id')
                    ->column(), [
                        'prompt'=>'Select Local Government Area',
                        'onchange'=>'
                            $.post("'.Yii::$app->urlManager->createUrl('/results/result-by-lga?id=').'"+$(this).val(), function(data){
                            $("div.results").html(data);
                        });'
                    ], ['class'=>'form-control'])?>





</div>

<div class="container results"></div>