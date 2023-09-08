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
                'project' => $project,
                'processedText' => $processedText
            ]
        );
    }

    public function actionCreate()
    {
        $project = new Project();
        $processedText = new ProcessedText();


        if (
            $project->load(Yii::$app->request->post())
            && $project->save()
            && $processedText->load(Yii::$app->request->post()
                && !$processedText->texto !== null)
        ) {
            // Dividir o text em parts iguais de 100 caracteres
            var_dump($processedText->texto);
            $a = $processedText->texto;
            $parts = str_split($processedText->texto, 100);

            // Criar uma nova instância do modelo ProcessedText para cada part
            foreach ($parts as $part) {
                $processedText = new ProcessedText();
                $processedText->id_project = $project->id;
                $processedText->text_part = $part;
                $processedText->save();
            }

            return $this->redirect(['view', 'id' => $project->id]);
        }

        return $this->render('create', ['project' => $project]);
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
