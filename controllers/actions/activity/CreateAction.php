<?php

namespace app\controllers\actions\activity;

use app\components\ActivityComponent;
use app\models\Activity;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

class CreateAction extends Action
{
    public $classEntity;

    public function run()
    {
        if (!\Yii::$app->rbac->canCreateActivity()) {
            throw new HttpException(403, 'Недостаточно прав');
        }
        $activityComponent = \Yii::createObject(['class' => ActivityComponent::class,
            'classEntity' => Activity::class]);
        $activity = $activityComponent->getEntity();
        $tableDb = \Yii::$app->activity->getNameTableDb();

        if (\Yii::$app->request->isPost) {
            $activity->load(\Yii::$app->request->post());
            if (\Yii::$app->request->isAjax) {
                \Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($activity);
            }

            if (\Yii::$app->activity->createActivity($activity)) {
                \Yii::$app->dao->insertActivityIntoDb($activity, $tableDb);
                return $this->controller->redirect(['/activity/view', 'id' => $activity->id]);
            }
        }

        return $this->controller->render('create', ['model' => $activity]);
    }
}