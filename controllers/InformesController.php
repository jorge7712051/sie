<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Informes;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\web\Response;
use app\models\User;
use yii\db\ActiveQuery;
use kartik\mpdf\Pdf;
use app\models\CentroCostos;
use app\models\Area;
/**
 * TercerosController implements the CRUD actions for Terceros model.
 */
class InformesController extends Controller
{
    /**
     * {@inheritdoc}
     */
     public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        //El administrador tiene permisos sobre las siguientes acciones
                        'actions' => ['create','index'],
                        //Esta propiedad establece que tiene permisos
                        'allow' => true,
                        //Usuarios autenticados, el signo ? es para invitados
                        'roles' => ['@'],
                        //Este método nos permite crear un filtro sobre la identidad del usuario
                        //y así establecer si tiene permisos o no
                        'matchCallback' => function ($rule, $action) {
                            //Llamada al método que comprueba si es un administrador
                            return User::isUserAdmin(Yii::$app->user->identity->id);
                        },
                    ],
                    [
                       //Los usuarios simples tienen permisos sobre las siguientes acciones
                       'actions' => ['create','index'],
                       //Esta propiedad establece que tiene permisos
                       'allow' => true,
                       //Usuarios autenticados, el signo ? es para invitados
                       'roles' => ['@'],
                       //Este método nos permite crear un filtro sobre la identidad del usuario
                       //y así establecer si tiene permisos o no
                       'matchCallback' => function ($rule, $action) {
                          //Llamada al método que comprueba si es un usuario simple
                          return User::isUserSimple(Yii::$app->user->identity->id);
                      },
                   ],
                ],
            ],
     //Controla el modo en que se accede a las acciones
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Terceros models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Informes(['scenario' => 'informe']);
$datos= array();
if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
{
    Yii::$app->response->format = Response::FORMAT_JSON;
    return ActiveForm::validate($model);
}
if ($model->load(Yii::$app->request->post()))
{
    if($model->validate())
    {
    $fecha1=explode("-", $model->fecha);
    $ano=$fecha1[0];
    $nextmes=$fecha1[1]+1;
    $nextmes=$this->mes($nextmes);
    $mes=$this->mes($fecha1[1]);
    $nombre=$this->getcentrocostos($model->centro_costos);
    $datos['diezmo']=$this->ingresoscaja($model->fecha,'recibo_caja_caja',$model->centro_costos,'1');
    $datos['diezmobanco']=$this->ingresoscaja($model->fecha,'recibo_caja_banco',$model->centro_costos,'1');
   $datos['ofrenda']=$this->ingresoscaja($model->fecha,'recibo_caja_caja',$model->centro_costos,'2');
   $datos['ofrendabanco']=$this->ingresoscaja($model->fecha,'recibo_caja_banco',$model->centro_costos,'2');
   $datos['otros']=$this->totalotros($model->fecha,'recibo_caja_caja',$model->centro_costos,'1','2');
   $datos['otrosbanco']=$this->totalotros($model->fecha,'recibo_caja_banco',$model->centro_costos,'1','2');
   $otros=$this->ingresoscomprobante($model->fecha,'comprobante_caja',$model->centro_costos);
   $otrosbanco=$this->ingresoscomprobante($model->fecha,'comprobante_banco',$model->centro_costos);
   $fechaanterior=$this->fechaanterior($model->fecha);
   $datos['otros']+=$otros;
   $datos['otrosbanco']+=$otrosbanco;
   $datos['cajamesant']=$this->cajamesant($fechaanterior,$model->centro_costos);
   $datos['bancosmesant']=$this->bancomesant($fechaanterior,$model->centro_costos);
   $totalcaja=$datos['otros']+ $datos['ofrenda']+$datos['diezmo'];
   $totalbanco=$datos['otrosbanco']+ $datos['ofrendabanco']+$datos['diezmobanco'];
    $datos['cajadisponible']=$datos['cajamesant']+$totalcaja;
    $datos['bancodisponible']=$datos['bancosmesant']+$totalbanco;
    $datos['egresocaja']=$this->egresoscaja($model->fecha,'recibo_caja_caja',$model->centro_costos);
    $datos['egresobanco']=$this->egresoscaja($model->fecha,'recibo_caja_banco',$model->centro_costos);
    $datos['egresocajacom']=$this->egresoscomprobantecaja($model->fecha,'comprobante_caja',$model->centro_costos);
     $datos['egresobancocom']=$this->egresoscomprobantecaja($model->fecha,'comprobante_banco',$model->centro_costos);
    $datos['egresocaja']+=$datos['egresocajacom'];
    $datos['egresobanco']+=$datos['egresobancocom'];
    $datos['cajafinal']=$datos['cajadisponible']-$datos['egresocaja'];
    $datos['bancofinal']=$datos['bancodisponible']-$datos['egresobanco'];
    $datos['diezmo']=$this->mision($model->fecha,'comprobante_caja',$model->centro_costos,'4')+
    $this->mision($model->fecha,'comprobante_banco',$model->centro_costos,'4');
    $datos['cuatro']=$this->mision($model->fecha,'comprobante_caja',$model->centro_costos,'5')+
    $this->mision($model->fecha,'comprobante_banco',$model->centro_costos,'5');
    $datos['bonos']=$this->mision($model->fecha,'comprobante_caja',$model->centro_costos,'6')+
    $this->mision($model->fecha,'comprobante_banco',$model->centro_costos,'6');
    $datos['totalmision']= $datos['cuatro']+ $datos['bonos']+$datos['diezmo'];
    $datos['egresocaja']-=$datos['totalmision'];
    $datos['egresostotales']=$datos['totalmision']+$datos['egresocaja'];
    $content="
    <div class='row'>
        <div class='col-xs-12'>
            <h3>INFORME MENSUAL DE TESORERIA IGLESIA EVANGELICA DISPULOS DE CRISTO</h3>
        </div>
    </div>
    <div class='row'>
        <div class='col-xs-4'>
            <span>CONGREGACION</span>
        </div>
        <div class='col-xs-4'>
            <span>".$nombre."</span>
        </div>
        <div class='col-xs-4'>
            <span><strong>FECHA: </strong></span>
            <span >".$mes." DEL ".$ano." </span>
        </div>
    </div>
    <div class='row'>
        <div class='col-xs-12'>
            <h5><strong>MOVIMIENTO CAJA<strong></h5>
        </div>
    </div>
    <div class='row'>
        <div class='col-xs-6'>
            <span><strong>1.</strong> INGRESO DIEZMOS EN CAJA</span>
        </div>
        <div class='col-xs-3 borde-abajo'>
        <span>$ ".$datos['diezmo']."</span>
        </div>
    </div>
    <div class='row'>
        <div class='col-xs-6'>
            <span><strong>2.</strong> INGRESO OFRENDAS EN CAJA</span>
        </div>
        <div class='col-xs-3 borde-abajo'>
            <span >$ ". $datos['ofrenda']."</span>
        </div>
    </div>
    <div class='row'>
        <div class='col-xs-6'>
            <span><strong>3.</strong> OTROS OFRENDAS EN CAJA</span>
        </div>
        <div class='col-xs-3  borde-abajo'>
            <span>$ ".$datos['otros']."</span>
        </div> 
    </div>
    <div class='row'>
        <div class='col-xs-6 centro'>
            <span><strong>TOTAL INGRESO EN CAJA</strong></span>
        </div>
        <div class='col-xs-offset-3  col-xs-3 borde-abajo'>
            <span>$ ".$totalcaja."</span>
        </div>
    </div>
    <div class='row'>
        <div class='col-xs-6'>
            <span><strong>4.</strong> SALDO ANTERIOR EN CAJA </span>
        </div>
        <div class='col-xs-3 borde-abajo'>
            <span>$ ".$datos['cajamesant']."</span>
        </div>
    </div>
    <div class='row'>
        <div class='col-xs-6 centro'>
            <span ><strong>TOTAL DISPONIBLE EN CAJA</strong></span>
        </div>
        <div class='col-xs-3 borde-abajo col-xs-offset-3 '>
            <span >$ ".$datos['cajadisponible']."</span>
        </div>
    </div>
    <div class='row'>
        <div class='col-xs-6 centro'>
            <span ><strong>TOTAL GASTO DE CAJA</strong></span>
        </div>
        <div class='col-xs-3 borde-abajo col-xs-offset-3 '>
            <span>$ -".$datos['egresocaja']."</span>
        </div>
    </div>
    <div class='row'>
        <div class='col-xs-6 centro'>
            <span ><strong>ENVIADO A LA MISION</strong></span>
        </div>
        <div class='col-xs-3 borde-abajo col-xs-offset-3 '>
            <span>$ -".$datos['totalmision']."</span>
        </div>
    </div>
    <div class='row'>
        <div class='col-xs-6'>
            <span ><strong>5.</strong> DIEZMO</span>
        </div>
        <div class='col-xs-3 borde-abajo '>
            <span>$ ".$datos['diezmo']."</span>
        </div>
    </div>
    <div class='row'>
        <div class='col-xs-6'>
            <span ><strong>6.</strong> 4% ENIVIADO A LA MISION</span>
        </div>
        <div class='col-xs-3 borde-abajo '>
            <span>$ ".$datos['cuatro']."</span>
        </div>
    </div>
    <div class='row'>
        <div class='col-xs-6'>
            <span ><strong>7.</strong> OFRENDAS (BONOS-OTROS)</span>
        </div>
        <div class='col-xs-3 borde-abajo '>
            <span>$ ".$datos['bonos']."</span>
        </div>
    </div>
    <div class='row'>
        <div class='col-xs-9'>
            <span ><strong>TOTAL GENERAL DE EGRESOSO DE CAJA (Total de gastos + total enviado a la misión)</strong></span>
        </div>
        <div class='col-xs-3 borde-abajo '>
            <span>$ -".$datos['egresostotales']."</span>
        </div>
    </div>
    <div class='row'>
        <div class='col-xs-8 centro'>
            <span ><strong>SALDO FINAL EN CAJA</strong></span>
        </div>
        <div class='col-xs-4 borde-abajo '>
            <span><strong>$ ".$datos['cajafinal']."</strong></span>
        </div>
    </div>
    <div class='row'>
        <div class='col-xs-12'>
            <h5><strong>MOVIMIENTO BANCOS<strong></h5>
        </div>
    </div>
    <div class='row'>
        <div class='col-xs-6'>
            <span><strong>1.</strong> INGRESO DIEZMOS EN BANCOS</span>
        </div>
        <div class='col-xs-3 borde-abajo '>
            <span>$ ".$datos['diezmobanco']."</span>
        </div>
    </div>
    <div class='row'>
        <div class='col-xs-6'>
            <span><strong>2.</strong> INGRESO OFRENDAS EN BANCOS</span>
        </div>
        <div class='col-xs-3 borde-abajo'>
            <span >$  ". $datos['ofrendabanco']."</span>
        </div>
    </div>
    <div class='row'>
        <div class='col-xs-6'>
            <span><strong>3.</strong> OTROS INGRESOS EN BANCOS</span>
        </div>
        <div class='col-xs-3 borde-abajo'>
            <span >$ ".$datos['otrosbanco']."</span>
        </div> 
    </div>
    <div class='row'>
        <div class='col-xs-6 centro'>
            <span ><strong>TOTAL INGRESO EN BANCOS</strong></span>
        </div>
        <div class='col-xs-3 borde-abajo col-xs-offset-3 '>
            <span >$ ".$totalbanco."</span>
        </div>
    </div>
    <div class='row'>
        <div class='col-xs-6'>
            <span><strong>4.</strong> SALDO ANTERIOR EN BANCOS </span>
        </div>
        <div class='col-xs-3  borde-abajo'>
            <span>$ ". $datos['bancosmesant']."</span>
        </div>
    </div>
    <div class='row'>
        <div class='col-xs-6 centro'>
            <span ><strong>TOTAL DISPONIBLE EN BANCOS</strong></span>
        </div>
        <div class='col-xs-3 borde-abajo col-xs-offset-3'>
            <span>$ ".$datos['bancodisponible']."</span>
        </div>
    </div>
    <div class='row'>
        <div class='col-xs-6 centro'>
            <span><strong>TOTAL GASTO EN BANCOS</strong></span>
        </div>
        <div class='col-xs-3 borde-abajo col-xs-offset-3'>
            <span>$ -".$datos['egresobanco']."</span>
        </div>
    </div>
    <div class='row'>
        <div class='col-xs-6 centro'>
            <span ><strong>SALDO FINAL EN BANCOS</strong></span>
        </div>
        <div class='col-xs-3 borde-abajo col-xs-offset-3'>
            <span><strong>$ ".$datos['bancofinal']."</strong></span>
        </div>
    </div>
    <div class='row colorbajo'>
        <div class='col-xs-9'>
            <span><strong>DISPONIBLE EN CAJA PARA EL MES DE : ".$nextmes."</strong></span>
        </div>
        
        <div class='col-xs-3 borde-abajo '>
            <span><strong>$ ".$datos['cajafinal']."</strong></span>
        </div>
    </div>
    <div class='row colorbajo'>
        <div class='col-xs-9'>
            <span><strong>DISPONIBLE EN BANCO PARA EL MES DE : ".$nextmes."</strong></span>
        </div>
        <div class='col-xs-3 borde-abajo '>
            <span><strong>$ ".$datos['bancofinal']."</strong></span>
        </div>
    </div>
";
        $pdf=$this->generarpdf($content);
        return $pdf->render();
            }
         } 
        return $this->render('index', [
                       'model' => $model
            ]);
    }


