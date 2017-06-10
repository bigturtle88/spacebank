<?php

use yii\db\Migration;

/**
 * Handles the creation of table `config`.
 */
class m161130_144149_create_config_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%config}}', [
            'id' => $this->primaryKey(),
            'key' => $this->string(),
            'value' => $this->string(),
            'description' => $this->string(),
            'category' => $this->string(50)
        ]);
        
        $this->batchInsert('{{%config}}', [ 'key', 'value', 'description', 'category'], [
            ['auto_activation', '0', '', ''],
            ['theme', 'site', '', ''],
            ['system_procent', '5', 'Процент системы при сделках', 'finance'],
            ['query_price', '1', 'Цена 1 поискового запроса', 'finance'],
            ['password', '111', 'Пароль связи с сервером', 'finance'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%config}}');
    }
}
