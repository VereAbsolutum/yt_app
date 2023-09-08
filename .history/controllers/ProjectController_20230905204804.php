<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Projeto;
use app\models\TextoProcessado;

class ProjetoController extends Controller
{
    public function actionIndex()
    {
        $projetos = Projeto::find()->all();
        return $this->render('index', ['projetos' => $projetos]);
    }

    public function actionCreate()
    {
        $projeto = new Projeto();

        if ($projeto->load(Yii::$app->request->post()) && $projeto->save()) {
            // Dividir o texto em partes iguais de 100 caracteres
            $partes = str_split($projeto->texto, 100);

            // Criar uma nova instância do modelo TextoProcessado para cada parte
            foreach ($partes as $parte) {
                $textoProcessado = new TextoProcessado();
                $textoProcessado->id_projeto = $projeto->id;
                $textoProcessado->parte_texto = $parte;
                $textoProcessado->save();
            }

            return $this->redirect(['view', 'id' => $projeto->id]);
        }

        return $this->render('create', ['projeto' => $projeto]);
    }

    public function actionView($id)
    {
        $projeto = Projeto::findOne($id);
        return $this->render('view', ['projeto' => $projeto]);
    }

    public function actionUpdate($id)
    {
        $projeto = Projeto::findOne($id);

        if ($projeto->load(Yii::$app->request->post()) && $projeto->save()) {
            // Atualizar as partes do texto
            foreach ($projeto->textoProcessado as $textoProcessado) {
                if ($textoProcessado->load(Yii::$app->request->post()) && $textoProcessado->save()) {
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
        Projeto::findOne($id)->delete();
        return $this->redirect(['index']);
    }
}
