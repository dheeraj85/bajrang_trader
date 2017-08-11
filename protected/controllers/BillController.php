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
                    'savebillitems', 'showbill', 'invoice', 'incremental', 'getItemList', 'getItemTotalWeight',
                    'editincremental'),
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

    public function actionGetItemTotalWeight() {
        $item_id = Yii::app()->request->getParam('id');
        $from_date = Yii::app()->request->getParam('from_date');
        $to_date = Yii::app()->request->getParam('to_date');
        $tweight = 0.00;
        if (!empty($from_date) && !empty($to_date)) {
            $from_date = date('Y-m-d', strtotime($from_date));
            $to_date = date('Y-m-d', strtotime($to_date));
            $bi = Billitems::model()->findBySql("SELECT sum(bi.weight) as weight from bill_items bi join bill b ON b.id=bi.bill_id where b.item_id=$item_id and b.bill_type='cost_bill' and b.bill_no>=1 and b.bill_from_date between '$from_date' and '$to_date'");
            $tweight = $bi['weight'];
        }
        echo CJSON::encode(array('tweight' => $tweight));
    }

    public function actionIncremental() {
        $this->active_menu = "bill";
        $this->open_class = "bill";
        $this->active_class = "incremental";
        $model = new Bill();
        $model->bill_from_date = date('d-m-Y', strtotime('first day of last month'));
        $model->bill_to_date = date('d-m-Y', strtotime('last day of last month'));
        $model->rate = 100;
        if (isset($_POST['Bill'])) {
            $model->attributes = $_POST['Bill'];
            //$model->purchase_order_id = 0;
            $model->bill_type = 'incremental_bill';

            $model->bill_from_date = date('Y-m-d', strtotime($model->bill_from_date));
            $model->bill_to_date = date('Y-m-d', strtotime($model->bill_to_date));
            $model->bill_date = date('Y-m-d', strtotime($model->bill_date));
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

                $this->billNo($model->id);
                $this->redirect(array('showbill', 'id' => $model->id));
                //this will uncomment aftter proess will successful                
            }
        }
        $this->render('incremental', array(
            'model' => $model
        ));
    }

    public function actionInvoice($id) {
        $this->active_menu = "bill";
        $this->open_class = "bill";
        $this->active_class = "create";
        $this->layout = "nolayout";
        $poi = "";
        if (!empty(Yii::app()->user->id)) {
            $model = Bill::model()->findByPk($id);
            $items = Billitems::model()->findAllByAttributes(array('bill_id' => $model->id));
            if ($model->bill_type == 'incremental_bill') {
                // echo "SELECT po.order_no,po.place from purchase_order_items poi join purchase_order po ON po.id=poi.purchase_order_id where poi.item_id=$model->item_id";
                $poi = Purchaseorder::model()->findAllBySql("SELECT po.order_no,po.place from purchase_order_items poi join purchase_order po ON po.id=poi.purchase_order_id where poi.item_id=$model->item_id");
            }
            // print_r($poi->attributes);

            $this->render('print_invoice', array(
                'model' => $model,
                'items' => $items,
                'val' => $id,
                'poi' => $poi,
            ));
        }
    }

    public function actionShowbill($id) {
        $this->active_menu = "bill";
        $this->open_class = "bill";
        $this->active_class = "create";
        if (!empty(Yii::app()->user->id)) {
            $model = Bill::model()->findByPk($id);
            if ($model->bill_type == 'incremental_bill') {
                $this->active_class = "incremental";
            }
            $items = Billitems::model()->findAllByAttributes(array('bill_id' => $model->id));
            $this->render('showbill', array(
                'model' => $model,
                'items' => $items,
                'val' => $id,
            ));
        }
    }

    public function actionSavebillitems() {
        $bill_id = $_POST['bill_id'];
        if (!empty($bill_id)) {
            $this->billNo($bill_id);
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
        $rows = "";
        $model = Bill::model()->findByPk($id);
        $list = Purchaseorderitems::model()->findAllByAttributes(array('purchase_order_id' => $model->purchase_order_id));
        $rows = $this->getchllanlist($id);
        $this->render('generate_bill', array(
            'model' => $model, 'list' => $list, 'rows' => $rows
        ));
    }

    protected function getchllanlist($id) {        
        $model = Bill::model()->findByPk($id);
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
        return $rows;
    }

    public function actionGetOrderitems() {
        $id = Yii::app()->request->getParam('id');
        $list = Purchaseorderitems::model()->findAllByAttributes(array('purchase_order_id' => $id));
        echo CJSON::encode(array('list' => $list));
    }

    public function actionGetOrderList() {
        $list = Purchaseorder::model()->findAllByAttributes(array('is_active' => 1));
        echo CJSON::encode(array('list' => $list));
    }

    public function actionGetItemList() {
        $list = Purchaseitem::model()->findAll();
        echo CJSON::encode(array('list' => $list));
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
                $model->bill_type="cost_bill";
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
                // $this->billNo($model->id);
                // $this->redirect(array('showbill', 'id' => $model->id));
                //this will uncomment aftter proess will successful
                $this->redirect(array('generatebill', 'id' => $model->id));
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
        $this->active_menu = "bill";
        $this->open_class = "bill";
        $this->active_class = "create";
        $model = $this->loadModel($id);
        $items = Billitems::model()->findAllByAttributes(array('bill_id' => $model->id));
//        print_r($items[0]->attributes);
//        exit();
        if (!empty($items)) {
            $model->weight = $items[0]->weight;
            $model->rate = $items[0]->rate;
        }
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
                    $bilItems = Billitems::model()->findByAttributes(array('bill_id' => $model->id));
                    if (empty($bilItems))
                        $bilItems = new Billitems ();
                    $bilItems->bill_id = $model->id;
                    $bilItems->rate = $rate;
                    $bilItems->tax = Purchaseitem::model()->findByPk($model->item_id)->gst_percent;
                    $bilItems->kata_parchi_id = 0;
                    $bilItems->weight = $weight;
                    $bilItems->amount = $weight * $rate;
                    $bilItems->created_date = date('Y-m-d');
                    $bilItems->save();
                }
                Yii::app()->user->setFlash('success', "Cost Bill Updated Successfully!!!");
                $this->redirect(array('create'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionEditincremental($id) {
        $this->active_menu = "bill";
        $this->open_class = "bill";
        $this->active_class = "incremental";
        $model = $this->loadModel($id);
        $items = Billitems::model()->findAllByAttributes(array('bill_id' => $model->id));
//        print_r($items[0]->attributes);
//        exit();
        if (!empty($items)) {
            $model->weight = $items[0]->weight;
            $model->rate = $items[0]->rate;
        }
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
                    $bilItems = Billitems::model()->findByAttributes(array('bill_id' => $model->id));
                    if (empty($bilItems))
                        $bilItems = new Billitems ();
                    $bilItems->bill_id = $model->id;
                    $bilItems->rate = $rate;
                    $bilItems->weight = $weight;
                    $bilItems->amount = $weight * $rate;
                    $bilItems->tax = Purchaseitem::model()->findByPk($model->item_id)->gst_percent;
                    $bilItems->kata_parchi_id = 0;
                    $bilItems->created_date = date('Y-m-d');
                    $bilItems->save();
                }
                Yii::app()->user->setFlash('success', "Incremental Bill Updated Successfully!!!");
                $this->redirect(array('incremental'));
            }
        }

        $this->render('editincremental', array(
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
