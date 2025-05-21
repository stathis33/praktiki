<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['username'], 'required'],
            [['username', 'email', 'cn', 'dn'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'email'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'cn' => 'Common Name',
            'dn' => 'Distinguished Name (DN)',
        ];
    }

    // IdentityInterface methods
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null; // Δεν χρησιμοποιείς API tokens
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return null; // Δεν χρησιμοποιείς "remember me"
    }

    public function validateAuthKey($authKey)
    {
        return false; // Δεν χρησιμοποιείς auth keys
    }
}
