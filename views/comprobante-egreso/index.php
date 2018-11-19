<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\CentroCostos;
use kartik\daterange\DateRangePicker;
use kartik\widgets\DatePicker;


/* @var $this yii\web\View */
/* @var $searchModel app\models\ComprobanteEgresoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comprobante Egresos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comprobante-egreso-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
                'template' => '{view} {update} ',
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
                ],
            ],
           
        ],
    ]); ?>
</div>
