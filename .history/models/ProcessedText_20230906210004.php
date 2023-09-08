<?php

namespace app\models;

use yii\db\ActiveRecord;

class ProcessedText extends ActiveRecord
{
    public $texto;

    public static function tableName()
    {
        return 'processed_text';
    }

    public function rules()
    {
        return [
            [['id_projeto', 'parte_texto'], 'required'],
            ['id_projeto', 'integer'],
            [['parte_texto', 'parte_texto_processado'], 'string']
        ];
    }

    public function attributes()
    {
    }

    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'id_project']);
    }
}
