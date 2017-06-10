<?php

namespace console\models;

use Yii;
use backend\models\AdminModel;
use yii\base\Model;

class Admin extends Model {

    public $name;
    public $pass;
    public $email;

    public function AddAdmin($name, $pass, $email)
    {

        $admin = new AdminModel();
        $admin->username = $name;
        $admin->email = $email;
        $admin->setPassword($pass);
        $admin->generateAuthKey();
        $admin->status = 10;
        return $admin->save() ? true : false;
    }

}
