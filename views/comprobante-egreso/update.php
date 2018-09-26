<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ComprobanteEgreso */

$this->title = 'Actualizar Comprobante Egreso: ' . $model->idcomprobante;
$this->params['breadcrumbs'][] = ['label' => 'Comprobante Egresos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idcomprobante, 'url' => ['view', 'id' => $model->idcomprobante]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="comprobante-egreso-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formupdate', [
        'model' => $model,
    ]) ?>

</div>
