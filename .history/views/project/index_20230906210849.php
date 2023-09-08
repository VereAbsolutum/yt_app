<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\YourModel */
?>

<h1>Hello</h1>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="your-model-form">

                    <?php $form = ActiveForm::begin(['action' => ['save']]); ?>

                    <?= $form->field($project, 'nome')->textInput()->label($project->getAttributeLabel('nome'))  ?>

                    <?= $form->field($processedText, 'texto')->textarea(['rows' => 6])->label($processedText->getAttributeLabel('texto')) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>