<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ciudades".
 *
 * @property int $idciudad
 * @property string $ciudad
 * @property int $idanulo
 *
 * @property Terceros[] $terceros
 */
class Ciudades extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    


    public static function tableName()
    {
        return 'ciudades';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ciudad','iddepartamento'], 'required'],
            [['idciudad', 'idanulo','iddepartamento'], 'integer'],
            [['ciudad'], 'string', 'max' => 100],
            [['idciudad'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idciudad' => 'Idciudad',
            'ciudad' => 'Ciudad',
            'iddepartamento' => 'Departamento',
            'idanulo' => 'Idanulo',
        ];
    }

    public static function buscarmodelo($id){
        $ciudad= Ciudades::findOne($id);
        if($ciudad !== null)
        {   
            $ciudad->idanulo=1;
            $ciudad->save();
            return true;
        }
        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTerceros()
    {
        return $this->hasMany(Terceros::className(), ['idciudad' => 'idciudad']);
    }

    public function getDepartamento()
    {
        return $this->hasOne(Departamento::className(), ['id' => 'iddepartamento']);
    }
}
