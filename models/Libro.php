<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "libros".
 *
 * @property int $id
 * @property string $titulo
 * @property string $imagen
 */
class Libro extends \yii\db\ActiveRecord
{
    public $archivo; // Atributo para manejar el archivo subido
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'libros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'titulo', 'archivo'], 'required'],
            [['id'], 'default', 'value' => null],
            [['id'], 'integer'],
            [['titulo'], 'string', 'max' => 255],
            [['archivo'], 'file', 'extensions' => 'jpg,png'],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'archivo' => 'Archivo',
        ];
    }

}
