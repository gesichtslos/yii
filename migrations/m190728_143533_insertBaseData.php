<?php

use yii\db\Migration;

/**
 * Class m190728_143533_insertBaseData
 */
class m190728_143533_insertBaseData extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('users',[
            'id'=>1,
            'email'=>'test@test.ru',
            'pwd_hash'=>'asdasd'
        ]);
        $this->insert('users',[
            'id'=>2,
            'email'=>'test1@test.ru',
            'pwd_hash'=>'asdasd'
        ]);

        $this->batchInsert('activity', ['title', 'user_id', 'dateStart', 'useNotification', 'email'],
            [
                ['title 1', 1, date('Y-m-d'), 0, null],
                ['title 2', 2, date('Y-m-d'), 0, null],
                ['title 3', 2, date('Y-m-d'), 1, 'email@mail.com'],
                ['title 4', 2, date('Y-m-d'), 1, 'email@mail.com'],
                ['title 5', 1, date('2019-07-20'), 1, 'email@mail.com']
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('users');
        $this->delete('activity');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190728_143533_insertBaseData cannot be reverted.\n";

        return false;
    }
    */
}
