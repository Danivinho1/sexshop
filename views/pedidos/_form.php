<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Pedidos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pedidos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_usuario')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'estado')->dropDownList([ 'pendiente' => 'Pendiente', 'enviado' => 'Enviado', 'entregado' => 'Entregado', 'cancelado' => 'Cancelado', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'id_metodo_pago')->textInput() ?>

    <?= $form->field($model, 'total')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
