<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\web\View;
use app\models\Terceros;
use app\models\Concepto;
use app\models\ComprobanteEgreso;
use app\models\CentroCostos;
/* @var $this yii\web\View */
/* @var $model app\models\ComprobanteEgreso */

$this->title = $model->idcomprobante;
$this->params['breadcrumbs'][] = ['label' => 'Comprobante Egresos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comprobante-egreso-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->idcomprobante], ['class' => 'btn btn-primary']) ?>


       <?= Html::a('Añadir nuevo', ['detalles-comprobante-egreso/create', 'id' => base64_encode($model->idcomprobante)], ['class' => 'btn btn-primary']) ?> 
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idcomprobante',
            //'fecha_creacion',
            'fecha',
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
           // 'anulado',
            //'codigo',
        ],
    ]) ?>
    
     <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'showFooter'=>TRUE,
        'columns' => [
          ['class' => 'yii\grid\SerialColumn'],
            'idcomprobanteegreso',
            [
                'attribute'=>'idtercero',               
                'value'=>function($model){
                    $tercero = Terceros::findOne($model->idtercero);
                    if($tercero->razon_social!=""){return $tercero->razon_social;}
                    return $tercero->nombre." ".$tercero->apellido;
                }
            ],
            [
                'attribute'=>'total',
                'footerOptions' => ['class' => 'valor-total'],
                'value'=>function($model){  
                            Yii::$app->formatter->locale = 'et-EE';                 
                            return Yii::$app->formatter->asCurrency($model->total,'USD'); 
                        },
                'footer' => ComprobanteEgreso::getTotal($dataProvider->models, 'total')               
            ],            
            [
                'attribute'=>'idconcepto',
                'value'=>function($model){
                    $concepto = Concepto::findOne($model->idconcepto);
                    return $concepto->concepto;
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Acciones',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => '{update}{delete}',
                  'buttons' => [
          'update' => function ($url, $model,$key) {
              $session = Yii::$app->session;
                if($session->get('rol')==1)
                    {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                          'title' => 'Actualizar',
                        ]);
                    }
                    $hoy = date("Y-m");
                    $fecha1=explode("-", $model->fechacreacion);
                    $a =$fecha1[0]."-".$fecha1[1];
                    $modelo=ComprobanteEgreso::find()->where(['idcomprobante' => $model->idcomprobanteegreso])->one();
                    if($modelo->bloqueo=='0'  )
                    {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                          'title' => 'Actualizar',
                        ]);
                    }
                    return false;
                
                
            },
            'delete' => function ($url, $model,$key) {
            $session = Yii::$app->session;
            if($session->get('rol')==1)
            {
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => 'Borrar',
                             'data-confirm'=>'¿Está seguro de eliminar esta elemento?',
                ]);
            }

            $hoy = date("Y-m");
            $fecha1=explode("-", $model->fechacreacion);
            $a =$fecha1[0]."-".$fecha1[1]; 
            $modelo=ComprobanteEgreso::find()->where(['idcomprobante' => $model->idcomprobanteegreso])->one(); 
            if($modelo->bloqueo=='0' )
                {
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => 'Borrar',
                             'data-confirm'=>'¿Está seguro de eliminar esta elemento?',
                    ]);
                }
                return false;
               
            }

          ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'update') {
                    $url =Url::to(['detalles-comprobante-egreso/update', 'id' => $model->iddetalle]);
                     return $url;
                    }   
                    if ($action === 'delete') {
                    $url =Url::to(['detalles-comprobante-egreso/delete', 'id' => $model->iddetalle]);                   
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
