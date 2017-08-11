<?php

// this file must be stored in:
// protected/components/WebUser.php

class WebUser extends CWebUser {

    // Store model to not repeat query.
    private $_model;
    private $_account;

    // Load user model.
    protected function loadUser($id = null) {
        if ($this->_model === null) {
            if ($id !== null) {
                $this->_model = Users::model()->findByPk($id);
                if (!is_null($this->_model)) {
                    $this->_account = $this->_model->role;
                }
            }
        }
        return $this->_model;
    }

    public function getUser() {
        return $this->loadUser(Yii::app()->user->id);
    }

    public function isAdmin() {
        $user = $this->loadUser(Yii::app()->user->id);
        return isset($user) && $user->role == 'admin';
    }

    public function isCPS() {
        $user = $this->loadUser(Yii::app()->user->id);
        return isset($user) && $user->role == 'cps';
    }

    public function isCDS() {
        $user = $this->loadUser(Yii::app()->user->id);
        return isset($user) && $user->role == 'cds';
    }
    public function isPOS() {
        $user = $this->loadUser(Yii::app()->user->id);
        return isset($user) && $user->role == 'pos';
    }

    public function isKPOS() {
        $user = $this->loadUser(Yii::app()->user->id);
        return isset($user) && $user->role == 'kpos';
    }
    
    public function isGPU() {
        $user = $this->loadUser(Yii::app()->user->id);
        return isset($user) && $user->role == 'gpu';
    }

    public function isOutletManager() {
        $user = $this->loadUser(Yii::app()->user->id);
        return isset($user) && $user->role == 'outlet_mgr';
    }

    public function isTicketManager() {
        $user = $this->loadUser(Yii::app()->user->id);
        return isset($user) && $user->role == 'ticket_mgr';
    }

    public function isSA() {
        $user = $this->loadUser(Yii::app()->user->id);
        return isset($user) && ($user->role == 'sa');
    }

    public function setAccount($ea) {
        $this->_account = $ea;
    }

    public function getAccount() {
        return $this->_account;
    }

    public function getUsername() {
        $user = $this->getUser();
        return isset($user) ? $user->name : '';
    }

    public function getRole() {
        $user = $this->getUser();
        return isset($user) ? $user->role : '';
    }

    public function getEmail() {
        $user = $this->getUser();
        return isset($user) ? $user->email : '';
    }

}

?>