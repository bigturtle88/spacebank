<?php

namespace frontend\models;

use Yii;
use yii\base\Model;


/**
 * ContactForm is the model behind the contact form.
 */
class ProfileForm extends Model {

    public $username;
    public $email;
    public $fio;
    public $tel;
    public $is_individual;
    public $contact;
    public $firm_name;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['username', 'email', 'fio', 'tel'], 'required'],
                ['email', 'email'],
                [['is_individual'], 'integer'],
                [['username', 'fio', 'tel', 'contact', 'firm_name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'username' => Yii::t('frontend', 'Username'),
            'email' => Yii::t('frontend', 'Email'),
            'fio' => Yii::t('frontend', 'Fio'),
            'tel' => Yii::t('frontend', 'Tel'),
            'is_individual' => Yii::t('frontend', 'Is Individual'),
            'contact' => Yii::t('frontend', 'Contact'),
            'firm_name' => Yii::t('frontend', 'Firm Name')
        ];
    }

}
