<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use app\models\Ciudades;

/* @var $this yii\web\View */
/* @var $model app\models\CentroCostos */

$this->title = $model->centrocostos;
$this->params['breadcrumbs'][] = ['label' => 'Iglesias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="centro-costos-view">

    <h2><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->idcentrocostos], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->idcentrocostos], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Seguro que quieres eliminar este elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idcentrocostos',
            'centrocostos',
            [
                'attribute'=>'idciudad',
                'value'=>function($model){
                    $ciudades = Ciudades::findOne($model->idciudad);
                    return $ciudades->ciudad;
                }

            ],
          
        ],
    ]) ?>

</div>
