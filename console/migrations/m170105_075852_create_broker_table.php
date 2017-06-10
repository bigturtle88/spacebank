<?php

use yii\db\Migration;

/**
 * Handles the creation of table `broker`.
 */
class m170105_075852_create_broker_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%broker}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'broker_id' => $this->integer(),
            'consolidator_id' => $this->integer(),
            'procent' => $this->integer(),
            'is_active' => $this->integer(1),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%broker}}');
    }
}
