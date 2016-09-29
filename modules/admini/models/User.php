<?php

namespace app\modules\admini\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "tb_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $create_time
 */
class User extends ActiveRecord implements IdentityInterface
{

    public static function tableName()
    {
        return 'tb_user';
    }

    public function rules()
    {
        return [
            [['username', 'password', 'email'], 'required'],
            [['create_time'], 'integer'],
            [['username', 'email'], 'unique'],
            ['email', 'email'],
            [['username', 'email'], 'string', 'max' => 64],
            [['password'], 'string', 'max' => 128],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'username' => '用户名',
            'password' => '登录密码',
            'email' => '邮箱',
            'create_time' => '创建时间',
        ];
    }

    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    public static function findByUsername($username)
    {
        $user = self::find()->where(['username' => $username])->one();
        if ($user)
            return new static($user);
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return null;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->setPassword($this->password);
                $this->create_time = time();
            }
            return true;
        }
        return false;
    }
}
