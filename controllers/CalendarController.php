<?php

namespace app\controllers;

use app\base\BaseController;
use app\controllers\actions\calendar\CreateAction;
use app\models\Calendar;

class CalendarController extends BaseController
{
    public function actions()
    {
        return [
            'view' => ['class' => CreateAction::class, 'classEntity' => Calendar::class]
        ];
    }
}