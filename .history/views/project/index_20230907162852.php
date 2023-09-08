<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\YourModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projetos';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="container mb-5">
    <div class="row">
        <div class="col">
            <div class="card px-3 py-5">
                <div class="your-model-form">
                    <?php $form = ActiveForm::begin(['action' => ['create']]); ?>

                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="mb-3">Youtube Project</h1>
                        <div>
                            <div class="btn-group">
                                <?php if (!isset($dataProvider)) : ?>
                                    <?= Html::a('Cancelar', ['index'], ['class' => 'btn btn-danger']) ?>
                                <?php endif; ?>
                                <?= Html::submitButton(
                                    isset($dataProvider) ? 'Criar <i class="fa fa-plus"></i>' : 'Salvar <i class="fa fa-save"></i>',
                                    ['class' => isset($dataProvider) ? 'btn btn-primary' : 'btn btn-success']
                                ) ?>

                            </div>
                        </div>

                    </div>

                    <?= $form->field($project, 'nome')->textInput([
                        'value' => $project->nome ?? null, // Define o valor do campo nome com o valor do modelo, se estiver definido
                        'readonly' => !isset($dataProvider), // Define o campo como somente leitura se $dataProvider não estiver definido
                    ])->label($project->getAttributeLabel('nome')) ?>

                    <?= $form->field($video, 'link')->textInput([
                        'value' => $video->link ?? null, // Define o valor do campo link com o valor do modelo, se estiver definido
                    ])->label($video->getAttributeLabel('link'))  ?>

                    <?= $form->field($project, 'texto')->textarea([
                        'rows' => 6,
                        'value' => $project->texto ?? null, // Define o valor do campo texto com o valor do modelo, se estiver definido
                    ])->label('Digite seu texto:') ?>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container">
    <div class="row">
        <div class="col">
            <div class="card px-3 py-5">
                <?php if (isset($dataProvider)) : ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'caption' => 'Lista dos Projetos',
                        'columns' => [
                            'nome',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{update} {delete}',
                                'contentOptions' => ['style' => 'white-space: nowrap; width: 1%;'], // Ajusta a largura

                                'buttons' => [
                                    'update' => function ($url, $model, $key) {
                                        return Html::a('Alterar', ['update', 'id' => $model->id]);
                                    },
                                ],
                            ],
                        ],
                        'tableOptions' => ['class' => 'table table-responsive'],
                    ]); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>