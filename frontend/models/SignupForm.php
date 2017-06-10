<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model {

    public $username;
    public $email;
    public $password;
    public $tel;
    public $fio;
    public $is_individual;
    public $contact;
    public $firm_name;
    public $country;
    public $password_repeat;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                ['email', 'trim'],
                ['email', 'required'],
                ['email', 'email'],
                ['email', 'string', 'max' => 255],
                ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'email' => Yii::t('frontend', 'Email'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function sendMail() {

        if (!$this->validate()) {
            return null;
        }

        $user = User::find()->where(['email' => $this->email])->one();

        if (!$user || $user->status === User::STATUS_WAIT) {

            $user = new User();
            //$user->username = $this->email;
  
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->country_id = 0;
            $user->status = User::STATUS_WAIT;
            $user->generateAuthKey();
            $user->email_confirm_token = Yii::$app->security->generateRandomString() . '_' . time();
            $user->username = $user->email_confirm_token;
            $user->save();

            return Yii::$app->mailer->compose(('signup.php'), ['user' => $user])
                    ->setFrom(['spacebank7@gmail.com' => 'Spacebank'])
                    ->setTo($this->email)
                    ->setSubject('Spacebank register')
                    ->send();
        }

        return false;
    }

}
