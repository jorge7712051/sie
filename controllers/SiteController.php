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
use app\models\Usuarios;
use yii\web\Session;
use app\models\FormRecoverPass;
use app\models\FormResetPass;
use yii\helpers\Url;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login','contact', 'about','logout','recoverpass','resetpass','index'],
                'rules' => [
                     [
                        //El administrador tiene permisos sobre las siguientes acciones
                        'actions' => ['recoverpass','resetpass'],
                        //Esta propiedad establece que tiene permisos
                        'allow' => true,
                        //Usuarios autenticados, el signo ? es para invitados
                        'roles' => ['?'],
                        //Este método nos permite crear un filtro sobre la identidad del usuario
                        //y así establecer si tiene permisos o no
                        
                    ],
                    [
                       //Los usuarios simples tienen permisos sobre las siguientes acciones
                       'actions' => ['login' ],
                       //Esta propiedad establece que tiene permisos
                       'allow' => true,
                       //Usuarios autenticados, el signo ? es para invitados
                       'roles' => ['?'],
                       
                   ],
                   
                    [
                       //Los usuarios simples tienen permisos sobre las siguientes acciones
                       'actions' => ['logout', 'about','index','login'],
                       //Esta propiedad establece que tiene permisos
                       'allow' => true,
                       //Usuarios autenticados, el signo ? es para invitados
                       'roles' => ['@'],
                       //Este método nos permite crear un filtro sobre la identidad del usuario
                       //y así establecer si tiene permisos o no
                       
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

     public function actionLogin()
    {
      if(Yii::$app->user->isGuest)
      {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $cc=User::createSesion(Yii::$app->user->identity->id);
            $session = Yii::$app->session;
            $session->set('centrocostos', $cc->centrocosto);
            $session->set('rol', $cc->role);
            return $this->redirect(['terceros/index']);
        }

        $model->password = '';
        $this->layout = 'layaout_login';
        return $this->render('login', [
            'model' => $model,
        ]);
      }
       return $this->render('index');
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

    public function actionRecoverpass()
  {
   //Instancia para validar el formulario
   $model = new FormRecoverPass;
  
   //Mensaje que será mostrado al usuario en la vista
   $msg = null;
  
   if ($model->load(Yii::$app->request->post()))
   {
    if ($model->validate())
    {
     //Buscar al usuario a través del email
     $table = Usuarios::find()->where("email=:email", [":email" => $model->email]);
    
     //Si el usuario existe
     if ($table->count() == 1)
     {
      //Crear variables de sesión para limitar el tiempo de restablecido del password
      //hasta que el navegador se cierre
      $session = new Session;
      $session->open();
     
      //Esta clave aleatoria se cargará en un campo oculto del formulario de reseteado
      $session["recover"] = $this->randKey("abcdef0123456789", 200);
      $recover = $session["recover"];
     
      //También almacenaremos el id del usuario en una variable de sesión
      //El id del usuario es requerido para generar la consulta a la tabla users y 
      //restablecer el password del usuario
      $table = Usuarios::find()->where("email=:email", [":email" => $model->email])->one();
      $session["id_recover"] = $table->id;
     
      //Esta variable contiene un número hexadecimal que será enviado en el correo al usuario 
      //para que lo introduzca en un campo del formulario de reseteado
      //Es guardada en el registro correspondiente de la tabla users
      $verification_code = $this->randKey("abcdef0123456789", 8);
      //Columna verification_code
      $table->verification_code = $verification_code;
      //Guardamos los cambios en la tabla users
      $table->save();
     
      //Creamos el mensaje que será enviado a la cuenta de correo del usuario
      $subject = "Recuperar password";
      $body = "<p>Copie el siguiente código de verificación para restablecer su password ... ";
      $body .= "<strong>".$verification_code."</strong></p>";
      $body .= "<p><a href='http://localhost/sie/web/resetpass'>Recuperar password</a></p>";

      //Enviamos el correo
      Yii::$app->mailer->compose()
      ->setTo($model->email)
      ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["title"]])
      ->setSubject($subject)
      ->setHtmlBody($body)
      ->send();
     
      //Vaciar el campo del formulario
      $model->email = null;
     
      //Mostrar el mensaje al usuario
      $msg = "Le hemos enviado un mensaje a su cuenta de correo para que pueda resetear su password";
     }
     else //El usuario no existe
     {
      $msg = "Ha ocurrido un error";
     }
    }
    else
    {
     $model->getErrors();
    }
   }
   $this->layout = 'layaout_login';
   return $this->render("recoverpass", ["model" => $model, "msg" => $msg]);
  }

  private function randKey($str='', $long=0)
     {
         $key = null;
         $str = str_split($str);
         $start = 0;
         $limit = count($str)-1;
         for($x=0; $x<$long; $x++)
         {
             $key .= $str[rand($start, $limit)];
         }
         return $key;
     }
 
  public function actionResetpass()
  {
   //Instancia para validar el formulario
   $model = new FormResetPass;
  
   //Mensaje que será mostrado al usuario
   $msg = null;
  
   //Abrimos la sesión
   $session = new Session;
   $session->open();
  
   //Si no existen las variables de sesión requeridas lo expulsamos a la página de inicio
   if (empty($session["recover"]) || empty($session["id_recover"]))
   {
    return $this->redirect(["site/login"]);
   }
   else
   {
   
    $recover = $session["recover"];
    //El valor de esta variable de sesión la cargamos en el campo recover del formulario
    $model->recover = $recover;
   
    //Esta variable contiene el id del usuario que solicitó restablecer el password
    //La utilizaremos para realizar la consulta a la tabla users
    $id_recover = $session["id_recover"];
   
   }
  
   //Si el formulario es enviado para resetear el password
   if ($model->load(Yii::$app->request->post()))
   {
    if ($model->validate())
    {
     //Si el valor de la variable de sesión recover es correcta
     if ($recover == $model->recover)
     {
      //Preparamos la consulta para resetear el password, requerimos el email, el id 
      //del usuario que fue guardado en una variable de session y el código de verificación
      //que fue enviado en el correo al usuario y que fue guardado en el registro
      $table = Usuarios::findOne(["email" => $model->email, "id" => $id_recover, "verification_code" => $model->verification_code]);
     
      //Encriptar el password
     
      $table->password  = Yii::$app->getSecurity()->generatePasswordHash($model->password);
      
     
      //Si la actualización se lleva a cabo correctamente
      if ($table->save())
      {
      
       //Destruir las variables de sesión
       $session->destroy();
      
       //Vaciar los campos del formulario
       $model->email = null;
       $model->password = null;
       $model->password_repeat = null;
       $model->recover = null;
       $model->verification_code = null;
      
       $msg = "Enhorabuena, password reseteado correctamente, redireccionando a la página de login ...";
       $msg .= "<meta http-equiv='refresh' content='5; ".Url::toRoute("site/login")."'>";
      }
      else
      {
       $msg = "Ha ocurrido un error";
      }
     
     }
     else
     {
      $model->getErrors();
     }
    }
   }
   $this->layout = 'layaout_login';
   return $this->render("resetpass", ["model" => $model, "msg" => $msg]);
  
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
