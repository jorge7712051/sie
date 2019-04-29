<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DetalleReciboCaja */
/*
$this->title = 'Update Detalle Recibo Caja: ' . $model->iddetalle_recibo;
$this->params['breadcrumbs'][] = ['label' => 'Detalle Recibo Cajas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->iddetalle_recibo, 'url' => ['view', 'id' => $model->iddetalle_recibo]];
$this->params['breadcrumbs'][] = 'Update';*/
?>
<div class="detalle-recibo-caja-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
