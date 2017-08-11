<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {
private $_id;

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        $users = array(
            // username => password
            'user1' => 'user1',
            'admin' => 'admin',
        );
        if (!isset($users[$this->username]))
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        elseif ($users[$this->username] !== $this->password)
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else
            $this->errorCode = self::ERROR_NONE;
        return !$this->errorCode;
    }
    
     public function fauthenticate() {
        $this->errorCode = "Invalid Mobile No. and Password or your account is blocked by admin";
        $user = Users::model()->fauthenticate($this->username, $this->password);

        if (isset($user)) {
            $this->logInUser($user);
        }else{
            return $this->errorCode;
        }        
    }

      protected function logInUser($user) {
        if ($user) {
            $this->_id = $user->id;
            $this->errorCode = self::ERROR_NONE;
            $this->setAccount($user->role);
        }
    }

 public function setAccount($account) {
        $this->setState('account', $account);
    }

    public function getAccount($account) {
        $this->getState('account');
    }

    public function getId() {
        return $this->_id;
    }

    public static function impersonate($userId) {
        $ui = null;
        $user = Users::model()->findByPk($userId);

        if ($user) {
            $ui = new UserIdentity($user->username, "");
            $ui->logInUser($user);
        }
        return $ui;
    }

}
