<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DetallesComprobanteEgreso;

/**
 * DetallesComprobanteEgresoSearch represents the model behind the search form of `app\models\DetallesComprobanteEgreso`.
 */
class DetallesComprobanteEgresoSearch extends DetallesComprobanteEgreso
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iddetalle', 'idtercero', 'idcomprobanteegreso', 'idconcepto'], 'integer'],
            [['valor', 'subtotal', 'total'], 'number'],
            [['fechacreacion', 'adjunto'], 'safe'],
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
        $query = DetallesComprobanteEgreso::find();


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
            'iddetalle' => $this->iddetalle,
            'idtercero' => $this->idtercero,
            'valor' => $this->valor,
            'idcomprobanteegreso' => $this->idcomprobanteegreso,
            'idconcepto' => $this->idconcepto,
            'fechacreacion' => $this->fechacreacion,
            'subtotal' => $this->subtotal,
            'total' => $this->total,
        ]);

        $query->andFilterWhere(['like', 'adjunto', $this->adjunto]);

        return $dataProvider;
    }
    public function searchespecifico($id)
    {
        $query = DetallesComprobanteEgreso::find();
          $query->where('idcomprobanteegreso='.$id); 
          $query->orderBy(['iddetalle' => SORT_ASC]) ;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
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
}
