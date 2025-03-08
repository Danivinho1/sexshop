<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Proveedores $model */

$this->title = 'Create Proveedores';
$this->params['breadcrumbs'][] = ['label' => 'Proveedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proveedores-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
