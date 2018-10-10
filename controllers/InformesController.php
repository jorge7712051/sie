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
        $model = new Informes();
        return $this->render('index', [
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
public function actionCreate()
{
$model = new Informes();
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
                $content="<div class='row'>
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
    <span><strong>FECHA:</strong></span>
    <span >$model->fecha </span>
    </div>
</div>
<div class='row'>
    <div class='col-xs-12'>
    <h5><strong>MOVIMIENTO CAJA<strong></h5>
    </div>
</div>
<div class='row'>
    <div class='col-xs-8'>
    <span><strong>1.</strong> INGRESO DIEZMOS EN CAJA</span>
    </div>
    <div class='col-xs-4'>
    <span class='decoracion'>$ ".$datos['diezmo']."</span>
    </div>
    <div class='col-xs-8'>
    <span><strong>2.</strong> INGRESO OFRENDAS EN CAJA</span>
    </div>
    <div class='col-xs-4'>
    <span class='decoracion'>$  ". $datos['ofrenda']."</span>
    </div>
    <div class='col-xs-8'>
    <span><strong>3.</strong> OTROS OFRENDAS EN CAJA</span>
    </div>
    <div class='col-xs-4'>
    <span class='decoracion'>$ ".$datos['otros']."</span>
    </div> 
</div>
<div class='row'>
    <div class='col-xs-8 centro'>
    <span ><strong>TOTAL INGRESO EN CAJA</strong></span>
    </div>
    <div class='col-xs-4'>
    <span class='decoracion'>$ ".$totalcaja."</span>
    </div>
</div>
<div class='row'>
    <div class='col-xs-8'>
    <span><strong>4.</strong> SALDO ANTERIOR EN CAJA </span>
    </div>
    <div class='col-xs-4'>
    <span class='decoracion'>$ ".$datos['cajamesant']."</span>
    </div>
</div>
<div class='row'>
    <div class='col-xs-8 centro'>
    <span ><strong>TOTAL DISPONIBLE EN CAJA</strong></span>
    </div>
    <div class='col-xs-4'>
    <span class='decoracion'>$ ".$datos['cajadisponible']."</span>
    </div>
</div>
<div class='row'>
    <div class='col-xs-8 centro'>
    <span ><strong>TOTAL GASTO EN CAJA</strong></span>
    </div>
    <div class='col-xs-4'>
    <span class='decoracion'>$ -".$datos['egresocaja']."</span>
    </div>
</div>
<div class='row'>
    <div class='col-xs-8 centro'>
    <span ><strong>SALDO FINAL EN CAJA</strong></span>
    </div>
    <div class='col-xs-4'>
    <span class='decoracion'><strong>$ ".$datos['cajafinal']."</strong></span>
    </div>
</div>
<div class='row'>
    <div class='col-xs-12'>
    <h5><strong>MOVIMIENTO BANCOS<strong></h5>
    </div>
</div>
<div class='row'>
    <div class='col-xs-8'>
    <span><strong>1.</strong> INGRESO DIEZMOS EN BANCOS</span>
    </div>
    <div class='col-xs-4'>
    <span class='decoracion'>$ ".$datos['diezmobanco']."</span>
    </div>
    <div class='col-xs-8'>
    <span><strong>2.</strong> INGRESO OFRENDAS EN BANCOS</span>
    </div>
    <div class='col-xs-4'>
    <span class='decoracion'>$  ". $datos['ofrendabanco']."</span>
    </div>
    <div class='col-xs-8'>
    <span><strong>3.</strong> OTROS OFRENDAS EN BANCOS</span>
    </div>
    <div class='col-xs-4'>
    <span class='decoracion'>$ ".$datos['otrosbanco']."</span>
    </div> 
</div>
<div class='row'>
    <div class='col-xs-8 centro'>
    <span ><strong>TOTAL INGRESO EN BANCOS</strong></span>
    </div>
    <div class='col-xs-4'>
    <span class='decoracion'>$ ".$totalbanco."</span>
    </div>
</div>
<div class='row'>
    <div class='col-xs-8'>
    <span><strong>4.</strong> SALDO ANTERIOR EN BANCOS </span>
    </div>
    <div class='col-xs-4'>
    <span class='decoracion'>$ ". $datos['bancosmesant']."</span>
    </div>
</div>
<div class='row'>
    <div class='col-xs-8 centro'>
    <span ><strong>TOTAL DISPONIBLE EN BANCOS</strong></span>
    </div>
    <div class='col-xs-4'>
    <span class='decoracion'>$ ".$datos['bancodisponible']."</span>
    </div>
</div>
<div class='row'>
    <div class='col-xs-8 centro'>
    <span ><strong>TOTAL GASTO EN BANCOS</strong></span>
    </div>
    <div class='col-xs-4'>
    <span class='decoracion'>$ -".$datos['egresobanco']."</span>
    </div>
</div>
<div class='row'>
    <div class='col-xs-8 centro'>
    <span ><strong>SALDO FINAL EN BANCOS</strong></span>
    </div>
    <div class='col-xs-4'>
    <span class='decoracion'><strong>$ ".$datos['bancofinal']."</strong></span>
    </div>
</div>
";
        $pdf=$this->generarpdf($content);
        return $pdf->render();
            }
         }      
    }

   public function generarpdf($content)
{
     $pdf = new Pdf([
   // set to use core fonts only
   'mode' => Pdf::MODE_BLANK,
   'filename' => 'reporte_' . date('d-m-Y_his') . '.pdf',
   // A4 paper format
   'format' => Pdf::FORMAT_A4,
   // portrait orientation
   'orientation' => Pdf::ORIENT_PORTRAIT,
   // stream to browser inline
   'destination' => Pdf::DEST_DOWNLOAD  ,   
   // your html content input
   'content' => $content,
   // format content from your own css file if needed or use the
   // enhanced bootstrap css built by Krajee for mPDF formatting
   //'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
   // any css to be embedded if required
   'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
   'cssInline' => '.kv-heading-1{font-size:10px} h3,h5{ text-align: center; }

    .decoracion{ text-decoration: underline;       
    }
    h5{    background: #cce5ff;
    padding: 5px;}
    .col-xs-4 {
    width: 33.33333333%;   
   
}
.col-xs-1, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9, .col-xs-10, .col-xs-11, .col-xs-12 {
    float: left;
}
span{
    font-size:13px;
}
.centro
{
    text-align: center;
}
.col-xs-8 {
    width: 66.66666667%;
}',
   // set mPDF properties on the fly
   'options' => ['title' => 'Krajee Report Title',                
                'SetWatermarkImage'=>'../web/img/logo.png',
                'showWatermarkText' => true,
    'showWatermarkImage' => true,
    ],
   // call mPDF methods on the fly
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

    public function cajamesant($fecha,$centrocostos)
    {
        $diezmo=$this->ingresoscaja($fecha,'recibo_caja_caja',$centrocostos,'1');
        $ofrenda=$this->ingresoscaja($fecha,'recibo_caja_caja',$centrocostos,'2');
        $otros=$this->totalotros($fecha,'recibo_caja_caja',$centrocostos,'1','2');
        $egresoscaja=$this->egresoscaja($fecha,'recibo_caja_caja',$centrocostos);
        $egresoscomcaja=$this->egresoscomprobantecaja($fecha,'comprobante_caja',$centrocostos);
        $ingresoco=$this->ingresoscomprobante($fecha,'comprobante_caja',$centrocostos);
        $r=$diezmo+$ofrenda+$otros+$ingresoco-$egresoscaja-$egresoscomcaja;
        return $r;

    }

    public function bancomesant($fecha,$centrocostos)
    {
        $diezmo=$this->ingresoscaja($fecha,'recibo_caja_banco',$centrocostos,'1');
        $ofrenda=$this->ingresoscaja($fecha,'recibo_caja_banco',$centrocostos,'2');
        $otros=$this->totalotros($fecha,'recibo_caja_banco',$centrocostos,'1','2');
        $egresoscaja=$this->egresoscaja($fecha,'recibo_caja_banco',$centrocostos);
        $egresoscomcaja=$this->egresoscomprobantecaja($fecha,'comprobante_banco',$centrocostos);
        $ingresoco=$this->ingresoscomprobante($fecha,'comprobante_banco',$centrocostos);
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
