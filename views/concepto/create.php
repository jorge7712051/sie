<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Concepto */

$this->title = 'Craer Concepto';
$this->params['breadcrumbs'][] = ['label' => 'Conceptos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="concepto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
