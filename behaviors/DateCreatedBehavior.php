<?php

namespace app\behaviors;


use yii\base\Behavior;

class DateCreatedBehavior extends Behavior
{
    public $attributeName;

    public function getDateCreated()
    {
        $date = $this->owner->{$this->attributeName};
        return \Yii::$app->formatter->asDatetime($date, 'php:d.n.Y H:i:s');
    }
}