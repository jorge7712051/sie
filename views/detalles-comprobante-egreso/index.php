<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DetallesComprobanteEgresoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detalles Comprobante Egresos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detalles-comprobante-egreso-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Detalles Comprobante Egreso', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'iddetalle',
            'idtercero',
            'valor',
            'idcomprobanteegreso',
            'idconcepto',
            //'fechacreacion',
            //'adjunto',
            //'subtotal',
            //'total',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
