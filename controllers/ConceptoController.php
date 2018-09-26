<?php

namespace app\controllers;

use Yii;
use app\models\Concepto;
use app\models\ConceptoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\User;
/**
 * ConceptoController implements the CRUD actions for Concepto model.
 */
class ConceptoController extends Controller
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
                        'allow' => true,
                        'actions' => ['concepto-porcentaje'],
                        'roles' => ['@'],
                    ],
                    [
                        //El administrador tiene permisos sobre las siguientes acciones
                        'actions' => ['create', 'view','update','delete','index'],
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
                       'actions' => ['create','view','update','delete'],
                       //Esta propiedad establece que tiene permisos
                       'allow' => false,
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
     * Lists all Concepto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ConceptoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Concepto model.
     * @param integer $id
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
     * Creates a new Concepto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Concepto();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idconcepto]);
        }
        $model->piso=0;
        $model->porcentaje=0;
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Concepto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idconcepto]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Concepto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
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
        $model = Concepto::buscarmodelo($id);
        if ($model) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionConceptoPorcentaje($q = null)
    {
        $request = Yii::$app->request; 
        $id = $request->post('id');  
        $out = [];
        $out = Concepto::find()
        ->where('idconcepto='.$id)
        ->asArray()
        ->all();
        return \yii\helpers\Json::encode($out);
    }



    /**
     * Finds the Concepto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Concepto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Concepto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
