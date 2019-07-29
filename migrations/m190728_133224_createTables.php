<?php

use yii\db\Migration;

/**
 * Class m190728_133224_createTables
 */
class m190728_133224_createTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('activity', [
            'id' => $this->primaryKey(),
            'title' => $this->string(150)->notNull(),
            'description' => $this->text(),
            'dateStart' => $this->date()->notNull(),
            'dateEnd' => $this->date(),
            'isBlocked' => $this->tinyInteger()->notNull()->defaultValue(0),
            'isRepeatable' => $this->tinyInteger()->notNull()->defaultValue(0),
            'repeatType' => $this->tinyInteger()->notNull()->defaultValue(0),
            'email' => $this->string(150),
            'useNotification' => $this->tinyInteger()->notNull()->defaultValue(0),
            'createAt' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'email' => $this->string(150),
            'pwd_hash' => $this->string(300)->notNull(),
            'token' => $this->string(150),
            'auth_key' => $this->string(150),
            'createAt' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->createTable('day', [
            'id' => $this->primaryKey(),
            'title' => $this->string(150)->notNull(),
            'workday' => $this->tinyInteger()->notNull()->defaultValue(0),
            'createAt' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->createTable('calendar', [
            'id' => $this->primaryKey(),
            'createAt' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('activity');
        $this->dropTable('users');
        $this->dropTable('day');
        $this->dropTable('calendar');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190728_133224_createTables cannot be reverted.\n";

        return false;
    }
    */
}
