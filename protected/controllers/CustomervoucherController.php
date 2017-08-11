<?php

class CustomervoucherController extends Controller {

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
                //  'postOnly + delete', // we only allow deletion via POST request
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
                'actions' => array('create', 'update', 'admin', 'getreceiverlist', 'addvoucheritem', 'review',
                    'voucherupdate', 'getbalance', 'getloan',
                    'getreceivername', 'getbenefitamount', 'geteditbenefitamount', 'editvoucheritem', 'print',
                    'getvouchertypelist', 'getinvoice', 'getcustomerinvoice', 'getcustomerbalance'),
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

    public function actionGetvouchertypelist() {
        $list = Vouchertype::model()->findAll();
        echo CJSON::encode(array('scat' => $list));
    }

    public function actionPrint() {
        $this->active_menu = "ex";
        $this->open_class = "exp";
        $this->active_class = "vadmin";
        $model = Voucher::model()->findByPk(Yii::app()->request->getParam('id'));
        $this->render('print', array(
            'model' => $model, 'id' => Yii::app()->request->getParam('id')
        ));
    }

    public function actionGetreceivername() {
        $voucher_type_id = Yii::app()->request->getParam('voucher_type_id');
        $vouchertype = Vouchertype::model()->findByPk($voucher_type_id);
        echo $vouchertype->payment_receiver_type;
    }

    public function actionReview() {
        $this->active_menu = "ex";
        $this->open_class = "exp";
        $this->active_class = "vadmin";
        $model = Voucher::model()->findByPk(Yii::app()->request->getParam('id'));
        d21('Voucher review by ' . Yii::app()->user->getUsername(), "site.login");
        $this->render('review', array(
            'model' => $model, 'id' => Yii::app()->request->getParam('id')
        ));
    }

    public function actionVoucherupdate() {
        $id = Yii::app()->request->getPost('id');
        if (Yii::app()->request->getPost('generateorder')) {
            $received_by = Yii::app()->request->getPost('received_by');
            $received_mobileno = Yii::app()->request->getPost('received_mobileno');
            Voucher::model()->updateByPk($id, array("received_by" => $received_by, "received_mobileno" => $received_mobileno, "received_status" => 1));
            d21('Voucher updated by ' . Yii::app()->user->getUsername(), "site.login");
            $this->redirect(array('voucher/admin'));
        }
        $this->render('itemevaluate');
    }

    public function actionGetbenefitamount() {
        $vtype = Yii::app()->request->getParam('vtype');
        if ($vtype == 1) {
            $trans_type = "others";
        } elseif ($vtype == 2) {
            $trans_type = "others";
        } elseif ($vtype == 3) {
            $trans_type = "advance";
        } elseif ($vtype == 4) {
            $trans_type = "loan";
        } else {
            $trans_type = "others";
        }
        $receiver_type = Yii::app()->request->getParam('receiver_type');
        $voucher_receiver_id = Yii::app()->request->getParam('voucher_receiver_id');
        if ($receiver_type == "employee") {
            $employeebenifits = Employeebenifits::model()->findBySql("select * from employee_benifits where txn_type='$trans_type' and employee_id=$voucher_receiver_id and voucher_no is NULL");
            if (!empty($employeebenifits)) {
                echo $employeebenifits->amount;
            }
        } else if ($receiver_type == "vendor") {
            echo "0";
        }
    }

    public function actionGeteditbenefitamount() {
        $vtype = Yii::app()->request->getParam('vtype');
        if ($vtype == 1) {
            $trans_type = "others";
        } elseif ($vtype == 2) {
            $trans_type = "others";
        } elseif ($vtype == 3) {
            $trans_type = "advance";
        } elseif ($vtype == 4) {
            $trans_type = "loan";
        } else {
            $trans_type = "others";
        }
        $voucher_receiver_id = Yii::app()->request->getParam('voucher_receiver_id');
        $checkvoucher = Voucher::model()->findByPk($voucher_receiver_id);
        if (!empty($checkvoucher)) {
            echo $checkvoucher->amount;
        } else {
            echo "0";
        }
    }

    public function actionGetreceiverlist() {
        $pay_rec_type = Yii::app()->request->getParam('pay_rec_type');
        $receiver_id = Yii::app()->request->getParam('receiver_id');
        $this->renderPartial('_reclist', array(
            'pay_rec_type' => $pay_rec_type, 'receiver_id' => $receiver_id,
        ));
    }

    public function actionGetcustomerinvoice() {
        $receiver_id = Yii::app()->request->getParam('voucher_receiver_id');
        $voucher_id = Yii::app()->request->getParam('voucher_id');
        if (!empty($voucher_id)) {
            $voucherid = $voucher_id;
        } else {
            $voucherid = 0;
        }
        if ($receiver_id == "") {
            $list = ShelfSale::model()->findAllBySql("select * from off_shelf_sale where txn_type='customer' order by id desc");
        } else {
            $list = ShelfSale::model()->findAllBySql("select * from off_shelf_sale where customer_id=$receiver_id and txn_type='customer' order by id desc");
        }
        $this->renderPartial('_customer_invoicelist', array(
            'list' => $list, 'receiver_id' => $receiver_id, 'voucherid' => $voucherid,
        ));
    }

    public function actionGetcustomerbalance() {
        $receiver_id = Yii::app()->request->getParam('voucher_receiver_id');
        echo Customer::model()->findByPk($receiver_id)->balance;
    }

