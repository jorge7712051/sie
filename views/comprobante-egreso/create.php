<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ComprobanteEgreso */

$this->title = 'Crear Comprobante Egreso';
$this->params['breadcrumbs'][] = ['label' => 'Comprobante Egresos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comprobante-egreso-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
