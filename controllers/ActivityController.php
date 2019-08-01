<?php

namespace app\controllers;

use app\base\BaseController;
use app\controllers\actions\activity\CreateAction;
use app\models\Activity;
use app\controllers\actions\activity\ViewAction;

class ActivityController extends BaseController
{
    public function actions()
    {
        return [
            'create' => ['class' => CreateAction::class, 'classEntity' => Activity::class],
            'view' => ['class' => ViewAction::class]
        ];
    }
}