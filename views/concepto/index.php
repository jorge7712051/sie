<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Concepto;


/* @var $this yii\web\View */
/* @var $searchModel app\models\ConceptoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Conceptos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="concepto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Concepto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idconcepto',
            'concepto',
            [
                'attribute'=>'piso',               
                'value'=>function($model){  
                    Yii::$app->formatter->locale = 'et-EE';                 
                    return Yii::$app->formatter->asCurrency($model->piso,'USD'); 
                },
            ],
            [
                'attribute'=>'porcentaje',               
                'value'=>function($model){ 
                    $valor=$model->porcentaje/100;
                    return Yii::$app->formatter->asPercent($valor); 
                },
            ],
            [
                'attribute'=>'doble',               
                'value'=>function($model){ 
                   if ($model->doble==0) { return 'NO';}
                    return 'SI';
                },
                 'filter'=> ArrayHelper::map(Concepto::find()->all(),
                    'doble',
                    function($model) {
                        if ($model->doble==0) { return 'NO';}
                        return 'SI';
                    }),
            ],
            [
                'attribute'=>'adjobligatorio',               
                'value'=>function($model){ 
                   if ($model->adjobligatorio==0) { return 'SI';}
                    return 'NO';
                },
                 'filter'=> ArrayHelper::map(Concepto::find()->all(),
                    'adjobligatorio',
                    function($model) {
                        if ($model->adjobligatorio==0) { return 'SI';}
                        return 'NO';
                    }),
            ],
            
            //'idanulo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
