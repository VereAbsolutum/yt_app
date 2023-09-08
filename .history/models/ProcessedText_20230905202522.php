<?php

namespace app\models;

use yii\db\ActiveRecord;

class TextoProcessado extends ActiveRecord
{
    public static function tableName()
    {
        return 'texto_processado';
    }

    public function rules()
    {
        return [
            [['id_projeto', 'parte_texto'], 'required'],
            ['id_projeto', 'integer'],
            [['parte_texto', 'parte_texto_processado'], 'string']
        ];
    }

    public function getProjeto()
    {
        return $this->hasOne(Projeto::class, ['id' => 'id_projeto']);
    }
}
