<?php

class ExpenseinfoController extends Controller {

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
                'actions' => array('create', 'update', 'admin', 'reconcileitem', 'delete', 'review', 'authreview',
                    'getsecuritypwd', 'natureupdate'),
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

    public function actionAuthreview() {
        $id = Yii::app()->request->getParam('id');
        $this->renderPartial('_authreview', array('id' => $id));
    }

    public function actionGetsecuritypwd() {
        Yii::app()->session['security'] = Yii::app()->request->getPost('valid_data');
        Yii::app()->session['authorize'] = Yii::app()->user->id;
        $model = Users::model()->findByAttributes(array("auth_password" => Yii::app()->request->getPost('authpwd'), "id" => Yii::app()->user->id));
        if (!empty($model)) {
            echo "1";
        } else {
            echo "Invalid Security Password !! Please try again.";
        }
    }

    public function actionReview() {
        $this->active_menu = "exps";
        $this->open_class = "exps";
        $this->active_class = "exinfo";
        $model = Expenseinfo::model()->findByPk(Yii::app()->request->getParam('id'));
        $this->render('review', array(
            'model' => $model, 'id' => Yii::app()->request->getParam('id')
        ));
    }

    public function actionNatureupdate() {
        $id = Yii::app()->request->getPost('id');
        if (Yii::app()->request->getPost('generateorder')) {
            $reg_no = $_POST['Expenseinfo']['reg_no'];
            $particular = $_POST['Expenseinfo']['particular'];
            $nature_id = $_POST['Expenseinfo']['expense_nature_id'];
            Expenseinfo::model()->updateByPk($id, array("reg_no"=>$reg_no,"particular"=>$particular,"expense_nature_id" => $nature_id, "updated_by" => Yii::app()->user->id));
            d21('Expense Nature updated by ' . Yii::app()->user->getUsername(), "site.login");
            $this->redirect(array('expenseinfo/admin'));
        }
        $this->render('itemevaluate');
    }

//    public function actionReconcileitem() {
//        $model = new Expenseinfo();
//        $model->attributes = $_POST['Expenseinfo'];
//        $model->expense_head_id = $_POST['expense_head_id'];
//        $model->name = $_POST['expensehead_name'];
//        $model->reg_no = $_POST['reg_no'];
//        $model->particular = $_POST['particular'];
//        $model->voucher_no = $_POST['voucher_no'];
//        $model->amount = $_POST['amount'];
//        $model->voucher_date = $_POST['dated'];
//        $model->created_by = Yii::app()->user->id;
//        $model->save();
//        d21('Expense Voucher Reconciliation by' . Yii::app()->user->getUsername(), "site.login");
//    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->active_menu = "exps";
        $this->open_class = "exps";
        $this->active_class = "exinfo";
        $model = new Expenseinfo;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Expenseinfo'])) {
            $model->attributes = $_POST['Expenseinfo'];
            if (isset($_POST['evaluate'])) {
                $model->expense_head_id = $_POST['expense_head_id'];
                $model->name = $_POST['expensehead_name'];
                $model->reg_no = $_POST['reg_no'];
                $model->particular = $_POST['particular'];
                $model->voucher_no = $_POST['Expenseinfo']['voucher_no'];
                $model->amount = $_POST['amount'];
                $model->voucher_date = $_POST['dated'];
                $model->created_by = Yii::app()->user->id;
                $model->save();
                d21('Expense Voucher Reconciliation by' . Yii::app()->user->getUsername(), "site.login");
                $this->redirect(array('admin'));
            }
            //Yii::app()->user->setFlash('success', "Expense Voucher Entry for Reconciliation Added Successfully");
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
        $this->active_class = "exinfo";
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Expenseinfo'])) {
            $model->attributes = $_POST['Expenseinfo'];
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
        //if (Yii::app()->request->isPostRequest) {
        // we only allow deletion via POST request
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        //} else
        //   throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Expenseinfo');
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
        $this->active_class = "exinfo";
        $model = new Expenseinfo('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Expenseinfo']))
            $model->attributes = $_GET['Expenseinfo'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Expenseinfo the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Expenseinfo::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Expenseinfo $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'expenseinfo-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
