<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pastores */

$this->title = 'Update Pastores: ' . $model->cedula;
$this->params['breadcrumbs'][] = ['label' => 'Pastores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cedula, 'url' => ['view', 'id' => $model->cedula]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pastores-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
