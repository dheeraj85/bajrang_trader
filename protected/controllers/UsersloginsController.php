<?php

class UsersloginsController extends Controller {

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
                // 'postOnly + delete', // we only allow deletion via POST request
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
                'actions' => array('create', 'update', 'admin','viewlogs'),
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
        $model = new Userslogins;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Userslogins'])) {
            $model->attributes = $_POST['Userslogins'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
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

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Userslogins'])) {
            $model->attributes = $_POST['Userslogins'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
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
        $dataProvider = new CActiveDataProvider('Userslogins');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionViewlogs() {
        $this->active_menu = "ums";
        $this->open_class = "users";
        $this->active_class = "logapp";
        $this->render('viewlogs');
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->active_menu = "ums";
        $this->open_class = "users";
        $this->active_class = "logadmin";
        $filter_date_start = "";
        $filter_date_end = "";
        $model = new Userslogins('search');

        if (isset($_GET['filter_date_start'])) {
            $filter_date_start = $_GET['filter_date_start'];
        }

        if (isset($_GET['filter_date_end'])) {
            $filter_date_end = $_GET['filter_date_end'];
        }

        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Userslogins']))
            $model->attributes = $_GET['Userslogins'];

        $this->render('admin', array(
            'model' => $model, 'filter_date_start' => $filter_date_start, 'filter_date_end' => $filter_date_end,
        ));
    }

    public function actionAdmin2() {
        $this->open_class = "users";
        $this->active_class = "logadmin";

        if (isset($_POST['filter_date_start'])) {
            $filter_date_start = $_POST['filter_date_start'];
        } else {
            $filter_date_start = date('Y-m-d', strtotime(date('Y') . '-' . date('m') . '-01'));
        }

        if (isset($_POST['filter_date_end'])) {
            $filter_date_end = $_POST['filter_date_end'];
        } else {
            $filter_date_end = date('Y-m-d');
        }

        if (isset($_POST['filter_name'])) {
            $name = $_POST['filter_name'];
        } else {
            $name = '';
        }

        if (isset($_POST['filter_date'])) {
            $url .= '&filter_date=' . $_POST['filter_date'];
        }

        if (isset($_POST['filter_name'])) {
            $url .= '&filter_name=' . $_POST['filter_name'];
        }

        $report = new Reports;

        $data['loglist'] = array();

        $filter_data = array(
            'filter_date_start' => $filter_date_start,
            'filter_date_end' => $filter_date_end,
            'filter_name' => $name,
            // 'filter_order_status_id' => $filter_order_status_id,
            'start' => ($page - 1) * 5,
            'limit' => 5
        );

        $results = $report->getloglist($filter_data);
        if (!empty($results)) {
            foreach ($results as $result) {
                $data['loglist'][] = array(
                    //'date_start' => date('d/m/Y', strtotime($result['dated'])),
                    //'date_end' => date('d/m/Y', strtotime($result['date_end'])),
                    //'dated' => $result['dated'],
                    'username' => $result['name'],
                    'log_type' => $result['log_type'],
                    'in_out' => $result['in_out']
                );
            }
        } else {
            $data['text_no_results'] = 'No Result Found';
        }
        if (isset($_POST['filter_date_start'])) {
            $url .= '&filter_date_start=' . $_POST['filter_date_start'];
        }

        if (isset($_POST['filter_date_end'])) {
            $url .= '&filter_date_end=' . $_POST['filter_date_end'];
        }
        $data['results'] = $data['text_no_results'];
        $data['filter_date_start'] = $filter_date_start;
        $data['filter_date_end'] = $filter_date_end;
        $data['filter_name'] = $name;

        $this->render('admin', array(
            'data' => $data,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Userslogins the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Userslogins::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Userslogins $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'userslogins-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
