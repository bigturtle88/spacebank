<?php

namespace console\models;

use Yii;
use backend\models\LogDeals;

class DealsGenerator extends LogDeals {


    public function AddDeals($val)
    {
        $deals = new LogDeals();
        foreach( $val as $k => $v ){
          $deals->$k = $v;  
        }
        return $deals->save() ? true : false;
    }
    
    public function RemoveDeals($conditions)
    {
       return LogDeals::deleteAll($conditions) ? true : false;
    }

}
