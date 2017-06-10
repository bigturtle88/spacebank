<?php

use yii\db\Migration;

/**
 * Handles the creation of table `url_rule`.
 */
class m161130_150832_create_url_rule_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%url_rule}}', [
            'id' => 'pk',
            'slug' => $this->string(),
            'route' => $this->string(),
            'params' => $this->string()->defaultValue('a:0:{}'),
            'redirect' => $this->integer(1),
            'redirect_code' => $this->integer(5)->defaultValue(302),
            'status' => $this->integer(1),
            'page_id' => $this->integer(10),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%url_rule}}');
    }
}
