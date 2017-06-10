<?php

use yii\db\Migration;

/**
 * Handles the creation of table `apartment_types`.
 */
class m161130_125556_create_apartment_types_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%apartment_types}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(128)->notNull()->unique(),
            'description' => $this->text()->notNull(),
            'is_active' => $this->integer(1)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'is_active_server' => $this->integer(1)
        ]);
        $created_at = $updated_at = date("Ymd");

        $this->batchInsert('{{%apartment_types}}', ['name', 'description', 'is_active', 'created_at', 'updated_at', 'is_active_server'], [
                ['T0', 'T0', 1, $created_at, $updated_at, 1],
                ['T1', 'T1', 1, $created_at, $updated_at, 1],
                ['T2', 'T2', 1, $created_at, $updated_at, 1],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%apartment_types}}');
    }
}
