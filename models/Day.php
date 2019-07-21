<?php

namespace app\models;


use yii\base\Model;

class Day extends Model
{
    public $title;
    public $workday;
    public $actions;

    public function rules(){
        return [
            ['title', 'required'],
            ['workday', 'boolean'],
            ['actions', 'string']
        ];
    }

    public function attributeLabels()
    {
        return [
            'title'=>'Заголовок',
            'workday'=>'Рабочий день',
            'actions'=>'События'
        ];
    }
}