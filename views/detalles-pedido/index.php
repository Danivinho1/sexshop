<?php

use app\models\DetallesPedido;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Detalles Pedidos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detalles-pedido-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Detalles Pedido', ['create'], ['class' => 'btn btn-success']) ?>
        <a href="<?= Yii::$app->urlManager->createUrl(['categorias/index']) ?>" class="btn btn-success">Categorias</a>
        <a href="<?= Yii::$app->urlManager->createUrl(['producto/index']) ?>" class="btn btn-success">Productos</a>
        <a href="<?= Yii::$app->urlManager->createUrl(['direcciones/index']) ?>" class="btn btn-success">Direcciones</a>
        <a href="<?= Yii::$app->urlManager->createUrl(['inventario/index']) ?>" class="btn btn-success">Inventario</a>
        <a href="<?= Yii::$app->urlManager->createUrl(['metodos-pago/index']) ?>" class="btn btn-success">Metodos de Pago</a>
        <a href="<?= Yii::$app->urlManager->createUrl(['pagos/index']) ?>" class="btn btn-success">Pagos</a>
        <a href="<?= Yii::$app->urlManager->createUrl(['proveedores/index']) ?>" class="btn btn-success">Proveedores</a>
        <a href="<?= Yii::$app->urlManager->createUrl(['pedidos/index']) ?>" class="btn btn-success">Pedidos</a>
        <a href="<?= Yii::$app->urlManager->createUrl(['resenas/index']) ?>" class="btn btn-success">Reseñas</a>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_pedido',
            'id_producto',
            'cantidad',
            'precio_unitario',
            //'subtotal',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, DetallesPedido $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
