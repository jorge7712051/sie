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
class CajaBanco extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $fecha_banco;
    public $idiglesia;
    public $id_anterior;
    public $valor_total;
    public $retencion;
    public $llave;
    public $contraparte='banco';
   

    public static function tableName()
    {
        return 'recibo_caja_banco';
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