<?php

namespace app\models;
use app\models\Bancos;
use app\models\Caja;
use yii\helpers\Url;
use Yii;

/**
 * This is the model class for table "comprobante_egreso".
 *
 * @property string $idcomprobante
 * @property string $fecha_creacion
 * @property string $fecha
 * @property int $bloqueo
 * @property double $valor
 * @property string $idcentrocostos
 * @property string $adjunto
 * @property int $idanulo
 * @property string $codigo
 *
 * @property CentroCostos $centrocostos
 * @property DetallesComprobanteEgreso $detallesComprobanteEgreso
 */
class ComprobanteEgreso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
   
    public $comprobante;
    public $ruta;
    public static function tableName()
    {
        return 'comprobante_egreso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idcomprobante', 'fecha', 'valor', 'idcentrocostos'], 'required'],
            [['bloqueo', 'idcentrocostos', 'idanulo'], 'integer'],
            [['anulado'],'boolean'],
            [['fecha_creacion', 'fecha'], 'safe'],
            [['idcomprobante'], 'validar_id', 'on'=>'update'],
            [['fecha'], 'validar_fecha', 'on' => 'update'],
            [['valor'], 'number'],
            [['codigo'], 'string', 'max' => 5],
            [['idcomprobante'], 'unique','on'=>'create'],
            [['comprobante'], 'required', 'on' =>'create'],
            [['comprobante'],'file',//Error
                                'maxSize' => 2048*1024*1, //1 MB
                                'tooBig' => 'El tamaño máximo permitido es 2MB', //Error
                                'extensions' => 'pdf, png, jpg',
                                'wrongExtension' => 'El archivo {file} no contiene una extensión permitida {extensions}', //Error
            ],
            [['idcomprobante'], 'match','pattern'=>"/^[0-9]{6}$/",'message' => 'Numero de comprobant erroneo'],
            [['idcentrocostos'], 'exist', 'skipOnError' => true, 'targetClass' => CentroCostos::className(), 'targetAttribute' => ['idcentrocostos' => 'idcentrocostos']],
        ];
    }

    /**
     * {@inheritdoc}
     */

    public static function getTotal($provider, $columnName)
    {
    $total = 0;
    foreach ($provider as $item) {
      $total += $item[$columnName];
    }
    Yii::$app->formatter->locale = 'et-EE';                 
                
    return Yii::$app->formatter->asCurrency($total ,'USD'); 
    }
    public function validar_id($attribute, $params)
    {
        $request = Yii::$app->request; 
        $id = $request->get('id');  
        if($this->idcomprobante == $id)
        {
            return true;
        }
        $this->addError($attribute, "El numero no coincide");
    }

    public function validar_fecha($attribute, $params)
    {
        $request = Yii::$app->request; 
        $model = ComprobanteEgreso::findOne($request->get('id'));
        $fecha1=explode("-", $model->fecha);
        $fecha2=explode("-", $this->fecha);
        $a =$fecha1[0]."-".$fecha1[1];              
        $b =$fecha2[0]."-".$fecha2[1]; 
         if($a==$b)
        {
            return true;
        }
        $this->addError($attribute, "Fecha inconsistente");
    }

    public function attributeLabels()
    {
        return [
            'idcomprobante' => 'Numero comprobante',
            'fecha_creacion' => 'Fecha Creacion',
            'fecha' => 'Fecha',
            'bloqueo' => 'Bloqueo',
            'valor' => 'Valor',
            'idcentrocostos' => 'Iglesia',
            'adjunto' => 'Adjunto',
            'idanulo' => 'Idanulo',
            'codigo' => 'Codigo',
            'anulado' => 'Anulado',
        ];
    }


   public function beforeSave($insert)
   {
        if(parent::beforeSave($insert))
        {
            if($insert)
        {
            $this->fecha_creacion = new \yii\db\Expression('NOW()');         
        }
        
        return true;
        }
        return false;
    }

    /*public function afterSave($insert, $changedAttributes)
    {
    
        if($insert)
        {
            if($this->contraparte==1 && $this->anulado==0)
            {
                $model= new Bancos();
                $model->valor_egreso=$this->valor;
                $model->idcomprobante=$this->idcomprobante;
                $model->save();
            }
            if($this->contraparte==2 && $this->anulado==0)
            {
                $model= new Caja();
                $model->valor_egreso=$this->valor;
                $model->idcomprobante=$this->idcomprobante;
                $model->save();
            } 
            return true;       
        }
        else
        {
            $model= new Bancos();
            $model= new Caja();
            Bancos::deleteAll("idcomprobante=:id", [":id" => $this->idcomprobante]);
            Caja::deleteAll("idcomprobante=:id", [":id" => $this->idcomprobante]);
            
            if($this->contraparte==1 && $this->anulado==0)
            {
                $model= new Bancos();
                $model->valor_egreso=$this->valor;
                $model->idcomprobante=$this->idcomprobante;
                $model->save();
            }
            if($this->contraparte==2 && $this->anulado==0)
            {
                $model= new Caja();
                $model->valor_egreso=$this->valor;
                $model->idcomprobante=$this->idcomprobante;
                $model->save();
            } 
            return true;    
             
        }
        
   
        return false;
    }*/

    public function upload()
    {
        if ($this->validate()) {
            $this->comprobante->saveAs('archivos/' . $this->ruta . '.' . $this->comprobante->extension);
            return true;
        } else {
            return false;
        }
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
  
    public static function Seguridadfecha($hoy)
    {
        $request = Yii::$app->request; 
        $model = ComprobanteEgreso::findOne($request->get('id'));
        $fecha1=explode("-", $model->fecha);       
        $a =$fecha1[0]."-".$fecha1[1];      
         if($a==$hoy)
        {
            return true;
        }
        return false;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCentrocostos()
    {
        return $this->hasOne(CentroCostos::className(), ['idcentrocostos' => 'idcentrocostos']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetallesComprobanteEgreso()
    {
        return $this->hasOne(DetallesComprobanteEgreso::className(), ['idcomprobanteegreso' => 'idcomprobante']);
    }
}
