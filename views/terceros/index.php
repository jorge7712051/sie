<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\TipoId;
use app\models\Ciudades;
use kartik\export\ExportMenu;


/* @var $this yii\web\View */
/* @var $searchModel app\models\TercerosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Terceros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="terceros-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<div  class="row">
  
<div class="col-md-12">
     <div class="fondo">
         <h4 class="text-center">Descarga Terceros</h4>


<?php
    $gridColumnscaja = [    
    'idtercero',
    'identificacion',
    'razon_social',
    'nombre',
    'apellido',
    'telefono',   
    'direccion',    
   
];

// Renders a export dropdown menu
echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumnscaja,
    'filename' => 'Comprobante egreso caja',
    'dropdownOptions' => [
        'label' => 'Exportar Terceros',
        'class' => 'btn btn-secondary'
    ]
]);
?>


</div>
 </div>
</div>  
<br>


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
            [
                'attribute' => 'identificacion',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Buscar identificacion'
                ]
            ],
            [
                'attribute' => 'razon_social',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Buscar razon social'
                ]
            ],
            [
                'attribute' =>  'nombre',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Buscar nombre'
                ]
            ],
            [
                'attribute' =>  'apellido',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Buscar apellido'
                ]
            ],
            [
                'attribute' =>  'telefono',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Buscar telefono'
                ]
            ],
           
             //'digitoverificacion',
            
           
      
           
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
