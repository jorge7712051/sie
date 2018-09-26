<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoId */

$this->title = 'Actualizar tiposde Identificacion: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Ids', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="tipo-id-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
