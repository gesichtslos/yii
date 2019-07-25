<?php

namespace app\models;


use app\models\validations\TitleValidation;
use yii\base\Model;

class Activity extends Model
{
    public $title;
    public $description;
    public $dateStart;
    public $dateEnd;
    public $isBlocked;
    public $isRepeatable;
    public $repeatType;
    public $email;
    public $emailRepeat;
    public $useNotification;
    public $image;

    const REPEAT_TYPE = [
        '0'=>'Раз в день',
        '1'=>'Раз в неделю'
    ];

    public function beforeValidate()
    {
        $date = \DateTime::createFromFormat('d.m.Y', $this->dateStart);
        if ($date) {
            $this->dateStart = $date->format('Y-m-d');
        }
        $date = \DateTime::createFromFormat('d.m.Y', $this->dateEnd);
        if ($date) {
            $this->dateEnd = $date->format('Y-m-d');
        }
        return parent::beforeValidate();
    }

    public function rules()
    {
        return [
            ['image', 'file', 'maxFiles' => 5, 'extensions' => ['jpg', 'jpeg', 'png', 'gif', 'bmp']],
            [['title', 'email'], 'trim'],
            [['title', 'dateEnd'], 'required'],
            [['dateStart', 'dateEnd'], 'date', 'format' => 'php:Y-m-d'],
            ['description', 'string', 'min' => 5, 'max' => 300],
            [['isBlocked', 'isRepeatable', 'useNotification'], 'boolean'],
            ['email', 'email'],
            ['email', 'required', 'when' => function (Activity $model) {
                return $model->useNotification ? true : false;
            }],
            ['emailRepeat', 'compare', 'compareAttribute' => 'email', 'message' => 'Поля email не совпадают'],
            ['repeatType', 'in', 'range' => array_keys(self::REPEAT_TYPE)],
            ['title', TitleValidation::class, 'list' => ['admin']]
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'description' => 'Описание',
            'dateStart' => 'Дата начала',
            'dateEnd' => 'Дата окончания',
            'isBlocked' => 'Заблокировано',
            'isRepeatable' => 'Повторять',
            'useNotification' => 'Напоминать',
            'emailRepeat' => 'Повторите email',
            'repeatType' => 'Интервал повторений',
            'image' => 'Изображение'
        ];
    }
}