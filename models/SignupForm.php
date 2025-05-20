<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
           [['email'], 'required'],
[['email'], 'email'],
[['email'], 'unique', 'targetClass' => User::class],

            ['username', 'string', 'min' => 3, 'max' => 255],
           ['password', 'validateStrongPassword'],
            [['username'], 'unique', 'targetClass' => User::class],
        ];
    }

    public function signup()
    {
        if (!$this->validate()) return null;

        $user = new User();
        $user->username = $this->username;
      $user->email = $this->email;
        $user->password_hash = Yii::$app->security->generatePasswordHash($this->password); // ✅ απευθείας hash
    $user->auth_key = Yii::$app->security->generateRandomString();   
        return $user->save() ? $user : null;
    }
    

public function validateStrongPassword($attribute, $params)
{
    if (!preg_match('/[A-Z]/', $this->$attribute)) {
        $this->addError($attribute, 'Ο κωδικός πρέπει να περιέχει τουλάχιστον ένα κεφαλαίο γράμμα.');
    }

    if (!preg_match('/[\W]/', $this->$attribute)) { // \W = μη αλφαριθμητικός χαρακτήρας
        $this->addError($attribute, 'Ο κωδικός πρέπει να περιέχει τουλάχιστον ένα ειδικό σύμβολο (π.χ. !, @, #).');
    }
}}