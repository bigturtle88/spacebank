<?php

use yii\db\Migration;

/**
 * Handles the creation of table `certificates`.
 */
class m161130_151601_create_certificates_table extends Migration {

    /**
     * @inheritdoc
     */
    public function up() {
        $this->createTable('{{%certificates}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'club_id' => $this->integer()->notNull(),
            'company_id' => $this->integer()->notNull(),
            'country_id' => $this->integer()->notNull(),
            'certificate_code' => $this->char(64),
            'start_date' => $this->date(),
            'end_date' => $this->date(),
            'contract_code' => $this->char(64),
            'contract_date' => $this->date(),
            'certificate_period' => $this->integer(),
            'certificate_sum' => $this->integer(),
            'certificate_currency' => $this->char(3),
            'apartment_type_id' => $this->integer()->notNull(),
            'season_id' => $this->integer()->notNull(),
            'interval' => $this->integer(),
            'interval_numbers' => $this->integer(),
            'apartment_number' => $this->integer(),
            'bonus_weeks' => $this->integer(),
            'points' => $this->integer(),
            'fees_start_sum' => $this->integer(),
            'fees_start_currency' => $this->char(3),
            'fees_current_sum' => $this->integer(),
            'fees_current_currency' => $this->char(3),
            'is_penalty' => $this->integer(1),
            'penalty_start_sum' => $this->integer(),
            'penalty_start_currency' => $this->char(3),
            'fees_loan_sum' => $this->integer(),
            'fees_loan_currency' => $this->char(3),
            'certificate_loan_sum' => $this->integer(),
            'certificate_loan_currency' => $this->char(3),
            'status' => $this->integer(),
            'is_expertize' => $this->integer(1),
            'is_membership' => $this->integer(1),
            'is_priced' => $this->integer(1),
            'priced_sum' => $this->integer(),
            'priced_currency' => $this->char(3),
            'is_approved' => $this->integer(1),
            'is_archive' => $this->integer(1),
            'certificate_file' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'virtual' => $this->integer(1),
            'package_id' => $this->integer(10),
        ]);

        $this->addForeignKey('fk-certificates-user_id', '{{%certificates}}', 'user_id', 'user', 'id', 'RESTRICT');
        $this->addForeignKey('fk-certificates-club_id', '{{%certificates}}', 'club_id', 'clubs', 'id', 'RESTRICT');
        $this->addForeignKey('fk-certificates-apartment_type_id', '{{%certificates}}', 'apartment_type_id', 'apartment_types', 'id', 'RESTRICT');
        $this->addForeignKey('fk-certificates-season_id', '{{%certificates}}', 'season_id', 'seasons', 'id', 'RESTRICT');

        $this->createIndex('idx-certificates-country', '{{%certificates}}', 'country_id');
        $this->createIndex('idx-certificates-certificate_code', '{{%certificates}}', 'certificate_code');
        $this->createIndex('idx-certificates-contract_code', '{{%certificates}}', 'contract_code');
        $this->createIndex('idx-certificates-is_penalty', '{{%certificates}}', 'is_penalty');
        $this->createIndex('idx-certificates-is_expertize', '{{%certificates}}', 'is_expertize');
        $this->createIndex('idx-certificates-is_membership', '{{%certificates}}', 'is_membership');
        $this->createIndex('idx-certificates-is_priced', '{{%certificates}}', 'is_priced');
        $this->createIndex('idx-certificates-is_approved', '{{%certificates}}', 'is_approved');
        $this->createIndex('idx-certificates-is_archive', '{{%certificates}}', 'is_archive');
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropTable('{{%certificates}}');
    }

}
