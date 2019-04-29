<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Membresia */

$this->title = $model->identificacion;
$this->params['breadcrumbs'][] = ['label' => 'Membresias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membresia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->identificacion], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->identificacion], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro que desea borrar este elemento',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'identificacion',
            'sexo',
            'Nombres',
            'Apellidos',
            'Direccion',
            'barrio',
            'Telefono',
            'Celular',
            'Lugar_Nacimiento',
            'Fecha_Nacimiento',
            'estado_civil',
            'conyuge',
            'nivel_estudios',
            'estudios_tecnicos',
            'estudios_profesionales',
            'estudios_noformales:ntext',
            'fecha_bautismo',
            'fecha_conversion',
            'formacion_teologica:ntext',
            'cargo_iglesia',
            'ministerio_afin',
            'cc',
            'fecha_ingreso',
            'fecha_retiro',
            'tipo',
            'numero_hijos',
            'activo',
            'motivo_retiro:ntext',
        ],
    ]) ?>

</div>
