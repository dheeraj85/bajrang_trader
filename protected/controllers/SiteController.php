<?php

class SiteController extends Controller {

    public $active_menu = '';
    public $active_class = '';
    public $open_class = '';

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('login','error'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'dashboard', 'cmsdashboard','gpudashboard','cpsdashboard','cdsdashboard',
                    'logout','unauthorize','ticketmanageradmin','ticketmanagerview','reportdashboard'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */

    public function actionTicketmanageradmin() {
        $type = $_GET['type'];
        $model = new Ticket('searchadmin');
        $model->ticket_type = $type;
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Ticket']))
            $model->attributes = $_GET['Ticket'];
        $model->ticket_type = $type;

        $this->render('ticketmanageradmin', array(
            'model' => $model,
            'type' => $type,
        ));
    }
    
    
    public function actionTicketmanagerview($id) {
        d21(Yii::app()->user->getUsername().' View Ticket Details',"site.login");
        $this->render('ticketmanagerview', array(
            'model' => Ticket::model()->findByPk($id),
        ));
    }
    
    
    public function actionDashboard() {
        $this->layout = 'main';
        $model = new Users();
        $this->render('dashboard', array(
            'model' => $model,
        ));
    }

    public function actionCmsdashboard() {
        $this->layout = 'main';
        $model = new Users();
        $this->render('cmsdashboard', array(
            'model' => $model,
        ));
    }
    public function actionReportdashboard() {
        $this->layout = 'main';
        $this->render('reportdashboard');
    }
    public function actionGpudashboard() {
        $this->layout = 'main';
        $model = new Users();
        $this->render('gpudashboard', array(
            'model' => $model,
        ));
    }
    public function actionCdsdashboard() {
        $this->layout = 'main';
        $model = new Users();
        $this->render('cdsdashboard', array(
            'model' => $model,
        ));
    }
    
    public function actionCpsdashboard() {
        $this->layout = 'main';
        $model = new Users();
        $this->render('cpsdashboard', array(
            'model' => $model,
        ));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }
   
    public function actionUnauthorize() {
         $this->render('unauthorize', $error);
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin1() {
        $this->layout = "login";
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(array('site/index'));
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    public function actionLogin() {
        $this->layout = 'login';
        $model = new LoginForm;
        $model->scenario = 'front';
        $errorCode="";
        if(!empty(Yii::app()->user->id)){
            $this->redirectAfterLogin();
        }
        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            //     print_r($model->attributes);
            // validate user input and redirect to the previous page if valid
            if ($model->flogin()) {
                $this->redirectAfterLogin();
            } else {
                $errorCode = "<div class='alert alert-danger'>Invalid Mobile No. and Password or your account is blocked by admin</div>";
            }
        }
        $smodel = new Users();
        $smodel->unsetAttributes();  // clear any default values
        if (isset($_GET['Users']))
            $smodel->attributes = $_GET['Users'];
        // display the login form
        $this->render('login', array('smodel' => $smodel,'model' => $model, 'err_msg' => $errorCode));
    }

    public function redirectAfterLogin() {
        if (Yii::app()->user->isSA() || Yii::app()->user->isAdmin()){
            $this->loginlogs();
            $this->redirect(array('site/dashboard'));
        } else if (Yii::app()->user->isPOS()){
            $this->redirect(array('pos/authenticate'));
        } else if (Yii::app()->user->isKPOS())
            $this->redirect(array('kitchen/index'));
        else
            $this->redirect(array('site/dashboard'));
    }

    public function loginlogs() {
        $userlogs = New Userslogins();
        $userlogs->user_id = Yii::app()->user->id;
        $userlogs->log_type = "login";
        $userlogs->in_out = date('Y-m-d h:i:s');
        $userlogs->save();
        d21(Yii::app()->user->getUsername().' login',"site.login");
    }
    public function logoutlogs() {
        $userlogs = New Userslogins();
        $userlogs->user_id = Yii::app()->user->id;
        $userlogs->log_type = "logout";
        $userlogs->in_out = date('Y-m-d h:i:s');
        $userlogs->save();
        d21(Yii::app()->user->getUsername().' logout',"site.logout");
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        $this->logoutlogs();
        Yii::app()->user->logout();       
        $this->redirect(array('site/login'));
    }

}
