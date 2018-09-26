<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoIngreso */

$this->title = 'Update Tipo Ingreso: ' . $model->idtipo_ingreso;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Ingresos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idtipo_ingreso, 'url' => ['view', 'id' => $model->idtipo_ingreso]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipo-ingreso-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
