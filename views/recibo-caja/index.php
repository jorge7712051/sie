<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\CentroCostos;
use kartik\daterange\DateRangePicker;
use kartik\widgets\DatePicker;
use kartik\export\ExportMenu;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $searchModel app\models\ReciboCajaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Recibo Caja';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recibo-caja-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <br>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<?php  $session = Yii::$app->session;

// comprueba si una sesión está ya abierta
if ($session->isActive){
 ?>
<div  class="row">
<div class="col-md-6">
     <div class="fondo">
         <h4 class="text-center">Recibo Caja banco</h4>

<?= GridView::widget([
        'dataProvider' => $dataProviderBanco,
        'tableOptions' => [ 'id' => 'tablainformes'],
        'filterModel' => $searchModel,
        'columns' => [           
            [
                'attribute' => 'fecha_banco',
                'value' => function ($model) {
                return $model->fecha_banco;                
                },  
                'headerOptions' => 
                                [
                                    'class' => 'col-md-2'
                                ],            
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'fecha_banco', 
                    'pluginOptions' => [
                            'startView'=>'year',
                            'minViewMode'=>'months',
                            'format' => 'yyyy-mm'
                    ]          
                ])                    
            ]
        ],
    ]); ?>
<br>

<?php
    $gridColumnsbanco = [    
    'fecha_banco',
    'codigo',
    'idrecibo',
    'idiglesia',
    'idtercero',  
    'valor_total',
    'concepto',
    'idtipoingreso',
    'contraparte',
    'id_anterior' ,
   
];

// Renders a export dropdown menu
echo ExportMenu::widget([
    'dataProvider' => $dataProviderBanco,
    'columns' => $gridColumnsbanco,
    'filename' => 'Recibo caja banco',
    'dropdownOptions' => [
        'label' => 'Exportar Caja',
        'class' => 'btn btn-secondary'
    ]
]);
?>


</div>
 </div>
<div class="col-md-6">
     <div class="fondo">
         <h4 class="text-center">Recibo Caja caja</h4>

<?= GridView::widget([
        'dataProvider' => $dataProviderCaja,
        'tableOptions' => [ 'id' => 'tablainformes'],
        'filterModel' => $searchModel,
        'columns' => [           
            [
                'attribute' => 'fecha_caja',
                'value' => function ($model) {
                return $model->fecha_caja;                
                },  
                'headerOptions' => 
                                [
                                    'class' => 'col-md-2'
                                ],            
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'fecha_caja', 
                    'pluginOptions' => [
                            'startView'=>'year',
                            'minViewMode'=>'months',
                            'format' => 'yyyy-mm'
                    ]          
                ])                    
            ]
        ],
    ]); ?>
<br>

<?php
    $gridColumnscaja = [    
    'fecha_caja',
    'codigo',
    'idrecibo',
    'idiglesia',
    'idtercero',  
    'valor_total',
    'concepto',
    'idtipoingreso',
    'contraparte',
     'id_anterior' ,
   
];

// Renders a export dropdown menu
echo ExportMenu::widget([
    'dataProvider' => $dataProviderCaja,
    'columns' => $gridColumnscaja,
    'filename' => 'Comprobante egreso caja',
    'dropdownOptions' => [
        'label' => 'Exportar Caja',
        'class' => 'btn btn-secondary'
    ]
]);
?>


</div>
 </div>
</div>  
<br>
<div class="row">
<?php $form = ActiveForm::begin([
            'method' => 'post',
            'action' => 'desbloqueo',          
            'id' => 'formulario-informe-mensual',                     
            'enableAjaxValidation' => true,
]); ?>
 <div class="col-xs-12 col-md-3 ">
<?= $form->field($model, 'fecha')->widget(DatePicker::classname(), [
                'options' => ['autocomplete'=>"off",'placeholder' => 'Digite la fecha del recibo'],
                                'pluginOptions' => [
                                'autoclose'=>true,
                                'startView'=>'year',
                                'minViewMode'=>'months',
                                'format' => 'yyyy-mm'
                               
                                                    ]
    ]);?>    
</div>
 <div class="col-xs-12 col-md-3 ">
<?= $form->field($model, 'bloqueo')->dropDownList(
            ['0' => 'DESBLOQUEAR', '1' => 'BLOQUEAR',]
    );?> 
</div>

 <div class="col-xs-12 col-md-3 ">
 <?= $form->field($model, 'idcentrocostos')->dropDownList(ArrayHelper::map(CentroCostos::find()->where('idanulo=0')->all(), 'idcentrocostos', 'centrocostos'),array( 'prompt'=>'Seleccione...')); ?>
</div>

 <div class="col-xs-12 col-md-3 ">
        <div class="form-group">
            <br>
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        </div>
    </div>  

<?php ActiveForm::end(); ?>
</div>
<?php } ?>
    <p>
        <?= Html::a('Crear Recibo Caja', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'tableOptions' => [ 'class' => 'table table-sm table-hover table-bordered table-striped'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'idrecibo',
            [
                // the attribute
                'attribute' => 'fecha',
                'value' => function ($model) {
                    return $model->fecha;
                },
                'headerOptions' => [
                    'class' => 'col-md-2'
                ],
                'filter' => DateRangePicker::widget([
                'model' => $searchModel,
                'attribute' => 'fecha',
                'pluginOptions' => [
                       'locale' => [ 'format' => 'YYYY-MM-DD' ]
                            ]
            ])
            ],
            'concepto',         
            [
                'attribute'=>'idcentrocostos',
                'value'=>function($model){
                    $centrocosto = CentroCostos::findOne($model->idcentrocostos);
                    return $centrocosto->centrocostos;
                },
                'filter'=> ArrayHelper::map(CentroCostos::find()->all(),'idcentrocostos','centrocostos'),
            ],            
            [
                'attribute'=>'valor',
                'value'=>function($model){  
                        Yii::$app->formatter->locale = 'et-EE';                 
                    return Yii::$app->formatter->asCurrency($model->valor,'USD'); 
                }              
            ],
            [
                'attribute'=>'bloqueo',
                'value'=>function($model){
                    if ($model->bloqueo==0) {
                       return 'Sin Bloqueo';
                    }
                    return 'Bloqueado';
                },
                 'filter'=>array("1"=>"Bloqueado","0"=>"Sin BLouqeo"),
            ],
            
            array(
                'attribute'=>'adjunto',
                'contentOptions' => ['class' => 'celda-adjunto'],
                'format' => 'raw',
                'value'=>function($model){
                    return Html::a(Html::img($model->getImagenDocumento(), ['alt'=>'archivos','width'=>'50px']) , $model->getImageurl(),['target'=>'_blank'] );
                }),
            //'idanulo',
            //'codigo',

            [   'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}{delete} ',
                'visibleButtons' => [
                'update' => function ($url, $model, $key) {
                    $session = Yii::$app->session;
                    if($session->get('rol')==1)
                    {
                        return true;
                    }
                    $hoy = date("Y-m");
                    $fecha1=explode("-", $url->fecha);
                    $a =$fecha1[0]."-".$fecha1[1];   
                    if($url->bloqueo==0)
                    {
                         return true;
                    }
                    return false;
                    },
                'delete' => function ($url, $model, $key) {
                    $session = Yii::$app->session;
                    if($session->get('rol')==1)
                    {
                        return true;
                    }
                    $hoy = date("Y-m");
                    $fecha1=explode("-", $url->fecha);
                    $a =$fecha1[0]."-".$fecha1[1];   
                    if($url->bloqueo==0)
                    {
                         return true;
                    }
                    return false;
                    },
                ],
            ],
        ],
    ]); ?>
</div>
