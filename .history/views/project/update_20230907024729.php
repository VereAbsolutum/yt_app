<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
?>

<h1>Consulta API</h1>

<div class="container">
    <div class="row">
        <div class="col-md-5">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'input')->textarea(['rows' => 6])->label('Entrada') ?>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-md-2 text-center align-self-center">
            <?= Html::button('Consultar', ['class' => 'btn btn-primary', 'id' => 'consult-button']) ?>
        </div>
        <div class="col-md-5">
            <?= Html::textarea('output', '', ['class' => 'form-control', 'rows' => 6, 'readonly' => true, 'id' => 'output']) ?>
        </div>
    </div>
</div>

<?php
$js = <<<JS
    $('#consult-button').on('click', function() {
        var input = $('#input').val();
        $.ajax({
            url: '<URL da API>',
            type: 'POST',
            data: {input: input},
            success: function(data) {
                $('#output').val(data);
            }
        });
    });
JS;
$this->registerJs($js);
