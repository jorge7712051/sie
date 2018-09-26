<?php

namespace app\models;
use app\models\Usuarios;
use Yii;

/**
 * This is the model class for table "centro_costos".
 *
 * @property string $idcentrocostos
 * @property string $centrocostos
 * @property int $idanulo
 *
 * @property ComprobanteEgreso[] $comprobanteEgresos
 */
class CentroCostos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'centro_costos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['centrocostos'], 'required'],
            [['idanulo'], 'integer'],
            [['centrocostos'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcentrocostos' => 'Id',
            'centrocostos' => 'Centro de costos',
            'idanulo' => 'Activo',
        ];
    }

    public static function buscarmodelo($id){
        
        $centro= CentroCostos::findOne($id);
        if($centro !== null)
        {   
            $usuarios=$centro->usuarios;
            
            $ids="";
            foreach($usuarios as $users)
        { 
            $ids = $ids . "," . $users->id;
        }

            $ids=trim($ids,",");     
            Usuarios::buscarmodelo($ids);
            $centro->idanulo=1;
            $centro->save();

            return true;
        }
        return false;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComprobanteEgresos()
    {
        return $this->hasMany(ComprobanteEgreso::className(), ['idcentrocostos' => 'idcentrocostos']);
    }
    public function getReciboCaja()
    {
        return $this->hasMany(ReciboCaja::className(), ['idcentrocostos' => 'idcentrocostos']);
    }
   public function getUsuarios()
    {
        return $this->hasMany(Usuarios::className(), ['centrocosto' => 'idcentrocostos']);
    }
}
