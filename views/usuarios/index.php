<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\CentroCostos;

/* @var $this yii\web\View */
/* @var $searchModel app\modelsUsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Usuarios', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'email:email',
            'nombrecompleto',
            [
                'attribute'=>'centrocosto',
                'value'=>function($model){
                    $centrocosto = CentroCostos::findOne($model->centrocosto);
                    return $centrocosto->centrocostos;
                },
                'filter'=> ArrayHelper::map(CentroCostos::find()->all(),'idcentrocostos','centrocostos'),

            ],
            //'centrocosto',
            //'idanulo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
