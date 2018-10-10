<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pastores */

$this->title = $model->cedula;
$this->params['breadcrumbs'][] = ['label' => 'Pastores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pastores-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->cedula], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->cedula], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Esta seguro que desea borrar este usuario?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cedula',
            'nombre',
            'direccion',
            'telefono',
            'correo:email',
            //'idanulo',
            //'tipoid',
            //'centro_costo',
        ],
    ]) ?>

</div>
