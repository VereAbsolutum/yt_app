<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\YourModel */
?>


<div class="container">

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="your-model-form">

                    <?php $form = ActiveForm::begin(['action' => ['create']]); ?>

                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="mb-3">Youtube Project</h1>
                        <div class="">
                            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>


                    <?= $form->field($project, 'nome')->textInput()->label($project->getAttributeLabel('nome'))  ?>

                    <label for="texto">Digite seu texto:</label>
                    <?= Html::textarea('texto', null, ['id' => 'texto', 'class' => 'form-control', 'rows' => 6]) ?>



                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>