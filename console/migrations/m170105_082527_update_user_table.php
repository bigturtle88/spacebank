<?php

use yii\db\Migration;

class m170105_082527_update_user_table extends Migration
{
    public function up()
    {
       $this->alterColumn('{{%user}}','user_type','string');
    }

    public function down()
    {

    }
}
