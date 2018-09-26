<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DetalleReciboCajaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detalle Recibo Cajas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detalle-recibo-caja-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Detalle Recibo Caja', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'iddetalle_recibo',
            'idtercero',
            'valor',
            'idtipoingreso',
            'idrecibocaja',
            //'fechacreacion',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
