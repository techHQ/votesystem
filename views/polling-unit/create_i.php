<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Lga;
use app\models\Ward;

/* @var $this yii\web\View */
/* @var $model app\models\PollingUnit */
/* @var $form ActiveForm */
?>

<h2 class="page-header">Enter Polling Unit Result</h2>

<div class="polling-unit-create">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'lga_id')->dropDownList(
                                    Lga::find()
                                    ->select(['lga_name','lga_id'])
                                    ->indexBy('lga_id')
                                    ->column(),
                                    ['prompt'=>'Select LGA']
                )   ?>
        <?= $form->field($model, 'ward_id') ?>
        <?= $form->field($model, 'polling_unit_id') ?>
        <?= $form->field($model, 'uniquewardid') ?>
        <?= $form->field($model, 'polling_unit_description') ?>
        <?= $form->field($model, 'date_entered') ?>
        <?= $form->field($model, 'polling_unit_number') ?>
        <?= $form->field($model, 'polling_unit_name') ?>
        <?= $form->field($model, 'entered_by_user') ?>
        <?= $form->field($model, 'user_ip_address') ?>
        <?= $form->field($model, 'lat') ?>
        <?= $form->field($model, 'long') ?>
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- polling-unit-create -->