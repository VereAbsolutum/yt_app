<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\YourModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerJsFile('@web/js/get_transcript.js', [
    'depends' => [
        \yii\web\JqueryAsset::class
    ]
]);

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
                            </div>
                            <div class="btn-group">

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





                    <div class="form-group">
                        <?= $form->field($video, 'link', [
                            'template' => "{label}\n<div class='input-group'>{input}<span class='input-group-btn'><button type='button' class='btn btn-success ms-2' id='transcript-button'>Meu Botão</button></span></div>\n{hint}\n{error}",
                        ])->textInput([
                            'value' => $video->link ?? null,
                            'id' => 'video-link',
                        ])->label($video->getAttributeLabel('link')) ?>
                    </div>

                    <?= $form->field($project, 'texto')->textarea([
                        'rows' => 6,
                        'id' => 'video-text',
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


<?php
// Obtenha a chave de API do Yii2 params
$apiKey = Yii::$app->params['ytApiKey'];
?>

<?php
$js = <<<JS
    document.querySelector('#transcript-button').addEventListener('click', () => {
        // Get the value of the 'link' field
        const videoUrl = document.querySelector('#video-link').value;

        const apiKey = '$apiKey';

        // Call the 'get_transcription' function with the YouTube URL and your API key
        get_transcription(videoUrl, apiKey).then(transcript => {
            document.querySelector('#video-text').value = transcript;
        });
    });
JS;
$this->registerJs($js);
?>