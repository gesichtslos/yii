<?php

namespace app\controllers\actions\day;

use app\components\DayComponent;
use app\models\Day;
use yii\base\Action;

class CreateAction extends Action
{
    public $classEntity;
    public function run(){
        $dayComponent = \Yii::createObject(['class' => DayComponent::class,
            'classEntity' => Day::class]);
        $day = $dayComponent->getEntity();

        if(\Yii::$app->request->isPost){
            $day->load(\Yii::$app->request->post());
            if(\Yii::$app->day->createDay($day)){
                return $this->controller->redirect('/');
            }
        }

        return $this->controller->render('create', ['model'=>$day]);
    }
}