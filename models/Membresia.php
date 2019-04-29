<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "membresia".
 *
 * @property double $identificacion
 * @property string $sexo
 * @property string $Nombres
 * @property string $Apellidos
 * @property string $Direccion
 * @property string $barrio
 * @property string $Telefono
 * @property string $Celular
 * @property string $Lugar_Nacimiento
 * @property string $Fecha_Nacimiento
 * @property string $estado_civil
 * @property string $conyuge
 * @property string $nivel_estudios
 * @property string $estudios_tecnicos
 * @property string $estudios_profesionales
 * @property string $estudios_noformales
 * @property string $fecha_bautismo
 * @property string $fecha_conversion
 * @property string $formacion_teologica
 * @property string $cargo_iglesia
 * @property string $ministerio_afin
 * @property int $cc
 * @property string $fecha_ingreso
 * @property string $fecha_retiro
 * @property string $tipo
 * @property int $numero_hijos
 * @property int $activo
 * @property string $motivo_retiro
 */
class Membresia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'membresia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['identificacion','Nombres', 'Apellidos','Fecha_Nacimiento','fecha_ingreso'], 'required'],
            [['identificacion'], 'number'],
            [['Fecha_Nacimiento', 'fecha_bautismo', 'fecha_conversion', 'fecha_ingreso', 'fecha_retiro'], 'safe'],
            [['estudios_noformales', 'formacion_teologica', 'motivo_retiro'], 'string'],
            [['cc', 'numero_hijos', 'activo'], 'integer'],
            [['sexo'], 'string', 'max' => 1],
            [['Nombres', 'Apellidos'], 'string', 'max' => 155],
            [['Direccion', 'barrio', 'Telefono', 'Celular', 'Lugar_Nacimiento', 'estado_civil', 'conyuge', 'nivel_estudios', 'estudios_tecnicos', 'estudios_profesionales', 'cargo_iglesia', 'ministerio_afin'], 'string', 'max' => 45],
            [['tipo'], 'string', 'max' => 60],
            [['identificacion'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'identificacion' => 'Identificacion',
            'sexo' => 'Sexo',
            'Nombres' => 'Nombres',
            'Apellidos' => 'Apellidos',
            'Direccion' => 'Direccion',
            'barrio' => 'Barrio',
            'Telefono' => 'Telefono',
            'Celular' => 'Celular',
            'Lugar_Nacimiento' => 'Lugar Nacimiento',
            'Fecha_Nacimiento' => 'Fecha Nacimiento',
            'estado_civil' => 'Estado Civil',
            'conyuge' => 'Conyuge',
            'nivel_estudios' => 'Nivel Estudios',
            'estudios_tecnicos' => 'Estudios Tecnicos',
            'estudios_profesionales' => 'Estudios Profesionales',
            'estudios_noformales' => 'Estudios No formales',
            'fecha_bautismo' => 'Fecha Bautismo',
            'fecha_conversion' => 'Fecha Conversion',
            'formacion_teologica' => 'Formacion Teologica',
            'cargo_iglesia' => 'Cargo Iglesia',
            'ministerio_afin' => 'Ministerio Afin',
            'cc' => 'Cc',
            'fecha_ingreso' => 'Fecha Ingreso',
            'fecha_retiro' => 'Fecha Retiro',
            'tipo' => 'Calidad de miembro',
            'numero_hijos' => 'Numero Hijos',
            'activo' => 'Activo',
            'motivo_retiro' => 'Motivo Retiro',
        ];
    }
}
