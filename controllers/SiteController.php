<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public $defaultAction = 'login';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['contact', 'about','logout'],
                'rules' => [
                    [
                        //El administrador tiene permisos sobre las siguientes acciones
                        'actions' => ['logout', 'contact'],
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
                       'actions' => ['logout', 'about'],
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
     //Controla el modo en que se accede a las acciones, en este ejemplo a la acción logout
     //sólo se puede acceder a través del método post
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
       
       return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
       
        if (!Yii::$app->user->isGuest) {
            return $this->actionIndex();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $cc=User::createSesion(Yii::$app->user->identity->id);

            $session = Yii::$app->session;
            $session->set('centrocostos', $cc->centrocosto);
            $session->set('rol', $cc->role);
            return $this->goBack();
        }

        $model->password = '';
        $this->layout = 'layaout_login';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
         $session = Yii::$app->session;
        $session->close();
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
