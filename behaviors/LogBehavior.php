<?php

namespace app\behaviors;


use app\components\ActivityComponent;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class LogBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'logIt',
            ActivityComponent::EVENT_CUSTOM_EVENT => 'logIt'
        ];
    }

    public function logIt()
    {
        \Yii::warning('Behavior log');
    }
}