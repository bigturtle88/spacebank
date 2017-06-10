<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pages`.
 */
class m161130_150201_create_pages_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%pages}}', [
            'id' => 'pk',
            'title' => $this->string(),
            'content' => $this->string(),
            'status' => $this->integer(1)->notNull(),
            'parent' => $this->integer(10)->notNull(),
            'in_menu' => $this->integer(1)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%pages}}');
    }
}
