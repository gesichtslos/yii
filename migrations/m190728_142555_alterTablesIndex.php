<?php

use yii\db\Migration;

/**
 * Class m190728_142555_alterTablesIndex
 */
class m190728_142555_alterTablesIndex extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('activity', 'user_id', $this->integer()->notNull());

        $this->addForeignKey('activityUserFK', 'activity', 'user_id', 'users', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('emailUserIndex', 'users', 'email', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('activity', 'user_id');
        $this->dropForeignKey('activityUserFK', 'activity');
        $this->dropIndex('emailUserIndex', 'users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190728_142555_alterTablesIndex cannot be reverted.\n";

        return false;
    }
    */
}