public function actionCreate()
{

     $model = new Informes( ['scenario' => 'create']);
     $data=$this->getareas();
     if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ActiveForm::validate($model);
    }
    if ($model->load(Yii::$app->request->post()))
    {   
        if($model->validate())
        {           
            $contenido=$this->cabecera($model->fecha_inicio,$model->fecha_fin);            
            $contenido.='<tbody></tbody></table>';
            return $this->render('informe', [
                    'model' => $model,
                    'contenido'=>$contenido
                   
            ]);
       } 
    }
    $contenido='prueba';
    return $this->render('informe', [
                       'contenido'=>$contenido,
                       'model' => $model
            ]);
}
    /**
     * Displays a single Terceros model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
       /**
     * Creates a new Terceros model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
public function cabecera($fecha_inicio,$fecha_fin)
{
    $inicio=explode("-", $fecha_inicio);
    $fin=explode("-", $fecha_fin);
    $contenido='<table class="table"><thead><tr>';
    if($inicio[0]==$fin[0])
    {
        for ($i=$inicio[1]; $i <=$fin[1] ; $i++) { 
            $mes=  $this->mes($i);
            $contenido.='<th scope="col">'.$mes.' de '.$fin[0].'</th>';
     
                }
     $contenido.='</tr></thead>';    
    }
    else{
        for ($i=$inicio[1]; $i <=12 ; $i++) { 
            $mes=  $this->mes($i);
            $contenido.='<th scope="col">'.$mes.' DEL '.$inicio[0].'</th>';     
                }
        for ($i=1; $i <=$fin[1] ; $i++) { 
            $mes=  $this->mes($i);
            $contenido.='<th scope="col">'.$mes.' DEL '.$fin[0].'</th>';     
                }    

    }
     return $contenido;
    
}
public function getareas()
{
   $query = Area::find();
   $query->where('idanulo=0')->asArray()->all();
   return $query;
    
}

public function mes($fecha)
{
    if($fecha==13){$fecha=1;}
    
    switch($fecha) {
            case "01" : $mes= "ENERO";
                        break;
            case "02" : $mes= "FEBREROS";
                        break;
            case "03" : $mes= "MARZO";
                        break;
            case "04" : $mes= "ABRIL";
                       break;
            case "05" : $mes= "MAYO";
                        break;
            case "06" : $mes= "JUNIO";
                        break;
            case "07" : $mes= "JULIO";
                        break;
            case "08" : $mes= "AGOSTOS";
                        break;
            case "09" : $mes= "SEPTIEMBRE";
                        break;
            case "10" : $mes= "OCTUBRE";
                        break;
            case "11" : $mes= "NOVIEMBRE";
                        break;
            case "12" : $mes="DICIEMBRE";
            break;
             }
    return $mes  ;
          
}

   public function generarpdf($content)
{
    $pdf = new Pdf([
    'mode' => Pdf::MODE_BLANK,
    'filename' => 'reporte_' . date('d-m-Y_his') . '.pdf',
    'format' => Pdf::FORMAT_A4,
    'orientation' => Pdf::ORIENT_PORTRAIT,
    'destination' => Pdf::DEST_DOWNLOAD  ,   
    'content' => $content,
    'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
    'cssInline' => '.kv-heading-1{font-size:10px} h3,h5{ text-align: center; }
    .decoracion{ text-decoration: underline;}
    h5{background: #cce5ff;padding: 5px;}
    .colorbajo{background: #cce5ff;padding: 5px;}
    .col-xs-4 { width: 33.33333333%; }
    .col-xs-1, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9, .col-xs-10, .col-xs-11, .col-xs-12 {
        float: left;
    }
    .col-xs-offset-3 {margin-left: 25%;}
    .col-xs-6 {width: 50%;}
    .col-xs-3 { width: 25%;}
    .borde-abajo{ border-bottom: 1px solid black;}
    span{font-size:13px;}
    .row{margin-bottom: 8px;}
    .centro{ text-align: center;}
    .col-xs-offset-4 { margin-left: 33.33333333%;}
    .col-xs-9 { width: 75%;}
    .col-xs-8 {width: 66.66666667%;}',
    'options' => ['title' => 'Krajee Report Title',                
                'SetWatermarkImage'=>'../web/img/logo.png',
                'showWatermarkText' => true,
                'showWatermarkImage' => true,
    ],
     'methods' => [
     'SetWatermarkText' => 'VERIFICADO',
     'SetWatermarkImage' =>  '../web/img/logo.png',
     'SetHeader'=>['Disipulos de cristo'],
     'SetFooter'=>['{PAGENO}'],
   ]
 ]);
 return $pdf; 
}

    /**
     * Updates an existing Terceros model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function ingresoscaja($fecha,$tabla,$centro_costos,$concepto)
    {
        $out = (new \yii\db\Query())
        ->select([new \yii\db\Expression('*')])
        ->from($tabla)
        ->where('idtipoingreso='.$concepto)        
        ->andWhere("fecha >='".$fecha."-01'")
        ->andWhere("fecha <='".$fecha."-30'")
        ->andWhere("idcentrocostos = ".$centro_costos)
        ->sum('valor_ingreso');
        if($out==null)
        {
            return 0;
        }
        return $out;
    }

    public function mision($fecha,$tabla,$centro_costos,$concepto)
    {
        $out = (new \yii\db\Query())
        ->select([new \yii\db\Expression('*')])
        ->from($tabla)
        ->where('idconcepto='.$concepto)        
        ->andWhere("fecha >='".$fecha."-01'")
        ->andWhere("fecha <='".$fecha."-30'")
        ->andWhere("idcentrocostos = ".$centro_costos)
        ->sum('valor_egreso');
        if($out==null)
        {
            return 0;
        }
        return $out;
    }

    public function ingresosmesanterior($fecha,$tabla,$centro_costos,$concepto)
    {
        $out = (new \yii\db\Query())
        ->select([new \yii\db\Expression('*')])
        ->from($tabla)
        ->where('idtipoingreso='.$concepto)     
        ->andWhere("fecha <='".$fecha."-30'")
        ->andWhere("idcentrocostos = ".$centro_costos)
        ->sum('valor_ingreso');
        if($out==null)
        {
            return 0;
        }
        return $out;
    }

    public function ingresoscomprobante($fecha,$tabla,$centro_costos)
    {
        $out = (new \yii\db\Query())
        ->select([new \yii\db\Expression('*')])
        ->from($tabla)
        ->where("fecha >='".$fecha."-01'")
        ->andWhere("fecha <='".$fecha."-30'")
        ->andWhere("idcentrocostos = ".$centro_costos)
        ->sum('valor_ingreso');
        if($out==null)
            {
                return 0;
            }
        return $out;
       
    }

     public function ingresoscomprobanteanterior($fecha,$tabla,$centro_costos)
    {
        $out = (new \yii\db\Query())
        ->select([new \yii\db\Expression('*')])
        ->from($tabla)
        ->where("fecha <='".$fecha."-30'")
        ->andWhere("idcentrocostos = ".$centro_costos)
        ->sum('valor_ingreso');
        if($out==null)
            {
                return 0;
            }
        return $out;
       
    }

    public function getcentrocostos($centrocostos)
    {
        $consulta=CentroCostos::find()->where('idcentrocostos='.$centrocostos)->all();        
        return $consulta[0]['centrocostos'];
    }

    public function egresoscomprobantecaja($fecha,$tabla,$centro_costos)
    {
        $out = (new \yii\db\Query())
        ->select([new \yii\db\Expression('*')])
        ->from($tabla)
        ->where("fecha >='".$fecha."-01'")
        ->andWhere("fecha <='".$fecha."-30'")
        ->andWhere("idcentrocostos = ".$centro_costos)
        ->sum('valor_egreso');
        if($out==null)
        {
            return 0;
        }
        return $out;       
    }

    public function egresoscaja($fecha,$tabla,$centro_costos)
    {
        $out = (new \yii\db\Query())
        ->select([new \yii\db\Expression('*')])
        ->from($tabla)
        ->where("fecha >='".$fecha."-01'")
        ->andWhere("fecha <='".$fecha."-30'")
        ->andWhere("idcentrocostos = ".$centro_costos)
        ->sum('valor_egreso');
        if($out==null)
        {
            return 0;
        }
        return $out;       
    }
    public function egresosmesanterior($fecha,$tabla,$centro_costos)
    {
        $out = (new \yii\db\Query())
        ->select([new \yii\db\Expression('*')])
        ->from($tabla)
        ->where("fecha <='".$fecha."-30'")
        ->andWhere("idcentrocostos = ".$centro_costos)
        ->sum('valor_egreso');
        if($out==null)
        {
            return 0;
        }
        return $out;       
    }

    public function totalotros($fecha,$tabla,$centro_costos,$concepto1,$concepto2)
    {
        $out = (new \yii\db\Query())
        ->select([new \yii\db\Expression('*')])
        ->from($tabla)
        ->where('idtipoingreso !='.$concepto1)
        ->andWhere('idtipoingreso !='.$concepto2)       
        ->andWhere("fecha >='".$fecha."-01'")
        ->andWhere("fecha <='".$fecha."-30'")
        ->andWhere("idcentrocostos = ".$centro_costos)
        ->sum('valor_ingreso');
        if($out==null)
        {
            return 0;
        }
        return $out;      
    }
     public function totalotrosanterior($fecha,$tabla,$centro_costos,$concepto1,$concepto2)
    {
        $out = (new \yii\db\Query())
        ->select([new \yii\db\Expression('*')])
        ->from($tabla)
        ->where('idtipoingreso !='.$concepto1)
        ->andWhere('idtipoingreso !='.$concepto2)       
        ->andWhere("fecha <='".$fecha."-30'")
        ->andWhere("idcentrocostos = ".$centro_costos)
        ->sum('valor_ingreso');
        if($out==null)
        {
            return 0;
        }
        return $out;      
    }

    public function cajamesant($fecha,$centrocostos)
    {
        $diezmo=$this->ingresosmesanterior($fecha,'recibo_caja_caja',$centrocostos,'1');
        $ofrenda=$this->ingresosmesanterior($fecha,'recibo_caja_caja',$centrocostos,'2');
        $otros=$this->totalotrosanterior($fecha,'recibo_caja_caja',$centrocostos,'1','2');
        $egresoscaja=$this->egresosmesanterior($fecha,'recibo_caja_caja',$centrocostos);
        $egresoscomcaja=$this->egresosmesanterior($fecha,'comprobante_caja',$centrocostos);
        $ingresoco=$this->ingresoscomprobanteanterior($fecha,'comprobante_caja',$centrocostos);
        $r=$diezmo+$ofrenda+$otros+$ingresoco-$egresoscaja-$egresoscomcaja;
        return $r;
    }

    public function bancomesant($fecha,$centrocostos)
    {
        $diezmo=$this->ingresosmesanterior($fecha,'recibo_caja_banco',$centrocostos,'1');
        $ofrenda=$this->ingresosmesanterior($fecha,'recibo_caja_banco',$centrocostos,'2');
        $otros=$this->totalotrosanterior($fecha,'recibo_caja_banco',$centrocostos,'1','2');
        $egresoscaja=$this->egresosmesanterior($fecha,'recibo_caja_banco',$centrocostos);
        $egresoscomcaja=$this->egresosmesanterior($fecha,'comprobante_banco',$centrocostos);
        $ingresoco=$this->ingresoscomprobanteanterior($fecha,'comprobante_banco',$centrocostos);
        $r=$diezmo+$ofrenda+$otros+$ingresoco-$egresoscaja-$egresoscomcaja;
        return $r;

    }

    /**
     * Deletes an existing Terceros model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */   


    public function fechaanterior($fecha)
    {
        $fecha1=explode("-", $fecha);
        if ($fecha1[1]==01)
        {
           $fecha1[0]=$fecha1[0]-1;
           $fecha2= $fecha1[0]."-12" ;
           return $fecha2; 

        }
        $fecha1[1]=$fecha1[1]-1 ;  
         $fecha2 =$fecha1[0]."-".$fecha1[1] ;          
        return $fecha2; 
    }
    /**
     * Finds the Terceros model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Terceros the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Terceros::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
