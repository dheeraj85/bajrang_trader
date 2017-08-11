<?php

class EmployeesalaryController extends Controller {

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
                'actions' => array('create', 'update', 'admin', 'getattendance','getbenefitdetails','generatesalary'),
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
    
    public function actionGeneratesalary() {
        $model = new Employeesalary();
        $model->attributes = $_POST['Employeesalary'];
        $model->dated = date('Y-m-d');
        $model->save();
        $salarysettings=Employeesalarysettings::model()->findByAttributes(array("employee_id" => $model->employee_id));
        $earned_leaves=$salarysettings->earned_leaves-$_POST['earned_leaves'];
        $medical_leaves=$salarysettings->medical_leaves-$_POST['medical_leaves'];
        Employeesalarysettings::model()->updateByPk($salarysettings->id, array("earned_leaves" => $earned_leaves, "medical_leaves" => $medical_leaves));
        if (!empty($model->advance)) {
            $employee = Employee::model()->findByPk($model->employee_id);
            if ($employee->bal_advance > 0) {
                $bal_advance = $employee->bal_advance - $model->advance;
                Employee::model()->updateByPk($employee->id, array("bal_advance" => $bal_advance));
            }
        }
        d21('Employeesalary added by' . Yii::app()->user->getUsername(), "site.login");
    }

    public function actionGetbenefitdetails() {
        $employee_id = Yii::app()->request->getParam('employee_id');
        $salarysettings=Employeesalarysettings::model()->findByAttributes(array("employee_id"=>$employee_id));
        echo CJSON::encode(array('salarysetting' => $salarysettings));
    }
    
    public function actionGetattendance() {
        $employee_id = Yii::app()->request->getParam('employee_id');
        $sal_month = Yii::app()->request->getParam('sal_month');
        $year = Yii::app()->request->getParam('year');
        
        $timestamp = mktime(0, 0, 0, $sal_month, 1, $year);
        $maxday = date("t", $timestamp);
        
        $todate=$year."-".$sal_month."-01";
        $fromdate=$year."-".$sal_month."-".$maxday;
        
        $present_count= Attendance::model()->countBySql("select count(id) from emp_attendance where employee_id=$employee_id and date between '$todate' and '$fromdate' and attendance='present'");
        $absent_count= Attendance::model()->countBySql("select count(id) from emp_attendance where employee_id=$employee_id and date between '$todate' and '$fromdate' and attendance='absent'");   
        $earned_leave= Attendance::model()->countBySql("select count(id) from emp_attendance where employee_id=$employee_id and date between '$todate' and '$fromdate' and attendance='earned leave'");   
        $medical_leave= Attendance::model()->countBySql("select count(id) from emp_attendance where employee_id=$employee_id and date between '$todate' and '$fromdate' and attendance='medical leave'"); 
        $leave=$earned_leave+$medical_leave;
        echo CJSON::encode(array('present_count' => $present_count,'absent_count'=>$absent_count,'leave'=>$leave));
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
        $this->active_class = "saadmin";
        $model = new Employeesalary;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Employeesalary'])) {
            $model->attributes = $_POST['Employeesalary'];
            if ($model->save()) {
                d21('Employee Salary added by ' . Yii::app()->user->getUsername(), "site.login");
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
        $this->active_menu = "hr";
        $this->open_class = "hrm";
        $this->active_class = "saadmin";
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Employeesalary'])) {
            $model->attributes = $_POST['Employeesalary'];
            if ($model->save()) {
                d21('Employee Salary Updated by ' . Yii::app()->user->getUsername(), "site.login");
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
        //if (Yii::app()->request->isPostRequest) {
        // we only allow deletion via POST request
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        //} else
        //    throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Employeesalary');
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
        $this->active_class = "saadmin";
        $model = new Employeesalary('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Employeesalary']))
            $model->attributes = $_GET['Employeesalary'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Employeesalary the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Employeesalary::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Employeesalary $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'employeesalary-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
