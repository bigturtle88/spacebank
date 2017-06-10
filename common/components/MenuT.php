<?php

namespace common\components;

use backend\models\PagesModel;
use yii\helpers\Url;

class MenuT {

    public function getMenu()
    {
        $menu = self::getList();

        $data = array();
        foreach ($menu as $key => $value)
        {
            $data[$key]["label"] = $value->title;
            $data[$key]["url"][] = Url::toRoute($value->url->slug);
            $data[$key]["items"] = self::getItms($value->sub_pages);
        }
        return $data;
    }

    private function getItms($data)
    {
        $data2 = null;
        if ($data)
        {
            $data2 = array();
            foreach ($data as $key => $value)
            {
                if ($value->in_menu === 0)
                    continue;
                $data2[$key]["label"] = $value->title;
                $data2[$key]["url"][] = Url::toRoute($value->url->slug);
                if ($value->sub_pages)
                    $data2[$key]["items"] = self::getItms($value->sub_pages);
            }
        }
        return $data2;
    }

    private function getList()
    {
        return PagesModel::find()
                        ->select(['id', 'parent', 'title'])
                        ->where(['=', 'parent', 0])
                        ->andWhere(['!=', 'in_menu', 0])
                        ->with('url')
                        ->all();
    }

}
