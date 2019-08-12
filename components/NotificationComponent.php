<?php

namespace app\components;


use yii\base\Component;
use yii\helpers\Console;
use yii\mail\MailerInterface;

class NotificationComponent extends Component
{
    /** @var MailerInterface* */
    public $mailer;

    public function sendNotificationByEmail(array $activities)
    {
        foreach ($activities as $activity) {
            $complete = $this->mailer->compose('notification', ['model' => $activity])->
            setSubject('Сегодня начнётся событие')->
            setFrom('geekbrains@golikov.dev')->
            setTo($activity->email)->
            send();
            if ($complete) {
                echo Console::ansiFormat('Письмо отправлено' . $activity->email . PHP_EOL, [Console::FG_GREEN]);
            } else {
                echo Console::ansiFormat('Ошибка отправки письма' . $activity->email . PHP_EOL, [Console::FG_RED]);
            }
        }
    }
}