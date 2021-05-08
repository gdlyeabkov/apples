<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

/**
 * Class m210508_150757_applesTable
 */
class m210508_150757_applesTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('apples', [
            'id' => Schema::TYPE_PK,
            'color' => Schema::TYPE_STRING,
            'dateappears' => Schema::TYPE_DATE,
            'datedrop' => Schema::TYPE_DATE,
            'status' => Schema::TYPE_STRING,
            'percent' => Schema::TYPE_INTEGER,
            'tree' => Schema::TYPE_TINYINT,
            'drop' => Schema::TYPE_TINYINT,
            'dirty' => Schema::TYPE_TINYINT
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('apples');


        echo "m210508_150757_applesTable cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210508_150757_applesTable cannot be reverted.\n";

        return false;
    }
    */
}
