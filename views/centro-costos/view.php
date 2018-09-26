<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CentroCostos */

$this->title = $model->idcentrocostos;
$this->params['breadcrumbs'][] = ['label' => 'Centro Costos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="centro-costos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->idcentrocostos], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->idcentrocostos], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Seguro que quieres eliminar este elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idcentrocostos',
            'centrocostos',
          
        ],
    ]) ?>

</div>
