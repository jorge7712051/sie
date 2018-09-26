<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DetallesComprobanteEgreso */

$this->title = $model->iddetalle;
$this->params['breadcrumbs'][] = ['label' => 'Detalles Comprobante Egresos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detalles-comprobante-egreso-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->iddetalle], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->iddetalle], [
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
            'iddetalle',
            'idtercero',
            'valor',
            'idcomprobanteegreso',
            'idconcepto',
            'fechacreacion',
            'adjunto',
            'subtotal',
            'total',
        ],
    ]) ?>

</div>
