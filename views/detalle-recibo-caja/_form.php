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
use app\models\TipoIngreso;
use app\models\Terceros;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\DetalleReciboCaja */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detalle-recibo-caja-form">

    <?php $form = ActiveForm::begin(['method'=>'post',
       'id'=>'formulario-recibo-caja-detalle',
       'enableClientValidation'=>true,

       ]); ?>
<div class="col-xs-12 col-lg-6 ">
    <?= $form->field($model, 'cedulatercero')->widget(Typeahead::classname(), [
    'name' => 'terceros',
    'options' => ['placeholder' => 'Digite la identificacion ...','autocomplete'=>"off"],
    'scrollable' => true,
    'pluginOptions' => ['highlight'=>true,'minLength' => 2,'hint'=>false],
    'pluginEvents'=> ['keyup' => 'function() { format(this);}',
                       'typeahead:close' => 'function() { format(this);}',
                    ],
    'dataset' => [
       [
        'display' => 'identificacion',
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

     <?= $form->field($model, 'nombre')->textInput(['readonly'=> true]); ?>

    <?= $form->field($model, 'idtercero')->hiddenInput(['readonly'=> true])->label(false); ?>

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
 </div>
 <div class="col-xs-12 col-lg-6 ">
     <?= $form->field($model, 'idtipoingreso')->dropDownList(ArrayHelper::map(TipoIngreso::find()->where('idanulo=0')->all(), 'idtipo_ingreso', 'ingreso'),array( 'prompt'=>'Seleccione...')); ?>

     <?= $form->field($model, 'doble')->hiddenInput()->label(false); ?>
     
     <?= $form->field($model, 'contraparte')->radioList(array('1'=>'Bancos','2'=>'Caja')); ?>

    

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
         <?= Html::button('Crear Tercero', ['value' => Url::to(['terceros/create','id'=>1]), 'title' => 'Crear Tercer', 'class' => 'showModalButton btn btn-success']); ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>

</div>
