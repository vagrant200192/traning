<?php

namespace app\models;

use Yii;
use yii\base\Security;
use yii\web\IdentityInterface;
use app\models\Comment;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $email
 * @property string $password
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    const ROLE_ADMIN = 20;
    const ROLE_USER = 10;

    public function beforeSave($insert)
    {
        if (isset($this->password)){
            $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        }
        return parent::beforeSave($insert);
    }

    public $authKey;
    public $repeatPassword;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password', 'repeatPassword'], 'required'],
            [['email'], 'email'],
            [['email'], 'unique'],
            ['role', 'in', 'range' => [self::ROLE_USER, self::ROLE_ADMIN]],
            [['email', 'password'], 'string', 'max' => 255],
            [['password'], 'string', 'min' => 5],
            ['repeatPassword', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => Yii::t('app', 'ATTR_EMAIL'),
            'password' => Yii::t('app', 'ATTR_PASSWORD'),
            'repeatPassword' => Yii::t('app', 'ATTR_REPEAT_PASSWORD'),
        ];
    }

    /**
     * @inheritdoc
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public static function findByUsername($email)
    {
        return static::findOne(['email' => $email]);
    }

    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    public static function isUserAdmin($email)
    {
        if (static::findOne(['email' => $email, 'role' => self::ROLE_ADMIN])){
            return true;
        }
        else{
            return false;
        }
    }

    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['author' => 'email']);
    }
}
