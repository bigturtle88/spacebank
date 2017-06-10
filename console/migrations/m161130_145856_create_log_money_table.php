<?php

use yii\db\Migration;

/**
 * Handles the creation of table `log_money`.
 */
class m161130_145856_create_log_money_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%log_money}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(10)->notNull(),
            'sum' => $this->decimal(7,2)->notNull()->defaultValue(0.00),
            'tip' => $this->string(),
            'status' => $this->string(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%log_money}}');
    }
}
