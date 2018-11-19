<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
/**
 * This is the model class for table "recibo_caja".
 *
 * @property string $idrecibo
 * @property string $fecha
 * @property string $fecha_creacion
 * @property string $concepto
 * @property double $valor
 * @property int $bloqueo
 * @property int $idcentrocostos
 * @property string $adjunto
 * @property int $idanulo
 * @property string $codigo
 *
 * @property DetalleReciboCaja[] $detalleReciboCajas
 */
class ReciboCaja extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $comprobante;
    public $ruta;

    public static function tableName()
    {
        return 'recibo_caja';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idrecibo', 'fecha',  'concepto', 'valor', 'idcentrocostos'], 'required'],
            [['idrecibo', 'bloqueo', 'idcentrocostos', 'idanulo'], 'integer'],
            [['idrecibo'], 'unique','on'=>'create'],         
            [['comprobante'], 'required', 'on' =>'create'],
            [['fecha'], 'validar_fecha', 'on' => 'update'],
            [['idrecibo'], 'validar_id', 'on'=>'update'],
            [['fecha', 'fecha_creacion'], 'safe'],
            [['valor'], 'number'],
            [['concepto'], 'string', 'max' => 50],
            [['adjunto'], 'string', 'max' => 400],
            [['codigo'], 'string', 'max' => 5],
            [['idrecibo'], 'unique'],
            [['comprobante'], 'required', 'on' =>'create'],
            [['comprobante'],'file',//Error
                                'maxSize' => 2048*1024*1, //1 MB
                                'tooBig' => 'El tamaño máximo permitido es 2MB', //Error
                                'extensions' => 'pdf, png, jpg',
                                'wrongExtension' => 'El archivo {file} no contiene una extensión permitida {extensions}', //Error
            ],
             [['idrecibo'], 'match','pattern'=>"/^[0-9]{6}$/",'message' => 'Numero de recibo de caja invalido '],
             [['idcentrocostos'], 'exist', 'skipOnError' => true, 'targetClass' => CentroCostos::className(), 'targetAttribute' => ['idcentrocostos' => 'idcentrocostos']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idrecibo' => 'Numero recibo',
            'fecha' => 'Fecha',
            'fecha_creacion' => 'Fecha Creacion',
            'concepto' => 'Concepto',
            'valor' => 'Valor',
            'bloqueo' => 'Bloqueo',
            'idcentrocostos' => 'Iglesia',
            'adjunto' => 'Adjunto',
            'idanulo' => 'Idanulo',
            'codigo' => 'Codigo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
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
    public function validar_fecha($attribute, $params)
    {
        $request = Yii::$app->request; 
        $model = ReciboCaja::findOne($request->get('id'));
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

    public function getImageurl()
    {
        $ruta=Url::home(true);
        return $ruta.$this->adjunto;
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

    public function getImagenDocumento()
    {
        $ruta=Url::home(true);
        return $ruta."archivos/carpeta_archivos.png";
    }
  
    public static function Seguridadfecha($hoy)
    {
        $request = Yii::$app->request; 
        $model = ReciboCaja::findOne($request->get('id'));
        $fecha1=explode("-", $model->fecha);       
        $a =$fecha1[0]."-".$fecha1[1];      
         if($a==$hoy)
        {
            return true;
        }
        return false;
    }

    public function validar_id($attribute, $params)
    {
        $request = Yii::$app->request; 
        $id = $request->get('id');  
        if($this->idrecibo == $id)
        {
            return true;
        }
        $this->addError($attribute, "El numero no coincide");
    }

    public function getDetalleReciboCajas()
    {
        return $this->hasMany(DetalleReciboCaja::className(), ['idrecibocaja' => 'idrecibo']);
    }
}
