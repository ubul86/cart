<?php

use yii\db\Migration;

/**
 * Class m181220_192357_insert_sample_datas_to_item
 */
class m181220_192357_insert_sample_datas_to_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%item}}', ["name" => "Test Item 1"]);
        $this->insert('{{%item}}', ["name" => "Test Item 2"]);
        $this->insert('{{%item}}', ["name" => "Test Item 3"]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181220_192357_insert_sample_datas_to_item cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181220_192357_insert_sample_datas_to_item cannot be reverted.\n";

        return false;
    }
    */
}
