<?php

class ReportsController extends Controller {

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
                'actions' => array('freshstock', 'vendorpayment', 'attendance', 'purchaserawmaterial', 'salesitem',
                    'getvendorlist', 'getitemlist', 'smsreport', 'checkreportsend', 'sendsmsreport', 'expenses',
                    'purchaseindent', 'goodsreturn', 'salesbill', 'getitems', 'salesitemwise','gstformat','gstformat1'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'sales', 'cash', 'itemwisesales', 'todaysales'),
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

    public function actionGstformat() {
        $this->active_menu = "gst";
        $this->open_class = "gst";
        $this->active_class = "gstformat";
        $this->render('gstformat');
    }
    
    public function actionSalesitemwise() {
        $this->active_menu = "reports";
        $this->open_class = "reports";
        $this->active_class = "salesitemwise";
        $data = "";
        $time_from = "";
        $time_to = "";
        $type = "";
        if (Yii::app()->request->isPostRequest) {
            $type = $_POST['type'];
            $time_from = $_POST['time_from'];
            $time_to = $_POST['time_to'];
            if ($type == "selfitem") {
               $sql = "select osi.description as name,sum(osi.qty) as qty,sum(osi.amount) as amount
from off_shelf_sale_items osi 
join off_shelf_sale os ON os.id=osi.shelf_sale_id
where os.order_date between '$time_from' and '$time_to'
group by osi.item_id";
            } else {
                $sql = "select msi.item_id,sum(msi.qty) as qty, sum(msi.amount) as amount,p.itemname as name
from menu_sale_items msi 
join purchase_item p ON p.id=msi.item_id
join menu_sale ms ON msi.menu_sale_id=ms.id
where ms.order_date between '$time_from' and '$time_to'
group by msi.item_id";
            }
            //   exit();
            $data = Yii::app()->db->createCommand($sql)->queryAll();
        }
        $this->render('salesitemwise', array(
            'data' => $data,
            'time_from' => $time_from,
            'time_to' => $time_to,
            'type' => $type,
        ));
    }

    public function actionSalesitem() {
        $this->active_menu = "reports";
        $this->open_class = "reports";
        $this->active_class = "salesitem";

        if (isset($_POST['filter_date_start'])) {
            $filter_date_start = $_POST['filter_date_start'];
        } else {
            $filter_date_start = date('Y-m-d', strtotime(date('Y') . '-' . date('m') . '-01'));
        }

        if (isset($_POST['filter_date_end'])) {
            $filter_date_end = $_POST['filter_date_end'];
        } else {
            $filter_date_end = date('Y-m-d');
        }

        if (isset($_POST['choice_item'])) {
            $choice_item = $_POST['choice_item'];
        }
        if (isset($_POST['item_id'])) {
            $item_id = $_POST['item_id'];
        }

        $report = new Reports;

        $data['data'] = array();

        $filter_data = array(
            'choice_item' => $choice_item,
            'item_id' => $item_id,
            'filter_date_start' => $filter_date_start,
            'filter_date_end' => $filter_date_end,
            // 'filter_order_status_id' => $filter_order_status_id,
            'start' => ($page - 1) * 5,
            'limit' => 5
        );

        $results = $report->getsalesitem($filter_data);
        if (!empty($results)) {
            foreach ($results as $result) {
                $data['data'][] = array(
                    'invoice_number' => $result['invoice_number'],
                    'orderdate' => $result['orderdate'],
                    'time' => $result['time'],
                    'amount' => $result['amount'],
                    'description' => $result['description'],
                    'item_name' => $result['item_name'],
                    'brand' => $result['brand'],
                    'stock_qty' => $result['stock_qty'],
                );
            }
        } else {
            $data['text_no_results'] = 'No Result Found';
        }
        if (isset($_POST['choice_item'])) {
            $url .= '&choice_item=' . $_POST['choice_item'];
        }
        if (isset($_POST['item_id'])) {
            $url .= '&item_id=' . $_POST['item_id'];
        }
        if (isset($_POST['filter_date_start'])) {
            $url .= '&filter_date_start=' . $_POST['filter_date_start'];
        }
        if (isset($_POST['filter_date_end'])) {
            $url .= '&filter_date_end=' . $_POST['filter_date_end'];
        }
        $data['results'] = $data['text_no_results'];
        $data['filter_date_start'] = $filter_date_start;
        $data['filter_date_end'] = $filter_date_end;
        $data['choice_item'] = $choice_item;
        $data['item_id'] = $item_id;
        $this->render('salesitem', array(
            'data' => $data,
        ));
    }

    public function actionGetitems() {
        $cid = Yii::app()->request->getParam('cid');
        $scid = Yii::app()->request->getParam('scid');
        //$type = Yii::app()->request->getParam('type');
        $list = Purchaseitem::model()->findAllByAttributes(array('p_category_id' => $cid, 'p_sub_category_id' => $scid));
        echo CJSON::encode(array('items' => $list));
    }

