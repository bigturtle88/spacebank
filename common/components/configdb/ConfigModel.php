<?php

namespace common\components\configdb;

use Yii;

/**
 * This is the model class for table "config".
 *
 * @property string $theme
 */
class ConfigModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'value'], 'safe'],
        ];
    }

    public function getThemeList()
    {
        foreach (glob(Yii::getAlias('@frontend') . '/themes' . "/*", GLOB_ONLYDIR) as $dir) {
            $data[basename($dir)] = json_decode(file_get_contents(Yii::getAlias('@frontend') . '/themes/' . basename($dir) . '/info.json'));

        }
        return $data;
    }
}
