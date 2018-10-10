<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pastores;

/**
 * PastoresSearch represents the model behind the search form of `app\models\Pastores`.
 */
class PastoresSearch extends Pastores
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cedula', 'idanulo', 'tipoid', 'centro_costo'], 'integer'],
            [['nombre', 'direccion', 'telefono', 'correo'], 'safe'],
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
        $query = Pastores::find();
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
            'cedula' => $this->cedula,
            'idanulo' => $this->idanulo,
            'tipoid' => $this->tipoid,
            'centro_costo' => $this->centro_costo,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'correo', $this->correo]);

        return $dataProvider;
    }
}
