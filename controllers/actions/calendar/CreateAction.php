<?php

namespace app\controllers\actions\calendar;

use app\components\CalendarComponent;
use app\models\Calendar;
use yii\base\Action;

class CreateAction extends Action
{
    public $classEntity;
    public function run(){
        $calendarComponent = \Yii::createObject(['class' => CalendarComponent::class,
            'classEntity' => Calendar::class]);
        $calendar = $calendarComponent->getEntity();

        if(\Yii::$app->request->isPost){
            $calendar->load(\Yii::$app->request->post());
            if(\Yii::$app->calendar->createCalendar($calendar)){
                return $this->controller->render('view', ['model' => $calendar]);
            }
        }

        return $this->controller->render('view', ['model' => $calendar]);
    }
}