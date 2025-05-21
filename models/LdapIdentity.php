<?php
namespace app\models;

use Yii;
use yii\base\BaseObject;
use yii\web\IdentityInterface;

class LdapIdentity extends BaseObject implements IdentityInterface
{
    public $username;
    public $dn;
    public $mail;
    public $cn;

    public static function findIdentity($id) {
        return self::findByUsername($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) { 
        return null; 
    }

    public static function findByUsername($username)
    {
        $ldapconn = ldap_connect("ldap://localhost");
        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

        $bind = ldap_bind($ldapconn, "cn=admin,dc=secproject,dc=gr", "adminpass");
        if (!$bind) return null;

        $search = ldap_search($ldapconn, "ou=users,dc=secproject,dc=gr", "(uid=$username)");
        $entries = ldap_get_entries($ldapconn, $search);

        if ($entries["count"] > 0) {
            $user = new self();
            $user->username = $username;
            $user->dn = $entries[0]["dn"];
            $user->cn = $entries[0]["cn"][0] ?? null;
            $user->mail = $entries[0]["mail"][0] ?? null;
            return $user;
        }

        return null;
    }

    public function validatePassword($password)
    {
        $ldapconn = ldap_connect("ldap://localhost");
        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
        return @ldap_bind($ldapconn, $this->dn, $password);
    }

    public function getId() { return $this->username; }
    public function getAuthKey() { return null; }
    public function validateAuthKey($authKey) { return false; }
}