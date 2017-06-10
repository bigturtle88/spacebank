<?php

use yii\db\Migration;

class m170116_125703_update_offers_table extends Migration {

    public function up() {
        $this->addColumn('{{%offers}}', 'user_id', $this->integer()->notNull());
        $this->addColumn('{{%offers}}', 'type', $this->integer()->notNull());
    }

    public function down() {

        $this->dropColumn('{{%offers}}', 'user_id');
        $this->dropColumn('{{%offers}}', 'type');
    }

}
