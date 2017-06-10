<?php

namespace common\components;

use Yii;
use yii\base\Object;
use yii\web\UrlRuleInterface;
use backend\models\PagesModel;
use frontend\controllers;

class UrlRule extends Object implements UrlRuleInterface {

    /**
     * @param \yii\web\UrlManager $manager
     * @param string $route
     * @param array $params
     * @return bool|mixed
     */
    public function createUrl($manager, $route, $params)
    {

        $dbSlugName = false;
        try
        {
            if (!empty($params))
            {
                $dbSlugName = $this->setParams($route, $params);
            }
            else
            {
                $dbRoute = $this->getRouteFromCacheOrWriteCacheThenRead($route, $params);
                if ($dbRoute)
                    $dbSlugName = $dbRoute->slug;
            }
        }
        catch (\yii\db\Exception $e)
        {
            
        }
        return $dbSlugName;
    }

    /**
     * @param \yii\web\UrlManager $manager
     * @param \yii\web\Request $request
     * @return array|bool
     */
    public function parseRequest($manager, $request)
    {
        try
        {
            $_slug = $request->getPathInfo();
            $route = null;
            $params = array();
           
            if (!empty($_slug)){
                $route = $this->getCache($_slug);
                if($route === false)
                    $route = UrlModel::getRouteBySlug($this->checkActionStaticSlug($_slug));
            }

            if (!is_null($route))
            {
                $rq = $this->getCntrActArray($_slug);
                if (count($rq) === 1)
                {   if($route->page && $route->page->status!=0)
                        Yii::$app->params["page"] = $route->page;
                }
                else if (count($rq) > 1)
                {
                    $route->route = $this->createNewActionSlug($route->route, $_slug);
                    $route->route = $this->getControllAction($route->route);
                    if (count($rq) > 2)
                    {
                        $params = $this->RequstToArray($request->getPathInfo(), $this->getActionArgument($route->route));

                        if ($params === false)
                            return false;
                    }
                }
                else
                    return false;

                return [
                    $route->getAttribute('route'),
                    $params
                ];
            }else
            {
                $route = $request->getPathInfo();
                if (!$this->getControllAction($route))
                    return false;
                $params = $this->RequstToArray($request->getPathInfo(), $this->getActionArgument($route));
                $route = $this->createNewActionSlug($route, $route);
                return [
                    $route,
                    $params
                ];
            }
            //
        }
        catch (\yii\db\Exception $e)
        {
            
        }
        return false;
    }

    //возврашает true если есть такой метод в контроллере
    private function getControllAction($_slug)
    {
        $action = $this->getCntrActArray($_slug);
        $action = $this->delDash($action);
        if (is_array($action) && isset($action[0]) && isset($action[1]))
        {
            if (method_exists('\frontend\controllers\\' . $action[0] . 'Controller', 'action' . $action[1]) === true)
                return $_slug;
        }
        else
            return false;
    }

    //возврашает slug/action ссылки 
    private function createNewActionSlug($cntr, $act)
    {
        $cntrl = $this->getCntrActArray($cntr);
        $act = $this->getCntrActArray($act);
        return $cntrl[0] . '/' . $act[1];
    }

    //возврашает с ссылки только  slug
    private function checkActionStaticSlug($_slug)
    {
        if (strpos($_slug, "/") !== false)
        {
            $action = $this->getCntrActArray($_slug);
            $_slug = $action[0];
        }
        return $_slug;
    }

    /**
     * @param $_route
     * @param $_params
     * @return false|\yii\db\ActiveRecord
     */
    //берёт роутер из кэш ,если он есть , если нет записывает 
    private function getRouteFromCacheOrWriteCacheThenRead($_route, $_params)
    {
        if ($_params)
            unset($_params['/' . $_route]);
        $dbRoute = $this->getCache($_route);

        if ($dbRoute === false)
        {
            if (count($this->getCntrActArray($_route)) < 3 && ($route = UrlModel::getRouteBySlug($this->getCntrActArray($_route)[1]) && $route))
            {
                if (count($this->getCntrActArray($_route)) > 2)
                    $route->slug = $_route;
                $dbRoute = $route;
            }else
            {
                if ($this->getControllAction($_route) === false)
                    $dbRoute = UrlModel::getRouteBySlug($_route);
            }

            if ($dbRoute)
            {
                Yii::$app->cache->set($dbRoute->slug, $dbRoute);
            }
        }
        return $dbRoute;
    }

    //функция возврашает кэш слага если он есть
    private function getCache($_key)
    {

        $dbRoute = Yii::$app->cache->get($_key);
        if ($dbRoute === false && isset($this->getCntrActArray($_key)[1]))
            $dbRoute = Yii::$app->cache->get($this->getCntrActArray($_key)[1]);
        return $dbRoute;
    }

    //Функция берёт из контроллер/экшен аргументы отдаёт в виде массива аргументы экшена
    private function getActionArgument($_slug)
    {
        $action = $this->getCntrActArray($_slug);
        $action = $this->delDash($action);
        $ReflectionMethod = new \ReflectionMethod('\frontend\controllers\\' . $action[0] . "Controller", "action" . $action[1]);
        return $this->ActionArgToArray($ReflectionMethod->getParameters());
    }

    //создаёт массив параметров функции(экшена) контроллера
    private function ActionArgToArray($arg)
    {
        return array_map(function( $item )
        {
            return $item->getName();
        }, $arg);
    }

    //создаёт массив [параметр]="значение" функции(экшена) котроллера
    //Входные параметры ссылка и массив значений аргументов(экшена)
    private function RequstToArray($par, $req)
    {
        $params = $this->getCntrActArray($par, true);
        if (count($params) > count($req))
            return false;
        $a = array();
        foreach ($req as $k => $v)
        {
            if ($params[$k])
                $a[$v] = $params[$k];
            else
                $a[$v] = false;
        }
        return $a;
    }

    //возврашает массив ссылки([0]=>site,[1]=>login)
    //если стоит true удаляет последние значение возврашая контроллер(или слаг) экшен 
    private function getCntrActArray($_slug, $del = false)
    {
        $res = explode("/", $_slug);

        if ($del === true)
        {
            $res = array_splice($res, 2);
        }
        return $res;
    }

    //добавляет параметры к ссылки если они есть , пример site/news/1(параметр)
    private function setParams($route, $params)
    {

        foreach ($params as $val)
        {
            $route = $route . '/' . $val;
        }
        return $route;
    }

    //возврашает true если это статический метод контроллера Протестирывать возможно не нужный метод
    /* private function isStaticMethod($_route)
      {
      $route = UrlModel::getRouteBySlug($this->checkActionStaticSlug($_route));
      if (!is_null($route))
      {
      return $this->getControllAction($this->createNewActionSlug($route->route, $_route));
      }
      return false;
      } */

    //Удаляет - с экшена для проверки этого метода в контроллере
    private function delDash($action)
    {
        if (is_array($action) && isset($action[1]) && strpos($action[1], '-') > 0)
            $action[1] = str_replace("-", "", $action[1]);
        return $action;
    }

}

//getChildren( $active = false )