<?php

class PosController extends Controller {

    public $active_menu = '';
    public $active_class = '';
    public $open_class = '';
    public $layout = '//layouts/pos_column';

    /**
     * @return array action filtersot
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
//			/'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('cartdetails', 'ajaxdelete', 'takeorders', 'newentry', 'resetentry', 'authenticate'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('creditcustomer', 'savecreditbill', 'getsinglebill', 'findCreditCustomer', 'paycreditbill', 'paybill', 'viewotsbill', 'viewmenubill', 'getorders', 'vieworders', 'savebilldetail', 'removeKotItems', 'viewkot', 'generatemenubill', 'generateMenuKot', 'cancelMenuKot', 'removeToMenuKot', 'updateMenuKot', 'addToMenuKot', 'index', 'getSubcats', 'getCats', 'getMenuItems', 'getSearchItems', 'addToCart',
                    'getItemDetail', 'ots_items', 'menu_items', 'aos_items', 'checkcounter', 'handovercounter',
                    'savehandover', 'received', 'removeToCart', 'updateCart', 'authenticate', 'cancelorder',
                    'getItemDetailMenu', 'getorders', 'cancelbill', 'ajaxcancelbill'),
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

    public function actionSavecreditbill() {
//        print_r($_POST);
//        exit();
        $mobile = $_POST['mobile'];
        $name = $_POST['name'];
        $cid = $_POST['cid'];
        $bill_id = $_POST['shelf_id'];

        if (empty($cid)) {
            $c = new Customer();
            $c->full_name = $name;
            $c->mobile_no = $mobile;
            $c->type = "cash";
            $c->regdate = date('Y-m-d');
            $c->save();

            //insert data into credit table
//           $sql = "SELECT sum(o.amount) as amount,s.id,s.invoice_number,s.order_date,s.order_time,u.name from off_shelf_sale s JOIN off_shelf_sale_items o ON o.shelf_sale_id=s.id JOIN users u ON u.id=s.counter_id where s.id=$bill_id";
//            $getShelf =Yii::app()->db->createCommand($sql)->queryAll();
//            $credit = new Creditaccount();
//            $credit->bill_no = $getShelf[0]['invoice_number'];
//            $credit->pos_id = $bill_id;
//            $credit->pos_type = 'ots';
//            $credit->credit_amount = $getShelf[0]['amount'];
//            $credit->dated = date('Y-m-d');
//            $credit->remark = "Amount " . $getShelf[0]['amount'] . " has been credited to customer $name, mobile $mobile account ";
//            $credit->save();
            Offshelfsale::model()->updateByPk($bill_id, array("customer_id" => $c->id, 'pay_status' => 'Credit'));
            $msg = "success";
        } else {
            //if customer exist
            $c = Customer::model()->findByPk($cid);

            //insert data into credit table
            //echo $bill_id;
//            $sql = "SELECT sum(o.amount) as amount,s.id,s.invoice_number,
//                s.order_date,s.order_time,u.name from off_shelf_sale s 
//                JOIN off_shelf_sale_items o ON o.shelf_sale_id=s.id 
//                JOIN users u ON u.id=s.counter_id
//                where s.id=$bill_id";
//            $getShelf =Yii::app()->db->createCommand($sql)->queryAll();
////            print_r($getShelf);
////            exit();
//            $credit = new Creditaccount();
//            $credit->bill_no = $getShelf[0]['invoice_number'];
//            $credit->pos_type = 'ots';
//            $credit->pos_id = $bill_id;
//            $credit->credit_amount = $getShelf[0]['amount'];
//            $credit->dated = date('Y-m-d');
//            $credit->remark = "Amount " . $getShelf[0]['amount'] . " has been credited to customer $name, mobile $mobile account ";
//            $credit->save();
            Offshelfsale::model()->updateByPk($bill_id, array("customer_id" => $c->id, 'pay_status' => 'Credit'));
            $msg = "success";
        }
        echo CJSON::encode(array('msg' => $msg));
    }

    public function actionPaybill() {
        $id = $_POST['id'];
        if (!empty($id)) {
            Offshelfsale::model()->updateByPk($id, array("pay_status" => 'Paid'));
            echo "Success";
        } else {
            echo "Fail";
        }
    }

    public function actionPaycreditbill() {
        $id = $_POST['id'];
        $val = 'print';
        $this->renderPartial('_credit_bill', array('id' => $id));
    }

    // to find the cash customer from offshelfsale table for credit management
    public function actionFindCreditCustomer() {
        $mobile = $_POST['mobile'];
        $condition = 'mobile_no=:mobile';
        $params = array(':mobile' => $mobile);
        $mobileExists = Customer::model()->exists($condition, $params);
        if ($mobileExists) {
            $c = Customer::model()->findByAttributes(array('mobile_no' => $mobile));
            // echo $c->id;
            $sql = "SELECT sum(o.amount) as amount,s.id,s.invoice_number,
                s.order_date,s.order_time,u.name from off_shelf_sale s 
                JOIN off_shelf_sale_items o ON o.shelf_sale_id=s.id 
                JOIN users u ON u.id=s.counter_id
                where s.customer_id=$c->id and s.txn_type='cash' group by o.shelf_sale_id";
            $items = Yii::app()->db->createCommand($sql)->queryAll();
        } else {
            $items = "norecord";
            $c = "";
        }
        echo CJSON::encode(array('items' => $items, 'customer' => $c));
    }

    public function actionGetsinglebill() {
        $id = $_GET['id'];
        $sql = "SELECT sum(o.amount) as amount,s.id,s.invoice_number,
                s.order_date,s.order_time,u.name from off_shelf_sale s 
                JOIN off_shelf_sale_items o ON o.shelf_sale_id=s.id 
                JOIN users u ON u.id=s.counter_id
                where s.id=$id and s.txn_type='cash'";
        $shelf_sale = Yii::app()->db->createCommand($sql)->queryAll();
        echo CJSON::encode(array('shelf_sale' => $shelf_sale[0]));
    }

    public function actionCancelbill() {
        $id = $_GET['id'];
        $val = 'print';
        if (Yii::app()->user->isSA()) {
            $this->layout = 'column2';
            $this->active_menu = "pos";
            $this->open_class = "menu";
            $this->active_class = "view_order";
        }
        $shelf_sale = Offshelfsale::model()->findByPk($id);
        $this->render('cancelbill', array('shelf_sale' => $shelf_sale, 'val' => $val));
    }

    public function actionAjaxcancelbill() {
        $msg = "fail";
        if (isset($_POST)) {
            $id = $_POST['id'];
            $cancel_items = $_POST['cancel_item'];
            if (empty($cancel_items)) {
                echo CJSON::encode(array('msg' => $msg));
                exit();
            }
            //  $shelf_sale = Offshelfsale::model()->findByPk($id);
            Offshelfsale::model()->updateByPk($id, array('cancel_bill' => 1));
            //   $sale_items = ShelfSaleItems::model()->findAllByAttributes(array('shelf_sale_id' => $shelf_sale->id));
            foreach ($cancel_items as $ci) {
                $si = ShelfSaleItems::model()->findByPk($ci);
                $shelf = Shelfitems::model()->findByAttributes(array('item_id' => $si->item_id));
                if (!empty($shelf)) {
                    $available_qty = $shelf->total_qty + $si->qty;
                    $shelf->total_qty = $available_qty;
                    $shelf->update();
                    d21('Item name' . $si->description . ' Qty ' . $si->qty . ' canceled by ' . Yii::app()->user->getUsername() . ' On Dated ' . date('Y-m-d H:i:s'), "cancel");
                    $credit_item_ledger = new Itemledger();
                    $credit_item_ledger->addCreditInLedgerOnInternalStockUpdate($si->item_id, "shelf", $shelf->id, $si->qty);
                    $si->cancel_item = 1;
                    $si->save();
                }
            }
            $msg = "success";
        }
        echo CJSON::encode(array('msg' => $msg));
        exit();
    }

    public function actionViewotsbill() {
        $id = $_POST['id'];
        $val = 'admin';
        $shelf_sale = Offshelfsale::model()->findByPk($id);
        $this->renderPartial('_ots_bill', array('shelf_sale' => $shelf_sale, 'val' => $val));
    }

    public function actionViewmenubill() {
        $id = $_POST['id'];
        $val = 'print';
        $menu_sale = Menusale::model()->findByPk($id);
        $this->renderPartial('_menu_bill', array('menu_sale' => $menu_sale, 'val' => $val));
    }

    public function actionGetorders() {
        $pos_type = $_POST['pos_type'];
        $search = $_POST['search_order'];
        $counter_id = $_POST['counter_id'];
        $fd = $_POST['fd'];
        $td = $_POST['td'];
        if (Yii::app()->user->role == 'pos') {
            $user_info = "txn_type='cash' and created_by=" . Yii::app()->user->id;
        } else {
            $user_info = "txn_type in('cash','customer')";
        }
        if ($pos_type == 'OTS') {
            if (!empty($fd) && !empty($td) && !empty($counter_id)) {
                $shelf_sale = Offshelfsale::model()->findAllBySql("select * from off_shelf_sale where $user_info and counter_id=$counter_id and order_date between '$fd' and '$td' order by invoice_number desc");
            } else if (!empty($fd) && !empty($td) && empty($counter_id)) {
                $shelf_sale = Offshelfsale::model()->findAllBySql("select * from off_shelf_sale where $user_info and order_date between '$fd' and '$td' order by invoice_number desc");
            }
            if ($search == 'export') {
                $this->render('getotsexcel', array('shelf_sale' => $shelf_sale));
            } else {
                $this->renderPartial('_getotsorders', array('shelf_sale' => $shelf_sale));
            }
        } else if ($pos_type == 'MENU') {
            if (!empty($fd) && !empty($td) && !empty($counter_id)) {
                $menu_sale = Menusale::model()->findAllBySql("select * from menu_sale where txn_type='cash' $user_info and counter_id=$counter_id and order_date between '$fd' and '$td' order by invoice_number desc");
            } else if (!empty($fd) && !empty($td) && empty($counter_id)) {
                $menu_sale = Menusale::model()->findAllBySql("select * from menu_sale where txn_type='cash' $user_info and order_date between '$fd' and '$td' order by invoice_number desc");
            }
            $this->renderPartial('_getmenuorders', array('menu_sale' => $menu_sale));
        }
    }

    public function actionVieworders() {
        if (Yii::app()->user->isSA()) {
            $this->layout = 'column2';
            $this->active_menu = "pos";
            $this->open_class = "menu";
            $this->active_class = "view_order";
        }
        $this->render('view_orders');
    }

    public function actionSavebilldetail() {
        $menu_sale = new Menusale();
        $menu_sale->attributes = $_POST['Menusale'];
        $menu_sale->order_time = date('h:i A');
        if (!empty($_POST['tax_name'])) {
            $menu_sale->tax_name = serialize($_POST['tax_name']);
        } else {
            $menu_sale->tax_name = '';
        }
        if (!empty($_POST['tax_percent'])) {
            $menu_sale->tax_percent = serialize($_POST['tax_percent']);
        } else {
            $menu_sale->tax_percent = '';
        }
        $menu_sale->txn_type = 'cash';
        $menu_sale->created_by = Yii::app()->user->id;
        if ($menu_sale->save()) {
            $table = Ordertable::model()->findByPk($menu_sale->table_id);
            $table->is_running = 'no';
            $table->save();
            foreach (Menukot::model()->findAllByAttributes(array('table_id' => $menu_sale->table_id, 'counter_id' => $menu_sale->counter_id, 'is_added_to_bill' => 0)) as $mk) {
                foreach (Menukotitems::model()->findAllByAttributes(array('menu_kot_id' => $mk->id)) as $kot_items) {
                    $rate = Menuitems::model()->findByAttributes(array('item_id' => $kot_items->menu_item_id));
                    $menu_sale_items = new Menusaleitems();
                    $menu_sale_items->menu_sale_id = $menu_sale->id;
                    $menu_sale_items->menu_kot_id = $mk->id;
                    $menu_sale_items->item_id = $kot_items->menu_item_id;
                    $menu_sale_items->qty = $kot_items->qty;
                    $menu_sale_items->unit_price = $rate->sale_price;
                    $menu_sale_items->amount = $kot_items->price;
                    $menu_sale_items->save();
                }
                $mk->is_added_to_bill = 1;
                $mk->save();
            }
            $this->renderPartial('_menu_bill', array('menu_sale' => $menu_sale));
        } else {
//            print_r($menu_sale->getErrors());
//            exit();
            $this->renderPartial('_generatemenubill', array('model' => $menu_sale, 'tid' => $_POST['Menusale']['table_id']));
        }
    }

    public function actionRemoveKotItems() {
        $id = $_GET['id'];
        if (!empty($id)) {
            $mkot_items = Menukotitems::model()->findByPk($id);
            $kot_id = $mkot_items->menu_kot_id;
            $mkot_items->delete();
        }
        $kot = Menukot::model()->findByPk($kot_id);
        $this->renderPartial('_kot', array('kot' => $kot));
    }

    public function actionViewkot() {
        $kot_id = $_GET['kid'];
        $kot = Menukot::model()->findByPk($kot_id);
//        print_r($kot->attributes);
//        exit();
        $this->renderPartial('_kot', array('kot' => $kot));
    }

    public function actionGeneratemenubill() {
        $tid = $_GET['tid'];
        $model = new Menusale();
        $this->renderPartial('_generatemenubill', array('model' => $model, 'tid' => $tid));
    }

    public function actionGenerateMenuKot() {
        $id = $_SESSION['mkot_id'];
        if (!empty($id)) {
            $mkot = Menukot::model()->findByPk($id);
            $mkot->is_print_kot = 0;
            if ($mkot->update()) {
                unset($_SESSION['mkot_id']);
                unset($_SESSION['table_id']);
                unset($_SESSION['mkot_no']);
            }
        }
//        $this->redirect(array('menu_items'));
    }

    public function actionCancelMenuKot() {
        $id = $_SESSION['mkot_id'];
        if (!empty($id)) {
            $mkot = Menukot::model()->findByPk($id);
            foreach (Menukotitems::model()->findAllByAttributes(array('menu_kot_id' => $mkot->id)) as $mkot_items) {
                $mkot_items->delete();
            }
//            $table = Ordertable::model()->findByPk($mkot->table_id);
//                $table->is_running = 'no';
//                $table->update();
            unset($_SESSION['mkot_id']);
            unset($_SESSION['table_id']);
            unset($_SESSION['mkot_no']);
            if (!empty($mkot)) {
                $mkot->delete();
            }
        }
        $this->redirect(array('menu_items'));
    }

    public function actionRemoveToMenuKot() {
        $id = $_GET['id'];
        if (!empty($id)) {
            $mkot_items = Menukotitems::model()->findByPk($id);
            $mkot_items->delete();
        }
        $this->redirect(array('menu_items'));
    }

    public function actionUpdateMenuKot() {
        $id = $_GET['id'];
        $qty = $_GET['qty'];
        $mkot_items = Menukotitems::model()->findByPk($id);
        $mkot_items->qty = $qty;
        $shelf = Menuitems::model()->findByAttributes(array('item_id' => $mkot_items->menu_item_id));
        $amt = $qty * $shelf->sale_price;
        $mkot_items->price = $amt;
        $mkot_items->save();
        $val = "";
        $this->render('menu_items', array('val' => $val));
    }

    public function actionAddToMenuKot() {
        $table = $_GET['table'];
        $barcode = $_GET['q'];
        if (!empty($barcode)) {
            $item_id = Menuitems::model()->findByAttributes(array('barcode' => $barcode))->item_id;
        }
        $item = isset($_GET['item']) ? $_GET['item'] : $item_id;
        $qty = isset($_GET['qty']) ? $_GET['qty'] : 1;
        if (empty($_SESSION['mkot_id'])) {
            $menukot = Menukot::model()->findByAttributes(array('kot_date' => date('Y-m-d')), array('order' => 'id desc', 'limit' => 1));
            if (!empty($menukot)) {
                $kot = $menukot->kot_no + 1;
            } else {
                $kot = '01';
            }
            $kot_no = sprintf("%03d", $kot);
            $cash_drawer = Cashdrawer::model()->findByAttributes(array('date' => date('Y-m-d'), 'user_to' => Yii::app()->user->id), array('order' => 'id desc', 'limit' => 1));
            $mkot = new Menukot();
            $mkot->counter_id = $cash_drawer->counter_id;
            $mkot->status = 'pending';
            $mkot->table_id = $table;
            $mkot->kot_no = $kot_no;
            $mkot->kot_date = date('Y-m-d');
            if ($mkot->save()) {
                $_SESSION['mkot_id'] = $mkot->id;
                $_SESSION['table_id'] = $mkot->table_id;
                $_SESSION['mkot_no'] = $mkot->kot_no;
                $table = Ordertable::model()->findByPk($mkot->table_id);
                $table->is_running = 'yes';
                $table->update();
            }
        }
        $mkot_items = new Menukotitems();
        $mkot_items->menu_kot_id = $_SESSION['mkot_id'];
        $mkot_items->menu_item_id = $item;
        $mkot_items->qty = $qty;
        $shelf = Menuitems::model()->findByAttributes(array('item_id' => $item));
        $amt = $qty * $shelf->sale_price;
        $mkot_items->price = $amt;
        $mkot_items->save();

        $val = "qty_" . $mkot_items->id;
        $this->render('menu_items', array('val' => $val));
    }

    public function actionHandovercounter() {
        $this->layout = 'pos_front_layout';
        $cash_drawer = Cashdrawer::model()->findByAttributes(array('date' => date('Y-m-d'), 'user_to' => Yii::app()->user->id), array('order' => 'id desc', 'limit' => 1));
        $this->render('handover', array('cash_drawer' => $cash_drawer));
    }

    public function actionReceived() {
        $id = $_POST['drawer_id'];
        $cash_drawer = Cashdrawer::model()->findByPk($id);
        $cash_drawer->is_handover_verified = $_POST['is_handover_verified'];
        $cash_drawer->handover_remark = $_POST['handover_remark'];
        if ($cash_drawer->update()) {
            $this->redirect(array('ots_items'));
        }
    }

    public function actionSavehandover() {
        $model = new Cashdrawer();
        $model->counter_id = $_POST['counter_id'];
        $model->cash = $_POST['cash'];
        $model->user_id = Yii::app()->user->id;
        $model->txn_type = 'handover';
        $model->date = date('Y-m-d');
        $model->user_from = Yii::app()->user->id;
        $model->user_to = $_POST['user_to'];
        $model->remark = $_POST['remark'];
        if ($model->save()) {
            $this->redirect(array('site/logout'));
        } else {
//            print_r($model->getErrors());
        }
    }

    public function actionCheckcounter() {
        $cid = $_POST['data'];
        $cashdrawer = Cashdrawer::model()->findAllByAttributes(array('counter_id' => $cid), array('order' => 'id desc', 'limit' => '1'));
        $this->renderPartial('_opening_cash', array('cashdrawer' => $cashdrawer, 'cid' => $cid));
    }

    public function actionRemoveToCart() {
        $id = $_GET['id'];
        if (!empty($id)) {
            PosCart::remove($id);
        }
        $this->redirect(array('ots_items'));
    }

    public function actionUpdateCart() {
        $id = $_GET['id'];
        $qty = $_GET['qty'];
        $memo_no = $_GET['memo_no'];
        $stock = Shelfitems::model()->findByAttributes(array('item_id' => $id));
        if (!empty($stock)) {
            if (!empty($id)) {
                if (PosCart::checkExists($id)) {
                    $pos_cart = new PosCart();
                    $pos_cart->itemid = $id;
                    $pos_cart->qty = $qty;
                    PosCart::updatecart($pos_cart);
                }
            }
            //           $item_qty_id="qty_".$id;
//        $this->render('ots_items',array('item_qty_id'=>$item_qty_id));

            Yii::app()->user->setFlash('ots', "You Have Only $stock->total_qty Quantity of this item in your Stock");
        } else {
            Yii::app()->user->setFlash('ots', 'This Item is not in your Inventry, Please Add This Item In Your Stock...!!!');
        }

        $cash_drawer = Cashdrawer::model()->findByAttributes(array('date' => date('Y-m-d'), 'user_to' => Yii::app()->user->id), array('order' => 'id DESC'));
        $items = ShelfSale::model()->findAllByAttributes(array('counter_id' => $cash_drawer->counter_id, 'txn_type' => 'cash'), array(
            'order' => 'id desc',
            'limit' => 10
        ));
        $hot_items = Yii::app()->db->createCommand()
                ->select('pi.id,si.item_id,pi.itemname as item,si.qty,si.unit_price')
                ->from('off_shelf_sale_items si')
                ->join('purchase_item pi', 'pi.id=si.item_id')
                ->group('si.item_id')
                ->order('si.item_id desc')
                ->limit('8')
                ->queryAll();

        $this->render('ots_items', array('items' => $items,
            'hot_items' => $hot_items, 'memo_no' => $memo_no));
    }

    public function actionAddToCart() {
        $barcode = isset($_GET['q']) ? $_GET['q'] : '';
        $memo_no = $_GET['memo_no'];
        if (!empty($barcode)) {
            $item_id = Purchaseitem::model()->findByAttributes(array('barcode' => $barcode))->id;
        }
        $item = isset($_GET['item']) ? $_GET['item'] : $item_id;
        $qty = isset($_GET['qty']) ? $_GET['qty'] : 1;
        $stock = Shelfitems::model()->findByAttributes(array('item_id' => $item));
        //   print_r($stock->attributes);
        //    exit();
        if (!empty($stock)) {
            $pos_cart = new PosCart();
            $pos_cart->itemid = $item;
            $pos_cart->qty = $qty;
            PosCart::addtocart($pos_cart);
            $item_qty_id = "qty_" . $item;
            Yii::app()->user->setFlash('ots', "You Have Only $stock->total_qty Quantity of this item in your Item Stock");
        } else {
            Yii::app()->user->setFlash('ots', 'This Item is not in your Inventry, Please Add This Item In Your Item Stock...!!!');
        }

        $cash_drawer = Cashdrawer::model()->findByAttributes(array('date' => date('Y-m-d'), 'user_to' => Yii::app()->user->id), array('order' => 'id DESC'));
        $items = ShelfSale::model()->findAllByAttributes(array('counter_id' => $cash_drawer->counter_id, 'txn_type' => 'cash'), array(
            'order' => 'id desc',
            'limit' => 15
        ));

        $hot_items = Yii::app()->db->createCommand()
                ->select('pi.id,si.item_id,pi.itemname as item,si.qty,si.unit_price')
                ->from('off_shelf_sale_items si')
                ->join('purchase_item pi', 'pi.id=si.item_id')
                ->group('si.item_id')
                ->order('si.item_id desc')
                ->limit('8')
                ->queryAll();
        $this->render('ots_items', array('item_qty_id' => $item_qty_id,
            'items' => $items,
            'hot_items' => $hot_items,
            'memo_no' => $memo_no
        ));
    }

    public function actionGetItemDetail() {
        $items = Yii::app()->db->createCommand()
                ->select('pi.id,pi.itemname as display')
                ->from('shelf_items si')
                ->join('purchase_item pi', 'pi.id=si.item_id')
                ->where('pi.is_active=1')
                ->queryAll();
        echo CJSON::encode(array('data' => $items));
    }

    public function actionGetItemDetailMenu() {
        $items = Yii::app()->db->createCommand()
                ->select('pi.id,pi.itemname as display')
                ->from('menu_items si')
                ->join('purchase_item pi', 'pi.id=si.item_id')
                ->where('pi.is_active=1')
                ->queryAll();
        echo CJSON::encode(array('data' => $items));
    }

    public function actionOts_items() {
        $cash_drawer = Cashdrawer::model()->findByAttributes(array('date' => date('Y-m-d'), 'user_to' => Yii::app()->user->id), array('order' => 'id DESC'));
        $cash_counter = Cashcounter::model()->findByPk($cash_drawer->counter_id);
        Yii::app()->session['pos_user'] = $cash_drawer->userto->name;
        Yii::app()->session['counter'] = $cash_counter->counter_name;
        $memo = ShelfSale::model()->findBySql("SELECT MAX(memo_number) as memo_number, MAX(invoice_number) as invoice_number FROM off_shelf_sale where txn_type='cash'");
        //    echo $memo->memo_number;exit();
        if (!empty($memo)) {
            $memo_no = $memo->memo_number + 1;
        } else {
            $memo_no = 1;
        }

        if (Yii::app()->request->getPost('submit') == 'paid') {
            if (empty($_SESSION['pos_cart']))
                $this->redirect(array('ots_items'));
            $inv = ShelfSale::model()->findBySql("SELECT `invoice_number` FROM off_shelf_sale where txn_type='cash' ORDER BY LENGTH(invoice_number) DESC, invoice_number DESC LIMIT 1");
//         $inv = ShelfSale::model()->findByAttributes(array(), array('order' => 'id desc', 'limit' => 1));
            if (!empty($inv)) {
                $inv_no = $inv->invoice_number + 1;
            } else {
                $inv_no = '1001';
            }
            // echo sprintf("%04d", $inv_no);; exit();

            $cart = PosCart::getAll();
            $ss = new ShelfSale();
            $ss->invoice_number = $inv_no; // sprintf("%04d", $inv_no);
            $ss->memo_number = $memo_no;
            $ss->txn_type = 'cash';
            $ss->counter_id = $cash_drawer->counter_id;
            $ss->created_by = Yii::app()->user->id;
            $ss->order_date = date('Y-m-d');
            $ss->order_time = date('H:i:s');
            $ss->save();
//    echo $ss->id;
            foreach ($cart as $c) {
                $itemid = $c->itemid;
                $shelf = Shelfitems::model()->findByAttributes(array('item_id' => $itemid));
                if (!empty($shelf)) {
                    $sst = new ShelfSaleItems();
                    $sst->shelf_sale_id = $ss->id;
                    $sst->item_id = $itemid;
                    $sst->qty = $c->qty;
                    $sst->unit_price = $shelf->sale_price;
                    $sst->amount = $shelf->sale_price * $c->qty;
                    $sst->description = $shelf->positem->itemname;
                    if ($sst->save()) {
                        $available_qty = $shelf->total_qty - $c->qty;
                        $shelf->total_qty = $available_qty;
                        $shelf->update();
                        d21('Item name' . $sst->description . ' Qty ' . $c->qty . ' sale by ' . Yii::app()->user->getUsername() . ' On Dated ' . date('Y-m-d H:i:s'), "sale");
                        $debit_item_ledger = new Itemledger();
                        $debit_item_ledger->addDebitFrmShelf($itemid, "shelf", $sst->id, $c->qty, $shelf->total_qty);
                    }
                }
            }
//      print_r($cart);
//      exit();
            unset($_SESSION['pos_cart']);
//            $this->redirect(array('ots_items'));
            //      echo CJSON::encode(array('invoice_no' => $ss->invoice_number,'msg'=>'success'));
            echo "Invoice#-" . $ss->invoice_number;
            exit();
        }

        $items = ShelfSale::model()->findAllByAttributes(array('txn_type' => 'cash'), array(
            'order' => 'id desc',
            'limit' => 15
        ));


        $hot_items = Yii::app()->db->createCommand()
                ->select('pi.id,si.item_id,pi.itemname as item,si.qty,si.unit_price')
                ->from('off_shelf_sale_items si')
                ->join('purchase_item pi', 'pi.id=si.item_id')
                ->group('si.item_id')
                ->order('si.id desc')
                ->limit('8')
                ->queryAll();

        $this->render('ots_items', array('items' => $items, 'hot_items' => $hot_items, 'memo_no' => $memo_no));
    }

    public function actionCancelorder() {
        unset($_SESSION['pos_cart']);
        $this->redirect(array('ots_items'));
    }

    public function actionIndex() {
        //      unset($_SESSION['pos_cart']);
        $cart_items = unserialize(Yii::app()->session['item_cart']);
        PosCart::removeAll();
        $this->render('ots_items', array('cart_items' => $cart_items));
    }

    public function actionMenu_items() {
        $cart_items = '';
        $menu_categories = Purchasecategory::model()->findAllByAttributes(array('type' => 'Menu'));
        $this->render('menu_items', array('menu_categories' => $menu_categories, 'cart_items' => $cart_items));
    }

    public function actionAos_items() {
        $this->render('aos_items');
    }

    public function actionAuthenticate() {
        $this->layout = 'pos_front_layout';
        $cash_drawer = Cashdrawer::model()->findByAttributes(array('date' => date('Y-m-d'), 'user_to' => Yii::app()->user->id), array('order' => 'id desc', 'limit' => 1));
        if (!empty($cash_drawer)) {
//            echo Yii::app()->user->id;
//            echo '<br/>';
//            echo $cash_drawer->user_to;
            if ($cash_drawer->user_to == Yii::app()->user->id) {
                $this->render('received', array('cash_drawer' => $cash_drawer));
            } else {
                $this->layout = 'pos_front_layout';
                $this->render('authenticate');
            }
        } else if (empty($cash_drawer)) {
            $this->layout = 'pos_front_layout';
            $this->render('authenticate');
        }
    }

    public function actionGetCats() {
        $menu_categories = Purchasecategory::model()->findAllByAttributes(array('type' => 'Menu'));
        echo CJSON::encode(array('cats' => $menu_categories));
    }

    public function actionGetSubcats() {
        $model = Purchasecategory::model()->findByPk($_GET['cat']);
        $subcats = Purchasesubcategory::model()->findAllByAttributes(array('category_id' => $_GET['cat']));
        echo CJSON::encode(array('subcats' => $subcats, 'category' => $model->name));
    }

    public function actionGetMenuItems() {
        $cat = Purchasecategory::model()->findByPk($_GET['cat']);
        $subcat = Purchasesubcategory::model()->findByPk($_GET['sub_cat']);
        $menu = Menuitems::model()->findAllByAttributes(array('p_category_id' => $_GET['cat'], 'p_sub_category_id' => $_GET['sub_cat']));
        if (empty($menu))
            $msg = 'no';
        else
            $msg = 'yes';
        echo CJSON::encode(array('menu' => $menu,
            'cat_name' => $cat->name,
            'subcat_name' => $subcat->name,
            'msg' => $msg
        ));
    }

    public function actionGetSearchItems() {
        $item = $_GET['itemname'];
        $match = addcslashes($item, '%_'); // escape LIKE's special characters
        $q = new CDbCriteria(array(
            'condition' => "itemname LIKE :match", // no quotes around :match
            'params' => array(':match' => "%$match%")  // Aha! Wildcards go here
        ));

        $menu = Menuitems::model()->findAll($q);
        if (empty($menu))
            $msg = 'no';
        else
            $msg = 'yes';

        echo CJSON::encode(array('menu' => $menu,
            'msg' => $msg
        ));
    }

    public function actionNewentry() {
        unset($_SESSION['cart']);
        $this->render('index');
    }

    public function actionResetentry() {
        unset($_SESSION['cart']);
        $this->render('index');
    }

    public function actionCartdetails() {
        $show = Shoping::getAll();
        $this->renderPartial('_cartitems', array(
            'list' => $show));
    }

    public function actionTakeorders() {
        $id = $_GET['itemid'];
        //$mitem = Cakeaddons::model()->findByPk($id);
        //$mid = $mitem->id;
        if (!empty($_GET['itemid'])) {
            if (Shoping::checkExists($_GET['itemid'])) {
                
            } else {
                $shop = new Shoping();
                $shop->booksid = $_GET['itemid'];
                $shop->gprice = $_GET['rate'];
                if ($_GET['qty'] == 0) {
                    $shop->qty = 1;
                } else {
                    $shop->qty = $_GET['qty'];
                }
                Shoping::addtocart($shop);
            }
        }
    }

    public function actionAjaxdelete() {
        Shoping::remove(Yii::app()->request->getPost('id'));
    }

}
