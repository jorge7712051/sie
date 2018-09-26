<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "caja".
 *
 * @property string $id
 * @property string $valor_ingreso
 * @property string $valor_egreso
 * @property string $fecha
 * @property int $idcomprobante
 * @property int $idcaja
 */
class Caja extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'caja';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['valor_ingreso', 'valor_egreso', 'idcomprobante', 'idcaja'], 'integer'],
            [['fecha'], 'safe'],
          
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'valor_ingreso' => 'Valor Ingreso',
            'valor_egreso' => 'Valor Egreso',
            'fecha' => 'Fecha',
            'idcomprobante' => 'Idcomprobante',
            'idcaja' => 'Idcaja',
        ];
    }
}
