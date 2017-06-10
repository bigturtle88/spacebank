<?php

namespace console\controllers;

use Yii;
use console\models\DealsGenerator;
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
class DealsGeneratorController extends Controller
{
    /**
      * Обязательные опции - количество сделок (100, к примеру)
    */
    public function actionAdd($count)
    {
        $added = 0;
        
        $deal = new DealsGenerator();
    
        for( $i=0; $i<$count; $i++ )
        { 
          $certificate=Certificate::find()->where([ 'virtual' => 1])->orderBy('RAND()')->limit(1)->one();
          if(!$certificate){
            $this->stdout( "Сначала сгенерируйте виртуальные сертфикаты.\n", Console::FG_RED, Console::BOLD); 
            exit;
          }
          $val['buyer_id']=(new \yii\db\Query())  
            ->select(['id'])
            ->from('user')
            ->where(['!=', 'id', $certificate->user_id])
            ->orderBy('RANDOM()')
            ->limit(1)
            ->scalar();
          $val['seller_id']=$certificate->user_id;
          $val['club_id']=$certificate->club_id;
          $val['country_id']=$certificate->country_id;
          $val['apartment_type_id']=$certificate->apartment_type_id;
          $val['season_id']=$certificate->season_id;
          $val['certificate_id']=$certificate->certificate_code;
          $val['priced_value']=mt_rand(100, 1600)*10;
          $val['priced_currency']=(new \yii\db\Query())  
            ->select(['code'])
            ->from('currencies')
            ->orderBy('RANDOM()')
            ->limit(1)
            ->scalar();
          $rate=(new \yii\db\Query())  
            ->select(['rate'])
            ->from('currencies')
            ->where(['code'=>$val['priced_currency']])
            ->scalar();
          $val['sum']=round($val['priced_value']/$rate);
          $system_procent=(new \yii\db\Query())  
            ->select(['value'])
            ->from('config')
            ->where(['key'=>'system_procent'])
            ->scalar();
          $val['sum_system']=round($val['sum']*$system_procent/100);
          $val['created_at']=time();
          $val['updated_at']=time();
          $val['virtual']=1;
          if ($deal->AddDeals($val))$added++;
        }
        if ($added>0)
        {
            $this->stdout( $added." виртуальных логов сделок добавлено в базу.\n", Console::FG_GREEN, Console::BOLD);
        } else {
            $this->stdout( "Не удалось добавить логи сделок.\n", Console::FG_RED, Console::BOLD);
        }

    }
    
 
    
    /**
      * Удаляем все виртуальные логи сделок
    */
    public function actionRemove()
    {
        $deal = new DealsGenerator();
        
            if ($deal->RemoveDeals(['virtual' => 1 ]))
            {
                $this->stdout("Все виртуальные логи сделок удалены из базы.\n", Console::FG_GREEN, Console::BOLD);
            } else {
                $this->stdout("Виртуальные логи сделок в базе не обнаружены.\n", Console::FG_RED, Console::BOLD);
            }
    }

}
