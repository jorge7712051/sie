<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Departamento;
use app\models\Pais;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CiudadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ciudades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ciudades-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Ciudad', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'idciudad',           
            'ciudad',           
            [
                'attribute' => 'departamento',
                'value' => 'nombredep',
                'filter'=>ArrayHelper::map(Departamento::find()->where('idanulo=0' )->all(),'nombre','nombre'),
            ],
            [
                'attribute' => 'pais',
                'value' => 'nombrepais',
                'filter'=>ArrayHelper::map(Pais::find()->where('idanulo=0' )->all(),'nombre','nombre'),
               
            ],
            //'idanulo',
           [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Acciones',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => '{view}{update}{delete}',
                'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"> </span>', $url, [
                            'title' => 'Ver',

                            ]);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"> </span>', $url, [
                            'title' => 'Actualizar',
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"> </span>', $url, [
                            'title' => 'Borrar',
                            'data-confirm'=>'¿Está seguro de eliminar esta ciudad?',
                            ]);
                        }

                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                    $url =Url::to(['ciudades/view', 'id' => $model['idciudad']]);
                    return $url;
                    }
                    if ($action === 'update') {
                    $url =Url::to(['ciudades/update', 'id' => $model['idciudad']]);
                    return $url;
                    }   
                    if ($action === 'delete') {
                    $url =Url::to(['ciudades/delete', 'id' => $model['idciudad']]);                 
                    return $url;
                    }
                }
            ],
        ],
    ]); ?>
</div>
