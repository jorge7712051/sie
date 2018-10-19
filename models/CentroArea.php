<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "centro_area".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property int $idarea
 * @property int $idanulo
 *
 * @property Area $area
 */
class CentroArea extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'centro_area';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'idarea'], 'required'],
            [['descripcion'], 'string'],
            [['idarea', 'idanulo'], 'integer'],
            [['nombre'], 'string', 'max' => 200],
            [['idarea'], 'exist', 'skipOnError' => true, 'targetClass' => Area::className(), 'targetAttribute' => ['idarea' => 'idarea']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'idarea' => 'Area',
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
    public function getArea()
    {
        return $this->hasOne(Area::className(), ['idarea' => 'idarea']);
    }
}
