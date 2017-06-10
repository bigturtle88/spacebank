<?php

use yii\db\Migration;

class m170116_105225_update_packages_table extends Migration
{
    public function up() {
        $this->addColumn('{{%packages}}', 'author_id', $this->integer());
    }

    public function down() {
        
        $this->dropColumn('{{%packages}}', 'author_id');
    }

}
