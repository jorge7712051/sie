<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoIngreso */

$this->title = 'Crear Tipo Ingreso';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Ingresos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-ingreso-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
