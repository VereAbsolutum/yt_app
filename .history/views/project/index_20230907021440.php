<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\YourModel */
?>


<div class="container mb-3">

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

<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projetos';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <!-- <div class="row">
        <div class="col">
            <h1 class="mb-3">Youtube Project</h1>
        </div>
        <div class="col">
            <?= Html::a('Criar Novo Projeto', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div> -->
    <div class="row">
        <div class="col">
            <div class="card">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        'nome',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{update} {delete}',
                        ],
                    ],
                    'tableOptions' => ['class' => 'table table-responsive'],
                ]); ?>
            </div>
        </div>
    </div>
</div>