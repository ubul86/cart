<?php

use yii\db\Migration;

/**
 * Class m181220_192110_create_item
 */
class m181220_192110_create_item extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%item}}', [
            'id' => $this->primaryKey(10)->unsigned(),
            'name' => $this->string(100)->notNull()                      
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%item}}');
    }
}
