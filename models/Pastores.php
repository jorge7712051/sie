<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pastores".
 *
 * @property string $cedula
 * @property string $nombre
 * @property string $direccion
 * @property string $telefono
 * @property string $correo
 * @property int $idanulo
 * @property int $tipoid
 * @property string $centro_costo
 *
 * @property DiezmoPastores[] $diezmoPastores
 * @property CentroCostos $centroCosto
 * @property TipoId $tipo
 */
class Pastores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pastores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cedula', 'nombre', 'tipoid', 'centro_costo'], 'required'],
            [['cedula', 'idanulo', 'tipoid', 'centro_costo'], 'integer'],
            ['correo', 'email'],
            [['nombre', 'direccion', 'telefono', 'correo'], 'string', 'max' => 200],
            [['cedula'], 'unique'],
            [['centro_costo'], 'exist', 'skipOnError' => true, 'targetClass' => CentroCostos::className(), 'targetAttribute' => ['centro_costo' => 'idcentrocostos']],
            [['tipoid'], 'exist', 'skipOnError' => true, 'targetClass' => TipoId::className(), 'targetAttribute' => ['tipoid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cedula' => 'Identificacion',
            'nombre' => 'Nombre',
            'direccion' => 'Direccion',
            'telefono' => 'Telefono',
            'correo' => 'Correo Electronico',
            'idanulo' => 'Idanulo',
            'tipoid' => 'Tipo Identificacion',
            'centro_costo' => 'Centro Costo',
        ];
    }

    public static function buscarmodelo($id){
        $ciudad= Pastores::findOne($id);
        if($ciudad !== null)
        {   
            $ciudad->idanulo=1;
            $ciudad->save();
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
          $this->nombre = strtoupper($this->nombre );        
        }
        else{
          $this->nombre = strtoupper($this->nombre ); 
        }
        return true;
      }
      return false;  
  }  

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiezmoPastores()
    {
        return $this->hasMany(DiezmoPastores::className(), ['idpastor' => 'cedula']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCentroCosto()
    {
        return $this->hasOne(CentroCostos::className(), ['idcentrocostos' => 'centro_costo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipo()
    {
        return $this->hasOne(TipoId::className(), ['id' => 'tipoid']);
    }
}
