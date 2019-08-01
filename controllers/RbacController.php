<?php
/**
 * Created by PhpStorm.
 * User: 3G
 * Date: 01.08.2019
 * Time: 20:55
 */

namespace app\controllers;


use app\base\BaseController;

class RbacController extends BaseController
{
    public function actionGen()
    {
        \Yii::$app->rbac->genRbac();
    }
}