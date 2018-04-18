<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
// use yii\base\BaseObject;

use app\models\Lga;
use app\models\Ward;
use app\models\PollingUnit;
use app\models\Party;
use app\models\States;


/* @var $this yii\web\View */
/* @var $new_result app\models\AnnouncedPuResults */
/* @var $form ActiveForm */
?>

<h2 class="page-header">New Polling Unit Result</h2>

<?php if(Yii::$app->session->hasFlash('success')) : ?>
    <div class="alert alert-success"><?=Yii::$app->session->getFlash('success')?></div>
<?php endif; ?>

<div class="polling-unit-new">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->errorSummary($new_result) ?>

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

    <label for="lga_id">LGA Name</label>
        <?= Html::dropDownList('lga_id', $selection = null, Lga::find()
                    ->select(['lga_name', 'lga_id'])
                    ->indexBy('lga_id')
                    ->column(), [
                        'prompt'=>'Select Local Government Area',
                        'onchange'=>'
                            $.post("'.Yii::$app->urlManager->createUrl('/results/ward-by-lga?id=').'"+$(this).val(), function(data){
                            $("select[name=ward_id]").html(data);
                        });'
                    ], ['class'=>'form-control'])?>
        <label for="ward_id">Ward Name</label>
        <?= Html::dropDownList('ward_id', $selection = null, Ward::find()
                    ->select(['ward_name', 'ward_id'])
                    ->indexBy('ward_id')
                    ->column(), [
                        'prompt'=>'Select Ward',
                        'onchange'=>'
                            $.post("'.Yii::$app->urlManager->createUrl('/results/pu-by-ward?id=').'"+$(this).val(), function(data){
                            $("select#announcedpuresults-polling_unit").html(data);
                        });'
                    ], ['class'=>'form-control'])?>

       <!--  <label for="pulling_unit_id">Polling Unit</label> -->
        <?= $form->field($new_result, 'polling_unit')
                    ->dropDownList(PollingUnit::find()
                    ->select(['polling_unit_name', 'polling_unit_id'])
                    ->indexBy('polling_unit_id')
                    ->column(), [
                        'prompt'=>'Select Polling Unit',
                        'onchange'=>'
                            $.post("'.Yii::$app->urlManager->createUrl('/results/party-by-pu-uid?id=').'"+$(this).val(), function(data){
                            $("select#announcedpuresults-party_abbreviation").html(data);
                        });'
                    ], ['class'=>'form-control'])?>

 
        <?= $form->field($new_result, 'party_abbreviation')
            ->dropDownList(Party::find()
            ->select(['partyname', 'partyid'])
            ->indexBy('partyid')
            ->column(), ['prompt'=>'Select Party']);
            ?>
        <?= $form->field($new_result, 'party_score') ?>
        <?= $form->field($new_result, 'entered_by_user') ?>
        <?= $form->field($new_result, 'date_entered')->input('datetime-local') ?>
        <?= $form->field($new_result, 'user_ip_address')->textInput(['value'=>getenv('REMOTE_ADDR'), 'disabled'=>'disabled']) ?>


    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- polling-unit-create_i -->
<?php 
// echo $form->field($model, 'lga_id')->dropDownList(
//                                     Lga::find()
//                                     ->select(['lga_name','lga_id'])
//                                     ->indexBy('lga_id')
//                                     ->column(),
//                                     ['prompt'=>'Select LGA']
//                                         )   

                ?>