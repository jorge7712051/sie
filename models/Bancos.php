<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bancos".
 *
 * @property string $id
 * @property string $valor_ingreso
 * @property string $valor_egreso
 * @property int $idcomprobante
 * @property int $idcaja
 * @property int $idanulo
 */
class Bancos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bancos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'valor_ingreso', 'valor_egreso', 'idcomprobante', 'idcaja', 'idanulo'], 'integer'],
          
            
            [['id'], 'unique'],
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
            'idcomprobante' => 'Idcomprobante',
            'idcaja' => 'Idcaja',
            'idanulo' => 'Idanulo',
        ];
    }
}
