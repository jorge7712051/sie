<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use app\models\TipoId;
use app\models\Ciudades;

/* @var $this yii\web\View */
/* @var $model app\models\Terceros */

$this->title = $model->idtercero;
$this->params['breadcrumbs'][] = ['label' => 'Terceros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="terceros-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->idtercero], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->idtercero], [
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
            //'idtercero',
            [
                'attribute'=>'tipo_id',
                'value'=>function($model){
                    $tipo_id = TipoId::findOne($model->tipo_id);
                    return $tipo_id->codigo;
                },
                'filter'=> ArrayHelper::map(TipoId::find()->all(),'id','codigo'),

            ],
            'identificacion',
            'digitoverificacion',
            'razon_social',
            'nombre',
            'apellido',
            'telefono',
            'direccion',
            [
                'attribute'=>'idciudad',
                'value'=>function($model){
                    $ciudades = Ciudades::findOne($model->idciudad);
                    return $ciudades->ciudad;
                },
                'filter'=> ArrayHelper::map(Ciudades::find()->all(),'idciudad','ciudad'),

            ],
           
            
            'usuariocreacion',
            'fecha_creacion',
            'fecha_actualizacion',
            'anotaciones',
            
        ],
    ]) ?>

</div>
