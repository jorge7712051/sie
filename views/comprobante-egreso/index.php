<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\CentroCostos;


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
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'idcomprobante',
            'fecha',
            'bloqueo',
            [
                'attribute'=>'idcentrocostos',
                'value'=>function($model){
                    $centrocosto = CentroCostos::findOne($model->idcentrocostos);
                    return $centrocosto->centrocostos;
                },
                'filter'=> ArrayHelper::map(CentroCostos::find()->all(),'idcentrocostos','centrocostos'),

            ],
            'valor',
              array(
                'attribute'=>'adjunto',
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
