<?php

namespace console\controllers;

use Yii;
use console\models\OrderGenerator;
use yii\console\Controller;
use common\models\Order;
use common\models\Certificate;
use common\models\Country;
use common\models\Club;
use common\models\ApartmentType;
use common\models\Season;
use common\models\Company;
use yii\helpers\Console;



/**
 * Запуск генератора Ордеров
 */

class OrderGeneratorController extends Controller
{
    /**
      * Обязательные опции - логин от кого и количество ордеров (demo 100, к примеру)
    */
    public function actionAddsell($username,$count)
    {
        $added = 0;
        $user_id=(new \yii\db\Query())  
            ->select(['id'])
            ->from('user')
            ->where(['username' => $username])
            ->scalar();
        if(!$user_id){
           $this->stdout( "Пользователь с таким логином не найден в базе.\n", Console::FG_RED, Console::BOLD); 
           exit;
        }
          
        $order = new OrderGenerator();
    
        for( $i=0; $i<$count; $i++ )
        { 
          $val['user_id']=$user_id;
          $certificate=Certificate::find()->where([ 'virtual' => 1, 'user_id' => $val['user_id']])->orderBy('RAND()')->limit(1)->one();
          $val['type'] = Order::TYPE_SELL;
          if(!$certificate){
            $this->stdout( "Сначала сгенерируйте виртуальные сертфикаты.\n", Console::FG_RED, Console::BOLD); 
            exit;
          }
          $val['source_id']=$certificate->id;
          $val['user_id']=$certificate->user_id;
          $val['club_id']=$certificate->club_id;
          $val['country_id']=$certificate->country_id;
          $val['apartment_type_id']=$certificate->apartment_type_id;
          $val['season_id']=$certificate->season_id;
          $val['interval']=$certificate->interval;
          $val['interval_numbers']=$certificate->interval_numbers;
          $val['apartment_number']=$certificate->apartment_number;
          $val['bonus_weeks']=$certificate->bonus_weeks;
          $val['price_show']=1;
          $val['priced_value']=mt_rand(100, 1600)*10;
          $val['priced_currency']=(new \yii\db\Query())  
            ->select(['code'])
            ->from('currencies')
            ->orderBy('RANDOM()')
            ->limit(1)
            ->scalar();
          $val['is_active']=1;
          $val['created_at']=date("ymd");
          $val['updated_at']=date("ymd");
          $val['virtual']=1;
          if ($order->AddOrders($val))$added++;
        }
        if ($added>0)
        {
            $this->stdout( $added." виртуальных ордеров на продажу добавлено в базу.\n", Console::FG_GREEN, Console::BOLD);
        } else {
            $this->stdout( "Не удалось добавить ордера на продажу.\n", Console::FG_RED, Console::BOLD);
        }

    }
    
    /**
      * Обязательные опции - логин от кого и количество ордеров (demo 100, к примеру)
    */
    public function actionAddbuy($username,$count)
    {
        $added = 0;
        
        $user_id=(new \yii\db\Query())  
            ->select(['id'])
            ->from('user')
            ->where(['username' => $username])
            ->scalar();
        if(!$user_id){
           $this->stdout( "Пользователь с таким логином не найден в базе.\n", Console::FG_RED, Console::BOLD); 
           exit;
        }
        
        $order = new OrderGenerator();
    
        for( $i=0; $i<$count; $i++ )
        { 
          $val['user_id']=$user_id;
          $val['type'] = Order::TYPE_BUY;
          $val['source_id']=0;
          $val['club_id']=array_rand(Club::getClubList(), 1);
          $val['country_id']=array_rand(Country::getCountryList(), 1);
          $val['apartment_type_id']=array_rand(ApartmentType::getApartmentTypeList(), 1);
          $val['season_id']=array_rand(Season::getSeasonList(), 1);
          $val['interval']=mt_rand(1, 9);
          $val['interval_numbers']=mt_rand(1, 9);
          $val['apartment_number']=mt_rand(1, 99);
          $val['bonus_weeks']=0;
          $val['price_show']=1;
          $val['priced_value']=mt_rand(100, 1600)*10;
          $val['priced_currency']=(new \yii\db\Query())  
            ->select(['code'])
            ->from('currencies')
            ->orderBy('RANDOM()')
            ->limit(1)
            ->scalar();
          $val['is_active']=1;
          $val['created_at']=date("ymd");
          $val['updated_at']=date("ymd");
          $val['virtual']=1;
          if ($order->AddOrders($val))$added++;
        }
        if ($added>0)
        {
            $this->stdout( $added." виртуальных ордеров на покупку добавлено в базу.\n", Console::FG_GREEN, Console::BOLD);
        } else {
            $this->stdout( "Не удалось добавить ордера на покупку.\n", Console::FG_RED, Console::BOLD);
        }

    }
    
