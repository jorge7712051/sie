<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TipoIngresoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipo Ingresos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-ingreso-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tipo Ingreso', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idtipo_ingreso',
            'ingreso',
            'idanulo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
