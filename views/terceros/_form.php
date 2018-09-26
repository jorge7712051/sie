<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\TipoId;
use app\models\Ciudades;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $model app\models\Terceros */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="terceros-form">

    <?php $form = ActiveForm::begin([
       'method'=>'post',     
       'id'=>'formulario-terceros',
       'enableAjaxValidation' => true,  
       'validationUrl' => '../terceros/validate',   
    ]); ?>

    <?= $form->field($model, 'tipo_id')->dropDownList(ArrayHelper::map(TipoId::find()->where('idanulo=0')->all(), 'id', 'codigo'))?>   

    <?= $form->field($model, 'identificacion')->textInput() ?>

    <?= $form->field($model, 'digitoverificacion')->textInput() ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'razon_social')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono')->textInput() ?>

    <?= $form->field($model, 'direccion')->textInput() ?>

   <?= $form->field($model, 'idciudad')->dropDownList(ArrayHelper::map(Ciudades::find()->where('idanulo=0')->all(),'idciudad','ciudad'))  ?>      

    <?= $form->field($model, 'anotaciones')->textarea(['rows' => '6','maxlength' => true]) ?>
   

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>    
    <?php ActiveForm::end(); ?>
    
    
<div class="mensaje"> </div>
</div>
<?php 
$script=<<< JS
    inicio();
    $('.field-terceros-tipo_id select').on('change', function() {
                      terceros(this.value);
    });
    $('form#formulario-terceros').on('beforeSubmit', function(e){
        e.preventDefault();
        var \$form=$(this);
        $.post(
             \$form.attr('action'),
             \$form.serialize()
            )
            .done(function(result){
              $('#formulario-terceros')[0].reset();
             $('.mensaje').html(result);
          }).fail(function(){
                console.log('server.error');
            });
          return false;          
    }).on('submit', function(e){
    e.preventDefault();
});
JS;
$this->registerJs($script);
?>


