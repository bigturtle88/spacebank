<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $user_type
 * @property integer $tel
 * @property string $fio
 * @property integer $is_individual
 * @property string $contact
 * @property string $firm_name
 * @property integer $country_id
 * @property integer $money
 */
class UserForm extends \yii\db\ActiveRecord {

    public $password;
    public $password_repeat;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['username', 'email', 'tel', 'fio'], 'required'],
                [['status', 'country_id', 'is_individual'], 'integer'],
                [['money'], 'safe'],
                [['username', 'user_type', 'email', 'fio', 'contact', 'firm_name', 'password'], 'string', 'max' => 255],
                [['username'], 'unique'],
                [['email'], 'unique'],
                ['password_repeat', 'compare', 'compareAttribute' => 'password', 'skipOnEmpty' => false, 'message' => "Passwords don't match"],
                [['contact', 'firm_name'], 'required', 'when' => function($model) {
                    return $model->is_individual;
                }, 'whenClient' => "function (attribute, value) {return $('.isFirm').is(':checked');}"],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Пароль',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Активен',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_type' => Yii::t('backend', 'User type'),
            'tel' => Yii::t('backend', 'Phone number'),
            'fio' => Yii::t('backend', 'FIO'),
            'is_individual' => Yii::t('backend', 'Individual'),
            'contact' => Yii::t('backend', 'Contact name'),
            'firm_name' => Yii::t('backend', 'Firm name'),
            'country_id' => 'Страна',
            'password_repeat' => 'Повтор пароля',
            'password' => 'Пароль',
            'money' => 'Деньги на счету'
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function preperSave() {
        if (!empty($this->password)) {
            $this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
        }
        $this->auth_key = Yii::$app->security->generateRandomString();
        if(!$this->country_id) $this->country_id= 0;
        if(!$this->money) $this->money= 0;
        return true;
    }

}
