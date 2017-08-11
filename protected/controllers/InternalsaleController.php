<?php

class InternalsaleController extends Controller {

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
                'actions' => array('invoice', 'memo', 'removeitem', 'updatedisc', 'updateqty',
                    'additems', 'getItemDetail', 'sale', 'create', 'update', 'delete', 'ledger',
                    'getitem', 'getpayitem', 'searchcustomerinvoice', 'savevoucher', 'saveItems'),
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
    public function actionSavevoucher() {
        //print_r($_POST);
        $msg = 'fail';
        if (!empty($_POST['amt']) && !empty($_POST['customer_id'])) {
            $amts = $_POST['amt'];
            $cid = $_POST['customer_id'];
            //  echo $cid; exit();
            $total_amt = 0.00;
            foreach ($amts as $k => $v) {
                if (!empty($v)) {
                    $pos = Offshelfsale::model()->findByPk($k);
                    //  print_r($pos->attributes);
                    $credit = new Creditaccount();
                    $credit->bill_no = $pos->invoice_number;
                    $credit->pos_id = $pos->id;
                    $credit->pos_type = 'party';
                    $credit->credit_amount = $v;
                    $credit->dated = date('Y-m-d');
                    $credit->voucher_no = $_POST['voucher_no'];
                    $credit->remark = "Amount of rs " . $v . " for the bill no " . $credit->bill_no . " by user " . Yii::app()->user->name;
                    // print_r($credit);
                    $credit->save();
                    $total_amt = $total_amt + $v;
                }
            }
            $customer = Customer::model()->findByPk($cid);
            $customer->balance = $customer->balance - $total_amt;
            $customer->save();
            $msg = 'success';
        }
        echo CJSON::encode(array('msg' => $msg));
    }

    public function actionSearchcustomerinvoice() {
        $customer_id = $_POST['customer_id'];
        $this->renderPartial('_searchcustomerinvoice', array(
            'customer_id' => $customer_id, 'fromdate' => $_POST['from_dated'], 'todate' => $_POST['to_dated'],
        ));
    }

    public function actionGetitem() {
        $sale = Offshelfsale::model()->findByPk($_GET['invoice_id']);
        $this->renderPartial('_getitem', array(
            'sale' => $sale,
        ));
    }

    public function actionGetpayitem() {
        $sale = Offshelfsale::model()->findByPk($_GET['invoice_id']);
        $payments = Creditaccount::model()->findAllByAttributes(array('pos_id' => $sale->id));
        $this->renderPartial('_getpayitem', array(
            'sale' => $sale,
            'payments' => $payments,
        ));
    }

