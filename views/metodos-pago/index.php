<?php

use app\models\MetodosPago;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Metodos Pagos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metodos-pago-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Metodos Pago', ['create'], ['class' => 'btn btn-success']) ?>
        <a href="<?= Yii::$app->urlManager->createUrl(['categorias/index']) ?>" class="btn btn-success">Categorias</a>
        <a href="<?= Yii::$app->urlManager->createUrl(['detalles-pedido/index']) ?>" class="btn btn-success">Detalles de pedido</a>
        <a href="<?= Yii::$app->urlManager->createUrl(['direcciones/index']) ?>" class="btn btn-success">Direcciones</a>
        <a href="<?= Yii::$app->urlManager->createUrl(['inventario/index']) ?>" class="btn btn-success">Inventario</a>
        <a href="<?= Yii::$app->urlManager->createUrl(['producto/index']) ?>" class="btn btn-success">Productos</a>
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
            'metodo',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, MetodosPago $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
