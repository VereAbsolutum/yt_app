<?php


namespace app\models;

use yii\db\ActiveRecord;


class Video extends ActiveRecord
{
    public static function tableName()
    {
        return 'videos';
    }

    public function rules()
    {
        return [
            [['id_projeto', 'link'], 'required'],
            [['id_projeto'], 'integer'],
            [['link'], 'string'],
        ];
    }



    public function attributeLabels()
    {
        return [
            'id_projeto' => 'ID do Projeto',
            'link' => 'Link do Video',
        ];
    }
}
