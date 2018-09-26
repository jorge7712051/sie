<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TipoIngreso;

/**
 * TipoIngresoSearch represents the model behind the search form of `app\models\TipoIngreso`.
 */
class TipoIngresoSearch extends TipoIngreso
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idtipo_ingreso', 'idanulo'], 'integer'],
            [['ingreso'], 'safe'],
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
        $query = TipoIngreso::find();

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
            'idtipo_ingreso' => $this->idtipo_ingreso,
            'idanulo' => $this->idanulo,
        ]);

        $query->andFilterWhere(['like', 'ingreso', $this->ingreso]);

        return $dataProvider;
    }
}
