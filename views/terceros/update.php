<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Terceros */

$this->title = 'Actualizar Terceros: ' . $model->idtercero;
$this->params['breadcrumbs'][] = ['label' => 'Terceros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idtercero, 'url' => ['view', 'id' => $model->idtercero]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="terceros-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
