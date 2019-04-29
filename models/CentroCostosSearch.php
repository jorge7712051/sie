<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CentroCostos;

/**
 * CentroCostosSearch represents the model behind the search form of `app\models\CentroCostos`.
 */
class CentroCostosSearch extends CentroCostos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idcentrocostos', 'idanulo','idciudad'], 'integer'],
            [['centrocostos'], 'safe'],
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
        $query = CentroCostos::find();
        $query->where('idanulo=0');
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
            'idcentrocostos' => $this->idcentrocostos,
            'idciudad' => $this->idciudad,
            'idanulo' => $this->idanulo,
        ]);

        $query->andFilterWhere(['like', 'centrocostos', $this->centrocostos]);

        return $dataProvider;
    }
}
