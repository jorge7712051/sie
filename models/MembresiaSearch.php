<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Membresia;

/**
 * MembresiaSearch represents the model behind the search form of `app\models\Membresia`.
 */
class MembresiaSearch extends Membresia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['identificacion'], 'number'],
            [['sexo', 'Nombres', 'Apellidos', 'Direccion', 'barrio', 'Telefono', 'Celular', 'Lugar_Nacimiento', 'Fecha_Nacimiento', 'estado_civil', 'conyuge', 'nivel_estudios', 'estudios_tecnicos', 'estudios_profesionales', 'estudios_noformales', 'fecha_bautismo', 'fecha_conversion', 'formacion_teologica', 'cargo_iglesia', 'ministerio_afin', 'fecha_ingreso', 'fecha_retiro', 'tipo', 'motivo_retiro'], 'safe'],
            [['cc', 'numero_hijos', 'activo'], 'integer'],
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
        $query = Membresia::find();

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
            'identificacion' => $this->identificacion,
            'Fecha_Nacimiento' => $this->Fecha_Nacimiento,
            'fecha_bautismo' => $this->fecha_bautismo,
            'fecha_conversion' => $this->fecha_conversion,
            'cc' => $this->cc,
            'fecha_ingreso' => $this->fecha_ingreso,
            'fecha_retiro' => $this->fecha_retiro,
            'numero_hijos' => $this->numero_hijos,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['like', 'sexo', $this->sexo])
            ->andFilterWhere(['like', 'Nombres', $this->Nombres])
            ->andFilterWhere(['like', 'Apellidos', $this->Apellidos])
            ->andFilterWhere(['like', 'Direccion', $this->Direccion])
            ->andFilterWhere(['like', 'barrio', $this->barrio])
            ->andFilterWhere(['like', 'Telefono', $this->Telefono])
            ->andFilterWhere(['like', 'Celular', $this->Celular])
            ->andFilterWhere(['like', 'Lugar_Nacimiento', $this->Lugar_Nacimiento])
            ->andFilterWhere(['like', 'estado_civil', $this->estado_civil])
            ->andFilterWhere(['like', 'conyuge', $this->conyuge])
            ->andFilterWhere(['like', 'nivel_estudios', $this->nivel_estudios])
            ->andFilterWhere(['like', 'estudios_tecnicos', $this->estudios_tecnicos])
            ->andFilterWhere(['like', 'estudios_profesionales', $this->estudios_profesionales])
            ->andFilterWhere(['like', 'estudios_noformales', $this->estudios_noformales])
            ->andFilterWhere(['like', 'formacion_teologica', $this->formacion_teologica])
            ->andFilterWhere(['like', 'cargo_iglesia', $this->cargo_iglesia])
            ->andFilterWhere(['like', 'ministerio_afin', $this->ministerio_afin])
            ->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'motivo_retiro', $this->motivo_retiro]);

        return $dataProvider;
    }
}
