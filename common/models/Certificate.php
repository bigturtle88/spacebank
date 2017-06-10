<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

class Certificate extends ActiveRecord {

    public static $CERTIFICATE_PERIOD_ARRAY = ['1' => '1', '2' => '2', '3' => '3', '4' => '4',
        '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10', '69' => '69'];
    public static $CERTIFICATE_CURENCY = ['USD' => 'USD', 'EUR' => 'EUR', 'RUR' => 'RUR'];

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%certificates}}';
    }

    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
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
            'is_approved',
            'is_archive',
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
        ];
    }

    public function getCountry() {
        $country = $this->hasOne(Country::className(), ['id' => 'country_id'])->one();
        $country = is_null($country) ? new Country() : $country;

        return $country;
    }

    public function getCompany() {
        return $this->hasOne(Company::className(), ['id' => 'company_id'])->one();
    }

    public function getClub() {
        $club = $this->hasOne(Club::className(), ['id' => 'club_id'])->one();
        $club = is_null($club) ? new Club() : $club;
        return $club;
    }

    public function getApartmentType() {
        $apartmentType = $this->hasOne(ApartmentType::className(), ['id' => 'apartment_type_id'])->one();
        $apartmentType = is_null($apartmentType) ? new ApartmentType() : $apartmentType;
        return $apartmentType;
    }

    public function getSeason() {
        $season = $this->hasOne(Season::className(), ['id' => 'season_id'])->one();
        $season = is_null($season) ? new ApartmentType() : $season;
        return $season;
    }

    /**
     * Get Certificate list.
     *
     * @return array
     */
    public static function getCertificateObjectList() {

        return Certificate::find()
                        ->select('*')
                        ->where(['certificates.user_id' => Yii::$app->user->identity->id])
                        ->all();
    }

    /**
     * Get Certificate Object list.
     *
     * @return array
     */
    public static function getCertificateList() {

        $certificate = Certificate::find()
                ->select(['id', 'certificate_code'])
                ->where(['user_id' => Yii::$app->user->identity->id])
                ->all();


        return ArrayHelper::map($certificate, 'id', 'certificate_code');
    }

    /**
     * Get Certificate Object list.
     *
     * @return array
     */
    public static function getCertificatesPackageList($package_id) {

        $certificate = Certificate::find()
                ->select(['id', 'certificate_code'])
                ->where(['package_id' => $package_id])
                ->all();


        return ArrayHelper::map($certificate, 'id', 'certificate_code');
    }

    public function getClubUser() {

        $certificates = Certificate::find()
                        ->select(['club_id'])
                        ->where(['user_id' => Yii::$app->user->identity->id])->all();

        $clubs = array();
        foreach ($certificates as $certificate) {

            array_push( $clubs,$certificate->club_id);
        }
    
       $query =  new \yii\db\Query();
        $club =  $query->select(['id', 'name'])->from('clubs')->where( ['id' => $clubs])->all();

   return ArrayHelper::map($club, 'id', 'name');
    }

}