    /**
      * Необязательная опция - логин пользователя, чьи ордера удаляем (demo, к примеру), иначе удаляем все виртуальные ордера на продажу
    */
    public function actionRemovesell($username = null)
    {
        $user_id=(new \yii\db\Query())  
            ->select(['id'])
            ->from('user')
            ->where(['username' => $username])
            ->scalar();
        if($username && !$user_id){
           $this->stdout( "Пользователь с таким логином не найден в базе.\n", Console::FG_RED, Console::BOLD); 
           exit;
        }
        
        $order = new OrderGenerator();
        
        if( $user_id ){
            if ($order->RemoveOrders(['virtual' => 1 , 'type' => 1 , 'user_id' => $user_id]))
            {
                $this->stdout("Все виртуальные ордера на продажу пользователя №".$user_id." удалены из базы.\r\n", Console::FG_GREEN, Console::BOLD);
            } else {
                $this->stdout("Виртуальные ордера на продажу пользователя №".$user_id." в базе не обнаружены.\n", Console::FG_RED, Console::BOLD);
            }
        }
        else{
            if ($order->RemoveOrders(['virtual' => 1 , 'type' => 1  ]))
            {
                $this->stdout("Все виртуальные ордера на продажу удалены из базы.\n", Console::FG_GREEN, Console::BOLD);
            } else {
                $this->stdout("Виртуальные ордера на продажу в базе не обнаружены.\n", Console::FG_RED, Console::BOLD);
            }
        }
    }
    
    /**
      * Необязательная опция - логин пользователя, чьи ордера удаляем (demo, к примеру), иначе удаляем все виртуальные ордера на покупку
    */
    public function actionRemovebuy($username = null)
    {
        $user_id=(new \yii\db\Query())  
            ->select(['id'])
            ->from('user')
            ->where(['username' => $username])
            ->scalar();
        if($username && !$user_id){
           $this->stdout( "Пользователь с таким логином не найден в базе.\n", Console::FG_RED, Console::BOLD); 
           exit;
        }
        
        $order = new OrderGenerator();
        
        if( $user_id ){
            if ($order->RemoveOrders(['virtual' => 1 , 'type' => 2 , 'user_id' => $user_id]))
            {
                $this->stdout("Все виртуальные ордера на покупку пользователя №".$user_id." удалены из базы.\n", Console::FG_GREEN, Console::BOLD);
            } else {
                $this->stdout("Виртуальные ордера на покупку пользователя №".$user_id." в базе не обнаружены.\n", Console::FG_RED, Console::BOLD);
            }
        }
        else{
            if ($order->RemoveOrders(['virtual' => 1 , 'type' => 2  ]))
            {
                $this->stdout("Все виртуальные ордера на покупку удалены из базы.\n", Console::FG_GREEN, Console::BOLD);
            } else {
               $this->stdout("Виртуальные ордера на покупку в базе не обнаружены\n", Console::FG_RED, Console::BOLD);
            }
        }
        
    }

}
