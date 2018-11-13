<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use app\models\Concepto;
/* @var $this yii\web\View */
/* @var $model app\models\Concepto */

$this->title = $model->concepto;
$this->params['breadcrumbs'][] = ['label' => 'Conceptos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="concepto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->idconcepto], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->idconcepto], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Esta seguro que desea borrar este concepto?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idconcepto',
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
                    return Yii::$app->formatter->asPercent($valor,1); 
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
        ],
    ]) ?>

</div>
