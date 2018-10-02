<?php

namespace app\controllers;

use Yii;
use app\models\ReciboCaja;
use app\models\ReciboCajaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\web\Response;
use yii\filters\AccessControl;
use app\models\User;
use app\models\DetalleReciboCajaSearch;
/**
 * ReciboCajaController implements the CRUD actions for ReciboCaja model.
 */
class ReciboCajaController extends Controller
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
                        'actions' => ['create', 'view','update','index','delete','alta','baja'],
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
                       'actions' => ['create','view','index','delete','alta','baja'],
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
                        return User::actualizarrecibocaja($id,$session->get('centrocostos'));
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
     * Lists all ReciboCaja models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReciboCajaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ReciboCaja model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new DetalleRecibocajaSearch();
        $dataProvider = $searchModel->searchespecifico($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ReciboCaja model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ReciboCaja();
        $model->scenario = 'create';
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        } 

        if ($model->load(Yii::$app->request->post()))
        {
            $model->comprobante = UploadedFile::getInstance($model, 'comprobante');
            $model->ruta=$this->generarnombre();
            $model->adjunto="archivos/".$model->ruta.".".$model->comprobante->extension;
            $model->save(); 
            if ($model->upload())
            { 
                  return $this->redirect(['view', 'id' => $model->idrecibo]);
            }                                        
            
        }   


        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function generarnombre()
    {
        $fechaactual  = date("dHi");  //Fecha Actual       
        $no_aleatorio  = rand(10, 99);
        $fechaactual.=$no_aleatorio;
        return $fechaactual;
    }

    /**
     * Updates an existing ReciboCaja model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';

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
                   return $this->redirect(['view', 'id' => $model->idrecibo]);
                 }                  
            }
            $model->save(); 
            return $this->redirect(['view', 'id' => $model->idrecibo]);           
        }         

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionAlta($id)
    {   
        $model = $this->findModel($id);
        $model->alta=1;
        $model->save();
        $mensaje='<div class="alert alert-success" role="alert"><h4 class="alert-heading">¡BIEN HECHO!</h4><p>Loa valores coinciden el recibo de caja sera tenido en cuenta para el informe mensual, por favor no cambies o adiciones mas datos.</p><hr><p class="mb-0">Comprobante  tenido en cuenta .</p></div>'; 
        return $mensaje;
    }

    public function actionBaja($id)
    {
       $model = $this->findModel($id);
        $model->alta=0;
        $model->save();
        $mensaje='<div class="alert alert-danger" role="alert"><h4 class="alert-heading">¡ERROR!</h4><p>Los valores del recibo de caja y la suma de los valores de los adjuntos no coinciden o no son iguales, para que el recibo de caja sea tenido en cuenta, pueda subir al sistema y se vea reflejado en el informe mensual ajuste los valores hasta que sean iguales.</p><hr><p class="mb-0">Comprobante no tenido en cuenta .</p></div>'; 
        return $mensaje;
    }

    /**
     * Deletes an existing ReciboCaja model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ReciboCaja model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ReciboCaja the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ReciboCaja::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
