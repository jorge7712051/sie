<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\CentroCostos;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
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
            'id',
            'username',           
            'email:email',
            'nombrecompleto',
           [
                'attribute'=>'centrocosto',
                'value'=>function($model){
                    $centrocosto = CentroCostos::findOne($model->centrocosto);
                    return $centrocosto->centrocostos;
                },
                'filter'=> ArrayHelper::map(CentroCostos::find()->all(),'idcentrocostos','centrocostos'),

            ],
           
        ],
    ]) ?>

</div>
