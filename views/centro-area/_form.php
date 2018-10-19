<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Area;

/* @var $this yii\web\View */
/* @var $model app\models\CentroArea */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="centro-area-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'idarea')->dropDownList(ArrayHelper::map(Area::find()->where('idanulo=0')->all(), 'idarea', 'nombre'))?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
