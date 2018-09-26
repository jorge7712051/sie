<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ReciboCaja;

/**
 * ReciboCajaSearch represents the model behind the search form of `app\models\ReciboCaja`.
 */
class ReciboCajaSearch extends ReciboCaja
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idrecibo', 'bloqueo', 'idcentrocostos', 'idanulo'], 'integer'],
            [['fecha', 'fecha_creacion', 'concepto', 'adjunto', 'codigo'], 'safe'],
            [['valor'], 'number'],
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
        $query = ReciboCaja::find();

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
            'idrecibo' => $this->idrecibo,
            'fecha' => $this->fecha,
            'fecha_creacion' => $this->fecha_creacion,
            'valor' => $this->valor,
            'bloqueo' => $this->bloqueo,
            'idcentrocostos' => $this->idcentrocostos,
            'idanulo' => $this->idanulo,
        ]);

        $query->andFilterWhere(['like', 'concepto', $this->concepto])
            ->andFilterWhere(['like', 'adjunto', $this->adjunto])
            ->andFilterWhere(['like', 'codigo', $this->codigo]);

        return $dataProvider;
    }
}
