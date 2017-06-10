<?php

use yii\db\Migration;

class m170126_131150_update_packages_table2 extends Migration {

    public function up() {
        $this->addColumn('{{%packages}}', 'broker_id', $this->integer());
    }

    public function down() {

        $this->dropColumn('{{%packages}}', 'broker_id', $this->integer());
    }

}
