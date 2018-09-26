<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Terceros;

/**
 * TercerosSearch represents the model behind the search form of `app\models\Terceros`.
 */
class TercerosSearch extends Terceros
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idtercero', 'telefono', 'direccion', 'idciudad', 'tipo_id', 'usuariocreacion', 'digitoverificacion'], 'integer'],
            [['identificacion'], 'number'],
            [['nombre', 'apellido', 'razon_social', 'fecha_creacion', 'fecha_actualizacion', 'anotaciones'], 'safe'],
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
        $query = Terceros::find();
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
            'idtercero' => $this->idtercero,
            'identificacion' => $this->identificacion,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'idciudad' => $this->idciudad,
            'tipo_id' => $this->tipo_id,
            'usuariocreacion' => $this->usuariocreacion,
            'fecha_creacion' => $this->fecha_creacion,
            'fecha_actualizacion' => $this->fecha_actualizacion,
            'digitoverificacion' => $this->digitoverificacion,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellido', $this->apellido])
            ->andFilterWhere(['like', 'razon_social', $this->razon_social])
            ->andFilterWhere(['like', 'anotaciones', $this->anotaciones]);

        return $dataProvider;
    }
}
