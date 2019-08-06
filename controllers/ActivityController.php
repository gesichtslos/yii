<?php

namespace app\controllers;

use app\base\BaseController;
use app\controllers\actions\activity\CreateAction;
use app\models\Activity;
use app\controllers\actions\activity\ViewAction;
use yii\web\HttpException;

class ActivityController extends BaseController
{
    public function actions()
    {
        return [
            'create' => ['class' => CreateAction::class, 'classEntity' => Activity::class],
            'view' => ['class' => ViewAction::class]
        ];
    }

    public function actionEdit($id)
    {
        $activity = \Yii::$app->activity->getActivityById($id);

        if (!$activity) {
            throw new HttpException(404, 'Событие не найдено');
        }

        if (\Yii::$app->request->isPost) {

            $activity->load(\Yii::$app->request->post());
            if (\Yii::$app->activity->editActivity($activity)) {
                return $this->redirect(['/activity/view', 'id' => $id]);
            }
        }

        return $this->render('edit', ['model' => $activity]);
    }
}