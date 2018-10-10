<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\TipoId;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PastoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pastores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pastores-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Pastores', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'tipoid',
                'value'=>function($model){
                    $tipoid = TipoId::findOne($model->tipoid);
                    return $tipoid->codigo;
                },
                'filter'=> ArrayHelper::map(TipoId::find()->all(),'id','codigo'),

            ],
           
            'cedula',
            'nombre',
            'direccion',
            'telefono',
            'correo:email',
            //'idanulo',
            //'tipoid',
            //'centro_costo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
