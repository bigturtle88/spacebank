<?php

use yii\db\Migration;

class m161130_125552_create_admin_table extends Migration {

    public function up()
    {
        $this->createTable('{{%admin}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%admin}}');
    }
}
