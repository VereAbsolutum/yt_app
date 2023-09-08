<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

use app\models\Project;
use app\models\ProcessedText;
use app\models\Video;

use yii\data\ActiveDataProvider;

class ProjectController extends Controller
{
    public function actionIndex()
    {
        $project = new Project();
        $video = new Video();

        $query = Project::find()
            ->where(['status' => 'ativo'])
            ->orderBy(['created_at' => SORT_DESC]);

        // Configurar o DataProvider
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'project' => $project,
            'video' => $video,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCreate()
    {
        $project = new Project();
        $video = new Video();
        $texto = Yii::$app->request->post('texto');

        if (
            $texto !== null
            && $project->load(Yii::$app->request->post())
            && $project->save()
            && $video->load(Yii::$app->request->post())
            && $video->save()
        ) {
            // Dividir o text em parts iguais de 100 caracteres
            $parts = str_split($texto, 10);

            // Criar uma nova instância do modelo ProcessedText para cada part
            foreach ($parts as $key => $part) {
                var_dump($part);
                $processedText = new ProcessedText();
                $processedText->id_projeto = $project->id;
                $processedText->parte_texto = $part;
                $processedText->parte = $key;
                $processedText->save();
            }

            return $this->redirect(['view', 'id' => $project->id]);
        }

        return $this->render('index', [
            'project' => $project,
            'video' => $video
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
