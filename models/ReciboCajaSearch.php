<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ReciboCaja;
use app\models\CajaCaja;
use app\models\CajaBanco;
use yii\db\ActiveQuery;
use yii\db\Query;

/**
 * ReciboCajaSearch represents the model behind the search form of `app\models\ReciboCaja`.
 */
class ReciboCajaSearch extends ReciboCaja
{
    /**
     * {@inheritdoc}
     */
    public $fecha_caja;
    public $fecha_banco;
    public $idiglesia;
    public $id_anterior;

    public function rules()
    {
        return [
            [['idrecibo', 'bloqueo', 'idcentrocostos', 'idanulo'], 'integer'],
            [['fecha', 'fecha_creacion', 'concepto', 'adjunto', 'codigo','fecha_banco','fecha_caja'], 'safe'],
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
        $session = Yii::$app->session;
        if ($session->isActive)
        {
            if($session->get('rol')==1)
            {
                $query = ReciboCaja::find();
                $query->where('idanulo=0'); 
                $query->orderBy(['fecha' => SORT_ASC]) ;

            }
            else{
                $query = ReciboCaja::find();
                $query->where('idanulo=0');
                $query->andWhere('idcentrocostos='.$session->get('centrocostos'));
                $query->orderBy(['fecha' => SORT_ASC]) ;

            }
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idrecibo' => $this->idrecibo,
            'fecha_creacion' => $this->fecha_creacion,
            'valor' => $this->valor,
            'bloqueo' => $this->bloqueo,
            'idcentrocostos' => $this->idcentrocostos,
            'idanulo' => $this->idanulo,
        ]);

        $query->andFilterWhere(['like', 'concepto', $this->concepto])
            ->andFilterWhere(['like', 'adjunto', $this->adjunto])
            ->andFilterWhere(['like', 'codigo', $this->codigo]);

        if(!empty($this->fecha) && strpos($this->fecha, '-') !== false) {
            list($start_date, $end_date) = explode(' - ', $this->fecha);
            $query->andFilterWhere(['>=', 'fecha', $start_date]);
            $query->andFilterWhere(['<=', 'fecha', $end_date]);
        }

        return $dataProvider;
    }

        public function searchrecibobanco($params)
    {
        $session = Yii::$app->session;
        if ($session->isActive)
        {   
            if($session->get('rol')==1)
            {
            
                $query = CajaBanco::find()->alias('cb')->select(
                   ['fecha_banco'=>'fecha',
                     'idrecibo'=>'idrecibo', 
                     'idiglesia'=>'idcentrocostos',
                     'idtercero'=>'te.identificacion',
                     'valor_total'=>'valor_d',
                     'idtipoingreso'=>'idtipoingreso',
                     'concepto'=>'concepto',
                     'codigo'=>'codigo',
                     'id_anterior'=>'idanteriror',
               ])
               ->innerJoin('terceros as te','cb.idtercero=te.idtercero');
            }
            else{
                 $query = CajaBanco::find()->alias('cb')->select(
                   ['fecha_banco'=>'fecha',
                     'idrecibo'=>'idrecibo', 
                     'idiglesia'=>'idcentrocostos',
                     'idtercero'=>'te.identificacion',
                     'valor_total'=>'valor_d',
                     'idtipoingreso'=>'idtipoingreso',
                     'concepto'=>'concepto',
                     'codigo'=>'codigo',
                     'id_anterior'=>'idanteriror',
               ])
               ->innerJoin('terceros as te','cb.idtercero=te.idtercero')
               ->where('idcentrocostos='.$session->get('centrocostos'));

            }


           
        }
        // add conditions that should always apply here

        $dataProviderbanco = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProviderbanco;
        }

        // grid filtering conditions
        $query->andFilterWhere(['>=', 'fecha', $this->fecha_banco."-01"]);
         $query->andFilterWhere(['<=', 'fecha', $this->fecha_banco."-31"]);

        


        return $dataProviderbanco;
    }

      public function searchrecibocaja($params)
    {
        $session = Yii::$app->session;
        if ($session->isActive)
        {   
             if($session->get('rol')==1)
            {
             $query = CajaCaja::find()->alias('cb')->select(
                    ['fecha_caja'=>'fecha',
                     'idrecibo'=>'idrecibo', 
                     'idiglesia'=>'idcentrocostos',
                     'idtercero'=>'te.identificacion',
                     'valor_total'=>'valor_d',
                     'idtipoingreso'=>'idtipoingreso',
                     'concepto'=>'concepto',
                     'codigo'=>'codigo',
                     'id_anterior'=>'idanteriror',
               ]) ->innerJoin('terceros as te','cb.idtercero=te.idtercero');
            }
            else{
                 $query = CajaCaja::find()->alias('cb')->select(
                    ['fecha_caja'=>'fecha',
                     'idrecibo'=>'idrecibo', 
                     'idiglesia'=>'idcentrocostos',
                     'idtercero'=>'te.identificacion',
                     'valor_total'=>'valor_d',
                     'idtipoingreso'=>'idtipoingreso',
                     'concepto'=>'concepto',
                     'codigo'=>'codigo',
                     'id_anterior'=>'idanteriror',
               ]) ->innerJoin('terceros as te','cb.idtercero=te.idtercero')
                  ->where('idcentrocostos='.$session->get('centrocostos'));

            }

            
           
        }
        // add conditions that should always apply here

        $dataProvidercaja = new ActiveDataProvider([
            'query' => $query,
             'pagination' => false,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvidercaja;
        }

        // grid filtering conditions
        $query->andFilterWhere(['>=', 'fecha', $this->fecha_caja."-01"]);
         $query->andFilterWhere(['<=', 'fecha', $this->fecha_caja."-31"]);

        
/*
        if(!empty($this->fecha) && strpos($this->fecha, '-') !== false) {
            list($start_date, $end_date) = explode(' - ', $this->fecha);
            $query->andFilterWhere(['>=', 'fecha', $start_date]);
            $query->andFilterWhere(['<=', 'fecha', $end_date]);
        }
*/
        return $dataProvidercaja;
    }
}
