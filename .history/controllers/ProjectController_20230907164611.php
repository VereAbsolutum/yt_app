<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

use yii\web\NotFoundHttpException;

use app\models\Project;
use app\models\ProcessedText;
use app\models\Video;

use \app\util\Util;

use yii\data\ActiveDataProvider;

class ProjectController extends Controller
{
    public function actionIndex($project = null, $video = null, $dataProvider = false)
    {
        if (!isset($project) && !isset($video)) {
            $project = new Project();
            $video = new Video();
        }

        $query = Project::find()
            ->where(['status' => 'ativo'])
            ->orderBy(['created_at' => SORT_DESC]);

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


    public function actionUpdate($id)
    {
        $projectToUpdate = Project::findOne($id);

        if ($projectToUpdate === null) {
            throw new NotFoundHttpException('O projeto não foi encontrado.');
        }

        $videoToUpdate = Video::findOne(['id_projeto' => $id]);

        if ($videoToUpdate === null) {
            throw new NotFoundHttpException('O vídeo não foi encontrado.');
        }

        if ($projectToUpdate->load(Yii::$app->request->post()) && $videoToUpdate->load(Yii::$app->request->post())) {
            // Valide e salve o projeto
            if ($projectToUpdate->validate() && $projectToUpdate->save()) {
                // Valide e salve o vídeo
                if ($videoToUpdate->validate() && $videoToUpdate->save()) {
                    Yii::$app->session->setFlash('success', 'Projeto atualizado com sucesso.');
                    return $this->redirect(['index']);
                } else {
                    Yii::$app->session->setFlash('error', 'Erro ao salvar o vídeo.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Erro ao salvar o projeto.');
            }
        }

        // Renderize a mesma visão 'index' com os dados atualizados
        // return $this->render('index', [
        //     'project' => $projectToUpdate,
        //     'video' => $videoToUpdate,
        // ]);
        // Renderize a mesma visão 'index' com os dados atualizados
        $project = $projectToUpdate;
        $video = $videoToUpdate;
        return $this->redirect([
            'index',
            'project' => $project,
            'video' => $video,
            'dataProvider' => true
        ]);
    }


    // public function actionUpdate($id)
    // {
    //     $project = Project::findOne($id);

    //     if ($project === null) {
    //         throw new NotFoundHttpException('O projeto não foi encontrado.');
    //     }

    //     $video = Video::findOne(['id_projeto' => $id]);

    //     if ($video === null) {
    //         throw new NotFoundHttpException('O vídeo não foi encontrado.');
    //     }

    //     if ($project->load(Yii::$app->request->post()) && $video->load(Yii::$app->request->post())) {
    //         // Valide e salve o projeto
    //         if ($project->validate() && $project->save()) {
    //             // Valide e salve o vídeo
    //             if ($video->validate() && $video->save()) {
    //                 Yii::$app->session->setFlash('success', 'Projeto atualizado com sucesso.');
    //                 return $this->redirect(['index']);
    //             } else {
    //                 Yii::$app->session->setFlash('error', 'Erro ao salvar o vídeo.');
    //             }
    //         } else {
    //             Yii::$app->session->setFlash('error', 'Erro ao salvar o projeto.');
    //         }
    //     }

    //     // return $this->render('update', [
    //     //     'project' => $project,
    //     //     'video' => $video,
    //     // ]);
    //     return $this->redirect([
    //         'index',
    //         'project' => $project,
    //         'video' => $video
    //     ]);
    // }
    public function actionCreate()
    {
        $project = new Project();
        $video = new Video();
        // $texto = Yii::$app->request->post('texto');
        // $videoType = Yii::$app->request->post('videoType');
        // $arrVideoTotalTimeMin = [
        //     20 => 15,
        //     30 => 20,
        //     60 => 40,
        // ];

        if (
            // $videoType !== null
            // && $texto !== null
            // && 
            $project->load(Yii::$app->request->post())
            && $video->load(Yii::$app->request->post())
        ) {
            $project->save();
            $video->id_projeto = $project->id;
            $video->save();

            // $max_token = $arrVideoTotalTimeMin[$videoType];
            // $parts = Util::split_text_into_part($max_token, $texto);

            // foreach ($parts as $key => $part) {
            //     $processedText = new ProcessedText();
            //     $processedText->id_projeto = $project->id;
            //     $processedText->parte_texto = $part;
            //     $processedText->parte = $key;
            //     $processedText->save();
            // }


        }
        return $this->redirect(['index']);
        // $query = Project::find()
        //     ->where(['status' => 'ativo'])
        //     ->orderBy(['created_at' => SORT_DESC]);

        // $dataProvider = new ActiveDataProvider([
        //     'query' => $query,
        //     'pagination' => [
        //         'pageSize' => 10,
        //     ],
        // ]);

        // return $this->render('index', [
        //     'project' => $project,
        //     'video' => $video,
        //     'dataProvider' => $dataProvider
        // ]);
    }





    public function actionView($id)
    {
        $project = Project::findOne($id);
        return $this->render('view', ['project' => $project]);
    }

    public function actionDelete($id)
    {
        Project::findOne($id)->delete();
        return $this->redirect(['index']);
    }
}
