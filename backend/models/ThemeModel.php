<?php

namespace backend\models;

use Yii;
use yii\base\Model;

class ThemeModel extends Model {

    public $theme;

    public function rules()
    {
        return [
            [['theme'], 'safe']
        ];
    }

    public function getThemeList()
    {
        foreach (glob(Yii::getAlias('@frontend') . '/themes' . "/*", GLOB_ONLYDIR) as $dir)
        {
            $data[] = basename($dir);
        }
        return $data;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'theme' => 'Название темы',
        ];
    }

}
