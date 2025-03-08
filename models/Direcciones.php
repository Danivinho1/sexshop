<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "direcciones".
 *
 * @property int $id
 * @property int|null $id_usuario
 * @property string $direccion
 * @property string|null $ciudad
 * @property string|null $pais
 * @property string|null $codigo_postal
 *
 * @property Usuarios $usuario
 */
class Direcciones extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'direcciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_usuario', 'ciudad', 'pais', 'codigo_postal'], 'default', 'value' => null],
            [['id_usuario'], 'integer'],
            [['direccion'], 'required'],
            [['direccion'], 'string'],
            [['ciudad', 'pais'], 'string', 'max' => 100],
            [['codigo_postal'], 'string', 'max' => 20],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['id_usuario' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_usuario' => 'Id Usuario',
            'direccion' => 'Direccion',
            'ciudad' => 'Ciudad',
            'pais' => 'Pais',
            'codigo_postal' => 'Codigo Postal',
        ];
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::class, ['id' => 'id_usuario']);
    }

}
