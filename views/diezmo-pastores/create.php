<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DiezmoPastores */

$this->title = 'Create Diezmo Pastores';
$this->params['breadcrumbs'][] = ['label' => 'Diezmo Pastores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diezmo-pastores-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
