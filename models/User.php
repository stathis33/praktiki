<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 
 * @property string|null $auth_key
 * @property string|null $created_at
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
   public function rules()
{
    return [
        [['username', 'password_hash'], 'required'],
        [['username'], 'string', 'max' => 255],
        [['password_hash'], 'string', 'max' => 512],
        [['auth_key'], 'string', 'max' => 32],
        [['username'], 'unique'],
        [['email'], 'required'],
        [['email'], 'unique'],
    ];
}


    /**
     * {@inheritdoc}
     */
public function attributeLabels()
{
    return [
        'id' => 'ID',
        'username' => 'Username',
       'email' =>'Email',
        'password_hash' => 'Password',
        'auth_key' => 'Auth Key',
        'created_at' => 'Created At',
    ];
}
    // ========================
    // IdentityInterface methods
    // ========================

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null; // Δεν χρησιμοποιούμε API tokens
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }
    
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    // ========================
    // Extra methods
    // ========================

    /**
     * Ελέγχει τον κωδικό του χρήστη
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Ορίζει νέο password hash
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Δημιουργεί νέο auth_key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
}
