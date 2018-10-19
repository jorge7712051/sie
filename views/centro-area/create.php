<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CentroArea */

$this->title = 'Create Centro Area';
$this->params['breadcrumbs'][] = ['label' => 'Centro Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="centro-area-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
