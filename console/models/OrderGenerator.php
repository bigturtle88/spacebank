<?php

namespace console\models;

use Yii;
use common\models\Order;
use common\models\Certificate;
use yii\base\Model;

class OrderGenerator extends Order {


    public function AddOrders($val)
    {
        $order = new Order();
        foreach( $val as $k => $v ){
          $order->$k = $v;  
        }
        return $order->save() ? true : false;
    }
    
    public function RemoveOrders($conditions)
    {
       return Order::deleteAll($conditions) ? true : false;
    }

}
