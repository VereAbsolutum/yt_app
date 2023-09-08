<?php

namespace app\models;

use yii\db\ActiveRecord;

class Project extends ActiveRecord
{
    public static function tableName()
    {
        return 'projetos';
    }

    public function rules()
    {
        return [
            [['nome', 'texto'], 'required'],
            ['nome', 'string', 'max' => 255],
            ['texto', 'string'], // Declarar a coluna 'texto' como uma string
        ];
    }

    public function attributeLabels()
    {
        return [
            'nome' => 'Nome o Projeto'
        ];
    }

    public function getProcessedText()
    {
        return $this->hasMany(ProcessedText::class, ['id_projeto' => 'id']);
    }
}
