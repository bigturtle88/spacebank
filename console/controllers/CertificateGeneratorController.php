<?php

namespace console\controllers;

use Yii;
use console\models\CertificateGenerator;
use yii\console\Controller;
use common\models\Certificate;
use common\models\Country;
use common\models\Club;
use common\models\ApartmentType;
use common\models\Season;
use common\models\Company;
use yii\helpers\Console;

/**
 * Запуск генератора сертификатов
 */
class CertificateGeneratorController extends Controller {

    /**
      * Обязательные опции - логин от кого и количество сертификатов (100, к примеру)
    */
    public function actionAdd($username,$count)
    {
        $added = 0;
        $values_array = array();

        $certificate = new CertificateGenerator();
        
        for( $i=0; $i<$count; $i++ )
        {
          $certificate_code=certificate_code_generate();
          $certificate_sum=mt_rand(100, 1600)*10;
          $currency=(new \yii\db\Query())  
            ->select(['code'])
            ->from('currencies')
            ->orderBy('RANDOM()')
            ->limit(1)
            ->scalar();
          $period=array_rand(Certificate::$CERTIFICATE_PERIOD_ARRAY, 1);
          $period_secunds=3600*24*365*$period;
          $month_secunds=3600*24*30;
          $start=mt_rand(time()-$period_secunds+$month_secunds, time()-$month_secunds);
          $finish=$start+$period_secunds;
          $contract_date=$start-3600*24*365*mt_rand(1, 5);
          $val['user_id']=(new \yii\db\Query())  
            ->select(['id'])
            ->from('user')
            ->where(['username' => $username])
            ->scalar();
          if(!$val['user_id']){
            $this->stdout( "Пользователь с таким логином не найден в базе.\n", Console::FG_RED, Console::BOLD); 
            exit;
          }
          $val['club_id']=array_rand(Club::getClubList(), 1);
          $val['country_id']=array_rand(Country::getCountryList(), 1);
          $val['company_id']=array_rand(Company::getCompanyList(), 1);
          $val['certificate_code']=$certificate_code;
          $val['start_date']=date('Y-m-d',$start);
          $val['end_date']=date('Y-m-d',$finish);
          $val['contract_code']=mt_rand(100000, 999999);
          $val['contract_date']=date('Y-m-d',$contract_date);
          $val['certificate_period']=$period;
          $val['certificate_sum']=$certificate_sum;
          $val['certificate_currency']=$currency;
          $val['apartment_type_id']=array_rand(ApartmentType::getApartmentTypeList(), 1);
          $val['season_id']=array_rand(Season::getSeasonList(), 1);
          $val['interval']=mt_rand(1, 9);
          $val['interval_numbers']=mt_rand(1, 9);
          $val['apartment_number']=mt_rand(1, 99);
          $val['bonus_weeks']=0;
          $val['points']=22;
          $val['fees_start_sum']=mt_rand(100, 1600)*10;
          $val['fees_start_currency']=$currency;
          $val['fees_current_sum']=mt_rand(100, 1600)*10;
          $val['fees_current_currency']=$currency;
          $val['is_penalty']=0;
          $val['penalty_start_sum']=mt_rand(100, 1600)*10;
          $val['penalty_start_currency']=$currency;
          $val['fees_loan_sum']=mt_rand(100, 1600)*10;
          $val['fees_loan_currency']=$currency;
          $val['certificate_loan_sum']=mt_rand(100, 1600)*10;
          $val['certificate_loan_currency']=$currency;
          $val['is_expertize']=0;
          $val['is_membership']=0;
          $val['is_priced']=0;
          $val['priced_sum']=mt_rand(100, 1600)*10;
          $val['priced_currency']=$currency;
          $val['is_approved']=0;
          $val['is_archive']=0;
          $val['status']=1;
          $val['certificate_file']=0;
          $val['created_at']=date("ymd");
          $val['updated_at']=date("ymd");
          $val['virtual']=1;
          if ($certificate_code!=0)if ($certificate->AddCertificates($val))$added++;
          if ($certificate_code==0)$finish=1;
        }
        if ($added > 0) {
            echo $this->stdout($added . " сертификатов добавлено в базу.\n", Console::FG_GREEN, Console::BOLD);
        } else {
            echo $this->stdout("Не удалось добавить сертификаты.\n", Console::FG_RED, Console::BOLD);
        }
        if ($finish == 1)
            echo $this->stdout("Закончились свободные номера в выбранном диапазоне.\n", Console::FG_RED, Console::BOLD);
    }

    /**
     * Необязательная опция - ID пользователя, чьи сертификаты удаляем (5, к примеру), иначе удаляем все виртуальные сертификаты
     */
    public function actionRemove($user_id = null) {
        $certificate = new CertificateGenerator();

        if ($user_id) {
            if ($certificate->RemoveCertificates(['virtual' => 1, 'user_id' => $user_id])) {
                echo $this->stdout("Все виртуальные сертификаты пользователя №" . $user_id . " удалены из базы.\r\n", Console::FG_GREEN, Console::BOLD);
            } else {
                echo $this->stdout("Виртальные сертификаты пользователя №" . $user_id . " в базе не обнаружены.\r\n", Console::FG_RED, Console::BOLD);
            }
        } else {
            if ($certificate->RemoveCertificates(['virtual' => 1])) {
                echo $this->stdout("Все виртуальные сертификаты удалены из базы.\n", Console::FG_GREEN, Console::BOLD);
            } else {
                echo $this->stdout("Виртальные сертификаты в базе не обнаружены.\n", Console::FG_RED, Console::BOLD);
            }
        }
    }

}

function certificate_code_generate() {
    global $certificate_code;
    global $fails_number;
    $certificate_code = mt_rand(13500000, 13800000);
    $certificate_code_exists = Certificate::find()
            ->select(['id', 'certificate_code'])
            ->where(['certificate_code' => $certificate_code])
            ->one();
    //если такой номер уже есть в базе, выбираем ещё раз
    if ($certificate_code_exists && $fails_number < 10) {
        $fails_number++;
        certificate_code_generate();
    }

    if ($fails_number >= 10)
        $certificate_code = 0; //если закончились свободные номера в выделенном диапазоне

    return $certificate_code;
}