    public function actionGetitemlist() {
        if (Yii::app()->request->getParam('type') == "selfitem") {
            $sql = "select si.item_id as id,i.itemname as itemname,i.brand as brand from shelf_items si,purchase_item i where si.item_id=i.id";
        } else {
            $sql = "select mi.item_id as id,i.itemname as itemname,i.brand as brand from menu_items mi,purchase_item i where mi.item_id=i.id";
        }
        $query = Yii::app()->db->createCommand("$sql")->queryAll();
        echo CJSON::encode(array('items' => $query));
    }

    //added by dheeraj dt 29-04-2017 
    public function actionFindItemWiseList() {
        $type = Yii::app()->request->getParam('type');
        $time_from = Yii::app()->request->getParam('time_from');
        $time_to = Yii::app()->request->getParam('time_to');
        if ($type == "shelfitem") {
            $sql = "select si.item_id as id,i.itemname as itemname,i.brand as brand from shelf_items si,purchase_item i where si.item_id=i.id";
        } else {
            $sql = "select mi.item_id as id,i.itemname as itemname,i.brand as brand from menu_items mi,purchase_item i where mi.item_id=i.id";
        }
        $query = Yii::app()->db->createCommand("$sql")->queryAll();
        echo CJSON::encode(array('items' => $query));
    }

    public function actionPurchaserawmaterial() {
         $page=0;
         $choice_item='';
        $this->active_menu = "reports";
        $this->open_class = "reports";
        $this->active_class = "rawmaterial";

        if (isset($_POST['filter_date_start'])) {
            $filter_date_start = $_POST['filter_date_start'];
        } else {
            $filter_date_start = date('Y-m-d', strtotime(date('Y') . '-' . date('m') . '-01'));
        }

        if (isset($_POST['filter_date_end'])) {
            $filter_date_end = $_POST['filter_date_end'];
        } else {
            $filter_date_end = date('Y-m-d');
        }

        if (isset($_POST['choice_item'])) {
            $choice_item = $_POST['choice_item'];
        }
        if (isset($_POST['p_category_id'])) {
            $p_category_id = $_POST['p_category_id'];
        }
        if (isset($_POST['p_sub_category_id'])) {
            $p_sub_category_id = $_POST['p_sub_category_id'];
        }
        if (isset($_POST['item_id'])) {
            $item_id = $_POST['item_id'];
        }

        $report = new Reports;

        $data['data'] = array();
       
        $filter_data = array(
            'choice_item' => $choice_item,
            'p_category_id' => $p_category_id,
            'p_sub_category_id' => $p_sub_category_id,
            'item_id' => $item_id,
            'filter_date_start' => $filter_date_start,
            'filter_date_end' => $filter_date_end,
            // 'filter_order_status_id' => $filter_order_status_id,
            'start' => ($page - 1) * 5,
            'limit' => 5
        );

        $results = $report->getrawmaterial($filter_data);
        if (!empty($results)) {
            foreach ($results as $result) {
                $data['data'][] = array(
                    //'date_start' => date('d/m/Y', strtotime($result['dated'])),
                    //'date_end' => date('d/m/Y', strtotime($result['date_end'])),                    
                    'invoice_id' => $result['invoice_id'],
                    'invoice_no' => $result['invoice_no'],
                    'invoice_date' => $result['invoice_date'],
                    'category' => $result['category'],
                    'scategory' => $result['scategory'],
                    'item_name' => $result['item_name'],
                    'vendorinfo' => $result['vendorinfo'],
                    'brand' => $result['brand'],
                    'stock_qty' => $result['stock_qty'],
                    'rate' => $result['rate'],
                    'amount' => $result['amount'],
                    'scale' => $result['scale'],
                    'item_id' => $result['item_id'],
                        //'discard_date' => $result['discard_date']
                );
            }
        } else {
            $data['text_no_results'] = 'No Result Found';
        }
        if (isset($_POST['choice_item'])) {
            $url .= '&choice_item=' . $_POST['choice_item'];
        }
        if (isset($_POST['p_category_id'])) {
            $url .= '&p_category_id=' . $_POST['p_category_id'];
        }
        if (isset($_POST['p_sub_category_id'])) {
            $url .= '&p_sub_category_id=' . $_POST['p_sub_category_id'];
        }
        if (isset($_POST['item_id'])) {
            $url .= '&item_id=' . $_POST['item_id'];
        }
        if (isset($_POST['filter_date_start'])) {
            $url .= '&filter_date_start=' . $_POST['filter_date_start'];
        }
        if (isset($_POST['filter_date_end'])) {
            $url .= '&filter_date_end=' . $_POST['filter_date_end'];
        }
        $data['results'] = $data['text_no_results'];
        $data['filter_date_start'] = $filter_date_start;
        $data['filter_date_end'] = $filter_date_end;
        $data['p_category_id'] = $p_category_id;
        $data['p_sub_category_id'] = $p_sub_category_id;
        $data['item_id'] = $item_id;
        $this->render('purchaserawmaterial', array(
            'data' => $data,
        ));
    }

//    public function actionSalesitem() {
//        $this->active_menu = "reports";
//        $this->open_class = "reports";
//        $this->active_class = "salesitem";    
//        
//        if (isset($_POST['filter_date_start'])) {
//            $filter_date_start = $_POST['filter_date_start'];
//        } else {
//            $filter_date_start = date('Y-m-d', strtotime(date('Y') . '-' . date('m') . '-01'));
//        }
//
//        if (isset($_POST['filter_date_end'])) {
//            $filter_date_end = $_POST['filter_date_end'];
//        } else {
//            $filter_date_end = date('Y-m-d');
//        }
//
//        if (isset($_POST['choice_item'])) {
//            $choice_item =$_POST['choice_item'];
//        }
//        if (isset($_POST['item_id'])) {
//            $item_id = $_POST['item_id'];
//        }
//
//        $report = new Reports;
//
//        $data['data'] = array();
//
//        $filter_data = array(
//            'choice_item' => $choice_item,
//            'item_id' => $item_id,
//            'filter_date_start' => $filter_date_start,
//            'filter_date_end' => $filter_date_end,
//            // 'filter_order_status_id' => $filter_order_status_id,
//            'start' => ($page - 1) * 5,
//            'limit' => 5
//        );
//
//        $results = $report->getsalesitem($filter_data);
//        if (!empty($results)) {
//            foreach ($results as $result) {
//                $data['data'][] = array(
//                    'invoice_number'=>$result['invoice_number'],
//                    'orderdate'=>$result['orderdate'],
//                    'time'=>$result['time'],
//                    'amount' => $result['amount'],
//                    'description' => $result['description'],
//                    'item_name' => $result['item_name'],
//                    'brand' => $result['brand'],
//                    'stock_qty' => $result['stock_qty'],
//                );
//            }
//        } else {
//            $data['text_no_results'] = 'No Result Found';
//        }
//        if (isset($_POST['choice_item'])) {
//            $url .= '&choice_item=' . $_POST['choice_item'];
//        }
//        if (isset($_POST['item_id'])) {
//            $url .= '&item_id=' . $_POST['item_id'];
//        }
//        if (isset($_POST['filter_date_start'])) {
//            $url .= '&filter_date_start=' . $_POST['filter_date_start'];
//        }
//        if (isset($_POST['filter_date_end'])) {
//            $url .= '&filter_date_end=' . $_POST['filter_date_end'];
//        }
//        $data['results'] = $data['text_no_results'];
//        $data['filter_date_start'] = $filter_date_start;
//        $data['filter_date_end'] = $filter_date_end;
//        $data['choice_item'] = $choice_item;
//        $data['item_id'] = $item_id;
//        $this->render('salesitem', array(
//            'data' => $data,
//        ));
//    }


