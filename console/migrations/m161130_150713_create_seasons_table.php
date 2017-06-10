<?php

use yii\db\Migration;

/**
 * Handles the creation of table `seasons`.
 */
class m161130_150713_create_seasons_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%seasons}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(128)->notNull()->unique(),
            'description' => $this->text()->notNull(),
            'is_active' => $this->integer(1)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'is_active_server' => $this->integer(1)
        ]);
        $created_at = $updated_at = date("Ymd");

        $this->batchInsert('{{%seasons}}', ['name', 'description', 'is_active', 'created_at', 'updated_at', 'is_active_server'], [
                ['Red', 'Red', 1, $created_at, $updated_at, 1],
                ['Green', 'Green', 1, $created_at, $updated_at, 1],
                ['Yellow', 'Yellow', 1, $created_at, $updated_at, 1],
                ['Blue', 'Blue', 1, $created_at, $updated_at, 1],
                ['White', 'White', 1, $created_at, $updated_at, 1],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%seasons}}');
    }
}
