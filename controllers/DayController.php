<?php

namespace app\controllers;


use app\base\BaseController;
use app\controllers\actions\day\CreateAction;
use app\models\Day;

class DayController extends BaseController
{
    public function actions()
    {
        return [
            'create'=>['class'=>CreateAction::class, 'classEntity' => Day::class]
        ];
    }
}