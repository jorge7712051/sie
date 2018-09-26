<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detalle_recibo_caja".
 *
 * @property string $iddetalle_recibo
 * @property int $idtercero
 * @property double $valor
 * @property int $idtipoingreso
 * @property string $idrecibocaja
 * @property string $fechacreacion
 *
 * @property TipoIngreso $tipoingreso
 * @property Terceros $tercero
 * @property ReciboCaja $recibocaja
 */
class DetalleReciboCaja extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detalle_recibo_caja';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idtercero', 'valor', 'idtipoingreso', 'idrecibocaja', 'fechacreacion'], 'required'],
            [['idtercero', 'idtipoingreso', 'idrecibocaja'], 'integer'],
            [['valor'], 'number'],
            [['fechacreacion'], 'safe'],
            [['idtipoingreso'], 'exist', 'skipOnError' => true, 'targetClass' => TipoIngreso::className(), 'targetAttribute' => ['idtipoingreso' => 'idtipo_ingreso']],
            [['idtercero'], 'exist', 'skipOnError' => true, 'targetClass' => Terceros::className(), 'targetAttribute' => ['idtercero' => 'idtercero']],
            [['idrecibocaja'], 'exist', 'skipOnError' => true, 'targetClass' => ReciboCaja::className(), 'targetAttribute' => ['idrecibocaja' => 'idrecibo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iddetalle_recibo' => 'Iddetalle Recibo',
            'idtercero' => 'Idtercero',
            'valor' => 'Valor',
            'idtipoingreso' => 'Idtipoingreso',
            'idrecibocaja' => 'Idrecibocaja',
            'fechacreacion' => 'Fechacreacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoingreso()
    {
        return $this->hasOne(TipoIngreso::className(), ['idtipo_ingreso' => 'idtipoingreso']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTercero()
    {
        return $this->hasOne(Terceros::className(), ['idtercero' => 'idtercero']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecibocaja()
    {
        return $this->hasOne(ReciboCaja::className(), ['idrecibo' => 'idrecibocaja']);
    }
}
