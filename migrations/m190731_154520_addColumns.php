<?php

use yii\db\Migration;

/**
 * Class m190731_154520_addColumns
 */
class m190731_154520_addColumns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->delete('users');
        $this->insert('users',[
            'id'=>1,
            'email'=>'test@test.ru',
            'pwd_hash'=>'$2y$13$2DoQSU0geiF6lR2mcos1yu6jQdwYDebT1p/0QhGrknCAMy5FJzfMW'
        ]);
        $this->insert('users',[
            'id'=>2,
            'email'=>'test1@test.ru',
            'pwd_hash'=>'$2y$13$2DoQSU0geiF6lR2mcos1yu6jQdwYDebT1p/0QhGrknCAMy5FJzfMW'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190731_154520_addColumns cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190731_154520_addColumns cannot be reverted.\n";

        return false;
    }
    */
}
