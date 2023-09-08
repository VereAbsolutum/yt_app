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
            [['name'], 'required'],
            ['name', 'string', 'max' => 255],
        ];
    }

    public function getProcessedText()
    {
        return $this->hasMany(ProcessedText::classname(), ['id_projeto' => 'id']);
    }
}
