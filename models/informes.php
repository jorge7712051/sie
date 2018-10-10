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
    public $centro_costos;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['centro_costos','fecha'], 'required'],
            [['centro_costos'], 'integer'],
            [['fecha'], 'safe'],            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'centro_costos' => 'Centro de costos',
            'fecha' => 'fecha',        
        ];
    }


   
        
}
