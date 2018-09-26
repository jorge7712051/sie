<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_ingreso".
 *
 * @property int $idtipo_ingreso
 * @property string $ingreso
 * @property int $idanulo
 *
 * @property DetalleReciboCaja[] $detalleReciboCajas
 */
class TipoIngreso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_ingreso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ingreso'], 'required'],
            [['idanulo'], 'integer'],
            [['ingreso'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idtipo_ingreso' => 'Idtipo Ingreso',
            'ingreso' => 'Ingreso',
            'idanulo' => 'Idanulo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleReciboCajas()
    {
        return $this->hasMany(DetalleReciboCaja::className(), ['idtipoingreso' => 'idtipo_ingreso']);
    }
}
