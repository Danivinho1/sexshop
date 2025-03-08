<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\DetallesPedido $model */

$this->title = 'Update Detalles Pedido: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Detalles Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="detalles-pedido-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
