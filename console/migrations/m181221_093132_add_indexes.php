<?php

use yii\db\Migration;

/**
 * Class m181221_093132_add_indexes
 */
class m181221_093132_add_indexes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex('session_id_index', '{{%order}}', ['session_id']);
        $this->createIndex('user_id_index', '{{%order}}', ['user_id']);
        $this->createIndex('order_id_index', '{{%order_item}}', ['order_id']);
        $this->createIndex('item_id_index', '{{%order_item}}', ['item_id']);
        $this->createIndex('name_index', '{{%item}}', ['name']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181221_093132_add_indexes cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181221_093132_add_indexes cannot be reverted.\n";

        return false;
    }
    */
}
