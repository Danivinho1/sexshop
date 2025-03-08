<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "metodos_pago".
 *
 * @property int $id
 * @property string $metodo
 *
 * @property Pagos[] $pagos
 * @property Pedidos[] $pedidos
 */
class MetodosPago extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'metodos_pago';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['metodo'], 'required'],
            [['metodo'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'metodo' => 'Metodo',
        ];
    }

    /**
     * Gets query for [[Pagos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPagos()
    {
        return $this->hasMany(Pagos::class, ['id_metodo_pago' => 'id']);
    }

    /**
     * Gets query for [[Pedidos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedidos::class, ['id_metodo_pago' => 'id']);
    }

}
