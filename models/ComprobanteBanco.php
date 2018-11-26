<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "area".
 *
 * @property int $idcomprobante
 * @property string $nombre
 * @property int $idcentrocostos
 *
 * @property ComprobanteBanco[] $ComprobanteBanco
 */
class ComprobanteBanco extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $fecha_informe;
    public $idiglesia;
    public $valor_total;

    public static function tableName()
    {
        return 'comprobante_banco';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idcomprobante', 'idcentrocostos','idtercero','valor_d','idconcepto','area','centrocosto','subtotal','total'], 'integer'],
            [['codigo',], 'string', 'max' => 5],
            [['fecha','fecha_informe;'], 'safe'],
            
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

    
}
