<?php

use yii\db\Migration;

/**
 * Handles the creation of table `offers`.
 */
class m161130_152751_create_offers_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%offers}}', [
            'id' => $this->primaryKey(),
            'seller_id' => $this->integer()->notNull(),
            'buyer_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
            'source_id' => $this->integer()->notNull(),
            'bid' => $this->integer()->notNull(),
            'expertise' => $this->integer()->notNull(),
            'expert_price' => $this->integer(),
            'description' => $this->string(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%offers}}');
    }
}
