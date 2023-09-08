<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $models app\models\YourModel[] */
?>

<?php foreach ($models as $model) : ?>
    <div class="your-model-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'attribute')->widget(Select2::classname(), [
            'data' => ['Option 1' => 'Option 1', 'Option 2' => 'Option 2'],
            'options' => ['placeholder' => 'Select an option...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php endforeach; ?>