<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Departamento;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CiudadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ciudades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ciudades-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Ciudad', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'idciudad',           
            'ciudad',           
            [
                'attribute' => 'departamento',
                'value' => 'departamento.nombre',
                'filter'=>ArrayHelper::map(Departamento::find()->all(),'nombre','nombre'),
            ],
            [
                'attribute' => 'pais',
                'value' => 'pais',
               
            ],
            //'idanulo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
