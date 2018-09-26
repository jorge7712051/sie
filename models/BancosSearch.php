<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bancos;

/**
 * BancosSearch represents the model behind the search form of `app\models\Bancos`.
 */
class BancosSearch extends Bancos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'valor_ingreso', 'valor_egreso', 'idcomprobante', 'idcaja', 'idanulo'], 'integer'],
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
        $query = Bancos::find();

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
            'valor_ingreso' => $this->valor_ingreso,
            'valor_egreso' => $this->valor_egreso,
            'idcomprobante' => $this->idcomprobante,
            'idcaja' => $this->idcaja,
            'idanulo' => $this->idanulo,
        ]);

        return $dataProvider;
    }
}
