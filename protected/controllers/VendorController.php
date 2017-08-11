<?php

class VendorController extends Controller {

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
                'actions' => array('create', 'update', 'admin', 'invoice', 'index', 'ledger', 'getinvoicedata','polist','paypartyinvoice','addvoucheritem',
                    'getpayinvoicedata', 'payinvoice', 'searchinvoice', 'paymenthistory', 'historyprint', 'historyview','payinvoice','getinvoice'),
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
    public function actionGetinvoice() {
        $receiver_id = Yii::app()->request->getParam('voucher_receiver_id');
        $voucher_id = Yii::app()->request->getParam('voucher_id');
        $date = Yii::app()->request->getParam('date');
        if (!empty($voucher_id)) {
            $voucherid = $voucher_id;
        } else {
            $voucherid = 0;
        }
        if ($receiver_id == "1") {
            $list = Purchaseinvoice::model()->findAllBySql("select * from purchase_invoice where invoice_date <='$date' and total_amount!=0.00 and invoice_type='cash' and is_reviewed=1 order by id desc");
        } else {
            $list = Purchaseinvoice::model()->findAllBySql("select * from purchase_invoice where invoice_date <='$date' and total_amount!=0.00 and vendor_id=$receiver_id and is_reviewed=1 order by id desc");
        }
        $this->renderPartial('_invoicelist', array(
            'list' => $list, 'receiver_id' => $receiver_id, 'voucherid' => $voucherid,'date'=>$date,
        ));
    }
     public function actionPaypartyinvoice() {
        $this->active_menu = "ex";
        $this->open_class = "exp";
        $this->active_class = "vadmin";
        $id = Yii::app()->request->getParam('id');
        $receiver_type = Yii::app()->request->getParam('receiver_type');
        $receiver_id = Yii::app()->request->getParam('receiver_id');
        $voucher_type_id = Yii::app()->request->getParam('voucher_type_id');
        $date = Yii::app()->request->getParam('date');
        $invoice_id=Yii::app()->request->getParam('invoice_id');
        
        $model = new Voucher;
        if (!empty($_GET['closing_amt'])) {
            $model->amount = $_GET['closing_amt'];
        }
        $model->payment_date = date('Y-m-d');
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Voucher'])) {
            $model->attributes = $_POST['Voucher'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('paypartyinvoice', array(
            'model' => $model, 'id' => $id, 'receiver_type' => $receiver_type, 'receiver_id' => $receiver_id,'voucher_type_id'=>$voucher_type_id,'date'=>$date,'invoice_id'=>$invoice_id,
        ));
    }
    
     public function actionAddvoucheritem() {
        $voucherid = "";
        $trans_type = "";
        if ($_POST['Voucher']['voucher_type_id'] == 1) {
            $trans_type = "others";
        } elseif ($_POST['Voucher']['voucher_type_id'] == 2) {
            $trans_type = "others";
        } elseif ($_POST['Voucher']['voucher_type_id'] == 3) {
            $trans_type = "advance";
        } elseif ($_POST['Voucher']['voucher_type_id'] == 4) {
            $trans_type = "loan";
        } else {
            $trans_type = "others";
        }
        $vtype_id = $_POST['Voucher']['voucher_type_id'];
        $vouchers = Voucher::model()->model()->findBySql("select * from voucher where voucher_type_id='$vtype_id' order by id desc limit 1");
        $exist_voucher = explode("/", $vouchers->voucher_no);
        if (empty($exist_voucher[1])) {
            $voucherid = 1001;
        } else {
            $voucherid = $exist_voucher[1] + 1;
        }

        $model = new Voucher();
        $model->attributes = $_POST['Voucher'];
        $model->txn_type = $trans_type;
        $model->amount = str_replace("-", "", $_POST['Voucher']['amount']);
        $model->created_by = Yii::app()->user->id;
        $model->counter_id = $_POST['Voucher']['counter_id'];
        $model->save();
        $model->voucher_no = $vtype_id . "/" . $voucherid;
        $model->save();

        if ($model->payment_receiver_type == "vendor") {
            if (!empty($_POST['invoice_id'])) {
                foreach ($_POST['invoice_id'] as $k=>$v) {
                    $cmodel = Purchaseinvoice::model()->findByPk($v);
                    $ipay_model = new Invoicepay();
                    $ipay_model->invoice_id = $cmodel->id;
                    $ipay_model->amount = Yii::app()->request->getPost('paid_' . $v);
                    $ipay_model->dated = $model->dated;
                    $ipay_model->voucher_no = $model->voucher_no;
                    $ipay_model->save();
                }
            }
            $vendoraccount = Vendor::model()->findByPk($model->receiver_id);
            if ($vendoraccount->vendor_bal == 0.00) {
                $vendoraccount->vendor_bal = $_POST['Voucher']['amount'];
                $vendoraccount->save();
            } elseif ($_POST['Voucher']['voucher_type_id'] == 2) {
                $vendoraccount->vendor_bal = $vendoraccount->vendor_bal - $_POST['Voucher']['amount'];
                $vendoraccount->save();
            } else {
                $vendoraccount->vendor_bal = $vendoraccount->vendor_bal - $_POST['Voucher']['amount'];
                $vendoraccount->save();
            }
        }
        d21('Voucher added by' . Yii::app()->user->getUsername(), "site.login");
    }

    public function actionHistoryprint() {
        $this->active_menu = "cps";
        $this->open_class = "vendor";
        $this->active_class = "admin";
        $model = Voucher::model()->findByPk(Yii::app()->request->getParam('id'));
        $this->render('historyprint', array(
            'model' => $model,'id'=>$model->receiver_id,
        ));
    }
    public function actionPolist() {
        $this->active_menu = "cps";
        $this->open_class = "vendor";
        $this->active_class = "ledger";
        $id=$_GET['id'];
        $model = new Purchaseorder('searchvendorpo');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Purchaseorder']))
        $model->attributes = $_GET['Purchaseorder'];
        $this->render('polist', array(
            'model' => $model,'id'=>$id,
        ));
    }

    public function actionHistoryview($id) {
        $this->active_menu = "cps";
        $this->open_class = "vendor";
        $this->active_class = "admin";
        $list=Voucher::model()->findByPk($id);
        $this->render('historyview', array(
            'model' => $list,'id'=>$list->receiver_id,
        ));
    }
    
    public function actionPaymenthistory() {
        $this->active_menu = "cps";
        $this->open_class = "vendor";
        $this->active_class = "admin";
        $model = new Voucher('history');
        $vendorid = Yii::app()->request->getParam('id');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Voucher']))
            $model->attributes = $_GET['Voucher'];

        $this->render('paymenthistory', array(
            'model' => $model, 'vendorid' => $vendorid,
        ));
    }
    
    public function actionGetinvoicedata() {
        $list = Purchaseinvoice::model()->findByAttributes(array('id' => $_GET['invoice_id']));
        $this->renderPartial('_getinvoicedata', array(
            'list' => $list,
        ));
    }
    public function actionSearchinvoice() {
        $vendor_id = $_POST['vendor_id'];
        $this->renderPartial('_searchinvoice', array(
            'vendor_id' => $vendor_id,'todate'=>$_POST['to_dated'],
        ));
    }
    public function actionGetpayinvoicedata() {
        $criteria = new CDbCriteria;
        $criteria->order="id desc";
        $list = Invoicepay::model()->findAllByAttributes(array('invoice_id' => $_GET['invoice_id']),$criteria);
        $this->renderPartial('_getpayinvoicedata', array(
            'list' => $list,
        ));
    }

    public function actionPayinvoice() {
        $cinvoice = Purchaseinvoice::model()->findByPk($_POST['invoice_id']);
        if (!empty($cinvoice)) {
            $model = new Invoicepay();
            $model->invoice_id = $_POST['invoice_id'];
            $model->voucher_no = $_POST['Invoicepay']['voucher_no'];
            $model->dated = $_POST['dated'];
            $model->amount = $_POST['Invoicepay']['amount'];
            $model->save();
            d21('Invoice Bill Payed by ' . Yii::app()->user->getUsername(), "site.login");
        }
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
        $this->open_class = "vendor";
        $this->active_class = "create";
        $model = new Vendor;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Vendor'])) {
            $model->attributes = $_POST['Vendor'];
            $model->created_by = Yii::app()->user->id;
            $model->created_date = date('Y-m-d');
            $model->is_active = 1;
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Vendor Added successfully');
                d21('Vendor added by ' . Yii::app()->user->getUsername(), "site.login");
                $this->redirect(array('create'));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionLedger() {
        $this->active_menu = "cps";
        $this->open_class = "vendor";
        $this->active_class = "ledger";
        $list="";
        $model = new Purchaseinvoice;
        if (isset($_POST['Purchaseinvoice'])) {
            $model->attributes = $_POST['Purchaseinvoice'];
            $list = Vendor::model()->findByPk($_POST['Purchaseinvoice']['vendor_id']);
        }
        $this->render('ledger', array(
            'model' => $model, 'list' => $list,
        ));
    }

    public function actionInvoice() {
        $this->active_menu = "cps";
        $this->open_class = "vendor";
        $this->active_class = "invoice";
        $model = new Vendoritemsupply;
        $this->render('invoice', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $this->active_menu = "cps";
        $this->open_class = "vendor";
        $this->active_class = "admin";
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Vendor'])) {
            $model->attributes = $_POST['Vendor'];
            if ($model->save())
                d21('Vendor updated by ' . Yii::app()->user->getUsername(), "site.login");
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
        // if (Yii::app()->request->isPostRequest) {
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
        $this->active_menu = "cps";
        $this->open_class = "vendor";
        $this->active_class = "vindex";
        $this->render('index');
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->active_menu = "cps";
        $this->open_class = "vendor";
        $this->active_class = "admin";
        $model = new Vendor('search');
        $model->unsetAttributes();  // clear any default values
          if (isset($_GET['Vendor']))
         $model->attributes = $_GET['Vendor'];
        d21('Vendor viewed by ' . Yii::app()->user->getUsername(), "site.login");
        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Vendor the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Vendor::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Vendor $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'vendor-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
