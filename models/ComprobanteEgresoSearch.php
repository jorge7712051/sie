<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ComprobanteEgreso;
use app\models\ComprobanteBanco;
use yii\db\ActiveQuery;
use yii\db\Query;

/**
 * ComprobanteEgresoSearch represents the model behind the search form of `app\models\ComprobanteEgreso`.
 */
class ComprobanteEgresoSearch extends ComprobanteEgreso
{
    /**
     * {@inheritdoc}
     */
    
    public $fecha_informe;
    public $idiglesia;

    public function rules()
    {
        return [
            [['idcomprobante', 'bloqueo', 'idcentrocostos', 'idanulo'], 'integer'],
            [['fecha_creacion', 'fecha', 'adjunto', 'codigo','alta','anulado','fecha_informe'], 'safe'],
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
                $query = ComprobanteEgreso::find();
                $query->where('idanulo=0'); 
                $query->orderBy(['fecha' => SORT_ASC]) ;

            }
            else{
                $query = ComprobanteEgreso::find();
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
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idcomprobante' => $this->idcomprobante,
            'fecha_creacion' => $this->fecha_creacion,
            'bloqueo' => $this->bloqueo,
            'valor' => $this->valor,
            'alta' => $this->alta,
            'idcentrocostos' => $this->idcentrocostos,
            'idanulo' => $this->idanulo,
            'anulado' => $this->anulado,
        ]);

        $query->andFilterWhere(['like', 'adjunto', $this->adjunto])
            ->andFilterWhere(['like', 'codigo', $this->codigo]);

        if(!empty($this->fecha) && strpos($this->fecha, '-') !== false) {
            list($start_date, $end_date) = explode(' - ', $this->fecha);
            $query->andFilterWhere(['>=', 'fecha', $start_date]);
            $query->andFilterWhere(['<=', 'fecha', $end_date]);
        }

        return $dataProvider;
    }

        public function searchcomprobantebanco($params)
    {
        $session = Yii::$app->session;
        if ($session->isActive)
        {
            if($session->get('rol')==1)
            {
                $query = ComprobanteBanco::find()->select(
                    ['fecha_informe'=>'fecha',
                     'idcomprobante'=>'idcomprobante', 
                     'idiglesia'=>'idcentrocostos',
                     'idtercero'=>'idtercero',
                     'valor_total'=>'valor_d',
                     'idconcepto'=>'idconcepto',
                     'area'=>'area',
                     'centrocosto'=>'centrocosto',
                     'retencion'=>'subtotal',
                     'subtotal'=>'total'



                    ]);


            }
            else{
                $query = ComprobanteBanco::find();
                $query->where('idcentrocostos='.$session->get('centrocostos'));
                $query->orderBy(['fecha' => SORT_ASC]) ;

            }
        }
        // add conditions that should always apply here

        $dataProviderbanco = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProviderbanco;
        }

        // grid filtering conditions
        $query->andFilterWhere(['>=', 'fecha', $this->fecha_informe."-01"]);
         $query->andFilterWhere(['<=', 'fecha', $this->fecha_informe."-30"]);

        
/*
        if(!empty($this->fecha) && strpos($this->fecha, '-') !== false) {
            list($start_date, $end_date) = explode(' - ', $this->fecha);
            $query->andFilterWhere(['>=', 'fecha', $start_date]);
            $query->andFilterWhere(['<=', 'fecha', $end_date]);
        }
*/
        return $dataProviderbanco;
    }
}
