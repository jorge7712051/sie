<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CentroCostosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Centro de Costos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="centro-costos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Centro de Costos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idcentrocostos',
            'centrocostos',            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
