<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ConceptoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="concepto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idconcepto') ?>

    <?= $form->field($model, 'concepto') ?>

    <?= $form->field($model, 'piso') ?>

    <?= $form->field($model, 'porcentaje') ?>

    <?= $form->field($model, 'idanulo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
