<?php

namespace app\controllers;


use app\base\BaseController;
use yii\filters\PageCache;

class DaoController extends BaseController
{
    public function behaviors()
    {
        return [
            ['class' => PageCache::class,
                'duration' => 20,
                'only' => ['index']]
        ];

    }

    public function actionIndex()
    {
        $dao = \Yii::$app->dao;
        $user = $dao->getUsers();
        $activity = $dao->getActivitiesUser(\Yii::$app->request->get('user', 1));
        $act = $dao->getFirstActivity();
        $count = $dao->getCountActivity();
        $reader = $dao->getActivitiesReader();
        return $this->render('index', [
            'users' => $user,
            'activities' => $activity,
            'act' => $act,
            'count' => $count,
            'reader' => $reader
        ]);
    }

    public function actionCache()
    {
        $val = \Yii::$app->cache->getOrSet('key1', function () {
            return 'value for cache';
        });

        echo $val;
    }

}