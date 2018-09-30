<?php

namespace app\models;
use app\models\ComprobanteEgreso;
use Yii;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $email;
    public $nombrecompleto;
    public $centrocosto;
    public $idanulo;
    public $role;
    public $authKey;
    public $accessToken;



    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        
        $user = Usuarios::find()
                ->Where("id=:id", ["id" => $id])                
                ->one();
        
        return isset($user) ? new static($user) : null;
    }
    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $users = Usuarios::find()
               ->Where("username=:username", [":username" => $username])
                ->all();
        
        foreach ($users as $user) {
            if (strcasecmp($user->username, $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }
    public function getEmail()
    {
        return $this->email;
    }


    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password,$user)
    {        $users = Usuarios::find()
                         ->Where("username=:username", [":username" => $user])
                         ->andWhere("idanulo=0")
                         ->all();
        
        foreach ($users as $use) {
            if (strcasecmp($use->username, $user) === 0) {
                if (Yii::$app->getSecurity()->validatePassword($password, $use->password)) {
                   return Yii::$app->getSecurity()->validatePassword($password, $use->password);
                } 
            }
        }       
    }

    public static function isUserAdmin($id)
    {
       if (Usuarios::findOne(['id' => $id,  'role' => 1])){
        return true;
       } else {

        return false;
       }

    }

    public static function isUserSimple($id)
    {

       if (Usuarios::findOne(['id' => $id, 'role' => 0])){
       return true;
       } else {

       return false;
       }
    }

    public static function actualizarcomprobante($id,$cc)
    {
       $hoy = date("Y-m"); 
       if (ComprobanteEgreso::findOne(['idcomprobante'=>$id,'idcentrocostos'=>$cc,'bloqueo'=>'0']))
       {
        if(ComprobanteEgreso::Seguridadfecha($hoy))
        {
            return true;   
        }
       
       } 
       else {
            return false;
       }
    }


    public static function createSesion($id){
        $centrocosto=Usuarios::findOne($id);
        return $centrocosto;
    }
}
