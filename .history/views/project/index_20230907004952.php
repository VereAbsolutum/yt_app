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


                    <?php $form = ActiveForm::begin(['action' => ['create']]); ?>

                    <?= $form->field($project, 'nome')->textInput()->label($project->getAttributeLabel('nome'))  ?>

                    <!-- <?= $form->field($processedText, 'texto')->textarea(['rows' => 6])->label($processedText->getAttributeLabel('texto')) ?> -->

                    <label for="texto">Digite seu texto:</label>
                    <?= Html::textarea('texto', null, ['id' => 'texto', 'class' => 'form-control', 'rows' => 6]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>