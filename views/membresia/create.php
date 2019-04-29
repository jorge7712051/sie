<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Membresia */

$this->title = 'Crear Membresia';
$this->params['breadcrumbs'][] = ['label' => 'Membresias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membresia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
