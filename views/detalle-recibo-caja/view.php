<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DetalleReciboCaja */

$this->title = $model->iddetalle_recibo;
$this->params['breadcrumbs'][] = ['label' => 'Detalle Recibo Cajas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detalle-recibo-caja-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->iddetalle_recibo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->iddetalle_recibo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'iddetalle_recibo',
            'idtercero',
            'valor',
            'idtipoingreso',
            'idrecibocaja',
            'fechacreacion',
        ],
    ]) ?>

</div>
