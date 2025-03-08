<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detalles_pedido".
 *
 * @property int $id
 * @property int|null $id_pedido
 * @property int|null $id_producto
 * @property int $cantidad
 * @property float $precio_unitario
 * @property float|null $subtotal
 *
 * @property Pedidos $pedido
 * @property Producto $producto
 */
class DetallesPedido extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detalles_pedido';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pedido', 'id_producto', 'subtotal'], 'default', 'value' => null],
            [['id_pedido', 'id_producto', 'cantidad'], 'integer'],
            [['cantidad', 'precio_unitario'], 'required'],
            [['precio_unitario', 'subtotal'], 'number'],
            [['id_pedido'], 'exist', 'skipOnError' => true, 'targetClass' => Pedidos::class, 'targetAttribute' => ['id_pedido' => 'id']],
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
            'id_pedido' => 'Id Pedido',
            'id_producto' => 'Id Producto',
            'cantidad' => 'Cantidad',
            'precio_unitario' => 'Precio Unitario',
            'subtotal' => 'Subtotal',
        ];
    }

    /**
     * Gets query for [[Pedido]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedido()
    {
        return $this->hasOne(Pedidos::class, ['id' => 'id_pedido']);
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

}
