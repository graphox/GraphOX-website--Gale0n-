<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    /**
     * Authenticates a user.
     * @return boolean whether authentication succeeds.
     */
    private $_id;
    public static $_allowed;

    public function authenticate() {
        $username = strtolower($this->username);
        $user = Users::model()->find('LOWER(user_name)=?', array($username));
        if ($user === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
            Logger::error('User failed to log in: Username invalid (user\'s IP: ' . Logger::UserIP() . ')');
        } else if (Security::hash($this->password) != $user->user_pass) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
            Logger::error('User failed to log in: Password invalid (user\'s IP: ' . Logger::UserIP() . ', attempted login to ' . $this->username . ')');
        } else {
            $this->_id = $user->id;
            self::$_allowed == $user->user_acti;
            $this->setState('username', $user->user_name);
            $this->setState('suspended', $user->user_acti);
            $this->errorCode = self::ERROR_NONE;
        }
        return $this->errorCode == self::ERROR_NONE;
    }

    public function getId() {
        return $this->_id;
    }

}