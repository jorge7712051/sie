<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_id".
 *
 * @property int $id
 * @property string $tipoidentificacion
 * @property string $codigo
 *
 * @property Terceros[] $terceros
 */
class TipoId extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_id';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'tipoidentificacion', 'codigo'], 'required'],
            [['id'], 'integer'],
            [['tipoidentificacion'], 'string', 'max' => 50],
            [['codigo'], 'string', 'max' => 5],
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
            'tipoidentificacion' => 'Tipo de Identificacón',
            'codigo' => 'Sigla',
        ];
    }

     public static function buscarmodelo($id){
        $tipoid= TipoId::findOne($id);
        if($tipoid !== null)
        {   
            $tipoid->idanulo=1;
            $tipoid->save();
            return true;
        }
        return false;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTerceros()
    {
        return $this->hasMany(Terceros::className(), ['tipo_id' => 'id']);
    }
}
