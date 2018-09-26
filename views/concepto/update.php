<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Concepto */

$this->title = 'Actualizar Concepto: ' . $model->idconcepto;
$this->params['breadcrumbs'][] = ['label' => 'Conceptos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idconcepto, 'url' => ['view', 'id' => $model->idconcepto]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="concepto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
