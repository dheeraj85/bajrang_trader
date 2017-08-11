<?php

class SupplyController extends Controller {

    public $active_menu = '';
    public $active_class = '';
    public $open_class = '';
    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
                //'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array(''),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('viewIndents', 'index', 'indentitems', 'getStockItem', 'saveAllotedStock', 'reviewIndents', 'updateOrderStatus',
                    'reviewindentitems', 'invoice', 'viewstock', 'viewprint', 'getItems', 'generateInvoice', 'getDispatchItem', 'stockUpdate', 'transfershelf'
                    , 'getItemStockForPOS', 'saveDirectDispatchStock', 'exportdispatchlist'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionStockUpdate() {

        $this->render('stockUpdate', array(
            'model' => $model,
        ));
    }

    public function actionViewprint() {
        $this->active_menu = "cds";
        $this->open_class = "viewindent_open";
        $this->active_class = "indent_invoice";
        $model = new Indentmaster();
        $indent_id = $_GET['sync_id'];
        $msg = 'Fail';
        if (!empty($indent_id)) {
            $model = Indentmaster::model()->findByAttributes(array('sync_id' => $indent_id));
            if (empty($model->invoice_id)) {
                $model->invoice_id = $model->id;
                $model->challan_no = $model->id;
                $model->invoice_date = date('Y-m-d');
                $model->save();
            }
        }
        $this->render('viewprint', array(
            'model' => $model,
        ));
    }

    public function actionGetItems() {
        $subcat_id = $_GET['subcat_id'];
        $cat_id = $_GET['cat_id'];

        $sql = "SELECT pi.itemname, pi.brand, pi.item_scale, pi.specification, pi.low_qty, SUM( ist.stock_qty ) AS stock
FROM purchase_item pi, item_stock ist
WHERE ist.item_id = pi.id
AND pi.p_sub_category_id =$subcat_id
GROUP BY ist.item_id";
        $items = Yii::app()->db->createCommand($sql)->queryAll();

        echo CJSON::encode(array('data' => $items));
        exit();
    }

