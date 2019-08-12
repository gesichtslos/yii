<?php

namespace app\commands;


use app\components\NotificationComponent;
use yii\console\Controller;

class NotificationController extends Controller
{
    public $text;

    public function optionAliases()
    {
        return ['t' => 'text'];
    }

    public function options($actionID)
    {
        return ['text'];
    }

    public function actionTest()
    {
        echo $this->text . PHP_EOL;
    }

    public function actionSendCurrent()
    {
        $activities = \Yii::$app->activity->getCurrentActivityNotifications();
        echo 'Необходимо отправить писем: ' . count($activities) . PHP_EOL;
        $notification = \Yii::createObject(['class' => NotificationComponent::class, 'mailer' => \Yii::$app->mailer]);
        $notification->sendNotificationByEmail($activities);
    }
}