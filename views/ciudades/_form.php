<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Pais;
use app\models\Departamento;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Ciudades */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ciudades-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $estado = ArrayHelper::map(Pais::find()->all(), 'id', 'nombre'); ?>

    <?= $form->field($model, 'pais')->dropDownList(
                $estado,
                [
                    'prompt'=>'Selecione un pais',
                    'onchange'=>'
                        $.get( "'.Url::toRoute('/departamento/departamento').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($model, 'iddepartamento').'" ).html( data );
                            }
                        );
                    '    
                ]
        );  ?>

    <?= $form->field($model, 'iddepartamento')->dropDownList(['prompt'=>'Selecione un departamento'])  ?>

    <?= $form->field($model, 'ciudad')->textInput(['maxlength' => true]) ?>    

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
