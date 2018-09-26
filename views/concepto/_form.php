<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\number\NumberControl;

/* @var $this yii\web\View */
/* @var $model app\models\Concepto */
/* @var $form yii\widgets\ActiveForm */
?>
 <div class="row">       
    <div class="concepto-form">
        <div class="col-xs-12 col-lg-6 ">

          <?php $form = ActiveForm::begin(); ?>

          <?= $form->field($model, 'concepto')->textInput() ?>    

          <?= $form->field($model, 'porcentaje')->widget(NumberControl::classname(), [
                          'maskedInputOptions' => [
                                                    'prefix' => '%',
                                                    'allowMinus' => false,
                                                     'min' => 0,
   	                                              ],    
          ]);?> 

          <?= $form->field($model, 'piso')->widget(NumberControl::classname(), [
                          'maskedInputOptions' => [
                                                    'prefix' => '$',
                                                    'allowMinus' => false,
                                                    'min' => 0,
   	                                              ],      
          ]); ?>
          <?= $form->field($model, 'doble')->checkbox(array('label'=>'Habilitación doble') );?>

          <?= $form->field($model, 'adjobligatorio')->checkbox(array('label'=>'No se requiere adjunto') );?>

          <div class="form-group">
                <?= Html::submitButton('Guadar', ['class' => 'btn btn-success']) ?>
          </div>

          <?php ActiveForm::end(); ?>
        </div>
    </div>
  </div>
