<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resenas".
 *
 * @property int $id
 * @property int|null $id_usuario
 * @property int|null $id_producto
 * @property int|null $calificacion
 * @property string|null $comentario
 * @property string $fecha
 *
 * @property Producto $producto
 * @property Usuarios $usuario
 */
class Resenas extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resenas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_producto', 'calificacion', 'comentario'], 'default', 'value' => null],
            [['id_usuario', 'id_producto', 'calificacion'], 'integer'],
            [['comentario'], 'string'],
            [['fecha'], 'safe'],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['id_usuario' => 'id']],
            [['id_producto'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::class, 'targetAttribute' => ['id_producto' => 'id']],
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
            'id_producto' => 'Id Producto',
            'calificacion' => 'Calificacion',
            'comentario' => 'Comentario',
            'fecha' => 'Fecha',
        ];
    }

    /**
     * Gets query for [[Producto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Producto::class, ['id' => 'id_producto']);
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
