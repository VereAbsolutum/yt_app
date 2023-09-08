<?php

namespace app\models;

use yii\db\ActiveRecord;

class Projeto extends ActiveRecord
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
}
