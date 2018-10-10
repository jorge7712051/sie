<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Pastores;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DiezmoPastoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Diezmo Pastores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diezmo-pastores-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Diezmo Pastores', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'valor',
            'fecha',
            'idpastor',
            [
                'attribute'=>'idpastor',
                'value'=>function($model){
                    $pastores = Pastores::findOne($model->idpastor);
                    return $pastores->nombre;
                },
                'filter'=> ArrayHelper::map(Pastores::find()->all(),'cedula','nombre'),
            ],  
            //'idnulo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
