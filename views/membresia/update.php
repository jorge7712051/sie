<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Membresia */

$this->title = 'Actualizar Membresia: ' . $model->identificacion;
$this->params['breadcrumbs'][] = ['label' => 'Membresias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->identificacion, 'url' => ['view', 'id' => $model->identificacion]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="membresia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
