<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Ward;
use app\models\Course;
use app\models\Lga;
use yii\helpers\ArrayHelper;
use app\models\Pollingunit;

/* @var $this yii\web\View */
/* @var $model app\models\Pollingunit */
/* @var $form ActiveForm */
?>
<div class="pollingunit-index">




<h2 class="page-header">Check Result</h2>
    <?php $form = ActiveForm::begin(); ?>

          <?= $form->field($pollingunituniqueid, 'lga_id')->dropDownList(ArrayHelper::map(Lga::find()->orderBy('lga_name')->all(),'lga_id','lga_name') ,['prompt'=>'Select Local Government',
        'onchange'=>'$.post("index.php?r=ward/lists&id='.'"+$(this).val(),function(data){
            $("select#pollingunit-ward_id").html(data);
            });

        console.log("it changed");
        console.log($(this).val());
        console.log(data);
        ']);
      ?>


       <?= $form->field($pollingunituniqueid, 'ward_id')->dropDownList(ArrayHelper::map(Ward::find()->orderBy('ward_name'),'ward_id','ward_name') ,['prompt'=>'Select ward',
        'onchange'=>'$.post("index.php?r=pollingunit/lists&id='.'"+$(this).val(),function(data){
            $("select#pollingunit-polling_unit_id").html(data);
            });

        console.log("it changed");
        console.log($(this).val());
        console.log(data);
        ']);
      ?>
       

      

         <?= $form->field($pollingunituniqueid, 'polling_unit_id')->dropDownList(ArrayHelper::map(Pollingunit::find()->orderBy('polling_unit_name'),'polling_unit_id','polling_unit_name') ,['prompt'=>'Select Polling Unit',
           'onchange'=>'$.post("index.php?r=pollingunit/lists&id='.'"+$(this).val(),function(data){
            $("select#election_report-amnounced_pu_result").html(data);
            });

        console.log("it changed");
        console.log($(this).val());
        console.log(data);
        '
            
           
     ]);
      ?>
       
       
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- pollingunit-index -->
<div class="alert alert-success" role="alert" id="election_report">


 </div> 