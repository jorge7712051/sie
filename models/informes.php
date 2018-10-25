<?php

namespace app\models;

use Yii;
use yii\base\Model;
/**
 * This is the model class for table "terceros".
 *
 * @property string $idtercero
 * @property double $identificacion
 * @property string $nombre
 * @property string $apellido
 * @property string $telefono
 * @property string $direccion
 * @property int $idciudad
 * @property int $tipo_id
 * @property string $razon_social
 * @property int $usuariocreacion
 * @property string $fecha_creacion
 * @property string $fecha_actualizacion
 * @property string $anotaciones
 * @property int $digitoverificacion
 *
 * @property DetalleReciboCaja[] $detalleReciboCajas
 * @property DetallesComprobanteEgreso[] $detallesComprobanteEgresos
 * @property Ciudades $ciudad
 * @property TipoId $tipo
 * @property Usuarios $usuariocreacion0
 */
class Informes extends Model

{
    /*
     * {@inheritdoc}
     */
    public $fecha;
    public $fecha_inicio;
    public $fecha_fin;
    public $idpais;
    public $centro_costos;
    public $iddepartamento;
    public $idciudad;
    public $idarea;
    public $centro_area;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['centro_costos','fecha'], 'required','on' =>'informe'],
            [['fecha_inicio','fecha_fin','idpais','idarea'], 'required', 'on' =>'create'],
            [['centro_costos'], 'integer','on' =>'informe'],
            [['centro_area', 'iddepartamento','idciudad'], 'default'],
            ['fecha_inicio', 'compare', 'compareAttribute' => 'fecha_fin', 'operator' => '<='],
            [['fecha','centro_costos','idciudad','iddepartamento'], 'safe'],            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'centro_costos' => 'Iglesia',
            'fecha' => 'fecha',
            'fecha_inicio'      =>'Fceha inicio',
            'fecha_fin'      =>'Fecha fin',
            'idpais'=>'Pais',
            'idarea'=>'Area',
            'iddepartamento'=>'Departamento',
            'idciudad'=>'Ciudad',
            'centro_area'=>'Centro de costos'
        ];
    }


   
        
}
