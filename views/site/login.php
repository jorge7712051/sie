<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="row">
        <div class="col-xs-12 col-lg-6 col-lg-offset-3 imagencentro">        
            <img class="center-block " src="<?php echo Url::base().'/img/logo.png' ?>">  
            <p>Por favor complete los siguientes campos para iniciar sesión:</p>
        </div>
     </div>
    <div class="row">
       <div class="col-xs-12 col-lg-6 col-lg-offset-3">   
             <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'layout' => 'horizontal',
                'fieldConfig' => [
                     'template' => "{label}\n<div class=\"col-lg-8\">{input}</div>\n<div class=\"col-lg-12 col-lg-offset-4\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-4 control-label'],
                 ],
             ]); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => "<div class=\"col-lg-offset-4 col-lg-4\">{input} {label}</div>\n<div class=\"col-lg-4\">{error}</div>",
            ])->label('Recordarme') ?>

            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-10">
                  <?= Html::submitButton('Incio sesion', ['class' => 'btn  btn-primary btn-block', 'name' => 'login-button']) ?>
                </div>
            </div>

             <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
