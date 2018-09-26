<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "concepto".
 *
 * @property int $idconcepto
 * @property int $concepto
 * @property double $piso
 * @property double $porcentaje
 * @property int $idanulo
 *
 * @property DetallesComprobanteEgreso[] $detallesComprobanteEgresos
 */
class Concepto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'concepto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['concepto'], 'required'],
            [['doble','adjobligatorio'],'boolean'],
            [['idanulo'], 'integer'],
            [['concepto'], 'string', 'max' => 50],
            [['piso', 'porcentaje'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idconcepto' => 'Idconcepto',
            'concepto' => 'Concepto',
            'piso' => 'Piso',
            'porcentaje' => 'Porcentaje',
            'idanulo' => 'Idanulo',
            'doble'=>'Habilitación doble',
            'adjobligatorio'=> 'Adjunto nesesario',
        ];
    }

    public static function buscarmodelo($id){
        $usuario= Concepto::find()
                ->Where(['in','idconcepto', ["idconcepto" => $id]]) 
                ->all();

        if($usuario !== null)
        {
            Concepto::updateAll(['idanulo' => 1], ['in','idconcepto', ["ididconcepto" => $id]]);
            return true;
        }
        return false;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetallesComprobanteEgresos()
    {
        return $this->hasMany(DetallesComprobanteEgreso::className(), ['idconcepto' => 'idconcepto']);
    }
}
