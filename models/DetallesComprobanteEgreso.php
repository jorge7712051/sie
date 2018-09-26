<?php

namespace app\models;

use Yii;
use app\models\Bancos;
use app\models\Caja;

/**
 * This is the model class for table "detalles_comprobante_egreso".
 *
 * @property string $iddetalle
 * @property int $idtercero
 * @property double $valor
 * @property string $idcomprobanteegreso
 * @property int $idconcepto
 * @property string $fechacreacion
 * @property string $adjunto
 * @property double $subtotal
 * @property double $total
 *
 * @property ComprobanteEgreso $comprobanteegreso
 * @property Concepto $concepto
 * @property Terceros $tercero
 */
class DetallesComprobanteEgreso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $cedulatercero = '';
    public $nombre = '';
    public $porcentaje = '';
    public $comprobante;
    public $contraparte = '';
    public $ruta;
    public $marcaciondoble;
    public $piso;
    public $doble;
    public $adjobligatorio;
    public static function tableName()
    {
        return 'detalles_comprobante_egreso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'valor','idtercero', 'idconcepto', 'adjunto', 'subtotal', 'total','contraparte'], 'required'],
            [['idtercero', 'idcomprobanteegreso', 'idconcepto'], 'integer'],
            [['valor', 'subtotal', 'total'], 'number'],
            [['adjobligatorio'],'required','on'=>'create'],
            [['fechacreacion'], 'safe'],
            [['adjunto'], 'string', 'max' => 400],
            [['comprobante'], 'required', 'when' => function ($model) {
                  return $model->adjobligatorio == 0;
            }, 'whenClient' => "function (attribute, value) {
                return $('#detallescomprobanteegreso-adjobligatorio').val() == '0';
     }",'on' =>'create'],
            [['comprobante'],'file',//Error
                                'maxSize' => 2048*1024*1, //1 MB
                                'tooBig' => 'El tamaño máximo permitido es 2MB', //Error
                                'extensions' => 'pdf, png, jpg',
                                'wrongExtension' => 'El archivo {file} no contiene una extensión permitida {extensions}', //Error
            ],
             [['doble'],'boolean'],
            [['idcomprobanteegreso'], 'exist', 'skipOnError' => true, 'targetClass' => ComprobanteEgreso::className(), 'targetAttribute' => ['idcomprobanteegreso' => 'idcomprobante']],
            [['idconcepto'], 'exist', 'skipOnError' => true, 'targetClass' => Concepto::className(), 'targetAttribute' => ['idconcepto' => 'idconcepto']],
            [['idtercero'], 'exist', 'skipOnError' => true, 'targetClass' => Terceros::className(), 'targetAttribute' => ['idtercero' => 'idtercero']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iddetalle' => 'Iddetalle',
            'idtercero' => 'Tercero ',
            'valor' => 'Valor Base',
            'idcomprobanteegreso' => 'Comprobante Egreso',
            'idconcepto' => 'Concepto',
            'fechacreacion' => 'Fechacreacion',
            'adjunto' => 'Adjunto',
            'subtotal' => 'Retención',
            'total' => 'Total',
            'cedulatercero'=>'Identificacion Tercero'
        ];
    }

    public function validaradj($attribute, $params)
    {
        $a=0;
        if($a==1)
        {
            return true;
        }
         

        $this->addError($attribute, "Adjunto es requerido");     
    }
    
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if($insert)
        {
            $request = Yii::$app->request; 
            $idcom = $request->get('id');  
            $this->idcomprobanteegreso= base64_decode($idcom);
            $this->fechacreacion = new \yii\db\Expression('NOW()');         
        }
        
        return true;
        }
        return false;
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->comprobante->saveAs('archivos/' . $this->ruta . '.' . $this->comprobante->extension);
            return true;
        } else {
            return false;
        }
    }


    public function afterSave($insert, $changedAttributes)
    {
    
        if($insert)
        {
            $model= new Bancos();
            $modelo= new Caja();
            if($this->contraparte==1 && $this->doble==0)
            {
                $model->valor_egreso=$this->valor;
                $model->idcomprobante=$this->iddetalle;
                $model->save();
            }
            if($this->contraparte==2 && $this->doble==0)
            {
                $modelo->valor_egreso=$this->valor;
                $modelo->idcomprobante=$this->iddetalle;
                $modelo->save();
            }
            if($this->contraparte==1 && $this->doble==1)
            {
                $model->valor_egreso=$this->valor;
                $model->idcomprobante=$this->iddetalle;
                $model->save();
                $modelo->valor_ingreso=$this->valor;
                $modelo->idcomprobante=$this->iddetalle;
                $modelo->save();
            }
            if($this->contraparte==2 && $this->doble==1)
            {
                $model->valor_ingreso=$this->valor;
                $model->idcomprobante=$this->iddetalle;
                $model->save();
                $modelo->valor_egreso=$this->valor;
                $modelo->idcomprobante=$this->iddetalle;
                $modelo->save();
            } 
            return true;       
        }
        else
        {
            $model= new Bancos();
            $modelo= new Caja();
            Bancos::deleteAll("idcomprobante=:id", [":id" => $this->iddetalle]);
            Caja::deleteAll("idcomprobante=:id", [":id" => $this->iddetalle]);
            
            if($this->contraparte==1 && $this->doble==0)
            {
                $model->valor_egreso=$this->valor;
                $model->idcomprobante=$this->iddetalle;
                $model->save();
            }
            if($this->contraparte==2 && $this->doble==0)
            {
                $modelo->valor_egreso=$this->valor;
                $modelo->idcomprobante=$this->iddetalle;
                $modelo->save();
            }
            if($this->contraparte==1 && $this->doble==1)
            {
                $model->valor_egreso=$this->valor;
                $model->idcomprobante=$this->iddetalle;
                $model->save();
                $modelo->valor_ingreso=$this->valor;
                $modelo->idcomprobante=$this->iddetalle;
                $modelo->save();
            }
            if($this->contraparte==2 && $this->doble==1)
            {
                $model->valor_ingreso=$this->valor;
                $model->idcomprobante=$this->iddetalle;
                $model->save();
                $modelo->valor_egreso=$this->valor;
                $modelo->idcomprobante=$this->iddetalle;
                $modelo->save();
            } 
            return true;    
             
        }
        
   
        return false;
    }

    public function getImageurl()
    {
        $ruta=Url::home(true);
        return $ruta.$this->adjunto;
    }

    public function getImagenDocumento()
    {
        $ruta=Url::home(true);
        return $ruta."archivos/carpeta_archivos.png";
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComprobanteegreso()
    {
        return $this->hasOne(ComprobanteEgreso::className(), ['idcomprobante' => 'idcomprobanteegreso']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConcepto()
    {
        return $this->hasOne(Concepto::className(), ['idconcepto' => 'idconcepto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTercero()
    {
        return $this->hasOne(Terceros::className(), ['idtercero' => 'idtercero']);
    }
}
