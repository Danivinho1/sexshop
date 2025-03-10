<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedidos".
 *
 * @property int $id
 * @property int|null $id_usuario
 * @property string $fecha
 * @property string|null $estado
 * @property int|null $id_metodo_pago
 * @property float $total
 *
 * @property DetallesPedido[] $detallesPedidos
 * @property MetodosPago $metodoPago
 * @property Pagos[] $pagos
 * @property Usuarios $usuario
 */
class Pedidos extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const ESTADO_PENDIENTE = 'pendiente';
    const ESTADO_ENVIADO = 'enviado';
    const ESTADO_ENTREGADO = 'entregado';
    const ESTADO_CANCELADO = 'cancelado';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedidos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_metodo_pago'], 'default', 'value' => null],
            [['estado'], 'default', 'value' => 'pendiente'],
            [['id_usuario', 'id_metodo_pago'], 'integer'],
            [['fecha'], 'safe'],
            [['estado'], 'string'],
            [['total'], 'required'],
            [['total'], 'number'],
            ['estado', 'in', 'range' => array_keys(self::optsEstado())],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['id_usuario' => 'id']],
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
            'id_usuario' => 'Id Usuario',
            'fecha' => 'Fecha',
            'estado' => 'Estado',
            'id_metodo_pago' => 'Id Metodo Pago',
            'total' => 'Total',
        ];
    }

    /**
     * Gets query for [[DetallesPedidos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetallesPedidos()
    {
        return $this->hasMany(DetallesPedido::class, ['id_pedido' => 'id']);
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
     * Gets query for [[Pagos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPagos()
    {
        return $this->hasMany(Pagos::class, ['id_pedido' => 'id']);
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


    /**
     * column estado ENUM value labels
     * @return string[]
     */
    public static function optsEstado()
    {
        return [
            self::ESTADO_PENDIENTE => 'pendiente',
            self::ESTADO_ENVIADO => 'enviado',
            self::ESTADO_ENTREGADO => 'entregado',
            self::ESTADO_CANCELADO => 'cancelado',
        ];
    }

    /**
     * @return string
     */
    public function displayEstado()
    {
        return self::optsEstado()[$this->estado];
    }

    /**
     * @return bool
     */
    public function isEstadoPendiente()
    {
        return $this->estado === self::ESTADO_PENDIENTE;
    }

    public function setEstadoToPendiente()
    {
        $this->estado = self::ESTADO_PENDIENTE;
    }

    /**
     * @return bool
     */
    public function isEstadoEnviado()
    {
        return $this->estado === self::ESTADO_ENVIADO;
    }

    public function setEstadoToEnviado()
    {
        $this->estado = self::ESTADO_ENVIADO;
    }

    /**
     * @return bool
     */
    public function isEstadoEntregado()
    {
        return $this->estado === self::ESTADO_ENTREGADO;
    }

    public function setEstadoToEntregado()
    {
        $this->estado = self::ESTADO_ENTREGADO;
    }

    /**
     * @return bool
     */
    public function isEstadoCancelado()
    {
        return $this->estado === self::ESTADO_CANCELADO;
    }

    public function setEstadoToCancelado()
    {
        $this->estado = self::ESTADO_CANCELADO;
    }
}
