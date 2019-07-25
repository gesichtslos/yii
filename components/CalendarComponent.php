<?php

namespace app\components;


use yii\base\Component;

class CalendarComponent extends Component
{
    public $classEntity;

    public function init(){
        parent::init();
        if(empty($this->classEntity)){
            throw new \Exception('classEntity param required');
        }
    }

    public function getEntity(){
        return new $this->classEntity();
    }

    public function createCalendar($model): bool{
        if($model->validate()){
            return true;
        }
        return false;
    }
}