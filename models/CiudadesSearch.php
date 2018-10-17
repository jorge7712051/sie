<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ciudades;

/**
 * CiudadesSearch represents the model behind the search form of `app\models\Ciudades`.
 */
class CiudadesSearch extends Ciudades
{
    /**
     * {@inheritdoc}
     */

    public $departamento;
    public $pais;
    public function rules()
    {
        return [
            [['idciudad', 'idanulo'], 'integer'],
            [['ciudad','departamento','pais'], 'safe'],
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
        $query = Ciudades::find();
        $query->where('ciudades.idanulo=0');
        $query->joinWith(['departamento']);
        $query->innerJoin('pais', 'departamento.idpais= pais.id');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,

        ]);
        $dataProvider->sort->attributes['departamento'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['departamento.nombre' => SORT_ASC],
        'desc' => ['departamento.nombre' => SORT_DESC],
    ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idciudad' => $this->idciudad,            
            'idanulo' => $this->idanulo,
        ]);

        $query->andFilterWhere(['like', 'ciudad', $this->ciudad]);
        $query->andFilterWhere(['like', 'departamento.nombre', $this->departamento]);

        return $dataProvider;
    }
}