    public function actionViewstock() {
               $this->active_menu = "cds";
        $this->open_class = "cds";
        $this->active_class = "view_stock";
        $categories = Purchasecategory::model()->findAll();
        $subCats_Purchase = "";
        $subCats_Processed = "";
        $subCats_Resale = "";
        $subCats = "";
        $cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] : '';
        if (!empty($cat_id)) {
            $subCats_Purchase = Purchasesubcategory::model()->findAllByAttributes(array('category_id' => $cat_id, 'type' => 'Purchase'));
            $subCats_Processed = Purchasesubcategory::model()->findAllByAttributes(array('category_id' => $cat_id, 'type' => 'Processed'));
            $subCats_Resale = Purchasesubcategory::model()->findAllByAttributes(array('category_id' => $cat_id, 'type' => 'Resale'));
        }
        $this->render('viewstock', array(
            'categories' => $categories,
            'subCats_Purchase' => $subCats_Purchase,
            'subCats_Processed' => $subCats_Processed,
            'subCats_Resale' => $subCats_Resale,
            'cat_id' => $cat_id
        ));
    }

    public function actionTransfershelf() {
        $this->active_menu = "cds";
        $this->open_class = "";
        $this->active_class = "transfer_shelf";
        $model = new Shelfitems('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Shelfitems']))
            $model->attributes = $_GET['Shelfitems'];
        $this->render('transfershelf', array(
            'model' => $model,
        ));
    }

    public function actionExportdispatchlist() {
        $this->active_menu = "cds";
        $this->open_class = "";
        $this->active_class = "transfer_shelf";
        $model = new Shelfitems();
        $this->render('exportdispatchlist', array(
            'model' => $model,
        ));
    }

    public function actionGetItemStockForPOS() {
        //item_id=12&id=11
        $item = $_GET['item_id'];
        $item_master = Purchaseitem::model()->findByPk($item);
        $item_total_stk = Itemstock::model()->findBySql("Select sum(stock_qty) as stock_qty from item_stock where item_id=$item");
        //query with store
        //select istk.id,pi.itemname,pi.brand,pi.specification,istk.stock_qty,istk.stock_taking_scale,istk.rate,istk.amount,istk.make_date,istk.ready_date,istk.discard_date,st_str.name as name from item_stock as istk, purchase_item as pi, stock_store as st_str where istk.item_id=2 and istk.item_id=pi.id and st_str.id=istk.store_id order by istk.make_date asc
        $sql = "select istk.id,istk.invoice_id,pi.itemname,pi.brand,pi.specification,istk.stock_qty,istk.stock_taking_scale,istk.rate,istk.amount,istk.make_date,"
                . "istk.ready_date,istk.discard_date from item_stock as istk, purchase_item as pi  where istk.item_id=$item and istk.item_id=pi.id order by istk.make_date asc";
        $list = Yii::app()->db->createCommand($sql)->queryAll();
        $avail_stock = array();
        foreach ($list as $data) {
            if ($data['stock_qty'] > 0) {
                $items = array();
                $item_stock = Itemstock::model()->findByPk($data['invoice_id']);
                $invoice_item = Purchaseinvoiceitems::model()->findByAttributes(array('invoice_id' => $item_stock->invoice_id, 'item_id' => $item_stock->item_id));
                $item_taxes = Invoiceitemtax::model()->findAllByAttributes(array('invoice_item_id' => $invoice_item->id));
                $taxes = "";
                foreach ($item_taxes as $it) {
                    $taxes .=$it->label . " - " . $it->tax_percent . "%  ";
                }
//                $interal_stock = InternalStock::model()->findByAttributes(array('item_stock_id' => $data['id']));
//                if (!empty($interal_stock)) {
//                    $items['new_rate'] = $interal_stock->rate;
//                    $items['new_tax'] = $interal_stock->tax;
//                    $items['new_qty'] = $interal_stock->stock_qty;
//                }
                //  print_r($taxes);
                //  echo "<br/>";
                $items['id'] = $data['id'];
                $items['itemname'] = $data['itemname'];
                $items['brand'] = $data['brand'];
                $items['stock_qty'] = $data['stock_qty'];
                $items['scale'] = $data['stock_taking_scale'];
                $items['rate'] = $data['rate'];
                $items['tax'] = $taxes;
                $items['amount'] = $data['amount'];
                $items['make_date'] = $data['make_date'];
                $items['ready_date'] = $data['ready_date'];
                $items['discard_date'] = $data['discard_date'];
                $avail_stock[] = $items;
            }
        }
        echo CJSON::encode(array('item_stock' => $avail_stock, 'item_total' => array('item_name' => $item_master->itemname, 'stock_qty' => $item_total_stk->stock_qty)));
    }

    public function actionSaveDirectDispatchStock() {
//        print_r($_POST);
//        echo "worked";
        $stock_id = $_POST['stock_id'];
        $dispatch_qty = $_POST['dispatch_qty'];
        $item_id = $_POST['item_id'];
        $msg = "Fail";
        if (!empty($stock_id) && !empty($dispatch_qty)) {
            $stock = Itemstock::model()->findByPk($stock_id);
            $item = Purchaseitem::model()->findByPk($item_id);
//            $stock->stock_qty = $stock->stock_qty - $dispatch_qty;
//            $indent_item->qty_dispatch = $indent_item->qty_dispatch + $dispatch_qty;
            //   if ($indent_item->qty_dispatch <= $indent_item->qty_required) {
            //echo $stock->stock_qty;       
            $internal_stock = new InternalStock();
            $internal_stock->indent_item_id = 0;
            $internal_stock->item_stock_id = 0;
            $internal_stock->user_id = 0;
            $internal_stock->p_category_id = $item->p_category_id;
            $internal_stock->p_sub_category_id = $item->p_sub_category_id;
            $internal_stock->item_id = $item->id;
            $internal_stock->item_name = $item->itemname;
            $internal_stock->item_brand = $item->brand;
            $internal_stock->stock_qty = $dispatch_qty;
            $internal_stock->stock_taking_scale = $item->item_scale;
            $internal_stock->rate = 0.00;
            $internal_stock->tax = 0.00;
            $internal_stock->amount = 0.00;
            $internal_stock->is_mrd = $stock->is_mrd;
            $internal_stock->mrd_no = $stock->mrd_no;
            $internal_stock->make_date = $stock->make_date;
            $internal_stock->ready_date = $stock->ready_date;
            $internal_stock->ready_date = $stock->ready_date;
            $internal_stock->discard_date = $stock->discard_date;
            $internal_stock->schedule_date = $stock->schedule_date;
            $internal_stock->discard_date = date('Y-m-d');
            $internal_stock->save();
            // print_r($internal_stock->attributes);
            $stock->stock_qty = $stock->stock_qty - $dispatch_qty;  //update main stock qty
            $stock->update();
            $shelf_item = Shelfitems::model()->findByAttributes(array('item_id' => $item->id));
            $shelf_item->total_qty = $shelf_item->total_qty + $dispatch_qty;
            Shelfitems::model()->updateByPk($shelf_item->id, array("total_qty" => $shelf_item->total_qty));
            //print_r($shelf_item->attributes);
            $shelf_item->update();
            $msg = "Success";
            // insert record into item ledger for debit 
            $debit_item_ledger = new Itemledger();
            $debit_item_ledger->addDebitInLedgerOnDispatch($item->id, 'main', $stock_id, $dispatch_qty);
            // insert record into item ledger for internal stock update 
            $credit_item_ledger = new Itemledger();
            $credit_item_ledger->addCreditInLedgerOnInternalStockUpdate($item->id, 'internal', $internal_stock->id, $dispatch_qty);


//            } else {
//                $msg = "less_stock";
//            }
        }
        echo CJSON::encode(array('msg' => $msg));
    }

    public function actionInvoice() {
        $this->active_menu = "cds";
        $this->open_class = "viewindent_open";
        $this->active_class = "indent_invoice";

        $model = new Indentmaster('searchCDS');

        $model->unsetAttributes();  // clear any default values       

        if (isset($_GET['Indentmaster']))
            $model->attributes = $_GET['Indentmaster'];
        $model->is_order_done = 2;
        $this->render('invoice', array(
            'model' => $model,
        ));
    }

    public function actionUpdateOrderStatus() {
        $indent_id = $_GET['indent_id'];
        $status = isset($_GET['status']) ? $_GET['status'] : '';
        $msg = 'Fail';
        if (!empty($indent_id)) {
            $im = Indentmaster::model()->findByAttributes(array('sync_id' => $indent_id));
            $im->is_order_done = $status;
            if ($status == 2) {
                $im->issued_by = Yii::app()->user->id;
            }
            $im->update();
            $msg = 'Success';
        }
        echo CJSON::encode(array('msg' => $msg));
    }

    public function actionSaveAllotedStock() {
//        print_r($_POST);
//        echo "worked";
        $stock_id = $_POST['stock_id'];
        $dispatch_qty = $_POST['dispatch_qty'];
        $indent_id = $_POST['indent_id'];
        $sale_price = $_POST['sale_price'];
        $new_tax = $_POST['new_tax'];
        $msg = "Fail";
        if (!empty($stock_id) && !empty($dispatch_qty) && !empty($indent_id)) {
            $stock = Itemstock::model()->findByPk($stock_id);
            $indent_item = Indentitems::model()->findByPk($indent_id);
            $stock->stock_qty = $stock->stock_qty - $dispatch_qty;
            $indent_item->qty_dispatch = $indent_item->qty_dispatch + $dispatch_qty;
            //   if ($indent_item->qty_dispatch <= $indent_item->qty_required) {
            //echo $stock->stock_qty;          

            $indent_item->dispatch_date = date('Y-m-d');
            $indent_item->rate = $stock->rate;
            $internal_stock = InternalStock::model()->findByAttributes(array('item_stock_id' => $stock_id, 'indent_item_id' => $indent_id));
            if (!empty($internal_stock)) {
                //  $internal_stock=InternalStock::model()->findByAttributes(array('item_stock_id'=>$stock_id,'indent_item_id'=>$item_id));
                $internal_stock->stock_qty = $internal_stock->stock_qty + $dispatch_qty;
                $internal_stock->amount = $internal_stock->stock_qty * $internal_stock->rate;
                $internal_stock->update();
            } else {
                $internal_stock = new InternalStock();
                $internal_stock->indent_item_id = $indent_item->id;
                $internal_stock->item_stock_id = $stock_id;
                $internal_stock->user_id = $indent_item->created_by;
                $internal_stock->p_category_id = $indent_item->p_category_id;
                $internal_stock->p_sub_category_id = $indent_item->p_sub_category_id;
                $internal_stock->item_id = $indent_item->item_id;
                $internal_stock->item_name = $indent_item->item_name;
                $internal_stock->item_brand = $indent_item->item_brand;
                $internal_stock->stock_qty = $dispatch_qty;
                $internal_stock->stock_taking_scale = $indent_item->qty_scale;
                $internal_stock->rate = $sale_price;
                $internal_stock->tax = $new_tax;
                $tax = ($stock->rate * $new_tax) / 100;
                $internal_stock->amount = $dispatch_qty * $stock->rate + $tax;
                $internal_stock->is_mrd = $stock->is_mrd;
                $internal_stock->mrd_no = $stock->mrd_no;
                $internal_stock->make_date = $stock->make_date;
                $internal_stock->ready_date = $stock->ready_date;
                $internal_stock->ready_date = $stock->ready_date;
                $internal_stock->discard_date = $stock->discard_date;
                $internal_stock->schedule_date = $stock->schedule_date;
                $internal_stock->discard_date = date('Y-m-d');
                $internal_stock->save();
            }
            // print_r($internal_stock->attributes);
            $stock->update();
            $indent_item->update();
            $msg = "Success";
//            } else {
//                $msg = "less_stock";
//            }
        }
        echo CJSON::encode(array('msg' => $msg));
    }

    public function actionGetDispatchItem() {
        $item = $_GET['item_id'];
        $id = $_GET['id'];
        //fetch last 10 records by order  by dispatch_date 
        echo CJSON::encode(array('item_stock' => $avail_stock, 'indent_item' => $indent_item));
    }

    public function actionGetStockItem() {
        //item_id=12&id=11
        $item = $_GET['item_id'];
        $id = $_GET['id'];
        $indent_item = Indentitems::model()->findByPk($id);
        //query with store
        //select istk.id,pi.itemname,pi.brand,pi.specification,istk.stock_qty,istk.stock_taking_scale,istk.rate,istk.amount,istk.make_date,istk.ready_date,istk.discard_date,st_str.name as name from item_stock as istk, purchase_item as pi, stock_store as st_str where istk.item_id=2 and istk.item_id=pi.id and st_str.id=istk.store_id order by istk.make_date asc
        $sql = "select istk.id,istk.invoice_id,pi.itemname,pi.brand,pi.specification,istk.stock_qty,istk.stock_taking_scale,istk.rate,istk.amount,istk.make_date,"
                . "istk.ready_date,istk.discard_date from item_stock as istk, purchase_item as pi  where istk.item_id=$item and istk.item_id=pi.id order by istk.make_date asc";
        $list = Yii::app()->db->createCommand($sql)->queryAll();
        $avail_stock = array();
        foreach ($list as $data) {
            if ($data['stock_qty'] > 0 && !empty($data['invoice_id'])) {
                $items = array();
                $item_stock = Itemstock::model()->findByPk($data['id']);
                $invoice_item = Purchaseinvoiceitems::model()->findByAttributes(array('invoice_id' => $item_stock->invoice_id, 'item_id' => $item_stock->item_id));
                //echo $invoice_item->id;
                $item_taxes = Invoiceitemtax::model()->findAllByAttributes(array('invoice_item_id' => $invoice_item->id));
                 //addin new to show invoice id ,vendor and price to show in internal sale dt 20-06-2017
                
                $pi_data = Purchaseinvoice::model()->findByPk($data['invoice_id']);
                $items['invoice_no'] = $pi_data->invoice_no; 
                if (!empty($pi_data->vendor_name)) {
                    $items['vendor'] = $pi_data->vendor_name;
                } else {
                    if (isset($pi_data->vendor->name)) {
                        $items['vendor'] = $pi_data->vendor->name . " ( " . $pi_data->vendor->firm_name . " )";
                    }
                }

                $items['rate'] = $data['rate'];
                $taxes = "";
                $item_price = 0.00;
                foreach ($item_taxes as $it) {
                    $taxes .=$it->label . " - " . $it->tax_percent . "%  ";
                    $price_with_tax = $data['rate'] * $it->tax_percent / 100;
                    $item_price = $item_price + isset($price_with_tax) ? $price_with_tax : 0.00;
                }
                $items['price'] = $data['rate']+round($item_price,2);
//                $interal_stock = InternalStock::model()->findByAttributes(array('item_stock_id' => $data['id']));
//                if (!empty($interal_stock)) {
//                    $items['new_rate'] = $interal_stock->rate;
//                    $items['new_tax'] = $interal_stock->tax;
//                    $items['new_qty'] = $interal_stock->stock_qty;
//                }
                //  print_r($taxes);
                //  echo "<br/>";
                $items['id'] = $data['id'];
                $items['itemname'] = $data['itemname'];
                $items['brand'] = $data['brand'];
                $items['stock_qty'] = $data['stock_qty'];
                $items['scale'] = $data['stock_taking_scale'];
                $items['rate'] = $data['rate'];
                $items['tax'] = $taxes;
                $items['amount'] = $data['amount'];
                $items['make_date'] = $data['make_date'];
                $items['ready_date'] = $data['ready_date'];
                $items['discard_date'] = $data['discard_date'];
                $avail_stock[] = $items;
            }
        }
        echo CJSON::encode(array('item_stock' => $avail_stock, 'indent_item' => $indent_item));
    }

    public function actionIndentitems() {
        $this->active_menu = "cds";
        $this->open_class = "viewindent_open";
        $this->active_class = "viewindent_active";
        $model = Indentmaster::model()->findByAttributes(array('sync_id' => $_GET['sync_id']));
        $this->render('indentitems', array(
            'model' => $model,
        ));
    }

    public function actionReviewindentitems() {
        $this->active_menu = "cds";
        $this->open_class = "viewindent_open";
        $this->active_class = "review_indent";
        $model = Indentmaster::model()->findByAttributes(array('sync_id' => $_GET['sync_id']));
        $this->render('reviewindentitems', array(
            'model' => $model,
        ));
    }

    public function actionIndex() {
        $this->active_menu = "cds";
        $this->open_class = "viewindent_open";
        $this->active_class = "eindex";
        $this->render('index');
    }

    public function actionViewIndents() {
        $this->active_menu = "cds";
        $this->open_class = "viewindent_open";
        $this->active_class = "viewindent_active";

        $model = new Indentmaster('searchCDS');

        $model->unsetAttributes();  // clear any default values       
        $model->is_order_done = 0;
        if (isset($_GET['Indentmaster']))
            $model->attributes = $_GET['Indentmaster'];
        $this->render('viewIndents', array(
            'model' => $model,
        ));
    }

    public function actionReviewIndents() {
        $this->active_menu = "cds";
        $this->open_class = "viewindent_open";
        $this->active_class = "review_indent";

        $model = new Indentmaster('searchCDS');
        $model->unsetAttributes();  // clear any default values
        $model->is_order_done = 1;
        if (isset($_GET['Indentmaster']))
            $model->attributes = $_GET['Indentmaster'];
        $this->render('reviewIndents', array(
            'model' => $model,
        ));
    }

}
