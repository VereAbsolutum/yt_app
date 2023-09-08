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
        $projects = Project::find()->all();
        return $this->render('index', ['projects' => $projects]);
    }

    public function actionCreate()
    {
        $project = new Project();

        if ($project->load(Yii::$app->request->post()) && $project->save()) {
            // Dividir o texto em partes iguais de 100 caracteres
            $partes = str_split($project->texto, 100);

            // Criar uma nova instância do modelo ProcessedText para cada parte
            foreach ($partes as $parte) {
                $processedText = new ProcessedText();
                $processedText->id_project = $project->id;
                $processedText->text_part = $parte;
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
            // Atualizar as partes do texto
            foreach ($project->processedText as $processedText) {
                if ($processedText->load(Yii::$app->request->post()) && $processedText->save()) {
                    // A parte do texto foi atualizada com sucesso
                } else {
                    // Ocorreu um erro ao atualizar a parte do texto
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
