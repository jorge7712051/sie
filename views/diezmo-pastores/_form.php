<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Pastores;
use yii\helpers\ArrayHelper;
use kartik\widgets\DatePicker;
use kartik\number\NumberControl;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\DiezmoPastores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="diezmo-pastores-form">

    <?php $form = ActiveForm::begin([
            'method' => 'post',
            'id' => 'formulario-dismo-pastores',
            'enableAjaxValidation' => true,
]); ?>

    <?= $form->field($model, 'valor')->widget(NumberControl::classname(), [
                                'displayOptions' =>  [
                                                'autocomplete'=>"off"
                                                    ],
                                'maskedInputOptions' => [
                                                'prefix' => '$',
                                                'allowMinus' => false,
                                                'min' => 0,
                                            ],    
          ]);?>

    <?= $form->field($model, 'fecha')->widget(DatePicker::classname(), [
                'options' => ['autocomplete'=>"off",'placeholder' => 'Digite la fecha del comprobante'],
                                'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'yyyy-mm-dd',
                                'startDate'=>'yyyy-mm-1',
                                'endDate'=>'yyyy-mm-30',
                                                    ]
    ]);?>

    <?php    $session = Yii::$app->session;
    if ($session->isActive){
        if($session->get('rol')==1)
            { ?>
            <?= $form->field($model, 'idpastor')->dropDownList(ArrayHelper::map(Pastores::find()->where('idanulo=0')->all(), 'cedula', 'nombre'),array( 'prompt'=>'Seleccione...')); ?> <?php  
            } 
        else{ ?>
            <?= $form->field($model, 'idpastor')->dropDownList(ArrayHelper::map(Pastores::find()->where(['centro_costo'=>$session->get('centrocostos')])->all(), 'cedula', 'nombre')); ?>
            <?php }
        } ?>


    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
