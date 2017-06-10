<?php

use yii\db\Migration;

/**
 * Handles the creation of table `packages`.
 */
class m161202_130032_create_packages_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%packages}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'club_id' => $this->integer()->notNull(),
            'country_id' => $this->string(),
            'company' => $this->string(),
            'apartment_type_id' => $this->string(),
            'certificate_period' => $this->string(),
            'season_id' => $this->string(),
            'quantity' => $this->integer(),
            'priced_sum' => $this->decimal(7,2)->notNull()->defaultValue(0.00),
            'priced_currency' => $this->char(3),
            'is_active' => $this->integer(1),
            'is_blocked' => $this->integer(1),
            'status' => $this->string(),
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
        $this->dropTable('{{%packages}}');
    }
}
