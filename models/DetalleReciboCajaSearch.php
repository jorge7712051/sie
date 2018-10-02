<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DetalleReciboCaja;

/**
 * DetalleReciboCajaSearch represents the model behind the search form of `app\models\DetalleReciboCaja`.
 */
class DetalleReciboCajaSearch extends DetalleReciboCaja
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iddetalle_recibo', 'idtercero', 'idtipoingreso', 'idrecibocaja'], 'integer'],
            [['valor'], 'number'],
            [['fechacreacion'], 'safe'],
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
    public function searchespecifico($id)
    {
        $query = DetalleReciboCaja::find();
          $query->where('idrecibocaja='.$id); 
          $query->orderBy(['iddetalle_recibo' => SORT_ASC]) ;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //$this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        /*
        $query->andFilterWhere([
            'iddetalle' => $this->iddetalle,
            'idtercero' => $this->idtercero,
            'valor' => $this->valor,
            'idcomprobanteegreso' => $this->idcomprobanteegreso,
            'idconcepto' => $this->idconcepto,
            'fechacreacion' => $this->fechacreacion,
            'subtotal' => $this->subtotal,
            'total' => $this->total,
        ]);*/

        //$query->andFilterWhere(['like', 'adjunto', $this->adjunto]);

        return $dataProvider;
    }
    public function search($params)
    {
        $query = DetalleReciboCaja::find();

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
            'iddetalle_recibo' => $this->iddetalle_recibo,
            'idtercero' => $this->idtercero,
            'valor' => $this->valor,
            'idtipoingreso' => $this->idtipoingreso,
            'idrecibocaja' => $this->idrecibocaja,
            'fechacreacion' => $this->fechacreacion,
        ]);

        return $dataProvider;
    }
}