    public function actionSalesbill() {
        $this->active_menu = "reports";
        $this->open_class = "reports";
        $this->active_class = "salesitem";

        if (isset($_POST['filter_date_start'])) {
            $filter_date_start = $_POST['filter_date_start'];
        } else {
            $filter_date_start = date('Y-m-d', strtotime(date('Y') . '-' . date('m') . '-01'));
        }

        if (isset($_POST['filter_date_end'])) {
            $filter_date_end = $_POST['filter_date_end'];
        } else {
            $filter_date_end = date('Y-m-d');
        }

        if (isset($_POST['choice_item'])) {
            $choice_item = $_POST['choice_item'];
        }

        $report = new Reports;

        $data['data'] = array();

        $filter_data = array(
            'choice_item' => $choice_item,
            'filter_date_start' => $filter_date_start,
            'filter_date_end' => $filter_date_end,
            // 'filter_order_status_id' => $filter_order_status_id,
            'start' => ($page - 1) * 5,
            'limit' => 5
        );

        $results = $report->getsalesbill($filter_data);
        if (!empty($results)) {
            foreach ($results as $result) {
                $data['data'][] = array(
                    'invoice_number' => $result['invoice_number'],
                    'orderdate' => $result['orderdate'],
                    'time' => $result['time'],
                    'amount' => $result['amount'],
                    //'id'=>$result['id'],
                    'txn_type' => $result['txn_type'],
                );
            }
        } else {
            $data['text_no_results'] = 'No Result Found';
        }
        if (isset($_POST['choice_item'])) {
            $url .= '&choice_item=' . $_POST['choice_item'];
        }
        if (isset($_POST['filter_date_start'])) {
            $url .= '&filter_date_start=' . $_POST['filter_date_start'];
        }
        if (isset($_POST['filter_date_end'])) {
            $url .= '&filter_date_end=' . $_POST['filter_date_end'];
        }
        $data['results'] = $data['text_no_results'];
        $data['filter_date_start'] = $filter_date_start;
        $data['filter_date_end'] = $filter_date_end;
        $data['choice_item'] = $choice_item;
        $this->render('salesbill', array(
            'data' => $data,
        ));
    }

