<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Project;
use app\models\ProcessedText;

class ProjectController extends Controller
{
    public function actionIndex()
    {
        $project = new Project();
        $processedText = new ProcessedText();
        return $this->render(
            'index',
            [
                'project' => $project
            ]
        );
    }

    public function actionCreate()
    {
        $project = new Project();
        $texto = Yii::$app->request->post('texto');
        var_dump($texto);

        if (
            // $processedText->load(Yii::$app->request->post())
            $texto !== null
            && $project->load(Yii::$app->request->post())
            && $project->save()
        ) {
            // Dividir o text em parts iguais de 100 caracteres
            $parts = str_split($texto, 10);

            // Criar uma nova instância do modelo ProcessedText para cada part
            foreach ($parts as $part) {
                var_dump($part);
                $processedText = new ProcessedText();
                $processedText->id_projeto = $project->id;
                $processedText->parte_texto = $part;
                $processedText->save();
            }

            return $this->redirect(['view', 'id' => $project->id]);
        }

        return $this->render('index', [
            'project' => $project
        ]);
    }

    public function actionView($id)
    {
        $project = Project::findOne($id);
        return $this->render('view', ['project' => $project]);
    }

    public function actionUpdate($id)
    {
        $project = Project::findOne($id);

        if ($project->load(Yii::$app->request->post()) && $project->save()) {
            // Atualizar as parts do text
            foreach ($project->processedText as $processedText) {
                if ($processedText->load(Yii::$app->request->post()) && $processedText->save()) {
                    // A part do text foi atualizada com sucesso
                } else {
                    // Ocorreu um erro ao atualizar a part do text
                }
            }

            return $this->redirect(['view', 'id' => $project->id]);
        }

        return $this->render('update', ['project' => $project]);
    }

    public function actionDelete($id)
    {
        Project::findOne($id)->delete();
        return $this->redirect(['index']);
    }
}
