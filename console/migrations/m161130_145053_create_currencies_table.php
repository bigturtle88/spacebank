<?php

use yii\db\Migration;

/**
 * Handles the creation of table `currencies`.
 */
class m161130_145053_create_currencies_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%currencies}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(3),
            'rate' => $this->decimal(7,2),
            'name' => $this->string(),
            'is_active' => $this->integer(1)->notNull(),
            'is_active_server' => $this->integer(1)
        ]);
        $this->batchInsert('{{%currencies}}', ['name', 'code', 'rate', 'is_active', 'is_active_server'], [
                ['Доллар', 'USD', '1.000', 1, 1],
                ['Евро', 'EUR', '1.070', 1, 1],
                ['Рубль', 'RUB', '64.000', 1, 1]
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%currencies}}');
    }
}
