<?php

namespace app\components;

use yii\caching\DbDependency;
use yii\caching\ExpressionDependency;
use yii\caching\TagDependency;
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
        return $this->getConnection()->createCommand($sql)->cache(20, new DbDependency(['sql' => 'select max(id) from activity']))->queryAll();
    }

    public function getActivitiesUser($user_id)
    {
        $sql = 'select * from activity where user_id =:user;';
        return $this->getConnection()->createCommand($sql, ['user' => $user_id])->queryAll();
    }

    public function getFirstActivity()
    {
        TagDependency::invalidate(\Yii::$app->cache, 'tag1');
        $query = new Query();
        return $query->from('activity')
            ->orderBy(['id' => SORT_DESC])
            ->select(['id', 'title'])
            ->andWhere(['useNotification' => 1])
            ->limit(3)
            ->cache(20, new TagDependency(['tags' => 'tag1']))
            ->one($this->getConnection());
    }

    public function getCountActivity()
    {
        $query = new Query();
        return $query->from('activity')
            ->select('count(id)')
            ->cache(20, new ExpressionDependency(['expression' => 'true']))
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

    public function assignUserRole($user)
    {
        $query = new Query();
        return $query->from('auth_assignment')
            ->select('item_name')
            ->andWhere(['user_id' => $user->id])
            ->one($this->getConnection());
    }

    public function getActivitiesReader()
    {
        $query = new Query();
        return $query->from('activity')->createCommand()->query();
    }
}