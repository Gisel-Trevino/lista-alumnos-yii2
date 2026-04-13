<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "personas".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $apellido_pa
 * @property string|null $apellido_ma
 * @property string|null $foto
 * @property string $curp
 * @property string $telefono
 * @property string $email
 */
class Persona extends \yii\db\ActiveRecord
{
    public $archivo;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'personas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['apellido_pa', 'apellido_ma', 'foto'], 'default', 'value' => null],
            [['nombre', 'curp', 'telefono', 'email'], 'required'],
            [['nombre', 'apellido_pa', 'apellido_ma', 'email'], 'string', 'max' => 255],

            [['archivo'], 'file', 'extensions' => 'jpg, jpeg, png'],
            
            [['curp', 'telefono'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'curp' => 'CURP',
            'nombre' => 'Nombre',
            'apellido_pa' => 'Apellido Paterno',
            'apellido_ma' => 'Apellido Materno',
            'archivo' => 'Foto',
            'telefono' => 'Teléfono',
            'email' => 'Email',
        ];
    }

}
