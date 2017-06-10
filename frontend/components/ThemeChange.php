<?php

namespace frontend\components;

use Yii;

class ThemeChange {

    public function ChangeTheme($name)
    {

        var_dump(Yii::$app->view->theme);
    }

}
