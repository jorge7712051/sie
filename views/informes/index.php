<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Pastores;
use yii\helpers\ArrayHelper;
use kartik\widgets\DatePicker;
use kartik\number\NumberControl;
use kartik\widgets\FileInput;
use app\models\CentroCostos;


/* @var $this yii\web\View */
/* @var $model app\models\DiezmoPastores */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
<div class="informe-mensual-form">

    <?php $form = ActiveForm::begin([
            'method' => 'post',
            'action' => '/informes/create',
            'id' => 'formulario-informe-mensual',                     
            'enableAjaxValidation' => true,
]); ?>
    <div class="col-xs-12 col-lg-4 ">
    <?= $form->field($model, 'fecha')->widget(DatePicker::classname(), [
                'options' => ['autocomplete'=>"off",'placeholder' => 'Digite la fecha del comprobante'],
                                'pluginOptions' => [
                                'autoclose'=>true,
                                'startView'=>'year',
                                'minViewMode'=>'months',
                                'format' => 'yyyy-mm'
                               
                                                    ]
    ]);?>      
    </div>
    <div class="col-xs-12 col-lg-4 ">
     <?php    $session = Yii::$app->session;
    if ($session->isActive){
      if($session->get('rol')==1)
        { ?>
          <?= $form->field($model, 'centro_costos')->dropDownList(ArrayHelper::map(CentroCostos::find()->where('idanulo=0')->all(), 'idcentrocostos', 'centrocostos'),array( 'prompt'=>'Seleccione...')); ?> <?php  
        } 
      else{ ?>
         <?= $form->field($model, 'centro_costos')->dropDownList(ArrayHelper::map(CentroCostos::find()->where(['idcentrocostos'=>$session->get('centrocostos')])->all(), 'idcentrocostos', 'centrocostos')); ?>
        <?php }} ?>   
            

    </div>
    <div class="col-xs-12 col-lg-12 ">
        <div class="form-group">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>


</div>
</div>


<style type="text/css">
    h3,h5{ text-align: center; }

    .decoracion{ text-decoration: underline;       
    }
    h5{    background: #cce5ff;
    padding: 5px;}
    .col-xs-4 {
    width: 33.33333333%;
}
.col-xs-1, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9, .col-xs-10, .col-xs-11, .col-xs-12 {
    float: left;
}
.centro
{
    text-align: center;
}
.col-xs-8 {
    width: 66.66666667%;
}
</style>