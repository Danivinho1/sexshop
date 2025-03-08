<?php

use app\Models\Producto;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var app\models\ProductoSearch $searchModel */

$this->title = 'Productos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Producto', ['create'], ['class' => 'btn btn-success']) ?>
        <a href="<?= Yii::$app->urlManager->createUrl(['categorias/index']) ?>" class="btn btn-success">Categorias</a>
        <a href="<?= Yii::$app->urlManager->createUrl(['detalles-pedido/index']) ?>" class="btn btn-success">Detalles de pedido</a>
        <a href="<?= Yii::$app->urlManager->createUrl(['direcciones/index']) ?>" class="btn btn-success">Direcciones</a>
        <a href="<?= Yii::$app->urlManager->createUrl(['inventario/index']) ?>" class="btn btn-success">Inventario</a>
        <a href="<?= Yii::$app->urlManager->createUrl(['metodos-pago/index']) ?>" class="btn btn-success">Metodos de Pago</a>
        <a href="<?= Yii::$app->urlManager->createUrl(['pagos/index']) ?>" class="btn btn-success">Pagos</a>
        <a href="<?= Yii::$app->urlManager->createUrl(['proveedores/index']) ?>" class="btn btn-success">Proveedores</a>
        <a href="<?= Yii::$app->urlManager->createUrl(['pedidos/index']) ?>" class="btn btn-success">Pedidos</a>
        <a href="<?= Yii::$app->urlManager->createUrl(['resenas/index']) ?>" class="btn btn-success">Reseñas</a>
        <?= Html::a('Exportar Productos', ['producto/exportar'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= Html::beginForm(['producto/importar'], 'post', ['enctype' => 'multipart/form-data']) ?>
        <?= Html::fileInput('archivo_csv') ?>
        <?= Html::submitButton('Importar CSV', ['class' => 'btn btn-success']) ?>
    <?= Html::endForm() ?>

    <?php Pjax::begin(); ?>

    <div class="producto-search">
        <?php $form = ActiveForm::begin([
            'method' => 'get',
            'options' => ['data-pjax' => true]
        ]); ?>

        <?= $form->field($searchModel, 'nombre')->textInput(['placeholder' => 'Buscar producto...'])->label(false) ?>

        <?php ActiveForm::end(); ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => null,
        'columns' => [
            'id',
            'nombre',
            'precio',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
