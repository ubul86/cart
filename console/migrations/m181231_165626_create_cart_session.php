<?php

use yii\db\Migration;

/**
 * Class m181231_165626_create_cart_session
 */
class m181231_165626_create_cart_session extends Migration
{
    public function up()
    {
        $this->createTable('{{%cart_session}}', [
            'id' => $this->char(64)->notNull(),
            'expire' => $this->integer(),
            'data' => $this->binary()
        ]);
        $this->addPrimaryKey('pk-id', '{{%cart_session}}', 'id');
    }

    public function down()
    {
        $this->dropTable('{{%cart_session}}');
    }
}
