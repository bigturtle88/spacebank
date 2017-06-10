<?php

use yii\db\Migration;

class m161130_125551_create_user_table extends Migration {

    public function up() {
        $tableOptions = null;
        $this->createTable('{{%user}}', [
        'id' => $this->primaryKey(),
        'username' => $this->string()->notNull()->unique(),
        'auth_key' => $this->string(32)->notNull(),
        'password_hash' => $this->string()->notNull(),
        'password_reset_token' => $this->string()->unique(),
        'email' => $this->string()->notNull()->unique(),
        'status' => $this->smallInteger()->notNull()->defaultValue(0),
        'created_at' => $this->integer()->notNull(),
        'updated_at' => $this->integer()->notNull(),
        'user_type' => $this->integer()->notNull()->defaultValue(0),
        'tel' => $this->string(),
        'fio' => $this->string(),
        'is_individual' => $this->integer(1)->defaultValue(0),
        'contact' => $this->string(),
        'firm_name' => $this->string(),
        'money' => $this->decimal(7,2)->notNull()->defaultValue(0.00),
        'email_confirm_token' => $this->string(),
        'country_id' => $this->integer()->notNull(),
        'virtual' => $this->integer(1)->notNull()->defaultValue(0),
        'signup_attempt' => $this->smallInteger()->notNull()->defaultValue(0) 
        ], $tableOptions);
    }

    public function down() {
        $this->dropTable('{{%user}}');
    }

}
