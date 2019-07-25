<?php

namespace app\controllers\actions\activity;

use app\components\ActivityComponent;
use app\models\Activity;
use yii\base\Action;
use yii\web\Response;
use yii\widgets\ActiveForm;

class CreateAction extends Action
{
    public $classEntity;

    public function run()
    {
        $activityComponent = \Yii::createObject(['class' => ActivityComponent::class,
            'classEntity' => Activity::class]);
        $activity = $activityComponent->getEntity();

        if (\Yii::$app->request->isPost) {
            $activity->load(\Yii::$app->request->post());
            if(\Yii::$app->request->isAjax){
                \Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($activity);
            }

            if (\Yii::$app->activity->createActivity($activity)) {
                return $this->controller->render('view', ['model' => $activity]);
//                return $this->controller->redirect('/');
            }
        }

        return $this->controller->render('create', ['model' => $activity]);
    }
}