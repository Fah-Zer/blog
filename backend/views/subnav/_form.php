<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Subnav */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subnav-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nav_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
