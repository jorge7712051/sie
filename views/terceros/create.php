<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Terceros */

$this->title = 'Crear Terceros';
$this->params['breadcrumbs'][] = ['label' => 'Terceros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="terceros-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
     	
          'model' => $model,
    ]) ?>

</div>
