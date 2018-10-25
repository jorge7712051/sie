<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Pastores;
use yii\helpers\ArrayHelper;
use kartik\widgets\DatePicker;
use kartik\number\NumberControl;
use kartik\widgets\FileInput;
use app\models\CentroCostos;
use kartik\daterange\DateRangePicker;
use app\models\Pais;
use app\models\Area;
use kartik\select2\Select2;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\DiezmoPastores */
/* @var $form yii\widgets\ActiveForm */
/*
echo DateRangePicker::widget([
    'model'=>$model,
    'attribute'=>'rango_fechas',
    'convertFormat'=>true,    
    'pluginOptions'=>[
        'locale'=>[
            'format'=>'Y-m'
        ]
    ]
]);*/
?>
<?php $form = ActiveForm::begin([
            'method' => 'post',           
            'id' => 'formulario-informe',                     
            'enableAjaxValidation' => true,
]); ?>
<div class="row">
    <div class="col-xs-12 col-lg-6 "> 
    <?= $form->field($model, 'fecha_inicio')->widget(DatePicker::classname(), [
                'options' => ['autocomplete'=>"off",'placeholder' => 'Digite la fecha del comprobante'],
                                'pluginOptions' => [
                                'autoclose'=>true,
                                'startView'=>'year',
                                'minViewMode'=>'months',
                                'format' => 'yyyy-mm'                               
                                                    ]
    ]);?> 
    </div>
    <div class="col-xs-12 col-lg-6 ">
        <?= $form->field($model, 'fecha_fin')->widget(DatePicker::classname(), [
                'options' => ['autocomplete'=>"off",'placeholder' => 'Digite la fecha del comprobante'],
                                'pluginOptions' => [
                                'autoclose'=>true,
                                'startView'=>'year',
                                'minViewMode'=>'months',
                                'format' => 'yyyy-mm'
                                ]
        ]);?>        
    </div>
</div>
<div class="row">    
    <div class="col-xs-12 col-lg-3 ">
        <?= $form->field($model, 'idpais')->dropDownList(ArrayHelper::map(Pais::find()->where('idanulo=0')->all(),'id','nombre'))  ?> 
    </div>
    <div class="col-xs-12 col-lg-3 ">
         <?= $form->field($model, 'iddepartamento')->widget(Select2::classname(), [
                'language' => 'es',
                'data' => [],
                'options' => ['placeholder' => 'Selecione un departamento', 'multiple' => true],
                'pluginEvents' =>[
                'change' => 'function() {  var ids=$(this).val();
                                        var ides="";
                                        ids.forEach( function(valor, indice, array) {
                                        ides =valor+"a"+ides;
                                        });
                    $.get( "'.Url::toRoute('/ciudades/ciudad').'", { id: ides } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($model, 'idciudad').'" ).html( data );
                            }
                        ); }',
                ],               
                'pluginOptions' => [
                                    'tags' => true,
                                    'tokenSeparators' => [',', ' '],
                                    'maximumInputLength' => 10
                ],
    ])?>
    </div>
    <div class="col-xs-12 col-lg-3 ">
        <?= $form->field($model, 'idciudad')->widget(Select2::classname(), [
                'language' => 'es',
                'data' => [],
                'options' => ['placeholder' => 'Selecione una ciudad', 'multiple' => true],
                'pluginEvents' =>[
                'change' => 'function() {  var ids=$(this).val();
                                        var ides="";
                                        ids.forEach( function(valor, indice, array) {
                                        ides =valor+"a"+ides;
                                        });
                    $.get( "'.Url::toRoute('/centro-costos/centrocosto').'", { id: ides } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($model, 'centro_costos').'" ).html( data );
                            }
                        ); }',
                ],               
                'pluginOptions' => [
                                    'tags' => true,
                                    'tokenSeparators' => [',', ' '],
                                    'maximumInputLength' => 10
                ],
    ])?>  
    </div>
    <div class="col-xs-12 col-lg-3 ">
        <?= $form->field($model, 'centro_costos')->widget(Select2::classname(), [
                'language' => 'es',
                'data' => [],
                'options' => ['placeholder' => 'Selecione una ciudad', 'multiple' => true],
                'pluginOptions' => [
                                    'tags' => true,
                                    'tokenSeparators' => [',', ' '],
                                    'maximumInputLength' => 10
                ],
    ])?>  
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-lg-6 ">
    <?php $data = ArrayHelper::map(Area::find()->where(['idanulo'=>'0'])->asArray()->all(),'idarea', 'nombre'); ?>     
    <?= $form->field($model, 'idarea')->widget(Select2::classname(), [
                'language' => 'es',
                'data' => $data,
                'options' => ['placeholder' => 'Selecione area', 'multiple' => true],
                'pluginEvents' =>[
                'change' => 'function() {  var ids=$(this).val();
                                        var ides="";
                                        ids.forEach( function(valor, indice, array) {
                                        ides =valor+"a"+ides;
                                        });
                    $.get( "'.Url::toRoute('/centro-area/carea').'", { id: ides } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($model, 'centro_area').'" ).html( data );
                            }
                        ); }',
                ],
                'pluginOptions' => [
                                    'tags' => true,
                                    'tokenSeparators' => [',', ' '],
                                    'maximumInputLength' => 10
                ],
    ])?>
    </div>
    <div class="col-xs-12 col-lg-6 ">
    
    <?= $form->field($model, 'centro_area')->widget(Select2::classname(), [
                'language' => 'es',
                'data' => [],
                'options' => ['placeholder' => 'Selecione un Centro de costos', 'multiple' => true],
                               
                'pluginOptions' => [
                                    'tags' => true,
                                    'tokenSeparators' => [',', ' '],
                                    'maximumInputLength' => 10
                ],
    ])?>

  
    </div>
</div>
  
        <div class="form-group">
            <?= Html::submitButton('Exportar', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>



<div> <?= $contenido  ?></div>