    public function actionGoodsreturn() {
        $this->active_menu = "reports";
        $this->open_class = "reports";
        $this->active_class = "goodsreturn";

        if (isset($_POST['filter_date_start'])) {
            $filter_date_start = $_POST['filter_date_start'];
        } else {
            $filter_date_start = date('Y-m-d', strtotime(date('Y') . '-' . date('m') . '-01'));
        }

        if (isset($_POST['filter_date_end'])) {
            $filter_date_end = $_POST['filter_date_end'];
        } else {
            $filter_date_end = date('Y-m-d');
        }

        $report = new Reports;
        $data['data'] = array();

        $filter_data = array(
            'filter_date_start' => $filter_date_start,
            'filter_date_end' => $filter_date_end,
            // 'filter_order_status_id' => $filter_order_status_id,
            'start' => ($page - 1) * 5,
            'limit' => 5
        );

        $results = $report->getgritem($filter_data);
        if (!empty($results)) {
            foreach ($results as $result) {
                $data['data'][] = array(
                    'amount' => $result['amount'],
                    'invoice_no' => $result['invoice_no'],
                    'item_name' => $result['item_name'],
                    'brand' => $result['brand'],
                    'stock_qty' => $result['stock_qty'],
                );
            }
        } else {
            $data['text_no_results'] = 'No Result Found';
        }
        if (isset($_POST['filter_date_start'])) {
            $url .= '&filter_date_start=' . $_POST['filter_date_start'];
        }
        if (isset($_POST['filter_date_end'])) {
            $url .= '&filter_date_end=' . $_POST['filter_date_end'];
        }
        $data['results'] = $data['text_no_results'];
        $data['filter_date_start'] = $filter_date_start;
        $data['filter_date_end'] = $filter_date_end;
        $this->render('goodsreturn', array(
            'data' => $data,
        ));
    }

    public function actionFreshstock() {
        $this->active_menu = "reports";
        $this->open_class = "reports";
        $this->active_class = "fresh";

        if (isset($_POST['filter_date_start'])) {
            $filter_date_start = $_POST['filter_date_start'];
        } else {
            $filter_date_start = date('Y-m-d', strtotime(date('Y') . '-' . date('m') . '-01'));
        }

        if (isset($_POST['filter_date_end'])) {
            $filter_date_end = $_POST['filter_date_end'];
        } else {
            $filter_date_end = date('Y-m-d');
        }

        if (isset($_POST['filter_date'])) {
            $url .= '&filter_date=' . $_POST['filter_date'];
        }

        $report = new Reports;

        $data['data'] = array();

        $filter_data = array(
            'filter_date_start' => $filter_date_start,
            'filter_date_end' => $filter_date_end,
            // 'filter_order_status_id' => $filter_order_status_id,
            'start' => ($page - 1) * 5,
            'limit' => 5
        );

        $results = $report->getfreshitem($filter_data);
        if (!empty($results)) {
            foreach ($results as $result) {
                $data['data'][] = array(
                    //'date_start' => date('d/m/Y', strtotime($result['dated'])),
                    //'date_end' => date('d/m/Y', strtotime($result['date_end'])),
                    'category' => $result['category'],
                    'scategory' => $result['scategory'],
                    'item_name' => $result['item_name'],
                    'brand' => $result['brand'],
                    'stock_qty' => $result['stock_qty'],
                    'discard_date' => $result['discard_date']
                );
            }
        } else {
            $data['text_no_results'] = 'No Result Found';
        }
        if (isset($_POST['filter_date_start'])) {
            $url .= '&filter_date_start=' . $_POST['filter_date_start'];
        }

        if (isset($_POST['filter_date_end'])) {
            $url .= '&filter_date_end=' . $_POST['filter_date_end'];
        }
        $data['results'] = $data['text_no_results'];
        $data['filter_date_start'] = $filter_date_start;
        $data['filter_date_end'] = $filter_date_end;
        $this->render('freshstock', array(
            'data' => $data,
        ));
    }

