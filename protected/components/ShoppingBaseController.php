<?php

class ShoppingBaseController extends Controller {

    const LANG_KEY = '_lang';

    function init() {
        parent::init();
        $app = Yii::app();
        if (isset($_GET[self::LANG_KEY])) {
            $app->language = $_GET[self::LANG_KEY];
            $app->session[self::LANG_KEY] = $app->language;
            $cookie = new CHttpCookie(self::LANG_KEY, $app->language);
            Yii::app()->request->cookies[self::LANG_KEY] = $cookie;
        } else if (isset($app->request->cookies[self::LANG_KEY])) {
            $app->language = $app->request->cookies[self::LANG_KEY]->value;
        } else {
            $app->language = Yii::app()->getRequest()->getPreferredLanguage();
        }
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function filters() {
        return array(
            'accessControl',
        );
    }


    public function loadOrCreateUser() {
        $inst = null;

        if (isset($_GET['id']))
            $inst = User::model()->findbyPk($_GET['id']);
        if ($inst === null) {
            $inst = new User;
        }

        return $inst;
    }


    public function getDashboardHomeLink() {
        if (Yii::app()->user->isAdmin()) {
            return CHtml::link(Yii::t('site', 'Dashboard'), array('admin/dashboard'));
        }
        if (Yii::app()->user->isUser()) {
            return CHtml::link(Yii::t('site', 'Dashboard'), array('users/dashboard'));
        }
        return array();
    }

    public function getUserIdentity() {
        $userIdentity = Yii::app()->user->getUsername() . ' (' . Yii::app()->user->getRole() . ')';

        return $userIdentity;
    }
    ////New Funstion added 
    public function getUserEmail() {
        return Yii::app()->user->getEmail();
    }

}
?>