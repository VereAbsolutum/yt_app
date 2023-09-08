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
        $projeto = new Project();

        if ($projeto->load(Yii::$app->request->post()) && $projeto->save()) {
            // Dividir o texto em partes iguais de 100 caracteres
            $partes = str_split($projeto->texto, 100);

            // Criar uma nova instância do modelo ProcessedText para cada parte
            foreach ($partes as $parte) {
                $processedText = new ProcessedText();
                $processedText->id_projeto = $projeto->id;
                $processedText->parte_texto = $parte;
                $processedText->save();
            }

            return $this->redirect(['view', 'id' => $projeto->id]);
        }

        return $this->render('create', ['projeto' => $projeto]);
    }

    public function actionView($id)
    {
        $projeto = Project::findOne($id);
        return $this->render('view', ['projeto' => $projeto]);
    }

    public function actionUpdate($id)
    {
        $projeto = Project::findOne($id);

        if ($projeto->load(Yii::$app->request->post()) && $projeto->save()) {
            // Atualizar as partes do texto
            foreach ($projeto->processedText as $processedText) {
                if ($processedText->load(Yii::$app->request->post()) && $processedText->save()) {
                    // A parte do texto foi atualizada com sucesso
                } else {
                    // Ocorreu um erro ao atualizar a parte do texto
                }
            }

            return $this->redirect(['view', 'id' => $projeto->id]);
        }

        return $this->render('update', ['projeto' => $projeto]);
    }

    public function actionDelete($id)
    {
        Project::findOne($id)->delete();
        return $this->redirect(['index']);
    }
}
