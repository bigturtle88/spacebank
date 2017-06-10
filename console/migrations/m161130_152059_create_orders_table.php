<?php

use yii\db\Migration;

/**
 * Handles the creation of table `orders`.
 */
class m161130_152059_create_orders_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'source_id' => $this->integer()->notNull(),
            'club_id' => $this->integer()->notNull(),
            'country_id' => $this->string(),
            'apartment_type_id' => $this->string(),
            'season_id' => $this->string(),
            'interval' => $this->integer()->notNull(),
            'interval_numbers' => $this->integer()->notNull(),
            'apartment_number' => $this->integer()->notNull(),
            'bonus_weeks' => $this->integer()->notNull(),
            'price_show' => $this->integer()->notNull(),
            'priced_value' => $this->integer()->notNull(),
            'priced_currency' => $this->string(3),
            'type' => $this->integer()->notNull(),
            'is_active' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'virtual' => $this->integer(1),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%orders}}');
    }
}
