<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\TipoId;
use app\models\Ciudades;


/* @var $this yii\web\View */
/* @var $searchModel app\models\TercerosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Terceros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="terceros-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Terceros', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
             //'digitoverificacion',
            'razon_social',
            'nombre',
            'apellido',
            'telefono',
            //'direccion',
            [
                'attribute'=>'idciudad',
                'value'=>function($model){
                    $ciudades = Ciudades::findOne($model->idciudad);
                    return $ciudades->ciudad;
                },
                'filter'=> ArrayHelper::map(Ciudades::find()->all(),'idciudad','ciudad'),

            ],
             
           
            //'usuariocreacion',
            //'fecha_creacion',
            //'fecha_actualizacion',
            //'anotaciones',
            //'digitoverificacion',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
