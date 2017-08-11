<?php

class CustomerinternalController extends Controller {

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
//            'postOnly + delete', // we only allow deletion via POST request
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
                'actions' => array('deletedisc', 'updatedisc', 'getdiscount', 'customersale', 'savediscount', 'discount', 'admin', 'delete', 'create', 'update'),
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

    public function actionDeletedisc() {
        $id = $_GET['id'];
        $disc = Customerdiscount::model()->findByPk($id);
        $disc->delete();
    }

    public function actionUpdatedisc() {
        $id = $_GET['id'];
        $disc = Customerdiscount::model()->findByPk($id);
        $disc->discount = $_GET['value'];
        $disc->update();
    }

    public function actionGetdiscount() {
        $id = $_POST['id'];
        $customer = Customer::model()->findByPk($id);
        $this->renderPartial('_discount', array(
            'model' => $customer,
        ));
    }

    public function actionCustomersale() {

        $this->render('customersale');
    }

    public function actionSavediscount() {
        $cid = $_POST['cid'];
        $item_id = $_POST['item_id'];
        $disc = $_POST['disc'];
        $check_discount = Customerdiscount::model()->findByAttributes(array('customer_id' => $cid, 'item_id' => $item_id));
        if (empty($check_discount)) {
            $discount = new Customerdiscount();
            $discount->customer_id = $cid;
            $discount->item_id = $item_id;
            $discount->discount = $disc;
            if ($discount->save()) {
                echo '<h4 class="alert alert-success">Discount has been saved successfully</h4>';
            }
        } else {
            echo '<h4 class="alert alert-danger">Discount has been already saved for this item...!!!</h4>';
        }
    }

    public function actionDiscount($id) {
        $this->active_menu = "customer";
        $this->open_class = "customer";
        $this->active_class = "cust";
        $this->render('discount', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->active_menu = "customer";
        $this->open_class = "customer";
        $this->active_class = "cust";
        $model = new Customer;
       // $model->type = 'internal';

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Customer'])) {
            $model->attributes = $_POST['Customer'];
            $model->regdate = date('Y-m-d');
            $model->balance = 0.00;
            if ($model->save())
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
        $this->active_menu = "customer";
        $this->open_class = "customer";
        $this->active_class = "cust";
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Customer'])) {
            $model->attributes = $_POST['Customer'];
            if ($model->save())
                $this->redirect(array('create'));
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
//		if(Yii::app()->request->isPostRequest)
//		{
        // we only allow deletion via POST request
        $model = $this->loadModel($id);
        if (!empty($model)) {
            foreach (Customerdiscount::model()->findAllByAttributes(array('customer_id' => $model->id)) as $disc) {
                $disc->delete();
            }
            $model->delete();
        }
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('create'));
//		}
//		else
//        throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Customer');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Customer('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Customer']))
            $model->attributes = $_GET['Customer'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Customer the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Customer::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Customer $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'customer-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
