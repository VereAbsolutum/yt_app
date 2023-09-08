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
            [['nome'], 'required'],
            ['nome', 'string', 'max' => 255],
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
        return $this->hasMany(ProcessedText::classname(), ['id_projeto' => 'id']);
    }
}
