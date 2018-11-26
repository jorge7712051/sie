<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DetallesComprobanteEgreso */
/*
$this->title = 'Create Detalles Comprobante Egreso';
$this->params['breadcrumbs'][] = ['label' => 'Detalles Comprobante Egresos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
*/?>
<div class="detalles-comprobante-egreso-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
