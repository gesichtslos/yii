<?php

namespace app\base;


use yii\web\Controller;

class BaseController extends Controller
{
    public function afterAction($action, $result)
    {
        \Yii::$app->session->setFlash('prev_page', \Yii::$app->request->absoluteUrl);
        return parent::afterAction($action, $result);
    }
}