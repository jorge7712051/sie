<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ciudades */

$this->title = 'Actualizar Ciudades: ' . $model->idciudad;
$this->params['breadcrumbs'][] = ['label' => 'Ciudades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idciudad, 'url' => ['view', 'id' => $model->idciudad]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="ciudades-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
