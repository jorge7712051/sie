<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ReciboCaja */

$this->title = 'Crear Recibo Caja';
$this->params['breadcrumbs'][] = ['label' => 'Recibo Cajas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recibo-caja-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
