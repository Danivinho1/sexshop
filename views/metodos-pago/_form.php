<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MetodosPago $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="metodos-pago-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'metodo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
