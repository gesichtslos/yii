<?php

namespace app\components;

use yii\db\Connection;
use yii\db\Exception;
use yii\db\Query;

class DAOComponent
{
    private function getConnection(): Connection
    {
        return \Yii::$app->db;
    }

    public function getUsers()
    {
        $sql = 'select * from users;';
        return $this->getConnection()->createCommand($sql)->queryAll();
    }

    public function getActivitiesUser($user_id)
    {
        $sql = 'select * from activity where user_id =:user;';
        return $this->getConnection()->createCommand($sql, ['user' => $user_id])->queryAll();
    }

    public function getFirstActivity()
    {
        $query = new Query();
        return $query->from('activity')
            ->orderBy(['id' => SORT_DESC])
            ->select(['id', 'title'])
            ->andWhere(['useNotification' => 1])
            ->limit(3)
            ->one($this->getConnection());
    }

    public function getCountActivity()
    {
        $query = new Query();
        return $query->from('activity')
            ->select('count(id)')
            ->scalar($this->getConnection());
    }

    public function transactionTest()
    {
        $transaction = $this->getConnection()->beginTransaction();
        try {
            $this->getConnection()->createCommand()->insert('activity',
                ['title' => 'title' . mt_rand(100, 1000),
                    'user_id' => 1,
                    'dateStart' => date('Y-m-d')])->execute();
            throw new Exception('');
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
        }
    }

    public function insertActivityIntoDb(&$model, $tableDb)
    {
        $this->getConnection()->createCommand()->insert($tableDb, [
            'title' => $model->title,
            'description' => $model->description,
            'dateStart' => $model->dateStart,
            'dateStart' => $model->dateEnd,
            'isBlocked' => $model->isBlocked,
            'email' => $model->email,
            'isRepeatable' => $model->isRepeatable,
            'isRepeatable' => $model->isRepeatable,
            'repeatType' => $model->repeatType,
            'useNotification' => $model->useNotification,
            'user_id' => \Yii::$app->user->getId(),
            'createAt' => date('Y-m-d H:i:s')])
            ->execute();
        $model->id = $this->getConnection()->lastInsertID;
    }
}