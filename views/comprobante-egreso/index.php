<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\CentroCostos;
use kartik\daterange\DateRangePicker;
use kartik\widgets\DatePicker;
use kartik\export\ExportMenu;


/* @var $this yii\web\View */
/* @var $searchModel app\models\ComprobanteEgresoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comprobante Egresos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comprobante-egreso-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<div  class="row">
  <div class="col-md-6">
    <div class="fondo">
    <h4 class="text-center">Comprobante egreso banco</h4>
<?php
    $gridColumns = [
    
    'idcomprobante',
    'idiglesia',
    'idtercero',
    'valor_total',
    'idconcepto',
    'area',
    'centrocosto',
    'subtotal',
    'total',
   
];

// Renders a export dropdown menu
echo ExportMenu::widget([
    'dataProvider' => $dataProviderBanco,
    'columns' => $gridColumns
]);
?>

<?= GridView::widget([
        'dataProvider' => $dataProviderBanco,
        'tableOptions' => [ 'id' => 'tablainformes'],
        'filterModel' => $searchModel,
        'columns' => [           
            [
                'attribute' => 'fecha_informe',
                'value' => function ($model) {
                return $model->fecha_informe;                
                },  
                'headerOptions' => 
                                [
                                    'class' => 'col-md-2'
                                ],            
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'fecha_informe', 
                    'pluginOptions' => [
                            'startView'=>'year',
                            'minViewMode'=>'months',
                            'format' => 'yyyy-mm'
                    ]          
                ])                    
            ]
        ],
    ]); ?>
</div>
</div>
<div class="col-md-6">
     <div class="fondo">
         <h4 class="text-center">Comprobante egreso caja</h4>
<?php
    $gridColumns = [
    
    'idcomprobante',
    'idiglesia',
    'idtercero',
    'valor_total',
    'idconcepto',
    'area',
    'centrocosto',
    'subtotal',
    'total',
   
];

// Renders a export dropdown menu
echo ExportMenu::widget([
    'dataProvider' => $dataProviderBanco,
    'columns' => $gridColumns
]);
?>

<?= GridView::widget([
        'dataProvider' => $dataProviderBanco,
        'tableOptions' => [ 'id' => 'tablainformes'],
        'filterModel' => $searchModel,
        'columns' => [           
            [
                'attribute' => 'fecha_informe',
                'value' => function ($model) {
                return $model->fecha_informe;                
                },  
                'headerOptions' => 
                                [
                                    'class' => 'col-md-2'
                                ],            
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'fecha_informe', 
                    'pluginOptions' => [
                            'startView'=>'year',
                            'minViewMode'=>'months',
                            'format' => 'yyyy-mm'
                    ]          
                ])                    
            ]
        ],
    ]); ?>
</div>
 </div>
</div>  
<br>
    <p>
        <?= Html::a('Crear Comprobante Egreso', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'tableOptions' => [ 'class' => 'table table-sm table-hover table-bordered table-striped'],
        
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'idcomprobante',
            [
            // the attribute
            'attribute' => 'fecha',
            // format the value
            'value' => function ($model) {
                return $model->fecha;
                
            },
            // some styling? 
            'headerOptions' => [
                'class' => 'col-md-2'
            ],
            // here we render the widget
            'filter' => DateRangePicker::widget([
                'model' => $searchModel,
                'attribute' => 'fecha',
                'pluginOptions' => [
                       'locale' => [ 'format' => 'YYYY-MM-DD' ]
                            ]
            ])
        ],
         
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
            [
                'attribute'=>'alta',
                'value'=>function($model){
                     if ($model->alta==0) {
                       return 'Sin aceptar';
                    }
                    return 'Aceptado';
                },
                 'filter'=>array("1"=>"Acpetado","0"=>"Sin Aceptar"),
            ],
            [
                'attribute'=>'anulado',
                'value'=>function($model){
                     if ($model->anulado==0) {
                       return 'Sin Anular';
                    }
                    return 'Anulado';
                },
                 'filter'=>array("1"=>"Anulado","0"=>"Sin Anular"),
            ],

              array(
                'attribute'=>'adjunto',
                'contentOptions' => ['class' => 'celda-adjunto'],
                'format' => 'raw',
                'value'=>function($model){
          return Html::a(Html::img($model->getImagenDocumento(), ['alt'=>'archivos','width'=>'50px']) , $model->getImageurl(),['target'=>'_blank'] );
     }
            

),
            //'idcentrocostos',
            //'adjunto',
            //'idanulo',
            //'codigo',

            [   'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
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
                    if($a==$hoy && $url->bloqueo==0)
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
                    if($a==$hoy && $url->bloqueo==0)
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
