<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MetodosPago $model */

$this->title = 'Update Metodos Pago: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Metodos Pagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="metodos-pago-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
