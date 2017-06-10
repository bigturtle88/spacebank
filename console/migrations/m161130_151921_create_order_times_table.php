<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_times`.
 */
class m161130_151921_create_order_times_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%order_times}}', [
            'id' => $this->primaryKey(),
            'block_number' => $this->integer()->notNull(),
            'days' => $this->integer()->notNull(),
            'penalty_seller' => $this->integer()->notNull(),
            'penalty_buyer' => $this->integer()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%order_times}}');
    }
}
