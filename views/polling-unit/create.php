<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Lga;
use app\models\Ward;


/* @var $this yii\web\View */
/* @var $model app\models\AnnouncedPuResults */
/* @var $form ActiveForm */
?>
<div class="polling-unit-create_i">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'polling_unit_uniqueid') ?>
        <?= $form->field($model, 'party_abbreviation') ?>
        <?= $form->field($model, 'party_score') ?>
        <?= $form->field($model, 'entered_by_user') ?>
        <?= $form->field($model, 'date_entered') ?>
        <?= $form->field($model, 'user_ip_address') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- polling-unit-create_i -->

