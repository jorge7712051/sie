<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\DetallesComprobanteEgreso;
use app\models\DetallesComprobanteEgresoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Url;
use app\models\User;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\models\Bancos;
use app\models\Caja;
use app\models\Terceros;

/*
 * DetallesComprobanteEgresoController implements the CRUD actions for DetallesComprobanteEgreso model.
 */
class DetallesComprobanteEgresoController extends Controller
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
                        'actions' => ['create', 'update','delete'],
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
                       'actions' => ['create','delete'],
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
                    [
                       //Los usuarios simples tienen permisos sobre las siguientes acciones
                       'actions' => ['update'],
                       //Esta propiedad establece que tiene permisos
                       'allow' => true,
                       //Usuarios autenticados, el signo ? es para invitados
                       'roles' => ['@'],
                       //Este método nos permite crear un filtro sobre la identidad del usuario
                       //y así establecer si tiene permisos o no
                       'matchCallback' => function ($rule, $action) {
                        $session = Yii::$app->session; 
                        $request = Yii::$app->request; 
                        $id = $request->get('id');  
                          //Llamada al método que comprueba si es un usuario simple
                        return User::actualizarcomprobante($id,$session->get('centrocostos'));
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
     * Lists all DetallesComprobanteEgreso models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DetallesComprobanteEgresoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DetallesComprobanteEgreso model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DetallesComprobanteEgreso model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DetallesComprobanteEgreso();  
        $model->scenario = 'create';    
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()))
        {
            if($model->adjobligatorio==0)
            {
                $model->comprobante = UploadedFile::getInstance($model, 'comprobante');
                $model->ruta=$this->generarnombre();
                $model->adjunto="archivos/".$model->ruta.".".$model->comprobante->extension;
                $model->save(); 
                if ($model->upload())
                { 
                    return $this->redirect(['comprobante-egreso/view','id' => $model->idcomprobanteegreso]);
                }          
            }
            $model->adjunto="archivos/sinarchivo.png";
            $model->save(); 
            return $this->redirect(['comprobante-egreso/view','id' => $model->idcomprobanteegreso]);
        }   

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function generarnombre(){
        $fechaactual  = date("dHi");  //Fecha Actual       
        $no_aleatorio  = rand(10, 99);
        $fechaactual.=$no_aleatorio;
        return $fechaactual;
    }

    /**
     * Updates an existing DetallesComprobanteEgreso model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $model->contraparte=$this->getcontraparte($id);
        $model->nombre=$this->gettercero( $model->idtercero);
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()))
        {
            $directorio= $model->adjunto  ;               
            $model->comprobante = UploadedFile::getInstance($model, 'comprobante');
            if(!empty($model->comprobante))
            {
                $model->ruta=$this->generarnombre();
                $model->adjunto="archivos/".$model->ruta.".".$model->comprobante->extension;
                $model->save(); 
                if ($model->upload())
                 { 
                    unlink($directorio);
                   return $this->redirect(['comprobante-egreso/view','id' => $model->idcomprobanteegreso]);
                 }                  
            }
            $model->save(); 
            return $this->redirect(['comprobante-egreso/view','id' => $model->idcomprobanteegreso]);           
        } 
        return $this->render('update', [
        'model' => $model,
        ]);
    }


    /**
     * Deletes an existing DetallesComprobanteEgreso model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */


     public function actionDelete($id)
    {
        $modelcaja= new Caja();
        $modelbanco= new Bancos();
        $model = $this->findModel($id); 
        $directorio= $model->adjunto  ;
        if($directorio!='archivos/sinarchivo.png')
        {
             unlink($directorio);
         }
        Bancos::deleteAll("idcomprobante=:id", [":id" => $id]);
        Caja::deleteAll("idcomprobante=:id", [":id" => $id]);
        $url = Url::previous();
        $this->findModel($id)->delete();
        return $this->redirect($url);
    }

      public function getcontraparte($id)
    {
        $modelcaja= new Caja();
        $modelbanco= new Bancos();
        $resultado=$modelcaja->find()->where('idcomprobante='.$id)->all();
        if($resultado!=null)
        {
            return $valor=2;
        }
        $resultado=$modelbanco->find()->where('idcomprobante='.$id)->all();
         if($resultado!=null)
         {
            return $valor=1;
        }
    }

        public function gettercero($id)
    {
        $modelotercero= new Terceros();
        $resultado=$modelotercero->find()->where('idtercero='.$id)->all();
        if($resultado[0]['razon_social']!="")
        {
            return $resultado[0]['razon_social'];
        }
        $nombre= $resultado[0]['nombre']." ".$resultado[0]['apellido'];
        return $nombre;
    }
    /**
     * Finds the DetallesComprobanteEgreso model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return DetallesComprobanteEgreso the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DetallesComprobanteEgreso::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
