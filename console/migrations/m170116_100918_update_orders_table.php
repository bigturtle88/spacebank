<?php

use yii\db\Migration;

class m170116_100918_update_orders_table extends Migration {

    public function up() {
        $this->addColumn('{{%orders}}', 'author_id', $this->integer());
    }

    public function down() {
        $this->dropColumn('{{%orders}}', 'author_id');
    }

}
