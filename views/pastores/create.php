<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pastores */

$this->title = 'Create Pastores';
$this->params['breadcrumbs'][] = ['label' => 'Pastores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pastores-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
