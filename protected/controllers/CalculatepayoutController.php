<?php

class CalculatepayoutController extends Controller {

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
                'actions' => array('index', 'view', 'getinvoicedata', 'paynow', 'print'),
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

    public function actionPrint() {
        $this->active_menu = "cps";
        $this->open_class = "invoice";
        $this->active_class = "admin";
        $model = Calculatepayout::model()->findByPk(Yii::app()->request->getParam('id'));
        $list = Voucher::model()->findByAttributes(array("calculate_payout_id" => $model->id));
        $this->render('print', array(
            'data' => $model, 'list' => $list
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

    public function actionGetinvoicedata() {
        $invoice_details = Purchaseinvoice::model()->findByPk(Yii::app()->request->getPost('invoice_id'));
        $kataparchy = Kataparchy::model()->findByAttributes(array("purchase_invoice_id" => $invoice_details->id));
        $this->renderPartial('_getcustomer_details', array(
            'invoice_details' => $invoice_details, 'kataparchy' => $kataparchy
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->active_menu = "cps";
        $this->open_class = "invoice";
        $this->active_class = "cpadmin";
        $model = new Calculatepayout;
        $id = $_GET['id'];
        $invoice_details = Purchaseinvoice::model()->findByPk($id);
        $kataparchy = Kataparchy::model()->findByAttributes(array("purchase_invoice_id" => $invoice_details->id));
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Calculatepayout'])) {
            $model->attributes = $_POST['Calculatepayout'];
            $invoice_details = Purchaseinvoice::model()->findByPk($_POST['Calculatepayout']['customer_id']);
            $kataparchy = Kataparchy::model()->findByAttributes(array("purchase_invoice_id" => $invoice_details->id));
            $model->kata_parchy_id = $kataparchy->id;
            $model->rate = $_POST['Calculatepayout']['rate'];
            $model->dated = date('Y-m-d');
            if ($model->save())
                Yii::app()->user->setFlash('success', 'Item Added successfully');
            $this->redirect(array('create', 'id' => $model->customer_id));
        }

        $this->render('create', array(
            'model' => $model, 'id' => $id, 'invoice_details' => $invoice_details, 'kataparchy' => $kataparchy
        ));
    }

    public function actionPaynow() {
        $this->active_menu = "cps";
        $this->open_class = "invoice";
        $this->active_class = "cpadmin";
        $calculate_payout_id = Yii::app()->request->getParam('id');
        $receiver_id = Yii::app()->request->getParam('kata_parchy_id');
        $model = new Voucher;
        $model->payment_date = date('Y-m-d');
        if (isset($_POST['Voucher'])) {
            $model->attributes = $_POST['Voucher'];
            $kataparchy = Kataparchy::model()->findByPk($_POST['Voucher']['receiver_id']);
            $amount = $_POST['Voucher']['amount'];
            if ($_POST['gstin_no'] == "") {
                $model->reverse_percent_rate = $kataparchy->gst_percent;
                $model->reverse_amt = $amount * $kataparchy->gst_percent / 100;
            } else {                
                if ($_POST['place_of_supply'] == 1) {
                    $model->item_tax_type = "IGST";
                    $model->tax_percent_rate = $kataparchy->gst_percent;
                    $model->tax_amt = $amount * $kataparchy->gst_percent / 100;
                } else {
                    $model->item_tax_type = "CGST/SGST";
                    $model->tax_percent_rate = $kataparchy->gst_percent;
                    $model->tax_amt = $amount * $kataparchy->gst_percent / 100;
                }
                $model->reverse_percent_rate = 0.0;
                $model->reverse_amt = 0.0;
            }
            $model->calculate_payout_id = $calculate_payout_id;
            $model->amount = $amount;
            $model->txn_type = 'others';
            $model->created_by = Yii::app()->user->id;
            //print_r($model->attributes);
            //exit();
            $vtype_id = $_POST['Voucher']['voucher_type_id'];
            $vouchers = Voucher::model()->model()->findBySql("select * from voucher where voucher_type_id='$vtype_id' order by id desc limit 1");
            $exist_voucher = explode("/", $vouchers->voucher_no);
            if (empty($exist_voucher[1])) {
                $voucherid = 1001;
            } else {
                $voucherid = $exist_voucher[1] + 1;
            }
            //echo $vtype_id . "/" . $voucherid;
            //print_r($model->attributes);
            //exit();
            if ($model->save()) {
                $model->voucher_no = $vtype_id . "/" . $voucherid;
                $model->save();
                $payout_confirm = Calculatepayout::model()->findByPk($calculate_payout_id);
                Calculatepayout::model()->updateByPk($payout_confirm->id, array("is_paid" => 1));
                $this->redirect(array('admin'));
            }
        }
        $this->render('paynow', array(
            'model' => $model, 'calculate_payout_id' => $calculate_payout_id, 'receiver_type' => 'vendor', 'receiver_id' => $receiver_id, 'voucher_type_id' => 12,
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

        if (isset($_POST['Calculatepayout'])) {
            $model->attributes = $_POST['Calculatepayout'];
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
        // if (Yii::app()->request->isPostRequest) {
        // we only allow deletion via POST request
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        // } else
        //throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Calculatepayout');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->active_menu = "cps";
        $this->open_class = "invoice";
        $this->active_class = "cpadmin";
        $model = new Calculatepayout('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Calculatepayout']))
            $model->attributes = $_GET['Calculatepayout'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Calculatepayout the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Calculatepayout::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Calculatepayout $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'calculatepayout-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
