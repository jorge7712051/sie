<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use kartik\widgets\DatePicker;
use kartik\number\NumberControl;
use kartik\widgets\FileInput;
use app\models\CentroCostos;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\ComprobanteEgreso */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="row">       
    <div class="comprobante-egreso-form">
      
    <?php $form = ActiveForm::begin([
       'method'=>'post',
       'id'=>'formulario-comprobante-egreso',
       'enableClientValidation'=>true,        
    ]); ?>

    <div class="col-xs-12 col-lg-6 ">
    <?= $form->field($model, 'idcomprobante',['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'autocomplete'=>"off",'disabled'=>true]) ?>  

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
    </div>
    <div class="col-xs-12 col-lg-6 ">
        <?php    
        $session = Yii::$app->session;
        if ($session->isActive){
        if($session->get('rol')==1){ ?>
        <?= $form->field($model, 'idcentrocostos')->dropDownList(ArrayHelper::map(CentroCostos::find()->where('idanulo=0')->all(), 'idcentrocostos', 'centrocostos'),array( 'prompt'=>'Seleccione...')); ?> <?php  
        } 
        else{ ?>
         <?= $form->field($model, 'idcentrocostos')->dropDownList(ArrayHelper::map(CentroCostos::find()->where(['idcentrocostos'=>$session->get('centrocostos')])->all(), 'idcentrocostos', 'centrocostos')); ?>
        <?php }} ?>
   
        <?= $form->field($model, 'valor')->widget(NumberControl::classname(), [
                        'displayOptions' => [
                                            'autocomplete'=>"off"
                                            ],
                        'maskedInputOptions' => [
                                                'prefix' => '$',
                                                'allowMinus' => false,
                                                'min' => 0,
                                                ],    
        ]);?>

        <?= $form->field($model, 'fecha',['enableAjaxValidation' => true])->widget(DatePicker::classname(), [
                'options' => ['autocomplete'=>"off",'placeholder' => 'Digite la fecha del comprobante'],
                'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'yyyy-mm-dd',
                                'startDate'=>'yyyy-mm-1',
                                'endDate'=>'yyyy-mm-31',
                                    ]
        ]);?>
       
    
        <?= $form->field($model, 'anulado')->checkbox(array('label'=>'anular') );?>

        <div class="form-group">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
</div>
