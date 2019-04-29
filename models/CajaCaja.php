<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ComprobanteCaja".
 *
 * @property int $idcomprobante
 * @property string $nombre
 * @property int $idcentrocostos
 *
 * @property ComprobanteBanco[] $ComprobanteBanco
 */
class CajaCaja extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $fecha_caja;
    public $idiglesia;
    public $id_anterior;
    public $valor_total;
    public $retencion;
    public $llave;
    public $contraparte='caja';
   

    public static function tableName()
    {
        return 'recibo_caja_caja';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idrecibo', 'idcentrocostos','idtercero','valor_d','idconcepto','valor','idtipoingreso','id_anterior'], 'integer'],
            [['codigo','concepto'], 'string', 'max' => 5],
            [['fecha','fecha_caja;'], 'safe'],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idrecibo' => 'Recibo',
            'idcentrocostos' => 'Centro Costos',
            'fecha' => 'Fecha',
        ];
    }

    public static function primaryKey()
    {
        
        
        return ["llave"];
    }
}
