<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CentroCostos */

$this->title = 'Actualizar Centro Costos: ' . $model->idcentrocostos;
$this->params['breadcrumbs'][] = ['label' => 'Centro Costos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idcentrocostos, 'url' => ['view', 'id' => $model->idcentrocostos]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="centro-costos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
