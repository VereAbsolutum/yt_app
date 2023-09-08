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
            [['id_project', 'parte_texto'], 'required'],
            ['id_project', 'integer'],
            [['parte_texto', 'parte_texto_processado'], 'string']
        ];
    }

    public function getProjeto()
    {
        return $this->hasOne(Projeto::class, ['id' => 'id_project']);
    }
}
