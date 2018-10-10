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
    public $cedulatercero = '';
    public $nombre = '';
    public $contraparte = '';
     public $doble;

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
            [['idtercero', 'valor', 'idtipoingreso','contraparte'], 'required'],
            [['idtercero', 'idtipoingreso', 'idrecibocaja'], 'integer'],
            [['valor'], 'number'],
            [['doble'],'boolean'],
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
            'idtercero' => 'Nombre Tercero',
            'valor' => 'Valor',
            'idtipoingreso' => 'Tipo de Ingreso',
            'idrecibocaja' => 'Idrecibocaja',
            'fechacreacion' => 'Fechacreacion',
            'cedulatercero'=> 'Nombre Tercero',
        ];
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if($insert)
        {
            $request = Yii::$app->request; 
            $idcom = $request->get('id');  
            $this->idrecibocaja= base64_decode($idcom);
            $this->fechacreacion = new \yii\db\Expression('NOW()');         
        }
        
        return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
    
        if($insert)
        {
            $model= new Bancos();
            $modelo= new Caja();
            if($this->contraparte==1 && $this->doble==0)
            {
                $model->valor_ingreso=$this->valor;
                $model->idcaja=$this->iddetalle_recibo;
                $model->save();
            }
            if($this->contraparte==2 && $this->doble==0)
            {
                $modelo->valor_ingreso=$this->valor;
                $modelo->idcaja=$this->iddetalle_recibo;
                $modelo->save();
            }
            if($this->contraparte==1 && $this->doble==1)
            {
                $model->valor_ingreso=$this->valor;
                $model->idcaja=$this->iddetalle_recibo;
                $model->save();
                $modelo->valor_egreso=$this->valor;
                $modelo->idcaja=$this->iddetalle_recibo;
                $modelo->save();
            }
            if($this->contraparte==2 && $this->doble==1)
            {
                $model->valor_egreso=$this->valor;
                $model->idcaja=$this->iddetalle_recibo;
                $model->save();
                $modelo->valor_ingreso=$this->valor;
                $modelo->idcaja=$this->iddetalle_recibo;
                $modelo->save();
            } 
            return true;       
        }
        else
        {
            $model= new Bancos();
            $modelo= new Caja();
            Bancos::deleteAll("idcaja=:id", [":id" => $this->iddetalle_recibo]);
            Caja::deleteAll("idcaja=:id", [":id" => $this->iddetalle_recibo]);
            
            if($this->contraparte==1 && $this->doble==0)
            {
                $model->valor_ingreso=$this->valor;
                $model->idcaja=$this->iddetalle_recibo;
                $model->save();
            }
            if($this->contraparte==2 && $this->doble==0)
            {
                $modelo->valor_ingreso=$this->valor;
                $modelo->idcaja=$this->iddetalle_recibo;
                $modelo->save();
            }
            if($this->contraparte==1 && $this->doble==1)
            {
                $model->valor_ingreso=$this->valor;
                $model->idcaja=$this->iddetalle_recibo;
                $model->save();
                $modelo->valor_egreso=$this->valor;
                $modelo->idcaja=$this->iddetalle_recibo;
                $modelo->save();
            }
            if($this->contraparte==2 && $this->doble==1)
            {
                $model->valor_egreso=$this->valor;
                $model->idcomprobante=$this->iddetalle_recibo;
                $model->save();
                $modelo->valor_ingreso=$this->valor;
                $modelo->idcomprobante=$this->iddetalle_recibo;
                $modelo->save();
            } 
            return true;    
             
        }
        
   
        return false;
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
