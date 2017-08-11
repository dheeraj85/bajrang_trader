<?php

class KataparchyController extends Controller {

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
                'actions' => array('index', 'view', 'getinvoicedata', 'itemdelete', 'getitemdata',
                    'edititem','print'),
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

    public function actionEdititem() {
        $model1 = Kataparchy::model()->findByPk(Yii::app()->request->getPost('kata_parchy_id'));
        if (!empty($model1)) {
            $model1->grn_no = $_POST['Kataparchy']['grn_no'];
            $model1->load_weight = $_POST['Kataparchy']['load_weight'];
            $model1->net_weight = $_POST['Kataparchy']['net_weight'];
            $model1->vendor_name = $_POST['Kataparchy']['vendor_name'];
            $model1->save();
            d21('Kataparchy Item Edit by ' . Yii::app()->user->getUsername(), "site.login");
        }
    }

    public function actionPrint() {
        $this->active_menu = "cps";
        $this->open_class = "invoice";
        $this->active_class = "admin";
        $model = Purchaseinvoice::model()->findByPk(Yii::app()->request->getParam('id'));
        $list = Kataparchy::model()->findByAttributes(array("purchase_invoice_id" => $model->id));
        $this->render('print', array(
            'data' => $model, 'list' => $list
        ));
    }

    public function actionGetinvoicedata() {
        $id = Yii::app()->request->getPost('invoice_id');
        $this->renderPartial('_addpartial', array(
            'id' => $id,
        ));
    }

    public function actionItemdelete() {
        Kataparchy::model()->findByPk(Yii::app()->request->getPost('id'))->delete();
    }

    public function actionGetitemdata() {
        $model = Kataparchy::model()->findByPk(Yii::app()->request->getParam('id'));
        $challan_details = Challan::model()->findByAttributes(array("purchase_invoice_id" => $model->purchase_invoice_id));
        echo CJSON::encode(array('model' => $model, 'items' => $challan_details));
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
        $this->active_menu = "cps";
        $this->open_class = "invoice";
        $this->active_class = "admin";
        $model = new Kataparchy;
        $id = Yii::app()->request->getParam('id');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Kataparchy'])) {
            $items = Purchaseitem::model()->findByPk($_POST['Kataparchy']['item_id']);
            $model->attributes = $_POST['Kataparchy'];
            $model->grn_no = $_POST['Kataparchy']['grn_no'];
            $model->purchase_invoice_id = $_POST['id'];
            $model->challan_id = $_POST['challan_id'];
            $model->order_no = $_POST['Kataparchy']['order_no'];
            $model->item_code = $items->brand;
            $model->gst_code_type=$items->gst_code_type;
            $model->gst_code=$items->gst_code;
            $model->item_name = $items->itemname;
            $model->gst_percent=$items->gst_percent;
            $model->vendor_name = $_POST['Kataparchy']['vendor_name'];
            $date=$_POST['Kataparchy']['kata_parchi_date'];
              $model->kata_parchi_date = date('Y-m-d', strtotime($date));
            if ($model->save())
                Yii::app()->user->setFlash('success', 'Item Added successfully');
            $this->redirect(array('create', 'id' => $_POST['id']));
        }

        $this->render('create', array(
            'model' => $model, 'id' => $id,
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

        if (isset($_POST['Kataparchy'])) {
            $model->attributes = $_POST['Kataparchy'];
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
        $dataProvider = new CActiveDataProvider('Kataparchy');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Kataparchy('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Kataparchy']))
            $model->attributes = $_GET['Kataparchy'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Kataparchy the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Kataparchy::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Kataparchy $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'kataparchy-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
