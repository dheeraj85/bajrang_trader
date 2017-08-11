<?php

class ExpensemasterController extends Controller {

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
                'actions' => array('index', 'view', 'admin'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
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
        $this->active_menu = "exps";
        $this->open_class = "exps";
        $this->active_class = "expcreate";
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->active_menu = "exps";
        $this->open_class = "exps";
        $this->active_class = "expcreate";
        $model = new Expensemaster;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Expensemaster'])) {
            $model->attributes = $_POST['Expensemaster'];
            $model->expense_heads_id=$_POST['Expensemaster']['expense_heads_id'];
            $model->created_by = Yii::app()->user->id;
            $model->created_date = date('Y-m-d');
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Expense Master Added successfully');
                d21('Expense Master ' . $model->gs_name . ' added by ' . Yii::app()->user->getUsername(), "site.login");
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
        $this->active_menu = "exps";
        $this->open_class = "exps";
        $this->active_class = "expcreate";
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Expensemaster'])) {
            $model->attributes = $_POST['Expensemaster'];
            $model->expense_heads_id=$_POST['Expensemaster']['expense_heads_id'];
            $model->created_by = Yii::app()->user->id;
            $model->created_date = date('Y-m-d');
            if ($model->save()) {
                d21('Expense Master updated by ' . Yii::app()->user->getUsername(), "site.login");
                $this->redirect(array('admin'));
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
        //  if (Yii::app()->request->isPostRequest) {
        // we only allow deletion via POST request
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        //} else
        // throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Expensemaster');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->active_menu = "exps";
        $this->open_class = "exps";
        $this->active_class = "expcreate";
        $model = new Expensemaster('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Expensemaster']))
            $model->attributes = $_GET['Expensemaster'];
        d21('Purchase Item viewed by ' . Yii::app()->user->getUsername(), "site.login");

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Expensemaster the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Expensemaster::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Expensemaster $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'expensemaster-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
