<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use app\models\Area;

/* @var $this yii\web\View */
/* @var $model app\models\CentroArea */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Centro de costos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="centro-area-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Esta seguro que desea borrar este centro de costos?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre',
            'descripcion:ntext',
            //'idanulo',
            [
                'attribute'=>'idarea',
                'value'=>function($model){
                    $area= Area::findOne($model->idarea);
                    return $area->nombre;
                }
            ]
        ],
    ]) ?>

</div>
