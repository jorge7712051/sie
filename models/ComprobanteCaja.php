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
class ComprobanteCaja extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $fecha_caja;
    public $idiglesia;
    public $valor_total;
    public $retencion;
    public $llave;
    public $id_anterior;
    public $contraparte='caja';
   

    public static function tableName()
    {
        return 'comprobante_caja';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idcomprobante', 'idcentrocostos','idtercero','valor_d','idconcepto','area','centrocosto','subtotal','total','id_anterior'], 'integer'],
            [['codigo',], 'string', 'max' => 5],
            [['fecha','fecha_caja;'], 'safe'],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcomprobante' => 'Comprobante',
            'idcentrocostos' => 'Centro Costos',
            'fecha' => 'Fecha',
        ];
    }

     public static function primaryKey()
    {
        
        
        return ["llave"];
    }

    
}