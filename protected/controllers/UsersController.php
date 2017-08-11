<?php

class UsersController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $active_menu = '';
    public $active_class = '';
    public $open_class = '';
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
                //'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array(''),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'index', 'approval','assignroles','getrole','proceed','rightsByid','saveByAjax','deleteByAjax','delete'),
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

       public function actionRightsByid() {
        $userid = $_SESSION['userid'];
        $model = new Userrights();
        $model = Userrights::model()->findAllByAttributes(array('user_id' => $userid));
        echo CJSON::encode($model);
        Yii::app()->end();
    }

     public function actionSaveByAjax() {
        $model = new Userrights();
        $model->user_id = $_SESSION['userid'];
        $model->link_name = $_GET['linkname'];
        $model->link_url =$_GET['linkurl'];
        $model->heading = $_GET['heading'];
        $model->subheading = $_GET['subheading'];
        $model->action = $_GET['action'];
        $model->isactive= 1;
        $model->save();
        $msg = "Record Saved";
        echo CJSON::encode(array('msg' => $msg));
    }
    
     public function actionDeleteByAjax() {
        $model = new Userrights();
        $model->user_id = $_SESSION['userid'];
        $model->link_name = $_GET['linkname'];
        $model = Userrights::model()->findByAttributes(array('user_id' => $model->user_id, 'link_name' => $model->link_name));
        $model->delete();
        $uid = $_SESSION['userid'];
        $model = Userrights::model()->findAllByAttributes(array('user_id' => $uid));
        echo CJSON::encode($model);
    }
     public function actionProceed() {
        $model = Yii::app()->request->getPost('user_id');
        $this->renderPartial('_result', array(
            'model' => $model,
        ));
    }

    public function actionGetrole() {
        $id = $_GET['ctid'];
        $_SESSION['userid']=$id;
        $roles = Users::model()->findByPk($id);
        echo strtoupper($roles->role);
    }
    
     public function actionAssignroles() {
        $this->active_menu = "ums";
        $this->open_class = "users";
        $this->active_class = "assign";
        $model = new Userrights();
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Userrights'])) {
            if (!empty($_POST['link'])) {
                $c = 1;
                //   foreach ($_POST['user_id'] as $user) {
                //$count = 1;
                foreach ($_POST['link'] as $value) {
                    $model1 = new Userrights;
                    $model1->user_id = $_SESSION['userid'];
                    $model1->link_name = $_POST[$value . 'link_name'];
                    $model1->link_url = $_POST[$value . 'link_url'];
                    $model1->heading=$_POST[$value . 'link_heading'];
                    $model1->insert();
                    //$count ++;
                }
                $c++;
                // }
            }
            Yii::app()->user->setFlash('usersright', "Your Modules has been Alloted!");
            $this->redirect(array('assignroles'));
        }

        $this->render('assignroles', array(
            'model' => $model,
        ));
    }
    
    public function actionApproval() {
        $id = $_GET['id'];
        $active = $_GET['active'];
        $model = Users::model()->findByPk($id);
        $model->is_active = $active;
        $model->save();
        $admin = new CActiveDataProvider('Users');
        $this->redirect(array('admin'), array('model' => $admin));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Users;
        $this->active_menu = "ums";
        $this->open_class = "users";
        $this->active_class = "create";
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Users'])) {
            $model->attributes = $_POST['Users'];
            $model->password = $_POST['Users']['password'];
            $model->password_hash = md5($_POST['Users']['password']);
            $model->auth_password = $_POST['Users']['auth_password'];
            $model->is_active = 1;
            if ($model->save()){
                Yii::app()->user->setFlash('user', 'User Added successfully');
            $this->redirect(array('create'));
            }
        }
        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $this->active_menu = "ums";
        $this->open_class = "users";
        $this->active_class = "create";
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Users'])) {
            $model->attributes = $_POST['Users'];
            $model->password = $_POST['Users']['password'];
            $model->password_hash = md5($_POST['Users']['password']);
            $model->auth_password = $_POST['Users']['auth_password'];
            if ($model->save())
                $this->redirect(array('admin'));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
//         if (Yii::app()->request->isPostRequest) {
        // we only allow deletion via POST request
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
//         } else
//         throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Users');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->active_menu = "ums";
        $this->open_class = "users";
        $this->active_class = "admin";
        $model = new Users('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Users']))
            $model->attributes = $_GET['Users'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Users the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Users::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Users $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
