<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "terceros".
 *
 * @property string $idtercero
 * @property double $identificacion
 * @property string $nombre
 * @property string $apellido
 * @property string $telefono
 * @property string $direccion
 * @property int $idciudad
 * @property int $tipo_id
 * @property string $razon_social
 * @property int $usuariocreacion
 * @property string $fecha_creacion
 * @property string $fecha_actualizacion
 * @property string $anotaciones
 * @property int $digitoverificacion
 *
 * @property DetalleReciboCaja[] $detalleReciboCajas
 * @property DetallesComprobanteEgreso[] $detallesComprobanteEgresos
 * @property Ciudades $ciudad
 * @property TipoId $tipo
 * @property Usuarios $usuariocreacion0
 */
class Terceros extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'terceros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['identificacion', 'telefono', 'direccion', 'idciudad', 'tipo_id'], 'required'],
            [['identificacion'], 'number'],
            [['idciudad', 'tipo_id', 'usuariocreacion', 'digitoverificacion'], 'integer'],
            [['fecha_creacion', 'fecha_actualizacion'], 'safe'],
            [['nombre', 'apellido'], 'string', 'max' => 50],
            [['telefono', 'razon_social'], 'string', 'max' => 100],
            [['direccion'], 'string', 'max' => 200],
            [['anotaciones'], 'string', 'max' => 500],
            [['identificacion'], 'unique'],
            [['nombre', 'apellido','digitoverificacion','razon_social','identificacion'],'verificar_nit'],
            [['digitoverificacion'],'match', 'pattern' => "/^.{1,1}$/", 'message' => 'Solo se permite un digito'],
            [['idciudad'], 'exist', 'skipOnError' => true, 'targetClass' => Ciudades::className(), 'targetAttribute' => ['idciudad' => 'idciudad']],
            [['tipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoId::className(), 'targetAttribute' => ['tipo_id' => 'id']],
            [['usuariocreacion'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuariocreacion' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idtercero' => 'Idtercero',
            'identificacion' => 'Documento',
            'digitoverificacion' => 'Digito de verificacion',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'telefono' => 'Telefono',
            'direccion' => 'Direccion',
            'idciudad' => 'Ciudad',
            'tipo_id' => 'Tipo Documento',
            'razon_social' => 'Razon Social',
            'usuariocreacion' => 'Usuariocreación',
            'fecha_creacion' => 'Fecha Creacion',           
            'anotaciones' => 'Anotaciones',
            
        ];
    }


    public function verificar_nit($attribute, $params){
        if($this->tipo_id==3 )
        {
          if(empty($this->digitoverificacion))
          {
            $this->addError('digitoverificacion', "Digito de verificacion es obligatorio"); 
          }
          if(empty($this->razon_social))
          {
            $this->addError('razon_social', "Razon social de verificacion es obligatorio");
          }
          
        }else
        {
           if(empty($this->nombre))
          {
            $this->addError('nombre', "Nombre de verificacion es obligatorio"); 
          }
          if(empty($this->apellido))
          {
            $this->addError('apellido', "Apellido de verificacion es obligatorio");
          } 
        }
            
    }

    public function beforeSave($insert)
  {
      if (parent::beforeSave($insert)) 
      {
        if($insert)
        {
          $this->nombre = strtoupper($this->nombre );
          $this->apellido = strtoupper($this->apellido );
          $this->razon_social = strtoupper($this->razon_social );
          $this->direccion = strtoupper($this->direccion );
          $this->usuariocreacion = Yii::$app->user->identity->id;
          $this->fecha_creacion = new \yii\db\Expression('NOW()');
          $this->fecha_actualizacion = new \yii\db\Expression('NOW()');
         
        }
        else{
          $this->nombre = strtoupper($this->nombre );
          $this->apellido = strtoupper($this->apellido );
          $this->razon_social = strtoupper($this->razon_social );
          $this->direccion = strtoupper($this->direccion );
          $this->usuariocreacion = Yii::$app->user->identity->id;
          $this->fecha_actualizacion = new \yii\db\Expression('NOW()');          
        }
        return true;
      }
      return false;  
  }      
          
  public static function buscarmodelo($id){
        $tercero= Terceros::findOne($id);
        if($tercero !== null)
        {   
            $tercero->idanulo=1;
            $tercero->save();
            return true;
        }
        return false;
    }      
        
      
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleReciboCajas()
    {
        return $this->hasMany(DetalleReciboCaja::className(), ['idtercero' => 'idtercero']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetallesComprobanteEgresos()
    {
        return $this->hasMany(DetallesComprobanteEgreso::className(), ['idtercero' => 'idtercero']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCiudad()
    {
        return $this->hasOne(Ciudades::className(), ['idciudad' => 'idciudad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipo()
    {
        return $this->hasOne(TipoId::className(), ['id' => 'tipo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuariocreacion0()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuariocreacion']);
    }
        
}
