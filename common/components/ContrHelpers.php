<?php

namespace common\components;

use Yii;
use yii\helpers\ArrayHelper;

class ContrHelpers {

    public function Getcontrollersandactions()
    {
        $controllerlist = [];
        if ($handle = opendir(Yii::getAlias('@app') . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'frontend' . DIRECTORY_SEPARATOR . 'controllers'))
        {
            while (false !== ($file = readdir($handle)))
            {
                if ($file != "." && $file != ".." && substr($file, strrpos($file, '.') - 10) == 'Controller.php')
                {

                    $controllerlist[$file] = substr($file, 0, -14);
                }
            }
            closedir($handle);
        }
        asort($controllerlist);
        $fulllist = [];
        foreach ($controllerlist as $controller => $className):
            if($className!='Example') {
                $fulllist[strtolower($className) . '/index'] = $className;
            }

        endforeach;
        return $fulllist;
    }

}
