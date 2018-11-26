<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\web\View;
use app\models\Terceros;
use app\models\Concepto;
use app\models\ReciboCaja;
use app\models\CentroCostos;
use app\models\TipoIngreso;

/* @var $this yii\web\View */
/* @var $model app\models\ReciboCaja */

$this->title = $model->idrecibo;
$this->params['breadcrumbs'][] = ['label' => 'Recibo Caja', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recibo-caja-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->idrecibo], ['class' => 'btn btn-primary']) ?>
        
       <?= Html::a('Añadir nuevo', ['detalle-recibo-caja/create', 'id' => base64_encode($model->idrecibo)], ['class' => 'btn btn-primary']) ?> 
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idrecibo',
            'fecha',
            //'fecha_creacion',
            'concepto',
            [
                'attribute'=>'valor',
                 'contentOptions' => ['class' => 'valor-comprobante'],               
                'value'=>function($model){  
                Yii::$app->formatter->locale = 'et-EE';                 
                return Yii::$app->formatter->asCurrency($model->valor,'USD'); 
                },
            ],
            [
                'attribute'=>'idcentrocostos',
                'value'=>function($model){
                    $centrocosto = CentroCostos::findOne($model->idcentrocostos);
                    return $centrocosto->centrocostos;
                },                

            ],
            array(
            'attribute'=>'adjunto',
            'format' => 'raw',           
            'value'=>function($model){
          return Html::a(Html::img($model->getImagenDocumento(), ['alt'=>'archivos','width'=>'50px']) , $model->getImageurl(),['target'=>'_blank'] );
            }
            

),

            //'bloqueo',
            //'idcentrocostos',
            //'adjunto',
            //'idanulo',
            //'codigo',
        ],
    ]) ?>

 <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'showFooter'=>TRUE,
        'columns' => [
          ['class' => 'yii\grid\SerialColumn'],
            'idrecibocaja',
            [
                'attribute'=>'idtercero',               
                'value'=>function($model){
                    $tercero = Terceros::findOne($model->idtercero);
                    if($tercero->razon_social!=""){return $tercero->razon_social;}
                    return $tercero->nombre." ".$tercero->apellido;
                }


            ],
             [
                'attribute'=>'valor',
                'footerOptions' => ['class' => 'valor-total'],
               'value'=>function($model){  
                        Yii::$app->formatter->locale = 'et-EE';                 
                    return Yii::$app->formatter->asCurrency($model->valor,'USD'); 
                },
                'footer' => ReciboCaja::getTotal($dataProvider->models, 'valor')
               
            ],

            
            [
                'attribute'=>'idtipoingreso',
                'value'=>function($model){
                    $ingreso = TipoIngreso::findOne($model->idtipoingreso);
                    return $ingreso->ingreso;
                }

            ],
            //'fechacreacion',
            //'adjunto',
            //'subtotal',
            //'total',
  [
          'class' => 'yii\grid\ActionColumn',
          'header' => 'Acciones',
          'headerOptions' => ['style' => 'color:#337ab7'],
          'template' => '{update}{delete}',
          'buttons' => [
          'update' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                          'title' => 'Actualizar',
                ]);
            },
            'delete' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => 'Borrar',
                ]);
            }

          ],
          'urlCreator' => function ($action, $model, $key, $index) {
           

            if ($action === 'update') {
                $url =Url::base().'/detalle-recibo-caja/update?id='.$model->iddetalle_recibo;
                return $url;
            }
            if ($action === 'delete') {
                $url ='/detalle-recibo-caja/delete?id='.$model->iddetalle_recibo;
                Url::remember();

                return $url;
            }

          }
          ],
        ],
    ]); ?>
 <?= $this->registerJs("updatecomprobantes('alta','baja')", View::POS_READY,'my-button-handler');?>

</div>
<div class="row">
    <div class="col-sm-12">
        <div class="mensaje"></div>
    </div>    
</div>

