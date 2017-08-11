<?php

class EmployeeattController extends Controller {

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
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update','getnext','getsheet','getchange','puthalf','gethalf', 'attendancereport', 'getreport', 'getExcelReport'),
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

    public function actionGetnext() {
        $dated = $_GET['dated'];
        $model = new Attendance;
        $this->renderPartial('_allstaff', array(
            'model' => $model, 'dated' => $dated
        ));
    }

    public function actionGetchange() {
        $dated = $_GET['dated'];
        $month = date('m', strtotime($dated));
        $year = date('Y', strtotime($dated));
        $history = Attendance::model()->findAllBySql("select * from emp_attendance where MONTH(date)=$month AND YEAR(date)=$year group by employee_id");
    }

    public function actionGethalf() {
        $dated = $_GET['dated'];
        $model = Attendance::model()->findAllBySql("select * from emp_attendance where half_day=1 and date='$dated' order by date desc");
        $this->renderPartial('_allstaffhalfnew', array(
            'model' => $model, 'dated' => $dated
        ));
    }

    public function actionPuthalf() {
        $dated = $_GET['dated'];
        $model = new Attendance;
        if (!empty($_POST['check'])) {
            foreach ($_POST['check'] as $value) {
                if (!empty($value)) {
                    $uatt = Attendance::model()->findByPk($value);
                    $uatt->out_time = $_POST[$value . 'attendance']['out_time'];
                    $uatt->half_day = 1;
                    $uatt->save();
                }
            }
            Yii::app()->user->setFlash('successhalf', 'Halfday added successfully');
            $this->redirect(array('create'));
        }
        $this->renderPartial('_allstaffhalf', array(
            'model' => $model, 'dated' => $dated
        ));
    }

    public function actionGetsheet() {
        $dated = $_GET['dated'];
        $model = new Attendance;
        $this->renderPartial('_monthsheet', array(
            'model' => $model, 'dated' => $dated
        ));
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
        $this->active_menu = "hr";
        $this->open_class = "hrm";
        $this->active_class = "attcreate";
        $model = new Attendance;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (!empty($_POST['Attendance']['date'])) {
            $model1 = Employee::model()->findAll();
            $model->attributes = $_POST['Attendance'];
            foreach ($model1 as $md1) {
                $model = new Attendance;
                $model->employee_id = $md1->id;
                $teacher = 'attendance' . $md1->id;
                $model->attendance = $_POST['Attendance'][$teacher];
                $model->date = $_POST['Attendance']['date'];
                if (!empty($model->attendance)) {
                    $history = Attendance::model()->findByAttributes(array('employee_id' => $model->employee_id,'date'=>$_POST['Attendance']['date']));
                    if (!empty($history)) {
                        $history->attendance = $model->attendance;
                        $history->save();
                        Yii::app()->user->setFlash('successatt', 'Atttendance added successfully');
                    } else {
                        Yii::app()->user->setFlash('successatt', 'Attendance updated successfully');
                        $model->save();                        
                    }
                }
            }
            $this->redirect(array('create'));
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
        $this->active_menu = "hr";
        $this->open_class = "hrm";
        $this->active_class = "create";
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Attendance'])) {
            $model->attributes = $_POST['Attendance'];
            if ($model->save()) {
                $this->redirect(array('create'));
            }
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
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Attendance');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->active_menu = "hr";
        $this->open_class = "hrm";
        $this->active_class = "create";
        $model = new Attendance('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Attendance']))
            $model->attributes = $_GET['Attendance'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Attendance the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Attendance::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Attendance $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'employeeatt-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
