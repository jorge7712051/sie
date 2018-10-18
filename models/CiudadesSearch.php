<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ciudades;
use yii\db\ActiveQuery;

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
        $query = (new \yii\db\Query())
        ->select([new \yii\db\Expression('c.*,d.id,d.nombre as nombredep,p.nombre as nombrepais')])
        ->from('ciudades as c')
        ->innerJoin('departamento as d','c.iddepartamento=d.id')
        ->innerJoin('pais as p','d.idpais=p.id')
        ->where('c.idanulo=0' )
        ->andWhere('d.idanulo=0')
        ->andWhere('p.idanulo=0');
        
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,

        ]);
        $dataProvider->setSort([
        'attributes' => [
            'ciudad' => [
                'asc' => ['ciudad' => SORT_ASC],
                'desc' => ['ciudad' => SORT_DESC],
                'default' => SORT_ASC
            ],
            'departamento' => [
                'asc' => ['nombredep' => SORT_ASC],
                'desc' => ['nombredep' => SORT_DESC],
                'default' => SORT_ASC,
            ],
            'pais' => [
                'asc' => ['nombrepais' => SORT_ASC],
                'desc' => ['nombrepais' => SORT_DESC],
                'default' => SORT_ASC,
            ],
        ]
    ]);
       $dataProvider->sort->attributes['nombredep'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['nombredep' => SORT_ASC],
        'desc' => ['nombredep' => SORT_DESC],
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
        $query->andFilterWhere(['like', 'd.nombre', $this->departamento]);
        $query->andFilterWhere(['like', 'p.nombre', $this->pais]);

        return $dataProvider;
    }
}
