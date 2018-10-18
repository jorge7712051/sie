<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CentroCostos */

$this->title = 'Actualizar Iglesi: ' . $model->centrocostos;
$this->params['breadcrumbs'][] = ['label' => 'Iglesias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->centrocostos, 'url' => ['view', 'id' => $model->idcentrocostos]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="centro-costos-update">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
