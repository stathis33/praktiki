<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\LdapIdentity;
/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params, $validator)
{
    if (!$this->hasErrors()) {
        $ldapconn = ldap_connect("localhost", 389);

        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);

        $dn = "uid={$this->username},ou=users,dc=secproject,dc=gr";

        if (!@ldap_bind($ldapconn, $dn, $this->password)) {
            $this->addError($attribute, 'Λανθασμένα στοιχεία σύνδεσης.');
        }
    }
}

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
   public function login()
{
    $user = LdapIdentity::findByUsername($this->username);
    if ($user && $user->validatePassword($this->password)) {
        return Yii::$app->user->login($user);
    }

    $this->addError('password', 'Λανθασμένα LDAP στοιχεία.');
    return false;
}

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
