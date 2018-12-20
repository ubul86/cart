<?php

use yii\db\Migration;

/**
 * Class m181220_191524_create_order_item
 */
class m181220_191524_create_order_item extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%order_item}}', [
            'id' => $this->primaryKey(10)->unsigned(),
            'order_id' => $this->integer(10)->notNull()->unsigned(),
            'item_id' => $this->integer(10)->notNull()->unsigned(),
            'quantity' => $this->integer(10)->notNull()->defaultValue(0)->unsigned(),            
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),            
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%order_item}}');
    }
}
