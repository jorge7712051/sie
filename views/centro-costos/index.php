<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Ciudades;


/* @var $this yii\web\View */
/* @var $searchModel app\models\CentroCostosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Iglesias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="centro-costos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Iglesia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idcentrocostos',
            'centrocostos', 
            [
                'attribute'=>'idciudad',
                'value'=>function($model){
                    $ciudad = Ciudades::findOne($model->idciudad);
                    return $ciudad->ciudad;
                },
                'filter'=> ArrayHelper::map(Ciudades::find()->all(),'idciudad','ciudad'),

            ],           

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
