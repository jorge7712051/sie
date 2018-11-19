 <?php
 use yii\helpers\Html;
 use yii\widgets\ActiveForm;
 ?>
 <div class="site-login">
    <div class="row">
        <div class="col-xs-12 col-lg-6 col-lg-offset-3 imagencentro">    
 			<h3><?= $msg ?></h3>
 
 			<h1>Reset Password</h1>
 			<?php $form = ActiveForm::begin([
     					'method' => 'post',
     					'enableClientValidation' => true,
 			]);
 			?>

 <div class="form-group">
  <?= $form->field($model, "email")->input("email") ?>  
 </div>
 
 <div class="form-group">
  <?= $form->field($model, "password")->input("password") ?>  
 </div>
 
 <div class="form-group">
  <?= $form->field($model, "password_repeat")->input("password") ?>  
 </div>

 <div class="form-group">
  <?= $form->field($model, "verification_code")->textInput(['autocomplete' =>'off']) ?>  
 </div>

 <div class="form-group">
  <?= $form->field($model, "recover")->input("hidden")->label(false) ?>  
 </div>
 
 <?= Html::submitButton("Reset password", ["class" => "btn btn-primary"]) ?>
 
 <?php $form->end() ?>
</div>
</div>
</div>