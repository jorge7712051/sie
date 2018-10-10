<?php

namespace app\models;
use app\models\Pastores;


use Yii;

/**
 * This is the model class for table "diezmo_pastores".
 *
 * @property string $id
 * @property int $valor
 * @property string $fecha
 * @property string $idpastor
 * @property int $idnulo
 *
 * @property Pastores $pastor
 */
class DiezmoPastores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'diezmo_pastores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['valor', 'fecha', 'idpastor'], 'required'],
            [['valor', 'idpastor', 'idnulo'], 'integer'],
            [['idpastor'],'validarpastor'],
            [['fecha'], 'safe'],
            [['idpastor'], 'exist', 'skipOnError' => true, 'targetClass' => Pastores::className(), 'targetAttribute' => ['idpastor' => 'cedula']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'valor' => 'Valor',
            'fecha' => 'Fecha',
            'idpastor' => 'Pastor',
            'idnulo' => 'Idnulo',
        ];
    }

    public function validarpastor($attribute, $params)
    {
        $session = Yii::$app->session;
        if ($session->isActive)
        {
            if($session->get('rol')!=1)
            {
                $centrocostos =$session->get('centrocostos');
                $query = Pastores::find()
                        ->where('centro_costo=:status', [':status' => $centrocostos])
                        ->asArray()
                        ->all();
                if ( $this->idpastor != $query['0']['cedula'] )
                    {
                       $this->addError($attribute, "Error reprtado al administrador");     
                    }
            }
            return true;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPastor()
    {
        return $this->hasOne(Pastores::className(), ['cedula' => 'idpastor']);
    }
}
