<?php

namespace app\models;

use yii\db\ActiveRecord;

class ProcessedText extends ActiveRecord
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

    public function attributeLabels()
    {
        return [
            'id_projeto' => 'ID do Projeto',
            'parte_texto' => 'Parte do Texto',
            'parte_texto_processado' => 'Parte do Texto Processado',
            'texto' => 'Texto'
        ];
    }

    public function getProject()
    {
        return $this->hasOne(Project::class, ['id' => 'id_project']);
    }
}
