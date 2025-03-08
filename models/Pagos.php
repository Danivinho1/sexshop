<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pagos".
 *
 * @property int $id
 * @property int|null $id_pedido
 * @property int|null $id_metodo_pago
 * @property float $monto
 * @property string|null $fecha_pago
 *
 * @property MetodosPago $metodoPago
 * @property Pedidos $pedido
 */
class Pagos extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pagos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pedido', 'id_metodo_pago'], 'default', 'value' => null],
            [['id_pedido', 'id_metodo_pago'], 'integer'],
            [['monto'], 'required'],
            [['monto'], 'number'],
            [['fecha_pago'], 'safe'],
            [['id_pedido'], 'exist', 'skipOnError' => true, 'targetClass' => Pedidos::class, 'targetAttribute' => ['id_pedido' => 'id']],
            [['id_metodo_pago'], 'exist', 'skipOnError' => true, 'targetClass' => MetodosPago::class, 'targetAttribute' => ['id_metodo_pago' => 'id']],
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
            'id_metodo_pago' => 'Id Metodo Pago',
            'monto' => 'Monto',
            'fecha_pago' => 'Fecha Pago',
        ];
    }

    /**
     * Gets query for [[MetodoPago]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMetodoPago()
    {
        return $this->hasOne(MetodosPago::class, ['id' => 'id_metodo_pago']);
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

}
