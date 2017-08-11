<?php

class CreditController extends Controller {

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
                'actions' => array(),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('creditcustomer', 'index', 'paycreditbill'
                ),
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

    public function actionPaycreditbill() {
      $msg="fail";
        $arr = $_POST;
//        print_r($arr);
//        exit();
        if (!empty($arr)) {
            $amt = 0.00;
            foreach ($arr as $k => $v) {
                $off_shelf = Offshelfsale::model()->findByPk($k);
                if (!empty($off_shelf)) {
                    $credit_acc = new Creditaccount();
                    $credit_acc->bill_no = $off_shelf->invoice_number;
                    $credit_acc->pos_id = $off_shelf->id;
                    $credit_acc->pos_type = 'ots';
                    $credit_acc->credit_amount = $v;
                    $credit_acc->dated = date('Y-m-d');
                    $credit_acc->remark = "Amount " . $v . " has been paid";
                    $credit_acc->save();
                    $amt = $amt + $v;
                }
            }
            /* Create Voucher */
         $cash_drawer = Cashdrawer::model()->findByAttributes(array('date' => date('Y-m-d'), 'user_to' => Yii::app()->user->id), array('order' => 'id DESC'));
    
            $vtype_id = 11; //for voucher type receipt
            $vouchers = Voucher::model()->model()->findBySql("select * from voucher where voucher_type_id='$vtype_id' order by id desc limit 1");
            $exist_voucher = explode("/", $vouchers->voucher_no);
            if (empty($exist_voucher[1])) {
                $voucherid = 1001;
            } else {
                $voucherid = $exist_voucher[1] + 1;
            }
            $model = new Voucher();
//            $model->attributes = $_POST['Voucher'];
            $model->txn_type = "others";
            $model->amount = $amt;
            $model->created_by = Yii::app()->user->id;
            $model->counter_id =$cash_drawer->counter_id;
            $model->payment_receiver_type ='others';
            $model->dated = date('Y-m-d');
            $model->received_status=1;
            $model->voucher_type_id=$vtype_id;
            $model->c_number_t_num_utr_num=$_POST['Voucher']['c_number_t_num_utr_num'];
            $model->account_no=$_POST['Voucher']['account_no'];
            $model->bank_card_name=$_POST['Voucher']['bank_card_name'];
            $model->payment_mode=$_POST['Voucher']['payment_mode'];
            $model->remark="Amount ". $amt ." Received By ".Yii::app()->user->name." in mode of ". $model->txn_type. " Dated ". date('Y-m-d h:i:s');
            $model->save();
            $model->voucher_no = $vtype_id . "/" . $voucherid;
            $model->save();
            $msg="success";
        }
     echo CJSON::encode(array('msg' => $msg));
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionGetorders() {
        $pos_type = $_POST['pos_type'];
        $search = $_POST['search_order'];
        $mobile = isset($_POST['mobile_no']) ? $_POST['mobile_no'] : '';
//        $counter_id = $_POST['counter_id'];
        $fd = $_POST['fd'];
        $td = $_POST['td'];
        //   $uid = Yii::app()->user->id;
        if ($pos_type == 'OTS') {
            if (!empty($fd) && !empty($td)) {
                $shelf_sale = $this->getCustomerBill($mobile, $fd, $td);
            }
            if ($search == 'export') {
                $this->render('getotsexcel', array('shelf_sale' => $shelf_sale));
            } else {
                $this->renderPartial('_getotsorders', array('shelf_sale' => $shelf_sale, 'mobile' => $mobile));
            }
        } else if ($pos_type == 'MENU') {
            if (!empty($fd) && !empty($td) && !empty($counter_id)) {
                $menu_sale = Menusale::model()->findAllBySql("select * from menu_sale where txn_type='cash' and created_by=$uid and counter_id=$counter_id and order_date between '$fd' and '$td'");
            } else if (!empty($fd) && !empty($td) && empty($counter_id)) {
                $menu_sale = Menusale::model()->findAllBySql("select * from menu_sale where txn_type='cash' and created_by=$uid and order_date between '$fd' and '$td'");
            }
            $this->renderPartial('_getmenuorders', array('menu_sale' => $menu_sale));
        }
    }

    private function getCustomerBill($mobile, $fd, $td) {
        $c = Customer::model()->findByAttributes(array('mobile_no' => $mobile, 'type' => 'cash'));
        // echo $c->id;
        $str = "SELECT sum(o.amount) as amount,s.id,s.invoice_number,c.full_name,c.mobile_no,
                s.order_date,s.order_time from off_shelf_sale s 
                JOIN off_shelf_sale_items o ON o.shelf_sale_id=s.id 
                JOIN customer c ON c.id=s.customer_id ";
        if (!empty($c->id)) {
            $str .=" where s.customer_id=$c->id and pay_status='Credit' and order_date between '$fd' and '$td' group by o.shelf_sale_id";
        } else {
            $str .=" where order_date between '$fd' and '$td' and pay_status='Credit' group by o.shelf_sale_id";
        }
        //echo $str;
        return $items = Yii::app()->db->createCommand($str)->queryAll();
    }

}
