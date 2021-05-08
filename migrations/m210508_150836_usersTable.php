<?php

use yii\db\Migration;
use yii\db\mysql\Schema;
/**
 * Class m210508_150836_usersTable
 */
class m210508_150836_usersTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('apples', [
            'id' => Schema::TYPE_PK,
            'login' => Schema::TYPE_STRING,
            'password' => Schema::TYPE_STRING
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
        echo "m210508_150836_usersTable cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210508_150836_usersTable cannot be reverted.\n";

        return false;
    }
    */
}
