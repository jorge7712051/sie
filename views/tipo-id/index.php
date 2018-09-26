<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TipoIdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipo Ids';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-id-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Tipo Identificacón', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tipoidentificacion',
            'codigo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
