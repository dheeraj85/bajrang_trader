<?php

class BillController extends Controller {

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
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'getchllanlist', 'getOrderList',
                    'getOrderitems', 'generatebill', 'addbillitems', 'showBillItems',
                    'savebillitems', 'showbill', 'invoice'),
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

    public function actionInvoice($id) {
        $this->active_menu = "bill";
        $this->open_class = "bill";
        $this->active_class = "create";
        $this->layout = "nolayout";
        if (!empty(Yii::app()->user->id)) {
            $model = Bill::model()->findByPk($id);
            $items = Billitems::model()->findAllByAttributes(array('bill_id' => $model->id));
            $this->render('print_invoice', array(
                'model' => $model,
                'items' => $items,
                'val' => $id,
            ));
        }
    }

    public function actionShowbill($id) {
        $this->active_menu = "bill";
        $this->open_class = "bill";
        $this->active_class = "create";
        if (!empty(Yii::app()->user->id)) {
            $model = Bill::model()->findByPk($id);
            $items = Billitems::model()->findAllByAttributes(array('bill_id' => $model->id));
            $this->render('showbill', array(
                'model' => $model,
                'items' => $items,
                'val' => $id,
            ));
        }
    }

    public function actionShowBillItems() {
        $id = Yii::app()->request->getParam('bill_id');
        $bill_items = Billitems::model()->findAllByAttributes(array('bill_id' => $id));
        $this->renderPartial('_addedBillItems', array(
            'bill_items' => $bill_items
        ));
    }

    public function actionSavebillitems() {
        //print_r($_POST);
        $bill_id = $_POST['bill_id'];
        $rate = $_POST['rate'];
        $parchi = $_POST['parchi'];
        if (!empty($parchi) && !empty($rate)) {
            foreach ($parchi as $p) {
                $kp = Kataparchy::model()->findByPk($p);
                $bilItems = new Billitems();
                $bilItems->bill_id = $bill_id;
                $bilItems->rate = $rate;
                $bilItems->tax = $kp->gst_percent;
                $bilItems->kata_parchi_id = $kp->id;
                $bilItems->weight = $kp->net_weight;
                $bilItems->amount = $bilItems->weight * $bilItems->rate;
                $bilItems->created_date = date('Y-m-d');
                $bilItems->save();
            }
            $sale = Bill::model()->findByPk($bill_id);
            $inv = Bill::model()->findBySql("SELECT MAX(bill_no) as bill_no FROM bill");
            if (!empty($inv->bill_no)) {
                $invoice = preg_replace('/\D/', '', $inv->bill_no) + 1;
            } else {
                $invoice = '1001';
            }
            $inv_no = Globalpreferences::getValueByParamName('invoice_prefix') . $invoice;
            $sale->bill_no = $inv_no;
            $sale->added_on = date('Y-m-d');
            $sale->print_type = "bill_on_total";
            $sale->save();
            $msg = "success";
        } else {
            $msg = "fail";
        }
        echo CJSON::encode(array('msg' => $msg));
    }

    public function actionAddbillitems() {
        $id = Yii::app()->request->getParam('id');
        $bill_id = Yii::app()->request->getParam('bill_id');
        $kp = Kataparchy::model()->findByPk($id);
        $model = new Billitems();
        $model->bill_id = $bill_id;
        $model->kata_parchi_id = $kp->id;
        $model->weight = $kp->load_weight;
        $model->rate = 0.00;
        $model->amount = 0.00;
        $model->created_date = date('Y-m-d');
        $model->save();
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionGeneratebill($id) {
        $this->active_menu = "bill";
        $this->open_class = "bill";
        $this->active_class = "create";
        $model = Bill::model()->findByPk($id);
        $list = Purchaseorderitems::model()->findAllByAttributes(array('purchase_order_id' => $model->purchase_order_id));
        $this->render('generate_bill', array(
            'model' => $model, 'list' => $list
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionGetOrderitems() {
        $id = Yii::app()->request->getParam('id');

        $list = Purchaseorderitems::model()->findAllByAttributes(array('purchase_order_id' => $id));
        echo CJSON::encode(array('list' => $list));
    }

    public function actionGetOrderList() {
        $list = Purchaseorder::model()->findAllByAttributes(array('is_active' => 1));
        echo CJSON::encode(array('list' => $list));
    }

    public function actionGetchllanlist() {
        $bill_id = $_GET['bill_id'];
        $model = Bill::model()->findByPk($bill_id);
        $from_date = $model->bill_from_date;
        $to_date = $model->bill_to_date;
        $purchase_order = $model->purchase_order_id;
        $order_items = $model->item_id;
        $rows = "";
        $order_no = "";
        if (!empty($purchase_order)) {
            $order_no = Purchaseorder::model()->findByPk($purchase_order)->order_no;
        }
        if (!empty($from_date) && !empty($to_date) && !empty($purchase_order)) {
            $attribs = array('order_no' => $order_no, 'item_id' => $order_items);
            $criteria = new CDbCriteria(array('order' => 'id ASC'));
            $criteria->addBetweenCondition('kata_parchi_date', $from_date, $to_date);
            $rows = Kataparchy::model()->findAllByAttributes($attribs, $criteria);
        }

        $this->renderPartial('_showKataParchiList', array(
            'rows' => $rows, 'bill_id' => $bill_id
        ));
    }

    public function actionCreate() {
        $this->active_menu = "bill";
        $this->open_class = "bill";
        $this->active_class = "create";
        $model = new Bill;
        $model->scenario = "create";
        if (isset($_POST['Bill'])) {
            $model->attributes = $_POST['Bill'];
            $model->purchase_order_id = $_POST['Bill']['purchase_order_id'];

            if ($model->validate()) {
                $model->bill_from_date = date('Y-m-d', strtotime($model->bill_from_date));
                $model->bill_to_date = date('Y-m-d', strtotime($model->bill_to_date));
                $model->bill_date = date('Y-m-d', strtotime($model->bill_date));
//                print_r($model->attributes);
//                exit();
                $model->save();
                //Tempreroy solution
                $weight = $_POST['Bill']['weight'];
                $rate = $_POST['Bill']['rate'];
                if (!empty($rate) && !empty($weight)) {
                    $bilItems = new Billitems();
                    $bilItems->bill_id = $model->id;
                    $bilItems->rate = $rate;
                    $bilItems->tax = Purchaseitem::model()->findByPk($model->item_id)->gst_percent;
                    $bilItems->kata_parchi_id = 0;
                    $bilItems->weight = $weight;
                    $bilItems->amount = $weight * $rate;
                    $bilItems->created_date = date('Y-m-d');
                    $bilItems->save();
                }
                $this->billNo($model->id);
                $this->redirect(array('showbill', 'id' => $model->id));
                //this will uncomment aftter proess will successful
                //$this->redirect(array('generatebill', 'id' => $model->id));
            }
        }
        $this->render('create', array(
            'model' => $model,
        ));
    }

    protected function billNo($bill_id) {
        $sale = Bill::model()->findByPk($bill_id);
        $inv = Bill::model()->findBySql("SELECT MAX(bill_no) as bill_no FROM bill");
        if (!empty($inv->bill_no)) {
            // $invoice = preg_replace('/\D/', '', $inv->bill_no) + 1;
            $invoice = $inv->bill_no + 1;
        } else {
            $invoice = 1;
        }
        $sale->bill_no = $invoice;
        $sale->added_on = date('Y-m-d');
        $sale->print_type = "bill_on_total";
        $sale->save();
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

        if (isset($_POST['Bill'])) {
            $model->attributes = $_POST['Bill'];
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
        $dataProvider = new CActiveDataProvider('Bill');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Bill('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Bill']))
            $model->attributes = $_GET['Bill'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Bill the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Bill::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Bill $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'bill-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
