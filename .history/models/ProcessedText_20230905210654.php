<?php

namespace app\models;

use yii\db\ActiveRecord;

class ProcessedText extends ActiveRecord
{
    public static function tableName()
    {
        return 'processed_text';
    }

    public function rules()
    {
        return [
            [['id_project', 'parte_texto'], 'required'],
            ['id_project', 'integer'],
            [['parte_texto', 'parte_processed_text'], 'string']
        ];
    }

    public function getProject()
    {
        return $this->hasOne(Project::class, ['id' => 'id_project']);
    }
}
