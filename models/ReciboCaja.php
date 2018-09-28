<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "recibo_caja".
 *
 * @property string $idrecibo
 * @property string $fecha
 * @property string $fecha_creacion
 * @property string $concepto
 * @property double $valor
 * @property int $bloqueo
 * @property int $idcentrocostos
 * @property string $adjunto
 * @property int $idanulo
 * @property string $codigo
 *
 * @property DetalleReciboCaja[] $detalleReciboCajas
 */
class ReciboCaja extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $comprobante;
    public $ruta;

    public static function tableName()
    {
        return 'recibo_caja';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idrecibo', 'fecha', 'fecha_creacion', 'concepto', 'valor', 'idcentrocostos'], 'required'],
            [['idrecibo', 'bloqueo', 'idcentrocostos', 'idanulo'], 'integer'],
            [['idrecibo'], 'unique','on'=>'create'],
            [['fecha', 'fecha_creacion'], 'safe'],
            [['valor'], 'number'],
            [['concepto'], 'string', 'max' => 50],
            [['adjunto'], 'string', 'max' => 400],
            [['codigo'], 'string', 'max' => 5],
            [['idrecibo'], 'unique'],
            [['comprobante'], 'required', 'on' =>'create'],
            [['comprobante'],'file',//Error
                                'maxSize' => 2048*1024*1, //1 MB
                                'tooBig' => 'El tamaño máximo permitido es 2MB', //Error
                                'extensions' => 'pdf, png, jpg',
                                'wrongExtension' => 'El archivo {file} no contiene una extensión permitida {extensions}', //Error
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idrecibo' => 'Idrecibo',
            'fecha' => 'Fecha',
            'fecha_creacion' => 'Fecha Creacion',
            'concepto' => 'Concepto',
            'valor' => 'Valor',
            'bloqueo' => 'Bloqueo',
            'idcentrocostos' => 'Idcentrocostos',
            'adjunto' => 'Adjunto',
            'idanulo' => 'Idanulo',
            'codigo' => 'Codigo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getImageurl()
    {
        $ruta=Url::home(true);
        return $ruta.$this->adjunto;
    }

    public function getDetalleReciboCajas()
    {
        return $this->hasMany(DetalleReciboCaja::className(), ['idrecibocaja' => 'idrecibo']);
    }
}