    public function actionLedger() {
        $this->active_menu = "pos";
        $this->open_class = "menu";
        $this->active_class = "customer_ledger";
        $plist = "";
        $list = "";
        $model = new Customer();
        if (isset($_POST['Customer'])) {
            $model->attributes = $_POST['Customer'];
            $list = Customer::model()->findByPk($_POST['Customer']['id']);
        }
        if (isset($_GET['cid'])) {
            $list = Customer::model()->findByPk($_GET['cid']);
        }
        $cid = isset($_GET['cid']) ? $_GET['cid'] : $_POST['Customer']['id'];
        $vouchers = Voucher::model()->findAllByAttributes(array('receiver_id' => $cid));

        if (!empty($_POST['from_dated']) && !empty($_POST['to_dated'])) {
            $fromdate = $_POST['from_dated'];
            $todate = $_POST['to_dated'];
            if ($fromdate != "" && $todate != "" && !empty($cid)) {
                $plist = ShelfSale::model()->findAllBySql("select * from off_shelf_sale where order_date between '$fromdate' and '$todate' and txn_type='customer' and customer_id=$cid order by id desc");
            }
        } else {
            if (!empty($cid))
                $plist = ShelfSale::model()->findAllBySql("select * from off_shelf_sale where txn_type='customer' and customer_id=$cid order by id desc");
        }

        $this->render('ledger', array(
            'model' => $model,
            'list' => $list,
            'plist' => $plist,
            'vouchers' => $vouchers
        ));
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionInvoice($id) {
        $this->layout = 'pos_front_layout';
        if (!empty(Yii::app()->user->id)) {
            $sale = Offshelfsale::model()->findByPk($id);
            if (empty($sale->invoice_number)) {
                $inv = Offshelfsale::model()->findBySql("SELECT MAX(invoice_number) as invoice_number FROM off_shelf_sale where txn_type='internal'");
                if (!empty($inv->invoice_number)) {
                    $invoice = preg_replace('/\D/', '', $inv->invoice_number) + 1;
                } else {
                    $invoice = '1001';
                }
                $inv_no = 'TR' . $invoice;
                $sale->invoice_number = $inv_no;
                $customer = Customer::model()->findByPk($sale->customer_id);
                $amt = 0.00;
                foreach (Offshelfsaleitems::model()->findAllByAttributes(array('shelf_sale_id' => $sale->id)) as $item) {
                    $amt = $amt + $item->amount;
                }
                $balance = $customer->balance - $amt;
                $customer->balance = $balance;
                if ($customer->save()) {
                    $sale->counter_id = 0;
                    $sale->update();
                }
            }
            $this->render('print_invoice', array('sale' => $sale));
        }
    }

    public function actionMemo($id) {
        $this->layout = 'pos_front_layout';
        $sale = Offshelfsale::model()->findByPk($id);
        $this->render('print_memo', array('sale' => $sale));
    }

    public function actionRemoveitem($id) {
        $id = $_GET['id'];
        $items = Offshelfsaleitems::model()->findByPk($id);
        $mkot_sale = Offshelfsale::model()->findByPk($items->shelf_sale_id);
        $sid = $items->shelf_sale_id;
        $shelf = Itemstock::model()->findByPk($items->item_stock_id);
        if (!empty($shelf)) {
            $available_qty = $shelf->stock_qty + $items->qty;
            $shelf->stock_qty = $available_qty;
            $shelf->update();
            $items->delete();
        }
        $this->redirect(array('sale', 'id' => $sid));
    }

//    public function actionUpdatedisc() {
//        $id = $_GET['id'];
//        $disc = $_GET['disc'];
//        $mkot_items = Offshelfsaleitems::model()->findByPk($id);
//        $mkot_items->discount_percent = $disc;
//        $amt = $mkot_items->qty * $mkot_items->unit_price;
//        $total_amt = $amt - ($amt * ($mkot_items->discount_percent / 100));
//        $mkot_items->amount = $total_amt;
//        $mkot_items->save();
//        $this->redirect(array('sale', 'id' => $mkot_items->shelf_sale_id));
//    }

    public function actionUpdateqty() {
        $id = $_GET['id'];
        $qty = $_GET['qty'];
        $mkot_items = Offshelfsaleitems::model()->findByPk($id);
        $shelf = Shelfitems::model()->findByPk($mkot_items->item_id);

        if (!empty($shelf)) {
            $available_qty = ($shelf->total_qty + $mkot_items->qty) - $qty;
            $shelf->total_qty = $available_qty;
            $shelf->update();
            $category_taxes = Categorytaxes::model()->findByAttributes(array('pos_type' => 'OTS', 'p_category_id' => $shelf->p_category_id, 'p_sub_category_id' => $shelf->p_sub_category_id));
            $tax = Postaxes::model()->findByPk($category_taxes->tax_id);
            $mkot_items->qty = $qty;
            $amt = $mkot_items->qty * $mkot_items->unit_price;

            $disc = round(($amt * ($mkot_items->discount_percent / 100)), 2);
            $amt_after_disc = $amt - $disc;
            $mkot_items->disc_amt = $disc;
            $amt_without_tax = round((($amt_after_disc * 100) / ($tax->tax_percent + 100)), 2);
            $tax_amt = $amt_after_disc - $amt_without_tax;
            $mkot_items->unit_tax = $tax->tax_percent;
            $mkot_items->tax_amt = $tax_amt;
            $mkot_items->amt_without_tax = $amt_without_tax;
            $mkot_items->amount = $amt_after_disc;
            $mkot_items->save();

            $avail_qty = $shelf->total_qty + $qty;
            Yii::app()->user->setFlash('special_c', "You Have Only $avail_qty Quantity of this item in your Stock");
        } else {
            Yii::app()->user->setFlash('special_c', 'This Item is not in your Inventry, Please Add This Item In Your Stock...!!!');
        }
        $this->redirect(array('sale', 'id' => $mkot_items->shelf_sale_id));
    }

    public function actionSaveItems() {
        $stock_id = $_POST['stock_id'];
        $dispatch_qty = $_POST['dispatch_qty'];
        $indent_id = $_POST['indent_id'];
        $sale_price = $_POST['sale_price'];
        $sid = $_POST['pid'];
        $item = $_POST['cid'];

//        print_r($_POST);
//        exit();

        $item_info = Purchaseitem::model()->findByPk($item);
        $msg = 'Fail';
        if (!empty($item_info) && !empty($stock_id)) {

            $customer_sale = Offshelfsale::model()->findByPk($sid);
            $discount = Customerdiscount::model()->findByAttributes(array('customer_id' => $customer_sale->customer_id, 'item_id' => $item));
            $category_taxes = Categorytaxes::model()->findByAttributes(array('pos_type' => 'OTS', 'p_category_id' => $item_info->p_category_id, 'p_sub_category_id' => $item_info->p_sub_category_id));
            $tax = Postaxes::model()->findByPk($category_taxes->tax_id);

            $stock = Itemstock::model()->findByPk($stock_id); //====read stock 
            $condition = 'shelf_sale_id=:sid';
            $condition .= ' and item_id=:item';
            $params = array(':sid' => $sid, ':item' => $item);
            $chkExists = ShelfSaleItems::model()->exists($condition, $params);
            if ($chkExists) {
                $sale_items = Offshelfsaleitems::model()->findByAttributes(array('shelf_sale_id' => $sid, 'item_id' => $item));
                $stock->stock_qty = $stock->stock_qty - $dispatch_qty;
                $sale_items->qty = $sale_items->qty+$dispatch_qty;

                $sale_items->shelf_sale_id = $sid;
                $sale_items->item_id = $item;
                $sale_items->description = $item_info->itemname;
                $sale_items->unit_price = $sale_price;
                $sale_items->discount_percent = $discount->discount;
                $amt = $sale_items->qty * $sale_items->unit_price;
                $disc = round(($amt * ($sale_items->discount_percent / 100)), 2);
                $amt_after_disc = $amt - $disc;
                $sale_items->disc_amt = $disc;
                $total_tax = 0.00;
                $tax_percent = array();
                if (!empty($category_taxes)) {
                    foreach ($category_taxes as $taxes) {
                        $tax = Postaxes::model()->findByPk($category_taxes->tax_id);
                        $tax_percent[] = $tax->tax_percent;
                        $total_tax = $total_tax + ($amt_after_disc * ($tax->tax_percent / 100));
                    }
                }
                $amt_without_tax = round((($amt_after_disc * 100) / ($tax->tax_percent + 100)), 2);
                $tax_amt = $amt_after_disc - $amt_without_tax;
                $sale_items->unit_tax = $tax->tax_percent;
                $sale_items->tax_amt = $tax_amt;
                $sale_items->amt_without_tax = $amt_without_tax;
                $sale_items->amount = $amt_after_disc;
                $sale_items->item_stock_id = $stock_id;//new added to track CSK stock dispatching from which stock
                
                $sale_items->update();
                $stock->update(); // update stock after dispatch
                $il=new Itemledger();
                $il->addDebitInLedgerOnDispatch($item,'main',$sale_items->id, $dispatch_qty);
            } else {
                //check if item already exist then update qty and amount
                $sale_items = new Offshelfsaleitems();
                $stock->stock_qty = $stock->stock_qty - $dispatch_qty;
                $sale_items->qty = $dispatch_qty;

                $sale_items->shelf_sale_id = $sid;
                $sale_items->item_id = $item;
                $sale_items->description = $item_info->itemname;
                $sale_items->unit_price = $sale_price;
                $sale_items->discount_percent = $discount->discount;
                $amt = $sale_items->qty * $sale_items->unit_price;
                $disc = round(($amt * ($sale_items->discount_percent / 100)), 2);
                $amt_after_disc = $amt - $disc;
                $sale_items->disc_amt = $disc;
                $total_tax = 0.00;
                $tax_percent = array();
                if (!empty($category_taxes)) {
                    foreach ($category_taxes as $taxes) {
                        $tax = Postaxes::model()->findByPk($category_taxes->tax_id);
                        $tax_percent[] = $tax->tax_percent;
                        $total_tax = $total_tax + ($amt_after_disc * ($tax->tax_percent / 100));
                    }
                }
                $amt_without_tax = round((($amt_after_disc * 100) / ($tax->tax_percent + 100)), 2);
                $tax_amt = $amt_after_disc - $amt_without_tax;
                $sale_items->unit_tax = $tax->tax_percent;
                $sale_items->tax_amt = $tax_amt;
                $sale_items->amt_without_tax = $amt_without_tax;
                $sale_items->amount = $amt_after_disc;
                $sale_items->item_stock_id = $stock_id;//new added to track CSK stock dispatching from which stock
                $sale_items->save();
                $stock->update();
                $il=new Itemledger();
                $il->addDebitInLedgerOnDispatch($item,'main',$sale_items->id, $dispatch_qty);
            }
            $msg = "Success";
        }
        echo CJSON::encode(array('msg' => $msg));
    }

    public function actionAdditems() {
        $sid = $_GET['sid'];
        $item = $_GET['item'];
        $item_master = Purchaseitem::model()->findByPk($item);

//        $condition = 'shelf_sale_id=:sid';
//        $condition .= ' and item_id=:item';
//        $params = array(':sid' => $sid,':item'=>$item);
//        $chkExists = ShelfSaleItems::model()->exists($condition, $params);
//        if ($chkExists) {
//         $sale_items = Offshelfsaleitems::model()->findByAttributes(array('shelf_sale_id'=>$sid,'item_id'=>$item));            
//        }else{
//            $sale_items = new Offshelfsaleitems();
//        }
//        if (!empty($item_master)) {
//            $item_name = $item_master->itemname;
//            $customer_sale = Offshelfsale::model()->findByPk($sid);
//            $discount = Customerdiscount::model()->findByAttributes(array('customer_id' => $customer_sale->customer_id, 'item_id' => $item));
//            $category_taxes = Categorytaxes::model()->findByAttributes(array('pos_type' => 'OTS', 'p_category_id' => $item_master->p_category_id, 'p_sub_category_id' => $item_master->p_sub_category_id));
//            $tax = Postaxes::model()->findByPk($category_taxes->tax_id);
//            $mkot_items->shelf_sale_id = $sid;
//            $mkot_items->item_id = $item;
//            $mkot_items->description = $item_name->itemname;
//            $mkot_items->qty = 1;
//            $mkot_items->unit_price = $item_master->sale_price;
//            $mkot_items->discount_percent = $discount->discount;
//            $amt = $mkot_items->qty * $mkot_items->unit_price;
//            $disc = round(($amt * ($mkot_items->discount_percent / 100)), 2);
//            $amt_after_disc = $amt - $disc;
//            $mkot_items->disc_amt = $disc;
////        $total_tax = 0.00;
////        $tax_percent = array();
////        if (!empty($category_taxes)) {
////            foreach ($category_taxes as $taxes) {
////                $tax = Postaxes::model()->findByPk($category_taxes->tax_id);
////                $tax_percent[] = $tax->tax_percent;
////                $total_tax = $total_tax + ($amt_after_disc * ($tax->tax_percent / 100));
////            }
////        }
//            $amt_without_tax = round((($amt_after_disc * 100) / ($tax->tax_percent + 100)), 2);
//            $tax_amt = $amt_after_disc - $amt_without_tax;
//            $mkot_items->unit_tax = $tax->tax_percent;
//            $mkot_items->tax_amt = $tax_amt;
//            $mkot_items->amt_without_tax = $amt_without_tax;
//            $mkot_items->amount = $amt_after_disc;
//        print_r($mkot_items->attributes);
//        exit();
//            if ($mkot_items->save()) {
//                $available_qty = $item_master->total_qty - $mkot_items->qty;
//                $item_master->total_qty = $available_qty;
//                $item_master->update();
////           print_r($mkot_items->attributes); 
//            } else {
//                print_r($mkot_items->getErrors());
//            }
//            $avail_qty = $item_master->total_qty + $mkot_items->qty;
//            Yii::app()->user->setFlash('special_c', "You Have Only $avail_qty Quantity of this item in your Stock");
//        } else {
//            Yii::app()->user->setFlash('special_c', 'This Item is not in your Inventry, Please Add This Item In Your Stock...!!!');
//        }
        $this->redirect(array('sale', 'id' => $sid, 'val' => $item_master->id));
    }

    public function actionGetItemDetail() {
        $items = Yii::app()->db->createCommand()
                ->select('pi.id,pi.itemname as display')
                ->from('purchase_item pi')
                //->join('purchase_item pi', 'pi.id=si.item_id')
                ->queryAll();
        echo CJSON::encode(array('data' => $items));
    }

    public function actionSale($id) {
        $this->active_menu = "customer";
        $this->open_class = "customer";
        $this->active_class = "sale";
        $this->layout = 'pos_main';
        if (!empty(Yii::app()->user->id)) {
            $val = $_GET['val'];
            $model = Offshelfsale::model()->findByPk($id);
            $this->render('sale', array(
                'model' => $model,
                'val' => $val,
            ));
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->active_menu = "customer";
        $this->open_class = "customer";
        $this->active_class = "sale";
        $model = new Offshelfsale;
        $model->txn_type = 'internal';

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Offshelfsale'])) {
            $cash_drawer = Cashdrawer::model()->findByAttributes(array('date' => date('Y-m-d'), 'user_to' => Yii::app()->user->id), array('order' => 'id desc', 'limit' => 1));
            $model->attributes = $_POST['Offshelfsale'];
            $model->created_by = Yii::app()->user->id;
            $model->counter_id = $cash_drawer->counter_id;
            $model->order_date = date('Y-m-d');
            $model->order_time = date('h:m:s');
            if ($model->save()) {
                $this->redirect(array('sale', 'id' => $model->id));
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
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Offshelfsale'])) {
            $model->attributes = $_POST['Offshelfsale'];
            if ($model->save()) {
                $this->redirect(array('create'));
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
//        if (Yii::app()->request->isPostRequest) {
        // we only allow deletion via POST request
        $model = $this->loadModel($id);
        if (!empty($model)) {
            foreach (Offshelfsaleitems::model()->findAllByAttributes(array('shelf_sale_id' => $model->id)) as $item) {
                $item->delete();
            }
            $model->delete();
        }
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('create'));
//        } else
//            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Offshelfsale');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Offshelfsale('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Offshelfsale']))
            $model->attributes = $_GET['Offshelfsale'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Offshelfsale the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Offshelfsale::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Offshelfsale $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'offshelfsale-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
