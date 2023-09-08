<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\YourModel */
?>

<h1>Hello</h1>

<div class="your-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'attribute')->textarea(
        ['Option 1' => 'Option 1', 'Option 2' => 'Option 2'],
        ['prompt' => 'Select an option...']
    ); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>