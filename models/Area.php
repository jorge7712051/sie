<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "area".
 *
 * @property int $idarea
 * @property string $nombre
 * @property int $idanulo
 *
 * @property CentroArea[] $centroAreas
 */
class Area extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'area';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['idarea', 'idanulo'], 'integer'],
            [['nombre'], 'string', 'max' => 200],
            [['idarea'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idarea' => 'Idarea',
            'nombre' => 'Nombre area',
            'idanulo' => 'Idanulo',
        ];
    }

    public function beforeSave($insert)
    {
      if (parent::beforeSave($insert)) 
      {
        $this->nombre = strtoupper($this->nombre );
        return true;
      }
      return false;  
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCentroAreas()
    {
        return $this->hasMany(CentroArea::className(), ['idarea' => 'idarea']);
    }
}
