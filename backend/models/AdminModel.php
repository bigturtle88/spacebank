<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "admin".
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
 */
class AdminModel extends ActiveRecord implements IdentityInterface {

    public $password;
    public $password_repeat;
    public $perm;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%admin}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'username' => Yii::t('backend', 'Admin name'),
            'email' => Yii::t('backend', 'Email'),
            'status' => Yii::t('backend', 'Active'),
            'created_at' => Yii::t('backend', 'Created at'),
            'updated_at' => Yii::t('backend', 'Updated at'),
            'password_repeat' => Yii::t('backend', 'Password repeat'),
            'password' => Yii::t('backend', 'Password'),
            'perm' => 'Группа доступа'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['username', 'email', 'status'], 'required'],
                [['username', 'password', 'email'], 'string', 'max' => 255],
                [['username'], 'unique'],
                [['email'], 'unique'],
                ['password_repeat', 'compare', 'compareAttribute' => 'password', 'skipOnEmpty' => false, 'message' => "Passwords don't match"],
                [['perm'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return static::findOne(['id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token) {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
                    'password_reset_token' => $token
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token) {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password) {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken() {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }

    /**
     * Returns user role name according to RBAC
     * @return string
     */
    public function getRoleName() {
        $roles = Yii::$app->authManager->getRolesByUser($this->id);
        if (!$roles) {
            return null;
        }

        reset($roles);
        /* @var $role \yii\rbac\Role */
        $role = current($roles);

        return $role->name;
    }

    public function beforeSave($insert) {
        if (!empty($this->password))
            $this->setPassword($this->password);
        $this->generateAuthKey();
        if (isset($this->status))
            $this->status = 10;
        else
            $this->status = 0;

        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes) {
        if (isset($this->perm)) {
            $auth = Yii::$app->authManager;
            $roleObject = $auth->getRole($this->perm);
            //exit(var_dump($roleObject));
            if ($auth->getRolesByUser($this->id))
                $auth->revokeAll($this->id);

            $auth->assign($roleObject, $this->id);
        }
        parent::afterSave($insert, $changedAttributes);
    }

}
