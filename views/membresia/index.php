<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MembresiaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Membresias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membresia-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Membresia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'identificacion',
            'sexo',
            'Nombres',
            'Apellidos',
            'Direccion',
            //'barrio',
            'Telefono',
            'Celular',
            //'Lugar_Nacimiento',
            //'Fecha_Nacimiento',
            //'estado_civil',
            //'conyuge',
            //'nivel_estudios',
            //'estudios_tecnicos',
            //'estudios_profesionales',
            //'estudios_noformales:ntext',
            //'fecha_bautismo',
            //'fecha_conversion',
            //'formacion_teologica:ntext',
            //'cargo_iglesia',
            //'ministerio_afin',
            //'cc',
            //'fecha_ingreso',
            //'fecha_retiro',
            //'tipo',
            //'numero_hijos',
            //'activo',
            //'motivo_retiro:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