    public function actionGetinvoice() {
        $receiver_id = Yii::app()->request->getParam('voucher_receiver_id');
        $voucher_id = Yii::app()->request->getParam('voucher_id');
        if (!empty($voucher_id)) {
            $voucherid = $voucher_id;
        } else {
            $voucherid = 0;
        }
        if ($receiver_id == "1") {
            $list = Purchaseinvoice::model()->findAllBySql("select * from purchase_invoice where invoice_type='cash' and is_reviewed=1 order by id desc");
        } else {
            $list = Purchaseinvoice::model()->findAllBySql("select * from purchase_invoice where vendor_id=$receiver_id and is_reviewed=1 order by id desc");
        }
        $this->renderPartial('_invoicelist', array(
            'list' => $list, 'receiver_id' => $receiver_id, 'voucherid' => $voucherid,
        ));
    }

    public function actionGetbalance() {
        $receiver_id = Yii::app()->request->getParam('voucher_receiver_id');
        echo Vendor::model()->findByPk($receiver_id)->vendor_bal;
    }

    public function actionGetloan() {
        $receiver_id = Yii::app()->request->getParam('voucher_receiver_id');
        echo Employee::model()->findByPk($receiver_id)->bal_loan;
    }

    public function actionAddvoucheritem() {
        $voucherid = "";

        $trans_type = "others";

        $vtype_id = 11;
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
        $model->voucher_type_id =11;
        $model->save();
        $model->voucher_no = $vtype_id . "/" . $voucherid;
        $model->save();
        d21('Voucher added by' . Yii::app()->user->getUsername(), "site.login");
    }

    public function actionEditvoucheritem() {
        $model = Voucher::model()->findByPk($_POST['Voucher']['id']);
        $model->attributes = $_POST['Voucher'];
        $model->amount = str_replace("-", "", $_POST['Voucher']['amount']);
        $model->created_by = Yii::app()->user->id;
        $model->counter_id = $_POST['Voucher']['counter_id'];
        $model->save();

        if ($model->payment_receiver_type == "vendor") {
            $vendoraccount = Vendor::model()->findByPk($model->receiver_id);
            if ($vendoraccount->vendor_bal == 0.00) {
                $vendoraccount->vendor_bal = $_POST['Voucher']['amount'];
                $vendoraccount->save();
            } elseif ($model->voucher_type_id == 2) {
                
            } else {
                $vendoraccount->vendor_bal = $_POST['Voucher']['amount'];
                $vendoraccount->save();
            }
        }
        if ($model->payment_receiver_type == "expense_head") {
            
        }
        if ($model->payment_receiver_type == "others") {
            if ($model->voucher_type_id == 9) {
                
            }
            if ($model->voucher_type_id == 11) {
                
            }
        }
        d21('Voucher updated by' . Yii::app()->user->getUsername(), "site.login");
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
        $this->active_menu = "pos";
        $this->open_class = "menu";
        $this->active_class = "customer_ledger";
        $id = '';
     $receiver_type = Yii::app()->request->getParam('receiver_type');
   
        $receiver_id = Yii::app()->request->getParam('receiver_id');
        $voucher_type_id = 11;
        $model = new Voucher;
        if (!empty($_GET['closing_amt'])) {
            $model->amount = $_GET['closing_amt'];
        }
        $model->payment_date = date('Y-m-d');
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Voucher'])) {
            $model->attributes = $_POST['Voucher'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', "Receipt voucher has been created successfully");
                $this->redirect(array('offshelfsale/ledger?', 'cid' => $model->receiver_id));
            }
        }
        if (!empty($receiver_id)) {
            $customer = Customer::model()->findByPk($receiver_id);
        }

        $this->render('create', array(
            'model' => $model, 'id' => $id, 'receiver_type' => $receiver_type,
            'receiver_id' => $receiver_id,
            'voucher_type_id' => $voucher_type_id,
            'customer' => $customer
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $this->active_menu = "ex";
        $this->open_class = "exp";
        $this->active_class = "vadmin";
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Voucher'])) {
            $model->attributes = $_POST['Voucher'];
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
        //} else
        // throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $this->active_menu = "ex";
        $this->open_class = "exp";
        $this->active_class = "ex";
        $dlist = Vouchertype::model()->findAllByAttributes(array("voucher_nature" => 'debit'));
        $clist = Vouchertype::model()->findAllByAttributes(array("voucher_nature" => 'credit'));
        unset(Yii::app()->request->cookies['fdate']);  // first unset cookie for dates
        unset(Yii::app()->request->cookies['tdate']);
        $model = new Voucher('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Voucher']))
            Yii::app()->request->cookies['fdate'] = new CHttpCookie('from_date', $_GET['from_date']);  // define cookie for from_date
        Yii::app()->request->cookies['tdate'] = new CHttpCookie('to_date', $_GET['to_date']);
        $model->from_date = $_GET['from_date'];
        $model->to_date = $_GET['to_date'];
        $model->attributes = $_GET['Voucher'];

        $this->render('index', array(
            'dlist' => $dlist, 'clist' => $clist, 'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->active_menu = "ex";
        $this->open_class = "exp";
        $this->active_class = "vadmin";
        unset(Yii::app()->request->cookies['fdate']);  // first unset cookie for dates
        unset(Yii::app()->request->cookies['tdate']);
        $model = new Voucher('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Voucher']))
            Yii::app()->request->cookies['fdate'] = new CHttpCookie('from_date', $_GET['from_date']);  // define cookie for from_date
        Yii::app()->request->cookies['tdate'] = new CHttpCookie('to_date', $_GET['to_date']);
        $model->from_date = $_GET['from_date'];
        $model->to_date = $_GET['to_date'];
        $model->attributes = $_GET['Voucher'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Voucher the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Voucher::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Voucher $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'voucher-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
