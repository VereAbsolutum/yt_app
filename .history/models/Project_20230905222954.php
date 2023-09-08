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
            ['texto', 'string']
        ];
    }

    public function getProcessedText()
    {
        return $this->hasMany(ProcessedText::classname(), ['id_projeto' => 'id']);
    }
}
