<?php

namespace common\components\configdb;

use common\components\configdb\ConfigModel;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class ConfigInDB extends Component
{
    protected $data = array();

    public function init()
    {
        $items = $this->getOrWriteCache();
        if (empty($items)) {
            throw new InvalidConfigException('Need insert config in config table.');
        }

        $this->data = $items;
        parent::init();
    }

    public function get($key, $default = false)
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        } elseif ($default) {
            return $default;
        } else {
            throw new InvalidConfigException('Undefined parameter ' . $key);
        }
    }

    public function set($key, $value = false, $obj = false)
    {
        $model = ConfigModel::find()->where(['key' => $key])->one();

        if ($obj) {
            $model->load($obj);
            $this->data["theme"] = $model->value;
        } else {
            if (!$model) {
                throw new InvalidConfigException('Cant find config table');
            }

            $this->data[$key] = $value;
            $model->value     = $value;
        }
        if ($model->save()) {
            Yii::$app->cache->offsetUnset("config");
            $this->getOrWriteCache();
            return true;
        }
        return false;
    }

    private function getOrWriteCache()
    {
        $cache = Yii::$app->cache->mget(["config"]);
        if (!$cache["config"]) {
            $cache = ConfigModel::find()->asArray()->all();
            $cache = $this->getConfArray($cache);
            Yii::$app->cache->mset($cache);
        }
        return $cache["config"];
    }

    private function getConfArray($items)
    {
        $res = array();
        foreach ($items as $key => $item) {
            if (!is_null($item["key"]) && !is_null($item["value"])) {
                $res["config"][$item["key"]] = $item["value"];
            }

        }
        return $res;
    }

}
