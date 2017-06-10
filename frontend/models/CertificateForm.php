<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Certificate;
use yii\validators\RequiredValidator;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class CertificateForm extends Model {

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
    public function rules() {
        return [
                [[
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
            'certificate_sum',
                ], 'integer'],
                [[
            'certificate_code',
            'start_date',
            'end_date',
            'contract_code',
            'contract_date',
            'certificate_currency',
            'fees_start_currency',
            'fees_current_currency',
            'penalty_start_currency',
            'fees_loan_currency',
            'certificate_loan_currency',
            'priced_currency',
            'certificate_file'
                ], 'safe'],
                ['certificate_code', 'unique', 'targetClass' => '\common\models\Certificate'],
                [['certificate_file'], 'file', 'extensions' => ['png', 'jpg'], /* 'skipOnEmpty' => false */]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'club_id' => Yii::t('frontend', 'Club'), // select список клубов
            'country_id' => Yii::t('frontend', 'Country'), // select список стран
            'company_id' => Yii::t('frontend', 'Company'), // select список компаний
            'certificate_code' => Yii::t('frontend', 'Code of certificate'), // код сертификата
            'start_date' => Yii::t('frontend', 'Date of start'), // начало действия сертификата
            'end_date' => Yii::t('frontend', 'Date of end'), // 
            'contract_date' => Yii::t('frontend', 'Date of contract'),
            'certificate_period' => Yii::t('frontend', 'Certificate period'),
            'certificate_sum' => Yii::t('frontend', 'Certificate costs'),
            'certificate_currency' => Yii::t('frontend', 'Currency'),
            'apartment_type_id' => Yii::t('frontend', 'Apartment type'), // select типы апартаментов
            'season_id' => Yii::t('frontend', 'Season'), // select выбор сезона
            'interval' => Yii::t('frontend', 'Interval'),
            'interval_numbers' => Yii::t('frontend', 'Number of intervals'),
            'apartment_number' => Yii::t('frontend', 'Number of appartments'),
            'bonus_weeks' => Yii::t('frontend', 'Bonus weeks'),
            'points' => Yii::t('frontend', 'Points'),
            'fees_start_sum' => Yii::t('frontend', 'Start sum of fees'),
            'fees_start_currency' => Yii::t('frontend', 'Currency'),
            'fees_current_sum' => Yii::t('frontend', 'Current fees sum'),
            'fees_current_currency' => Yii::t('frontend', 'Currency'),
            'is_penalty' => Yii::t('frontend', 'Penalty'), // checkbox bool
            'penalty_start_sum' => Yii::t('frontend', 'Start sum of penalty'),
            'penalty_start_currency' => Yii::t('frontend', 'Currency'),
            'fees_loan_sum' => Yii::t('frontend', 'Sum of fees loan'),
            'fees_loan_currency' => Yii::t('frontend', 'Currency'),
            'certificate_loan_sum' => Yii::t('frontend', 'Sum of certificate loan'),
            'certificate_loan_currency' => Yii::t('frontend', 'Currency'),
            'status' => Yii::t('frontend', 'Status'), // select список статусов
            'is_expertize' => Yii::t('frontend', 'Expertize'), // bool
            'is_membership' => Yii::t('frontend', 'Membership'), // bool
            'is_priced' => Yii::t('frontend', 'Priced'), // bool
            'priced_sum' => Yii::t('frontend', 'Priced sum'),
            'priced_currency' => Yii::t('frontend', 'Currency'),
            'contract_code' => Yii::t('frontend', 'Contract Code'),
            'certificate_file' => Yii::t('frontend', 'Load Certificate File'),
        ];
    }

    /**
     * Save certificate.
     *
     * @return true|null the saved model or null if saving fails
     */
    public function save() {

        $modelCertificateForm = new Certificate();
        $modelCertificateForm->setAttributes($this->attributes);
        $modelCertificateForm->user_id = Yii::$app->user->identity->id;
        $modelCertificateForm->is_approved = 0;
        $modelCertificateForm->status = 0;
        $modelCertificateForm->is_archive = 0;
        $modelCertificateForm->created_at = time("ymd");
        $modelCertificateForm->updated_at = time("ymd");

        $modelCertificateForm->certificate_file = '1'; // Yii::$app->user->identity->id . '_' . $this->certificate_file->baseName . '.' . $this->certificate_file->extension;


     
        if ($modelCertificateForm->save()) {
            return true;
        } else {

            return false;
        }
    }

    public function upload() {
        if ($this->validate()) {
            $this->certificate_file->saveAs('../../uploads/certificate_file/' . Yii::$app->user->identity->id . '_' . $this->certificate_file->baseName . '.' . $this->certificate_file->extension);
            return true;
        } else {
            return false;
        }
    }

}