    public function actionAttendance() {
        $this->active_menu = "reports";
        $this->open_class = "reports";
        $this->active_class = "attendance";

        if (isset($_POST['filter_date_start'])) {
            $filter_date_start = $_POST['filter_date_start'];
        } else {
            $filter_date_start = date('Y-m-d', strtotime(date('Y') . '-' . date('m') . '-01'));
        }

        if (isset($_POST['filter_date_end'])) {
            $filter_date_end = $_POST['filter_date_end'];
        } else {
            $filter_date_end = date('Y-m-d');
        }

        if (isset($_POST['filter_date'])) {
            $url .= '&filter_date=' . $_POST['filter_date'];
        }

        $report = new Reports;

        $data['data'] = array();

        $filter_data = array(
            'filter_date_start' => $filter_date_start,
            'filter_date_end' => $filter_date_end,
            // 'filter_order_status_id' => $filter_order_status_id,
            'start' => ($page - 1) * 5,
            'limit' => 5
        );

        $results = $report->getcalculatedsalary($filter_data);
        if (!empty($results)) {
            foreach ($results as $result) {
                $data['data'][] = array(
                    //'date_start' => date('d/m/Y', strtotime($result['dated'])),
                    //'date_end' => date('d/m/Y', strtotime($result['date_end'])),
                    'empcode' => $result['empcode'],
                    'empname' => $result['empname'],
                    'dob' => $result['dob'],
                    'tpresent' => $result['tpresent'],
                    'tabsent' => $result['tabsent'],
                    'tleave' => $result['tleave'],
                    'basic' => $result['basic'],
                    'advance' => $result['advance'],
                    'ta' => $result['ta'],
                    'da' => $result['da'],
                    'hra' => $result['hra'],
                    'salary_deduction' => $result['salary_deduction'],
                    'tsalary' => $result['tsalary'],
                );
            }
        } else {
            $data['text_no_results'] = 'No Result Found';
        }
        if (isset($_POST['filter_date_start'])) {
            $url .= '&filter_date_start=' . $_POST['filter_date_start'];
        }

        if (isset($_POST['filter_date_end'])) {
            $url .= '&filter_date_end=' . $_POST['filter_date_end'];
        }
        $data['results'] = $data['text_no_results'];
        $data['filter_date_start'] = $filter_date_start;
        $data['filter_date_end'] = $filter_date_end;
        $this->render('attendance', array(
            'data' => $data,
        ));
    }

    public function actionVendorpayment() {
        $this->active_menu = "reports";
        $this->open_class = "reports";
        $this->active_class = "payment";

        $date_half = date(strtotime(date('Y-m-d')) - (86400 * 9));
        $filter_date_start = date('Y-m-d', $date_half);
        $filter_date_end = date('Y-m-d');

        $report = new Reports;
        $data['data'] = array();
        $filter_data = array(
            'filter_date_start' => $filter_date_start,
            'filter_date_end' => $filter_date_end
        );

        $results = $report->getvendorduepayment($filter_data);
        if (!empty($results)) {
            foreach ($results as $result) {
                $data['data'][] = array(
                    //'date_start' => date('d/m/Y', strtotime($result['dated'])),
                    //'date_end' => date('d/m/Y', strtotime($result['date_end'])),
                    'id' => $result['id'],
                    'name' => $result['name'],
                    'firmname' => $result['firm_name'],
                    'tinno' => $result['tin_no'],
                    'mobile' => $result['mobile'],
                    'email' => $result['email'],
                    'balance' => $result['vendor_bal']
                );
            }
        } else {
            $data['text_no_results'] = 'No Result Found';
        }

        $data['results'] = $data['text_no_results'];
        $data['filter_date_start'] = $filter_date_start;
        $data['filter_date_end'] = $filter_date_end;
        $this->render('vendorpayment', array(
            'data' => $data,
        ));
    }

    public function actionGetvendorlist() {
        $report = new Reports;
        $data['data'] = array();

        $results = $report->getallvendorduepayment();
        if (!empty($results)) {
            foreach ($results as $result) {
                $data['data'][] = array(
                    //'date_start' => date('d/m/Y', strtotime($result['dated'])),
                    //'date_end' => date('d/m/Y', strtotime($result['date_end'])),
                    'id' => $result['id'],
                    'name' => $result['name'],
                    'firmname' => $result['firm_name'],
                    'tinno' => $result['tin_no'],
                    'mobile' => $result['mobile'],
                    'email' => $result['email'],
                    'balance' => $result['vendor_bal']
                );
            }
        } else {
            $data['text_no_results'] = 'No Result Found';
        }

        $data['results'] = $data['text_no_results'];
        $this->renderPartial('_allvendorlist', array(
            'data' => $data,
        ));
    }

