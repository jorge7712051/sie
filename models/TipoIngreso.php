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
            [['doble'],'boolean'],
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
            'idtipo_ingreso' => 'ID Ingreso',
            'ingreso' => 'Nombre Ingreso',
            'idanulo' => 'Idanulo',
            'doble'=>'Habilitación doble',
        ];
    }

     public static function buscarmodelo($id){
        $ingreso= TipoIngreso::find()
                ->Where(['in','idtipo_ingreso', ["idtipo_ingreso" => $id]]) 
                ->all();

        if($ingreso !== null)
        {
            TipoIngreso::updateAll(['idanulo' => 1], ['in','idtipo_ingreso', ["idtipo_ingreso" => $id]]);
            return true;
        }
        return false;
    }

       public function beforeSave($insert)
  {
      if (parent::beforeSave($insert)) 
      {
        if($insert)
        {
          $this->ingreso = strtoupper($this->ingreso );        
        }
        else{
          $this->ingreso = strtoupper($this->ingreso ); 
        }
        return true;
      }
      return false;  
  }  

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleReciboCajas()
    {
        return $this->hasMany(DetalleReciboCaja::className(), ['idtipoingreso' => 'idtipo_ingreso']);
    }
}
