<?php

use yii\db\Migration;

/**
 * Handles the creation of table `log_deals`.
 */
class m161130_145805_create_log_deals_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%log_deals}}', [
            'id' => $this->primaryKey(),
            'sum' => $this->integer(10)->notNull(),
            'sum_system' => $this->decimal(7,2)->notNull()->defaultValue(0.00),
            'seller_id' => $this->integer(10)->notNull(),
            'buyer_id' => $this->integer(10)->notNull(),
            'packages_id' => $this->integer(10)->notNull(),
            'club_id' => $this->string(),
            'country_id' => $this->string(),
            'apartment_type_id' => $this->string(),
            'season_id' => $this->string(),
            'priced_value' => $this->decimal(7,2)->notNull()->defaultValue(0.00),
            'priced_currency' => $this->string(3),
            'virtual' => $this->integer(1)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%log_deals}}');
    }
}
