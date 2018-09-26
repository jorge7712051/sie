<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Concepto;

/**
 * ConceptoSearch represents the model behind the search form of `app\models\Concepto`.
 */
class ConceptoSearch extends Concepto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idconcepto', 'concepto', 'idanulo','doble','adjobligatorio'], 'integer'],
            [['piso', 'porcentaje'], 'number'],
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
        $query = Concepto::find();
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
            'idconcepto' => $this->idconcepto,
            'concepto' => $this->concepto,
            'piso' => $this->piso,
            'porcentaje' => $this->porcentaje,
            'idanulo' => $this->idanulo,
            'doble' => $this->doble,
            'adjobligatorio'=>$this->adjobligatorio,
        ]);

        return $dataProvider;
    }
}
