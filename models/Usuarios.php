<?php

namespace app\models;
use yii\base\model;
use app\models\Users;
use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $nombrecompleto
 * @property string $centrocosto
 * @property int $idanulo
 *
 * @property CentroCostos $centrocosto0
 */
class Usuarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email', 'nombrecompleto', 'centrocosto','role'], 'required'],
            [['centrocosto', 'idanulo'], 'integer'],
            [['username', 'password', 'email', 'nombrecompleto'], 'string', 'max' => 200],
            [['username'], 'unique'],          
            [['email'], 'unique'],
            [['email'], 'email'],
            [['role'],'validar_role'],
            [['centrocosto'], 'exist', 'skipOnError' => true, 'targetClass' => CentroCostos::className(), 'targetAttribute' => ['centrocosto' => 'idcentrocostos']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Usuario',
            'password' => 'Password',
            'email' => 'Email',
            'nombrecompleto' => 'Nombre completo',
            'centrocosto' => 'Centro de costos',
            'idanulo' => 'Idanulo',
            'role' => 'Permisos',
        ];
    }

    public function validar_role($attribute, $params){
        if($this->role==0 || $this->role==1)
        {
            return true;
        }
        $this->addError($attribute, "El role no existe");
    }


    public static function buscarmodelo($id){
        $usuario= Usuarios::find()
                ->Where(['in','id', ["id" => $id]]) 
                ->all();

        if($usuario !== null)
        {
            Usuarios::updateAll(['idanulo' => 1], ['in','id', ["id" => $id]]);
            return true;
        }
        return false;
    }

   
/*
    public function username_existe($attribute, $params)
    {
        //Buscar el username en la tabla
         $table = $this::find()->where("username=:username", [":username" => $this->username]);
  
            //Si el username existe mostrar el error
        if ($table->count() == 1)
        {
                $this->addError($attribute, "El usuario seleccionado existe");
        }
    }
*/
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCentrocosto0()
    {
        return $this->hasOne(CentroCostos::className(), ['idcentrocostos' => 'centrocosto']);
    }
}
