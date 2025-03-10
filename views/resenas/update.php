<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Resenas $model */

$this->title = 'Update Resenas: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Resenas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="resenas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
