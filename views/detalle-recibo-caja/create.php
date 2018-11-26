<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DetalleReciboCaja */
/*
$this->title = 'Create Detalle Recibo Caja';
$this->params['breadcrumbs'][] = ['label' => 'Detalle Recibo Cajas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;*/
?>
<div class="detalle-recibo-caja-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
