<?php

namespace app\models;


use yii\base\Model;

class Activity extends Model
{
    public $title;
    public $description;
    public $dateStart;
    public $dateEnd;
    public $isBlocked;
    public $isRepeatable;

    public function rules(){
        return [
            ['title', 'required'],
            ['description', 'string', 'min' => 5],
            ['dateStart', 'string'],
            ['dateEnd', 'string'],
            ['isBlocked', 'boolean'],
            ['isRepeatable', 'boolean']
        ];
    }

    public function attributeLabels()
    {
        return [
            'title'=>'Заголовок',
            'description'=>'Описание',
            'dateStart'=>'Дата начала',
            'dateEnd'=>'Дата окончания',
            'isBlocked'=>'Заблокировано',
            'isRepeatable'=>'Повторять'
        ];
    }
}