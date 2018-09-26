<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DetallesComprobanteEgreso */

$this->title = 'Update Detalles Comprobante Egreso: ' . $model->iddetalle;

?>
<div class="detalles-comprobante-egreso-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formupdate', [
        'model' => $model,
    ]) ?>

</div>
