<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DiezmoPastores;

/**
 * DiezmoPastoresSearch represents the model behind the search form of `app\models\DiezmoPastores`.
 */
class DiezmoPastoresSearch extends DiezmoPastores
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'valor', 'idpastor', 'idnulo'], 'integer'],
            [['fecha'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = DiezmoPastores::find();
        $session = Yii::$app->session;
        if ($session->isActive)
        {
                $query = DiezmoPastores::find()
                ->select('diezmo_pastores.*')
                ->innerJoin('pastores', '`pastores`.`cedula` = `diezmo_pastores`.`idpastor`')
                ->where(['pastores.centro_costo' => $session->get('centrocostos')]);
           
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'valor' => $this->valor,
            'fecha' => $this->fecha,
            'idpastor' => $this->idpastor,
            'idnulo' => $this->idnulo,
        ]);

        return $dataProvider;
    }
}
