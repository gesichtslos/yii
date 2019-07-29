<?php

namespace app\controllers;


use app\base\BaseController;

class DaoController extends BaseController
{
    public function actionIndex()
    {
        $dao = \Yii::$app->dao;
        $dao->transactionTest();
        $user = $dao->getUsers();
        $activity = $dao->getActivitiesUser(\Yii::$app->request->get('user', 1));
        $act = $dao->getFirstActivity();
        $count = $dao->getCountActivity();
        return $this->render('index', ['users' => $user, 'activity' => $activity, 'act' => $act, 'count' => $count]);
    }


}