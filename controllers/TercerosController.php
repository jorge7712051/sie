<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Terceros;
use app\models\TercerosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\web\Response;
use app\models\User;
use yii\db\ActiveQuery;
/**
 * TercerosController implements the CRUD actions for Terceros model.
 */
class TercerosController extends Controller
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
                        'actions' => ['create', 'view','update','delete','index','validate','terceros-list'],
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
                       'actions' => ['create','view','update','index','terceros-list','validate'],
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
        $searchModel = new TercerosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Terceros model.
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
     * Creates a new Terceros model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Terceros();
        $idmodal =yii::$app->request->get('id');
        if($idmodal==1){
            $request = Yii::$app->getRequest();
            if ($request->isPost && $model->load($request->post())) {
                 $model->save();
                return '<div class="alert alert-success">
                    <strong>Exito!</strong> Datos guardados.
                    </div> ';;
                }                    
            else
            {    
                return $this->renderAjax('create', [
                            'model' => $model
                ]);
            }            
        }      
       
        if ($model->load(Yii::$app->request->post()))
         {
          if($model->validate())
            {
                $model->save();
                return $this->redirect(['view', 'id' => $model->idtercero]);
            }
        }
     
        return $this->render('create', [
                       'model' => $model
            ]);
        

       
    }

   public function actionValidate()
{
    $model = new Terceros();
    $request = \Yii::$app->getRequest();
    if ($request->isPost && $model->load($request->post())) {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return ActiveForm::validate($model);
    }
}

    /**
     * Updates an existing Terceros model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
         if ($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                $model->save();
                return $this->redirect(['view', 'id' => $model->idtercero]);
            }
         } 

        return $this->render('update', [
            'model' => $model,
        ]);

       
    }

    /**
     * Deletes an existing Terceros model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModelDelete($id);
        return $this->redirect(['index']);
    }

    protected function findModelDelete($id)
    {
        $model = Terceros::buscarmodelo($id);
        if ($model) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionTercerosList($q = null)
    {
        $params = ","." ".",";
        $out = [];       
        $out = (new \yii\db\Query())
        ->select([new \yii\db\Expression('*,
            CASE
            WHEN  t.nombre = ""   THEN  t.razon_social
            ELSE concat( t.nombre ," ", t.apellido)
            END as resultado')])
        ->from('terceros as t')
        ->where('t.nombre  LIKE :q',[':q'=>$q.'%'] )
        ->orWhere(' t.razon_social LIKE :q',[':q'=>$q.'%'] )
        ->andWhere('t.idanulo=0')
        
        ->all();
       return \yii\helpers\Json::encode($out);
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
