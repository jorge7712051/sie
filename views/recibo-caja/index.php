<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
        <?= Html::a('Create Recibo Caja', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idrecibo',
            'fecha',
            'fecha_creacion',
            'concepto',
            'valor',
            //'bloqueo',
            //'idcentrocostos',
            //'adjunto',
            //'idanulo',
            //'codigo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
