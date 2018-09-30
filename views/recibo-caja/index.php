<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\CentroCostos;


/* @var $this yii\web\View */
/* @var $searchModel app\models\ReciboCajaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Recibo Cajas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recibo-caja-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Recibo Caja', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'tableOptions' => [ 'class' => 'table table-sm table-hover table-bordered table-striped'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'idrecibo',
            'fecha', 
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
