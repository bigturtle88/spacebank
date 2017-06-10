<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\Certificate;
use yii\validators\RequiredValidator;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii\behaviors\TimestampBehavior;
/**
 * ContactForm is the model behind the contact form.
 */

class CertificateForm extends Model 
{

    public $id;
    public $user_id;
    public $club_id;
    public $country_id;
    public $company_id;
    public $certificate_code;
    public $start_date;
    public $end_date;
    public $contract_code;
    public $contract_date;
    public $certificate_period;
    public $certificate_sum;
    public $certificate_currency;
    public $apartment_type_id;
    public $season_id;
    public $interval;
    public $interval_numbers;
    public $apartment_number;
    public $bonus_weeks;
    public $points;
    public $fees_start_sum;
    public $fees_start_currency;
    public $fees_current_sum;
    public $fees_current_currency;
    public $is_penalty;
    public $penalty_start_sum;
    public $penalty_start_currency;
    public $fees_loan_sum;
    public $fees_loan_currency;
    public $certificate_loan_sum;
    public $certificate_loan_currency;
    public $status;
    public $is_expertize;
    public $is_membership;
    public $is_priced;
    public $priced_sum;
    public $priced_currency;
    public $is_approved;
    public $is_archive;
    public $created_at;
    public $updated_at;
    public $certificate_file;



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'certificates';
    }
 
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [[
                  'user_id',
                  'club_id',
                  'certificate_code',
                  'start_date',
                  'end_date',
                  'apartment_type_id',
                  'season_id',
                  'company_id',
                  'country_id',
                ], 'required'],
                [[
                    'id',
                    'club_id',
                    'country_id',
                    'company_id',
                    'certificate_period',
                    'apartment_type_id',
                    'season_id',
                    'interval',
                    'interval_numbers',
                    'apartment_number',
                    'bonus_weeks',
                    'points',
                    'fees_start_sum',
                    'fees_current_sum',
                    'is_penalty',
                    'penalty_start_sum',
                    'fees_loan_sum',
                    'certificate_loan_sum',
                    'is_expertize',
                    'is_membership',
                    'is_priced',
                    'priced_sum',
                    'is_approved',
                    'is_archive',
                    'priced_sum',
                    ], 'integer'],
                    [[
                    'certificate_code',
                    'start_date',
                    'end_date',
                    'contract_code',
                    'contract_date',
                    'certificate_sum',
                    'certificate_currency',
                    'fees_start_currency',
                    'fees_current_currency',
                    'penalty_start_currency',
                    'fees_loan_currency',
                    'certificate_loan_currency',
                    'priced_currency',
                    'certificate_file',
                    'priced_currency',
                    'created_at',
                    'updated_at',
                    ], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
 
   
 
    public function attributeLabels()
    {
        return [
            'club_id' => Yii::t('backend', 'Club'), // select список клубов
            'country_id' => Yii::t('backend', 'Country'), // select список стран
            'company_id' => Yii::t('backend', 'Company'),
            'certificate_code' => Yii::t('backend', 'Certificate Code'), // код сертификата
            'start_date' => Yii::t('backend', 'Date of start'), // начало действия сертификата
            
            'end_date' => Yii::t('backend', 'Date of end'), // 
            'contract_date' => Yii::t('backend', 'Date of contract'),

            'contract_code' => Yii::t('backend', 'Contract Code'),
            
            'certificate_period' => Yii::t('backend', 'Certificate period'),
            'certificate_sum' => Yii::t('backend', 'Certificate costs'),
            
            'certificate_currency' => Yii::t('backend', 'Currency'),
            'apartment_type_id' => Yii::t('backend', 'Apartment Type'), // select типы апартаментов
            
            'season_id' => Yii::t('backend', 'Season'), // select выбор сезона
            'interval' => Yii::t('backend', 'Interval'),
            
            'interval_numbers' => Yii::t('backend', 'Number of intervals'),
            'apartment_number' => Yii::t('backend', 'Number of appartments'),
            'bonus_weeks' => Yii::t('backend', 'Bonus weeks'),
            'points' => Yii::t('backend', 'Points'),
            
            'fees_start_sum' => Yii::t('backend', 'Start sum of fees'),
            'fees_start_currency' => Yii::t('backend', 'Currency'),
            
            'fees_current_sum' => Yii::t('backend', 'Current fees sum'),
            'fees_current_currency' => Yii::t('backend', 'Currency'),
            
            'is_penalty' => Yii::t('backend', 'Penalty'), // checkbox bool
            'penalty_start_sum' => Yii::t('backend', 'Start sum of penalty'),
            
            'penalty_start_currency' => Yii::t('backend', 'Currency'),
            'fees_loan_sum' => Yii::t('backend', 'Sum of fees loan'),
            
            'fees_loan_currency' => Yii::t('backend', 'Currency'),
            'certificate_loan_sum' => Yii::t('backend', 'Sum of certificate loan'),
            
            'certificate_loan_currency' => Yii::t('backend', 'Currency'),
            'status' => Yii::t('backend', 'Status'), // select список статусов
            'is_expertize' => Yii::t('backend', 'Expertize'), // bool
            
            'is_membership' => Yii::t('backend', 'Membership'),  // bool
            'is_priced' => Yii::t('backend', 'Priced'),  // bool
            'priced_sum' => Yii::t('backend', 'Priced sum'),
            'priced_currency' => Yii::t('backend', 'Currency'),
            'is_approved' => Yii::t('backend', 'Approved'),
            'is_archive' =>  Yii::t('backend', 'Archive')
        ];
    }


    /**
     * Save certificate.
     *
     * @return true|null the saved model or null if saving fails
     */
    public function save()
    {
        if(is_null($this->id)){
            $modelCertificateForm  =  new Certificate();
        }else{
            $modelCertificateForm = Certificate::findOne($this->id);
        }

        $modelCertificateForm->setAttributes($this->attributes);
        if(!$modelCertificateForm->user_id)$modelCertificateForm->user_id=1;
        if(!$modelCertificateForm->created_at)$modelCertificateForm->created_at = date("ymd");
        if(!$modelCertificateForm->updated_at)$modelCertificateForm->updated_at = date("ymd");
        return $modelCertificateForm->save() ? true : false;
        
    }

    public function delete(){
       Certificate::findOne($this->id)->delete();
    }


    public function isNewRecord(){
        return is_null($this->id) ? true : false;
    }
}