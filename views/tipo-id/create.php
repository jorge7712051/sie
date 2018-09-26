<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoId */

$this->title = 'Crear Tipo de Identificación';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Identificación', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-id-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
