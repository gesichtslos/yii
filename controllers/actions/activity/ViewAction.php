<?php
/**
 * Created by PhpStorm.
 * User: 3G
 * Date: 01.08.2019
 * Time: 21:36
 */

namespace app\controllers\actions\activity;


use app\models\Activity;
use yii\base\Action;
use yii\web\HttpException;

class ViewAction extends Action
{
    public function run($id)
    {
        $model = Activity::find()->andWhere(['id' => $id])->one();
        if (!$model) {
            throw new HttpException(404, 'Событие не найдено');
        }

        if (!\Yii::$app->rbac->canEditViewActivity($model)) {
            throw new HttpException(403, 'Недостаточно прав');
        }

        return $this->controller->render('view', ['model' => $model]);
    }
}