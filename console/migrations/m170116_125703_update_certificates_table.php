<?php

use yii\db\Migration;

class m170116_125703_update_certificates_table extends Migration {

    public function up() {
        
        $this->addColumn('{{%certificates}}', 'broker_id', $this->integer() );
       
    }
    public function down() {

        $this->dropColumn('{{%certificates}}', 'broker_id');

    }

}