    public function actionItemwisesales() {

        if (isset($_POST['filter_date_start'])) {
            $filter_date_start = $_POST['filter_date_start'];
        } else {
            $filter_date_start = date('Y-m-d', strtotime(date('Y') . '-' . date('m') . '-01'));
        }

        if (isset($_POST['filter_date_end'])) {
            $filter_date_end = $_POST['filter_date_end'];
        } else {
            $filter_date_end = date('Y-m-d');
        }

        if (isset($_POST['filter_item'])) {
            $filter_item = $_POST['filter_item'];
        } else {
            $filter_item = '';
        }

        if (isset($_POST['filter_date'])) {
            $url .= '&filter_date=' . $_POST['filter_date'];
        }

        if (isset($_POST['filter_item'])) {
            $url .= '&filter_item=' . $_POST['filter_item'];
        }

        $report = new Reports;

        $data['orders'] = array();

        $filter_data = array(
            'filter_date_start' => $filter_date_start,
            'filter_date_end' => $filter_date_end,
            'filter_item' => $filter_item,
            // 'filter_order_status_id' => $filter_order_status_id,
            'start' => ($page - 1) * 5,
            'limit' => 5
        );

        $results = $report->getOrdersitem($filter_data);
        if (!empty($results)) {
            foreach ($results as $result) {
                $data['orders'][] = array(
                    'date_start' => date('d/m/Y', strtotime($result['dated'])),
                    'date_end' => date('d/m/Y', strtotime($result['date_end'])),
                    'dated' => $result['dated'],
                    'item_name' => $result['item_name'],
                    'total' => $result['total']
                );
            }
        } else {
            $data['text_no_results'] = 'No Result Found';
        }
        if (isset($_POST['filter_date_start'])) {
            $url .= '&filter_date_start=' . $_POST['filter_date_start'];
        }

        if (isset($_POST['filter_date_end'])) {
            $url .= '&filter_date_end=' . $_POST['filter_date_end'];
        }
        $data['results'] = $data['text_no_results'];
        $data['filter_date_start'] = $filter_date_start;
        $data['filter_date_end'] = $filter_date_end;
        $data['filter_item'] = $filter_item;
        $this->render('itemwisesales', array(
            'data' => $data,
        ));
    }

    public function actionExpenses() {

        if (isset($_POST['filter_date_start'])) {
            $filter_date_start = $_POST['filter_date_start'];
        } else {
            $filter_date_start = date('Y-m-d', strtotime(date('Y') . '-' . date('m') . '-01'));
        }

        if (isset($_POST['filter_date_end'])) {
            $filter_date_end = $_POST['filter_date_end'];
        } else {
            $filter_date_end = date('Y-m-d');
        }

        if (isset($_POST['filter_item'])) {
            $filter_item = $_POST['filter_item'];
        } else {
            $filter_item = '';
        }

        if (isset($_POST['filter_date'])) {
            $url .= '&filter_date=' . $_POST['filter_date'];
        }

        if (isset($_POST['filter_item'])) {
            $url .= '&filter_item=' . $_POST['filter_item'];
        }

        $report = new Reports;

        $data['orders'] = array();

        $filter_data = array(
            'filter_date_start' => $filter_date_start,
            'filter_date_end' => $filter_date_end,
            'filter_item' => $filter_item,
            // 'filter_order_status_id' => $filter_order_status_id,
            'start' => ($page - 1) * 5,
            'limit' => 5
        );

        $results = $report->getExpensesitem($filter_data);
        if (!empty($results)) {
            foreach ($results as $result) {
                $data['orders'][] = array(
                    'date' => date('d/m/Y', strtotime($result['date'])),
                    'dated' => $result['dated'],
                    'eid' => $result['eid'],
                    'sid' => $result['sid'],
                    'qty' => $result['qty'],
                    'total' => $result['total']
                );
            }
        } else {
            $data['text_no_results'] = 'No Result Found';
        }
        if (isset($_POST['filter_date_start'])) {
            $url .= '&filter_date_start=' . $_POST['filter_date_start'];
        }

        if (isset($_POST['filter_date_end'])) {
            $url .= '&filter_date_end=' . $_POST['filter_date_end'];
        }
        $data['results'] = $data['text_no_results'];
        $data['filter_date_start'] = $filter_date_start;
        $data['filter_date_end'] = $filter_date_end;
        $data['filter_item'] = $filter_item;
        $this->render('expenses', array(
            'data' => $data,
        ));
    }

    public function actionTodaysales() {

        if (isset($_POST['filter_date'])) {
            $filter_date = $_POST['filter_date'];
        } else {
            $filter_date = date('Y-m-d');
        }

        if (isset($_POST['filter_cat'])) {
            $filter_cat = $_POST['filter_cat'];
        } else {
            $filter_cat = '';
        }

        if (isset($_POST['filter_date'])) {
            $url .= '&filter_date=' . $_POST['filter_date'];
        }

        if (isset($_POST['filter_item'])) {
            $url .= '&filter_cat=' . $_POST['filter_cat'];
        }

        $report = new Reports;

        $data['orders'] = array();

        $filter_data = array(
            'filter_date' => $filter_date,
            'filter_cat' => $filter_cat,
            // 'filter_order_status_id' => $filter_order_status_id,
            'start' => ($page - 1) * 5,
            'limit' => 5
        );

        $results = $report->getTodayOrdersitem($filter_data);
        if (!empty($results)) {
            foreach ($results as $result) {
                $data['orders'][] = array(
                    'date' => date('d/m/Y', strtotime($result['orderdate'])),
                    'id' => $result['id'],
                    'cat' => $result['type'],
                    'tableno' => $result['tableno'],
                    'cname' => $result['customername'],
                    'mno' => $result['mobileno'],
                    'total' => $result['netamount']
                );
            }
        } else {
            $data['text_no_results'] = 'No Result Found';
        }
        if (isset($_POST['filter_date'])) {
            $url .= '&filter_date=' . $_POST['filter_date'];
        }

        $data['results'] = $data['text_no_results'];
        $data['filter_date'] = $filter_date;
        $data['filter_cat'] = $filter_cat;
        $this->render('todaysales', array(
            'data' => $data,
        ));
    }

