<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MetodosPago $model */

$this->title = 'Create Metodos Pago';
$this->params['breadcrumbs'][] = ['label' => 'Metodos Pagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metodos-pago-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
