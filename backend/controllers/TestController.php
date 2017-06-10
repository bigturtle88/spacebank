<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\components\ContrHelpers;
use fg\UrlAlias\models\UrlModel;
use yii\helpers\Url;
use backend\models\PagesModel;

class TestController extends Controller {

    public function actionIndex()
    {
        $menu = PagesModel::find()
                ->select(['id', 'parent', 'title'])
                ->where(['=', 'parent', 0])
                ->with('url')
                ->all();

        $data = array();
        foreach ($menu as $key => $value)
        {
            $data[$key]["label"] = $value->title;
            $data[$key]["url"][] = $value->url->slug;
            $data[$key]["items"] = $this::getItms($value->sub_pages);


            //var_dump($value);
        }

        var_dump($data);

        //return $data;
        //var_dump(ContrHelpers::Getcontrollersandactions());
        //echo Url::to('\frontend\controllers\SiteController\index');
        //var_dump(new UrlModel());
        //echo $url = Url::to(['test/admin', 'id' => 100,'name' => "cat"]);
    }

    public function getItms($data)
    {
        $data2 = array();
        if ($data)
        {
            foreach ($data as $key => $value)
            {
                $data2[$key]["label"] = $value->title;
                $data2[$key]["url"][] = $value->url->slug;
            }
            if ($value->sub_pages)
                $data2[$key]["items"] = $this::getItms($value->sub_pages);
        }
        return $data2;
    }

}