    public function actionSales() {
        if (isset($_POST['filter_date_start'])) {
            $filter_date_start = $_POST['filter_date_start'];
        } else {
            $filter_date_start = date('Y-m-d', strtotime(date('Y') . '-' . date('m') . '-01'));
        }

        if (isset($_POST['filter_date_end'])) {
            $filter_date_end = $_POST['filter_date_end'];
        } else {
            $filter_date_end = date('Y-m-d');
        }

        if (isset($_POST['filter_group'])) {
            $filter_group = $_POST['filter_group'];
        } else {
            $filter_group = 'week';
        }
        if (isset($_POST['page'])) {
            $page = $_POST['page'];
        } else {
            $page = 1;
        }

        $url = '';

        if (isset($_POST['filter_date_start'])) {
            $url .= '&filter_date_start=' . $_POST['filter_date_start'];
        }

        if (isset($_POST['filter_date_end'])) {
            $url .= '&filter_date_end=' . $_POST['filter_date_end'];
        }

        if (isset($_POST['filter_group'])) {
            $url .= '&filter_group=' . $_POST['filter_group'];
        }

        $report = new Reports;

        $data['orders'] = array();

        $filter_data = array(
            'filter_date_start' => $filter_date_start,
            'filter_date_end' => $filter_date_end,
            'filter_group' => $filter_group,
            // 'filter_order_status_id' => $filter_order_status_id,
            'start' => ($page - 1) * 5,
            'limit' => 5
        );

        $results = $report->getOrders($filter_data);

        foreach ($results as $result) {
            $data['orders'][] = array(
                'date_start' => date('d/m/Y', strtotime($result['date_start'])),
                'date_end' => date('d/m/Y', strtotime($result['date_end'])),
                'orders' => $result['orders'],
                'products' => $result['products'],
                //  'tax' => $this->currency->format($result['tax'], $this->config->get('config_currency')),
                'total' => $result['total']
            );
        }
        $data['text_no_results'] = 'No Result Found';

        $data['groups'] = array();

        $data['groups'][] = array(
            'text' => 'Year',
            'value' => 'year',
        );

        $data['groups'][] = array(
            'text' => 'Month',
            'value' => 'month',
        );

        $data['groups'][] = array(
            'text' => 'Week',
            'value' => 'week',
        );

        $data['groups'][] = array(
            'text' => 'Day',
            'value' => 'day',
        );

        if (isset($_POST['filter_date_start'])) {
            $url .= '&filter_date_start=' . $_POST['filter_date_start'];
        }

        if (isset($_POST['filter_date_end'])) {
            $url .= '&filter_date_end=' . $_POST['filter_date_end'];
        }

        if (isset($_POST['filter_group'])) {
            $url .= '&filter_group=' . $_POST['filter_group'];
        }
        $data['filter_date_start'] = $filter_date_start;
        $data['filter_date_end'] = $filter_date_end;
        $data['filter_group'] = $filter_group;
        $this->render('sales', array(
            'data' => $data,
        ));
    }

    public function actionSmsreport() {

        $this->render('smsreport');
    }

