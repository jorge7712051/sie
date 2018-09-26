<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BancosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bancos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bancos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bancos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'valor_ingreso',
            'valor_egreso',
            'idcomprobante',
            'idcaja',
            //'idanulo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
