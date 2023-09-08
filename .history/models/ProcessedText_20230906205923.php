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
            [['id_projecto', 'parte_texto'], 'required'],
            ['id_projecto', 'integer'],
            [['parte_texto', 'parte_texto_processado'], 'string']
        ];
    }

    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'id_project']);
    }
}
