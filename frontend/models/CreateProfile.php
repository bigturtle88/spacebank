<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * CreateProfile form
 */
class CreateProfile extends Model {

    public $username;
    public $email;
    public $password;
    public $tel;
    public $fio;
    public $is_individual;
    public $contact;
    public $firm_name;
    public $country_id;
    public $password_repeat;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                ['username', 'trim'],
                ['is_individual', 'boolean'],
                [['username', 'tel', 'fio', 'is_individual'], 'required'],
                ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
                ['username', 'string', 'min' => 2, 'max' => 255],
                ['email', 'trim'],
                ['email', 'required'],
                ['email', 'email'],
                ['email', 'string', 'max' => 255],
            //['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
                ['password', 'string', 'min' => 6],
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
            'username' => Yii::t('frontend', 'Login'),
            'email' => Yii::t('frontend', 'Email'),
            'fio' => Yii::t('frontend', 'Fio'),
            'tel' => Yii::t('frontend', 'Tel'),
            'is_individual' => Yii::t('frontend', 'Is Individual'),
            'contact' => Yii::t('frontend', 'Contact'),
            'firm_name' => Yii::t('frontend', 'Firm Name'),
            'password' => Yii::t('frontend', 'Password'),
            'password_repeat' => Yii::t('frontend', 'Password Repeat'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup($id) {

        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user = $user->findOne($id);
        $user->username = $this->username;

        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->tel = $this->tel;
        $user->fio = $this->fio;
        $user->country_id = 0;
        $user->user_type = User::TYPE_USER;

        $user->email_confirm_token = null;
        if ($this->is_individual != 0) {

            $user->is_individual = $this->is_individual;
            $user->contact = $this->contact;
            $user->firm_name = $this->firm_name;
        }

        if (Yii::$app->config->get('auto_activation') === 1)
            $user->status = $user::STATUS_ACTIVE;

        return $user->save() ? $user : null;
    }

}
