<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\number\NumberControl;
use kartik\widgets\FileInput;
use kartik\widgets\Typeahead;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use app\models\Concepto;
use app\models\Terceros;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $model app\models\DetallesComprobanteEgreso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detalles-comprobante-egreso-form">

    <?php $form = ActiveForm::begin(['method'=>'post',
       'id'=>'formulario-comprobante-egreso-detalle',
       'enableClientValidation'=>true,

       ]); 
    ?>

 <div class="col-xs-12 col-lg-6 ">
    <?= $form->field($model, 'cedulatercero')->widget(Typeahead::classname(), [
    'name' => 'terceros',
    'options' => ['placeholder' => 'Digite la identificacion ...','autocomplete'=>"off"],
    'scrollable' => true,
    'pluginOptions' => ['highlight'=>true,'minLength' => 2,'hint'=>false],
    'dataset' => [
       [
        'display' => 'resultado',
        'remote' => [
                        'url' => Url::to(['terceros/terceros-list']) . '?q=%QUERY',
                        'wildcard' => '%QUERY',
                    ],
        'templates' => [
                        'empty' => '<div class="text-danger" style="padding:0 8px">Sin resultados.</div>',
                    ]
        ]
    ]
    ]); ?>
    <?= $form->field($model, 'idtercero')->hiddenInput(['readonly'=> true])->label(false); ?>

    <?= $form->field($model, 'porcentaje')->hiddenInput(['readonly'=> true])->label(false); ?>

    <?= $form->field($model, 'piso')->hiddenInput(['readonly'=> true])->label(false); ?>

    <?= $form->field($model, 'doble')->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'nombre')->textInput(['readonly'=> true]); ?>

    <?= $form->field($model, 'adjobligatorio')->hiddenInput(['readonly'=> true])->label(false); ?>

    <?= $form->field($model, 'idconcepto')->dropDownList(ArrayHelper::map(Concepto::find()->where('idanulo=0')->all(), 'idconcepto', 'concepto'),array( 'prompt'=>'Seleccione...')); ?>

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
    <?= $form->field($model, 'subtotal')->widget(NumberControl::classname(), [
                                'displayOptions' =>  [
                                                'autocomplete'=>"off",
                                                'readonly'=> true

                                                    ],
                                'maskedInputOptions' => [
                                                'prefix' => '$',
                                                'allowMinus' => false,
                                                'min' => 0,
                                            ],    
          ]);?>
    <?= $form->field($model, 'total')->widget(NumberControl::classname(), [
                                'displayOptions' =>  [
                                                'autocomplete'=>"off",
                                                'readonly'=> true

                                                    ],
                                'maskedInputOptions' => [
                                                'prefix' => '$',
                                                'allowMinus' => false,
                                                'min' => 0,
                                            ],    
          ]);?>

    
</div>
 <div class="col-xs-12 col-lg-6 ">
 <?php $carga= '<embed class="kv-preview-data file-preview-pdf" src="'.Url::home(true).$model->adjunto.'" style="width:100%;height:160px;">'; ?>
    <?= $form->field($model, 'comprobante',['enableAjaxValidation' => true])->widget(FileInput::classname(), [
                                'options' => ['accept' => 'image/*,application/pdf'],
                                'pluginOptions' => [
                                        'showUpload' => false,
                                        'initialPreview'=>[ $carga,],
                                        'overwriteInitial'=>true,
                                        'accept' => 'image/*'
                                        ],
                                ]); ?>  

     <?= $form->field($model, 'contraparte')->radioList(array('1'=>'Bancos','2'=>'Caja')); ?>
    
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        <?= Html::button('Crear Tercero', ['value' => Url::to(['terceros/create','id'=>1]), 'title' => 'Crear Tercer', 'class' => 'showModalButton btn btn-success']); ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>
  
</div>
