<?php

class AosController extends Controller {

    public $layout = '//layouts/pos_column';

    /**
     * @return array action filters
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
                'actions' => array('index'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('searchdata', 'searchdatabystatus', 'changestatus', 'saveadvance',
                    'vieworder', 'status', 'generatebill', 'getdesignrate', 'viewingredients'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array(''),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionStatus() {
        $data = $_POST['data'];
        $d2 = strtotime(date('Y-m-d'));
        $d1 = $d2 - (86400 * 7);
        $fd = date('Y-m-d', $d2);
        $td = date('Y-m-d', $d1);
        if (!empty($data)) {
            $customer = array();
            $customer1 = Customer::model()->findAllBySql("select * from customer where full_name like '%$data%'");
            if (!empty($customer1)) {
                foreach ($customer1 as $val) {
                    $customer[] = $val->id;
                }
            } else {
                $customer2 = Customer::model()->findAllBySql("select * from customer where mobile_no like '%$data%'");
                foreach ($customer2 as $val) {
                    $customer[] = $val->id;
                }
            }
            $order1 = Cakeorder::model()->findAllByAttributes(array('customer_id' => $customer));
            if (!empty($order1)) {
                $searchdata = $order1;
            } else if (empty($order1)) {
                $order2 = Cakeorder::model()->findAllBySql("select * from cake_order where id like '%$data%' and order_date>=$d1 and order_date<=$d2");
                $searchdata = $order2;
            }
        } else {
            $searchdata = Cakeorder::model()->findAllBySql("select * from cake_order where order_date>=$d1 and order_date<=$d2");
        }
        $this->renderPartial('_status', array('searchdata' => $searchdata));
    }

    public function actionVieworder() {
        $id = $_POST['id'];
        $this->renderPartial('_view_order', array('id' => $id));
    }

    public function actionViewingredients() {
        $id = $_POST['id'];
        $cake_order = Cakeorder::model()->findByPk($id);
        $recipe = Recipeitems::model()->findByAttributes(array('recipe_category' => 'Flavour', 'category_name_id' => $cake_order->flavour_id));
        $ingredients = Ingredients::model()->findAllByAttributes(array('recipe_item_id' => $recipe->id));
        $this->renderPartial('_ingredients', array(
            'list' => $ingredients,
            'recipe' => $recipe,
            'cake_order' => $cake_order,
        ));
    }

    public function actiongetdesignrate() {
        $id = $_POST['id'];
        $design = Designcomplexity::model()->findByPk($id);
        echo $design->rate;
    }

    public function actionGeneratebill() {
        $id = $_POST['id'];
        $order = Cakeorder::model()->findByPk($id);
        $invoice_no = count(Cakeorder::model()->findAllByAttributes(array('cake_status' => 'delivered'))) + 1;
        $balance = $_POST['payable'] - $_POST['paid'];
        $order->design_complexity_id = $_POST['design_complexity_id'];
        $order->design_complexity_rate = $_POST['design_complexity_rate'];
        $order->extra_charges = $_POST['extra_charges'];
        $order->discount = $_POST['discount'];
        $order->tax = $_POST['tax'];
        $order->amount = $_POST['total_amt'];
        $order->delivery_charges = $_POST['delivery_charges'];
        $order->balance_amount = $balance;
        $order->invoice_no = $invoice_no;
        $order->update();
    }

    public function actionSaveadvance() {
        $id = $_POST['order_id'];
        $order = Cakeorder::model()->findByPk($id);
        $balance = $order->amount - $_POST['advance'];
        $order->advance_amount = $_POST['advance'];
        $order->balance_amount = $balance;
        $order->remark = $_POST['remark'];
        $order->update();
//        $searchdata = Cakeorder::model()->findAllByAttributes(array('cake_status' => $status));
//        $this->renderPartial('_searchdatabystatus', array('searchdata' => $searchdata, 'status' => $status));
    }

    public function actionSearchdata() {
        $data = $_POST['data'];
        $customer = array();
        $customer1 = Customer::model()->findAllBySql("select * from customer where full_name like '%$data%'");
        if (!empty($customer1)) {
            foreach ($customer1 as $val) {
                $customer[] = $val->id;
            }
        } else {
            $customer2 = Customer::model()->findAllBySql("select * from customer where mobile_no like '%$data%'");
            foreach ($customer2 as $val) {
                $customer[] = $val->id;
            }
        }
        $order1 = Cakeorder::model()->findAllByAttributes(array('customer_id' => $customer));
        if (!empty($order1)) {
            $searchdata = $order1;
        } else if (empty($order1)) {
            $order2 = Cakeorder::model()->findAllBySql("select * from cake_order where id like '%$data%'");
            $searchdata = $order2;
        }
        $this->renderPartial('_searchdata', array('searchdata' => $searchdata));
    }

    public function actionSearchdatabystatus() {
        $status = $_POST['status'];
        $searchdata = Cakeorder::model()->findAllByAttributes(array('cake_status' => $status));
        $this->renderPartial('_searchdatabystatus', array('searchdata' => $searchdata, 'status' => $status));
    }

    public function actionChangestatus() {
        $status = $_POST['status'];
        $id = $_POST['id'];
        $cash_drawer = Cashdrawer::model()->findByAttributes(array('date' => date('Y-m-d'), 'user_to' => Yii::app()->user->id), array('order' => 'id desc', 'limit' => 1));
        $data = Cakeorder::model()->findByPk($id);
        $data->cake_status = $status;
        if($data->cake_status=='p_accepted' || $data->cake_status=='processing'){
         $data->picked_counter_id = $cash_drawer->counter_id;   
        }
        $data->update();
    }

}
