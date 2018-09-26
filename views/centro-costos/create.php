<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CentroCostos */

$this->title = 'Create Centro Costos';
$this->params['breadcrumbs'][] = ['label' => 'Centro Costos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="centro-costos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