    public function actionSendsmsreport() {
        $rtype = Yii::app()->request->getQuery("rtype");
        $mobilenos = array();
        $reports = new Reports();
        if ($rtype == 'weekly') {
            $time = time() - 86400 * 7;
            $tdate = date('Y-m-d', $time);
            $fdate = date('Y-m-d');
            $salesreport = $reports->getWeekSales($tdate, $fdate);
            $smsformat = "GO Highway Restuarant Weekly Sales Report &nbsp;&nbsp;&nbsp;Weekly Sales : " . $salesreport . " Period : " . date("d-m-Y", strtotime($tdate)) . " to " . date("d-m-Y", strtotime($fdate));
            foreach (Numberlist::model()->findAll() as $m) {
                $mobilenos[] = $m->mobileno;
            }
            SendSms::sendMulti($smsformat, $mobilenos);
            $checkmodel = Smsreport::model()->findByAttributes(array("rtype" => $rtype, "status" => 1, "sdate" => date('Y-m-d')));
            if (empty($checkmodel)) {
                $model = new Smsreport();
                $model->rtype = $rtype;
                $model->lmonth = $tdate;
                $model->day = 'Monday';
                $model->sdate = date('Y-m-d');
                $model->sdated = date('Y-m-d h:i:s');
                $model->status = 1;
                $model->save();
                echo CJSON::encode(array('rtype' => $rtype, 'msg' => 0, 'msg1' => $smsformat));
            } else {
                echo CJSON::encode(array('rtype' => $rtype, 'msg' => 1, 'msg1' => $smsformat));
            }
        }
        if ($rtype == 'monthly') {
            //$currentMonth = date('F');
            //echo Date('F', strtotime($currentMonth . " last month"));
            $month = date('m', strtotime(date('Y-m') . " -1 month"));
            $lmonth = date('Y-m-d', strtotime(date('Y-m') . " -1 month"));
            $salesreport = $reports->getMonthSales($month);
            $smsformat = "GO Highway Restuarant Monthly Sales Report &nbsp;&nbsp;&nbsp;Monthly Sales : " . $salesreport . " Month : " . date("d-m-Y", strtotime($lmonth));
            foreach (Numberlist::model()->findAll() as $m) {
                $mobilenos[] = $m->mobileno;
            }
            SendSms::sendMulti($smsformat, $mobilenos);
            $checkmodel = Smsreport::model()->findByAttributes(array("rtype" => $rtype, "status" => 1, "sdate" => date('Y-m-d')));
            if (empty($checkmodel)) {
                $model = new Smsreport();
                $model->rtype = $rtype;
                $model->lmonth = $lmonth;
                $model->day = date('l');
                $model->sdate = date('Y-m-d');
                $model->sdated = date('Y-m-d h:i:s');
                $model->status = 1;
                $model->save();
                echo CJSON::encode(array('rtype' => $rtype, 'msg' => 0, 'msg1' => $smsformat));
            } else {
                echo CJSON::encode(array('rtype' => $rtype, 'msg' => 1, 'msg1' => $smsformat));
            }
        }
    }

    public function actionCheckreportsend() {
        $rtype = Yii::app()->request->getQuery("rtype");
        if ($rtype == 'daily') {

            echo CJSON::encode(array('rtype' => $rtype));
        }
        if ($rtype == 'weekly') {
            $day = date('l');
            if ($day == 'Monday') {
                $status = "1";
            } else {
                $status = "0";
            }
            echo CJSON::encode(array('rtype' => $rtype, 'status' => $status));
        }
        if ($rtype == 'monthly') {
            $lmonth = date('Y-m-d', strtotime(date('Y-m') . " -1 month"));
            $checklastmonthreport = Smsreport::model()->findByAttributes(array("lmonth" => $lmonth, "rtype" => 'monthly'));
            if (empty($checklastmonthreport)) {
                $status = "1";
            } else {
                $status = "0";
            }
            echo CJSON::encode(array('rtype' => $rtype, 'status' => $status));
        }
    }

    public function actionGetprice() {
        $id = $_POST['item'];
        $model = Menuitems::model()->findByPk($id);
        echo $model->price;
        //exit();
    }

    public function actionOrderdetails($id) {
        $show = Orders::model()->findByPk($id);
        $this->render('orderdetails', array('produ' => $show));
    }

    public function actionOrderkotdetails($id) {
        $model = new Orderkot('kotsearch');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Orderkot']))
            $model->attributes = $_GET['Orders'];
        $this->render('orderkotdetails', array('model' => $model, 'id' => $id));
    }

    public function actionDeleteorderkot() {
        $orderkot = Orderkot::model()->findByPk($_GET['id']);
        $list = Orderitems::model()->findAllByAttributes(array("order_id" => $orderkot->order_id, 'tokenno' => $orderkot->tokenno));
        foreach ($list as $k) {
            // echo $k->item_name;
            $k->isdelete = 1;
            $k->save();
        }
        $orderkot->isdelete = 1;
        $orderkot->save();
        $this->redirect(array('orders/tablebills'));
    }

    public function actionPrint() {
        $klist = array();
        if (!empty($_GET['orderid'])) {
            $id = $_GET['orderid'];
        } else {
            $id = $_SESSION['ordersid'];
        }
        $data = Orders::model()->findByPk($id);
        $kotlist = Orderkot::model()->findAllByAttributes(array("order_id" => $data->id, "isdelete" => 0));
        foreach ($kotlist as $k) {
            $klist[] = $k->tokenno;
        }
        $kots = implode(",", $klist);
        $list = Orderitems::model()->findAllByAttributes(array("order_id" => $data->id, "isdelete" => 0));
        $this->renderPartial('_print', array(
            'list' => $list, 'data' => $data, 'id' => $id, 'kots' => $kots,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Admin::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'admin-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
