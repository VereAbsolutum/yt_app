<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap5\ButtonDropdown;

/* @var $this yii\web\View */
/* @var $model app\models\YourModel */
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
                                <?= Html::dropDownList('videoType', '20', [
                                    '20' => '20 minutos',
                                    '30' => '30 minutos',
                                    '60' => '1 hora'
                                ], [
                                    'class' => 'form-control' // Adicione esta classe para estilização Bootstrap
                                ]) ?>


                            </div>
                            <div class="btn-group">
                                <?= Html::submitButton('Criar <i class="fa fa-plus"></i>', ['class' => 'btn btn-success btn-right']) ?>
                            </div>
                        </div>

                    </div>


                    <?= $form->field($project, 'nome')->textInput()->label($project->getAttributeLabel('nome'))  ?>

                    <?= $form->field($video, 'link')->textInput()->label($video->getAttributeLabel('link'))  ?>

                    <label for="texto">Digite seu texto:</label>
                    <?= Html::textarea('texto', null, [
                        'id' => 'texto',
                        'class' => 'form-control',
                        'rows' => 6,
                        'required' => 'required'
                    ]) ?>

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
    <div class="row">
        <div class="col">
            <div class="card px-3 py-5">
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

            </div>
        </div>
    </div>
</div>