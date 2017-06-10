<?php

namespace console\controllers;

use backend\models\AdminModel;
use console\models\Admin;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * Добавление администратора
 */

class AdminController extends Controller
{

    /**
      * Создание админа - логин, пароль и емейл админа - например admin admin admin@admin.com
    */
    public function actionAdd($name, $pass, $email)
    {
        $admin = new Admin();

        if ($admin->AddAdmin($name, $pass, $email))
        {
            echo "ok";
        } else {
            echo "error";
        }

    }

    /**
      * Наделение админа паравами - роль и логин админа - например admin admin
    */
    public function actionAssign($role, $username)
    {
        $user = AdminModel::findByUsername($username);
        if (!$user) {
            $this->stdout("Пользователь с логином $username в базе не обнаружен.\n", Console::FG_RED, Console::BOLD);
            exit;
        }

        $auth       = Yii::$app->authManager;
        $roleObject = $auth->getRole($role);

        if (!$roleObject) {
            $this->stdout("Такой роли $role нет.\n", Console::FG_RED, Console::BOLD);
            exit;
        }

        if ($auth->getRolesByUser($user->id)) {
            $auth->revokeAll($user->id);
        }

        $auth->assign($roleObject, $user->id);

        $this->stdout("Права доступа назначены.\n", Console::FG_GREEN, Console::BOLD);
    }
}
