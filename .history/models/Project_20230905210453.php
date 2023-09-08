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

    public function getTextoProcessado()
    {
        return $this->hasMany(TextoProcessado::class, ['id_projeto' => 'id']);
    }
}
