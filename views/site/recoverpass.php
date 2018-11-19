<?php
 use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
 ?>
 <div class="site-login">
    <div class="row">
        <div class="col-xs-12 col-lg-6 col-lg-offset-3 imagencentro">        
            <img class="center-block " src="<?php echo Url::base().'/img/logo.png' ?>">  
        </div>
    </div>
     <div class="row">
        <div class="col-xs-12 col-lg-6 col-lg-offset-3 imagencentro"> 
        <h4><?= $msg ?></h4>
        
          <h1>Recuperar password</h1>
 <?php $form = ActiveForm::begin([
     'method' => 'post',
     'enableClientValidation' => true,
 ]);
 ?>
 
 <div class="form-group">
  <?= $form->field($model, "email")->input("email") ?>  
 </div>
 
 <?= Html::submitButton("Recuperar Password", ["class" => "btn btn-primary"]) ?>
 
 <?php $form->end() ?> 
        </div>
    </div>

    
 
 
  
</div>

 