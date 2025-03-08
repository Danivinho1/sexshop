<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\DetallesPedido $model */

$this->title = 'Create Detalles Pedido';
$this->params['breadcrumbs'][] = ['label' => 'Detalles Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detalles-pedido-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
