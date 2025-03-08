<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proveedores".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $telefono
 * @property string|null $email
 * @property string|null $direccion
 *
 * @property Producto[] $productos
 */
class Proveedores extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proveedores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['telefono', 'email', 'direccion'], 'default', 'value' => null],
            [['nombre'], 'required'],
            [['direccion'], 'string'],
            [['nombre'], 'string', 'max' => 255],
            [['telefono'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'telefono' => 'Telefono',
            'email' => 'Email',
            'direccion' => 'Direccion',
        ];
    }

    /**
     * Gets query for [[Productos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::class, ['id_proveedor' => 'id']);
    }

}
